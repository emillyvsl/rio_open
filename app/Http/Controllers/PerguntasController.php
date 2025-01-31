<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use App\Models\Pergunta;
use App\Models\RespostaParticipante;
use Illuminate\Http\Request;
use Log;

class PerguntasController extends Controller
{
    public function index($id)
    {
        $participanteId = $id;
        $perguntas = Pergunta::with([
            'respostas' => function ($query) {
                $query->inRandomOrder();
            }
        ])->inRandomOrder()->limit(5)->get();

        return view('quiz', compact('perguntas', 'participanteId'));
    }


    public function store(Request $request)
    {
        try {
            Log::info('Início do método store', ['request_data' => $request->all()]);

            $totalTime = $request->totalTime;
            $minutes = floor($totalTime / 60000);
            $seconds = floor(($totalTime % 60000) / 1000);
            $milliseconds = $totalTime % 1000;

            $formattedTime = sprintf('%02d:%02d:%02d', $minutes, $seconds, floor($milliseconds / 10));

            $jogo = Jogo::create([
                'participante_id' => $request->participanteId,
                'tipo_jogo' => 'PERGUNTAS',
                'tempo' => $formattedTime,
                'pontuacao' => 0,
            ]);

            Log::info('Jogo criado', ['jogo_id' => $jogo->id]);

            foreach ($request->answers as $answer) {
                RespostaParticipante::create([
                    'jogo_id' => $jogo->id,
                    'pergunta_id' => $answer['questionId'],
                    'resposta_id' => $answer['selectedAnswerId'],
                    'is_correta' => $answer['isCorrect'],
                ]);

                Log::info('Resposta salva', [
                    'questionId' => $answer['questionId'],
                    'selectedAnswerId' => $answer['selectedAnswerId']
                ]);
            }
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Erro no método store', ['exception' => $e->getMessage()]);

            return response()->json(['error' => 'Ocorreu um erro ao salvar as respostas.'], 500);
        }
    }






}
