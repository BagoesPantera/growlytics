import * as echarts from 'echarts';
import { formatRelativeTime, updateRelativeTimeElements } from './relative-time.js';

const chartEl = document.getElementById('item-price-chart');
const rangeButtons = document.querySelectorAll('[data-range]');
const recentContainer = document.getElementById('recent-worlds');
const loadMoreButton = document.getElementById('load-more-worlds');

let chart = null;
let currentRange = '24H';
let recentPage = 1;
let recentHasMore = false;
let loadingChart = false;
let serverTimeOffset = 0;
let serverTimeInitialized = false;
let relativeTimeTimer = null;

function formatNumber(value) {
    return new Intl.NumberFormat().format(value);
}

function initChart() {
    chart = echarts.init(chartEl, null, { renderer: 'canvas' });

    const resizeObserver = new ResizeObserver(() => {
        chart.resize();
    });

    resizeObserver.observe(chartEl);
}

function showChartState(state, message = '') {
    const loading = document.getElementById('chart-loading');
    const empty = document.getElementById('chart-empty');
    const error = document.getElementById('chart-error');
    const unavailable = document.getElementById('chart-unavailable');

    loading?.classList.toggle('hidden', state !== 'loading');
    empty?.classList.toggle('hidden', state !== 'empty');
    error?.classList.toggle('hidden', state !== 'error');
    unavailable?.classList.toggle('hidden', state !== 'unavailable');

    if (message && (state === 'error' || state === 'unavailable')) {
        const target = state === 'error' ? error : unavailable;
        if (target) {
            target.textContent = message;
        }
    }
}

async function loadPriceHistory(range) {
    if (loadingChart) {
        return;
    }

    loadingChart = true;
    currentRange = range;
    showChartState('loading');

    try {
        const itemId = chartEl.dataset.itemId;
        const response = await fetch(`/items/${itemId}/price-history?range=${encodeURIComponent(range)}`, {
            headers: { Accept: 'application/json' },
        });

        if (!response.ok) {
            throw new Error('Failed to load price history');
        }

        const payload = await response.json();

        if (payload.status === 'unavailable') {
            showChartState('unavailable', payload.message || 'Price history is unavailable for this item and range.');
            return;
        }

        if (payload.status !== 'ok') {
            throw new Error(payload.message || 'Price history unavailable');
        }

        updateSummary(payload);
        const hasData = renderChart(payload);
        showChartState(hasData ? 'ready' : 'empty');
    } catch (error) {
        showChartState('error', error.message);
    } finally {
        loadingChart = false;
    }
}

function updateSummary(payload) {
    const summary = payload.summary || {};
    const buy = summary.buy || {};
    const sell = summary.sell || {};

    const setText = (id, value) => {
        const element = document.getElementById(id);

        if (element) {
            element.textContent = value;
        }
    };

    setText('summary-buy-count', formatNumber(buy.count || 0));
    setText('summary-sell-count', formatNumber(sell.count || 0));
    setText('summary-buy-median', `Median ${buy.median === null ? '—' : formatNumber(buy.median)} WL`);
    setText('summary-sell-median', `Median ${sell.median === null ? '—' : formatNumber(sell.median)} WL`);
    setText('summary-buy-range', `${buy.min === null ? '—' : formatNumber(buy.min)} – ${buy.max === null ? '—' : formatNumber(buy.max)} WL`);
    setText('summary-sell-range', `${sell.min === null ? '—' : formatNumber(sell.min)} – ${sell.max === null ? '—' : formatNumber(sell.max)} WL`);
}

