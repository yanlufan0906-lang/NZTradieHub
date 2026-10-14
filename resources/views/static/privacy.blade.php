@extends('layouts.app', [
    'title' => 'Privacy Policy | New Zealand Businesses',
    'description' => 'Read how New Zealand Businesses collects, uses, stores, and shares personal information.',
    'bodyClass' => 'privacy-page',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/privacy.css') }}">
@endpush

@section('content')
    <main>
        <header class="privacy-hero" aria-labelledby="privacy-title">
            <div class="privacy-shell">
                <span class="privacy-eyebrow">Your information matters</span>
                <h1 id="privacy-title">Privacy Policy</h1>
                <p>This policy explains how New Zealand Businesses collects, uses, stores, and shares personal information when you use this website and its services.</p>
                <div class="privacy-updated">
                    <span>Effective date</span>
                    <strong>30 July 2026</strong>
                </div>
            </div>
        </header>

        <div class="privacy-shell privacy-layout">
            <aside class="privacy-nav" aria-label="Privacy policy contents">
                <p>On this page</p>
                <nav>
                    <a href="#who-we-are">1. Who we are</a>
                    <a href="#information-we-collect">2. Information we collect</a>
                    <a href="#how-we-collect">3. How we collect it</a>
                    <a href="#how-we-use">4. How we use it</a>
                    <a href="#sharing">5. When we share it</a>
                    <a href="#ai-tools">6. AI-assisted descriptions</a>
                    <a href="#cookies">7. Cookies and technical data</a>
                    <a href="#storage">8. Storage, security, and retention</a>
                    <a href="#your-rights">9. Your privacy rights</a>
                    <a href="#changes">10. Changes to this policy</a>
                    <a href="#contact-us">11. Contact us</a>
                </nav>
            </aside>

            <article class="privacy-content">
                <div class="privacy-summary">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3 4.5 6v5.2c0 4.5 3.1 8.6 7.5 9.8 4.4-1.2 7.5-5.3 7.5-9.8V6L12 3Z"></path>
                        <path d="m8.8 12 2.1 2.1 4.5-4.6"></path>
                    </svg>
                    <div>
                        <strong>Privacy at a glance</strong>
                        <p>We collect information needed to provide directory, quote-request, contact, and account services. We do not currently use advertising cookies or sell personal information.</p>
                    </div>
                </div>

                <section id="who-we-are">
                    <span class="privacy-section-number">01</span>
                    <h2>Who we are</h2>
                    <p>New Zealand Businesses operates this online business directory and service-request platform. In this policy, “we”, “us”, and “our” refer to New Zealand Businesses, and “Platform” means this website and the services available through it.</p>
                    <p>For the purposes of the <a href="https://www.legislation.govt.nz/act/public/2020/31/en/latest/" rel="noopener noreferrer" target="_blank">Privacy Act 2020</a>, we are responsible for the personal information we collect and hold through the Platform.</p>
                </section>

                <section id="information-we-collect">
                    <span class="privacy-section-number">02</span>
                    <h2>Information we collect</h2>
                    <p>The information we collect depends on how you use the Platform.</p>

                    <h3>Quote requests</h3>
                    <ul>
                        <li>Your name, email address, and phone number.</li>
                        <li>The service and location you select.</li>
                        <li>Your preferred business, job description, and optional budget.</li>
                    </ul>

                    <h3>Contact messages</h3>
                    <ul>
                        <li>Your name, email address, and optional phone number.</li>
                        <li>The subject and content of your message.</li>
                    </ul>

                    <h3>Accounts and business listings</h3>
                    <ul>
                        <li>Account identifiers and authentication details used to sign you in.</li>
                        <li>Business names, contact details, locations, service areas, categories, descriptions, and other listing information.</li>
                        <li>Information you choose to make public through a business profile.</li>
                    </ul>

                    <div class="privacy-note">
                        <strong>Business registration prototype</strong>
                        <p>The current multi-step business-registration prototype runs in your browser and is not connected to a live registration or file-upload service. Information and identity files selected in that prototype are not currently transmitted to or stored by the Platform. We will update the relevant collection notice and this policy before enabling that functionality.</p>
                    </div>
                </section>

                <section id="how-we-collect">
                    <span class="privacy-section-number">03</span>
                    <h2>How we collect information</h2>
                    <p>We generally collect personal information directly from you when you submit a quote request, send a contact message, sign in, create or manage a listing, or otherwise communicate with us.</p>
                    <p>We may also receive limited technical information automatically when your browser uses the Platform. If we obtain personal information from public sources or another person in the future, we will provide any notice required by New Zealand privacy law.</p>
                    <p>Required form fields are marked on the relevant form. If you do not provide required information, we may be unable to submit your request, respond to your message, authenticate your account, or provide the requested service.</p>
                </section>

                <section id="how-we-use">
                    <span class="privacy-section-number">04</span>
                    <h2>How we use personal information</h2>
                    <p>We may use personal information to:</p>
                    <ul>
                        <li>Provide, administer, maintain, and improve the Platform.</li>
                        <li>Receive and manage quote requests and contact messages.</li>
                        <li>Operate accounts and business listings.</li>
                        <li>Connect customers with the business they select or enquire about.</li>
                        <li>Respond to questions, support requests, and privacy requests.</li>
                        <li>Protect the Platform, prevent misuse, troubleshoot problems, and enforce applicable terms.</li>
                        <li>Meet legal, regulatory, accounting, or reporting obligations.</li>
                    </ul>
                    <p>We will use personal information for the purpose for which it was collected, a directly related purpose, or another purpose permitted by law.</p>
                </section>

                <section id="sharing">
                    <span class="privacy-section-number">05</span>
                    <h2>When we share personal information</h2>
                    <p>We may disclose personal information only where reasonably necessary, including:</p>
                    <ul>
                        <li>To the business you choose when processing or responding to a quote request.</li>
                        <li>To technology providers that support hosting, databases, security, communications, or other Platform operations.</li>
                        <li>To professional advisers where reasonably necessary.</li>
                        <li>Where required or authorised by law, or where necessary to protect people, rights, or the security of the Platform.</li>
                        <li>As part of a proposed or completed business transfer, subject to appropriate confidentiality protections.</li>
                    </ul>
                    <p>Business-profile information marked or intended as public may be displayed to Platform visitors. We do not currently sell personal information.</p>
                </section>

                <section id="ai-tools">
                    <span class="privacy-section-number">06</span>
                    <h2>AI-assisted job descriptions</h2>
                    <p>The quote form includes an optional “Improve with AI” feature. If you choose to use it, the job description in the text box is sent to Google’s Gemini API so a revised description can be generated. Your name, email address, phone number, selected business, location, and budget are not included in that request by the Platform.</p>
                    <p>Google may process the submitted description outside New Zealand under its own service terms and <a href="https://policies.google.com/privacy" rel="noopener noreferrer" target="_blank">privacy policy</a>. Do not include sensitive personal information in a job description submitted to the AI feature. You can complete and submit a quote request without using this feature.</p>
                </section>

                <section id="cookies">
                    <span class="privacy-section-number">07</span>
                    <h2>Cookies and technical information</h2>
                    <p>The Platform uses essential cookies and similar technology to maintain sessions, protect forms against cross-site request forgery, remember temporary form state, and support sign-in functionality. These cookies are necessary for core Platform features.</p>
                    <p>Our systems and infrastructure providers may receive standard technical data such as your IP address, browser type, device information, requested pages, timestamps, and diagnostic or security events. We may use this information to operate, secure, and troubleshoot the Platform.</p>
                    <p>We do not currently use advertising cookies or third-party analytics scripts. Pages may load fonts from Google, which may receive technical request information such as your IP address and browser details.</p>
                </section>

                <section id="storage">
                    <span class="privacy-section-number">08</span>
                    <h2>Storage, security, and retention</h2>
                    <p>We take reasonable technical and organisational safeguards to protect personal information against loss, unauthorised access, modification, disclosure, or other misuse. However, no internet transmission or storage system can be guaranteed completely secure.</p>
                    <p>Some service providers may store or process information outside New Zealand. Where personal information is disclosed overseas, we will take reasonable steps required by the Privacy Act 2020 to ensure appropriate safeguards apply, unless another lawful basis permits the disclosure.</p>
                    <p>We retain personal information only for as long as reasonably required for the purposes described in this policy, including providing services, resolving disputes, maintaining security, and meeting legal obligations. We then delete, anonymise, or securely dispose of it where reasonably practicable.</p>
                </section>

                <section id="your-rights">
                    <span class="privacy-section-number">09</span>
                    <h2>Your privacy rights</h2>
                    <p>Under the Privacy Act 2020, you may ask whether we hold personal information about you and request access to that information. You may also ask us to correct information you believe is inaccurate, incomplete, out of date, or misleading.</p>
                    <p>We may need to confirm your identity before processing a request. Legal grounds may allow or require us to withhold some information, but we will explain our decision where required.</p>
                    <p>If you are not satisfied with how we handle a privacy concern, you may contact the <a href="https://www.privacy.org.nz/" rel="noopener noreferrer" target="_blank">Office of the Privacy Commissioner</a>.</p>
                </section>

                <section id="changes">
                    <span class="privacy-section-number">10</span>
                    <h2>Changes to this policy</h2>
                    <p>We may update this policy to reflect changes to the Platform, our privacy practices, service providers, or legal obligations. The effective date at the top of this page shows when the current version took effect. Material changes may also be highlighted through the Platform where appropriate.</p>
                </section>

                <section id="contact-us">
                    <span class="privacy-section-number">11</span>
                    <h2>Contact us</h2>
                    <p>To request access to or correction of your personal information, ask a privacy question, or raise a concern, contact New Zealand Businesses through our contact form.</p>
                    <a class="privacy-contact-button" href="{{ route('contact.create') }}">Contact New Zealand Businesses</a>
                </section>
            </article>
        </div>
    </main>
@endsection
