<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateBirthDate implements ValidationRule
{
   
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        Carbon::parse($value)->age >= 120 ? $fail('A idade não pode ser maior que 120') : null;
    }
}
