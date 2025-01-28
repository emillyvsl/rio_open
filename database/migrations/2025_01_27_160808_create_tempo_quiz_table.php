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
        Schema::create('tempo_quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participante_id');
            $table->unsignedBigInteger('perguntas_id');
            $table->time('tempo');

            $table->foreign('participante_id')->references('id')->on('participantes');
            $table->foreign('perguntas_id')->references('id')->on('perguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempo_quiz');
    }
};
