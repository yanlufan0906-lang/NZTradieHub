<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Meet the people who contributed to the NZ Businesses platform.">
    <title>Who We Are | New Zealand Businesses</title>

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contributors.css') }}">
</head>
<body class="contributors-page">
    @include('partials.header')

    <main>
        <section class="contributors-hero">
            <div class="contributors-hero__inner">
                <div class="contributors-hero__content">
                    <span class="contributors-eyebrow">Who We Are</span>
                    <h1>The team behind NZ Businesses</h1>
                    <p>
                        NZ Businesses was delivered through a shared effort across leadership, people support,
                        project management, development, and quality assurance.
                    </p>
                </div>

            </div>
        </section>

        <section class="contributors-summary" aria-label="Team summary">
            <article class="summary-card">
                <span class="summary-card__label">Leadership</span>
                <h3>Business vision</h3>
                <p>Provided direction, requirements, and decision-making support to keep the platform aligned with company goals.</p>
            </article>
            <article class="summary-card">
                <span class="summary-card__label">Delivery</span>
                <h3>Project coordination</h3>
                <p>Managed planning, communication, and prioritisation so the project moved forward clearly and efficiently.</p>
            </article>
            <article class="summary-card">
                <span class="summary-card__label">Engineering</span>
                <h3>Build and quality</h3>
                <p>Delivered the interface, supported system integration, and reviewed user flows to improve overall quality.</p>
            </article>
        </section>

        <section class="contributors-section" aria-labelledby="contributors-heading">
            <div class="contributors-section__header">
                <span class="section-badge">Project Team</span>
                <h2 id="contributors-heading">Meet the contributors</h2>
                <p>Each card below shows who was involved in the project and how they contributed to the platform.</p>
            </div>

            <div class="contributors-grid" id="team-grid">
                @foreach($contributors as $contributor)
                    <article class="contributor-card">
                        <div class="contributor-card__accent"></div>
                        <div class="contributor-card__top">
                            <span class="contributor-group">{{ $contributor['group'] }}</span>
                        </div>

                        <div class="contributor-portrait">
                            <img src="{{ asset($contributor['avatar']) }}" alt="Cartoon portrait of {{ $contributor['name'] }}">
                        </div>

                        <div class="contributor-card__body">
                            <h3>{{ $contributor['name'] }}</h3>
                            <p class="contributor-role">{{ $contributor['role'] }}</p>
                            <div class="contributor-divider"></div>
                            <h4>Contribution</h4>
                            <p class="contributor-description">{{ $contributor['contribution'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="contributors-values" aria-labelledby="contributors-values-heading">
            <div class="contributors-values__header">
                <span class="section-badge">Working Style</span>
                <h2 id="contributors-values-heading">How the team delivered value</h2>
            </div>
            <div class="contributors-values__grid">
                <article class="value-card">
                    <h3>Direction</h3>
                    <p>Strong business input helped the platform stay focused on useful features and a practical user journey.</p>
                </article>
                <article class="value-card">
                    <h3>Coordination</h3>
                    <p>Clear communication and task management supported consistent progress across different parts of the project.</p>
                </article>
                <article class="value-card">
                    <h3>Implementation</h3>
                    <p>Front-end and back-end work were aligned to improve usability, workflow logic, and future integration readiness.</p>
                </article>
                <article class="value-card">
                    <h3>Quality</h3>
                    <p>Testing and review helped identify issues early and improved page consistency and the overall user experience.</p>
                </article>
            </div>
        </section>

        <section class="contributors-cta">
            <div>
                <span>Explore the platform</span>
                <h2>Find trusted businesses across New Zealand.</h2>
            </div>
            <div class="contributors-cta__actions">
                <a href="{{ route('businesses.index') }}" class="contributors-primary-btn">Browse Businesses</a>
                <a href="{{ route('home') }}" class="contributors-secondary-btn">Back to Home</a>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>
