<?php

namespace Database\Factories;

use App\Models\Performer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'performer_id' => $this->faker->randomElement(Performer::pluck("id")),
            'title' => $this->faker->word(),
            'text' => $this->faker->text()
        ];
    }
}
