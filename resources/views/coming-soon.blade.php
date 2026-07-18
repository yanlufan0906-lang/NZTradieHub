<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NZ Businesses is coming soon.">
    <meta name="robots" content="noindex, nofollow">
    <title>Coming Soon | NZ Businesses</title>
    <link rel="stylesheet" href="{{ asset('css/coming-soon.css') }}">
</head>
<body>
    <main class="coming-soon-page">
        <div class="coming-soon-page__glow coming-soon-page__glow--one"></div>
        <div class="coming-soon-page__glow coming-soon-page__glow--two"></div>

        <header class="coming-soon-header">
            <a href="{{ route('home') }}" class="coming-soon-brand" aria-label="NZ Businesses home">
                <span class="coming-soon-brand__mark" aria-hidden="true">NZ</span>
                <span>NZ Businesses</span>
            </a>

            <span class="coming-soon-status">
                <span class="coming-soon-status__dot" aria-hidden="true"></span>
                Platform in development
            </span>
        </header>

        <section class="coming-soon-content" aria-labelledby="coming-soon-title">
            <div class="coming-soon-copy">
                <span class="coming-soon-eyebrow">Launching soon</span>
                <h1 id="coming-soon-title">A better way to discover trusted local businesses.</h1>
                <p>
                    We are building a new platform that will make it easier to find, compare,
                    and connect with businesses across New Zealand.
                </p>

                <div class="coming-soon-progress" aria-label="Platform connection status">
                    <div class="coming-soon-progress__heading">
                        <span>Production integration</span>
                        <strong>In progress</strong>
                    </div>
                    <div class="coming-soon-progress__track" aria-hidden="true">
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="coming-soon-visual" aria-hidden="true">
                <div class="coming-soon-orbit coming-soon-orbit--outer"></div>
                <div class="coming-soon-orbit coming-soon-orbit--inner"></div>

                <div class="coming-soon-visual__card">
                    <div class="coming-soon-visual__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <strong>Coming Soon</strong>
                    <p>Connecting the platform to live business services.</p>
                </div>

                <span class="coming-soon-node coming-soon-node--one"></span>
                <span class="coming-soon-node coming-soon-node--two"></span>
                <span class="coming-soon-node coming-soon-node--three"></span>
            </div>
        </section>

        <footer class="coming-soon-footer">
            <span>&copy; {{ date('Y') }} NZ Businesses</span>
            <span>New Zealand</span>
        </footer>
    </main>
</body>
</html>
