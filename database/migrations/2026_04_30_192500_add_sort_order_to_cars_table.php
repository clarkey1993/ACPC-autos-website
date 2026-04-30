<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->nullable()->after('status');
            $table->index(['status', 'sort_order', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['status', 'sort_order', 'created_at']);
            $table->dropColumn('sort_order');
        });
    }
};
