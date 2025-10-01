<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TravelGroup;

class TravelGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TravelGroup::insert([
            [
            "id" => 1,
            "travel_id" => 1,
            "name" => "UMROH INDIGO",
            "quota" => 35,
            "start_date" => "2025-09-01",
            "end_date" => "2025-09-08",
            "created_at" => "2025-09-29T09:13:45.000000Z",
            "updated_at" => "2025-09-29T09:13:45.000000Z",
            ],
            [
            "id" => 2,
            "travel_id" => 1,
            "name" => "UMROH SUB LION",
            "quota" => 41,
            "start_date" => "2025-09-03",
            "end_date" => "2025-09-08",
            "created_at" => "2025-09-29T10:47:56.000000Z",
            "updated_at" => "2025-09-29T10:47:56.000000Z",
            ],
            [
            "id" => 3,
            "travel_id" => 1,
            "name" => "UMROH INDIGO 2",
            "quota" => 21,
            "start_date" => "2025-09-09",
            "end_date" => "2025-09-15",
            "created_at" => "2025-09-29T11:15:49.000000Z",
            "updated_at" => "2025-09-29T11:15:49.000000Z",
            ],
            [
            "id" => 4,
            "travel_id" => 2,
            "name" => "UMROH INDIGO 3",
            "quota" => 29,
            "start_date" => "2025-09-16",
            "end_date" => "2025-09-22",
            "created_at" => "2025-09-29T13:08:18.000000Z",
            "updated_at" => "2025-09-30T01:55:55.000000Z",
            ],
            [
            "id" => 5,
            "travel_id" => 1,
            "name" => "CAIRO+UMROH ISTIFADAH",
            "quota" => 16,
            "start_date" => "2025-09-16",
            "end_date" => "2025-09-22",
            "created_at" => "2025-09-30T02:29:29.000000Z",
            "updated_at" => "2025-09-30T02:29:29.000000Z",
            ],
            [
            "id" => 6,
            "travel_id" => 1,
            "name" => "UMROH PROMO",
            "quota" => 27,
            "start_date" => "2025-09-18",
            "end_date" => "2025-09-22",
            "created_at" => "2025-09-30T02:38:26.000000Z",
            "updated_at" => "2025-09-30T02:38:26.000000Z",
            ],
            [
            "id" => 7,
            "travel_id" => 1,
            "name" => "UMROH QATAR",
            "quota" => 37,
            "start_date" => "2025-09-19",
            "end_date" => "2025-09-22",
            "created_at" => "2025-09-30T02:39:29.000000Z",
            "updated_at" => "2025-09-30T02:39:29.000000Z",
            ],
            [
            "id" => 8,
            "travel_id" => 1,
            "name" => "DUBAI+UMROH",
            "quota" => 38,
            "start_date" => "2025-09-27",
            "end_date" => "2025-09-30",
            "created_at" => "2025-09-30T02:40:17.000000Z",
            "updated_at" => "2025-09-30T02:40:17.000000Z",
            ],
            [
            "id" => 9,
            "travel_id" => 1,
            "name" => "UMROH INDIGO 1",
            "quota" => 29,
            "start_date" => "2025-09-13",
            "end_date" => "2025-09-17",
            "created_at" => "2025-09-30T02:41:22.000000Z",
            "updated_at" => "2025-09-30T02:41:22.000000Z",
            ],
        ]);
    }
}
