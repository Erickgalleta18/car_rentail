<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            'name' => 'Audi',
            'img' => 'audi.png',
            'created_at'=>date("Y-m-d h:m:s")
        ]);
        $dato = new Brand();
        $dato->name = "Mercedes";
        $dato->img = "mercedes.png";
        $dato->save();
    }
}
