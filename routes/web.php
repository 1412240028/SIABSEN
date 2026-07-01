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

    // ============ MASTER DATA ============
    use App\Http\Controllers\KelasController;
    use App\Http\Controllers\MataKuliahController;
    use App\Http\Controllers\DosenController;
    use App\Http\Controllers\MahasiswaController;

    // Admin + Dosen: boleh lihat aja
    Route::middleware('role:admin,dosen')->group(function () {
        Route::resource('kelas', KelasController::class)->only(['index', 'show']);
        Route::resource('mata_kuliah', MataKuliahController::class)->only(['index', 'show']);
        Route::resource('dosen', DosenController::class)->only(['index', 'show']);
        Route::resource('mahasiswa', MahasiswaController::class)->only(['index', 'show']);
    });

    // Admin only: create, edit, delete
    Route::middleware('role:admin')->group(function () {
        Route::resource('kelas', KelasController::class)->except(['index', 'show']);
        Route::resource('mata_kuliah', MataKuliahController::class)->except(['index', 'show']);
        Route::resource('dosen', DosenController::class)->except(['index', 'show']);
        Route::resource('mahasiswa', MahasiswaController::class)->except(['index', 'show']);
    });
});

require __DIR__.'/auth.php';
