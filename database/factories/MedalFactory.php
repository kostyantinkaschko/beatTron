<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medal>
 */
class MedalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => "user",
            'description' => $this->faker->text(),
            'difficulty' => $this->faker->randomElement(['easy', 'hard']),
        ];
    }
}
