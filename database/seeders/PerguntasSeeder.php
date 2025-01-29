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
                'pergunta' => 'Qual é o principal ingrediente do queijo?',
                'respostas' => [
                    ['alternativa' => 'Leite', 'is_correta' => true],
                    ['alternativa' => 'Farinha', 'is_correta' => false],
                    ['alternativa' => 'Açúcar', 'is_correta' => false],
                    ['alternativa' => 'Óleo', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Que tipo de leite é tradicionalmente usado para fazer queijo parmesão?',
                'respostas' => [
                    ['alternativa' => 'Leite de vaca', 'is_correta' => true],
                    ['alternativa' => 'Leite de cabra', 'is_correta' => false],
                    ['alternativa' => 'Leite de búfala', 'is_correta' => false],
                    ['alternativa' => 'Leite de ovelha', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O queijo mussarela tem origem em qual país?',
                'respostas' => [
                    ['alternativa' => 'Itália', 'is_correta' => true],
                    ['alternativa' => 'França', 'is_correta' => false],
                    ['alternativa' => 'Brasil', 'is_correta' => false],
                    ['alternativa' => 'Espanha', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Qual queijo é famoso por ter buracos?',
                'respostas' => [
                    ['alternativa' => 'Queijo Suíço (Emmental)', 'is_correta' => true],
                    ['alternativa' => 'Cheddar', 'is_correta' => false],
                    ['alternativa' => 'Provolone', 'is_correta' => false],
                    ['alternativa' => 'Gorgonzola', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Que tipo de queijo é usado na tradicional receita de fondue suíço?',
                'respostas' => [
                    ['alternativa' => 'Gruyère', 'is_correta' => true],
                    ['alternativa' => 'Mussarela', 'is_correta' => false],
                    ['alternativa' => 'Parmesão', 'is_correta' => false],
                    ['alternativa' => 'Ricota', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O queijo gorgonzola pertence a qual categoria de queijos?',
                'respostas' => [
                    ['alternativa' => 'Queijos azuis', 'is_correta' => true],
                    ['alternativa' => 'Queijos frescos', 'is_correta' => false],
                    ['alternativa' => 'Queijos duros', 'is_correta' => false],
                    ['alternativa' => 'Queijos defumados', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Qual é o nome do queijo francês conhecido por sua casca branca e macia?',
                'respostas' => [
                    ['alternativa' => 'Brie', 'is_correta' => true],
                    ['alternativa' => 'Cheddar', 'is_correta' => false],
                    ['alternativa' => 'Mussarela', 'is_correta' => false],
                    ['alternativa' => 'Roquefort', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O queijo feta é originário de qual país?',
                'respostas' => [
                    ['alternativa' => 'Grécia', 'is_correta' => true],
                    ['alternativa' => 'Itália', 'is_correta' => false],
                    ['alternativa' => 'França', 'is_correta' => false],
                    ['alternativa' => 'Espanha', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Qual queijo é comum em hambúrgueres e conhecido por sua cor laranja?',
                'respostas' => [
                    ['alternativa' => 'Cheddar', 'is_correta' => true],
                    ['alternativa' => 'Provolone', 'is_correta' => false],
                    ['alternativa' => 'Gorgonzola', 'is_correta' => false],
                    ['alternativa' => 'Mussarela', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O queijo provolone é tradicionalmente defumado ou fresco?',
                'respostas' => [
                    ['alternativa' => 'Defumado', 'is_correta' => true],
                    ['alternativa' => 'Fresco', 'is_correta' => false],
                    ['alternativa' => 'Enlatado', 'is_correta' => false],
                    ['alternativa' => 'Pasteurizado', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Que tipo de queijo é usado para fazer cheesecake?',
                'respostas' => [
                    ['alternativa' => 'Cream cheese', 'is_correta' => true],
                    ['alternativa' => 'Ricota', 'is_correta' => false],
                    ['alternativa' => 'Brie', 'is_correta' => false],
                    ['alternativa' => 'Gorgonzola', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'Que queijo italiano é frequentemente ralado sobre massas?',
                'respostas' => [
                    ['alternativa' => 'Parmesão', 'is_correta' => true],
                    ['alternativa' => 'Brie', 'is_correta' => false],
                    ['alternativa' => 'Feta', 'is_correta' => false],
                    ['alternativa' => 'Provolone', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O queijo camembert é semelhante a qual outro queijo francês famoso?',
                'respostas' => [
                    ['alternativa' => 'Brie', 'is_correta' => true],
                    ['alternativa' => 'Gorgonzola', 'is_correta' => false],
                    ['alternativa' => 'Provolone', 'is_correta' => false],
                    ['alternativa' => 'Roquefort', 'is_correta' => false],
                ],
            ],
            [
                'pergunta' => 'O queijo brie é tradicionalmente feito com leite de vaca ou de cabra?',
                'respostas' => [
                    ['alternativa' => 'Leite de vaca', 'is_correta' => true],
                    ['alternativa' => 'Leite de cabra', 'is_correta' => false],
                    ['alternativa' => 'Leite de búfala', 'is_correta' => false],
                    ['alternativa' => 'Leite de ovelha', 'is_correta' => false],
                ],
            ],
        ];

        foreach ($perguntasRespostas as $item) {
            $perguntaId = DB::table('perguntas')->insertGetId(['pergunta' => $item['pergunta']]);

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
