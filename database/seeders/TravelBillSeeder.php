<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TravelBill;

class TravelBillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TravelBill::insert([
            [
            "id" => 2,
            "travelgroup_id" => 1,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 3,
            "total" => 905,
            "created_at" => "2025-09-29T10:38:19.000000Z",
            "updated_at" => "2025-09-29T10:38:19.000000Z",
            ],
            [
            "id" => 4,
            "travelgroup_id" => 2,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 4,
            "total" => 1210,
            "created_at" => "2025-09-29T10:51:21.000000Z",
            "updated_at" => "2025-09-29T10:51:21.000000Z",
            ],
            [
            "id" => 5,
            "travelgroup_id" => 3,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 3,
            "total" => 695,
            "created_at" => "2025-09-30T01:39:41.000000Z",
            "updated_at" => "2025-09-30T01:41:23.000000Z",
            ],
            [
            "id" => 6,
            "travelgroup_id" => 4,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 4,
            "total" => 970,
            "created_at" => "2025-09-30T02:27:37.000000Z",
            "updated_at" => "2025-09-30T02:27:37.000000Z",
            ],
            [
            "id" => 7,
            "travelgroup_id" => 5,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 4,
            "total" => 710,
            "created_at" => "2025-09-30T02:30:17.000000Z",
            "updated_at" => "2025-09-30T02:30:17.000000Z",
            ],
            [
            "id" => 8,
            "travelgroup_id" => 6,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 4,
            "total" => 930,
            "created_at" => "2025-09-30T02:38:52.000000Z",
            "updated_at" => "2025-09-30T02:38:52.000000Z",
            ],
            [
            "id" => 9,
            "travelgroup_id" => 7,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 4,
            "total" => 1130,
            "created_at" => "2025-09-30T02:39:50.000000Z",
            "updated_at" => "2025-09-30T02:39:50.000000Z",
            ],
            [
            "id" => 10,
            "travelgroup_id" => 8,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 3,
            "total" => 950,
            "created_at" => "2025-09-30T02:40:32.000000Z",
            "updated_at" => "2025-09-30T02:40:32.000000Z",
            ],
            [
            "id" => 11,
            "travelgroup_id" => 9,
            "fee_in_out" => 350,
            "fee_snack" => 5,
            "quota_add" => 2,
            "trip" => 4,
            "total" => 970,
            "created_at" => "2025-09-30T02:41:39.000000Z",
            "updated_at" => "2025-09-30T02:41:39.000000Z",
            ],
        ]);
    }
}
