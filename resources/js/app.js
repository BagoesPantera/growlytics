import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.itemSearch = function itemSearch() {
    return {
        query: '',
        open: false,
        loading: false,
        error: false,
        searched: false,
        results: [],
        activeIndex: -1,
        controller: null,
        timer: null,

        onInput() {
            this.activeIndex = -1;

            if (this.timer) {
                clearTimeout(this.timer);
            }

            const value = this.query.trim();

            if (value.length < 2) {
                this.results = [];
                this.open = false;
                this.loading = false;
                this.error = false;
                this.searched = false;

                return;
            }

            this.loading = true;
            this.open = true;
            this.error = false;

            this.timer = setTimeout(() => {
                this.performSearch(value);
            }, 300);
        },

        async performSearch(value) {
            if (this.controller) {
                this.controller.abort();
            }

            this.controller = new AbortController();

            try {
                const response = await fetch(
                    `/search/items?q=${encodeURIComponent(value)}&limit=8`,
                    {
                        headers: { Accept: 'application/json' },
                        signal: this.controller.signal,
                    }
                );

                if (!response.ok) {
                    throw new Error('Search failed');
                }

                const payload = await response.json();
                this.results = payload.data || [];
                this.searched = true;
                this.error = false;
            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }

                this.results = [];
                this.error = true;
                this.searched = true;
            } finally {
                this.loading = false;
            }
        },

        onKeyDown(event) {
            if (!this.open) {
                return;
            }

            if (event.key === 'ArrowDown') {
                event.preventDefault();
                this.activeIndex = Math.min(this.results.length - 1, this.activeIndex + 1);
                this.scrollActive();
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                this.activeIndex = Math.max(-1, this.activeIndex - 1);
                this.scrollActive();
            } else if (event.key === 'Enter') {
                if (this.activeIndex >= 0 && this.results[this.activeIndex]) {
                    event.preventDefault();
                    window.location.href = this.results[this.activeIndex].url;
                }
            } else if (event.key === 'Escape') {
                this.close();
            }
        },

        scrollActive() {
            this.$nextTick(() => {
                const element = this.$refs.list?.querySelector(`[data-index="${this.activeIndex}"]`);

                if (element) {
                    element.scrollIntoView({ block: 'nearest' });
                }
            });
        },

        select(item) {
            window.location.href = item.url;
        },

        close() {
            this.open = false;
            this.activeIndex = -1;
        },
    };
};

Alpine.start();

function initializeGuestPage() {
    document.querySelectorAll('[data-utc-datetime]').forEach((element) => {
        const value = element.getAttribute('data-utc-datetime');

        if (!value) {
            return;
        }

        const date = new Date(value);

        if (Number.isNaN(date.getTime())) {
            return;
        }

        element.textContent = new Intl.DateTimeFormat(undefined, {
            dateStyle: 'medium',
            timeStyle: 'short',
        }).format(date);
    });

    if (document.getElementById('item-price-chart')) {
        import('./item-detail.js');
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeGuestPage, { once: true });
} else {
    initializeGuestPage();
}
