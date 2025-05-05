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
    Schema::create('album_likes', function (Blueprint $table) {
        $table->id();

        // Correção: user_id como UUID
        $table->uuid('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        // album_id continua como bigint
        $table->foreignId('album_id')->constrained()->onDelete('cascade');

        $table->timestamps();

        // Cada usuário pode curtir o mesmo álbum só uma vez
        $table->unique(['user_id', 'album_id']);
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_likes');
    }
};