function renderChart(payload) {
    const buckets = payload.buckets || [];
    const scatter = payload.scatter || { buy: [], sell: [] };

    const times = buckets.map((bucket) => new Date(bucket.bucket_start));
    const sellMedian = buckets.map((bucket) => bucket.sell.median);
    const buyMedian = buckets.map((bucket) => bucket.buy.median);
    const sellP25 = buckets.map((bucket) => bucket.sell.p25);
    const sellP75 = buckets.map((bucket) => bucket.sell.p75);
    const buyP25 = buckets.map((bucket) => bucket.buy.p25);
    const buyP75 = buckets.map((bucket) => bucket.buy.p75);
    const volumeBuy = buckets.map((bucket) => bucket.buy.count);
    const volumeSell = buckets.map((bucket) => bucket.sell.count);

    const hasData = buckets.some((bucket) => bucket.buy.count > 0 || bucket.sell.count > 0);

    if (!hasData) {
        return false;
    }

    const option = {
        color: ['#F59E0B', '#06B6D4'],
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'cross' },
        },
        legend: {
            data: ['Sell median', 'Buy median'],
            top: 0,
        },
        grid: [
            { left: 64, right: 24, top: 32, height: '56%' },
            { left: 64, right: 24, top: '78%', height: '15%' },
        ],
        xAxis: [
            {
                type: 'time',
                gridIndex: 0,
                min: times.length ? times[0].getTime() : undefined,
                max: times.length ? times[times.length - 1].getTime() : undefined,
                boundaryGap: false,
                axisLabel: { show: false },
            },
            {
                type: 'time',
                gridIndex: 1,
                min: times.length ? times[0].getTime() : undefined,
                max: times.length ? times[times.length - 1].getTime() : undefined,
                boundaryGap: false,
                axisLabel: { hideOverlap: true, formatter: (value) => new Date(value).toLocaleString() },
            },
        ],
        yAxis: [
            { type: 'value', name: 'WL', nameLocation: 'end', nameGap: 12, gridIndex: 0 },
            { type: 'value', gridIndex: 1 },
        ],
        series: [
            {
                name: 'Sell median',
                type: 'line',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: times.map((time, index) => [time, sellMedian[index]]),
                smooth: true,
                connectNulls: true,
                lineStyle: { color: '#F59E0B', width: 2 },
                itemStyle: { color: '#F59E0B' },
            },
            {
                name: 'Sell p25-p75',
                type: 'line',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: times.map((time, index) => [time, sellP25[index]]),
                lineStyle: { opacity: 0 },
                stack: 'sell-band',
                symbol: 'none',
                areaStyle: { color: 'rgba(245, 158, 11, 0.12)' },
            },
            {
                name: 'Sell p75',
                type: 'line',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: times.map((time, index) => [time, sellP75[index]]),
                lineStyle: { opacity: 0 },
                stack: 'sell-band',
                symbol: 'none',
                areaStyle: { color: 'rgba(245, 158, 11, 0.12)' },
            },
            {
                name: 'Buy median',
                type: 'line',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: times.map((time, index) => [time, buyMedian[index]]),
                smooth: true,
                connectNulls: true,
                lineStyle: { color: '#06B6D4', width: 2 },
                itemStyle: { color: '#06B6D4' },
            },
            {
                name: 'Buy p25-p75',
                type: 'line',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: times.map((time, index) => [time, buyP25[index]]),
                lineStyle: { opacity: 0 },
                stack: 'buy-band',
                symbol: 'none',
                areaStyle: { color: 'rgba(6, 182, 212, 0.12)' },
            },
            {
                name: 'Buy p75',
                type: 'line',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: times.map((time, index) => [time, buyP75[index]]),
                lineStyle: { opacity: 0 },
                stack: 'buy-band',
                symbol: 'none',
                areaStyle: { color: 'rgba(6, 182, 212, 0.12)' },
            },
            {
                name: 'Sell listings',
                type: 'scatter',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: scatter.sell || [],
                symbolSize: 4,
                itemStyle: { color: 'rgba(245, 158, 11, 0.45)' },
            },
            {
                name: 'Buy listings',
                type: 'scatter',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: scatter.buy || [],
                symbolSize: 4,
                itemStyle: { color: 'rgba(6, 182, 212, 0.45)' },
            },
            {
                name: 'Sell volume',
                type: 'bar',
                xAxisIndex: 1,
                yAxisIndex: 1,
                data: times.map((time, index) => [time, volumeSell[index]]),
                itemStyle: { color: 'rgba(245, 158, 11, 0.6)' },
                barMaxWidth: 12,
            },
            {
                name: 'Buy volume',
                type: 'bar',
                xAxisIndex: 1,
                yAxisIndex: 1,
                data: times.map((time, index) => [time, volumeBuy[index]]),
                itemStyle: { color: 'rgba(6, 182, 212, 0.6)' },
                barMaxWidth: 12,
            },
        ],
    };

    chart.setOption(option, true);

    return true;
}

