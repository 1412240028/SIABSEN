<?php

namespace App\Console\Commands;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestAccountsCommand extends Command
{
    protected $signature = 'app:create-test-accounts';
    protected $description = 'Create admin, dosen, and mahasiswa test accounts';

    public function handle(): int
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin.test@siabsen.test'],
            ['name' => 'Admin Test', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $dosenUser = User::firstOrCreate(
            ['email' => 'dosen.test@siabsen.test'],
            ['name' => 'Dosen Test', 'password' => Hash::make('password'), 'role' => 'dosen']
        );

        if (! Dosen::where('user_id', $dosenUser->id)->exists()) {
            Dosen::create([
                'user_id' => $dosenUser->id,
                'nidn' => '9999999999',
                'nama' => $dosenUser->name,
                'jenis_kelamin' => 'L',
                'no_hp' => '0811111111',
                'alamat' => 'Test',
            ]);
        }

        $mahasiswaUser = User::firstOrCreate(
            ['email' => 'mahasiswa.test@siabsen.test'],
            ['name' => 'Mahasiswa Test', 'password' => Hash::make('password'), 'role' => 'mahasiswa']
        );

        $kelas = Kelas::query()->where('status', true)->orderBy('nama_kelas')->first();

        if ($kelas && ! Mahasiswa::where('user_id', $mahasiswaUser->id)->exists()) {
            Mahasiswa::create([
                'user_id' => $mahasiswaUser->id,
                'kelas_id' => $kelas->id,
                'nim' => 'TEST0001',
                'nama' => $mahasiswaUser->name,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => null,
                'no_hp' => null,
                'alamat' => null,
                'angkatan' => date('Y'),
            ]);
        }

        $this->info('Created/verified test accounts:');
        $this->line('admin.test@siabsen.test / password');
        $this->line('dosen.test@siabsen.test / password');
        $this->line('mahasiswa.test@siabsen.test / password');

        return self::SUCCESS;
    }
}
