import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-utc-datetime]').forEach((element) => {
        const value = element.getAttribute('data-utc-datetime');
        const date = new Date(value);

        if (Number.isNaN(date.getTime())) {
            return;
        }

        element.textContent = new Intl.DateTimeFormat(undefined, {
            dateStyle: 'medium',
            timeStyle: 'short',
        }).format(date);
    });
});
