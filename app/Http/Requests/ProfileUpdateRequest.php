<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidateCPF;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidateBirthDate;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)],
            'cpf' => ['required', 'string', 'max:14', Rule::unique(User::class)->ignore(auth()->user()->id), new ValidateCPF(auth()->user())],
            'birth_date' => ['required', 'date', 'before:today', new ValidateBirthDate()],
        ];
    }
}
