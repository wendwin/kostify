<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_tenant_page(): void
    {
        $role = Role::create([
            'name' => 'admin',
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/tenants');

        $response->assertStatus(200);
    }

    public function test_tenant_is_displayed(): void
    {
        $role = Role::create([
            'name' => 'admin',
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $tenantUser = User::factory()->create([
            'role_id' => $role->id,
            'name' => 'Budi Santoso',
        ]);

        $tenant = Tenant::create([
            'user_id' => $tenantUser->id,
            'nik' => '3201234567890001',
            'phone' => '081234567890',
            'gender' => 'Laki-laki',
            'birth_place' => 'Bandung',
            'birth_date' => '2000-01-01',
            'address' => 'Bandung',
            'occupation' => 'Karyawan',
            'emergency_contact_name' => 'Andi',
            'emergency_contact_phone' => '089876543210',
        ]);

        $response = $this->actingAs($user)
            ->get('/tenants');

        $response->assertStatus(200);

        $response->assertSee('Budi Santoso');
        $response->assertSee($tenant->nik);
    }

    public function test_admin_can_create_tenant(): void
    {
        $roleAdmin = Role::create([
            'name' => 'admin',
        ]);

        $rolePenghuni = Role::create([
            'name' => 'penghuni',
        ]);

        $admin = User::factory()->create([
            'role_id' => $roleAdmin->id,
        ]);

        $response = $this->actingAs($admin)
            ->post('/tenants', [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'nik' => '3201234567890001',
                'phone' => '081234567890',
                'gender' => 'Laki-laki',
                'birth_place' => 'Bandung',
                'birth_date' => '2000-01-01',
                'address' => 'Bandung',
                'occupation' => 'Karyawan',
                'emergency_contact_name' => 'Andi Santoso',
                'emergency_contact_phone' => '089876543210',
                'identity_document' => null,
            ]);

        $response->assertRedirect('/tenants');

        $this->assertDatabaseHas('users', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'role_id' => $rolePenghuni->id,
        ]);

        $this->assertDatabaseHas('tenants', [
            'nik' => '3201234567890001',
            'phone' => '081234567890',
        ]);
    }

    public function test_tenant_creation_requires_required_fields(): void
    {
        $role = Role::create([
            'name' => 'admin',
        ]);

        $admin = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $response = $this->actingAs($admin)
            ->post('/tenants', []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'nik',
            'phone',
            'gender',
            'birth_place',
            'birth_date',
            'address',
            'occupation',
            'emergency_contact_name',
            'emergency_contact_phone',
        ]);
    }
}
