<?php

namespace App\Http\Controllers;

use App\Models\PengajuanIzin;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PengajuanIzinController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'mahasiswa') {
            $izin = PengajuanIzin::where('user_id', $user->id)->latest()->get();
            return view('izin.mahasiswa_index', compact('izin'));
        } elseif ($user->role === 'dosen') {
            // Dosen melihat pengajuan izin mahasiswa untuk kelasnya
            $dosen = $user->dosen;
            $jadwalIds = Jadwal::where('dosen_id', $dosen->id)->pluck('id');
            $izin = PengajuanIzin::whereIn('jadwal_id', $jadwalIds)
                ->with('user.mahasiswa')
                ->latest()
                ->get();
            return view('izin.dosen_index', compact('izin'));
        }
        
        // Admin
        $izin = PengajuanIzin::with('user')->latest()->get();
        return view('izin.admin_index', compact('izin'));
    }

    public function create()
    {
        $user = auth()->user();
        $jadwal = collect();
        if ($user->role === 'mahasiswa') {
            $mahasiswa = $user->mahasiswa;
            $jadwal = Jadwal::with('mataKuliah')->where('kelas_id', $mahasiswa->kelas_id)->get();
        }
        return view('izin.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:SAKIT,IZIN',
            'keterangan' => 'required|string|max:500',
            'jadwal_id' => 'nullable|exists:jadwals,id',
            'file_bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['status'] = 'PENDING';

        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('bukti_izin', 'public');
        }

        PengajuanIzin::create($data);

        return redirect()->route('dashboard')->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    public function approve(PengajuanIzin $izin)
    {
        // Simple approve logic
        $izin->update([
            'status' => 'APPROVED',
            'approved_by' => auth()->id()
        ]);
        
        // TODO: Auto create presensi record if this is specific to a Jadwal/Sesi

        return back()->with('success', 'Izin disetujui.');
    }

    public function reject(PengajuanIzin $izin)
    {
        $izin->update([
            'status' => 'REJECTED',
            'approved_by' => auth()->id()
        ]);

        return back()->with('success', 'Izin ditolak.');
    }
}
