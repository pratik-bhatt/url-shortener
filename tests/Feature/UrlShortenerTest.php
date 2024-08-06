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
            'url' => 'https://app.fireflies.ai/view/Pratik-Bhatt-and-Sheilah-Casaclang::BZi657yjr3AsR228?ref=recap&track=BZi657yjr3AsR228&sg=nb&utm_content=view_recap_cta'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['short_url']);
    }

    public function testDecodeUrl()
    {
        // First, encode a URL to get a short URL
        $response = $this->postJson('/api/encode', [
            'url' => 'https://app.fireflies.ai/view/Pratik-Bhatt-and-Sheilah-Casaclang::BZi657yjr3AsR228?ref=recap&track=BZi657yjr3AsR228&sg=nb&utm_content=view_recap_cta'
        ]);

        $shortUrl = $response->json('short_url');

        // Decode the short URL
        $response = $this->postJson('/api/decode', [
            'short_url' => $shortUrl
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'original_url' => 'https://app.fireflies.ai/view/Pratik-Bhatt-and-Sheilah-Casaclang::BZi657yjr3AsR228?ref=recap&track=BZi657yjr3AsR228&sg=nb&utm_content=view_recap_cta'
                 ]);
    }

    public function testDecodeUrlNotFound()
    {
        $response = $this->postJson('/api/decode', [
            'short_url' => 'http://short.est/Alq5W4'
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'error' => 'URL not found'
                 ]);
    }
}