<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        $kalender = KalenderAkademik::orderBy('tanggal_mulai')->get();

        return view('modules.Academic.kalender.index', compact('kalender'));
    }

    public function create()
    {
        return view('modules.Academic.kalender.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis' => 'required|in:Libur,Ujian,Perkuliahan,Lainnya',
        ]);

        KalenderAkademik::create($request->all());

        return redirect()->route('admin.kalender.index')->with('success', 'Kalender Akademik berhasil ditambahkan.');
    }

    public function edit(KalenderAkademik $kalender)
    {
        return view('modules.Academic.kalender.edit', compact('kalender'));
    }

    public function update(Request $request, KalenderAkademik $kalender)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis' => 'required|in:Libur,Ujian,Perkuliahan,Lainnya',
        ]);

        $kalender->update($request->all());

        return redirect()->route('admin.kalender.index')->with('success', 'Kalender Akademik berhasil diubah.');
    }

    public function destroy(KalenderAkademik $kalender)
    {
        $kalender->delete();

        return redirect()->route('admin.kalender.index')->with('success', 'Kalender Akademik berhasil dihapus.');
    }
}
