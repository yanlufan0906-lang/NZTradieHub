(() => {
    const toggle = document.querySelector('.nav-toggle');
    const menu = document.getElementById('primaryNavigationActions');

    if (!toggle || !menu) {
        return;
    }

    const closeMenu = () => {
        menu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Open navigation menu');
    };

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';

        menu.classList.toggle('is-open', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
        toggle.setAttribute('aria-label', isOpen ? 'Open navigation menu' : 'Close navigation menu');
    });

    menu.addEventListener('click', (event) => {
        if (event.target.closest('a')) {
            closeMenu();
        }
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.navbar') && menu.classList.contains('is-open')) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && menu.classList.contains('is-open')) {
            closeMenu();
            toggle.focus();
        }
    });

    window.matchMedia('(min-width: 761px)').addEventListener('change', (event) => {
        if (event.matches) {
            closeMenu();
        }
    });
})();
