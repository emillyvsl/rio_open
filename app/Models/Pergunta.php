<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    protected $table = 'perguntas';

    protected $fillable = [
        'pergunta',
        'dicas',
    ];


    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'pergunta_id');
    }

    public function respostasParticipante()
    {
        return $this->hasMany(RespostaParticipante::class, 'pergunta_id');
    }
}
