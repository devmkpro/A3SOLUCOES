<?php

use App\Models\User;
use Carbon\Carbon;

it('deve retornar a idade correta do usuário', function () {
    $user = User::create([
        'name' => 'Fulano fulaninho',
        'email' => 'fulano@fulaninho.com',
        'password' => bcrypt('password'),
        'birth_date' => '1990-01-01',
        'cpf' => '629.744.040-90',
    ]);

    $idadeEsperada = 34;
    expect(Carbon::parse($user->birth_date)->age)->toBe($idadeEsperada);
});