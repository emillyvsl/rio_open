<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $table = 'jogos';

    protected $fillable = [
        'participante_id',
        'tipo_jogo',
        'tempo',
        'pontuacao',
    ];

    /**
     * Relacionamento: um Jogo pertence a um Participante
     */
    public function participante()
    {
        return $this->belongsTo(Participante::class, 'participante_id');
    }

    /**
     * Se quiser relacionar com a tabela de respostas do participante (resposta_participante),
     * um Jogo pode ter várias respostas registradas.
     */
    public function respostasParticipante()
    {
        return $this->hasMany(RespostaParticipante::class, 'jogo_id');
    }
}
