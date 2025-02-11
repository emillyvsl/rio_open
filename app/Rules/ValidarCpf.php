<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarCpf implements ValidationRule
{
    /**
     * Executa a validação do CPF.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            $fail('O CPF deve conter 11 dígitos.');
            return;
        }

        // Elimina CPFs com todos os números iguais (ex: 111.111.111-11)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O CPF informado é inválido.');
            return;
        }

        // Cálculo do primeiro e segundo dígito verificador
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$t] != $d) {
                $fail('O CPF informado é inválido.');
                return;
            }
        }
    }
}
