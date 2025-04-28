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
    Schema::create('singers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('genre');
        $table->date('birth_date');
        $table->text('bio')->nullable();
        $table->string('label')->nullable();
        // Adicione outros campos necessários
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('singers');
    }
};
