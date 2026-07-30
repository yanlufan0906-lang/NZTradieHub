<?php

namespace Tests\Feature;

use Tests\TestCase;

class PrivacyPageTest extends TestCase
{
    public function test_privacy_page_is_available_and_linked_from_the_footer(): void
    {
        $response = $this->get(route('pages.show', 'privacy'));

        $response
            ->assertOk()
            ->assertViewIs('static.privacy')
            ->assertSee('Privacy Policy')
            ->assertSee('30 July 2026')
            ->assertSee('css/privacy.css', false)
            ->assertSee('href="'.route('pages.show', 'privacy').'"', false)
            ->assertSee('AI-assisted job descriptions')
            ->assertSee(route('contact.create'), false);
    }
}
