<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\SesiPresensi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PresensiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sesi_presensi_id' => 'required|exists:sesi_presensi,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'status' => 'required|in:HADIR,TERLAMBAT,IZIN,SAKIT,ALPHA',
            'metode' => 'required|in:QR,MANUAL',
            'catatan' => 'nullable|string',
        ]);

        $sesi = SesiPresensi::findOrFail($validated['sesi_presensi_id']);

        if ($sesi->status !== 'OPEN' || now()->lt($sesi->opened_at) || now()->gt($sesi->expired_at)) {
            return back()->withErrors(['sesi_presensi_id' => 'Sesi presensi tidak tersedia.']);
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

        $presensi = Presensi::with(['sesiPresensi.jadwal.mataKuliah', 'sesiPresensi.jadwal.kelas'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->orderByDesc('waktu_presensi')
            ->paginate(10)
            ->withQueryString();

        return view('presensi.history', compact('presensi'));
    }

    public function showScanForm()
    {
        return view('presensi.scan');
    }

    public function scan(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $sesi = SesiPresensi::where('token', $request->token)
            ->where('status', 'OPEN')
            ->where('opened_at', '<=', now())
            ->where('expired_at', '>=', now())
            ->first();

        if (! $sesi) {
            return back()->withErrors(['token' => 'Token sesi tidak valid atau sudah kedaluwarsa.']);
        }

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        Presensi::updateOrCreate(
            [
                'sesi_presensi_id' => $sesi->id,
                'mahasiswa_id' => $mahasiswa->id,
            ],
            [
                'status' => 'HADIR',
                'metode' => 'QR',
                'waktu_presensi' => now(),
            ]
        );

        return redirect()->route('mahasiswa.presensi.history')->with('success', 'Presensi QR berhasil dicatat.');
    }

    public function rekap(Request $request)
    {
        $rekap = Presensi::with(['sesiPresensi.jadwal.mataKuliah', 'sesiPresensi.jadwal.kelas', 'mahasiswa.kelas'])
            ->orderByDesc('waktu_presensi')
            ->paginate(20)
            ->withQueryString();

        return view('presensi.rekap', compact('rekap'));
    }
}
