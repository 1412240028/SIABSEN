<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::orderBy('kode')->paginate(10);
        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        return view('mata_kuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'   => 'required|string|max:20|unique:mata_kuliah,kode',
            'nama'   => 'required|string|max:100',
            'sks'    => 'required|integer|min:1|max:6',
            'status' => 'required|boolean',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mata_kuliah)
    {
        return view('mata_kuliah.show', ['mataKuliah' => $mata_kuliah]);
    }

    public function edit(MataKuliah $mata_kuliah)
    {
        return view('mata_kuliah.edit', ['mataKuliah' => $mata_kuliah]);
    }

    public function update(Request $request, MataKuliah $mata_kuliah)
    {
        $validated = $request->validate([
            'kode'   => 'required|string|max:20|unique:mata_kuliah,kode,' . $mata_kuliah->id,
            'nama'   => 'required|string|max:100',
            'sks'    => 'required|integer|min:1|max:6',
            'status' => 'required|boolean',
        ]);

        $mata_kuliah->update($validated);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mata_kuliah)
    {
        $mata_kuliah->delete();

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}