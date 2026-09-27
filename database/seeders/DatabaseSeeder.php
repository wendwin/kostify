<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\RoomTypeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
        ]);

        $owner = Role::where('name', 'owner')->first();

        $owner = Role::where('name', 'owner')->first();
        $admin = Role::where('name', 'admin')->first();
        $penghuni = Role::where('name', 'penghuni')->first();

        User::factory()->create([
            'name' => 'Owner Kostify',
            'email' => 'owner@kostify.test',
            'role_id' => $owner->id,
        ]);

        User::factory()->create([
            'name' => 'Admin Kostify',
            'email' => 'admin@kostify.test',
            'role_id' => $admin->id,
        ]);

        User::factory()->create([
            'name' => 'Penghuni Test',
            'email' => 'penghuni@kostify.test',
            'role_id' => $penghuni->id,
        ]);
    }
}
