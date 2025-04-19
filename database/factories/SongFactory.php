<?php

namespace Database\Factories;

use App\Models\Discography;
use App\Models\Genre;
use App\Models\Performer;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
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
            'disk_id' => $this->faker->randomElement(Discography::pluck("id")),
            'name' => $this->faker->word(),
            'listening_count' => rand(0, 1000),
            'year' => rand(1995, 3000),
            'status' => $this->faker->randomElement(['private', 'public', 'protected']),
        ];
    }
}
