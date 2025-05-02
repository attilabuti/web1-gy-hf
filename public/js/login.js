function _initPage() {
    const loginForm = document.querySelector('#login');
    if (loginForm !== null && loginForm !== undefined) {
        loginForm.addEventListener('submit', checkLoginForm);
    }
}

function checkLoginForm(e) {
    e.preventDefault();

    const result = validate.check([{
        el: document.querySelector('#email'),
        rules: [
            { rule: 'required', message: 'Az e-mail cím megadása kötelező.' },
            { rule: 'is:mail',  message: 'Érvényes e-mail cím megadása kötelező.' },
        ]
    }, {
        el: document.querySelector('#password'),
        rules: [
            { rule: 'required', message: 'A jelszó megadása kötelező.' },
        ]
    }]);

    if (result) {
        document.getElementById('login').submit();
    }
}
