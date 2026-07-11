<?php

namespace App\Http\Controllers;

use App\Models\KomplainPresensi;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;

class KomplainPresensiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'mahasiswa') {
            $komplain = KomplainPresensi::where('mahasiswa_id', $user->mahasiswa->id)->latest()->get();

            return view('modules.Academic.komplain.mahasiswa_index', compact('komplain'));
        } elseif ($user->role === 'dosen') {
            $jadwalIds = $user->dosen->jadwal()->pluck('id');
            $sesiIds = SesiPresensi::whereIn('jadwal_id', $jadwalIds)->pluck('id');
            $komplain = KomplainPresensi::whereIn('sesi_presensi_id', $sesiIds)
                ->with('mahasiswa', 'sesiPresensi.jadwal.mataKuliah')
                ->latest()
                ->get();

            return view('modules.Academic.komplain.dosen_index', compact('komplain'));
        }

        $komplain = KomplainPresensi::with('mahasiswa', 'sesiPresensi.jadwal.mataKuliah')->latest()->get();

        return view('modules.Academic.komplain.admin_index', compact('komplain'));
    }

    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $sesi = SesiPresensi::with('jadwal.mataKuliah')->whereHas('jadwal', function ($q) use ($mahasiswa) {
            $q->where('kelas_id', $mahasiswa->kelas_id);
        })->latest('tanggal')->get();

        return view('modules.Academic.komplain.create', compact('sesi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi_presensi_id' => 'required|exists:sesi_presensis,id',
            'alasan' => 'required|string|max:500',
            'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['mahasiswa_id'] = auth()->user()->mahasiswa->id;
        $data['status'] = 'PENDING';

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti_komplain', 'public');
        }

        KomplainPresensi::create($data);

        return redirect()->route('dashboard')->with('success', 'Komplain presensi berhasil dikirim.');
    }

    public function resolve(Request $request, KomplainPresensi $komplain)
    {
        $request->validate(['tanggapan' => 'required|string']);

        $komplain->update([
            'status' => 'RESOLVED',
            'tanggapan' => $request->tanggapan,
        ]);

        return back()->with('success', 'Komplain diselesaikan.');
    }

    public function reject(Request $request, KomplainPresensi $komplain)
    {
        $request->validate(['tanggapan' => 'required|string']);

        $komplain->update([
            'status' => 'REJECTED',
            'tanggapan' => $request->tanggapan,
        ]);

        return back()->with('success', 'Komplain ditolak.');
    }
}
