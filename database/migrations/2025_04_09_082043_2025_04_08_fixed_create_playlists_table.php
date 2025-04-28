<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('playlists', function (Blueprint $table) {
        $table->id();
        
        // CORREÇÃO: Definir explicitamente como uuid (com mesmo tipo da tabela users)
        $table->uuid('user_id');
        
        $table->string('title');
        $table->text('description')->nullable();
        $table->boolean('is_public')->default(false);
        $table->timestamps();
        
        // CORREÇÃO: Foreign key para UUID
        $table->foreign('user_id')
              ->references('id') // Certifique-se que a coluna 'id' em users é UUID
              ->on('users')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};
