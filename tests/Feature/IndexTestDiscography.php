<?php

namespace Tests\Feature;

use App\Models\Discography;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTestDiscography extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function index(): void
    {
        $disk = Discography::factory(1)->create();
        $response = $this->get('admin/discography');

        $response->assertStatus(200);

        $response->assertSee($disk->genre_id);
        $response->assertSee($disk->performer_id);
        $response->assertSee($disk->name);
        $response->assertSee($disk->type);
        $response->assertSee($disk->description);
    }
}
