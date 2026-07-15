<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KomplainPresensiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PengajuanIzinController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiPresensiController;
use App\Models\Dosen;
use App\Models\Jadwal as JadwalModel;
use App\Models\Kelas;
use App\Models\KomplainPresensi;
use App\Models\Mahasiswa;
use App\Models\PengajuanIzin;
use App\Models\Pengumuman;
use App\Models\Presensi;
use App\Models\SesiPresensi as SesiPresensiModel;
use Illuminate\Support\Facades\Route;

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
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $kelasAktif = Kelas::where('status', true)->count();
        $totalKapasitas = Kelas::where('status', true)->sum('kapasitas');

        $sesiHariIni = SesiPresensiModel::whereDate('tanggal', today())->count();
        $sesiStatusCounts = SesiPresensiModel::whereDate('tanggal', today())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $recentActivity = SesiPresensiModel::with(['jadwal.mataKuliah', 'jadwal.kelas', 'jadwal.dosen', 'presensi'])
            ->orderByDesc('tanggal')
            ->limit(5)
            ->get();

        $pendingIzin = PengajuanIzin::where('status', 'PENDING')->count();
        $pendingKomplain = KomplainPresensi::where('status', 'PENDING')->count();

        return view('modules.Academic.dashboards.dashboard-admin', compact(
            'totalMahasiswa',
            'totalDosen',
            'kelasAktif',
            'totalKapasitas',
            'sesiHariIni',
            'sesiStatusCounts',
            'recentActivity',
            'pendingIzin',
            'pendingKomplain'
        ));
    })->middleware('role:admin')->name('admin.dashboard');

    // Dashboard Dosen
    Route::get('/dosen/dashboard', function () {
        $dosen = auth()->user()->dosen()->first();
        $dayNames = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $hariIni = $dayNames[now()->dayOfWeek];

        $jadwalHariIni = collect();
        $sesiAktif = collect();
        $sesiTerbaru = collect();
        $totalJadwal = 0;
        $totalSesi = 0;

        if ($dosen) {
            $jadwalHariIni = JadwalModel::with(['mataKuliah', 'kelas'])
                ->where('dosen_id', $dosen->id)
                ->where('status', true)
                ->where('hari', $hariIni)
                ->orderBy('jam_mulai')
                ->get();

            $totalJadwal = JadwalModel::where('dosen_id', $dosen->id)
                ->where('status', true)
                ->count();

            $sesiAktif = SesiPresensiModel::with(['jadwal.mataKuliah', 'jadwal.kelas'])
                ->where('status', 'OPEN')
                ->whereHas('jadwal', function ($query) use ($dosen) {
                    $query->where('dosen_id', $dosen->id);
                })
                ->orderByDesc('opened_at')
                ->limit(5)
                ->get();

            $sesiTerbaru = SesiPresensiModel::with(['jadwal.mataKuliah', 'jadwal.kelas'])
                ->whereHas('jadwal', function ($query) use ($dosen) {
                    $query->where('dosen_id', $dosen->id);
                })
                ->orderByDesc('tanggal')
                ->limit(5)
                ->get();

            $totalSesi = SesiPresensiModel::whereHas('jadwal', function ($query) use ($dosen) {
                $query->where('dosen_id', $dosen->id);
            })->count();
        }

        $izinTerbaru = PengajuanIzin::with('user')->where('status', 'PENDING')->latest()->take(3)->get();

        return view('modules.Academic.dashboards.dashboard-dosen', compact(
            'dosen',
            'hariIni',
            'jadwalHariIni',
            'sesiAktif',
            'sesiTerbaru',
            'totalJadwal',
            'totalSesi',
            'izinTerbaru'
        ));
    })->middleware('role:dosen')->name('dosen.dashboard');

    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', function () {
        $mahasiswa = auth()->user()->mahasiswa()->with('kelas')->first();

        $statusCounts = collect([
            'HADIR' => 0,
            'TERLAMBAT' => 0,
            'IZIN' => 0,
            'SAKIT' => 0,
            'ALPHA' => 0,
        ]);

        $recentPresensi = collect();
        $totalPresensi = 0;
        $attendancePercentage = 0;

        if ($mahasiswa) {
            $counts = Presensi::where('mahasiswa_id', $mahasiswa->id)
                ->selectRaw('status, COUNT(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status');

            $statusCounts = $statusCounts->map(
                fn (int $total, string $status): int => (int) ($counts[$status] ?? $total)
            );

            $totalPresensi = $statusCounts->sum();
            $attendedCount = $statusCounts['HADIR'] + $statusCounts['TERLAMBAT'];
            $attendancePercentage = $totalPresensi > 0
                ? round(($attendedCount / $totalPresensi) * 100)
                : 0;

            $recentPresensi = Presensi::with(['sesiPresensi.jadwal.mataKuliah', 'sesiPresensi.jadwal.kelas'])
                ->where('mahasiswa_id', $mahasiswa->id)
                ->orderByDesc('waktu_presensi')
                ->limit(5)
                ->get();
        }

        $pengumuman = Pengumuman::where('is_active', true)->latest()->take(3)->get();

        return view('modules.Academic.dashboards.dashboard-mahasiswa', compact(
            'mahasiswa',
            'statusCounts',
            'recentPresensi',
            'totalPresensi',
            'attendancePercentage',
            'pengumuman'
        ));
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
        Route::post('sesi_presensi/{sesi_presensi}/mark-alpha', [SesiPresensiController::class, 'markAlpha'])->name('sesi_presensi.mark-alpha');
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

    // Admin only: rekap presensi, pengumuman, kalender
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('presensi/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap');

        Route::resource('pengumuman', PengumumanController::class);
        Route::resource('kalender', KalenderAkademikController::class);
    });

    // Izin & Komplain (All roles have different views/actions inside controller, but we group them)
    Route::prefix('izin')->name('izin.')->group(function () {
        Route::get('/', [PengajuanIzinController::class, 'index'])->name('index');
        Route::get('/create', [PengajuanIzinController::class, 'create'])->name('create');
        Route::post('/', [PengajuanIzinController::class, 'store'])->name('store');
        Route::post('/{izin}/approve', [PengajuanIzinController::class, 'approve'])->name('approve');
        Route::post('/{izin}/reject', [PengajuanIzinController::class, 'reject'])->name('reject');
    });

    Route::prefix('komplain')->name('komplain.')->group(function () {
        Route::get('/', [KomplainPresensiController::class, 'index'])->name('index');
        Route::get('/create', [KomplainPresensiController::class, 'create'])->name('create');
        Route::post('/', [KomplainPresensiController::class, 'store'])->name('store');
        Route::post('/{komplain}/resolve', [KomplainPresensiController::class, 'resolve'])->name('resolve');
        Route::post('/{komplain}/reject', [KomplainPresensiController::class, 'reject'])->name('reject');
    });
});

require __DIR__.'/auth.php';
