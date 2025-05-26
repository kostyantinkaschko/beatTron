<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Song;
use App\Models\User;
use App\Models\Genre;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Performer;
use App\Models\Discography;
use App\Models\Medal;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(1)->create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'role' => 'admin',
        ]);

        $users = User::factory(40)->create();

        Genre::factory(200)->create();

        Performer::factory(90)->create();
        // News::factory(20)->create();

        Discography::factory(100)->create();

        $playlists = Playlist::factory()->count(5)->create();
        // $songs = Song::factory()->count(1000)->create();

        // foreach ($playlists as $playlist) {
        //     $playlist->songs()->attach(
        //         $songs->random(3)->pluck('id')
        //     );
        // }

        // $medals = Medal::factory(80)->create();

        // foreach ($medals as $medal) {
        //     $medal->users()->attach(
        //         $users->random(3)->pluck('id')
        //     );
        // }
    }
}
