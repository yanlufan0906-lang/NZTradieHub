<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Login | NZ Businesses</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/business.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/login.js') }}" defer></script>
</head>
<body>
    @include('partials.header-auth')

    <main class="login-page login-page--trady">
        <div class="container">
            <section class="login-panel" aria-labelledby="login-title">
                <div class="login-panel__intro">
                    <span class="login-panel__eyebrow">Business account</span>
                    <h1 id="login-title">Sign in to your business account</h1>
                    <p>Access your business profile, manage incoming quote requests, and review your public listing.</p>
                </div>

                <form class="login-form" action="{{ route('login.store') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" id="quick-demo-login" name="quick_demo" value="0">

                    @if(session('status'))
                        <div class="login-status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="login-error-summary" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="login-form__field">
                        <label for="login-email">Email <span class="required">*</span></label>
                        <input id="login-email" type="email" name="Email" value="{{ old('Email') }}" placeholder="{{ $demoAccount['email'] }}" autocomplete="email" pattern="^[A-Za-z0-9.!#$%&'*+/=?^_`{|}~-]+@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?)+$" title="Enter valid email address">
                        <span class="field-error" aria-live="polite"></span>
                    </div>

                    <div class="login-form__field">
                        <label for="login-password">Password <span class="required">*</span></label>
                        <input id="login-password" type="password" name="password" placeholder="{{ $demoAccount['password'] }}" autocomplete="current-password">
                        <span class="field-error" aria-live="polite"></span>
                    </div>

                    <div class="login-form__meta">
                        <label class="login-form__remember">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" aria-disabled="true">Forgot password?</a>
                    </div>

                    <button class="submit-button" type="submit">Login</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
