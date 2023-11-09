<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScraperControllerTest extends TestCase
{
    /** @test */
    public function scraper_can_scrape_jumia_website()
    {
        $response = $this->get('/scraper');

        $response->assertStatus(200);

        $this->assertTrue(session()->has('scrapedData'));
    }
}