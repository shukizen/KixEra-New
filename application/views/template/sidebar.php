<!-- Floating Sidebar Toggle Button -->
<button id="sidebarToggleBtn" class="fixed top-6 left-4 lg:left-[272px] z-50 bg-white text-slate-800 border border-slate-200 p-3 rounded-lg shadow-sm hover:bg-slate-50 transition-all duration-300 ease-in-out">
    <i id="sidebarToggleIcon" class="fas fa-bars text-xl"></i>
</button>

<!-- Overlay untuk mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

<!-- Sidebar -->
<?php
// Get current URI segment untuk menentukan menu aktif
$CI = &get_instance();
$segment2 = $CI->uri->segment(2);
// Mengambil segment ke-2 dari URL
?>
<aside id="sidebar" class="sidebar w-64 bg-white border-r border-slate-200 h-screen flex flex-col fixed left-0 top-0 z-40 transition-all duration-300 ease-in-out transform -translate-x-full lg:translate-x-0 overflow-hidden shadow-sm">
    <!-- Logo Area -->
    <div class="h-24 border-b border-slate-200 flex items-center justify-between px-6">
        <div class="flex items-center gap-2">
            <img src="<?= base_url('assets/img/logo/logo.svg') ?>" alt="KixEra Logo" class="h-25 w-auto dark:hidden">
            <img src="<?= base_url('assets/img/logo/logoPutih.svg') ?>" alt="KixEra Logo" class="h-25 w-auto hidden dark:block">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="<?= base_url('pemilik/pemilik_dashboard') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pemilik_dashboard') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-chart-line mr-3"></i>
            <?= lang_text('dashboard') ?>
        </a>

        <!-- Pesanan -->
        <a href="<?= base_url('pemilik/pesanan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pesanan') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-shopping-bag mr-3"></i>
            <?= lang_text('orders') ?>
        </a>

        <!-- Pelanggan -->
        <a href="<?= base_url('pemilik/pelanggan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pelanggan') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-users mr-3"></i>
            <?= lang_text('customers') ?>
        </a>

        <!-- Keuangan -->
        <a href="<?= base_url('pemilik/keuangan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'keuangan') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-dollar-sign mr-3"></i>
            <?= lang_text('finance') ?>
        </a>

        <!-- Layanan -->
        <a href="<?= base_url('pemilik/layanan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'layanan') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-concierge-bell mr-3"></i>
            Layanan
        </a>

        <!-- Inventory -->
        <a href="<?= base_url('pemilik/inventori') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'inventori') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-boxes mr-3"></i>
            <?= lang_text('inventory') ?>
        </a>

        <!-- Pengaturan -->
        <a href="<?= base_url('pemilik/pengaturan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-6 transition-colors <?= ($segment2 == 'pengaturan') ? 'bg-emerald-50 text-emerald-600 font-bold dark:bg-emerald-950/50 dark:text-emerald-400' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 dark:text-slate-300 dark:hover:bg-slate-700/50 dark:hover:text-emerald-400' ?>">
            <i class="fas fa-cog mr-3"></i>
            <?= lang_text('settings') ?>
        </a>

        <!-- Dark Mode Toggle -->
        <button id="themeToggleBtn" type="button" class="w-full flex items-center justify-between px-4 py-3 rounded-xl mb-2 transition-colors text-slate-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-700">
            <span class="flex items-center">
                <i id="themeToggleIcon" class="fas fa-moon mr-3"></i>
                <span id="themeToggleText">Mode Gelap</span>
            </span>
            <span class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" id="themeToggleCheckbox" class="sr-only peer">
                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500"></div>
            </span>
        </button>

        <!-- Logout -->
        <a href="<?= base_url('auth/logout') ?>"
            class="bg-red-50 text-red-600 dark:bg-red-950/20 dark:text-red-400 flex items-center px-4 py-3 rounded-xl font-medium hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
            <i class="fas fa-sign-out-alt mr-3"></i>
            <?= lang_text('logout') ?>
        </a>
    </nav>
</aside>

<!-- JavaScript untuk Toggle Sidebar - LETAKKAN SEBELUM PENUTUP </body> -->
<script>
    // Pastikan script ini berjalan setelah DOM ready
    (function() {
        'use strict';

        function initSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const toggleIcon = document.getElementById('sidebarToggleIcon');
            const overlay = document.getElementById('sidebarOverlay');
            const mainContent = document.querySelector('main');

            if (!sidebar || !toggleBtn || !toggleIcon || !overlay) {
                console.error('Sidebar elements not found');
                return;
            }

            // Adjust headers padding to prevent overlap with floating toggle button
            const headers = document.querySelectorAll('main header, header');
            headers.forEach(h => {
                if (h.closest('#sidebar')) return;
                h.style.paddingLeft = '80px';
            });

            // State variable
            let isSidebarOpen = window.innerWidth >= 1024;

            // Set initial state
            updateSidebarUI(isSidebarOpen);

            function updateSidebarUI(open) {
                if (open) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0', 'lg:translate-x-0');
                    toggleBtn.style.left = '272px';
                    toggleIcon.className = 'fas fa-bars text-xl';
                    if (window.innerWidth < 1024) {
                        overlay.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }
                    if (mainContent && window.innerWidth >= 1024) {
                        mainContent.classList.add('lg:ml-64');
                    }
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0', 'lg:translate-x-0');
                    toggleBtn.style.left = '16px'; // 16px is left-4
                    toggleIcon.className = 'fas fa-bars text-xl';
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                    if (mainContent) {
                        mainContent.classList.remove('lg:ml-64');
                    }
                }
            }

            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                isSidebarOpen = !isSidebarOpen;
                updateSidebarUI(isSidebarOpen);
            });

            overlay.addEventListener('click', function() {
                isSidebarOpen = false;
                updateSidebarUI(isSidebarOpen);
            });

            // Auto close sidebar saat link diklik (mobile)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        isSidebarOpen = false;
                        updateSidebarUI(isSidebarOpen);
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                const isDesktop = window.innerWidth >= 1024;
                if (isDesktop) {
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                    updateSidebarUI(isSidebarOpen);
                } else {
                    if (isSidebarOpen) {
                        overlay.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    } else {
                        overlay.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                    updateSidebarUI(isSidebarOpen);
                }
            });
        }

        // Jalankan saat DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSidebar);
        } else {
            initSidebar();
        }
    })();
</script>