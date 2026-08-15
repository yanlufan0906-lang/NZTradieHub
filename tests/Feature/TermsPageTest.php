<?php

namespace Tests\Feature;

use Tests\TestCase;

class TermsPageTest extends TestCase
{
    public function test_terms_page_is_available_and_linked_from_the_footer(): void
    {
        $response = $this->get(route('pages.show', 'terms'));

        $response
            ->assertOk()
            ->assertViewIs('static.terms')
            ->assertSee('Terms &amp; Conditions', false)
            ->assertSee('15 August 2026')
            ->assertSee('css/terms.css', false)
            ->assertSee('Current prototype and demonstration features')
            ->assertSee(route('pages.show', 'privacy'), false)
            ->assertSee(route('pages.show', 'terms'), false)
            ->assertSee(route('contact.create'), false);
    }

    public function test_business_registration_terms_references_are_linked(): void
    {
        $response = $this->get(route('businesses.register'));
        $termsLink = 'href="'.route('pages.show', 'terms').'" target="_blank" rel="noopener noreferrer"';

        $response->assertOk();
        $this->assertSame(2, substr_count($response->getContent(), $termsLink));
    }
}
