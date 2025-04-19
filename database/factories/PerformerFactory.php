<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Performer>
 */
class PerformerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::pluck("id")),
            'name' => $this->faker->word(),
            'instagram' => 'https://instagram.com/' . fake()->userName(),
            'facebook' => 'https://facebook.com/' . fake()->userName(),
            'x' => 'https://x.com/' . fake()->userName(),
            'youtube' => 'https://youtube.com/watch?v=' . fake()->bothify('###???'),
        ];
    }
}
