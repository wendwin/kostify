<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_role(): void
    {
        $role = Role::create([
            'name' => 'owner',
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $this->assertTrue(
            $user->role->is($role)
        );
    }

    public function test_role_has_many_users(): void
    {
        $role = Role::create([
            'name' => 'admin',
        ]);

        User::factory()->count(2)->create([
            'role_id' => $role->id,
        ]);

        $this->assertCount(2, $role->users);
    }
}
