<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipanteRequest;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index(Request $request)
{
    $searchCpf = $request->input('searchCpf');

    $participantes = Participante::with('jogos')
        ->when($searchCpf, function ($query, $searchCpf) {
            return $query->where('cpf', 'like', '%' . $searchCpf . '%');
        })
        ->paginate(10);

    return view('home', compact('participantes'));
}

    public function store(ParticipanteRequest $request)
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
