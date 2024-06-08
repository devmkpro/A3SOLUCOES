<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateCPF implements ValidationRule
{
  

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/\D/', '', $value);

        if (User::where('cpf', $cpf)->exists() && !auth()->check()) {
            $fail('CPF já cadastrado.');
        } elseif (auth()->check() && User::where('cpf', $cpf)->where('id', '!=', auth()->id())->exists()) {
            $fail('CPF já cadastrado.');
        }

        if (!strlen($cpf) == 11) {
            $fail('CPF deve conter 11 caracteres.');
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) { 
            $fail('CPF inválido.'); 
        }

        // Digito verificador (nove primeiros digitos)
        $cpfValidate = substr($cpf, 0, 9);
        $cpfValidate .= $this->calculateDigit($cpfValidate);
        $cpfValidate .= $this->calculateDigit($cpfValidate);

        if ($cpf != $cpfValidate) {
            $fail('CPF inválido.');
        }
    }

    /**
     * Calcula o digito verificador com base em sequencia numerica.
     */
    private function calculateDigit(string $cpf): string
    {
        /**
         * 1x10 2x9 3x8 4x7 5x6 6x5 7x4 8x3 9x2
         * o multiplicador muda dependendo do tamanho do cpf, para que o ultimo digito seja multiplicado por 2
         */
        $length = strlen($cpf);
        $sum = 0;
        $factor = $length + 1;

        for ($i = 0; $i < $length; $i++) { 
            $sum += $cpf[$i] * $factor--;
        }

        $rest = $sum % 11;
        return $rest > 1 ? 11 - $rest : 0; 
    }
}
