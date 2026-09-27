<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create([
            'name' => 'Standard',
            'description' => 'Kamar standard dengan fasilitas dasar.',
        ]);

        RoomType::create([
            'name' => 'Eksklusif',
            'description' => 'Kamar eksklusif dengan fasilitas yang lebih lengkap.',
        ]);
    }
}
