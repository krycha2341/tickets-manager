<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'description' => fake()->text,
            'user_id' => User::factory(),
            'status' => fake()->randomElement(TaskStatus::cases()),
        ];
    }
}
