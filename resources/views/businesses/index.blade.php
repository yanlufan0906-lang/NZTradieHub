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

                <article class="business-card business-directory-card" data-business-card aria-labelledby="business-card-title-{{ $loop->index }}">
                    <header class="business-card-header">
                        <div class="business-card-identity">
                            <div class="business-card-avatar" aria-hidden="true">
                                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($business['name'], 0, 1)) }}
                            </div>

                            <div class="business-card-heading">
                                <span class="business-industry">{{ $business['industry'] }}</span>
                                <h2 id="business-card-title-{{ $loop->index }}">{{ $business['name'] }}</h2>
                            </div>
                        </div>

                        <span class="verified-badge">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m7.5 12 3 3 6-6"></path>
                                <path d="M12 3.5 14.1 5l2.6-.1.8 2.5 2.2 1.4-.9 2.5.9 2.5-2.2 1.4-.8 2.5-2.6-.1L12 19.5l-2.1-1.9-2.6.1-.8-2.5-2.2-1.4.9-2.5-.9-2.5 2.2-1.4.8-2.5 2.6.1L12 3.5Z"></path>
                            </svg>
                            Verified
                        </span>
                    </header>

                    <div class="business-meta business-card-meta">
                        <span>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 7h16v12H4zM8 7V5h8v2"></path>
                            </svg>
                            {{ $business['category'] }}
                        </span>
                        <span>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="2.5"></circle>
                            </svg>
                            {{ $business['location'] }}
                        </span>
                        @if(! empty($business['rating']))
                            <span class="business-card-rating">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z"></path>
                                </svg>
                                {{ number_format($business['rating'], 1) }}
                            </span>
                        @endif
                    </div>

                    <p class="business-description">
                        {{ $business['description'] }}
                    </p>

                    @if(! empty($business['services']))
                        <section class="business-card-services" aria-label="Popular services">
                            <span class="business-card-label">Popular services</span>
                            <div class="tag-row business-card-tags">
                                @foreach(array_slice($business['services'], 0, 4) as $item)
                                    <span>{{ $item }}</span>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @if(! empty($business['service_areas']))
                        <div class="business-card-coverage">
                            <span class="business-card-coverage__icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="2.5"></circle>
                                </svg>
                            </span>
                            <div>
                                <strong>Service areas</strong>
                                <p>{{ implode(', ', array_slice($business['service_areas'], 0, 5)) }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="business-contact business-card-contact">
                        <div>
                            <span class="business-card-contact__icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M7 3h3l1.5 4-2 1.5a15 15 0 0 0 6 6l1.5-2 4 1.5v3c0 2.2-1.8 4-4 4C9.3 21 3 14.7 3 7c0-2.2 1.8-4 4-4Z"></path>
                                </svg>
                            </span>
                            <span>
                                <strong>Phone</strong>
                                {{ $business['phone'] }}
                            </span>
                        </div>

                        <div>
                            <span class="business-card-contact__icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M3 5h18v14H3z"></path>
                                    <path d="m4 7 8 6 8-6"></path>
                                </svg>
                            </span>
                            <span>
                                <strong>Email</strong>
                                {{ $business['email'] }}
                            </span>
                        </div>
                    </div>

                    <footer class="business-actions business-card-actions">
                        <a href="{{ route('businesses.show', $slug) }}" class="view-profile-btn">
                            View Profile
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>

                        <a href="{{ route('quote.create', ['business' => $business['name'], 'service' => $business['category'], 'location' => $business['location']]) }}" class="get-quote-btn">
                            Get Quotation
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M5 12h14m-5-5 5 5-5 5"></path>
                            </svg>
                        </a>
                    </footer>
                </article>
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
