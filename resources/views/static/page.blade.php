@extends('layouts.app', ['title' => $title, 'bodyClass' => 'static-info-page'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/directory.css') }}">
@endpush

@section('content')
    <main class="page-container narrow-container">
        <section class="profile-card">
            <span class="business-industry">Information</span>
            <h1>{{ $heading }}</h1>
            <p class="profile-description">{{ $body }}</p>
            <div class="profile-actions">
                <a href="{{ route('businesses.index') }}" class="get-quote-btn">Browse Businesses</a>
                <a href="{{ route('home') }}" class="view-profile-btn">Back Home</a>
            </div>
        </section>
    </main>
@endsection
