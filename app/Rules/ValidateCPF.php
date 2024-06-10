<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateCPF implements ValidationRule
{
  private ?User $userUniqueCPFIgnore;

  public function __construct(?User $userUniqueCPFIgnore)
  {
    $this->userUniqueCPFIgnore = $userUniqueCPFIgnore;
  }

  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $cpf = preg_replace('/\D/', '', $value);

    $this->checkUniqueCPF($cpf, $fail);
    $this->validateCPF($cpf, $fail);
  }

  private function checkUniqueCPF(string $cpf, Closure $fail): void
  {
    $query = User::where('cpf', $cpf);

    if (auth()->check()) {
      $query->where('id', '!=', $this->userUniqueCPFIgnore->id);
    }

    if ($query->exists()) {
      $fail('CPF já cadastrado.');
    }
  }

  private function validateCPF(string $cpf, Closure $fail): void
  {
    if (strlen($cpf) != 11) {
      $fail('CPF deve conter 11 caracteres.');
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) { // 11 digitos iguais
      $fail('CPF inválido.');
    }

    // Digito verificador (nove primeiros digitos)
    $cpfValidate = substr($cpf, 0, 9); // corta os dois ultimos digitos
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
       * ou 
       * 1x11 2x10 3x9 4x8 5x7 6x6 7x5 8x4 9x3 10x2
       * o multiplicador muda dependendo do tamanho do cpf, para que o ultimo digito seja multiplicado por 2
       */
    $length = strlen($cpf);
    $sum = 0;
    $factor = $length + 1; // 10 ou 11

    for ($i = 0; $i < $length; $i++) {
      $sum += $cpf[$i] * $factor--;
    }

    $rest = $sum % 11;
    return $rest > 1 ? 11 - $rest : 0;
  }
}