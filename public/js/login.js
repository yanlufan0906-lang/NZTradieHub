const loginForm = document.querySelector('.login-form');
const loginEmailField = document.querySelector('#login-email');
const loginPasswordField = document.querySelector('#login-password');
const quickDemoLoginField = document.querySelector('#quick-demo-login');

function getLoginFieldWrapper(field) {
    return field.closest('.login-form__field');
}

function showLoginFieldError(field) {
    const fieldWrapper = getLoginFieldWrapper(field);
    const error = fieldWrapper.querySelector('.field-error');
    const message = field.type === 'email' && field.value !== '' && !field.checkValidity()
        ? 'Enter valid email address'
        : 'Required';

    fieldWrapper.classList.add('form-field--error');
    field.setAttribute('aria-invalid', 'true');
    error.textContent = message;
}

function clearLoginFieldError(field) {
    const fieldWrapper = getLoginFieldWrapper(field);
    const error = fieldWrapper.querySelector('.field-error');

    fieldWrapper.classList.remove('form-field--error');
    field.removeAttribute('aria-invalid');
    error.textContent = '';
}

if (loginForm && loginEmailField && loginPasswordField) {
    loginEmailField.addEventListener('input', () => {
        if (loginEmailField.value !== '' && !loginEmailField.checkValidity()) {
            showLoginFieldError(loginEmailField);
        } else {
            clearLoginFieldError(loginEmailField);
        }
    });

    [loginEmailField, loginPasswordField].forEach((field) => {
        field.addEventListener('input', () => {
            if (field.value !== '' && field.checkValidity()) {
                clearLoginFieldError(field);
            } else if (field.getAttribute('aria-invalid') === 'true') {
                showLoginFieldError(field);
            }
        });
    });

    function validateLoginFormAndPreventIfInvalid() {
        const emailBlank = loginEmailField.value.trim() === '';
        const passwordBlank = loginPasswordField.value.trim() === '';

        // Client presentation shortcut: if both fields are blank, the system signs in with the default business account.
        // The form still looks like a normal login page and does not expose credentials on screen.
        if (emailBlank && passwordBlank) {
            if (quickDemoLoginField) {
                quickDemoLoginField.value = '1';
            }
            clearLoginFieldError(loginEmailField);
            clearLoginFieldError(loginPasswordField);
            return true;
        }

        if (quickDemoLoginField) {
            quickDemoLoginField.value = '0';
        }

        let firstInvalidField = null;

        [loginEmailField, loginPasswordField].forEach((field) => {
            if (field.value.trim() !== '' && field.checkValidity()) {
                clearLoginFieldError(field);
                return;
            }

            if (!firstInvalidField) {
                firstInvalidField = field;
            }

            showLoginFieldError(field);
        });

        if (firstInvalidField) {
            firstInvalidField.focus();
            return false;
        }

        return true;
    }

    loginForm.addEventListener('submit', (event) => {
        const isValid = validateLoginFormAndPreventIfInvalid();
        if (!isValid) {
            event.preventDefault();
        }
    });
}
