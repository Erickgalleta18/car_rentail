<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreignId('car_id')->references('id')->on('cars')->onDelete('cascade');;
            $table->foreignId('driver_id')->references('id')->on('drivers')->onDelete('cascade');;
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->integer('total_amount');
            $table->enum('status',['pending','confirmed','active','completed','cancelled']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
