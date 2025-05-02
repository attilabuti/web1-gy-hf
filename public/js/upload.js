function _initPage() {
    const uploadForm = document.querySelector('#upload');
    if (uploadForm !== null && uploadForm !== undefined) {
        uploadForm.addEventListener('submit', checkUploadForm);
    }

    const fileInput = document.querySelector("#poster-file input[type=file]");
    fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            const fileName = document.querySelector("#poster-file .file-name");
            fileName.textContent = fileInput.files[0].name;
        }
    };
}

function checkUploadForm(e) {
    e.preventDefault();

    const result = validate.check([{
        el: document.querySelector('#title'),
        rules: [
            { rule: 'required', message: 'A filmcím megadása kötelező.' },
            { rule: 'max:120',  message: 'A film címe maximum $$ karakter hosszú lehet.' },
        ]
    }, {
        el: document.querySelector('#release_date'),
        rules: [
            { rule: 'required',    message: 'A megjelenés éve kitöltése kötelező.' },
            { rule: 'intmin:1800', message: 'A megjelenés éve nem lehet kevesebb mint $$.' },
            { rule: 'intmax:2030', message: 'A megjelenés éve nem lehet több mint $$.' },
        ]
    }, {
        el: document.querySelector('#description'),
        rules: [
            { rule: 'required', message: 'A lírás megadása kötelező.' },
            { rule: 'max:5000', message: 'A leírás maximum $$ karakter hosszú lehet.' },
        ]
    }, {
        el: document.querySelector('#trailer'),
        rules: [
            { rule: 'required', message: 'Az előzőteshez tartozó URL megadása kötelező.' },
            { rule: 'max:150',  message: 'Az előzőteshez tartozó URL maximum $$ karakter hosszú lehet.' },
        ]
    }, {
        el: document.querySelector('#poster'),
        rules: [
            { rule: 'required',   message: 'Fájl feltöltése kötelező.' },
            { rule: 'type:image', message: 'A fájl csak kép lehet (jpg, png, webp).' },
        ]
    }]);

    if (result) {
        document.getElementById('upload').submit();
    }
}
