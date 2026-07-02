<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use App\Support\DemoBusinessRepository;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function create(Request $request)
    {
        $business = trim((string) $request->query('business', ''));
        $service = trim((string) $request->query('service', ''));
        $location = trim((string) $request->query('location', ''));

        $businesses = DemoBusinessRepository::all();
        $selectedBusinessName = old('preferred_business', $business);

        $selectedBusiness = $businesses->first(function ($item) use ($selectedBusinessName) {
            return ($item['name'] ?? '') === $selectedBusinessName;
        });

        return view('quotes.create', [
            'business' => $selectedBusinessName,
            'service' => old('service', $service ?: ($selectedBusiness['category'] ?? '')),
            'location' => old('location', $location ?: ($selectedBusiness['location'] ?? '')),
            'industries' => config('industries'),
            'businesses' => $businesses,
            'selectedBusiness' => $selectedBusiness,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'service' => ['required', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:120'],
            'preferred_business' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:1500'],
            'budget' => ['nullable', 'string', 'max:80'],
        ]);

        try {
            $quoteRequest = QuoteRequest::create($data);
            $reference = 'QR-' . str_pad((string) $quoteRequest->id, 5, '0', STR_PAD_LEFT);
        } catch (\Throwable $exception) {
            report($exception);
            $quoteRequest = (object) $data;
            $reference = 'QR-DEMO-' . now()->format('YmdHis');
        }

        $quoteForDashboard = array_merge($data, [
            'reference' => $reference,
            'created_at' => now()->format('d M Y, h:i A'),
        ]);

        $savedQuotes = collect(session('demo_quote_requests', []))
            ->prepend($quoteForDashboard)
            ->take(10)
            ->values()
            ->all();

        session(['demo_quote_requests' => $savedQuotes]);

        return view('static.submitted', [
            'title' => 'Quote request submitted',
            'message' => 'Thank you, ' . $quoteRequest->customer_name . '. Your quote request has been submitted. Reference number: ' . $reference . '.',
            'actions' => [
                ['label' => 'Back to Businesses', 'url' => route('businesses.index'), 'class' => 'view-profile-btn'],
                ['label' => 'Business Dashboard', 'url' => route('dashboard'), 'class' => 'get-quote-btn'],
            ],
        ]);
    }
}
