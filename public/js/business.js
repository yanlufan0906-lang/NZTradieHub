const serviceRequestForm = document.querySelector('.service-request-form');
const formSteps = serviceRequestForm ? serviceRequestForm.querySelectorAll('.form-step') : [];
const nextButtons = serviceRequestForm ? serviceRequestForm.querySelectorAll('[data-next-step]') : [];
const backButtons = serviceRequestForm ? serviceRequestForm.querySelectorAll('[data-back-step]') : [];
const formHeadingStep = document.querySelector('.form-heading__eyebrow');
const formHeadingTitle = document.querySelector('.form-heading h2');
const formHeadingDescription = document.querySelector('.form-heading p');
const stepProgressLabel = document.querySelector('.step-progress__label');
const stepProgressBars = document.querySelectorAll('.step-progress__bar');
const sidebarStepItems = document.querySelectorAll('.step-list__item');
const totalSteps = sidebarStepItems.length;
const passwordField = serviceRequestForm ? serviceRequestForm.querySelector('input[name="password"]') : null;
const confirmPasswordField = serviceRequestForm ? serviceRequestForm.querySelector('input[name="confirmPassword"]') : null;

const registrationValidationOptions = {
    wrapperSelector: '.form-field',
    getMessage(field, getDefaultMessage) {
        if (field.type === 'file' && field.validity.customError) {
            return 'Upload a PDF, JPG or PNG file';
        }

        if (field.name === 'NZBN' && field.validity.patternMismatch) {
            return 'Enter valid 13 digit NZBN number';
        }

        if (field.name === 'password' && field.validity.patternMismatch) {
            return 'Minimum 8 characters with uppercase, lowercase, number and symbol';
        }

        if (field.name === 'confirmPassword' && field.validity.customError) {
            return 'Passwords do not match';
        }

        return getDefaultMessage(field);
    }
};

function showFieldError(field) {
    FormValidation.showFieldError(field, registrationValidationOptions);
}

function clearFieldError(field) {
    FormValidation.clearFieldError(field, registrationValidationOptions);
}

function validateStep(step) {
    if (step.contains(confirmPasswordField)) {
        updatePasswordMatch();
    }

    return FormValidation.validateContainer(step, registrationValidationOptions);
}

function isStepComplete(stepNumber) {
    const step = serviceRequestForm.querySelector(`[data-step="${stepNumber}"]`);

    if (!step) {
        return false;
    }

    const requiredFields = step.querySelectorAll('[required]');

    return [...requiredFields].every((field) => field.checkValidity());
}

function showFormStep(stepNumber) {
    const activeStep = serviceRequestForm.querySelector(`[data-step="${stepNumber}"]`);

    formSteps.forEach((step) => {
        step.classList.toggle('form-step--active', step.dataset.step === String(stepNumber));
    });

    const stepText = `Step ${stepNumber} of ${totalSteps}`;
    if (formHeadingStep) formHeadingStep.textContent = stepText;
    if (formHeadingTitle) formHeadingTitle.textContent = activeStep.dataset.title;
    if (formHeadingDescription) formHeadingDescription.textContent = activeStep.dataset.description;
    if (stepProgressLabel) stepProgressLabel.textContent = stepText;

    stepProgressBars.forEach((bar, index) => {
        const barStepNumber = index + 1;

        bar.classList.toggle('step-progress__bar--active', barStepNumber === stepNumber);
        bar.classList.toggle('step-progress__bar--complete', barStepNumber < stepNumber && isStepComplete(barStepNumber));
    });

    sidebarStepItems.forEach((item) => {
        const itemStepNumber = Number(item.dataset.step);

        item.classList.toggle('step-list__item--active', itemStepNumber === stepNumber);
        item.classList.toggle('step-list__item--complete', itemStepNumber < stepNumber && isStepComplete(itemStepNumber));
    });
}

