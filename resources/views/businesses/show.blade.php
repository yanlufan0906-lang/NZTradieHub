<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $business['name'] }}</title>
    <link rel="stylesheet" href="{{ asset('css/businesses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>
    <nav class="page-navbar">
        <a href="{{ route('home') }}" class="brand-link">NZ Businesses</a>
        <div class="page-nav-links">
            <a href="{{ route('businesses.index') }}">Browse</a>
            @if(session('demo_user'))
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Business Login</a>
            @endif
            <a href="{{ route('businesses.register') }}" class="primary-link">List Your Business</a>
        </div>
    </nav>

    <main class="page-container narrow-container">
        <div class="profile-page-top">
            <a href="{{ url()->previous() }}" class="back-link profile-back-link">← Back</a>

            <section class="profile-search-shell" aria-label="Search businesses">
                <div class="profile-search-shell__header">
                    <span>Search businesses</span>
                    <p>Find other service providers by keyword, location, industry, or category.</p>
                </div>

                <form action="{{ route('businesses.index') }}" method="GET" class="filter-box profile-search-form">
                    <input
                        type="text"
                        name="service"
                        value=""
                    >

                    <input
                        type="text"
                        name="location"
                        value=""
                    >

                    <select name="industry">
                        <option value="" selected>All Industries</option>
                        @foreach(config('industries') as $industryName => $categories)
                            <option value="{{ $industryName }}">
                                {{ $industryName }}
                            </option>
                        @endforeach
                    </select>

                    <select name="category">
                        <option value="" selected>All Categories</option>
                        @foreach(config('industries') as $industryName => $categories)
                            @foreach($categories as $category)
                                <option value="{{ $category }}">
                                    {{ $category }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>

                    <button type="submit">Apply Filters</button>
                </form>
            </section>
        </div>

        <section class="profile-card">
            @if(! empty($business['cover_url']))
                <img src="{{ asset($business['cover_url']) }}" alt="{{ $business['name'] }} cover photo" class="profile-cover-image">
            @endif
            <span class="business-industry">{{ $business['industry'] }}</span>
            <div class="profile-title-row">
                @if(! empty($business['logo_url']))
                    <img src="{{ asset($business['logo_url']) }}" alt="{{ $business['name'] }} logo" class="profile-logo-image">
                @endif
                <h1>{{ $business['name'] }}</h1>
            </div>
            <div class="business-meta profile-meta">
                <span>{{ $business['category'] }}</span>
                <span>📍 {{ $business['location'] }}</span>
                <span>Verified business</span>
                @if(! empty($business['rating']))
                    <span>★ {{ number_format($business['rating'], 1) }}</span>
                @endif
            </div>

            <p class="profile-description">{{ $business['description'] }}</p>

            <div class="profile-info-grid">
                <div>
                    <strong>Phone</strong>
                    <p>{{ $business['phone'] }}</p>
                </div>
                <div>
                    <strong>Email</strong>
                    <p>{{ $business['email'] }}</p>
                </div>
                @if(! empty($business['jobs_completed']))
                    <div>
                        <strong>Jobs completed</strong>
                        <p>{{ $business['jobs_completed'] }} jobs</p>
                    </div>
                @endif
                @if(! empty($business['response_time']))
                    <div>
                        <strong>Response time</strong>
                        <p>{{ $business['response_time'] }}</p>
                    </div>
                @endif
            </div>

            @if(! empty($business['services']))
                <h3 class="profile-subheading">Services</h3>
                <div class="tag-row profile-tags">
                    @foreach($business['services'] as $item)
                        <span>{{ $item }}</span>
                    @endforeach
                </div>
            @endif

            @if(! empty($business['service_areas']))
                <h3 class="profile-subheading">Service areas</h3>
                <div class="tag-row profile-tags">
                    @foreach($business['service_areas'] as $area)
                        <span>{{ $area }}</span>
                    @endforeach
                </div>
            @endif

            <div class="profile-actions">
                <a href="{{ route('quote.create', ['business' => $business['name'], 'service' => $business['category'], 'location' => $business['location']]) }}" class="get-quote-btn">Request a Quote</a>
                <a href="mailto:{{ $business['email'] }}" class="view-profile-btn">Email Business</a>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>
