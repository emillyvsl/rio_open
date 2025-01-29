<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use Illuminate\Http\Request;

class PerguntasController extends Controller
{
    public function index()
    {
        $perguntas = Pergunta::with([
            'respostas' => function ($query) {
                $query->inRandomOrder();
            }
        ])->inRandomOrder()->limit(5)->get();

        return view('quiz', compact('perguntas'));
    }


}
