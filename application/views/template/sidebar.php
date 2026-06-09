<!-- Mobile Menu Button (Hamburger) -->
<button id="mobileMenuBtn" class="fixed top-6 left-4 z-50 bg-white text-slate-800 border border-slate-200 p-3 rounded-lg shadow-sm hover:bg-slate-50 transition-all duration-300 lg:hidden">
    <i class="fas fa-bars text-xl"></i>
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
            <img src="<?= base_url('assets/img/logo/logo.svg') ?>" alt="KixEra Logo" class="h-25 w-auto">
        </div>
        <!-- Toggle button untuk mobile & desktop -->
        <button id="closeSidebarBtn" class="text-slate-500 text-2xl hover:text-slate-700 transition-colors">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="<?= base_url('pemilik/pemilik_dashboard') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pemilik_dashboard') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-chart-line mr-3"></i>
            <?= lang_text('dashboard') ?>
        </a>

        <!-- Pesanan -->
        <a href="<?= base_url('pemilik/pesanan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pesanan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-shopping-bag mr-3"></i>
            <?= lang_text('orders') ?>
        </a>

        <!-- Pelanggan -->
        <a href="<?= base_url('pemilik/pelanggan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pelanggan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-users mr-3"></i>
            <?= lang_text('customers') ?>
        </a>

        <!-- Keuangan -->
        <a href="<?= base_url('pemilik/keuangan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'keuangan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-dollar-sign mr-3"></i>
            <?= lang_text('finance') ?>
        </a>

        <!-- Layanan -->
        <a href="<?= base_url('pemilik/layanan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'layanan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-concierge-bell mr-3"></i>
            Layanan
        </a>

        <!-- Inventory -->
        <a href="<?= base_url('pemilik/inventori') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'inventori') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-boxes mr-3"></i>
            <?= lang_text('inventory') ?>
        </a>

        <!-- Pengaturan -->
        <a href="<?= base_url('pemilik/pengaturan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-6 transition-colors <?= ($segment2 == 'pengaturan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-cog mr-3"></i>
            <?= lang_text('settings') ?>
        </a>

        <!-- Logout -->
        <a href="<?= base_url('auth/logout') ?>"
            class="bg-red-50 text-red-600 flex items-center px-4 py-3 rounded-xl font-medium hover:bg-red-100 transition-colors">
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
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');
            const overlay = document.getElementById('sidebarOverlay');

            if (!sidebar || !mobileMenuBtn || !closeSidebarBtn || !overlay) {
                console.error('Sidebar elements not found');
                return;
            }

            console.log('Sidebar script loaded successfully');

            // Fungsi untuk membuka sidebar
            function openSidebar(e) {
                if (e) e.preventDefault();
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('lg:translate-x-0');
                if (window.innerWidth < 1024) {
                    overlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
                mobileMenuBtn.classList.remove('lg:opacity-0', 'lg:pointer-events-none');
                mobileMenuBtn.classList.add('hidden');
                
                const mainContent = document.querySelector('main');
                if (mainContent && window.innerWidth >= 1024) {
                    mainContent.classList.add('lg:ml-64');
                }
            }

            // Fungsi untuk menutup sidebar
            function closeSidebar(e) {
                if (e) e.preventDefault();
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('lg:translate-x-0');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
                
                mobileMenuBtn.classList.remove('lg:opacity-0', 'lg:pointer-events-none');
                mobileMenuBtn.classList.remove('hidden', 'lg:hidden');

                const mainContent = document.querySelector('main');
                if (mainContent) {
                    mainContent.classList.remove('lg:ml-64');
                }
            }// Event listeners
            mobileMenuBtn.addEventListener('click', openSidebar);
            closeSidebarBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Auto close sidebar saat link diklik (mobile)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    // Do not auto-open on resize if they explicitly closed it, just reset overlay
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                } else {
                    // On mobile, if sidebar doesn't have -translate-x-full, show overlay
                    if (!sidebar.classList.contains('-translate-x-full')) {
                        overlay.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }
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