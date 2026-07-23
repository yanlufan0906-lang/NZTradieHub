@extends('layouts.app', ['title' => 'Business Listings'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/directory.css') }}">
@endpush

@section('content')
    <main class="page-container">
        <x-business-directory-search
            :industries="$industries"
            :service="$service"
            :location="$location"
            :selected-industry="$selectedIndustry"
            :selected-category="$selectedCategory"
            :business-count="$businesses->count()"
        />

        <div class="business-grid">
            @forelse($businesses as $business)
                @php($slug = \Illuminate\Support\Str::slug($business['name']))

                <div class="business-card">
                    <div class="business-top">
                        <div>
                            <span class="business-industry">
                                {{ $business['industry'] }}
                            </span>

                            <h2>{{ $business['name'] }}</h2>
                        </div>

                        <div class="verified-badge">
                            Verified
                        </div>
                    </div>

                    <div class="business-meta">
                        <span>{{ $business['category'] }}</span>
                        <span>📍 {{ $business['location'] }}</span>
                        @if(! empty($business['rating']))
                            <span>★ {{ number_format($business['rating'], 1) }}</span>
                        @endif
                    </div>

                    <p class="business-description">
                        {{ $business['description'] }}
                    </p>

                    @if(! empty($business['services']))
                        <div class="tag-row">
                            @foreach(array_slice($business['services'], 0, 4) as $item)
                                <span>{{ $item }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if(! empty($business['service_areas']))
                        <p class="area-line">
                            <strong>Service areas:</strong> {{ implode(', ', array_slice($business['service_areas'], 0, 5)) }}
                        </p>
                    @endif

                    <div class="business-contact">
                        <div>
                            <strong>Phone:</strong><br>
                            {{ $business['phone'] }}
                        </div>

                        <div>
                            <strong>Email:</strong><br>
                            {{ $business['email'] }}
                        </div>
                    </div>

                    <div class="business-actions">
                        <a href="{{ route('businesses.show', $slug) }}" class="view-profile-btn">
                            View Profile
                        </a>

                        <a href="{{ route('quote.create', ['business' => $business['name'], 'service' => $business['category'], 'location' => $business['location']]) }}" class="get-quote-btn">
                            Get Quotation
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h2>No businesses found</h2>
                    <p>Try a different service, category, or location.</p>
                    <div class="profile-actions">
                        <a href="{{ route('businesses.index') }}" class="view-profile-btn">Reset search</a>
                        <a href="{{ route('businesses.index') }}" class="get-quote-btn">View All Businesses</a>
                    </div>
                </div>
            @endforelse
        </div>
    </main>
@endsection
