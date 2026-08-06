@extends('layouts.app', [
    'title' => 'Login | New Zealand Businesses,
    'showFooter' => false,
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/login.js') }}" defer></script>
@endpush

@section('content')
    <main class="login-page login-page--trady">

        <div class="container">
            <section class="login-panel" aria-labelledby="login-title">
                <div class="login-panel__intro">
                    <span class="login-panel__eyebrow">Business account</span>
                    <h1 id="login-title">Login to your Trady account</h1>
                    <p>Access your business profile, service areas, verification details, and customer requests.</p>
                </div>

                <form class="login-form" action="#" method="post" novalidate>
                    <div class="login-form__field">
                        <label for="login-email">Email <span class="required">*</span></label>
                        <input id="login-email" type="email" name="Email" placeholder="Enter your email" autocomplete="email" pattern="^[A-Za-z0-9.!#$%&'*+/=?^_`{|}~-]+@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?)+$" title="Enter valid email address" required>
                        <span class="field-error" aria-live="polite"></span>
                    </div>

                    <div class="login-form__field">
                        <label for="login-password">Password <span class="required">*</span></label>
                        <input id="login-password" type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                        <span class="field-error" aria-live="polite"></span>
                    </div>

                    <div class="login-form__meta">
                        <label class="login-form__remember">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#">Forgot password?</a>
                    </div>

                    <button class="submit-button" type="button">Login</button>





                </form>
            </section>
        </div>
    </main>
@endsection
