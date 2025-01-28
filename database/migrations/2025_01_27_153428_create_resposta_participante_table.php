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
        Schema::create('resposta_participante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participante_id');
            $table->unsignedBigInteger('pergunta_id');
            $table->boolean('is_correta')->default(false);

            $table->foreign('participante_id')->references('id')->on('participantes');
            $table->foreign('pergunta_id')->references('id')->on('perguntas');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resposta_participante');
    }
};
