@extends('layouts.app', [
    'title' => 'Customer FAQ | New Zealand Businesses',
    'description' => 'Answers to common questions about finding businesses, comparing profiles, requesting quotes, and using New Zealand Businesses safely.',
    'bodyClass' => 'faq-page faq-page--customer',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endpush

@section('content')
    <main>
        <section class="faq-hero" aria-labelledby="customer-faq-title">
            <div class="faq-shell faq-hero__inner">
                <div class="faq-hero__content">
                    <span class="faq-eyebrow">Help for customers</span>
                    <h1 id="customer-faq-title">Customer frequently asked questions</h1>
                    <p>Find clear answers about searching the directory, comparing businesses, requesting a quote, and taking the next step with confidence.</p>
                    <div class="faq-hero__actions">
                        <a href="{{ route('businesses.index') }}" class="faq-button faq-button--primary">Browse Businesses</a>
                        <a href="{{ route('contact.create') }}" class="faq-button faq-button--secondary">Contact Us</a>
                    </div>
                </div>

                <div class="faq-hero__card" aria-label="Customer help topics">
                    <span>Popular help topics</span>
                    <ul>
                        <li>Finding the right service</li>
                        <li>Comparing business profiles</li>
                        <li>Preparing a quote request</li>
                        <li>Staying safe when hiring</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="faq-shell faq-layout">
            <aside class="faq-sidebar">
                <nav class="faq-topic-nav" aria-label="Customer FAQ topics">
                    <strong>On this page</strong>
                    <a href="#finding-businesses">Finding businesses</a>
                    <a href="#quotes-and-contact">Quotes and contact</a>
                    <a href="#trust-and-safety">Trust and safety</a>
                    <a href="#support-and-privacy">Support and privacy</a>
                </nav>

                <div class="faq-support-card">
                    <span>Still need help?</span>
                    <p>Send our team a message and include any reference number you received.</p>
                    <a href="{{ route('contact.create') }}">Contact support <span aria-hidden="true">&rarr;</span></a>
                </div>
            </aside>

            <div class="faq-content">
                <section class="faq-group" id="finding-businesses" aria-labelledby="finding-businesses-title">
                    <header class="faq-group__heading">
                        <span>01</span>
                        <div>
                            <h2 id="finding-businesses-title">Finding businesses</h2>
                            <p>Search, filter, and compare directory listings.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details open>
                            <summary>How do I search for a business?</summary>
                            <div class="faq-answer">
                                <p>Enter the service you need and, if helpful, a city or suburb. On the directory page you can refine the results by industry and category.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Can I browse without creating an account?</summary>
                            <div class="faq-answer">
                                <p>Yes. You can search the directory, open business profiles, and review public business information without signing in.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What information should I compare?</summary>
                            <div class="faq-answer">
                                <p>Compare the services offered, service areas, business description, contact details, availability information, and any qualifications or verification details shown on the profile.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Why are there no results for my search?</summary>
                            <div class="faq-answer">
                                <p>Try a broader service term, remove one of the filters, or search for a nearby city or suburb. You can also clear all filters to return to the full directory.</p>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="faq-group" id="quotes-and-contact" aria-labelledby="quotes-and-contact-title">
                    <header class="faq-group__heading">
                        <span>02</span>
                        <div>
                            <h2 id="quotes-and-contact-title">Quotes and contact</h2>
                            <p>Prepare a useful request and understand the next step.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details>
                            <summary>How do I request a quote?</summary>
                            <div class="faq-answer">
                                <p>Choose a business from the directory and select <strong>Request a Quote</strong>. Add the service, location, job description, contact details, and an optional budget before reviewing your request.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What should I include in my job description?</summary>
                            <div class="faq-answer">
                                <p>Explain what needs to be done, where the work is located, the current condition or problem, your preferred timing, and any access restrictions. Avoid including passwords, financial details, or other sensitive information.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Does requesting a quote commit me to hiring?</summary>
                            <div class="faq-answer">
                                <p>No. A quote request helps you start a conversation. Confirm the final scope, price, timing, and terms directly with the business before work begins.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Can I request quotes from more than one business?</summary>
                            <div class="faq-answer">
                                <p>Yes. Return to the directory, compare other suitable profiles, and prepare a separate request for each business you want to consider.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What should I do with my reference number?</summary>
                            <div class="faq-answer">
                                <p>Keep it with your records. If you contact our team about a submitted request, include the reference number so the enquiry is easier to identify.</p>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="faq-group" id="trust-and-safety" aria-labelledby="trust-and-safety-title">
                    <header class="faq-group__heading">
                        <span>03</span>
                        <div>
                            <h2 id="trust-and-safety-title">Trust and safety</h2>
                            <p>Practical checks to make before hiring.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details>
                            <summary>What should I check before choosing a business?</summary>
                            <div class="faq-answer">
                                <p>Confirm the business identity, relevant trade licences, insurance, experience, written scope, total price, payment schedule, and expected completion date. Ask questions whenever information is unclear.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Does a profile guarantee the quality of the work?</summary>
                            <div class="faq-answer">
                                <p>No directory profile can guarantee a particular result. Business information helps with comparison, but you should independently confirm that the provider is suitable for your job.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What if the work is urgent?</summary>
                            <div class="faq-answer">
                                <p>Use the phone number shown on the business profile and clearly explain the urgency. For immediate risks involving health, fire, gas, electricity, or public safety, contact the appropriate emergency service first.</p>
                            </div>
                        </details>

                        <details>
                            <summary>How can I report incorrect business information?</summary>
                            <div class="faq-answer">
                                <p>Use the contact page and include the business name, the information that appears incorrect, and any supporting detail that may help us review it.</p>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="faq-group" id="support-and-privacy" aria-labelledby="support-and-privacy-title">
                    <header class="faq-group__heading">
                        <span>04</span>
                        <div>
                            <h2 id="support-and-privacy-title">Support and privacy</h2>
                            <p>Help with requests and personal information.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details>
                            <summary>How can I correct or update a request?</summary>
                            <div class="faq-answer">
                                <p>Contact our team as soon as possible and include the request reference number. If you have already spoken with the business, also tell them about the correction directly.</p>
                            </div>
                        </details>

                        <details>
                            <summary>How is my personal information used?</summary>
                            <div class="faq-answer">
                                <p>Information submitted through the site is used to provide the requested directory, quote, or contact service. Read the <a href="{{ route('pages.show', 'privacy') }}">Privacy Policy</a> for details about collection, use, sharing, and your privacy rights.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Where can I get more help?</summary>
                            <div class="faq-answer">
                                <p>Use the <a href="{{ route('contact.create') }}">contact form</a> for website support, questions about a request, or concerns about information displayed in the directory.</p>
                            </div>
                        </details>
                    </div>
                </section>
            </div>
        </div>

        <section class="faq-cta">
            <div class="faq-shell faq-cta__inner">
                <div>
                    <span class="faq-eyebrow">Ready to start?</span>
                    <h2>Find a local business for your next job.</h2>
                    <p>Search by service and location, compare profiles, and prepare your quote request.</p>
                </div>
                <a href="{{ route('businesses.index') }}" class="faq-button faq-button--primary">Explore the Directory</a>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/faq.js') }}" defer></script>
@endpush
