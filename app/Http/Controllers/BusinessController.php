<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use App\Models\User;
use App\Support\DemoBusinessRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $service = trim((string) $request->query('service', ''));
        $location = trim((string) $request->query('location', ''));
        $industry = $request->query('industry');
        $category = $request->query('category');

        $businesses = DemoBusinessRepository::all();
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
                return ($business['industry'] ?? '') === $industry;
            });
        }

        if ($category) {
            $businesses = $businesses->filter(function ($business) use ($category) {
                return ($business['category'] ?? '') === $category;
            });
        }

        return view('businesses.index', [
            'businesses' => $businesses->values(),
            'industries' => $industries,
            'service' => $service,
            'location' => $location,
            'selectedIndustry' => $industry,
            'selectedCategory' => $category,
        ]);
    }

    public function show(string $slug)
    {
        $business = DemoBusinessRepository::findBySlug($slug);

        abort_if(! $business, 404);

        return view('businesses.show', [
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
        $data = $request->validate([
            'FirstName' => ['required', 'string', 'max:80'],
            'LastName' => ['required', 'string', 'max:80'],
            'Email' => ['required', 'email', 'max:120'],
            'PhoneNumber' => ['required', 'string', 'max:40'],
            'password' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'same:password'],
            'accountTermsConditions' => ['accepted'],
            'BusinessName' => ['required', 'string', 'max:150'],
            'NZBN' => ['required', 'digits:13'],
            'BusinessAddress' => ['required', 'string', 'max:220'],
            'businessType' => ['nullable', 'string', 'max:60'],
            'industryCategory' => ['required', 'string', 'max:100'],
            'primaryService' => ['required', 'string', 'max:100'],
            'yearsOfExperience' => ['required', 'string', 'max:60'],
            'teamSize' => ['nullable', 'string', 'max:60'],
            'availability' => ['required', 'string', 'max:80'],
            'emergencyServices' => ['nullable', 'string', 'max:10'],
            'serviceDescription' => ['required', 'string', 'max:1500'],
            'primaryServiceLocation' => ['required', 'string', 'max:120'],
            'travelDistance' => ['required', 'string', 'max:60'],
            'areasServed' => ['required', 'string', 'max:500'],
            'serviceType' => ['required', 'string', 'max:60'],
            'travelCharges' => ['nullable', 'string', 'max:80'],
            'additionalLocationNotes' => ['nullable', 'string', 'max:1000'],
            'businessLogo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'coverPhoto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'businessTagline' => ['required', 'string', 'max:160'],
            'yearsInBusiness' => ['required', 'string', 'max:60'],
            'aboutBusiness' => ['required', 'string', 'max:1500'],
            'websiteUrl' => ['nullable', 'url', 'max:220'],
            'socialMediaUrl' => ['nullable', 'url', 'max:220'],
            'certificationsLicenses' => ['nullable', 'string', 'max:1000'],
            'insuranceStatus' => ['required', 'string', 'max:100'],
            'profileVisibility' => ['nullable'],
            'governmentId' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'tradeLicense' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'nzbnVerification' => ['nullable'],
            'insuranceConfirmation' => ['accepted'],
            'backgroundCheckConsent' => ['accepted'],
            'termsConditions' => ['accepted'],
            'marketingPreferences' => ['nullable'],
            'additionalVerificationNotes' => ['nullable', 'string', 'max:1000'],
        ]);

        $uploadedPaths = [];

        foreach (['businessLogo', 'coverPhoto', 'governmentId', 'tradeLicense'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $uploadedPaths[$fileField . 'Path'] = $this->saveDemoUpload($request, $fileField);
            }
        }

        [$industry, $category] = $this->mapIndustryCategory($data['industryCategory']);
        $primaryService = $this->labelFromSlug($data['primaryService']);
        $areasServed = $this->splitCsv($data['areasServed']);

        $businessProfile = [
            'name' => $data['BusinessName'],
            'industry' => $industry,
            'category' => $category,
            'location' => $data['primaryServiceLocation'],
            'service_areas' => $areasServed,
            'description' => $data['businessTagline'] . ' ' . $data['aboutBusiness'],
            'services' => array_values(array_unique([$category, $primaryService])),
            'tags' => array_values(array_unique([
                Str::lower($category),
                Str::lower($primaryService),
                Str::lower($data['BusinessName']),
                Str::lower($data['primaryServiceLocation']),
            ])),
            'phone' => $data['PhoneNumber'],
            'email' => $data['Email'],
            'rating' => 5.0,
            'jobs_completed' => 0,
            'response_time' => 'New listing - ready to receive leads',
            'logo_url' => $uploadedPaths['businessLogoPath'] ?? null,
            'cover_url' => $uploadedPaths['coverPhotoPath'] ?? null,
            'is_session_listing' => true,
        ];

        $registeredBusinesses = collect(session('registered_businesses', []))
            ->reject(fn ($business) => Str::slug($business['name'] ?? '') === Str::slug($businessProfile['name']))
            ->prepend($businessProfile)
            ->values()
            ->all();

        session(['registered_businesses' => $registeredBusinesses]);

        $databaseUser = $this->storeRegisteredAccountInDatabase($data, $businessProfile);

        $registeredUser = [
            'id' => $databaseUser?->id,
            'name' => trim($data['FirstName'] . ' ' . $data['LastName']),
            'email' => $data['Email'],
            'password' => $data['password'],
            'business' => $data['BusinessName'],
            'type' => 'business',
        ];

        $registeredUsers = collect(session('registered_demo_users', []))
            ->reject(fn ($user) => ($user['email'] ?? '') === $registeredUser['email'])
            ->prepend($registeredUser)
            ->values()
            ->all();

        session([
            'registered_demo_users' => $registeredUsers,
            'demo_user' => collect($registeredUser)->except('password')->all(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Registration complete. Welcome, ' . trim($data['FirstName'] . ' ' . $data['LastName']) . '.');
    }

    private function storeRegisteredAccountInDatabase(array $data, array $businessProfile): ?User
    {
        try {
            $user = User::updateOrCreate(
                ['email' => $data['Email']],
                [
                    'name' => trim($data['FirstName'] . ' ' . $data['LastName']),
                    'business_name' => $data['BusinessName'],
                    'password' => $data['password'],
                ]
            );

            BusinessProfile::updateOrCreate(
                ['name' => $businessProfile['name']],
                [
                    'user_id' => $user->id,
                    'industry' => $businessProfile['industry'],
                    'category' => $businessProfile['category'],
                    'location' => $businessProfile['location'],
                    'service_areas' => $businessProfile['service_areas'],
                    'description' => $businessProfile['description'],
                    'services' => $businessProfile['services'],
                    'tags' => $businessProfile['tags'],
                    'phone' => $businessProfile['phone'],
                    'email' => $businessProfile['email'],
                    'rating' => $businessProfile['rating'],
                    'jobs_completed' => $businessProfile['jobs_completed'],
                    'response_time' => $businessProfile['response_time'],
                    'logo_url' => $businessProfile['logo_url'],
                    'cover_url' => $businessProfile['cover_url'],
                ]
            );

            return $user;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
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

    private function saveDemoUpload(Request $request, string $field): string
    {
        $file = $request->file($field);
        $directory = public_path('uploads/business-registrations');

        if (! is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $filename = now()->format('YmdHis') . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'uploads/business-registrations/' . $filename;
    }

    private function mapIndustryCategory(string $value): array
    {
        return match ($value) {
            'plumbing' => ['Construction & Trades', 'Plumbing'],
            'electrical' => ['Construction & Trades', 'Electrical'],
            'painting' => ['Construction & Trades', 'Painting'],
            'roofing' => ['Construction & Trades', 'Roofing'],
            'hvac' => ['Construction & Trades', 'HVAC'],
            'landscaping' => ['Home Services', 'Landscaping'],
            'building-construction' => ['Construction & Trades', 'Renovations'],
            'handyman-services' => ['Home Services', 'Handyman Services'],
            default => ['Construction & Trades', $this->labelFromSlug($value)],
        };
    }

    private function labelFromSlug(string $value): string
    {
        return Str::of($value)->replace('-', ' ')->title()->toString();
    }

    private function splitCsv(string $value): array
    {
        return collect(explode(',', $value))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
