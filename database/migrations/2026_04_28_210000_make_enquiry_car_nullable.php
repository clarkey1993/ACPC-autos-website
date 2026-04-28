<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreignId('car_id')->nullable()->change();
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        DB::table('enquiries')->whereNull('car_id')->delete();

        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreignId('car_id')->nullable(false)->change();
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars')->cascadeOnDelete();
        });
    }
};
