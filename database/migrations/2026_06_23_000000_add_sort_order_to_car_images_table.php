<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_images', function (Blueprint $table) {
            $table->integer('sort_order')->nullable()->after('image_path');
        });

        // Backfill existing images with a simple incremental order based on created_at
        $images = \DB::table('car_images')->orderBy('created_at')->pluck('id');
        foreach ($images as $i => $id) {
            \DB::table('car_images')->where('id', $id)->update(['sort_order' => $i]);
        }
    }

    public function down(): void
    {
        Schema::table('car_images', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};

