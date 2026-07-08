<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Presensi;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SesiPresensiController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->isDosen()) {
            $query = SesiPresensi::with('jadwal')
                ->whereHas('jadwal', function ($query) {
                    $query->where('dosen_id', auth()->user()->dosen->id);
                });
        } else {
            $query = SesiPresensi::with('jadwal');
        }

        $sesi = $query->orderByDesc('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('modules.Academic.sesi_presensi.index', compact('sesi'));
    }

    public function create(Request $request)
    {
        $dosenId = auth()->user()->dosen?->id;

        $jadwal = Jadwal::with(['mataKuliah', 'kelas'])
            ->where('status', true)
            ->where('dosen_id', $dosenId)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        $selectedJadwalId = $request->query('jadwal_id');

        return view('modules.Academic.sesi_presensi.create', compact('jadwal', 'selectedJadwalId'));
    }

    public function store(Request $request)
    {
        $dosenId = $request->user()->dosen?->id;

        abort_if(! $dosenId, 403, 'Akun dosen belum terhubung dengan data dosen.');

        $validated = $request->validate([
            'jadwal_id' => [
                'required',
                Rule::exists('jadwal', 'id')->where(function ($query) use ($dosenId) {
                    $query->where('dosen_id', $dosenId)
                        ->where('status', true);
                }),
            ],
            'pertemuan_ke' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'opened_at' => 'required|date',
            'expired_at' => 'required|date|after:opened_at',
        ]);

        $openedAt = Carbon::parse($validated['opened_at']);
        $expiredAt = Carbon::parse($validated['expired_at']);

        $hasOverlappingSession = SesiPresensi::where('jadwal_id', $validated['jadwal_id'])
            ->where('status', 'OPEN')
            ->where('opened_at', '<', $expiredAt)
            ->where('expired_at', '>', $openedAt)
            ->exists();

        if ($hasOverlappingSession) {
            throw ValidationException::withMessages([
                'jadwal_id' => 'Jadwal ini sudah memiliki sesi presensi aktif pada rentang waktu tersebut.',
            ]);
        }

        $validated['opened_at'] = $openedAt->toDateTimeString();
        $validated['expired_at'] = $expiredAt->toDateTimeString();
        $validated['token'] = Str::upper(Str::random(12));
        $validated['status'] = 'OPEN';

        SesiPresensi::create($validated);

        return redirect()->route('dosen.sesi_presensi.index')->with('success', 'Sesi presensi berhasil dibuat.');
    }

    public function show(SesiPresensi $sesiPresensi)
    {
        $this->authorizeDosenSession($sesiPresensi);

        $sesiPresensi->load(['jadwal.mataKuliah', 'jadwal.kelas', 'jadwal.dosen', 'presensi.mahasiswa']);

        $mahasiswa = Mahasiswa::where('kelas_id', $sesiPresensi->jadwal->kelas_id)
            ->orderBy('nama')
            ->get();

        $presensiByMahasiswa = $sesiPresensi->presensi->keyBy('mahasiswa_id');
        $statusCounts = collect([
            'HADIR' => 0,
            'TERLAMBAT' => 0,
            'IZIN' => 0,
            'SAKIT' => 0,
            'ALPHA' => 0,
        ]);

        foreach ($sesiPresensi->presensi as $presensi) {
            $statusCounts[$presensi->status] = ($statusCounts[$presensi->status] ?? 0) + 1;
        }

        $belumPresensi = $mahasiswa->reject(
            fn (Mahasiswa $mhs): bool => $presensiByMahasiswa->has($mhs->id)
        );

        $qrCode = $sesiPresensi->status === 'OPEN'
            ? QrCode::size(220)->generate($sesiPresensi->token)
            : null;

        return view('modules.Academic.sesi_presensi.show', compact(
            'sesiPresensi',
            'mahasiswa',
            'qrCode',
            'presensiByMahasiswa',
            'statusCounts',
            'belumPresensi'
        ));
    }

    public function close(SesiPresensi $sesiPresensi)
    {
        $this->authorizeDosenSession($sesiPresensi);

        $sesiPresensi->update([
            'status' => 'CLOSED',
            'closed_at' => now(),
        ]);

        return redirect()->route('dosen.sesi_presensi.show', $sesiPresensi)->with('success', 'Sesi presensi berhasil ditutup.');
    }

    public function markAlpha(SesiPresensi $sesiPresensi)
    {
        $this->authorizeDosenSession($sesiPresensi);

        if ($sesiPresensi->status !== 'CLOSED') {
            return back()->withErrors(['sesi_presensi_id' => 'Alpha otomatis hanya dapat dilakukan setelah sesi ditutup.']);
        }

        $sesiPresensi->load('jadwal');

        $mahasiswaIds = Mahasiswa::where('kelas_id', $sesiPresensi->jadwal->kelas_id)->pluck('id');
        $presentMahasiswaIds = Presensi::where('sesi_presensi_id', $sesiPresensi->id)->pluck('mahasiswa_id');
        $missingMahasiswaIds = $mahasiswaIds->diff($presentMahasiswaIds);

        DB::transaction(function () use ($sesiPresensi, $missingMahasiswaIds): void {
            foreach ($missingMahasiswaIds as $mahasiswaId) {
                Presensi::create([
                    'sesi_presensi_id' => $sesiPresensi->id,
                    'mahasiswa_id' => $mahasiswaId,
                    'status' => 'ALPHA',
                    'metode' => 'MANUAL',
                    'waktu_presensi' => now(),
                    'catatan' => 'Ditandai alpha otomatis oleh dosen.',
                ]);
            }
        });

        return redirect()
            ->route('dosen.sesi_presensi.show', $sesiPresensi)
            ->with('success', $missingMahasiswaIds->count() . ' mahasiswa ditandai Alpha.');
    }

    protected function authorizeDosenSession(SesiPresensi $sesiPresensi): void
    {
        $dosenId = auth()->user()->dosen?->id;

        abort_if(! $dosenId, 403, 'Akun dosen belum terhubung dengan data dosen.');

        $sesiPresensi->loadMissing('jadwal');

        abort_if($sesiPresensi->jadwal->dosen_id !== $dosenId, 403, 'Anda tidak memiliki akses ke sesi presensi ini.');
    }
}
