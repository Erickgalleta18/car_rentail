<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->string('model',100);           
            $table->integer('year');
            $table->string('color',100);
            $table->string('license_plate',100)->unique();
            $table->integer('mileage');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->integer('is_premium');
            $table->integer('rental_count');
            $table->integer('daily_rate');
            $table->enum('status',['available','rented','maintenance','retired']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
