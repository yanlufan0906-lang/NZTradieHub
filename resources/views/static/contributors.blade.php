@extends('layouts.app', [
    'title' => 'Contributors | New Zealand Businesses',
    'description' => 'Meet the people who contribute to New Zealand Businesses.',
    'bodyClass' => 'contributors-page',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contributors.css') }}">
@endpush

@section('content')
    <main>
        <section class="contributors-hero" aria-labelledby="contributors-title">
            <div class="contributors-hero__inner">
                <span class="contributors-badge">Our Contributors</span>
                <h1 id="contributors-title">Meet the people behind the project</h1>
                <p>Our contributors bring their skills, ideas, and experience together to help New Zealanders connect with trusted local businesses.</p>
            </div>
        </section>

        <section class="contributors-section" aria-label="Project contributors">
            <div class="contributors-grid">
                @forelse($contributors as $contributor)
                    <article class="contributor-card">
                        @if($contributor['photo'])
                            <img
                                class="contributor-photo"
                                src="{{ asset($contributor['photo']) }}"
                                alt="{{ $contributor['name'] }}"
                                width="640"
                                height="480"
                                loading="lazy"
                            >
                        @else
                            <div class="contributor-photo contributor-photo--empty" aria-hidden="true"></div>
                        @endif

                        <div class="contributor-card__content">
                            <span class="contributor-role">{{ $contributor['role'] }}</span>
                            <h2>{{ $contributor['name'] }}</h2>
                            <p>{{ $contributor['bio'] }}</p>
                        </div>
                    </article>
                @empty
                    <p class="contributors-empty">Contributor profiles will be added soon.</p>
                @endforelse
            </div>
        </section>
    </main>
@endsection
