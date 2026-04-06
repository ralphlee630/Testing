<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tasksData = [
            'Fix high-priority server bugs',
            'Draft Q4 marketing strategy',
            'Update employee onboarding docs',
            'Research new API integrations',
            'Optimize database queries',
            'Prepare presentation for client meeting',
            'Refactor authentication logic',
            'Review pull requests',
            'Conduct user interviews',
            'Design mobile app prototype',
        ];

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->randomElement($tasksData) . ' - ' . $this->faker->words(3, true),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        ];
    }
}
