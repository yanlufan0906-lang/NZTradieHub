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
const totalSteps = formSteps.length || sidebarStepItems.length;
const passwordField = serviceRequestForm ? serviceRequestForm.querySelector('input[name="password"]') : null;
const confirmPasswordField = serviceRequestForm ? serviceRequestForm.querySelector('input[name="confirmPassword"]') : null;

function getFieldWrapper(field) {
    return field.closest('.form-field') || field.closest('fieldset') || field.closest('label') || field.parentElement;
}

function getFieldError(field) {
    const wrapper = getFieldWrapper(field);

    if (!wrapper) {
        return null;
    }

    let error = wrapper.querySelector('.field-error');

    if (!error) {
        error = document.createElement('span');
        error.className = 'field-error';
        field.insertAdjacentElement('afterend', error);
    }

    return error;
}

function shouldValidateField(field) {
    if (field.disabled || field.type === 'hidden') {
        return false;
    }

    if (field.type === 'radio' || field.type === 'checkbox') {
        return field.required;
    }

    if (field.type === 'file') {
        return field.required || field.files.length > 0;
    }

    return field.required || String(field.value || '').trim() !== '';
}

function showFieldError(field) {
    const wrapper = getFieldWrapper(field);
    const error = getFieldError(field);
    let errorMessage = 'Required';

    if (field.type === 'file' && field.validity.customError) {
        errorMessage = 'Upload a PDF, JPG or PNG file';
    } else if (field.validity.valueMissing || !field.value.trim()) {
        errorMessage = 'Required';
    } else if (field.type === 'email') {
        errorMessage = 'Enter valid email address';
    } else if (field.type === 'tel') {
        errorMessage = 'Enter valid phone number';
    } else if (field.name === 'NZBN' && field.validity.patternMismatch) {
        errorMessage = 'Enter valid 13 digit NZBN number';
    } else if (field.name === 'password' && field.validity.patternMismatch) {
        errorMessage = 'Minimum 8 characters with uppercase, lowercase, number and symbol';
    } else if (field.name === 'confirmPassword' && field.validity.customError) {
        errorMessage = 'Passwords do not match';
    }

    if (wrapper) {
        wrapper.classList.add('form-field--error');
    }

    field.setAttribute('aria-invalid', 'true');

    if (error) {
        error.textContent = errorMessage;
    }
}

function clearFieldError(field) {
    const wrapper = getFieldWrapper(field);
    const error = wrapper?.querySelector('.field-error');

    if (wrapper) {
        wrapper.classList.remove('form-field--error');
    }

    field.removeAttribute('aria-invalid');

    if (error) {
        error.textContent = '';
    }
}

