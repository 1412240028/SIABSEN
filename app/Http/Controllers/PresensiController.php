<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\SesiPresensi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PresensiController extends Controller
{
    public function store(Request $request)
    {
        $dosenId = $request->user()->dosen?->id;
        abort_if(! $dosenId, 403, 'Akun dosen belum terhubung dengan data dosen.');

        $routeSesi = $request->route('sesi_presensi');
        if ($routeSesi) {
            $sessionInUrl = $routeSesi instanceof SesiPresensi
                ? $routeSesi
                : SesiPresensi::with('jadwal')->findOrFail($routeSesi);

            abort_if($sessionInUrl->jadwal->dosen_id !== $dosenId, 403, 'Anda tidak memiliki akses ke sesi presensi ini.');
        }

        $validated = $request->validate([
            'sesi_presensi_id' => 'required|exists:sesi_presensi,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'status' => 'required|in:HADIR,TERLAMBAT,IZIN,SAKIT,ALPHA',
            'metode' => 'required|in:QR,MANUAL',
            'catatan' => 'nullable|string',
        ]);

        $routeSesiId = $routeSesi instanceof SesiPresensi ? $routeSesi->id : (int) $routeSesi;

        if ($routeSesiId && $routeSesiId !== (int) $validated['sesi_presensi_id']) {
            abort(403, 'Sesi presensi tidak sesuai dengan URL.');
        }

        $sesi = SesiPresensi::with('jadwal')->findOrFail($validated['sesi_presensi_id']);

        abort_if($sesi->jadwal->dosen_id !== $dosenId, 403, 'Anda tidak memiliki akses ke sesi presensi ini.');

        if ($sesi->status !== 'OPEN' || now()->lt($sesi->opened_at) || now()->gt($sesi->expired_at)) {
            return back()->withErrors(['sesi_presensi_id' => 'Sesi presensi tidak tersedia.']);
        }

        $mahasiswa = Mahasiswa::findOrFail($validated['mahasiswa_id']);

        if ($mahasiswa->kelas_id !== $sesi->jadwal->kelas_id) {
            return back()->withErrors(['mahasiswa_id' => 'Mahasiswa tidak termasuk kelas pada jadwal sesi ini.']);
        }

        $validated['waktu_presensi'] = now();

        Presensi::updateOrCreate(
            [
                'sesi_presensi_id' => $validated['sesi_presensi_id'],
                'mahasiswa_id' => $validated['mahasiswa_id'],
            ],
            $validated
        );

        return back()->with('success', 'Presensi berhasil dicatat.');
    }

    public function history(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $statusOptions = [
            'HADIR' => 'Hadir',
            'TERLAMBAT' => 'Terlambat',
            'IZIN' => 'Izin',
            'SAKIT' => 'Sakit',
            'ALPHA' => 'Alpha',
        ];

        $filters = $request->validate([
            'status' => ['nullable', Rule::in(array_keys($statusOptions))],
            'mata_kuliah_id' => ['nullable', 'integer', 'exists:mata_kuliah,id'],
        ]);

        $presensiQuery = Presensi::with(['sesiPresensi.jadwal.mataKuliah', 'sesiPresensi.jadwal.kelas'])
            ->where('mahasiswa_id', $mahasiswa->id);

        if (! empty($filters['status'])) {
            $presensiQuery->where('status', $filters['status']);
        }

        if (! empty($filters['mata_kuliah_id'])) {
            $presensiQuery->whereHas('sesiPresensi.jadwal', function ($query) use ($filters) {
                $query->where('mata_kuliah_id', $filters['mata_kuliah_id']);
            });
        }

        $mataKuliahOptions = MataKuliah::whereHas('jadwal.sesiPresensi.presensi', function ($query) use ($mahasiswa) {
            $query->where('mahasiswa_id', $mahasiswa->id);
        })
            ->orderBy('nama')
            ->get();

        $presensi = $presensiQuery
            ->orderByDesc('waktu_presensi')
            ->paginate(10)
            ->withQueryString();

        return view('presensi.history', compact('presensi', 'statusOptions', 'mataKuliahOptions', 'filters'));
    }

    public function showScanForm()
    {
        return view('presensi.scan');
    }

    public function scan(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string',
        ]);

        $token = Str::upper(trim($validated['token']));

        $sesi = SesiPresensi::with('jadwal.mataKuliah')
            ->where('token', $token)
            ->where('status', 'OPEN')
            ->where('opened_at', '<=', now())
            ->where('expired_at', '>=', now())
            ->first();

        if (! $sesi) {
            return back()->withErrors(['token' => 'Token sesi tidak valid atau sudah kedaluwarsa.']);
        }

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        if ($mahasiswa->kelas_id !== $sesi->jadwal->kelas_id) {
            return back()->withErrors(['token' => 'Token ini bukan untuk kelas Anda.']);
        }

        $existingPresensi = Presensi::where('sesi_presensi_id', $sesi->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        if ($existingPresensi) {
            return redirect()
                ->route('mahasiswa.presensi.history')
                ->with('info', 'Anda sudah melakukan presensi sebelumnya untuk mata kuliah ' . $sesi->jadwal->mataKuliah->nama . ' (Pertemuan Ke-' . $sesi->pertemuan_ke . ').');
        }

        Presensi::create([
            'sesi_presensi_id' => $sesi->id,
            'mahasiswa_id' => $mahasiswa->id,
            'status' => 'HADIR',
            'metode' => 'QR',
            'waktu_presensi' => now(),
        ]);

        return redirect()
            ->route('mahasiswa.presensi.history')
            ->with('success', 'Presensi QR berhasil dicatat untuk mata kuliah ' . $sesi->jadwal->mataKuliah->nama . ' (Pertemuan Ke-' . $sesi->pertemuan_ke . ') pada pukul ' . now()->format('H:i') . '. Silakan periksa daftar riwayat presensi Anda di bawah ini.');
    }

    public function rekap(Request $request)
    {
        $statusOptions = [
            'HADIR' => 'Hadir',
            'TERLAMBAT' => 'Terlambat',
            'IZIN' => 'Izin',
            'SAKIT' => 'Sakit',
            'ALPHA' => 'Alpha',
        ];

        $filters = $request->validate([
            'kelas_id' => ['nullable', 'integer', 'exists:kelas,id'],
            'mata_kuliah_id' => ['nullable', 'integer', 'exists:mata_kuliah,id'],
            'status' => ['nullable', Rule::in(array_keys($statusOptions))],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        $rekapQuery = Presensi::with(['sesiPresensi.jadwal.mataKuliah', 'sesiPresensi.jadwal.kelas', 'mahasiswa.kelas']);

        if (! empty($filters['kelas_id'])) {
            $rekapQuery->whereHas('sesiPresensi.jadwal', function ($query) use ($filters) {
                $query->where('kelas_id', $filters['kelas_id']);
            });
        }

        if (! empty($filters['mata_kuliah_id'])) {
            $rekapQuery->whereHas('sesiPresensi.jadwal', function ($query) use ($filters) {
                $query->where('mata_kuliah_id', $filters['mata_kuliah_id']);
            });
        }

        if (! empty($filters['status'])) {
            $rekapQuery->where('status', $filters['status']);
        }

        if (! empty($filters['tanggal_mulai'])) {
            $rekapQuery->whereHas('sesiPresensi', function ($query) use ($filters) {
                $query->whereDate('tanggal', '>=', $filters['tanggal_mulai']);
            });
        }

        if (! empty($filters['tanggal_selesai'])) {
            $rekapQuery->whereHas('sesiPresensi', function ($query) use ($filters) {
                $query->whereDate('tanggal', '<=', $filters['tanggal_selesai']);
            });
        }

        $kelasOptions = Kelas::whereHas('jadwal.sesiPresensi.presensi')
            ->orderBy('nama_kelas')
            ->get();

        $mataKuliahOptions = MataKuliah::whereHas('jadwal.sesiPresensi.presensi')
            ->orderBy('nama')
            ->get();

        $rekap = $rekapQuery
            ->orderByDesc('waktu_presensi')
            ->paginate(20)
            ->withQueryString();

        return view('presensi.rekap', compact(
            'rekap',
            'kelasOptions',
            'mataKuliahOptions',
            'statusOptions',
            'filters'
        ));
    }
}
