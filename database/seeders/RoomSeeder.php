<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::insert([
            ['room_no' => 'Room 1'],
            ['room_no' => 'Room 2'],
            ['room_no' => 'Room 3'],
            ['room_no' => 'Room 4'],
            ['room_no' => 'Room 5'],
            ['room_no' => 'Room 6'],
            ['room_no' => 'Room 7'],
        ]);
    }
}
