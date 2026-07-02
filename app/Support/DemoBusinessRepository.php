<?php

namespace App\Support;

use App\Models\BusinessProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;

class DemoBusinessRepository
{
    public static function all(): Collection
    {
        $sessionBusinesses = collect(session('registered_businesses', []));
        $databaseBusinesses = self::databaseBusinesses();
        $seededBusinesses = collect(config('demo-businesses', []));

        return $sessionBusinesses
            ->merge($databaseBusinesses)
            ->merge($seededBusinesses)
            ->unique(fn ($business) => Str::slug($business['name'] ?? ''))
            ->values();
    }

    public static function findBySlug(string $slug): ?array
    {
        return self::all()->first(function ($business) use ($slug) {
            return Str::slug($business['name'] ?? '') === $slug;
        });
    }

    public static function findByName(string $name): ?array
    {
        return self::all()->first(function ($business) use ($name) {
            return ($business['name'] ?? '') === $name;
        });
    }

    private static function databaseBusinesses(): Collection
    {
        try {
            return BusinessProfile::query()
                ->latest()
                ->get()
                ->map(function (BusinessProfile $business) {
                    return [
                        'name' => $business->name,
                        'industry' => $business->industry,
                        'category' => $business->category,
                        'location' => $business->location,
                        'service_areas' => $business->service_areas ?? [],
                        'description' => $business->description,
                        'services' => $business->services ?? [],
                        'tags' => $business->tags ?? [],
                        'phone' => $business->phone,
                        'email' => $business->email,
                        'rating' => $business->rating,
                        'jobs_completed' => $business->jobs_completed,
                        'response_time' => $business->response_time,
                        'logo_url' => $business->logo_url,
                        'cover_url' => $business->cover_url,
                        'is_database_listing' => true,
                    ];
                });
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }
}
