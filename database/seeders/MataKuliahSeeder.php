<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mataKuliah = [
            ['kode' => 'IF201', 'nama' => 'Pemrograman Web', 'sks' => 3],
            ['kode' => 'IF202', 'nama' => 'Basis Data', 'sks' => 3],
            ['kode' => 'IF203', 'nama' => 'Struktur Data', 'sks' => 3],
        ];

        foreach ($mataKuliah as $mk) {
            MataKuliah::create([
                'kode' => $mk['kode'],
                'nama' => $mk['nama'],
                'sks' => $mk['sks'],
                'status' => true,
            ]);
        }
    }
}
