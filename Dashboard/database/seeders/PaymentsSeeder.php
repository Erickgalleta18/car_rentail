<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;

class PaymentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            'rental_id' => 1,
            'amount' => 18000,
            'payment_method' => 'credit card',
            'transaction_id' => 'CD9426209642',
            'status' => 'completed',
            'payment_date' =>date("Y-m-d h:m:s"),
            'created_at'=>date("Y-m-d h:m:s")
        ]);
        $dato = new Payment();
        $dato->rental_id = 2;
        $dato->amount = 19000;
        $dato->payment_method = 'debit card';
        $dato->transaction_id = 'DC4961469658';
        $dato->status = 'pending';
        $dato->payment_date = date("Y-m-d h:m:s");
        $dato->save();
    }
}
