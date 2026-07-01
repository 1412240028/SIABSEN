<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SesiPresensiController;
use App\Http\Controllers\PresensiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Redirector — arahkan user ke dashboard sesuai role setelah login
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'dosen' => redirect()->route('dosen.dashboard'),
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
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

    // Admin only: create, edit, delete
    Route::middleware('role:admin')->group(function () {
        Route::resource('kelas', KelasController::class)
            ->parameters(['kelas' => 'kelas'])
            ->except(['index', 'show']);
        Route::resource('mata_kuliah', MataKuliahController::class)->except(['index', 'show']);
        Route::resource('dosen', DosenController::class)->except(['index', 'show']);
        Route::resource('mahasiswa', MahasiswaController::class)->except(['index', 'show']);
    });

    // Dosen only: sesi presensi
    Route::middleware('role:dosen')->prefix('dosen')->name('dosen.')->group(function () {
        Route::resource('sesi_presensi', SesiPresensiController::class)->only(['index', 'create', 'store', 'show']);
        Route::patch('sesi_presensi/{sesi_presensi}/close', [SesiPresensiController::class, 'close'])->name('sesi_presensi.close');
        Route::post('sesi_presensi/{sesi_presensi}/presensi', [PresensiController::class, 'store'])->name('sesi_presensi.presensi.store');
    });

    // Admin + Dosen: boleh lihat aja
    Route::middleware('role:admin,dosen')->group(function () {
        Route::resource('kelas', KelasController::class)
            ->parameters(['kelas' => 'kelas'])
            ->only(['index', 'show']);
        Route::resource('mata_kuliah', MataKuliahController::class)->only(['index', 'show']);
        Route::resource('dosen', DosenController::class)->only(['index', 'show']);
        Route::resource('mahasiswa', MahasiswaController::class)->only(['index', 'show']);
    });

    // Admin only: jadwal manajemen
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('jadwal', JadwalController::class);
    });

    // Mahasiswa only: presensi history and scan
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('presensi/history', [PresensiController::class, 'history'])->name('presensi.history');
        Route::get('presensi/scan', [PresensiController::class, 'showScanForm'])->name('presensi.scan.form');
        Route::post('presensi/scan', [PresensiController::class, 'scan'])->name('presensi.scan');
    });

    // Admin only: rekap presensi
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('presensi/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap');
    });
});

require __DIR__ . '/auth.php';
