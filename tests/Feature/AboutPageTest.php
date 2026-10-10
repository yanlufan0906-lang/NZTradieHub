<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function test_about_page_is_available_and_linked_from_the_footer(): void
    {
        $response = $this->get(route('pages.show', 'about'));

        $response
            ->assertOk()
            ->assertViewIs('static.about')
            ->assertSee('Local expertise, easier to find.')
            ->assertSee('css/about.css', false)
            ->assertSee('href="'.route('pages.show', 'about').'"', false)
            ->assertSee(route('businesses.index'), false)
            ->assertSee(route('businesses.register'), false);
    }
}
