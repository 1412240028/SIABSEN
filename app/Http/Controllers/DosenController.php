<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Dosen::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nidn', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'nidn' => 'required|string|max:20|unique:dosen,nidn',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'user_id' => $user->id,
                'nidn' => $validated['nidn'],
                'nama' => $validated['name'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
            ]);
        });

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen)
    {
        $dosen->load('user');
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        $dosen->load('user');
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $dosen->user_id,
            'password' => 'nullable|string|min:8',
            'nidn' => 'required|string|max:20|unique:dosen,nidn,' . $dosen->id,
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $dosen) {
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $dosen->user->update($userData);

            $dosen->update([
                'nidn' => $validated['nidn'],
                'nama' => $validated['name'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
            ]);
        });

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        // Cuma soft-delete data Dosen. Akun User (login) sengaja TIDAK dihapus,
        // supaya histori jadwal/presensi yang masih mereferensikan dosen ini tetap utuh.
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}