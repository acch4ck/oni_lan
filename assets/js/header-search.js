(function () {
    'use strict';

    document.querySelectorAll('[data-inline-search]').forEach(function (search) {
        var toggle = search.querySelector('[data-search-toggle]');
        var form = search.querySelector('[data-search-form]');
        var input = search.querySelector('[data-search-input]');
        var submit = search.querySelector('[data-search-submit]');
        var openLabel = toggle ? toggle.getAttribute('data-open-label') : '';
        var closeLabel = toggle ? toggle.getAttribute('data-close-label') : '';

        if (!toggle || !form || !input || !submit) {
            return;
        }

        function setOpen(open, returnFocus) {
            search.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? closeLabel : openLabel);
            form.setAttribute('aria-hidden', open ? 'false' : 'true');
            input.tabIndex = open ? 0 : -1;
            submit.tabIndex = open ? 0 : -1;

            if (open) {
                window.requestAnimationFrame(function () {
                    input.focus();
                });
            } else if (returnFocus) {
                toggle.focus();
            }
        }

        toggle.addEventListener('click', function () {
            setOpen(!search.classList.contains('is-open'), true);
        });

        form.addEventListener('submit', function (event) {
            if (!input.value.trim()) {
                event.preventDefault();
                input.focus();
            }
        });

        search.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && search.classList.contains('is-open')) {
                event.preventDefault();
                setOpen(false, true);
            }
        });

        document.addEventListener('click', function (event) {
            if (search.classList.contains('is-open') && !search.contains(event.target)) {
                setOpen(false, false);
            }
        });
    });
}());
