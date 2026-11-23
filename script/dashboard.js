/**
 * AMANAH STORE - DASHBOARD CONTROLLER
 * Menangani filter waktu penjualan, interaksi kartu statistik, dan pencarian cepat
 */

document.addEventListener('DOMContentLoaded', () => {
    initDashboardPeriodFilters();
    initChartInteractions();
    initDashboardSearch();
});

function initDashboardPeriodFilters() {
    const periodPills = document.querySelectorAll('.filter-pill');
    periodPills.forEach(pill => {
        pill.addEventListener('click', () => {
            periodPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            showToast(`Menampilkan ringkasan data: ${pill.textContent.trim()}`, 'success');
        });
    });
}

function initChartInteractions() {
    const chartCols = document.querySelectorAll('.chart-col');
    chartCols.forEach(col => {
        col.addEventListener('click', () => {
            chartCols.forEach(c => c.classList.remove('active'));
            col.classList.add('active');
            const day = col.querySelector('.chart-label')?.textContent.trim();
            const val = col.querySelector('.chart-tooltip')?.textContent.trim() || 'Rp 2.450.000';
            showToast(`Penjualan ${day}: ${val}`, 'default');
        });
    });
}

function initDashboardSearch() {
    const searchInput = document.querySelector('.search-input');
    if (!searchInput) return;

    searchInput.addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase().trim();
        const trxItems = document.querySelectorAll('.trx-item');
        trxItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(term)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
}
