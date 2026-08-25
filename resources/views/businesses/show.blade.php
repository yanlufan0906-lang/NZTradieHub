@extends('layouts.app', ['title' => $business['name']])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/directory.css') }}">
@endpush

@section('content')
    <main class="page-container">
        <x-business-directory-search
            :industries="$industries"
            :business-count="$businessCount"
        />

        <div class="profile-page-shell">
            <a href="{{ url()->previous() }}" class="back-link profile-back-link">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                Back to results
            </a>

            <section class="profile-card business-profile-card" data-business-profile>
                <header class="business-profile-hero">
                    <div class="business-profile-identity">
                        <div class="business-profile-avatar" aria-hidden="true">
                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($business['name'], 0, 1)) }}
                        </div>

                        <div class="business-profile-heading">
                            <div class="business-profile-badges">
                                <span class="business-profile-industry">{{ $business['industry'] }}</span>
                                <span class="business-profile-verified">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="m7.5 12 3 3 6-6"></path>
                                        <path d="M12 3.5 14.1 5l2.6-.1.8 2.5 2.2 1.4-.9 2.5.9 2.5-2.2 1.4-.8 2.5-2.6-.1L12 19.5l-2.1-1.9-2.6.1-.8-2.5-2.2-1.4.9-2.5-.9-2.5 2.2-1.4.8-2.5 2.6.1L12 3.5Z"></path>
                                    </svg>
                                    Verified business
                                </span>
                            </div>

                            <h1>{{ $business['name'] }}</h1>

                            <div class="business-profile-meta">
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
                            </div>
                        </div>
                    </div>

                    @if(! empty($business['rating']))
                        <div class="business-profile-rating">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z"></path>
                            </svg>
                            <div>
                                <strong>{{ number_format($business['rating'], 1) }}</strong>
                                <span>Business rating</span>
                            </div>
                        </div>
                    @endif
                </header>

                <div class="business-profile-body">
                    <section class="business-profile-about" aria-labelledby="business-about-title">
                        <span class="business-profile-section-label">Business overview</span>
                        <h2 id="business-about-title">About this business</h2>
                        <p class="profile-description">{{ $business['description'] }}</p>
                    </section>

                    <div class="profile-info-grid business-profile-facts">
                        <div class="business-profile-fact">
                            <span class="business-profile-fact__icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M7 3h3l1.5 4-2 1.5a15 15 0 0 0 6 6l1.5-2 4 1.5v3c0 2.2-1.8 4-4 4C9.3 21 3 14.7 3 7c0-2.2 1.8-4 4-4Z"></path>
                                </svg>
                            </span>
                            <div>
                                <strong>Phone</strong>
                                <p>{{ $business['phone'] }}</p>
                            </div>
                        </div>

                        <div class="business-profile-fact">
                            <span class="business-profile-fact__icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M3 5h18v14H3z"></path>
                                    <path d="m4 7 8 6 8-6"></path>
                                </svg>
                            </span>
                            <div>
                                <strong>Email</strong>
                                <p>{{ $business['email'] }}</p>
                            </div>
                        </div>

                        @if(! empty($business['jobs_completed']))
                            <div class="business-profile-fact">
                                <span class="business-profile-fact__icon">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M4 7h16v13H4zM9 7V4h6v3"></path>
                                        <path d="m8 14 2.5 2.5L16 11"></path>
                                    </svg>
                                </span>
                                <div>
                                    <strong>Jobs completed</strong>
                                    <p>{{ $business['jobs_completed'] }} jobs</p>
                                </div>
                            </div>
                        @endif

                        @if(! empty($business['response_time']))
                            <div class="business-profile-fact">
                                <span class="business-profile-fact__icon">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M12 7v5l3 2"></path>
                                    </svg>
                                </span>
                                <div>
                                    <strong>Response time</strong>
                                    <p>{{ $business['response_time'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="business-profile-details">
                        @if(! empty($business['services']))
                            <section class="business-profile-detail-panel" aria-labelledby="business-services-title">
                                <div class="business-profile-detail-heading">
                                    <span class="business-profile-detail-icon">
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M14.5 6.5a4 4 0 0 0-5-5l2.2 2.2-2.8 2.8-2.2-2.2a4 4 0 0 0 5 5L20 17.6 17.6 20l-8.3-8.3"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <span>What they offer</span>
                                        <h2 id="business-services-title">Services</h2>
                                    </div>
                                </div>
                                <div class="tag-row profile-tags business-profile-tags">
                                    @foreach($business['services'] as $item)
                                        <span>{{ $item }}</span>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if(! empty($business['service_areas']))
                            <section class="business-profile-detail-panel" aria-labelledby="business-areas-title">
                                <div class="business-profile-detail-heading">
                                    <span class="business-profile-detail-icon">
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                            <circle cx="12" cy="10" r="2.5"></circle>
                                        </svg>
                                    </span>
                                    <div>
                                        <span>Where they work</span>
                                        <h2 id="business-areas-title">Service areas</h2>
                                    </div>
                                </div>
                                <div class="tag-row profile-tags business-profile-tags business-profile-tags--areas">
                                    @foreach($business['service_areas'] as $area)
                                        <span>{{ $area }}</span>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                </div>

                <footer class="business-profile-cta">
                    <div class="business-profile-cta__copy">
                        <span>Ready to get started?</span>
                        <h2>Discuss your job with {{ $business['name'] }}</h2>
                        <p>Share the job details, location, and preferred timing to prepare a clearer enquiry.</p>
                    </div>
                    <div class="profile-actions business-profile-actions">
                        <a href="{{ route('quote.create', ['business' => $business['name'], 'service' => $business['category'], 'location' => $business['location']]) }}" class="get-quote-btn">Request a Quote</a>
                        <a href="{{ route('businesses.contact', $slug) }}" class="view-profile-btn">Contact me</a>
                    </div>
                </footer>
            </section>
        </div>
    </main>
@endsection
