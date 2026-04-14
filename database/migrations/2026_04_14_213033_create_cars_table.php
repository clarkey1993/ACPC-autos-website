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
            $table->string('title');
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->unsignedInteger('price');
            $table->unsignedInteger('mileage')->nullable();
            $table->string('fuel_type', 50)->nullable();
            $table->string('transmission', 50)->nullable();
            $table->string('colour', 50)->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->string('featured_image')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['make', 'model']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};