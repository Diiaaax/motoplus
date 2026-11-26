<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_page_has_expected_content(): void
    {
        $response = $this->get('/');

        $response->assertSee('MotoPlus');
    }

    public function test_catalog_page_loads(): void
    {
        $response = $this->get('/catalog');

        $response->assertStatus(200);
    }

    public function test_brands_page_loads(): void
    {
        $response = $this->get('/brands');

        $response->assertStatus(200);
    }

    public function test_contact_page_loads(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    public function test_about_page_loads(): void
    {
        $response = $this->get('/about-us');

        $response->assertStatus(200);
    }

    public function test_faq_page_loads(): void
    {
        $response = $this->get('/faq');

        $response->assertStatus(200);
    }

    public function test_services_page_loads(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    public function test_terms_page_loads(): void
    {
        $response = $this->get('/terms-and-conditions');

        $response->assertStatus(200);
    }

    public function test_compare_page_loads(): void
    {
        $response = $this->get('/compare');

        $response->assertStatus(200);
    }
}
