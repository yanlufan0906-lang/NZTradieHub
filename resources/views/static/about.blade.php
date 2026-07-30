@extends('layouts.app', [
    'title' => 'About Us | New Zealand Businesses',
    'description' => 'Learn how New Zealand Businesses helps customers discover local services and helps businesses connect with people who need their expertise.',
    'bodyClass' => 'about-page',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <main>
        <section class="about-hero" aria-labelledby="about-title">
            <div class="about-shell about-hero__grid">
                <div class="about-hero__content">
                    <span class="about-eyebrow">About New Zealand Businesses</span>
                    <h1 id="about-title">Local expertise, easier to find.</h1>
                    <p>We bring customers and New Zealand service providers together in one straightforward place—so finding the right help feels simpler and local businesses have more opportunities to be discovered.</p>

                    <div class="about-hero__actions">
                        <a href="{{ route('businesses.index') }}" class="about-button about-button--primary">Browse Businesses</a>
                        <a href="{{ route('businesses.register') }}" class="about-button about-button--secondary">List Your Business</a>
                    </div>
                </div>

                <div class="about-hero__visual">
                    <img
                        src="{{ asset('images/hero/hero-7.webp') }}"
                        alt="A tradesperson working on a home renovation"
                        width="1920"
                        height="1280"
                    >
                    <div class="about-hero__note">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 7 9 18l-5-5"></path>
                        </svg>
                        <span>Built around local connections</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-mission" aria-labelledby="mission-title">
            <div class="about-shell about-mission__grid">
                <div>
                    <span class="about-eyebrow">Our purpose</span>
                    <h2 id="mission-title">Making local business discovery clear and convenient</h2>
                </div>
                <div class="about-mission__copy">
                    <p>Finding a reliable professional should not mean searching across dozens of places. Our directory helps people explore services, review business information, and take the next step from one simple platform.</p>
                    <p>For local businesses, it provides a focused place to present their services and connect with customers already looking for help.</p>
                </div>
            </div>
        </section>

        <section class="about-audiences" aria-labelledby="audiences-title">
            <div class="about-shell">
                <header class="about-section-heading">
                    <span class="about-eyebrow">Who we support</span>
                    <h2 id="audiences-title">One platform, two simple journeys</h2>
                    <p>Whether you need a job done or want your business to be found, the path forward is designed to be clear.</p>
                </header>

                <div class="about-audiences__grid">
                    <article class="about-audience-card">
                        <div class="about-audience-card__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M3 11.5 12 4l9 7.5"></path>
                                <path d="M5.5 10v10h13V10M9 20v-6h6v6"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="about-audience-card__label">For customers</span>
                            <h3>Find the right local help</h3>
                            <p>Search by service and location, explore business profiles, and request a quote when you are ready.</p>
                            <a href="{{ route('businesses.index') }}">Start your search <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </article>

                    <article class="about-audience-card about-audience-card--blue">
                        <div class="about-audience-card__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 21V8l8-5 8 5v13"></path>
                                <path d="M2 21h20M8 11h2m4 0h2m-8 4h2m4 0h2"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="about-audience-card__label">For businesses</span>
                            <h3>Be visible when customers need you</h3>
                            <p>Create a listing that explains what you do, where you work, and how potential customers can reach you.</p>
                            <a href="{{ route('businesses.register') }}">Create your listing <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="about-values" aria-labelledby="values-title">
            <div class="about-shell">
                <header class="about-section-heading about-section-heading--light">
                    <span class="about-eyebrow">What guides us</span>
                    <h2 id="values-title">Designed for useful local connections</h2>
                </header>

                <div class="about-values__grid">
                    <article class="about-value">
                        <span>01</span>
                        <h3>Keep it simple</h3>
                        <p>Clear search, useful business information, and direct next steps without unnecessary complexity.</p>
                    </article>
                    <article class="about-value">
                        <span>02</span>
                        <h3>Support local</h3>
                        <p>Help New Zealand businesses become more visible to the people looking for their skills.</p>
                    </article>
                    <article class="about-value">
                        <span>03</span>
                        <h3>Build confidence</h3>
                        <p>Give customers practical details so they can compare options and make informed choices.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="about-cta">
            <div class="about-shell about-cta__inner">
                <div>
                    <span class="about-eyebrow">Ready to get started?</span>
                    <h2>Find a business or put yours on the map.</h2>
                </div>
                <div class="about-cta__actions">
                    <a href="{{ route('businesses.index') }}" class="about-button about-button--primary">Explore the Directory</a>
                    <a href="{{ route('contact.create') }}" class="about-button about-button--secondary">Contact Us</a>
                </div>
            </div>
        </section>
    </main>
@endsection
