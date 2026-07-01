<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::with('kelas')
            ->when($request->search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            })
            ->orderBy('nim')
            ->paginate(10)
            ->withQueryString();

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $kelas = Kelas::where('status', true)->orderBy('nama_kelas')->get();
        return view('mahasiswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'kelas_id' => 'required|exists:kelas,id',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'angkatan' => 'required|digits:4|integer|min:2000|max:2100',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'kelas_id' => $validated['kelas_id'],
                'nim' => $validated['nim'],
                'nama' => $validated['name'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'angkatan' => $validated['angkatan'],
            ]);
        });

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load(['user', 'kelas']);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user');
        $kelas = Kelas::where('status', true)->orderBy('nama_kelas')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $mahasiswa->user_id,
            'password' => 'nullable|string|min:8',
            'kelas_id' => 'required|exists:kelas,id',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'angkatan' => 'required|digits:4|integer|min:2000|max:2100',
        ]);

        DB::transaction(function () use ($validated, $mahasiswa) {
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $mahasiswa->user->update($userData);

            $mahasiswa->update([
                'kelas_id' => $validated['kelas_id'],
                'nim' => $validated['nim'],
                'nama' => $validated['name'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'angkatan' => $validated['angkatan'],
            ]);
        });

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}