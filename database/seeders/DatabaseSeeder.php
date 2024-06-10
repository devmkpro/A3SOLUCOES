<?php

namespace Database\Seeders;

use App\Models\SubTask;
use App\Models\Task;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'maikeofc18@gmail.com',
            'is_admin' => true,
        ]);

       
        Task::create([
            'title' => 'Ir ao Midway',
            'description' => 'Ir ao Midway Mall para comprar um presente de aniversário.',
            'user_id' => User::first()->id,
            'expires_at' => now()->addMonths(6),
        ]);

        SubTask::create([
            'title' => 'Lanchar no refeitório',
            'description' => 'Lanchar no refeitório do shopping.',
            'task_id' => Task::first()->id,
            'expires_at' => now()->addMonths(6),
        ]);
    }
}
