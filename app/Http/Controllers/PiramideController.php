<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;

class PiramideController extends Controller
{
    public function index($id)
    {
        $participanteId = $id;

        return view('time-piramide', compact('participanteId'));

    }

    public function store(Request $request)
    {

        $totalTime = $request->totalTime;
        $minutes = floor($totalTime / 60000);
        $seconds = floor(($totalTime % 60000) / 1000);
        $milliseconds = $totalTime % 1000;

        $formattedTime = sprintf('%02d:%02d:%02d', $minutes, $seconds, floor($milliseconds / 10));

        $jogo = Jogo::create([
            'participante_id' => $request->participanteId,
            'tipo_jogo' => 'PIRAMIDE',
            'tempo' => $request->tempo,
            'pontuacao' => 0,
        ]);


        return response()->json(['success' => true]);


    }


}
