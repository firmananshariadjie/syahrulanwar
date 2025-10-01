<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Travel;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Travel::create([
            "id" => 1,
            "travel_name" => "Travel Ajudan",
            "description" => "Travel dari Lombok",
            "status" => "open",
            "created_at" => "2025-09-29T09:13:02.000000Z",
            "updated_at" => "2025-09-29T09:13:02.000000Z",
        ]);

        Travel::create([
            "id" => 2,
            "travel_name" => "Travel Ababil",
            "description" => "Travel dari Bandung",
            "status" => "open",
            "created_at" => "2025-09-29T13:07:49.000000Z",
            "updated_at" => "2025-09-29T13:07:49.000000Z",
        ]);
    }
}
