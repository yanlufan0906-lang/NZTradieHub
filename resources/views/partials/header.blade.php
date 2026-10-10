<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="{{ route('home') }}" class="logo-placeholder">NZ Businesses</a>
            <a href="{{ route('businesses.index') }}" class="browse-btn">Browse</a>
        </div>

        <button
            type="button"
            class="nav-toggle"
            aria-expanded="false"
            aria-controls="primaryNavigationActions"
            aria-label="Open navigation menu"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navbar-actions" id="primaryNavigationActions">
            @unless(Route::is('contact.create'))
                <a href="{{ route('contact.create') }}" class="nav-btn light-btn">Contact</a>
            @endunless

            @unless(Route::is('login'))
                <a href="{{ route('login') }}" class="nav-btn light-btn">Login</a>
            @endunless

            @unless(Route::is('businesses.register'))
                <a href="{{ route('businesses.register') }}" class="nav-btn business-btn">List Your Business</a>
            @endunless
        </div>
    </div>
</nav>
