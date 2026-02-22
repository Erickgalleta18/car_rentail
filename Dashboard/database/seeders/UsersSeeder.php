<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Orlando Gallardo',
            'email' => 'ogallardo@gmail.com',
            'password'=>Hash::make('orlando'),
            'loyalty_points' => 1200,
            'loyalty_level_id' => 1,
            'created_at'=>date("Y-m-d h:m:s")
        ]);
        $dato = new User();
        $dato->name="2";
        $dato->save();
    }
}
