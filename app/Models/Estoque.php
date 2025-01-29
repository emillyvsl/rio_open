<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';

    protected $fillable = [
        'nome',
        'quantidade',
    ];

    // Se precisar de relacionamentos adicionais (por exemplo, entregas de itens de estoque para participantes),
    // você poderia criar outra tabela e relacionar aqui. Caso contrário, é apenas uma tabela simples.
}
