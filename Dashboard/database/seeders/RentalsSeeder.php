<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rental;

class RentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rentals')->insert([
            'user_id' => 1,
            'car_id' => 1,
            'driver_id' => 1,
            'pickup_date' => date("Y-m-d h:m:s"),
            'return_date' => date("Y-m-d h:m:s"),
            'total_amount' => 18000,
            'status' => 'confirmed',
            'created_at'=>date("Y-m-d h:m:s")
        ]);
        $dato = new Rental();
        $dato->user_id = 2;
        $dato->car_id = 2;
        $dato->driver_id = 2;
        $dato->pickup_date = date("Y-m-d h:m:s");
        $dato->return_date = date("Y-m-d h:m:s");
        $dato->total_amount = 19000;
        $dato->status = "pending";
        $dato->save();
    }
}
