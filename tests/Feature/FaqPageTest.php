<?php

namespace Tests\Feature;

use Tests\TestCase;

class FaqPageTest extends TestCase
{
    public function test_customer_faq_page_is_available_and_linked_from_the_footer(): void
    {
        $response = $this->get(route('pages.show', 'customer-faq'));

        $response
            ->assertOk()
            ->assertViewIs('static.customer-faq')
            ->assertSee('Customer frequently asked questions')
            ->assertSee('How do I request a quote?')
            ->assertSee(asset('js/faq.js'), false)
            ->assertSee(route('pages.show', 'customer-faq'), false);
    }

    public function test_business_faq_page_is_available_and_linked_from_the_footer(): void
    {
        $response = $this->get(route('pages.show', 'business-faq'));

        $response
            ->assertOk()
            ->assertViewIs('static.business-faq')
            ->assertSee('Business frequently asked questions')
            ->assertSee('How do I list my business?')
            ->assertSee(asset('js/faq.js'), false)
            ->assertSee(route('pages.show', 'business-faq'), false);
    }
}
