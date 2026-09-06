document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-mobile-menu-toggle]');
    const menu = document.querySelector('[data-mobile-menu]');

    if (!toggle || !menu) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isHidden = menu.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', isHidden ? 'false' : 'true');
    });
});
