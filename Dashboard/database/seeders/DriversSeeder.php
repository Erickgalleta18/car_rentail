<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;

class DriversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drivers')->insert([
            'user_id' => 1,
            'licence_number' => 896642,
            'licence_img' => 'user1id.png',
            'created_at'=>date("Y-m-d h:m:s")
        ]);
    }
}
