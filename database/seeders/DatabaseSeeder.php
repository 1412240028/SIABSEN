<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KelasSeeder::class,
            MataKuliahSeeder::class,
            UserSeeder::class,
            KalenderAkademikSeeder::class,
            PengumumanSeeder::class,
            DummyDataSeeder::class,
        ]);
    }
}
