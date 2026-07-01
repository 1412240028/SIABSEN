<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Redirector — arahkan user ke dashboard sesuai role setelah login
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'dosen'      => redirect()->route('dosen.dashboard'),
            'mahasiswa'  => redirect()->route('mahasiswa.dashboard'),
        };
    })->name('dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('dashboard-admin');
    })->middleware('role:admin')->name('admin.dashboard');

    // Dashboard Dosen
    Route::get('/dosen/dashboard', function () {
        return view('dashboard-dosen');
    })->middleware('role:dosen')->name('dosen.dashboard');

    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', function () {
        return view('dashboard-mahasiswa');
    })->middleware('role:mahasiswa')->name('mahasiswa.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
