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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participante_id');
            $table->enum('tipo_jogo', ['PIRAMIDE', 'PERGUNTAS'])->nullable();
            $table->string('tempo')->default(0);
            $table->integer('pontuacao')->default(0);
            $table->timestamps();
            $table->foreign('participante_id')->references('id')->on('participantes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ajuste: dropIfExists('jogos') (e não 'piramides')
        Schema::dropIfExists('jogos');
    }
};
