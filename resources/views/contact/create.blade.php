@extends('layouts.app', ['title' => 'Contact Us', 'bodyClass' => 'form-page contact-page'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endpush

@section('content')
    <main class="contact-main">
        <section class="contact-card" aria-labelledby="contact-title">
            <header class="form-heading">
                <span class="form-heading__eyebrow">Contact form</span>
                <h1 id="contact-title">Send us a message</h1>
                <p>Complete the form below and we will receive your enquiry.</p>
            </header>

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form" data-contact-form novalidate>
                @csrf

                <div class="form-row form-row--full">
                    <div class="form-field {{ $errors->has('name') ? 'form-field--error' : '' }}">
                        <label>Your name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                        <span class="field-error" aria-live="polite">{{ $errors->has('name') ? 'Required' : '' }}</span>
                    </div>

                    <div class="form-field {{ $errors->has('email') ? 'form-field--error' : '' }}">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" title="Enter valid email address" required>
                        <span class="field-error" aria-live="polite">{{ $errors->has('email') ? (old('email') ? 'Enter valid email address' : 'Required') : '' }}</span>
                    </div>
                </div>

                <div class="form-row form-row--full">
                    <div class="form-field {{ $errors->has('phone') ? 'form-field--error' : '' }}">
                        <label>Phone <span class="optional">optional</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}">
                        <span class="field-error" aria-live="polite">{{ $errors->has('phone') ? 'Required' : '' }}</span>
                    </div>

                    <div class="form-field {{ $errors->has('subject') ? 'form-field--error' : '' }}">
                        <label>Subject <span class="required">*</span></label>
                        <input
                            type="text"
                            name="subject"
                            value="{{ old('subject') }}"
                            placeholder="Business listing, quote request, website support..."
                            required
                        >
                        <span class="field-error" aria-live="polite">{{ $errors->has('subject') ? 'Required' : '' }}</span>
                    </div>
                </div>

                <div class="form-row form-row--full">
                    <div class="form-field {{ $errors->has('message') ? 'form-field--error' : '' }}">
                        <label>Message <span class="required">*</span></label>
                        <textarea name="message" placeholder="Please write your message here" required>{{ old('message') }}</textarea>
                        <span class="field-error" aria-live="polite">{{ $errors->has('message') ? 'Required' : '' }}</span>
                    </div>
                </div>

                <div class="form-row form-row--full">
                    <button type="submit" class="submit-button">Submit Contact Message</button>
                </div>

            </form>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        (function () {
            const form = document.querySelector('[data-contact-form]');

            if (!form) return;

            FormValidation.bindRequiredFields(form, { validateNonEmpty: true });

            form.addEventListener('submit', (event) => {
                if (!FormValidation.validateContainer(form)) {
                    event.preventDefault();
                }
            });
        })();
    </script>
@endpush
