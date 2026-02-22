<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Car;

class CarsSeeder extends Seeder
{
    public function run(): void
    {
         DB::table('cars')->insert([
            'brand_id' => 1,
            'model' => 'R8',
            'year' => 2016,
            'color' => 'black',
            'license_plate' => 'CDN-0324',
            'mileage' => 1024,
            'lat' => 5.09219,
            'lng' => 92.92398,
            'is_premium' => 1,
            'rental_count' => 7,
            'daily_rate' => 10,
            'status'=>'available',
            'created_at'=>date("Y-m-d h:m:s")
        ]);
        $dato = new Car();
        $dato->brand_id = 2;
        $dato->model = "AMG";
        $dato->year = 2022;
        $dato->color = "white";
        $dato->license_plate = 'HWS-6136';
        $dato->mileage = 1632;
        $dato->lat = 54.01452;
        $dato->lng = 32.12494;
        $dato->is_premium = 1;
        $dato->rental_count = 2;
        $dato->daily_rate = 8;
        $dato->status = 'available';
        $dato->save();
    }
}
