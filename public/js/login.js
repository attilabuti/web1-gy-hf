function _initPage() {
    const regForm = document.querySelector('#login');
    if (regForm !== null && regForm !== undefined) {
        regForm.addEventListener('submit', checkRegForm);
    }
}

function checkRegForm(e) {
    e.preventDefault();

    const emailEl      = document.querySelector('#email');
    const passwordEl   = document.querySelector('#password');

    const result = validate.check([{
        el: emailEl,
        rules: [
            { rule: 'required', message: 'Az e-mail cím megadása kötelező.' },
            { rule: 'is:mail',  message: 'Érvényes e-mail cím megadása kötelező.' },
        ]
    }, {
        el: passwordEl,
        rules: [
            { rule: 'required', message: 'A jelszó megadása kötelező.' },
        ]
    }]);

    if (result) {
        document.getElementById('login').submit();
    }
}
