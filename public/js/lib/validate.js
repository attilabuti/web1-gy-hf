const validate = {
    check(ruleSet) {
        for (let i = 0; i < ruleSet.length; i++) {
            const inputEl = ruleSet[i].el;

            if (ruleSet[i].rules === undefined || ruleSet[i].rules === null) {
                continue;
            }

            for (let x = 0; x < ruleSet[i].rules.length; x++) {
                const rule = ruleSet[i].rules[x];
                let currentRule = rule.rule;

                if (currentRule === 'required') {
                    if (!this._required(inputEl.value)) {
                        this._setError(inputEl, rule.message);
                        return false;
                    }
                } else if (currentRule.includes('min:')) {
                    let minLength = parseInt(currentRule.replace('min:', ''));

                    if (!this._minLength(inputEl.value, minLength)) {
                        this._setError(inputEl, rule.message.replace('$$', minLength));
                        return false;
                    }
                } else if (currentRule.includes('max:')) {
                    let maxLength = parseInt(currentRule.replace('max:', ''));

                    if (!this._maxLength(inputEl.value, maxLength)) {
                        this._setError(inputEl, rule.message.replace('$$', maxLength));
                        return false;
                    }
                } else if (currentRule.includes('equal:')) {
                    let otherInput = currentRule.replace('equal:', '');

                    let value1 = inputEl.value;
                    let value2 = document.querySelector(otherInput).value;

                    if (value1 !== value2) {
                        this._setError(inputEl, rule.message);
                        return false;
                    }
                } else if (currentRule.includes('is:')) {
                    let subRule = currentRule.replace('is:', '');

                    if (subRule == 'mail') {
                        if (!this._isValidEmail(inputEl.value)) {
                            this._setError(inputEl, rule.message);
                            return false;
                        }
                    }
                }

                this._removeError(inputEl);
            }
        }

        return true;
    },

    _setError(inputEl, message) {
        inputEl.classList.add('is-danger');

        const field = inputEl.closest('.field');

        const existMsg = field.querySelector('.help');
        if (existMsg) {
            existMsg.remove();
        }

        const errorMsg = document.createElement('p');
        errorMsg.className = 'help is-danger';
        errorMsg.textContent = message;

        field.appendChild(errorMsg);
    },

    _removeError(inputEl) {
        inputEl.classList.remove('is-danger');

        const existMsg = inputEl.closest('.field').querySelector('.help');
        if (existMsg) {
            existMsg.remove();
        }
    },

    _required(value) {
        if (value === null || value === undefined) {
            return false;
        }

        if (typeof value === 'string') {
            value = value.trim();
            return value.length === 0 ? false : true;
        }

        return true;
    },

    _email(value) {
        if (!_isString(value)) {
            return false;
        }

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(value);
    },

    _minLength(value, length) {
        return !this._isString(value) ? false : (value.length >= length);
    },

    _maxLength(value, length) {
        return !this._isString(value) ? false : (value.length <= length);
    },

    _isValidEmail(value) {
        return value.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    },

    _isString(value) {
        if (value === null || value === undefined) {
            return false;
        }

        if (typeof value !== 'string') {
            return false;
        }

        return true;
    },
};
