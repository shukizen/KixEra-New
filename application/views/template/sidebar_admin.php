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
            <img src="<?= base_url('assets/img/logo/logo.svg') ?>" alt="KixEra Logo" class="h-25 w-auto">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="<?= base_url('admin/dashboard') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'dashboard') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-chart-line mr-3"></i>
            Dashboard
        </a>

        <!-- Manajemen Pengguna -->
        <a href="<?= base_url('admin/user_management') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'user_management') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-users-cog mr-3"></i>
            Manajemen Pengguna
        </a>

        <!-- Paket Langganan -->
        <a href="<?= base_url('admin/paket_langganan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'paket_langganan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-box mr-3"></i>
            Paket Langganan
        </a>

        <!-- Penagihan -->
        <a href="<?= base_url('admin/penagihan') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'penagihan') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-file-invoice-dollar mr-3"></i>
            Penagihan
        </a>

        <!-- Monitoring Sistem -->
        <a href="<?= base_url('admin/monitoring_sistem') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'monitoring_sistem') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-desktop mr-3"></i>
            Monitoring Sistem
        </a>

        <!-- Data Operasional -->
        <a href="<?= base_url('admin/data_operasional') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'data_operasional') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-database mr-3"></i>
            Data Operasional
        </a>

        <!-- Data Master -->
        <a href="<?= base_url('admin/data_master') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'data_master') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-folder mr-3"></i>
            Data Master
        </a>

        <!-- Notifikasi -->
        <a href="<?= base_url('admin/notifikasi') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'notifikasi') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-bell mr-3"></i>
            Notifikasi
        </a>

        <!-- Backup & Restore -->
        <a href="<?= base_url('admin/backup_restore') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'backup_restore') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-cloud-upload-alt mr-3"></i>
            Backup & Restore
        </a>

        <!-- Helpdesk -->
        <a href="<?= base_url('admin/helpdesk') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'helpdesk') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-headset mr-3"></i>
            Helpdesk
        </a>

        <!-- Profil -->
        <a href="<?= base_url('admin/profil') ?>"
            class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'profil') ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-600' ?>">
            <i class="fas fa-user-circle mr-3"></i>
            Profil
        </a>

        <!-- Logout -->
        <a href="<?= base_url('admin/logout') ?>"
            class="bg-red-50 text-red-600 flex items-center px-4 py-3 rounded-xl font-medium hover:bg-red-100 transition-colors mt-4">
            <i class="fas fa-sign-out-alt mr-3"></i>
            Logout
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