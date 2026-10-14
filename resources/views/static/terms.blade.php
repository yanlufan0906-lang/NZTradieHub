@extends('layouts.app', [
    'title' => 'Terms & Conditions | New Zealand Businesses',
    'description' => 'Read the terms that apply when using the New Zealand Businesses directory, quote-request forms, business listings, and related services.',
    'bodyClass' => 'privacy-page terms-page',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/privacy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/terms.css') }}">
@endpush

@section('content')
    <main>
        <header class="privacy-hero" aria-labelledby="terms-title">
            <div class="privacy-shell">
                <span class="privacy-eyebrow">Using the platform</span>
                <h1 id="terms-title">Terms &amp; Conditions</h1>
                <p>These terms explain the rules that apply when you browse the directory, submit a request, contact a business, or use a business-facing feature.</p>
                <div class="privacy-updated">
                    <span>Effective date</span>
                    <strong>15 August 2026</strong>
                </div>
            </div>
        </header>

        <div class="privacy-shell privacy-layout">
            <aside class="privacy-nav" aria-label="Terms and conditions contents">
                <p>On this page</p>
                <nav>
                    <a href="#acceptance">1. Acceptance</a>
                    <a href="#platform">2. The Platform</a>
                    <a href="#prototype-features">3. Current prototype features</a>
                    <a href="#your-responsibilities">4. Your responsibilities</a>
                    <a href="#business-listings">5. Business listings</a>
                    <a href="#customer-business-relationship">6. Customer and business relationship</a>
                    <a href="#trust-information">7. Verification, ratings, and reviews</a>
                    <a href="#ai-tools">8. AI-assisted descriptions</a>
                    <a href="#acceptable-use">9. Acceptable use</a>
                    <a href="#content-rights">10. Content and intellectual property</a>
                    <a href="#availability">11. Availability and external services</a>
                    <a href="#consumer-rights">12. Consumer rights and responsibility</a>
                    <a href="#changes-law-contact">13. Changes, law, and contact</a>
                </nav>
            </aside>

            <article class="privacy-content">
                <div class="privacy-summary terms-summary">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 3h9l3 3v15H6z"></path>
                        <path d="M15 3v4h4M9 11h6M9 15h6"></path>
                    </svg>
                    <div>
                        <strong>Important information about the current Platform</strong>
                        <p>The directory currently includes demonstration listings and some business-facing features are browser-only prototypes. A visible success message does not make an unavailable feature a connected service.</p>
                    </div>
                </div>

                <section id="acceptance">
                    <span class="privacy-section-number">01</span>
                    <h2>Acceptance of these terms</h2>
                    <p>These Terms &amp; Conditions (Terms) apply when you access or use the New Zealand Businesses website and its available services (the Platform). In these Terms, “we”, “us”, and “our” refer to New Zealand Businesses.</p>
                    <p>By using the Platform, you agree to follow these Terms. If a form asks you to confirm acceptance, you must read these Terms and the <a href="{{ route('pages.show', 'privacy') }}">Privacy Policy</a> before submitting that confirmation. If you do not agree, do not use the relevant feature.</p>
                    <p>If you use the Platform on behalf of a business or organisation, you confirm that you have authority to act for it.</p>
                </section>

                <section id="platform">
                    <span class="privacy-section-number">02</span>
                    <h2>What the Platform does</h2>
                    <p>The Platform provides an online business directory and tools that may help customers find businesses, view listing information, prepare enquiries, and submit quote or general contact requests.</p>
                    <p>Businesses shown in the directory are independent from us. Unless we expressly state otherwise, we are not their employer, agent, partner, insurer, or professional adviser. We do not perform the services advertised in a business listing.</p>
                    <p>The Platform does not guarantee that a particular business will respond, accept a job, provide a quote, remain available, or be suitable for your requirements.</p>
                </section>

                <section id="prototype-features">
                    <span class="privacy-section-number">03</span>
                    <h2>Current prototype and demonstration features</h2>
                    <p>The current Platform includes features that demonstrate intended designs and workflows but are not connected to a complete live service:</p>
                    <ul>
                        <li>Directory entries may contain fictional demonstration names, contact details, ratings, completed-job totals, and verification labels.</li>
                        <li>The multi-step business-registration form runs in your browser. Information and files selected in that prototype are not currently transmitted to or stored by the Platform.</li>
                        <li>The business-account login and password-recovery experience is not currently connected to a live authentication service.</li>
                        <li>The contact form displayed on an individual demonstration business profile validates information locally but does not currently deliver an enquiry.</li>
                    </ul>
                    <p>The general contact form and quote-request form are connected submission forms. A submission confirmation records that the Platform received the request; it does not guarantee delivery to, acceptance by, or a response from a selected business.</p>
                </section>

                <section id="your-responsibilities">
                    <span class="privacy-section-number">04</span>
                    <h2>Your responsibilities</h2>
                    <p>When using the Platform, you must:</p>
                    <ul>
                        <li>Provide information that is accurate, current, and not misleading.</li>
                        <li>Submit requests only for genuine personal or business purposes.</li>
                        <li>Check the scope, price, timing, qualifications, licences, insurance, and suitability of a business before engaging it.</li>
                        <li>Keep account credentials secure if connected account functionality becomes available.</li>
                        <li>Only upload or provide content that you own or are authorised to use.</li>
                        <li>Avoid including passwords, payment-card details, health information, government identifiers, or other unnecessary sensitive information in free-text fields.</li>
                    </ul>
                </section>

                <section id="business-listings">
                    <span class="privacy-section-number">05</span>
                    <h2>Business listings</h2>
                    <p>A business is responsible for ensuring that its name, contact details, services, service areas, qualifications, licences, insurance information, images, and other listing content are accurate and lawful.</p>
                    <p>If connected listing functionality becomes available, we may format submitted information to fit the Platform, request evidence, correct obvious errors, or refuse, suspend, update, or remove content that is inaccurate, unlawful, unsafe, misleading, infringes another person’s rights, or does not meet the Platform’s listing requirements.</p>
                    <p>A directory position is not guaranteed. Search and display order may take account of relevance, location, profile completeness, availability, or other clearly disclosed factors.</p>
                </section>

                <section id="customer-business-relationship">
                    <span class="privacy-section-number">06</span>
                    <h2>The relationship between customers and businesses</h2>
                    <p>Customers and businesses are responsible for communicating clearly and agreeing directly on the work, price, payment terms, materials, access, timing, cancellation arrangements, warranties, and dispute process.</p>
                    <p>Unless we expressly agree otherwise in writing, we are not a party to a contract between a customer and a listed business. We do not collect payment for the listed business and do not supervise or control its work.</p>
                    <p>You should keep written records of quotes, variations, invoices, warranties, and important communications and independently verify information relevant to your decision.</p>
                </section>

                <section id="trust-information">
                    <span class="privacy-section-number">07</span>
                    <h2>Verification, ratings, and reviews</h2>
                    <p>Verification, rating, job-total, or response-time information shown in a demonstration listing is illustrative unless the Platform clearly identifies it as based on a completed live review process.</p>
                    <p>If live verification is introduced, a verification label will mean only that the specified information was checked at a particular time. It will not be a guarantee of workmanship, price, availability, identity, licensing status, insurance cover, safety, or suitability for every customer.</p>
                    <p>If customer reviews are introduced, reviewers must describe genuine first-hand experiences and must not include unlawful, defamatory, abusive, promotional, copied, or private information. Separate review guidelines may apply before that feature is enabled.</p>
                </section>

                <section id="ai-tools">
                    <span class="privacy-section-number">08</span>
                    <h2>AI-assisted descriptions</h2>
                    <p>The quote form may offer an optional tool that suggests an improved job description using Google’s Gemini API. AI-generated text may be incomplete, inaccurate, or unsuitable.</p>
                    <p>You remain responsible for reviewing and editing a suggestion before using it. Do not include sensitive personal information in text sent to the AI feature. You can complete a quote request without using AI.</p>
                    <p>Information about what is sent to the AI provider is available in our <a href="{{ route('pages.show', 'privacy') }}#ai-tools">Privacy Policy</a>.</p>
                </section>

                <section id="acceptable-use">
                    <span class="privacy-section-number">09</span>
                    <h2>Acceptable use</h2>
                    <p>You must not use the Platform to:</p>
                    <ul>
                        <li>Break the law, mislead another person, impersonate someone, or submit fraudulent information.</li>
                        <li>Harass, threaten, discriminate against, defame, or harm another person or business.</li>
                        <li>Send spam, repeated unwanted enquiries, malicious files, or automated submissions.</li>
                        <li>Attempt to bypass security, access non-public systems, disrupt the Platform, or introduce harmful code.</li>
                        <li>Scrape, reproduce, or compile Platform content into another directory or commercial database without permission.</li>
                        <li>Use another person’s personal information without a lawful reason and appropriate authority.</li>
                    </ul>
                </section>

                <section id="content-rights">
                    <span class="privacy-section-number">10</span>
                    <h2>Content and intellectual property</h2>
                    <p>The Platform’s design, branding, software, and original content may be protected by copyright, trade mark, and other intellectual-property laws. You may use the Platform for its intended personal or internal business purposes, but you must not reproduce, sell, modify, or commercially exploit protected Platform material without permission.</p>
                    <p>You retain any rights you hold in content you submit. If a connected public-listing feature becomes available, you authorise us to host, reproduce, resize, format, and display submitted listing content only as reasonably necessary to operate, promote, and maintain that listing and the Platform. You confirm that doing so will not infringe another person’s rights.</p>
                    <p>Personal information is handled under the <a href="{{ route('pages.show', 'privacy') }}">Privacy Policy</a>.</p>
                </section>

                <section id="availability">
                    <span class="privacy-section-number">11</span>
                    <h2>Availability, changes, and external services</h2>
                    <p>We may maintain, improve, replace, restrict, or discontinue Platform content or features. We do not promise uninterrupted or error-free availability, but this does not limit any responsibility that cannot lawfully be limited.</p>
                    <p>The Platform may link to or use services operated by other organisations. Their content, availability, security, and terms are controlled by them. Review the applicable third-party terms and privacy information before using those services.</p>
                </section>

                <section id="consumer-rights">
                    <span class="privacy-section-number">12</span>
                    <h2>Consumer rights and responsibility</h2>
                    <p>Nothing in these Terms excludes, restricts, or modifies any right or remedy that cannot be excluded under the Consumer Guarantees Act 1993, Fair Trading Act 1986, Privacy Act 2020, or other applicable New Zealand law.</p>
                    <p>To the extent permitted by law, directory information and prototype features are provided on an “as available” basis. You remain responsible for deciding whether information or a listed business is suitable and for contracts you enter into directly with a business.</p>
                    <p>We remain responsible for obligations that the law imposes on us. A listed business remains responsible for the goods or services it agrees to provide and for its own legal obligations.</p>
                    <div class="privacy-note">
                        <strong>Legal review recommended</strong>
                        <p>These Terms describe the current Platform and are not a substitute for advice about your specific circumstances. The Platform operator should obtain New Zealand legal review before relying on them for a production service.</p>
                    </div>
                </section>

                <section id="changes-law-contact">
                    <span class="privacy-section-number">13</span>
                    <h2>Changes, New Zealand law, and contact</h2>
                    <p>We may update these Terms when Platform features, business practices, or legal obligations change. The effective date at the top of this page identifies the current version. Changes apply from publication unless a later date is stated.</p>
                    <p>These Terms are governed by New Zealand law. Nothing in this section prevents you from using a court, tribunal, regulator, or dispute process available to you under applicable law.</p>
                    <p>Questions, concerns, or requests relating to these Terms can be sent through our contact form.</p>
                    <a class="privacy-contact-button" href="{{ route('contact.create') }}">Contact New Zealand Businesses</a>
                </section>
            </article>
        </div>
    </main>
@endsection
