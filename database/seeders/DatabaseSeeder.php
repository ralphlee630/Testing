<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 3 Users
        $users = [
            [
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            
            // Each user gets 5-7 tasks
            Task::factory()->count(rand(5, 7))->create([
                'user_id' => $user->id,
            ]);
        }

        // Ensure we meet the "at least 20 tasks" requirement
        // if the random counts didn't reach it.
        $currentTaskCount = Task::count();
        if ($currentTaskCount < 20) {
            Task::factory()->count(20 - $currentTaskCount)->create([
                'user_id' => User::first()->id,
            ]);
        }
    }
}
