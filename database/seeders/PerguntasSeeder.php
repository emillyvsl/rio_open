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
                'pergunta' => 'Qual queijo de Faixa Azul recebeu uma medalha no maior concurso de queijos do mundo (World Cheese Awards)?',
                'respostas' => [
                    ['alternativa' => 'Parmesão', 'is_correta' => false],
                    ['alternativa' => 'Camembert', 'is_correta' => false],
                    ['alternativa' => 'Gorgonzola', 'is_correta' => false],
                    ['alternativa' => 'Todas as opções acima', 'is_correta' => true],
                ],
            ],
            [
                'pergunta' => 'O Reserva Especial Faixa Azul possui um tempo diferenciado de maturação em relação a outros queijos da categoria. De quanto tempo estamos falando?',
                'respostas' => [
                    ['alternativa' => '8 meses', 'is_correta' => false],
                    ['alternativa' => '12 meses', 'is_correta' => false],
                    ['alternativa' => '16 meses', 'is_correta' => false],
                    ['alternativa' => '18 meses', 'is_correta' => true],
                ],
            ],
            [
                'pergunta' => 'Você sabe qual queijo é super tradicional na região Nordeste e era consumido apenas pela realeza do Brasil na sua chegada ao país?',
                'respostas' => [
                    ['alternativa' => 'Reino', 'is_correta' => true],
                    ['alternativa' => 'Gruyère', 'is_correta' => false],
                    ['alternativa' => 'Emmental', 'is_correta' => false],
                    ['alternativa' => 'Brie', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Qual é a origem do queijo gorgonzola?',
                'respostas' => [
                    ['alternativa' => 'França', 'is_correta' => false],
                    ['alternativa' => 'Suíça', 'is_correta' => false],
                    ['alternativa' => 'Itália', 'is_correta' => true],
                    ['alternativa' => 'Holanda', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Qual queijo de origem holandesa é perfeito para ser consumido em pequenas porções e harmoniza muito bem com vinhos pinot noir, cervejas pilsen e pastrami?',
                'respostas' => [
                    ['alternativa' => 'Brie', 'is_correta' => false],
                    ['alternativa' => 'Camembert', 'is_correta' => false],
                    ['alternativa' => 'Emmental', 'is_correta' => false],
                    ['alternativa' => 'Gouda', 'is_correta' => true],
                ],
            ],
            [
                'pergunta' => 'Este queijo tem diversas premiações nacionais e internacionais, sendo extremamente reconhecido pelo nosso consumidor por seu sabor, textura e personalidade única.',
                'respostas' => [
                    ['alternativa' => 'Gouda', 'is_correta' => false],
                    ['alternativa' => 'Gorgonzola', 'is_correta' => false],
                    ['alternativa' => 'Camembert', 'is_correta' => false],
                    ['alternativa' => 'Parmesão', 'is_correta' => true],
                ],
            ],
            [
                'pergunta' => 'Qual queijo parmesão Faixa Azul é extraído da parte mais nobre de sua forma?',
                'respostas' => [
                    ['alternativa' => 'Fatia Parmesão Faixa Azul', 'is_correta' => false],
                    ['alternativa' => 'Cilindro Parmesão Faixa Azul', 'is_correta' => true],
                    ['alternativa' => 'Ralado Parmesão Faixa Azul', 'is_correta' => false],
                    ['alternativa' => 'Reserva Especial 18 Meses', 'is_correta' => false],
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
                'pergunta' => 'O queijo reino tem personalidade e seu sabor é impossível de ser ignorado. Se fosse um tenista, qual seria sua característica?',
                'respostas' => [
                    ['alternativa' => 'Dominante no saque', 'is_correta' => true],
                    ['alternativa' => 'Paciente no baseline', 'is_correta' => false],
                    ['alternativa' => 'Jogador de contra-ataque', 'is_correta' => false],
                    ['alternativa' => 'Especialista em ralis longos', 'is_correta' => false],
                ],
            ],
            [

                'pergunta' => 'Responsável por dar fama aos queijos suíços, o emmental tem furos internos conhecidos como olhaduras. Qual termo do tênis se encaixa nessa característica?',
                'respostas' => [
                    ['alternativa' => 'Passada', 'is_correta' => true],
                    ['alternativa' => 'Ace', 'is_correta' => false],
                    ['alternativa' => 'Voleio ', 'is_correta' => false],
                    ['alternativa' => 'Deuce', 'is_correta' => false],
                ],
            ],
            [

                'pergunta' => 'A elegância e a versatilidade do gouda combinam com qual atitude em quadra?',
                'respostas' => [
                    ['alternativa' => 'Jogo de rede sutil ', 'is_correta' => true],
                    ['alternativa' => 'Defesa intransigente', 'is_correta' => false],
                    ['alternativa' => 'Saque agressivo ', 'is_correta' => false],
                    ['alternativa' => 'Rally intenso', 'is_correta' => false],
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
