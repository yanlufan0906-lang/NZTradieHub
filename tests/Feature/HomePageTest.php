<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_exposes_the_primary_directory_actions(): void
    {
        $response = $this->get(route('home'));

        $response
            ->assertOk()
            ->assertViewIs('home')
            ->assertViewHas('heroImageUrl', fn ($url) => is_string($url) && str_ends_with($url, '.webp'))
            ->assertSee('Find Trusted Businesses')
            ->assertSee('fetchpriority="high"', false)
            ->assertSee('images/categories/builder.webp', false)
            ->assertSee('aria-controls="primaryNavigationActions"', false)
            ->assertSee('js/navigation.js', false)
            ->assertSee(route('businesses.index'), false)
            ->assertSee(route('businesses.register'), false);
    }
}
