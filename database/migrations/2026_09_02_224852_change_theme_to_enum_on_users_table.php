<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY theme ENUM('light', 'dark', 'system') NOT NULL DEFAULT 'light'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY theme VARCHAR(10) NOT NULL DEFAULT 'light'");
    }
};
