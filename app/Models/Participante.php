<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'participantes';
    protected $fillable = [
        'nome',
        'email',
        'data_nascimento',
        'cpf',
        'tipo_queijo',
        'termos_aceitos',
    ];
    protected $dates = [
        'data_nascimento',
    ];
    protected $casts = [
        'termos_aceitos' => 'boolean',
    ];
    protected $attributes = [
        'tipo_queijo' => 'BRIE',
    ];
    protected $enumTipoQueijo = [
        'BRIE',
        'CAMEMBERT',
        'GORGONZOLA',
        'EMMENTAL',
        'GRUYERE',
        'GOUDA',
        'PARMESÃO',
        'REINO',
    ];

    public function setTipoQueijoAttribute($value)
    {
        if (!in_array($value, $this->enumTipoQueijo)) {
            throw new \InvalidArgumentException('Tipo de queijo inválido');
        }

        $this->attributes['tipo_queijo'] = $value;
    }

    public function jogos()
    {
        return $this->hasMany(Jogo::class, 'participante_id');
    }
}