function validateStep(step) {
    if (step.contains(confirmPasswordField)) {
        updatePasswordMatch();
    }

    const fields = step.querySelectorAll('input, select, textarea');
    let firstInvalidField = null;

    fields.forEach((field) => {
        const shouldValidate = shouldValidateField(field);

        if (!shouldValidate || field.checkValidity()) {
            clearFieldError(field);
            return;
        }

        showFieldError(field);

        if (!firstInvalidField) {
            firstInvalidField = field;
        }
    });

    if (firstInvalidField) {
        firstInvalidField.focus();
        return false;
    }

    return true;
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

    const phoneNumberPattern = /^(?=(?:.*\d){7,})[\d\s+()-]+$/;
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

    serviceRequestForm.querySelectorAll('[data-step="1"] input[type="email"], [data-step="1"] input[type="tel"]').forEach((field) => {
        field.addEventListener('input', () => {
            const hasInvalidPhoneNumber = field.type === 'tel' && field.value !== '' && !phoneNumberPattern.test(field.value);

            if (field.type === 'tel') {
                field.setCustomValidity(hasInvalidPhoneNumber ? 'Enter valid phone number' : '');
            }

            if (field.value !== '' && (hasInvalidPhoneNumber || !field.checkValidity())) {
                showFieldError(field);
            } else if (field.value !== '') {
                clearFieldError(field);
            }
        });
    });

    serviceRequestForm.querySelectorAll('[required]').forEach((field) => {
        field.addEventListener('input', () => {
            if (field.checkValidity()) {
                clearFieldError(field);
            } else if (field.getAttribute('aria-invalid') === 'true') {
                showFieldError(field);
            }
        });

        field.addEventListener('change', () => {
            if (field.checkValidity()) {
                clearFieldError(field);
            } else if (field.getAttribute('aria-invalid') === 'true') {
                showFieldError(field);
            }
        });
    });

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

        for (const step of formSteps) {
            if (!validateStep(step)) {
                event.preventDefault();
                showFormStep(Number(step.dataset.step));

                setTimeout(() => {
                    const firstInvalidField = step.querySelector('[aria-invalid="true"], :invalid');
                    firstInvalidField?.focus();
                }, 0);

                return;
            }
        }

        const submitButton = activeStep.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'Submitting...';
        }
        showRegistrationComplete();
    });

    // File upload preview and drag/drop support for business logo, cover photo, ID, and license files.
    const allowedFileTypes = {
        image: ['image/jpeg', 'image/png', 'image/webp'],
        document: ['application/pdf', 'image/jpeg', 'image/png'],
    };
    const maxFileSizeBytes = 5 * 1024 * 1024;

    function fileSizeLabel(bytes) {
        if (bytes < 1024 * 1024) {
            return `${Math.max(1, Math.round(bytes / 1024))} KB`;
        }
        return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    }

    function setupFileUpload(input) {
        const uploadBox = input.closest('.profile-upload, .verification-upload');
        const wrapper = input.closest('.form-field');
        const preview = uploadBox?.querySelector('img');
        const title = uploadBox?.querySelector('.profile-upload__title, .verification-upload__title');
        const hint = uploadBox?.querySelector('.profile-upload__hint, .verification-upload__hint');
        const success = uploadBox?.querySelector('.verification-upload__success');
        const error = wrapper?.querySelector('.profile-upload__error, .verification-upload__error, .field-error');
        const profileUpload = uploadBox?.classList.contains('profile-upload');

        if (!uploadBox) return;

        function resetPreview() {
            input.setCustomValidity('');
            uploadBox.classList.remove('is-success');
            if (preview) {
                preview.hidden = true;
                preview.removeAttribute('src');
            }
            if (title) title.textContent = profileUpload ? 'Drop image here or browse' : 'Drop file here or browse';
            if (hint) hint.textContent = profileUpload ? 'JPG, PNG or WEBP' : 'PDF, JPG or PNG';
            if (success) success.hidden = true;
            if (error) error.textContent = '';
            if (wrapper) wrapper.classList.remove('form-field--error');
        }

        function showUploadError(message) {
            input.setCustomValidity(message);
            uploadBox.classList.remove('is-success');
            if (preview) preview.hidden = true;
            if (error) error.textContent = message;
            if (wrapper) wrapper.classList.add('form-field--error');
        }

        function showFile(file) {
            const isImage = file.type.startsWith('image/');
            const allowedTypes = profileUpload ? allowedFileTypes.image : allowedFileTypes.document;

            if (!allowedTypes.includes(file.type)) {
                showUploadError(profileUpload ? 'Please upload a JPG, PNG or WEBP image.' : 'Please upload a PDF, JPG or PNG file.');
                return;
            }

            if (file.size > maxFileSizeBytes) {
                showUploadError('File size must be 5 MB or smaller.');
                return;
            }

            input.setCustomValidity('');
            if (wrapper) wrapper.classList.remove('form-field--error');
            if (error) error.textContent = '';
            uploadBox.classList.add('is-success');

            if (title) title.textContent = file.name;
            if (hint) hint.textContent = `${file.type === 'application/pdf' ? 'PDF document' : 'Image file'} · ${fileSizeLabel(file.size)}`;
            if (success) {
                success.textContent = 'File selected';
                success.hidden = false;
            }

            if (preview && isImage) {
                preview.src = URL.createObjectURL(file);
                preview.hidden = false;
            } else if (preview) {
                preview.hidden = true;
                preview.removeAttribute('src');
            }

            clearFieldError(input);
        }

        input.addEventListener('change', () => {
            const file = input.files?.[0];
            if (!file) {
                resetPreview();
                return;
            }
            showFile(file);
        });

        ['dragenter', 'dragover'].forEach((eventName) => {
            uploadBox.addEventListener(eventName, (event) => {
                event.preventDefault();
                uploadBox.classList.add('is-dragover');
            });
        });

        ['dragleave', 'drop'].forEach((eventName) => {
            uploadBox.addEventListener(eventName, (event) => {
                event.preventDefault();
                uploadBox.classList.remove('is-dragover');
            });
        });

        uploadBox.addEventListener('drop', (event) => {
            const file = event.dataTransfer?.files?.[0];
            if (!file) return;

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;
            input.dispatchEvent(new Event('change', { bubbles: true }));
        });
    }

    serviceRequestForm.querySelectorAll('input[type="file"]').forEach(setupFileUpload);

    // Character counters for profile textareas.
    serviceRequestForm.querySelectorAll('[data-character-count]').forEach((field) => {
        const counter = field.parentElement?.querySelector('.character-count span');
        const updateCounter = () => {
            if (counter) counter.textContent = String(field.value.length);
        };
        field.addEventListener('input', updateCounter);
        updateCounter();
    });

    // Service areas selector: clickable dropdown + removable tags + hidden text value for form submission.
    const areasWidget = serviceRequestForm.querySelector('.areas-served');
    if (areasWidget) {
        const input = areasWidget.querySelector('.areas-served__input');
        const menu = areasWidget.querySelector('.areas-served__menu');
        const tags = areasWidget.querySelector('.areas-served__tags');
        const checkboxes = [...areasWidget.querySelectorAll('input[type="checkbox"]')];

        input.readOnly = true;

        function selectedAreas() {
            return checkboxes.filter((checkbox) => checkbox.checked).map((checkbox) => checkbox.value);
        }

        function updateAreas() {
            const values = selectedAreas();
            input.value = values.join(', ');
            tags.innerHTML = '';

            values.forEach((value) => {
                const tag = document.createElement('span');
                tag.className = 'areas-served__tag';
                tag.innerHTML = `${value} <button type="button" aria-label="Remove ${value}">×</button>`;
                tag.querySelector('button').addEventListener('click', () => {
                    const checkbox = checkboxes.find((item) => item.value === value);
                    if (checkbox) checkbox.checked = false;
                    updateAreas();
                });
                tags.appendChild(tag);
            });

            input.setCustomValidity(values.length ? '' : 'Select at least one service area');
            if (values.length) clearFieldError(input);
        }

        function openMenu() {
            menu.classList.add('is-open');
            input.setAttribute('aria-expanded', 'true');
        }

        function closeMenu() {
            menu.classList.remove('is-open');
            input.setAttribute('aria-expanded', 'false');
        }

        input.addEventListener('click', openMenu);
        input.addEventListener('focus', openMenu);
        checkboxes.forEach((checkbox) => checkbox.addEventListener('change', updateAreas));
        document.addEventListener('click', (event) => {
            if (!areasWidget.contains(event.target)) closeMenu();
        });
        updateAreas();
    }

}
