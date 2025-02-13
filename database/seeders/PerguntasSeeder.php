<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perguntasRespostas = [
            [
                'pergunta' => 'Qual movimento no tênis combina com a textura consistente, marcante e granulada do parmesão?',
                'respostas' => [
                    ['alternativa' => 'Slice', 'is_correta' => true],
                    ['alternativa' => 'Lob', 'is_correta' => false],
                    ['alternativa' => 'Drop Shot', 'is_correta' => false],
                    ['alternativa' => 'Smash', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Pensando no parmesão como um queijo consistente, poderoso e muito admirado, se ele fosse um estilo de jogo, qual seria?',
                'respostas' => [
                    ['alternativa' => 'Baseline agressivo', 'is_correta' => true],
                    ['alternativa' => 'Serve-and-volley', 'is_correta' => false],
                    ['alternativa' => 'All-court', 'is_correta' => false],
                    ['alternativa' => 'Defensive retriever', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O gouda é conhecido por sua textura macia e suavidade. Qual jogada reflete essa característica?',
                'respostas' => [
                    ['alternativa' => 'Voleio suave', 'is_correta' => true],
                    ['alternativa' => 'Ace', 'is_correta' => false],
                    ['alternativa' => 'Forehand potente', 'is_correta' => false],
                    ['alternativa' => 'Smash', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'A elegância e a versatilidade do Gouda combinam com qual atitude em quadra?',
                'respostas' => [
                    ['alternativa' => 'Jogo de rede sutil', 'is_correta' => true],
                    ['alternativa' => 'Defesa intransigente', 'is_correta' => false],
                    ['alternativa' => 'Saque agressivo', 'is_correta' => false],
                    ['alternativa' => 'Rally intenso', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Responsável por dar fama aos queijos suíços, o emmental tem furos internos conhecidos como olhaduras. Qual termo do tênis se encaixa com essa característica?',
                'respostas' => [
                    ['alternativa' => 'Passing shot', 'is_correta' => true],
                    ['alternativa' => 'Ace', 'is_correta' => false],
                    ['alternativa' => 'Voleio', 'is_correta' => false],
                    ['alternativa' => 'Deuce', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O emmental é um queijo leve, com textura macia. Qual golpe do tênis pode representar essa leveza?',
                'respostas' => [
                    ['alternativa' => 'Slice de backhand', 'is_correta' => true],
                    ['alternativa' => 'Forehand topspin', 'is_correta' => false],
                    ['alternativa' => 'Saque forçado', 'is_correta' => false],
                    ['alternativa' => 'Smash violento', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O gruyère é um queijo sofisticado com sabor complexo. Qual estratégia no tênis reflete essa complexidade?',
                'respostas' => [
                    ['alternativa' => 'Variação tática com transição rápida', 'is_correta' => true],
                    ['alternativa' => 'Serve-and-volley', 'is_correta' => false],
                    ['alternativa' => 'Baseline puro', 'is_correta' => false],
                    ['alternativa' => 'Jogo defensivo extremo', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O gruyère é um queijo semiduro que derrete na boca ao ser degustado e derrete bem. Qual jogada é "fluida" como ele?',
                'respostas' => [
                    ['alternativa' => 'Rali consistente', 'is_correta' => true],
                    ['alternativa' => 'Saque direto', 'is_correta' => false],
                    ['alternativa' => 'Drop shot curto', 'is_correta' => false],
                    ['alternativa' => 'Smash de finalização', 'is_correta' => false],
                ],
            ],

            [
                'pergunta' => 'O queijo reino é forte, intenso e marcante. Qual técnica do tênis tem essa força?',
                'respostas' => [
                    ['alternativa' => 'Forehand agressivo', 'is_correta' => true],
                    ['alternativa' => 'Slice defensivo', 'is_correta' => false],
                    ['alternativa' => 'Voleio suave', 'is_correta' => false],
                    ['alternativa' => 'Drop shot', 'is_correta' => false],
                ],
            ],

            [
                'pergunta' => 'O queijo reino tem personalidade e seu sabor é impossível de ser ignorado. Se fosse um tenista, qual seria sua característica?',
                'respostas' => [
                    ['alternativa' => 'Dominante no saque', 'is_correta' => true],
                    ['alternativa' => 'Paciente no baseline', 'is_correta' => false],
                    ['alternativa' => 'Jogador de contra-ataque', 'is_correta' => false],
                    ['alternativa' => 'Especialista em ralis longos', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O brie é cremoso e delicado para ser apreciado em seus mínimos detalhes. Qual jogada reflete essa suavidade?',
                'respostas' => [
                    ['alternativa' => 'Drop shot', 'is_correta' => true],
                    ['alternativa' => 'Ace poderoso', 'is_correta' => false],
                    ['alternativa' => 'Forehand chapado', 'is_correta' => false],
                    ['alternativa' => 'Smash', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O brie é conhecido por sua suavidade e sofisticação. Qual técnica do tênis representa essas qualidades?',
                'respostas' => [
                    ['alternativa' => 'Voleio elegante na rede', 'is_correta' => true],
                    ['alternativa' => 'Saque potente', 'is_correta' => false],
                    ['alternativa' => 'Forehand agressivo', 'is_correta' => false],
                    ['alternativa' => 'Devolução chapada', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Camembert tem um sabor forte e textura macia. Qual jogada combina com essa dualidade?',
                'respostas' => [
                    ['alternativa' => 'Slice agressivo', 'is_correta' => true],
                    ['alternativa' => 'Lob defensivo', 'is_correta' => false],
                    ['alternativa' => 'Forehand com topspin', 'is_correta' => false],
                    ['alternativa' => 'Voleio de finalização', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O sabor do gorgonzola é forte e marcante. Qual golpe reflete essa potência?',
                'respostas' => [
                    ['alternativa' => 'Smash poderoso', 'is_correta' => true],
                    ['alternativa' => 'Drop shot suave', 'is_correta' => false],
                    ['alternativa' => 'Slice defensivo', 'is_correta' => false],
                    ['alternativa' => 'Lob de cobertura', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O gorgonzola é um queijo de sabor intenso e cheio de personalidade. Se fosse um tenista, qual seria sua principal qualidade?',
                'respostas' => [
                    ['alternativa' => 'Estilo agressivo e impactante', 'is_correta' => true],
                    ['alternativa' => 'Defesa consistente', 'is_correta' => false],
                    ['alternativa' => 'Paciência tática', 'is_correta' => false],
                    ['alternativa' => 'Jogo de rede sutil', 'is_correta' => false],
                ],
            ],
        ];

        foreach ($perguntasRespostas as $item) {
            $perguntaId = DB::table('perguntas')->insertGetId([
                'pergunta' => $item['pergunta'],
            ]);

            foreach ($item['respostas'] as $resposta) {
                DB::table('respostas')->insert([
                    'pergunta_id' => $perguntaId,
                    'alternativa' => $resposta['alternativa'],
                    'is_correta' => $resposta['is_correta'],
                ]);
            }
        }
    }
}
