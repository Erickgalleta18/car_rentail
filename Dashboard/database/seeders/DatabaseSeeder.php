<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
       $this->call(Loyalty_levelsSeeder::class);
       $this->call(UsersSeeder::class);
       $this->call(BrandsSeeder::class);
       $this->call(CarsSeeder::class);
       $this->call(DriversSeeder::class);
       $this->call(RentalsSeeder::class);
       $this->call(PaymentsSeeder::class);
    }
}
