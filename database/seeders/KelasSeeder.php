<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'TI24A',
            'angkatan' => 2024,
            'kapasitas' => 40,
            'status' => true,
        ]);

        Kelas::create([
            'nama_kelas' => 'TI24B',
            'angkatan' => 2024,
            'kapasitas' => 40,
            'status' => true,
        ]);
    }
}
