<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_message_requires_valid_required_fields(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_valid_contact_message_is_persisted_with_a_reference_number(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => null,
            'subject' => 'Directory question',
            'message' => 'Please provide more information about business listings.',
        ]);

        $response
            ->assertOk()
            ->assertViewIs('static.submitted')
            ->assertSee('CM-00001');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => null,
            'subject' => 'Directory question',
            'status' => 'new',
        ]);
    }
}
