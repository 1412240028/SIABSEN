<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwal = Jadwal::with(['dosen', 'kelas', 'mataKuliah'])
            ->when($request->search, function ($query, $search) {
                $query->whereHas('mataKuliah', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                })->orWhereHas('dosen', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                })->orWhereHas('kelas', function ($query) use ($search) {
                    $query->where('nama_kelas', 'like', "%{$search}%");
                });
            })
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->paginate(10)
            ->withQueryString();

        return view('modules.Academic.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dosens = Dosen::orderBy('nama')->get();
        $kelas = Kelas::where('status', true)->orderBy('nama_kelas')->get();
        $mataKuliah = MataKuliah::where('status', true)->orderBy('kode')->get();

        return view('modules.Academic.jadwal.create', compact('dosens', 'kelas', 'mataKuliah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string|max:20',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'nullable|string|max:50',
            'status' => 'required|boolean',
        ]);

        Jadwal::create($validated);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['dosen', 'kelas', 'mataKuliah']);

        return view('modules.Academic.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $dosens = Dosen::orderBy('nama')->get();
        $kelas = Kelas::where('status', true)->orderBy('nama_kelas')->get();
        $mataKuliah = MataKuliah::where('status', true)->orderBy('kode')->get();

        return view('modules.Academic.jadwal.edit', compact('jadwal', 'dosens', 'kelas', 'mataKuliah'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string|max:20',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'nullable|string|max:50',
            'status' => 'required|boolean',
        ]);

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
