<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengumuman;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Pengumuman Penting: Registrasi Ulang',
                'konten' => 'Diharapkan kepada seluruh mahasiswa untuk segera melakukan registrasi ulang semester ini.',
                'kategori' => 'Penting',
                'is_active' => true,
            ],
            [
                'judul' => 'Jadwal Kuliah Semester Baru',
                'konten' => 'Jadwal kuliah untuk semester baru telah dirilis, silakan cek dashboard masing-masing.',
                'kategori' => 'Akademik',
                'is_active' => true,
            ],
            [
                'judul' => 'Fasilitas Kampus Diperbarui',
                'konten' => 'Beberapa fasilitas kampus di gedung utama telah selesai direnovasi.',
                'kategori' => 'Umum',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            Pengumuman::create($item);
        }
    }
}
