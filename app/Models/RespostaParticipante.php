<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaParticipante extends Model
{
    use HasFactory;

    protected $table = 'resposta_participante';

    protected $fillable = [
        'jogo_id',
        'pergunta_id',
        'resposta_id',
        'is_correta',
    ];


    public function jogo()
    {
        return $this->belongsTo(Jogo::class, 'jogo_id');
    }


    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function resposta()
    {
        return $this->belongsTo(Resposta::class, 'resposta_id');
    }
}
