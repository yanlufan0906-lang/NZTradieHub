<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Find trusted tradies and service providers across New Zealand.' }}">
    <title>{{ $title ?? 'New Zealand Businesses' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/responsive-typography.css') }}">
</head>
<body class="{{ trim(($bodyClass ?? '').' '.(($showHeader ?? true) ? 'has-fixed-header' : '')) }}">
    @if($showHeader ?? true)
        @include('partials.header')
    @endif

    @yield('content')

    @if($showFooter ?? true)
        @include('partials.footer')
    @endif

    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="{{ asset('js/navigation.js') }}"></script>
    @stack('scripts')
</body>
</html>
