<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Loyalty_level;

class Loyalty_levelsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('loyalty_levels')->insert([
            'name' => 'Gold',
            'min_points' => 1000,
            'discount_percentage' => 20,
            'free_extra_hours' => 24,
            'created_at'=>date("Y-m-d h:m:s")
        ]);
    }
}
