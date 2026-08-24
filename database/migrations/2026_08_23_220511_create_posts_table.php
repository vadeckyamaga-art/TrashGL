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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->enum('type', ['card', 'text']);
            $table->text('content');

            $table->string('background_type')->nullable();
            $table->string('background_value')->nullable();

            $table->timestamps();
            $table->softDeletes();//Pour garder une trace sur les publications supprimées
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
