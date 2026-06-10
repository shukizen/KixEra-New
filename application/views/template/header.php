<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KixEra Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Configure Tailwind CSS CDN to use class-based dark mode
    tailwind.config = {
        darkMode: 'class',
    }
    
    // Check localStorage or system preferences to apply dark mode immediately before page renders
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="icon" type="image/svg+xml" sizes="32x32" href="<?= base_url('assets/img/logo/logoPutih.svg') ?>">
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="<?= base_url('assets/img/logo/logoPutih.svg') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/logo/logoPutih.svg') ?>">
    <link rel="shortcut icon" type="image/svg+xml" href="<?= base_url('assets/img/logo/logoPutih.svg') ?>">
    <meta name="theme-color" content="#1E40AF">
    <meta name="msapplication-TileColor" content="#1E40AF">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    
    body {
        font-family: 'Inter', sans-serif;
    }
    
    .gradient-emerald {
        background-color: #10b981;
    }
    
    .gradient-red {
        background-color: #b91c1c;
    }
    
    /* Custom Scrollbar for Sidebar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    /* Fix untuk mencegah tombol hamburger menutupi teks header saat sidebar tertutup */
    @media (max-width: 1023px) {
        main header { padding-left: 5rem !important; }
    }
    @media (min-width: 1024px) {
        main:not(.lg\:ml-64) header { padding-left: 5rem !important; }
    }

    /* CSS Overrides for Dark Mode */
    .dark body {
        background-color: #0f172a !important;
        color: #f8fafc !important;
    }
    
    .dark aside,
    .dark .sidebar {
        background-color: #1e293b !important;
        border-color: #334155 !important;
    }
    .dark aside a,
    .dark .sidebar a {
        color: #cbd5e1 !important;
    }
    .dark aside a:hover,
    .dark .sidebar a:hover {
        background-color: #334155 !important;
        color: #10b981 !important;
    }
    .dark aside a.bg-emerald-50,
    .dark .sidebar a.bg-emerald-50,
    .dark aside a.bg-emerald-100/50,
    .dark .sidebar a.bg-emerald-100/50 {
        background-color: rgba(16, 185, 129, 0.15) !important;
        color: #34d399 !important;
    }
    
    .dark .border-b,
    .dark .border-t,
    .dark .border-r,
    .dark .border,
    .dark .border-slate-200 {
        border-color: #334155 !important;
    }
    
    .dark header,
    .dark main header {
        background-color: #1e293b !important;
        border-color: #334155 !important;
    }
    .dark header h1,
    .dark header h2,
    .dark header span,
    .dark header div,
    .dark main header h1,
    .dark main header h2 {
        color: #ffffff !important;
    }
    
    .dark .bg-white {
        background-color: #1e293b !important;
        color: #f8fafc !important;
    }
    .dark .bg-gray-50,
    .dark .bg-slate-50 {
        background-color: #0f172a !important;
    }
    
    .dark .border-gray-200,
    .dark .border-slate-200,
    .dark .border-gray-100,
    .dark .border-emerald-100 {
        border-color: #334155 !important;
    }
    
    .dark .text-gray-800,
    .dark .text-slate-800,
    .dark .text-gray-700,
    .dark .text-slate-700,
    .dark .text-slate-900,
    .dark .text-gray-900 {
        color: #f8fafc !important;
    }
    
    .dark .text-gray-600,
    .dark .text-slate-600,
    .dark .text-gray-500,
    .dark .text-slate-500,
    .dark .text-gray-400 {
        color: #94a3b8 !important;
    }
    
    /* Tables */
    .dark table thead,
    .dark thead,
    .dark thead tr {
        background-color: #0f172a !important;
    }
    .dark table thead th,
    .dark thead th {
        color: #94a3b8 !important;
        border-color: #334155 !important;
    }
    .dark table tbody tr:hover,
    .dark tbody tr:hover {
        background-color: rgba(51, 65, 85, 0.4) !important;
    }
    .dark table tbody td,
    .dark tbody td {
        color: #cbd5e1 !important;
        border-color: #334155 !important;
    }
    
    /* Dropdowns */
    .dark #profileDropdown,
    .dark #notificationDropdown {
        background-color: #1e293b !important;
        border-color: #334155 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5) !important;
    }
    .dark #profileDropdown p,
    .dark #notificationDropdown p,
    .dark #profileDropdown span,
    .dark #notificationDropdown span {
        color: #cbd5e1 !important;
    }
    .dark #profileDropdown a:hover,
    .dark #notificationDropdown div:hover {
        background-color: #334155 !important;
    }
    .dark #profileDropdown .border-t,
    .dark #profileDropdown .border-b,
    .dark #notificationDropdown .border-t,
    .dark #notificationDropdown .border-b {
        border-color: #334155 !important;
    }
    
    /* Forms & Inputs */
    .dark input,
    .dark select,
    .dark textarea {
        background-color: #0f172a !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }
    .dark input:focus,
    .dark select:focus,
    .dark textarea:focus {
        border-color: #10b981 !important;
        box-shadow: 0 0 0 1px #10b981 !important;
    }
    .dark input[readonly] {
        background-color: #1e293b !important;
        color: #94a3b8 !important;
    }
    
    /* Modals & Popups */
    .dark #editModal > div,
    .dark #deleteModal > div,
    .dark #addModal > div,
    .dark .modal-content {
        background-color: #1e293b !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }
    .dark .bg-black/50,
    .dark .bg-black/40 {
        background-color: rgba(0, 0, 0, 0.7) !important;
    }
    
    /* Alerts & Badges */
    .dark .bg-emerald-100 {
        background-color: rgba(16, 185, 129, 0.15) !important;
        color: #34d399 !important;
    }
    .dark .bg-green-100 {
        background-color: rgba(16, 185, 129, 0.15) !important;
        color: #34d399 !important;
    }
    .dark .bg-yellow-100 {
        background-color: rgba(245, 158, 11, 0.15) !important;
        color: #fbbf24 !important;
    }
    .dark .bg-blue-100 {
        background-color: rgba(59, 130, 246, 0.15) !important;
        color: #60a5fa !important;
    }
    .dark .bg-red-100 {
        background-color: rgba(239, 68, 68, 0.15) !important;
        color: #f87171 !important;
    }
    .dark .bg-purple-100 {
        background-color: rgba(139, 92, 246, 0.15) !important;
        color: #a78bfa !important;
    }
    .dark .text-emerald-500,
    .dark .text-emerald-600,
    .dark .text-teal-700 {
        color: #34d399 !important;
    }
    .dark .text-red-600,
    .dark .text-red-500 {
        color: #f87171 !important;
    }
    .dark .text-yellow-600 {
        color: #fbbf24 !important;
    }
    
    /* Footer */
    .dark footer {
        background-color: #1e293b !important;
        border-color: #334155 !important;
    }

    /* Scrollbars */
    .dark .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02) !important;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1) !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>