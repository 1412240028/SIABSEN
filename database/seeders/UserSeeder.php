<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // === ADMIN ===
        User::create([
            'name' => 'Administrator UNIROW',
            'email' => 'admin@unirow.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // === DOSEN ===
        $dosenData = [
            [
                'name' => 'Ahmad Fauzi, M.Kom',
                'email' => 'ahmad.fauzi@unirow.ac.id',
                'nidn' => '0712058701',
                'jenis_kelamin' => 'L',
                'no_hp' => '081234567801',
                'alamat' => 'Jl. Manunggal No. 12, Tuban',
            ],
            [
                'name' => 'Siti Rahmawati, M.Kom',
                'email' => 'siti.rahmawati@unirow.ac.id',
                'nidn' => '0725068802',
                'jenis_kelamin' => 'P',
                'no_hp' => '081234567802',
                'alamat' => 'Jl. Basuki Rahmat No. 5, Tuban',
            ],
        ];

        foreach ($dosenData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'user_id' => $user->id,
                'nidn' => $data['nidn'],
                'nama' => $data['name'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_hp' => $data['no_hp'],
                'alamat' => $data['alamat'],
            ]);
        }

        // === MAHASISWA ===
        $kelasA = Kelas::where('nama_kelas', 'TI24A')->first();
        $kelasB = Kelas::where('nama_kelas', 'TI24B')->first();

        $mahasiswaKelasA = [
            ['nama' => 'Budi Santoso', 'jk' => 'L'],
            ['nama' => 'Dewi Lestari', 'jk' => 'P'],
            ['nama' => 'Rizky Pratama', 'jk' => 'L'],
            ['nama' => 'Putri Wulandari', 'jk' => 'P'],
            ['nama' => 'Fajar Setiawan', 'jk' => 'L'],
        ];

        $mahasiswaKelasB = [
            ['nama' => 'Andi Saputra', 'jk' => 'L'],
            ['nama' => 'Nur Aini', 'jk' => 'P'],
            ['nama' => 'Bagas Wijaya', 'jk' => 'L'],
            ['nama' => 'Sri Handayani', 'jk' => 'P'],
            ['nama' => 'Ayu Kusuma', 'jk' => 'P'],
        ];

        $nim = 1;

        foreach ([$kelasA->id => $mahasiswaKelasA, $kelasB->id => $mahasiswaKelasB] as $kelasId => $list) {
            foreach ($list as $mhs) {
                $emailSlug = strtolower(str_replace(' ', '.', $mhs['nama']));
                $nimGenerated = '2024'.str_pad($nim, 4, '0', STR_PAD_LEFT);

                $user = User::create([
                    'name' => $mhs['nama'],
                    'email' => $emailSlug.'@student.unirow.ac.id',
                    'password' => Hash::make('password'),
                    'role' => 'mahasiswa',
                ]);

                Mahasiswa::create([
                    'user_id' => $user->id,
                    'kelas_id' => $kelasId,
                    'nim' => $nimGenerated,
                    'nama' => $mhs['nama'],
                    'jenis_kelamin' => $mhs['jk'],
                    'tanggal_lahir' => '2006-0'.rand(1, 9).'-1'.rand(0, 9),
                    'no_hp' => '0812'.rand(10000000, 99999999),
                    'alamat' => 'Tuban, Jawa Timur',
                    'angkatan' => 2024,
                ]);

                $nim++;
            }
        }
    }
}
