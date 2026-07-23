<?php

namespace Tests\Feature;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class BusinessDirectoryTest extends TestCase
{
    public function test_directory_combines_service_location_industry_and_category_filters(): void
    {
        $response = $this->get(route('businesses.index', [
            'service' => 'EV CHARGER',
            'location' => 'lower hutt',
            'industry' => 'Construction & Trades',
            'category' => 'Electrical',
        ]));

        $response
            ->assertOk()
            ->assertViewHas('businesses', function (Collection $businesses): bool {
                return $businesses->count() === 1
                    && $businesses->first()['name'] === 'Wellington Power Pros';
            })
            ->assertSee('Wellington Power Pros');
    }

    public function test_directory_displays_an_empty_state_when_no_business_matches(): void
    {
        $response = $this->get(route('businesses.index', [
            'service' => 'service-that-does-not-exist',
        ]));

        $response
            ->assertOk()
            ->assertViewHas('businesses', fn (Collection $businesses): bool => $businesses->isEmpty())
            ->assertSee('No businesses found');
    }

    public function test_directory_heading_displays_the_selected_category(): void
    {
        $this->get(route('businesses.index', ['category' => 'Electrical']))
            ->assertOk()
            ->assertSee('<strong>Electrical</strong>', false)
            ->assertDontSee('<strong>all services</strong>', false);
    }

    public function test_business_profiles_resolve_known_slugs_and_reject_unknown_slugs(): void
    {
        $business = config('demo-businesses.0');

        $this->get(route('businesses.show', Str::slug($business['name'])))
            ->assertOk()
            ->assertViewIs('businesses.show')
            ->assertSee($business['name'])
            ->assertSee('Search businesses')
            ->assertSee('Apply Filters')
            ->assertSee('Contact me')
            ->assertDontSee('Email Business')
            ->assertSee(route('businesses.contact', Str::slug($business['name'])), false);

        $this->get(route('businesses.show', 'business-that-does-not-exist'))
            ->assertNotFound();
    }

    public function test_business_contact_page_is_design_only_and_resolves_known_businesses(): void
    {
        $business = config('demo-businesses.0');
        $slug = Str::slug($business['name']);

        $this->get(route('businesses.contact', $slug))
            ->assertOk()
            ->assertViewIs('businesses.contact')
            ->assertSee('Contact ' . $business['name'])
            ->assertSee('data-business-contact-form', false)
            ->assertSee('Send Message')
            ->assertDontSee('method="POST"', false)
            ->assertDontSee('mailto:', false);

        $this->get(route('businesses.contact', 'business-that-does-not-exist'))
            ->assertNotFound();
    }
}
