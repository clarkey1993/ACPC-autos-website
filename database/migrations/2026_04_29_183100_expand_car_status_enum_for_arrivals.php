<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement(
            "ALTER TABLE cars MODIFY COLUMN status ENUM('available','reserved','sold','arriving_soon','just_arrived') NOT NULL DEFAULT 'available'"
        );
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement(
            "ALTER TABLE cars MODIFY COLUMN status ENUM('available','reserved','sold') NOT NULL DEFAULT 'available'"
        );
    }
};
