<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_form_requires_a_selected_business(): void
    {
        $this->get(route('quote.create'))
            ->assertRedirect(route('businesses.index'));

        $business = config('demo-businesses.0');

        $this->get(route('quote.create', ['business' => $business['name']]))
            ->assertOk()
            ->assertViewIs('quotes.create')
            ->assertSee('class="navbar"', false)
            ->assertSee($business['name']);
    }

    public function test_quote_request_rejects_invalid_contact_details(): void
    {
        $response = $this->post(route('quote.store'), [
            'customer_name' => 'Test Customer',
            'email' => 'invalid-email',
            'phone' => '123',
            'service' => 'Plumbing',
            'location' => 'Auckland',
            'preferred_business' => 'Auckland Plumbing Experts',
            'description' => 'A leaking pipe needs to be repaired.',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'Enter valid email address',
            'phone' => 'Enter valid phone number',
        ]);

        $this->assertDatabaseCount('quote_requests', 0);
    }

    public function test_valid_quote_request_is_persisted_with_a_reference_number(): void
    {
        $response = $this->post(route('quote.store'), [
            'customer_name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '+64 21 123 4567',
            'service' => 'Plumbing',
            'location' => 'Auckland',
            'preferred_business' => 'Auckland Plumbing Experts',
            'description' => 'A leaking pipe needs to be repaired.',
            'budget' => '$500 - $1,000',
        ]);

        $response
            ->assertOk()
            ->assertViewIs('static.submitted')
            ->assertSee('QR-00001');

        $this->assertDatabaseHas('quote_requests', [
            'customer_name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '+64 21 123 4567',
            'preferred_business' => 'Auckland Plumbing Experts',
            'status' => 'new',
        ]);
    }
}
