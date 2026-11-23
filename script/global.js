/**
 * AMANAH STORE - GLOBAL INTERACTIVE CONTROLLER
 * Menangani drawer 'Lainnya', aktif tab navigasi, dan sistem toast notifikasi
 */

document.addEventListener('DOMContentLoaded', () => {
    initLainnyaModal();
    initActiveNav();
});

/**
 * Inisialisasi Modal Drawer 'Lainnya'
 */
function initLainnyaModal() {
    const btnLainnya = document.getElementById('btnNavLainnya');
    const modalOverlay = document.getElementById('modalLainnya');
    const modalCloseArea = document.getElementById('modalCloseArea');

    if (btnLainnya && modalOverlay) {
        btnLainnya.addEventListener('click', (e) => {
            e.preventDefault();
            modalOverlay.classList.add('show');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('show');
            }
        });

        if (modalCloseArea) {
            modalCloseArea.addEventListener('click', () => {
                modalOverlay.classList.remove('show');
            });
        }

        // Keyboard ESC to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modalOverlay.classList.contains('show')) {
                modalOverlay.classList.remove('show');
            }
        });
    }
}

/**
 * Menandai menu aktif pada Bottom Navigation secara otomatis
 */
function initActiveNav() {
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    const navItems = document.querySelectorAll('.bottom-nav .nav-item');

    navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href) {
            const targetPage = href.split('/').pop();
            if (targetPage === currentPath || (currentPath === '' && targetPage === 'index.html') || (currentPath === 'index.html' && targetPage === 'dashboard.html')) {
                navItems.forEach(n => n.classList.remove('active'));
                item.classList.add('active');
            }
        }
    });
}

/**
 * Universal Toast Notification
 * @param {string} message 
 * @param {'default'|'success'|'warning'} type 
 */
function showToast(message, type = 'default') {
    let toast = document.getElementById('appToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'appToast';
        toast.className = 'app-toast';
        document.body.appendChild(toast);
    }

    toast.className = `app-toast ${type}`;
    toast.innerHTML = `
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
      <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    <span>${message}</span>
  `;

    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 2600);
}
