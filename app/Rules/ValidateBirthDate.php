<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateBirthDate implements ValidationRule
{
   
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        Carbon::parse($value)->age >= 120 ? $fail('Você não pode ter mais de 120 anos.') : null;
    }
}
