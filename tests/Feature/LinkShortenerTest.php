<?php

namespace Tests\Feature;

use App\Models\ShortenedLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinkShortenerTest extends TestCase
{
    const BAD_URL_FOR_TEST = 'some bad url string';
    const ORIGINAL_URL_FOR_TEST = 'https://developers.google.com/';

    /**
     * @return void
     */
    public function test_create_link_bad_original_url()
    {
        $response = $this->postJson('/api/shortener_form', [
            'original_url' => self::BAD_URL_FOR_TEST
        ]);

        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_create_link_success()
    {
        $response = $this->postJson('/api/shortener_form', [
            'original_url' => self::ORIGINAL_URL_FOR_TEST
        ]);

        $response->assertStatus(201);
    }

    /**
     * @return void
     */
    public function test_redirect_by_shortened_link()
    {
        $link = ShortenedLink::where('original_url', '=', self::ORIGINAL_URL_FOR_TEST)->firstOrFail();

        $this->assertEquals(self::ORIGINAL_URL_FOR_TEST, $link->original_url);

        $response = $this->from('/')->get($link->shortened_link);
        $response->assertStatus(302);
        $response->assertRedirect(self::ORIGINAL_URL_FOR_TEST);
    }
}
