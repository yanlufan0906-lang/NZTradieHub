<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Business Dashboard | NZ Businesses</title>
    <link rel="stylesheet" href="{{ asset('css/businesses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive-typography.css') }}">
</head>
<body class="has-fixed-header">
    @include('partials.header')

    <main class="page-container dashboard-container">
        @if(session('status'))
            <div class="dashboard-alert">{{ session('status') }}</div>
        @endif

        <section class="profile-card dashboard-hero">
            <div>
                <span class="business-industry">Business Dashboard</span>
                <h1>Welcome back, {{ $business['name'] ?? $user['name'] }}</h1>
                <p class="profile-description">Manage your listing, review new quote requests, and keep your business information up to date.</p>
            </div>
            <div class="profile-actions dashboard-actions">
                <a href="{{ route('businesses.index') }}" class="view-profile-btn">Browse Directory</a>
                @if($business)
                    <a href="{{ route('businesses.show', \Illuminate\Support\Str::slug($business['name'])) }}" class="get-quote-btn">View Public Profile</a>
                @endif
            </div>
        </section>

        <div class="dashboard-grid">
            <section class="profile-card dashboard-card">
                <h2>Business Profile</h2>
                @if($business)
                    <div class="dashboard-business-summary">
                        @if(! empty($business['logo_url']))
                            <img src="{{ asset($business['logo_url']) }}" alt="{{ $business['name'] }} logo" class="dashboard-logo">
                        @endif
                        <div>
                            <h3>{{ $business['name'] }}</h3>
                            <p>{{ $business['category'] }} · {{ $business['location'] }}</p>
                            <p>{{ $business['description'] }}</p>
                        </div>
                    </div>
                    <div class="dashboard-meta-list">
                        <div><strong>Email</strong><span>{{ $business['email'] }}</span></div>
                        <div><strong>Phone</strong><span>{{ $business['phone'] }}</span></div>
                        <div><strong>Service areas</strong><span>{{ implode(', ', $business['service_areas'] ?? []) }}</span></div>
                    </div>
                @else
                    <p>No business profile is connected to this account.</p>
                @endif
            </section>

            <section class="profile-card dashboard-card">
                <h2>Account Overview</h2>
                <p>Snapshot of the current business account and listing status.</p>
                <div class="credential-box">
                    <div><strong>Account email</strong><span>{{ $user['email'] ?? '—' }}</span></div>
                    <div><strong>Listing status</strong><span>Active</span></div>
                    <div><strong>Directory visibility</strong><span>Public</span></div>
                </div>
                <p class="dashboard-note">Use the public profile view to preview how customers see your business listing.</p>
            </section>
        </div>

        <section class="profile-card dashboard-card">
            <div class="dashboard-section-header">
                <div>
                    <span class="business-industry">Customer Requests</span>
                    <h2>Recent Quote Leads</h2>
                </div>
                <a href="{{ route('quote.create', ['business' => $business['name'] ?? config('demo-account.business')]) }}" class="view-profile-btn">Create Test Quote</a>
            </div>

            <div class="lead-list">
                @foreach($quotes as $quote)
                    <article class="lead-card">
                        <div>
                            <strong>{{ $quote['customer_name'] ?? 'Customer' }}</strong>
                            <span>{{ $quote['reference'] ?? 'QR-0001' }} · {{ $quote['created_at'] ?? 'Just now' }}</span>
                        </div>
                        <p>{{ $quote['description'] ?? 'No description provided.' }}</p>
                        <div class="business-meta">
                            <span>{{ $quote['service'] ?? 'Service' }}</span>
                            <span>📍 {{ $quote['location'] ?? 'Location' }}</span>
                            <span>{{ $quote['budget'] ?? 'Budget not provided' }}</span>
                        </div>
                        <div class="dashboard-meta-list compact">
                            <div><strong>Phone</strong><span>{{ $quote['phone'] ?? '—' }}</span></div>
                            <div><strong>Email</strong><span>{{ $quote['email'] ?? '—' }}</span></div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>

    @include('partials.footer')
    <script src="{{ asset('js/navigation.js') }}"></script>
</body>
</html>