function showRegistrationComplete() {
    stepProgressBars.forEach((bar, index) => {
        const barStepNumber = index + 1;

        bar.classList.remove('step-progress__bar--active');
        bar.classList.toggle('step-progress__bar--complete', barStepNumber <= totalSteps && isStepComplete(barStepNumber));
    });

    sidebarStepItems.forEach((item) => {
        const itemStepNumber = Number(item.dataset.step);

        item.classList.remove('step-list__item--active');
        item.classList.toggle('step-list__item--complete', itemStepNumber <= totalSteps && isStepComplete(itemStepNumber));
    });
}

if (serviceRequestForm) {
    sidebarStepItems.forEach((item) => {
        const stepNumber = Number(item.dataset.step);
        const linkedStep = serviceRequestForm.querySelector(`[data-step="${stepNumber}"]`);

        if (!linkedStep) {
            return;
        }

        item.classList.add('step-list__item--available');
        item.setAttribute('role', 'button');
        item.setAttribute('tabindex', '0');

        function openStep() {
            showFormStep(stepNumber);
        }

        item.addEventListener('click', openStep);
        item.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openStep();
            }
        });
    });

    nextButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const activeStep = serviceRequestForm.querySelector('.form-step--active');

            if (validateStep(activeStep)) {
                showFormStep(Number(button.dataset.nextStep));
            }
        });
    });

    backButtons.forEach((button) => {
        button.addEventListener('click', () => {
            showFormStep(Number(button.dataset.backStep));
        });
    });

    function updatePasswordMatch() {
        const hasMismatch = confirmPasswordField.value !== '' && confirmPasswordField.value !== passwordField.value;
        confirmPasswordField.setCustomValidity(hasMismatch ? 'Passwords do not match' : '');

        if (hasMismatch) {
            showFieldError(confirmPasswordField);
            return;
        }

        if (confirmPasswordField.value !== '') {
            clearFieldError(confirmPasswordField);
        }
    }

    function updatePasswordStrength() {
        if (passwordField.value !== '' && !passwordField.checkValidity()) {
            showFieldError(passwordField);
        } else if (passwordField.value !== '') {
            clearFieldError(passwordField);
        }

        updatePasswordMatch();
    }

    if (passwordField && confirmPasswordField) {
        passwordField.addEventListener('input', updatePasswordStrength);
        confirmPasswordField.addEventListener('input', updatePasswordMatch);
    }

    const nzbnField = serviceRequestForm.querySelector('[name="NZBN"]');

    if (nzbnField) {
        nzbnField.addEventListener('input', () => {
            nzbnField.value = nzbnField.value.replace(/\D/g, '').slice(0, 13);

            if (nzbnField.getAttribute('aria-invalid') === 'true') {
                if (nzbnField.checkValidity()) {
                    clearFieldError(nzbnField);
                } else {
                    showFieldError(nzbnField);
                }
            }
        });
    }

    const contactFields = serviceRequestForm.querySelectorAll(
        '[data-step="1"] input[type="email"], [data-step="1"] input[type="tel"]'
    );

    FormValidation.bindContactFields(contactFields, registrationValidationOptions);
    FormValidation.bindRequiredFields(serviceRequestForm, registrationValidationOptions);

    serviceRequestForm.addEventListener('submit', (event) => {
        const activeStep = serviceRequestForm.querySelector('.form-step--active');
        const activeStepNumber = Number(activeStep.dataset.step);

        if (activeStepNumber < totalSteps) {
            event.preventDefault();

            if (validateStep(activeStep)) {
                showFormStep(activeStepNumber + 1);
            }

            return;
        }

        if (!validateStep(activeStep)) {
            event.preventDefault();
            return;
        }

        event.preventDefault();
        const successMessage = activeStep.querySelector('.registration-success');
        const submitButton = activeStep.querySelector('button[type="submit"]');

        successMessage.hidden = false;
        submitButton.disabled = true;
        submitButton.textContent = 'Registration Complete';
        showRegistrationComplete();
    });
}
