<!-- Mobile Menu Button (Hamburger) -->
<button id="mobileMenuBtn" class="lg:hidden fixed top-6 left-4 z-50 bg-teal-700 text-white p-3 rounded-lg shadow-lg hover:bg-teal-600 transition-colors">
    <i class="fas fa-bars text-xl"></i>
</button>

<!-- Overlay untuk mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

<!-- Sidebar -->
<?php 
// Get current URI segment untuk menentukan menu aktif
$CI =& get_instance();
$segment2 = $CI->uri->segment(2);
// Mengambil segment ke-2 dari URL
?>
<aside id="sidebar" class="sidebar w-64 bg-teal-700 h-screen flex flex-col fixed left-0 top-0 z-40 transition-all duration-300 ease-in-out transform -translate-x-full lg:translate-x-0 overflow-hidden">
    <!-- Logo Area -->
    <div class="h-24 border-b border-teal-600 flex items-center justify-between px-6">
        <div class="flex items-center gap-2">
            <img src="<?= base_url('assets/img/logo/logoPutih.svg') ?>" alt="KixEra Logo" class="h-25 w-auto">
        </div>
        <!-- Close button untuk mobile -->
        <button id="closeSidebarBtn" class="lg:hidden text-white text-2xl hover:text-teal-200 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="<?= base_url('pemilik/pemilik_dashboard') ?>" 
           class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pemilik_dashboard') ? 'gradient-emerald text-white font-medium' : 'text-teal-200 hover:bg-teal-600' ?>">
            <i class="fas fa-chart-line mr-3"></i>
            Dashboard
        </a>
        
        <!-- Pesanan -->
        <a href="<?= base_url('pemilik/pesanan') ?>" 
           class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pesanan') ? 'gradient-emerald text-white font-medium' : 'text-teal-200 hover:bg-teal-600' ?>">
            <i class="fas fa-shopping-bag mr-3"></i>
            Pesanan
        </a>
        
        <!-- Pelanggan -->
        <a href="<?= base_url('pemilik/pelanggan') ?>" 
           class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'pelanggan') ? 'gradient-emerald text-white font-medium' : 'text-teal-200 hover:bg-teal-600' ?>">
            <i class="fas fa-users mr-3"></i>
            Pelanggan
        </a>
        
        <!-- Keuangan -->
        <a href="<?= base_url('pemilik/keuangan') ?>" 
           class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'keuangan') ? 'gradient-emerald text-white font-medium' : 'text-teal-200 hover:bg-teal-600' ?>">
            <i class="fas fa-dollar-sign mr-3"></i>
            Keuangan
        </a>
        
        <!-- Inventory -->
        <a href="<?= base_url('pemilik/inventori') ?>" 
           class="flex items-center px-4 py-3 rounded-xl mb-2 transition-colors <?= ($segment2 == 'inventori') ? 'gradient-emerald text-white font-medium' : 'text-teal-200 hover:bg-teal-600' ?>">
            <i class="fas fa-boxes mr-3"></i>
            Inventori
        </a>
        
        <!-- Pengaturan -->
        <a href="<?= base_url('pemilik/pengaturan') ?>" 
           class="flex items-center px-4 py-3 rounded-xl mb-6 transition-colors <?= ($segment2 == 'pengaturan') ? 'gradient-emerald text-white font-medium' : 'text-teal-200 hover:bg-teal-600' ?>">
            <i class="fas fa-cog mr-3"></i>
            Pengaturan
        </a>
        
        <!-- Logout -->
        <a href="<?= base_url('auth/logout') ?>" 
           class="gradient-red flex items-center px-4 py-3 rounded-xl text-white font-medium hover:opacity-90 transition-opacity">
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
            console.log('Opening sidebar...');
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
       // Fungsi untuk menutup sidebar
function closeSidebar(e) {
    if (e) e.preventDefault();
    console.log('Closing sidebar...');
    sidebar.classList.add('-translate-x-full');
    sidebar.classList.remove('lg:translate-x-0'); // Tambahkan ini
    overlay.classList.add('hidden');
    document.body.style.overflow = '';
    
    // Untuk mobile, tambahkan class khusus
    if (window.innerWidth < 1024) {
        document.querySelector('main').classList.remove('lg:ml-64');
    }
}
        // Event listeners
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
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
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