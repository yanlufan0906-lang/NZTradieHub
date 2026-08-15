<?php

namespace Tests\Feature;

use Illuminate\Pagination\LengthAwarePaginator;
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
            ->assertViewHas('businesses', function (LengthAwarePaginator $businesses): bool {
                return $businesses->total() === 1
                    && $businesses->getCollection()->first()['name'] === 'Wellington Power Pros';
            })
            ->assertSee('Wellington Power Pros')
            ->assertSee('data-business-card', false)
            ->assertSee('Popular services');
    }

    public function test_directory_displays_an_empty_state_when_no_business_matches(): void
    {
        $response = $this->get(route('businesses.index', [
            'service' => 'service-that-does-not-exist',
        ]));

        $response
            ->assertOk()
            ->assertViewHas('businesses', fn (LengthAwarePaginator $businesses): bool => $businesses->getCollection()->isEmpty())
            ->assertSee('No businesses found');
    }

    public function test_directory_paginates_six_businesses_at_a_time(): void
    {
        $firstPage = $this->get(route('businesses.index'));

        $firstPage
            ->assertOk()
            ->assertViewHas('businesses', function (LengthAwarePaginator $businesses): bool {
                return $businesses->perPage() === 6
                    && $businesses->currentPage() === 1
                    && $businesses->count() === 6
                    && $businesses->total() === count(config('demo-businesses'))
                    && $businesses->lastPage() === (int) ceil(count(config('demo-businesses')) / 6);
            })
            ->assertSee('Business directory pages')
            ->assertSee('Go to page 2')
            ->assertSee('Go to page 5')
            ->assertDontSee('Go to page 6')
            ->assertSee(config('demo-businesses.0.name'))
            ->assertDontSee(config('demo-businesses.6.name'));

        $this->get(route('businesses.index', ['page' => 2]))
            ->assertOk()
            ->assertSee(config('demo-businesses.6.name'))
            ->assertDontSee(config('demo-businesses.0.name'));
    }

    public function test_directory_pagination_uses_a_five_page_sliding_window(): void
    {
        $this->get(route('businesses.index', ['page' => 6]))
            ->assertOk()
            ->assertSee('Go to page 4')
            ->assertSee('Go to page 5')
            ->assertSee('Current page, page 6')
            ->assertSee('Go to page 7')
            ->assertSee('Go to page 8')
            ->assertDontSee('Go to page 3')
            ->assertDontSee('Go to page 9')
            ->assertSee('rel="prev"', false)
            ->assertSee('rel="next"', false);

        $lastPage = (int) ceil(count(config('demo-businesses')) / 6);

        $this->get(route('businesses.index', ['page' => $lastPage]))
            ->assertOk()
            ->assertSee('Go to page '.($lastPage - 4))
            ->assertSee('Current page, page '.$lastPage)
            ->assertDontSee('Go to page '.($lastPage - 5));
    }

    public function test_directory_pagination_preserves_active_filters(): void
    {
        $response = $this->get(route('businesses.index', [
            'industry' => 'Construction & Trades',
        ]));

        $response
            ->assertOk()
            ->assertViewHas('businesses', function (LengthAwarePaginator $businesses): bool {
                parse_str((string) parse_url($businesses->url(2), PHP_URL_QUERY), $query);

                $industryTotal = collect(config('demo-businesses'))
                    ->where('industry', 'Construction & Trades')
                    ->count();

                return $businesses->total() === $industryTotal
                    && $businesses->lastPage() === (int) ceil($industryTotal / 6)
                    && ($query['industry'] ?? null) === 'Construction & Trades'
                    && (int) ($query['page'] ?? 0) === 2;
            });
    }

    public function test_demo_businesses_cover_every_configured_service_category(): void
    {
        $configuredCategories = collect(config('industries'))
            ->flatten()
            ->sort()
            ->values();

        $businesses = collect(config('demo-businesses'));
        $representedCategories = $businesses
            ->pluck('category')
            ->unique()
            ->sort()
            ->values();

        $this->assertEquals($configuredCategories, $representedCategories);
        $this->assertCount($businesses->count(), $businesses->pluck('name')->unique());
        $this->assertCount($businesses->count(), $businesses->map(fn (array $business): string => Str::slug($business['name']))->unique());

        foreach ($businesses as $business) {
            $this->assertContains($business['category'], config('industries.'.$business['industry']));
        }
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
            ->assertSee('data-business-profile', false)
            ->assertSee('About this business')
            ->assertSee('Business rating')
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
            ->assertSee('Contact '.$business['name'])
            ->assertSee('data-business-contact-form', false)
            ->assertSee('Send Message')
            ->assertDontSee('method="POST"', false)
            ->assertDontSee('mailto:', false);

        $this->get(route('businesses.contact', 'business-that-does-not-exist'))
            ->assertNotFound();
    }
}
