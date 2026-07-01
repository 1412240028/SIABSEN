<?php

namespace Tests\Feature;

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
}
