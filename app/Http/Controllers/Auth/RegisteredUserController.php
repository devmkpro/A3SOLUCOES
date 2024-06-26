<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ValidateBirthDate;
use App\Rules\ValidateCPF;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['required', 'date', 'before:today', new ValidateBirthDate()], 
            'cpf' => ['required', 'string', 'unique:'.User::class, new ValidateCPF(auth()->user())],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => Carbon::parse($request->birth_date),
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
        ]);

        // event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }



}
