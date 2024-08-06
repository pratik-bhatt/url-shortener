<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{

    public function testEncodeUrl()
    {
        $response = $this->postJson('/api/encode', [
            'url' => 'https://laravel.com/docs/11.x'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['short_url']);
    }

    public function testDecodeUrl()
    {
        // First, encode a URL to get a short URL
        $response = $this->postJson('/api/decode', [
            'short_url' => 'http://short.est/shnXOd'
        ]);

        $shortUrl = $response->json('short_url');

        // Decode the short URL
        $response = $this->postJson('/api/decode', [
            'short_url' => 'http://short.est/shnXOd'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['url']);
    }
}