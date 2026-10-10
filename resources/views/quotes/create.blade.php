@extends('layouts.app', [
    'title' => 'Request a Quote',
    'bodyClass' => 'form-page quote-request-page',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quote-form.css') }}">
@endpush

@section('content')
    <div class="job-page">
        <div class="job-layout">
            <aside class="job-sidebar">
                <div class="sidebar-heading">
                    <h3>Quote request</h3>
                    <span>Complete all steps to request a quote</span>
                </div>

                <ol class="step-list">
                    <li class="step-list__item step-list__item--active" data-sidebar-step="1">
                        <div class="step-list__number">
                            <span>1</span>
                        </div>
                        <div class="step-list__content">
                            <h2>Job details</h2>
                            <p>Service, location, and job information</p>
                        </div>
                    </li>

                    <li class="step-list__item" data-sidebar-step="2">
                        <div class="step-list__number">
                            <span>2</span>
                        </div>
                        <div class="step-list__content">
                            <h2>Contact details</h2>
                            <p>How the business can reach you</p>
                        </div>
                    </li>

                    <li class="step-list__item" data-sidebar-step="3">
                        <div class="step-list__number">
                            <span>3</span>
                        </div>
                        <div class="step-list__content">
                            <h2>Review and submit</h2>
                            <p>Check your request before sending</p>
                        </div>
                    </li>
                </ol>
            </aside>

            <main class="job-form-area">
                <div class="form-heading">
                    <span>Customer request</span>
                    <h1>Request a quote</h1>
                    <p>Fill in the job details, add your contact details, then submit your request.</p>
                </div>

                <div class="step-progress" aria-label="Quote request progress">
                    <span class="step-progress__bar step-progress__bar--active" aria-hidden="true"></span>
                    <span class="step-progress__bar" aria-hidden="true"></span>
                    <span class="step-progress__bar" aria-hidden="true"></span>
                    <span class="step-progress__label" aria-live="polite">Step 1 of 3</span>
                </div>

                @if ($errors->any())
                    <div class="error-box">
                        <strong>Please fix the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('quote.store') }}" method="POST" class="job-form" id="quoteForm" novalidate>
                    @csrf
                    <input type="hidden" name="preferred_business" value="{{ old('preferred_business', $business) }}">

                    <section class="form-step-section active" data-form-step="1">
                        @if($selectedBusiness)
                            <div class="selected-business-card">
                                <div>
                                    <span>Selected business</span>
                                    <strong>{{ $selectedBusiness['name'] }}</strong>
                                    <small>{{ $selectedBusiness['category'] }} · {{ $selectedBusiness['location'] }}</small>
                                </div>
                                <a href="{{ route('businesses.index') }}">Change</a>
                            </div>
                        @endif

                        <div class="form-group full-width">
                            <label>Service <span>*</span></label>
                            <input type="text" name="service" id="serviceInput" value="{{ old('service', $service) }}" placeholder="Plumbing, Electrical, Cleaning..." required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Location <span>*</span></label>
                                <input type="text" name="location" id="locationInput" value="{{ old('location', $location) }}" placeholder="Auckland" required>
                            </div>

                            <div class="form-group">
                                <label>Budget <span class="optional">optional</span></label>
                                <input type="text" name="budget" id="budgetInput" value="{{ old('budget') }}" placeholder="$500 - $1,000">
                            </div>
                        </div>

                        <div class="form-group full-width description-field">
                            <div class="description-field__header">
                                <label for="descriptionInput">Job description <span>*</span></label>
                                <button
                                    type="button"
                                    class="ai-improve-btn"
                                    id="improveDescriptionButton"
                                    data-url="{{ route('quote.improve-description') }}"
                                    aria-controls="descriptionInput"
                                >
                                    <span class="ai-improve-btn__icon" aria-hidden="true">&#10022;</span>
                                    <span class="ai-improve-btn__label">Improve with AI</span>
                                </button>
                            </div>
                            <textarea
                                name="description"
                                id="descriptionInput"
                                placeholder="Describe the job, problem, or service you need"
                                maxlength="1500"
                                aria-describedby="descriptionAiStatus descriptionCharacterCount"
                                required
                            >{{ old('description') }}</textarea>
                            <div class="description-field__meta">
                                <span class="ai-description-status" id="descriptionAiStatus" role="status" aria-live="polite"></span>
                                <span class="description-character-count" id="descriptionCharacterCount">0 / 1500</span>
                            </div>
                        </div>

                        <button type="button" class="continue-btn step-next">Continue to Contact Details →</button>
                    </section>

                    <section class="form-step-section" data-form-step="2">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Your Name <span>*</span></label>
                                <input type="text" name="customer_name" id="nameInput" value="{{ old('customer_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Email <span>*</span></label>
                                <input type="email" name="email" id="emailInput" value="{{ old('email') }}" placeholder="Enter your email" title="Enter valid email address" required>
                                <span class="field-error"></span>
                            </div>
                        </div>

                        <div class="form-row one-column-row">
                            <div class="form-group">
                                <label>Phone <span>*</span></label>
                                <input type="tel" name="phone" id="phoneInput" value="{{ old('phone') }}" placeholder="Enter your phone number" title="Enter valid phone number" required>
                                <span class="field-error"></span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="back-btn step-back">Back</button>
                            <button type="button" class="continue-btn step-next">Review Request →</button>
                        </div>
                    </section>

                    <section class="form-step-section" data-form-step="3">
                        <div class="review-card">
                            <div class="review-card-header">
                                <h3>Review your request</h3>
                                <button type="button" class="text-edit-btn" data-go-step="1">Edit job details</button>
                            </div>

                            <div class="review-grid">
                                <div>
                                    <span>Business</span>
                                    <strong data-review="preferred_business">—</strong>
                                </div>
                                <div>
                                    <span>Service</span>
                                    <strong data-review="service">—</strong>
                                </div>
                                <div>
                                    <span>Location</span>
                                    <strong data-review="location">—</strong>
                                </div>
                                <div>
                                    <span>Budget</span>
                                    <strong data-review="budget">—</strong>
                                </div>
                                <div>
                                    <span>Name</span>
                                    <strong data-review="customer_name">—</strong>
                                </div>
                                <div>
                                    <span>Phone</span>
                                    <strong data-review="phone">—</strong>
                                </div>
                                <div>
                                    <span>Email</span>
                                    <strong data-review="email">—</strong>
                                </div>
                                <div class="review-full">
                                    <span>Job description</span>
                                    <p class="review-description" data-review="description">—</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="back-btn step-back">Back</button>
                            <button type="submit" class="continue-btn">Submit Quote Request →</button>
                        </div>
                    </section>
                </form>
            </main>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('quoteForm');
        const sections = [...document.querySelectorAll('[data-form-step]')];
        const sidebarSteps = [...document.querySelectorAll('[data-sidebar-step]')];
        const progressBars = [...document.querySelectorAll('.step-progress__bar')];
        const progressText = document.querySelector('.step-progress__label');
        const totalSteps = sections.length;
        let currentStep = 1;

        function isStepComplete(stepNumber) {
            const section = form.querySelector(`[data-form-step="${stepNumber}"]`);

            if (!section) {
                return false;
            }

            const requiredFields = [...section.querySelectorAll('[required]')];

            return requiredFields.every((field) => field.checkValidity());
        }

        function showStep(step) {
            currentStep = step;

            sections.forEach((section) => {
                section.classList.toggle('active', Number(section.dataset.formStep) === step);
            });

            sidebarSteps.forEach((item) => {
                const itemStep = Number(item.dataset.sidebarStep);
                item.classList.toggle('step-list__item--active', itemStep === step);
                item.classList.toggle('step-list__item--complete', itemStep < step && isStepComplete(itemStep));
            });

            progressBars.forEach((bar, index) => {
                const barStep = index + 1;

                bar.classList.toggle('step-progress__bar--active', barStep === step);
                bar.classList.toggle('step-progress__bar--complete', barStep < step && isStepComplete(barStep));
            });

            progressText.textContent = `Step ${step} of ${totalSteps}`;

            if (step === totalSteps) {
                updateReview();
            }
        }

        const validationOptions = { wrapperSelector: '.form-group' };

        function currentFieldsAreValid() {
            const currentSection = form.querySelector(`[data-form-step="${currentStep}"]`);
            return FormValidation.validateContainer(currentSection, validationOptions);
        }

        sidebarSteps.forEach((item) => {
            const stepNumber = Number(item.dataset.sidebarStep);
            const linkedSection = form.querySelector(`[data-form-step="${stepNumber}"]`);

            if (!linkedSection) {
                return;
            }

            item.classList.add('step-list__item--available');
            item.setAttribute('role', 'button');
            item.setAttribute('tabindex', '0');

            function openStep() {
                showStep(stepNumber);
            }

            item.addEventListener('click', openStep);
            item.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    openStep();
                }
            });
        });

        function fieldValue(name) {
            const field = form.elements[name];
            if (!field) return '—';
            return field.value.trim() || '—';
        }

        function updateReview() {
            document.querySelectorAll('[data-review]').forEach((item) => {
                item.textContent = fieldValue(item.dataset.review);
            });
        }

        document.querySelectorAll('.step-next').forEach((button) => {
            button.addEventListener('click', () => {
                if (currentFieldsAreValid() && currentStep < totalSteps) {
                    showStep(currentStep + 1);
                }
            });
        });

        document.querySelectorAll('.step-back').forEach((button) => {
            button.addEventListener('click', () => {
                if (currentStep > 1) {
                    showStep(currentStep - 1);
                }
            });
        });

        document.querySelectorAll('[data-go-step]').forEach((button) => {
            button.addEventListener('click', () => showStep(Number(button.dataset.goStep)));
        });

        form.addEventListener('submit', (event) => {
            const firstIncompleteIndex = sections.findIndex((section, index) => !isStepComplete(index + 1));

            if (firstIncompleteIndex === -1) {
                return;
            }

            event.preventDefault();

            const incompleteStep = firstIncompleteIndex + 1;
            showStep(incompleteStep);
            currentFieldsAreValid();
        });

        const emailInput = document.getElementById('emailInput');
        const phoneInput = document.getElementById('phoneInput');

        FormValidation.bindContactFields([emailInput, phoneInput], validationOptions);
        FormValidation.bindRequiredFields(form, validationOptions);

        const descriptionInput = document.getElementById('descriptionInput');
        const improveDescriptionButton = document.getElementById('improveDescriptionButton');
        const improveDescriptionLabel = improveDescriptionButton?.querySelector('.ai-improve-btn__label');
        const descriptionAiStatus = document.getElementById('descriptionAiStatus');
        const descriptionCharacterCount = document.getElementById('descriptionCharacterCount');
        const descriptionMaxLength = Number(descriptionInput?.maxLength) || 1500;
        let descriptionRequestInProgress = false;

        function updateDescriptionCharacterCount() {
            if (!descriptionInput || !descriptionCharacterCount) {
                return;
            }

            descriptionCharacterCount.textContent = `${descriptionInput.value.length} / ${descriptionMaxLength}`;
        }

        function setDescriptionAiStatus(message, state = '') {
            if (!descriptionAiStatus) {
                return;
            }

            descriptionAiStatus.textContent = message;
            descriptionAiStatus.dataset.state = state;
        }

        function setDescriptionLoading(isLoading) {
            descriptionRequestInProgress = isLoading;
            improveDescriptionButton.disabled = isLoading;
            improveDescriptionButton.classList.toggle('ai-improve-btn--loading', isLoading);
            improveDescriptionButton.setAttribute('aria-busy', String(isLoading));
            improveDescriptionLabel.textContent = isLoading ? 'Improving...' : 'Improve with AI';
        }

        descriptionInput?.addEventListener('input', updateDescriptionCharacterCount);

        improveDescriptionButton?.addEventListener('click', async () => {
            if (descriptionRequestInProgress) {
                return;
            }

            const originalDescription = descriptionInput.value.trim();

            if (originalDescription === '') {
                setDescriptionAiStatus('Enter a job description before using AI.', 'error');
                descriptionInput.focus();
                return;
            }

            if (originalDescription.length > descriptionMaxLength) {
                setDescriptionAiStatus(`The job description must not exceed ${descriptionMaxLength} characters.`, 'error');
                descriptionInput.focus();
                return;
            }

            setDescriptionLoading(true);
            setDescriptionAiStatus('Improving your description...', 'loading');

            try {
                const response = await fetch(improveDescriptionButton.dataset.url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({ description: originalDescription }),
                });
                const data = await response.json().catch(() => ({}));
                const remaining = response.headers.get('X-RateLimit-Remaining') ?? data.remaining;

                if (!response.ok) {
                    const validationMessage = data.errors?.description?.[0];
                    const fallbackMessage = response.status === 429
                        ? 'You have reached today\'s AI improvement limit. Please try again tomorrow.'
                        : 'We could not improve the description right now. Your original text has not been changed.';

                    setDescriptionAiStatus(validationMessage || data.message || fallbackMessage, 'error');
                    return;
                }

                if (typeof data.description !== 'string' || data.description.trim() === '') {
                    setDescriptionAiStatus('The AI returned an empty description. Your original text has not been changed.', 'error');
                    return;
                }

                descriptionInput.value = data.description.trim();
                descriptionInput.dispatchEvent(new Event('input', { bubbles: true }));

                const remainingMessage = remaining !== null && remaining !== undefined
                    ? ` ${remaining} AI improvement${Number(remaining) === 1 ? '' : 's'} remaining today.`
                    : '';

                setDescriptionAiStatus(`${data.message || 'Description improved. Review it before continuing.'}${remainingMessage}`, 'success');
                descriptionInput.focus();
            } catch (error) {
                setDescriptionAiStatus('We could not connect to the AI service. Your original text has not been changed.', 'error');
            } finally {
                setDescriptionLoading(false);
            }
        });

        updateDescriptionCharacterCount();

        showStep(1);
    </script>
@endpush