async function loadRecentWorlds(page = 1, append = false) {
    const itemId = chartEl.dataset.itemId;
    const response = await fetch(`/items/${itemId}/recent-worlds?page=${page}`, {
        headers: { Accept: 'application/json' },
    });

    if (!response.ok) {
        throw new Error('Failed to load recent worlds');
    }

    const payload = await response.json();
    const rows = payload.data || [];

    if (!append) {
        recentContainer.innerHTML = '';
    }

    const parsedServerTime = Date.parse(payload.server_now || payload.period?.end);

    if (!serverTimeInitialized && Number.isFinite(parsedServerTime)) {
        serverTimeOffset = parsedServerTime - Date.now();
        serverTimeInitialized = true;
    }

    rows.forEach((row) => {
        const card = document.createElement('div');
        card.className = 'rounded-2xl border border-[#E4EAF0] bg-white p-4 shadow-sm';

        const layout = document.createElement('div');
        layout.className = 'flex items-center justify-between gap-3';

        const left = document.createElement('div');

        const world = document.createElement('p');
        world.className = 'text-sm font-bold text-[#172B44]';
        world.textContent = row.world;

        const time = document.createElement('time');
        time.className = 'text-xs text-gray-500';
        time.dateTime = row.posted_at;
        time.dataset.relativeTime = 'true';
        time.title = formatAbsoluteTime(row.posted_at);
        time.textContent = formatRelativeTime(row.posted_at, currentServerNow());

        left.append(world, time);

        const right = document.createElement('div');
        right.className = 'text-right';

        const price = document.createElement('p');
        price.className = 'text-sm font-black text-[#172B44]';
        price.textContent = `${formatNumber(row.price_wl)} WL`;

        right.append(price);

        if (row.world_verified) {
            const verified = document.createElement('p');
            verified.className = 'text-xs text-[#2f7a27]';
            verified.textContent = 'Verified';
            right.append(verified);
        }

        if (row.url) {
            const source = document.createElement('a');
            source.href = row.url;
            source.target = '_blank';
            source.rel = 'noopener noreferrer';
            source.className = 'text-xs text-[#2f7a27] underline';
            source.textContent = 'Source';
            right.append(source);
        }

        layout.append(left, right);
        card.append(layout);
        recentContainer.appendChild(card);
    });

    updateRelativeTimes();
    ensureRelativeTimeUpdates();

    recentHasMore = payload.has_more;
    recentPage = payload.current_page;

    if (loadMoreButton) {
        loadMoreButton.classList.toggle('hidden', !recentHasMore);
    }
}

function currentServerNow() {
    return new Date(Date.now() + (Number.isFinite(serverTimeOffset) ? serverTimeOffset : 0));
}

function formatAbsoluteTime(value) {
    const date = new Date(value);

    if (Number.isNaN(date.getTime())) {
        return 'Unknown time';
    }

    return date.toLocaleString();
}

function updateRelativeTimes() {
    updateRelativeTimeElements(recentContainer, currentServerNow());
}

function hasRelativeTimeElements() {
    return Boolean(recentContainer?.querySelector('[data-relative-time]'));
}

function startRelativeTimeUpdates() {
    if (!hasRelativeTimeElements()) {
        return;
    }

    if (relativeTimeTimer) {
        clearInterval(relativeTimeTimer);
    }

    relativeTimeTimer = setInterval(updateRelativeTimes, 30000);
}

function ensureRelativeTimeUpdates() {
    if (!hasRelativeTimeElements()) {
        return;
    }

    updateRelativeTimes();
    startRelativeTimeUpdates();
}

function bootstrapItemDetail() {
    if (!chartEl) {
        return;
    }

    initChart();

    rangeButtons.forEach((button) => {
        button.addEventListener('click', () => {
            rangeButtons.forEach((item) => item.classList.remove('bg-[#FFD93D]', 'text-[#172B44]'));
            button.classList.add('bg-[#FFD93D]', 'text-[#172B44]');
            loadPriceHistory(button.dataset.range);
        });
    });

    const defaultButton = document.querySelector('[data-range="24H"]');
    if (defaultButton) {
        defaultButton.classList.add('bg-[#FFD93D]', 'text-[#172B44]');
    }

    loadPriceHistory('24H');
    loadRecentWorlds(1).catch(() => {});

    window.addEventListener('pagehide', () => {
        if (relativeTimeTimer) {
            clearInterval(relativeTimeTimer);
            relativeTimeTimer = null;
        }
    }, { once: true });

    window.addEventListener('pageshow', (event) => {
        if (event.persisted) {
            updateRelativeTimes();
            ensureRelativeTimeUpdates();
        }
    });

    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            updateRelativeTimes();
            ensureRelativeTimeUpdates();
        }
    });

    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', () => {
            if (recentHasMore) {
                loadRecentWorlds(recentPage + 1, true);
            }
        });
    }

    window.addEventListener('resize', () => {
        chart?.resize();
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrapItemDetail, { once: true });
} else {
    bootstrapItemDetail();
}
