<?php

namespace Tests\Feature;

use Tests\TestCase;

class PrototypePagesTest extends TestCase
{
    public function test_registration_page_is_explicitly_a_non_persistent_prototype(): void
    {
        $response = $this->get(route('businesses.register'));

        $response
            ->assertOk()
            ->assertSee('Tradesperson Registration')
            ->assertSee('action="#"', false)
            ->assertDontSee('class="nav-btn business-btn">List Your Business</a>', false)
            ->assertSee('Complete Registration');

        $this->post(route('businesses.register.store'))
            ->assertOk()
            ->assertSee('Business registration is handled separately');
    }

    public function test_login_page_has_no_authentication_submission_endpoint(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Login to your Trady account')
            ->assertSee('action="#"', false)
            ->assertSee('type="button"', false);

        $this->post('/login')->assertMethodNotAllowed();
    }
}
