@extends('layouts.app', [
    'title' => 'Business FAQ | New Zealand Businesses',
    'description' => 'Answers for New Zealand businesses about directory listings, profile information, visibility, enquiries, and support.',
    'bodyClass' => 'faq-page faq-page--business',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endpush

@section('content')
    <main>
        <section class="faq-hero" aria-labelledby="business-faq-title">
            <div class="faq-shell faq-hero__inner">
                <div class="faq-hero__content">
                    <span class="faq-eyebrow">Help for businesses</span>
                    <h1 id="business-faq-title">Business frequently asked questions</h1>
                    <p>Learn what information belongs in a useful listing, how customers find businesses, and what to expect from the current listing process.</p>
                    <div class="faq-hero__actions">
                        <a href="{{ route('businesses.register') }}" class="faq-button faq-button--primary">View Listing Form</a>
                        <a href="{{ route('contact.create') }}" class="faq-button faq-button--secondary">Contact Our Team</a>
                    </div>
                </div>

                <div class="faq-hero__card" aria-label="Business help topics">
                    <span>Popular help topics</span>
                    <ul>
                        <li>Preparing your listing</li>
                        <li>Business profile information</li>
                        <li>Visibility and customer requests</li>
                        <li>Updating or correcting details</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="faq-shell faq-layout">
            <aside class="faq-sidebar">
                <nav class="faq-topic-nav" aria-label="Business FAQ topics">
                    <strong>On this page</strong>
                    <a href="#getting-listed">Getting listed</a>
                    <a href="#building-profile">Building your profile</a>
                    <a href="#visibility-and-enquiries">Visibility and enquiries</a>
                    <a href="#listing-support">Listing support</a>
                </nav>

                <div class="faq-support-card">
                    <span>Need listing help?</span>
                    <p>Contact our team with your business name and the details you need help with.</p>
                    <a href="{{ route('contact.create') }}">Contact support <span aria-hidden="true">&rarr;</span></a>
                </div>
            </aside>

            <div class="faq-content">
                <section class="faq-group" id="getting-listed" aria-labelledby="getting-listed-title">
                    <header class="faq-group__heading">
                        <span>01</span>
                        <div>
                            <h2 id="getting-listed-title">Getting listed</h2>
                            <p>Understand the current listing process and what to prepare.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details open>
                            <summary>How do I list my business?</summary>
                            <div class="faq-answer">
                                <p>Open the <a href="{{ route('businesses.register') }}">listing form</a> to review the business, service-area, profile, and verification information requested. New registrations are currently handled separately, so contact our team when you are ready to discuss listing availability.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Which businesses can apply?</summary>
                            <div class="faq-answer">
                                <p>New Zealand tradies and local service providers can prepare a listing. Your services, operating location, and areas served should be described accurately and consistently with your real business.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What information should I have ready?</summary>
                            <div class="faq-answer">
                                <p>Prepare your business name, contact details, NZBN if applicable, service categories, service areas, experience, availability, business description, website, logo, work images, and relevant licence or insurance information.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Is there a cost to be listed?</summary>
                            <div class="faq-answer">
                                <p>Final listing plans and inclusions have not yet been published. Review the <a href="{{ route('pages.show', 'pricing') }}">Pricing page</a> for current information or contact our team before making a listing decision.</p>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="faq-group" id="building-profile" aria-labelledby="building-profile-title">
                    <header class="faq-group__heading">
                        <span>02</span>
                        <div>
                            <h2 id="building-profile-title">Building your profile</h2>
                            <p>Give customers clear, useful, and accurate information.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details>
                            <summary>What makes a useful business description?</summary>
                            <div class="faq-answer">
                                <p>Explain your main services, specialist experience, typical customers, the areas you serve, and what customers can expect when they contact you. Keep promotional claims specific and verifiable.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Which service areas should I select?</summary>
                            <div class="faq-answer">
                                <p>List only locations you regularly serve. If travel distance, call-out charges, or minimum job values apply, explain them clearly so customers can make an informed choice.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Can I add a logo, cover image, and work photos?</summary>
                            <div class="faq-answer">
                                <p>The listing form includes logo and cover-image fields. Use clear, current images that you own or have permission to publish, and avoid showing customer details without consent.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What should I provide for licences and insurance?</summary>
                            <div class="faq-answer">
                                <p>Provide information relevant to the services you advertise, keep it current, and do not claim a qualification or insurance cover you do not hold. Customers may independently confirm these details.</p>
                            </div>
                        </details>

                        <details>
                            <summary>What does a verification label mean?</summary>
                            <div class="faq-answer">
                                <p>A verification label should describe only the information that has actually been reviewed. It is not a guarantee of workmanship, availability, price, or suitability for every customer or job.</p>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="faq-group" id="visibility-and-enquiries" aria-labelledby="visibility-and-enquiries-title">
                    <header class="faq-group__heading">
                        <span>03</span>
                        <div>
                            <h2 id="visibility-and-enquiries-title">Visibility and enquiries</h2>
                            <p>Help customers find and understand your business.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details>
                            <summary>How do customers find my business?</summary>
                            <div class="faq-answer">
                                <p>Customers can search by service, keyword, business name, location, industry, and category. Accurate categories, service areas, services, and descriptions make your profile easier to match with relevant searches.</p>
                            </div>
                        </details>

                        <details>
                            <summary>How can I make my profile more helpful?</summary>
                            <div class="faq-answer">
                                <p>Use a recognisable business name, write a specific description, list your actual services and coverage areas, provide current contact details, and explain normal response times or availability.</p>
                            </div>
                        </details>

                        <details>
                            <summary>How do quote requests work?</summary>
                            <div class="faq-answer">
                                <p>Customers choose a business profile, describe the required service, and provide their contact information. Business-facing lead management is still being prepared, so contact our team for current availability.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Can I promise emergency or same-day service?</summary>
                            <div class="faq-answer">
                                <p>Only advertise emergency, same-day, or 24-hour availability when you can reliably provide it. Include any limits, hours, locations, or call-out charges that apply.</p>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="faq-group" id="listing-support" aria-labelledby="listing-support-title">
                    <header class="faq-group__heading">
                        <span>04</span>
                        <div>
                            <h2 id="listing-support-title">Listing support</h2>
                            <p>Corrections, privacy, and help from our team.</p>
                        </div>
                    </header>

                    <div class="faq-list">
                        <details>
                            <summary>How do I update or correct my listing?</summary>
                            <div class="faq-answer">
                                <p>Public account-based editing is not currently available. Contact our team with your business name, the information to change, and enough detail to confirm the request.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Can I ask for a listing to be removed?</summary>
                            <div class="faq-answer">
                                <p>Yes. Use the contact page and identify the business and your connection to it. Our team may request additional information before changing or removing business details.</p>
                            </div>
                        </details>

                        <details>
                            <summary>How is business and contact information used?</summary>
                            <div class="faq-answer">
                                <p>Some listing details are intended to be public so customers can find and contact the business. Read the <a href="{{ route('pages.show', 'privacy') }}">Privacy Policy</a> before providing personal or business information.</p>
                            </div>
                        </details>

                        <details>
                            <summary>Where can I ask another question?</summary>
                            <div class="faq-answer">
                                <p>Use the <a href="{{ route('contact.create') }}">contact form</a> for listing questions, corrections, website support, or concerns about information shown in the directory.</p>
                            </div>
                        </details>
                    </div>
                </section>
            </div>
        </div>

        <section class="faq-cta">
            <div class="faq-shell faq-cta__inner">
                <div>
                    <span class="faq-eyebrow">Prepare your listing</span>
                    <h2>Show customers what your business does best.</h2>
                    <p>Review the information requested for a clear and useful directory profile.</p>
                </div>
                <a href="{{ route('businesses.register') }}" class="faq-button faq-button--primary">View Listing Form</a>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/faq.js') }}" defer></script>
@endpush
