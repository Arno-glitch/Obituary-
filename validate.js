document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('obituary-form');
    if (!form) return;

    var fields = {
        name: { el: form.querySelector('#name'), message: 'Please enter a name.' },
        date_of_birth: { el: form.querySelector('#date_of_birth'), message: 'Please enter a date of birth.' },
        date_of_death: { el: form.querySelector('#date_of_death'), message: 'Please enter a date of death.' },
        content: { el: form.querySelector('#content'), message: 'Please write the obituary content (at least 20 characters).' },
        author: { el: form.querySelector('#author'), message: 'Please enter the submitting author\'s name.' },
    };

    function showError(key, message) {
        var errorEl = form.querySelector('.field-error[data-for="' + key + '"]');
        if (errorEl) errorEl.textContent = message || '';
    }

    function clearErrors() {
        Object.keys(fields).forEach(function (key) { showError(key, ''); });
    }

    function validate() {
        clearErrors();
        var valid = true;

        if (!fields.name.el.value.trim()) {
            showError('name', fields.name.message);
            valid = false;
        }

        if (!fields.date_of_birth.el.value) {
            showError('date_of_birth', fields.date_of_birth.message);
            valid = false;
        }

        if (!fields.date_of_death.el.value) {
            showError('date_of_death', fields.date_of_death.message);
            valid = false;
        }

        if (fields.date_of_birth.el.value && fields.date_of_death.el.value &&
            fields.date_of_birth.el.value > fields.date_of_death.el.value) {
            showError('date_of_death', 'Date of death must be after date of birth.');
            valid = false;
        }

        if (fields.content.el.value.trim().length < 20) {
            showError('content', fields.content.message);
            valid = false;
        }

        if (!fields.author.el.value.trim()) {
            showError('author', fields.author.message);
            valid = false;
        }

        return valid;
    }

    form.addEventListener('submit', function (event) {
        if (!validate()) {
            event.preventDefault();
        }
    });
});
