<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Performer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discography>
 */
class DiscographyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'genre_id' => $this->faker->randomElement(Genre::pluck("id")),
            'performer_id' => $this->faker->randomElement(Performer::pluck("id")),
            'name' => $this->faker->word(),
            'type' => "Album",
            'description' => $this->faker->text(),
        ];
    }
}
