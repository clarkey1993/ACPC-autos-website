<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_phone', 80)->nullable();
            $table->string('business_email', 120)->nullable();
            $table->string('whatsapp_number', 32)->nullable();
            $table->text('opening_hours_text')->nullable();
            $table->timestamps();
        });

        DB::table('site_settings')->insert([
            'business_phone' => '+353 87 000 0000',
            'business_email' => 'sales@example.com',
            'whatsapp_number' => '353870000000',
            'opening_hours_text' => 'Viewings by appointment only',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
