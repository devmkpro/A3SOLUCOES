<?php

namespace Database\Seeders;

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
            'email' => 'test@example.com',
        ]);

       
        Task::factory(5)->create();
        Task::create([
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'user_id' => User::first()->id,
            'expires_at' => now()->addMonths(6),
            'recurrence_type' => 'weekly',
            'recurrence_end_date' => now()->addMonths(6),
        ]);
    }
}
