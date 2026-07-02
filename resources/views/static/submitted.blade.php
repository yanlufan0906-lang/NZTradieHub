<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/businesses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/submitted-fix.css') }}">
</head>
<body>
    @include('partials.header')

    <main class="page-container narrow-container">
        <section class="profile-card success-card">
            <span class="business-industry">Success</span>
            <h1>{{ $title }}</h1>
            <p class="profile-description">{{ $message }}</p>
            <div class="profile-actions single-action">
                @foreach(($actions ?? [['label' => 'Back to Home', 'url' => route('home'), 'class' => 'get-quote-btn']]) as $action)
                    <a href="{{ $action['url'] }}" class="{{ $action['class'] ?? 'get-quote-btn' }}">{{ $action['label'] }}</a>
                @endforeach
            </div>
        </section>
    </main>
    @include('partials.footer')
</body>
</html>
