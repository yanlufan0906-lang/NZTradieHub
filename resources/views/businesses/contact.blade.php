@extends('layouts.app', [
    'title' => 'Contact ' . $business['name'],
    'bodyClass' => 'form-page contact-page business-contact-page',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endpush

@section('content')
    <main class="contact-main">
        <a href="{{ route('businesses.show', $slug) }}" class="business-contact-back">&larr; Back to business profile</a>

        <section class="contact-card" aria-labelledby="business-contact-title">
            <header class="form-heading">
                <span class="form-heading__eyebrow">Business contact</span>
                <h1 id="business-contact-title">Contact {{ $business['name'] }}</h1>
                <p>Complete the form below to prepare your enquiry.</p>
            </header>

            <div class="business-contact-summary">
                <div>
                    <span>{{ $business['industry'] }}</span>
                    <strong>{{ $business['name'] }}</strong>
                </div>
                <p>{{ $business['category'] }} &middot; {{ $business['location'] }}</p>
            </div>

            <form class="contact-form" data-business-contact-form novalidate>
                <div class="form-row">
                    <div class="form-field">
                        <label for="business-contact-name">Your name <span class="required">*</span></label>
                        <input id="business-contact-name" type="text" name="name" autocomplete="name" maxlength="120" required>
                        <span class="field-error" aria-live="polite"></span>
                    </div>

                    <div class="form-field">
                        <label for="business-contact-email">Email <span class="required">*</span></label>
                        <input id="business-contact-email" type="email" name="email" autocomplete="email" maxlength="120" required>
                        <span class="field-error" aria-live="polite"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="business-contact-phone">Phone <span class="optional">optional</span></label>
                        <input id="business-contact-phone" type="tel" name="phone" autocomplete="tel" maxlength="40">
                        <span class="field-error" aria-live="polite"></span>
                    </div>

                    <div class="form-field">
                        <label for="business-contact-subject">Subject <span class="required">*</span></label>
                        <input id="business-contact-subject" type="text" name="subject" placeholder="What would you like to ask?" maxlength="150" required>
                        <span class="field-error" aria-live="polite"></span>
                    </div>
                </div>

                <div class="form-row form-row--full">
                    <div class="form-field">
                        <label for="business-contact-message">Message <span class="required">*</span></label>
                        <textarea id="business-contact-message" name="message" placeholder="Write your message here" maxlength="1500" required></textarea>
                        <span class="field-error" aria-live="polite"></span>
                    </div>
                </div>

                <div class="form-row form-row--full">
                    <button type="submit" class="submit-button">Send Message</button>
                </div>
            </form>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        (function () {
            const form = document.querySelector('[data-business-contact-form]');

            if (!form) return;

            const emailField = form.querySelector('[name="email"]');
            const phoneField = form.querySelector('[name="phone"]');
            const validationOptions = { validateNonEmpty: true };

            FormValidation.bindRequiredFields(form, validationOptions);
            FormValidation.bindContactFields([emailField, phoneField], validationOptions);

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                FormValidation.updateContactValidity(phoneField, validationOptions);
                FormValidation.validateContainer(form, {
                    selector: '[required], input[type="tel"]',
                });
            });
        })();
    </script>
@endpush
