<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();

        return view('modules.Academic.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('modules.Academic.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:Penting,Akademik,Umum',
            'is_active' => 'boolean',
        ]);

        Pengumuman::create($request->all());

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('modules.Academic.pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('modules.Academic.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:Penting,Akademik,Umum',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diubah.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
