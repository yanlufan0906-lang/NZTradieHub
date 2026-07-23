const loginForm = document.querySelector('.login-form');
const loginEmailField = document.querySelector('#login-email');

if (loginForm && loginEmailField) {
    const validationOptions = { wrapperSelector: '.login-form__field' };
    const validateLoginForm = () => FormValidation.validateContainer(loginForm, validationOptions);

    FormValidation.bindContactFields([loginEmailField], validationOptions);
    FormValidation.bindRequiredFields(loginForm, validationOptions);

    loginForm.addEventListener('submit', (event) => {
        if (!validateLoginForm()) {
            event.preventDefault();
        }
    });

    const loginButton = loginForm.querySelector('.submit-button');

    if (loginButton && loginButton.type === 'button') {
        loginButton.addEventListener('click', validateLoginForm);
    }
}
