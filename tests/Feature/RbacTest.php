<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\AuditLog;
use Database\Seeders\RbacSeeder;

class RbacTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RbacSeeder::class);
    }

    public function test_guest_cannot_access_rbac_page(): void
    {
        $response = $this->get('/admin/rbac');
        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_rbac_page(): void
    {
        $user = User::factory()->create([
            'peran' => 'Mahasiswa',
            'verified' => 1,
        ]);
        $user->syncRoles(['Mahasiswa']);

        $response = $this->actingAs($user)->get('/admin/rbac');
        // CheckUserRole middleware redirects non-admin to home
        $response->assertRedirect(route('home'));
    }

    public function test_admin_can_access_rbac_page(): void
    {
        $admin = User::factory()->create([
            'peran' => 'Administrator',
            'verified' => 1,
            'two_factor_enabled' => false,
        ]);
        $admin->syncRoles(['Administrator']);

        $response = $this->actingAs($admin)->get('/admin/rbac');
        $response->assertStatus(200);
        $response->assertSee('Manajemen RBAC & Hak Akses');
    }

    public function test_admin_can_sync_all_roles(): void
    {
        $admin = User::factory()->create([
            'peran' => 'Administrator',
            'verified' => 1,
            'two_factor_enabled' => false,
        ]);
        $admin->syncRoles(['Administrator']);

        $mhs = User::factory()->create([
            'peran' => 'Mahasiswa',
            'verified' => 1,
        ]);

        $response = $this->actingAs($admin)->post('/admin/rbac/sync');
        $response->assertRedirect('/admin/rbac');
        $response->assertSessionHas('success');

        // Check if user has role
        $this->assertTrue($mhs->fresh()->hasRole('Mahasiswa'));
        // Check if audit log was recorded
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'RBAC_SYNC',
        ]);
    }

    public function test_admin_can_assign_new_role_to_user(): void
    {
        $admin = User::factory()->create([
            'peran' => 'Administrator',
            'verified' => 1,
            'two_factor_enabled' => false,
        ]);
        $admin->syncRoles(['Administrator']);

        $user = User::factory()->create([
            'peran' => 'Mahasiswa',
            'verified' => 1,
        ]);

        $response = $this->actingAs($admin)->post('/admin/rbac/assign-role', [
            'user_id' => $user->id,
            'role' => 'Checker',
        ]);

        $response->assertRedirect('/admin/rbac');
        $response->assertSessionHas('success');

        $this->assertEquals('Checker', $user->fresh()->peran);
        $this->assertTrue($user->fresh()->hasRole('Checker'));

        // Check audit log
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'RBAC_ASSIGN',
        ]);
    }
}
