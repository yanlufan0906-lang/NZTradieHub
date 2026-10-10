(function (window) {
    'use strict';

    const phoneNumberPattern = /^(?=(?:.*\d){7,})[\d\s+()-]+$/;
    const defaultWrapperSelector = '.form-field, .form-group, .login-form__field';

    function getFieldWrapper(field, options = {}) {
        return field.closest(options.wrapperSelector || defaultWrapperSelector);
    }

    function getFieldError(field, options = {}) {
        const wrapper = getFieldWrapper(field, options);
        let error = wrapper ? wrapper.querySelector('.field-error') : null;

        if (!error) {
            error = document.createElement('span');
            error.className = 'field-error';
            error.setAttribute('aria-live', 'polite');
            field.insertAdjacentElement('afterend', error);
        }

        return error;
    }

    function getDefaultMessage(field) {
        if (field.validity.valueMissing || (typeof field.value === 'string' && !field.value.trim())) {
            return 'Required';
        }

        if (field.type === 'email') {
            return 'Enter valid email address';
        }

        if (field.type === 'tel') {
            return 'Enter valid phone number';
        }

        return 'Required';
    }

    function getFieldMessage(field, options = {}) {
        return options.getMessage ? options.getMessage(field, getDefaultMessage) : getDefaultMessage(field);
    }

    function showFieldError(field, options = {}) {
        const wrapper = getFieldWrapper(field, options);
        const error = getFieldError(field, options);

        if (wrapper) {
            wrapper.classList.add('form-field--error');
        }

        field.setAttribute('aria-invalid', 'true');
        error.textContent = getFieldMessage(field, options);
    }

    function clearFieldError(field, options = {}) {
        const wrapper = getFieldWrapper(field, options);
        const error = wrapper ? wrapper.querySelector('.field-error') : null;

        if (wrapper) {
            wrapper.classList.remove('form-field--error');
        }

        field.removeAttribute('aria-invalid');

        if (error) {
            error.textContent = '';
        }
    }

    function validateField(field, options = {}) {
        if (field.checkValidity()) {
            clearFieldError(field, options);
            return true;
        }

        showFieldError(field, options);
        return false;
    }

    function validateContainer(container, options = {}) {
        const selector = options.selector || '[required]';
        let firstInvalidField = null;

        container.querySelectorAll(selector).forEach((field) => {
            if (!validateField(field, options) && !firstInvalidField) {
                firstInvalidField = field;
            }
        });

        if (firstInvalidField && options.focus !== false) {
            firstInvalidField.focus();
        }

        return !firstInvalidField;
    }

    function bindRequiredFields(container, options = {}) {
        const selector = options.selector || '[required]';

        container.querySelectorAll(selector).forEach((field) => {
            const updateError = () => {
                if (field.checkValidity()) {
                    clearFieldError(field, options);
                } else if (options.validateNonEmpty && field.value !== '') {
                    showFieldError(field, options);
                } else if (field.getAttribute('aria-invalid') === 'true') {
                    showFieldError(field, options);
                }
            };

            field.addEventListener('input', updateError);
            field.addEventListener('change', updateError);
        });
    }

    function updateContactValidity(field, options = {}) {
        const hasInvalidPhoneNumber = field.type === 'tel'
            && field.value !== ''
            && !phoneNumberPattern.test(field.value);

        if (field.type === 'tel') {
            field.setCustomValidity(hasInvalidPhoneNumber ? 'Enter valid phone number' : '');
        }

        if (field.value !== '' && (hasInvalidPhoneNumber || !field.checkValidity())) {
            showFieldError(field, options);
        } else if (field.value !== '') {
            clearFieldError(field, options);
        }
    }

    function bindContactFields(fields, options = {}) {
        [...fields].filter(Boolean).forEach((field) => {
            const updateValidity = () => updateContactValidity(field, options);

            field.addEventListener('input', updateValidity);
            field.addEventListener('change', updateValidity);

            if (field.value !== '') {
                updateValidity();
            }
        });
    }

    window.FormValidation = Object.freeze({
        bindContactFields,
        bindRequiredFields,
        clearFieldError,
        getDefaultMessage,
        showFieldError,
        updateContactValidity,
        validateContainer,
        validateField,
    });
})(window);
