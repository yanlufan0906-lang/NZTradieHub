<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContributorsPageTest extends TestCase
{
    public function test_contributors_page_displays_dummy_profiles_with_empty_photo_spaces(): void
    {
        $response = $this->get(route('contributors.index'));

        $response
            ->assertOk()
            ->assertViewIs('static.contributors')
            ->assertViewHas('contributors', fn (array $contributors) => count($contributors) === 6)
            ->assertSee('Meet the people behind the project')
            ->assertSee('css/contributors.css', false)
            ->assertSee('href="'.route('contributors.index').'"', false);

        $this->assertSame(6, substr_count($response->getContent(), 'class="contributor-card"'));
        $this->assertSame(6, substr_count($response->getContent(), 'contributor-photo--empty'));
    }
}
