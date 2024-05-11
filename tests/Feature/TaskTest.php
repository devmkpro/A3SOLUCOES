<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('deve criar uma tarefa e associar ao usuário autenticado', function () {

    $user = User::factory()->create();
    Auth::login($user);

    $response = $this->post(route('tasks.store'), [
        'title' => 'Nova tarefa',
        'description' => 'Descrição da tarefa',
        'status' => 'pending',
    ]);

    $response->assertStatus(302);
    
    $task = Task::where('title', 'Nova tarefa')->first();
    expect($task)
    ->not->toBeNull()
    ->description->toBe('Descrição da tarefa')
    ->user_id->toBe($user->id);

});
