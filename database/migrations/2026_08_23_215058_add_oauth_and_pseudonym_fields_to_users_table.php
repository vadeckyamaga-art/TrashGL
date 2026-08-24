<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('pseudonym')->unique()->after('name');
            $table->string('provider')->nullable()->after('email');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('language', 5)->default('fr')->after('provider_id');
            $table->enum('theme', ['light', 'dark'])->default('light')->after('language');
            $table->unique(['provider', 'provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['provider', 'provider_id']);
            $table->dropColumn(['pseudonyme', 'provider', 'provider_id', 'language', 'theme']);
            $table->string('password')->nullable(false)->change();
        });
    }
};
