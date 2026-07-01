<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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

        return view('sesi_presensi.index', compact('sesi'));
    }

    public function create()
    {
        $dosenId = auth()->user()->dosen?->id;

        $jadwal = Jadwal::with(['mataKuliah', 'kelas'])
            ->where('status', true)
            ->where('dosen_id', $dosenId)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('sesi_presensi.create', compact('jadwal'));
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

        $validated['token'] = Str::upper(Str::random(12));
        $validated['status'] = 'OPEN';

        SesiPresensi::create($validated);

        return redirect()->route('dosen.sesi_presensi.index')->with('success', 'Sesi presensi berhasil dibuat.');
    }

    public function show(SesiPresensi $sesiPresensi)
    {
        $sesiPresensi->load(['jadwal.mataKuliah', 'jadwal.kelas', 'jadwal.dosen', 'presensi.mahasiswa']);

        $mahasiswa = Mahasiswa::where('kelas_id', $sesiPresensi->jadwal->kelas_id)
            ->orderBy('nama')
            ->get();

        $qrCode = QrCode::size(220)->generate($sesiPresensi->token);

        return view('sesi_presensi.show', compact('sesiPresensi', 'mahasiswa', 'qrCode'));
    }

    public function close(SesiPresensi $sesiPresensi)
    {
        $sesiPresensi->update([
            'status' => 'CLOSED',
            'closed_at' => now(),
        ]);

        return redirect()->route('dosen.sesi_presensi.show', $sesiPresensi)->with('success', 'Sesi presensi berhasil ditutup.');
    }
}
