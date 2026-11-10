export function formatRelativeTime(value, now = new Date()) {
    const date = value instanceof Date ? value : new Date(value);
    const reference = now instanceof Date ? now : new Date(now);

    if (Number.isNaN(date.getTime()) || Number.isNaN(reference.getTime())) {
        return 'Unknown time';
    }

    const differenceMs = date.getTime() - reference.getTime();
    const absoluteMs = Math.abs(differenceMs);

    if (absoluteMs < 5000) {
        return 'just now';
    }

    const formatter = new Intl.RelativeTimeFormat(undefined, { numeric: 'auto' });

    if (absoluteMs < 60000) {
        return formatter.format(Math.round(differenceMs / 1000), 'second');
    }

    if (absoluteMs < 3600000) {
        return formatter.format(Math.round(differenceMs / 60000), 'minute');
    }

    if (absoluteMs < 86400000) {
        return formatter.format(Math.round(differenceMs / 3600000), 'hour');
    }

    return formatter.format(Math.round(differenceMs / 86400000), 'day');
}

export function updateRelativeTimeElements(root = document, now = new Date()) {
    const reference = now instanceof Date ? now : new Date(now);

    if (Number.isNaN(reference.getTime())) {
        return;
    }

    (root || document).querySelectorAll('[data-relative-time]').forEach((element) => {
        const value = element.getAttribute('datetime') || element.dataset.timestamp || element.textContent;

        element.textContent = formatRelativeTime(value, reference);
    });
}

if (typeof window !== 'undefined') {
    window.GrowlyticsRelativeTime = {
        formatRelativeTime,
        updateRelativeTimeElements,
    };
}