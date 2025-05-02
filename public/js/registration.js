function _initPage() {
    const regForm = document.querySelector('#registration');
    if (regForm !== null && regForm !== undefined) {
        regForm.addEventListener('submit', checkRegForm);
    }
}

function checkRegForm(e) {
    e.preventDefault();

    const usernameEl   = document.querySelector('#username');
    const emailEl      = document.querySelector('#email');
    const passwordEl   = document.querySelector('#password');
    const passwordReEl = document.querySelector('#password_re');
    const lastNameEl   = document.querySelector('#last_name');
    const firstNameEl  = document.querySelector('#first_name');

    const result = validate.check([{
        el: usernameEl,
        rules: [
            { rule: 'required', message: 'A felhasználónév kitöltése kötelező.' },
            { rule: 'min:4',    message: 'A felhasználónév legalább $$ karakter hosszúnak kell lennie.' },
            { rule: 'max:20',   message: 'A felhasználónév maximum $$ karakter hosszú lehet.' },
        ]
    }, {
        el: emailEl,
        rules: [
            { rule: 'required', message: 'Az e-mail cím megadása kötelező.' },
            { rule: 'is:mail',  message: 'Érvényes e-mail cím megadása kötelező.' },
        ]
    }, {
        el: passwordEl,
        rules: [
            { rule: 'required', message: 'A jelszó megadása kötelező.' },
            { rule: 'min:5',    message: 'A jelszónak legalább $$ karakter hosszúnak kell lennie.' },
        ]
    }, {
        el: passwordReEl,
        rules: [
            { rule: 'equal:#password', message: 'A két jelszónak meg kell egyeznie.' },
        ]
    }, {
        el: lastNameEl,
        rules: [
            { rule: 'required', message: 'A családnév megadása kötelező.' },
            { rule: 'max:50',   message: 'A családnév maximum $$ karakter hosszú lehet.' },
        ]
    }, {
        el: firstNameEl,
        rules: [
            { rule: 'required', message: 'Az utónév megadása kötelező.' },
            { rule: 'max:50',   message: 'Az utónév maximum $$ karakter hosszú lehet.' },
        ]
    }]);

    if (result) {
        document.getElementById('registration').submit();
    }
}
