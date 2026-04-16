<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->references('id')->on('rentals')->onDelete('cascade');;
            $table->integer('amount');
            $table->string('payment_method',100);
            $table->string('transaction_id',255)->unique();
            $table->enum('status',['pending','completed','failed','refunded']);
            $table->dateTime('payment_date');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
