<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index()
    {
        $participantes = Participante::with('jogos')->get();

        return view('home', data: compact('participantes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:participantes,email',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|unique:participantes,cpf',
            'tipo_queijo' => 'nullable|string|in:BRIE,CAMEMBERT,GORGONZOLA,EMMENTAL,GRUYERE,GOUDA,PARMESÃO,REINO',
            'termos_aceitos' => 'required|boolean',
        ]);

        $participante = new Participante();
        $participante->fill($request->all());
        $participante->save();

        return redirect()->route('dashboard')->with('success', 'Participante cadastrado com sucesso!');
    }
}
