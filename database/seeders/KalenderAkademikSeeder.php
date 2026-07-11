<?php

namespace Database\Seeders;

use App\Models\KalenderAkademik;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KalenderAkademikSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'kegiatan' => 'Ujian Tengah Semester (UTS)',
                'tanggal_mulai' => $now->copy()->addDays(14)->toDateString(),
                'tanggal_selesai' => $now->copy()->addDays(21)->toDateString(),
                'jenis' => 'Ujian',
            ],
            [
                'kegiatan' => 'Ujian Akhir Semester (UAS)',
                'tanggal_mulai' => $now->copy()->addMonths(2)->toDateString(),
                'tanggal_selesai' => $now->copy()->addMonths(2)->addDays(7)->toDateString(),
                'jenis' => 'Ujian',
            ],
            [
                'kegiatan' => 'Libur Nasional Idul Fitri',
                'tanggal_mulai' => $now->copy()->addMonths(1)->toDateString(),
                'tanggal_selesai' => $now->copy()->addMonths(1)->addDays(3)->toDateString(),
                'jenis' => 'Libur',
            ],
            [
                'kegiatan' => 'Awal Perkuliahan',
                'tanggal_mulai' => $now->copy()->subDays(30)->toDateString(),
                'tanggal_selesai' => $now->copy()->subDays(30)->toDateString(),
                'jenis' => 'Perkuliahan',
            ],
        ];

        foreach ($data as $item) {
            KalenderAkademik::create($item);
        }
    }
}
