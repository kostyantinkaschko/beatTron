<?php

namespace Database\Factories;

use App\Models\Discrography;
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
            'disk_id' => $this->faker->randomElement(Discrography::pluck("id")),
            'performer_id' => $this->faker->randomElement(Performer::pluck("id")),
            'name' => $this->faker->word(),
            'size' => rand(4000000, 20000000),
            'rate' => rand(0, 5),
            'listeningCount' => rand(0, 1000),
            'year' => rand(1995, 3000),
            'status' => $this->faker->randomElement(['private', 'public', 'protected']),
        ];
    }
}
