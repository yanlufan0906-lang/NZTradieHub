<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $service = trim((string) $request->query('service', ''));
        $location = trim((string) $request->query('location', ''));
        $industry = $request->query('industry');
        $category = $request->query('category');

        $businesses = collect(config('demo-businesses'));
        $industries = config('industries');

        if ($service !== '') {
            $businesses = $businesses->filter(function ($business) use ($service) {
                return $this->containsSearchText($business, $service, [
                    'name',
                    'industry',
                    'category',
                    'description',
                    'services',
                    'tags',
                ]);
            });
        }

        if ($location !== '') {
            $businesses = $businesses->filter(function ($business) use ($location) {
                return $this->containsSearchText($business, $location, [
                    'location',
                    'service_areas',
                ]);
            });
        }

        if ($industry) {
            $businesses = $businesses->filter(function ($business) use ($industry) {
                return $business['industry'] === $industry;
            });
        }

        if ($category) {
            $businesses = $businesses->filter(function ($business) use ($category) {
                return $business['category'] === $category;
            });
        }

        $businesses = $businesses->values();
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $businesses = new LengthAwarePaginator(
            $businesses->forPage($currentPage, $perPage)->values(),
            $businesses->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->except('page'),
                'fragment' => 'business-results',
            ],
        );

        return view('businesses.index', [
            'businesses' => $businesses,
            'industries' => $industries,
            'service' => $service,
            'location' => $location,
            'selectedIndustry' => $industry,
            'selectedCategory' => $category,
        ]);
    }

    public function show(string $slug)
    {
        $business = collect(config('demo-businesses'))->first(function ($business) use ($slug) {
            return Str::slug($business['name']) === $slug;
        });

        abort_if(! $business, 404);

        return view('businesses.show', [
            'business' => $business,
            'slug' => $slug,
            'industries' => config('industries'),
            'businessCount' => count(config('demo-businesses')),
        ]);
    }

    public function contact(string $slug)
    {
        $business = collect(config('demo-businesses'))->first(function ($business) use ($slug) {
            return Str::slug($business['name']) === $slug;
        });

        abort_if(! $business, 404);

        return view('businesses.contact', [
            'business' => $business,
            'slug' => $slug,
        ]);
    }

    public function register()
    {
        return view('businesses.register');
    }

    public function storeRegistration(Request $request)
    {
        return view('static.submitted', [
            'title' => 'Business registration is handled separately',
            'message' => 'Thank you. Please contact our team to discuss business listing options.',
        ]);
    }

    private function containsSearchText(array $business, string $term, array $fields): bool
    {
        $haystack = collect($fields)
            ->flatMap(function ($field) use ($business) {
                $value = $business[$field] ?? '';

                return is_array($value) ? $value : [$value];
            })
            ->implode(' ');

        return str_contains(Str::lower($haystack), Str::lower($term));
    }
}
