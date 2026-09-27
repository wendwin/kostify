<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $standard = RoomType::where('name', 'Standard')->firstOrFail();
        $exclusive = RoomType::where('name', 'Eksklusif')->firstOrFail();

        $rooms = [];

        // Gedung Standard
        for ($i = 1; $i <= 5; $i++) {
            $rooms[] = [
                'room_type_id' => $standard->id,
                'room_number' => 'S' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'price' => 800000,
                'status' => 'available',
                'description' => 'Kamar standard lantai 1',
            ];
        }

        for ($i = 6; $i <= 10; $i++) {
            $rooms[] = [
                'room_type_id' => $standard->id,
                'room_number' => 'S' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'price' => 850000,
                'status' => 'available',
                'description' => 'Kamar standard lantai 2',
            ];
        }

        // Gedung Eksklusif
        for ($i = 1; $i <= 5; $i++) {
            $rooms[] = [
                'room_type_id' => $exclusive->id,
                'room_number' => 'E' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'price' => 1200000,
                'status' => 'available',
                'description' => 'Kamar eksklusif lantai 1',
            ];
        }

        for ($i = 6; $i <= 10; $i++) {
            $rooms[] = [
                'room_type_id' => $exclusive->id,
                'room_number' => 'E' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'price' => 1300000,
                'status' => 'available',
                'description' => 'Kamar eksklusif lantai 2',
            ];
        }

        Room::insert($rooms);
    }
}
