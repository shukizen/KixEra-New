<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KixEra Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
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
        background: linear-gradient(to right, #10b981, #34d399);
    }
    
    .gradient-red {
        background: linear-gradient(to right, rgba(185, 28, 28, 0.7), rgba(185, 28, 28, 0.7));
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
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>