<?php

namespace Tests\Feature;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_dosen_can_access_dosen_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'dosen']);

        $response = $this->actingAs($user)->get('/dosen/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_kelas_create_page(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/kelas/create');

        $response->assertStatus(200);
    }

    public function test_mahasiswa_can_access_mahasiswa_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'mahasiswa']);

        $response = $this->actingAs($user)->get('/mahasiswa/dashboard');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'dosen']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_user_with_dosen_profile_can_access_dosen_routes_without_role_field(): void
    {
        $user = User::factory()->create();
        $user->dosen()->create([
            'nidn' => '0000000001',
            'nama' => 'Test Dosen',
            'jenis_kelamin' => 'L',
            'no_hp' => '08123456789',
            'alamat' => 'Test',
        ]);
        $user->role = null;

        $response = $this->actingAs($user)->get('/dosen/dashboard');

        $response->assertStatus(200);
    }

    public function test_dosen_can_access_sesi_presensi_index(): void
    {
        $user = User::factory()->create(['role' => 'dosen']);
        $user->dosen()->create([
            'nidn' => '0000000002',
            'nama' => 'Test Dosen',
            'jenis_kelamin' => 'L',
            'no_hp' => '08123456789',
            'alamat' => 'Test',
        ]);

        $response = $this->actingAs($user)->get('/dosen/sesi_presensi');

        $response->assertStatus(200);
    }

    public function test_dosen_can_create_sesi_presensi_and_return_to_index(): void
    {
        $user = User::factory()->create(['role' => 'dosen']);
        $dosen = $user->dosen()->create([
            'nidn' => '0000000003',
            'nama' => 'Test Dosen',
            'jenis_kelamin' => 'L',
            'no_hp' => '08123456789',
            'alamat' => 'Test',
        ]);

        $kelas = Kelas::create([
            'nama_kelas' => 'TI24A',
            'angkatan' => 2024,
            'kapasitas' => 40,
            'status' => true,
        ]);

        $mataKuliah = MataKuliah::create([
            'kode' => 'IF201',
            'nama' => 'Pemrograman Web',
            'sks' => 3,
            'status' => true,
        ]);

        $jadwal = Jadwal::create([
            'dosen_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'mata_kuliah_id' => $mataKuliah->id,
            'semester' => 'Ganjil',
            'tahun_ajaran' => '2026/2027',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:40',
            'ruangan' => 'A101',
            'status' => true,
        ]);

        $response = $this->actingAs($user)->post('/dosen/sesi_presensi', [
            'jadwal_id' => $jadwal->id,
            'pertemuan_ke' => 1,
            'tanggal' => '2026-07-01',
            'opened_at' => '2026-07-01 08:00:00',
            'expired_at' => '2026-07-01 09:40:00',
        ]);

        $response->assertRedirect(route('dosen.sesi_presensi.index'));
        $this->assertDatabaseHas('sesi_presensi', [
            'jadwal_id' => $jadwal->id,
            'pertemuan_ke' => 1,
            'status' => 'OPEN',
        ]);
        $this->actingAs($user)->get('/dosen/sesi_presensi')->assertStatus(200);
    }
}
