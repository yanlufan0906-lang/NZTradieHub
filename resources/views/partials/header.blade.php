<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="{{ route('home') }}" class="logo-placeholder">NZ Businesses</a>
            <a href="{{ route('businesses.index') }}" class="browse-btn">Browse</a>
        </div>

        <div class="navbar-actions">
            @if(session('demo_user'))
                <a href="{{ route('dashboard') }}" class="nav-btn light-btn">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="nav-logout-form">
                    @csrf
                    <button type="submit" class="nav-btn light-btn nav-logout-button">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn light-btn">Business Login</a>
            @endif

            @if(!Route::is('businesses.register'))
                <a href="{{ route('businesses.register') }}" class="nav-btn business-btn">List Your Business</a>
            @endif
        </div>
    </div>
</nav>
