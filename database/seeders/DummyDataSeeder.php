<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\KomplainPresensi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\PengajuanIzin;
use App\Models\Presensi;
use App\Models\SesiPresensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Dosen::first();
        $mahasiswa = Mahasiswa::first();
        $kelas = Kelas::first();
        $mataKuliah = MataKuliah::first();
        $userMahasiswa = User::where('id', $mahasiswa->user_id ?? 0)->first() ?? User::first();

        if (! $dosen || ! $mahasiswa || ! $kelas || ! $mataKuliah) {
            return;
        }

        // Create Jadwal for Dosen
        $jadwal = Jadwal::create([
            'dosen_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'mata_kuliah_id' => $mataKuliah->id,
            'semester' => 'Ganjil',
            'tahun_ajaran' => '2026/2027',
            'hari' => 'Senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'ruangan' => 'Ruang 101',
            'status' => true,
        ]);

        // Create SesiPresensi for Jadwal
        $now = Carbon::now();
        $sesiPresensi1 = SesiPresensi::create([
            'jadwal_id' => $jadwal->id,
            'pertemuan_ke' => 1,
            'tanggal' => $now->copy()->subDays(7)->toDateString(),
            'token' => Str::random(10),
            'opened_at' => $now->copy()->subDays(7)->setTime(8, 0),
            'expired_at' => $now->copy()->subDays(7)->setTime(10, 0),
            'closed_at' => $now->copy()->subDays(7)->setTime(10, 0),
            'status' => 'CLOSED',
        ]);

        $sesiPresensi2 = SesiPresensi::create([
            'jadwal_id' => $jadwal->id,
            'pertemuan_ke' => 2,
            'tanggal' => $now->copy()->toDateString(),
            'token' => Str::random(10),
            'opened_at' => $now->copy()->setTime(8, 0),
            'expired_at' => $now->copy()->setTime(10, 0),
            'status' => 'OPEN',
        ]);

        // Create Presensi
        Presensi::create([
            'sesi_presensi_id' => $sesiPresensi1->id,
            'mahasiswa_id' => $mahasiswa->id,
            'status' => 'HADIR',
            'metode' => 'QR',
            'waktu_presensi' => $now->copy()->subDays(7)->setTime(8, 15),
        ]);

        Presensi::create([
            'sesi_presensi_id' => $sesiPresensi2->id,
            'mahasiswa_id' => $mahasiswa->id,
            'status' => 'ALPHA',
            'metode' => 'MANUAL',
            'waktu_presensi' => null,
            'catatan' => 'Belum hadir',
        ]);

        // Create PengajuanIzin for Mahasiswa
        if ($userMahasiswa) {
            PengajuanIzin::create([
                'user_id' => $userMahasiswa->id,
                'jadwal_id' => $jadwal->id,
                'tanggal' => $now->copy()->addDays(7)->toDateString(),
                'jenis' => 'SAKIT',
                'keterangan' => 'Sakit demam berdarah',
                'status' => 'PENDING',
            ]);
        }

        // Create KomplainPresensi
        KomplainPresensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'sesi_presensi_id' => $sesiPresensi2->id,
            'alasan' => 'Saya sebenarnya hadir tapi telat scan QR',
            'status' => 'PENDING',
        ]);
    }
}
