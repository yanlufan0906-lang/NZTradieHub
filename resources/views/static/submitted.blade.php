@extends('layouts.app', ['title' => $title])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/directory.css') }}">
@endpush

@section('content')
    <main class="page-container narrow-container">
        <section class="profile-card success-card">
            <span class="business-industry">Success</span>
            <h1>{{ $title }}</h1>
            <p class="profile-description">{{ $message }}</p>
            <div class="profile-actions single-action">
                <a href="{{ route('home') }}" class="get-quote-btn">Back to Home</a>
            </div>
        </section>
    </main>
@endsection
