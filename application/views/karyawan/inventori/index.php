<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Inventory</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100">
<div class="flex min-h-screen">

<!-- Sidebar (SAMA) -->
<aside class="w-64 bg-emerald-700 text-white flex flex-col">
    <div class="px-6 py-6 text-3xl font-bold italic">
        Kix<span class="text-emerald-300">Era</span>
    </div>
    <nav class="flex-1 px-4 space-y-2">
        <a class="sidebar-item">Dashboard</a>
        <a class="sidebar-item">Pesanan</a>
        <a class="sidebar-item">Pelanggan</a>
        <a class="sidebar-item bg-emerald-600">Inventory</a>
        <a class="sidebar-item">Pengaturan</a>
    </nav>
</aside>

<!-- Main -->
<main class="flex-1 p-6">

<h1 class="text-xl font-semibold mb-6">Input Data Inventory</h1>

<!-- Form -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
<h2 class="font-semibold mb-4 flex items-center gap-2">
<i class="fas fa-plus text-emerald-600"></i> Form Input Inventory
</h2>

<div class="grid grid-cols-2 gap-6">
<div>
<label class="text-sm">Nama Barang</label>
<input class="input" placeholder="Masukkan nama barang">
</div>
<div>
<label class="text-sm">Jumlah Masuk</label>
<input class="input" type="number">
</div>

<div>
<label class="text-sm">Kategori</label>
<select class="input"><option>Pilih kategori</option></select>
</div>
<div>
<label class="text-sm">Satuan</label>
<select class="input"><option>Pilih satuan</option></select>
</div>

<div>
<label class="text-sm">Cabang</label>
<select class="input"><option>Pilih cabang</option></select>
</div>
<div>
<label class="text-sm">Tanggal</label>
<input type="date" class="input">
</div>
</div>

<div class="mt-6 flex gap-3">
<button class="bg-emerald-600 text-white px-4 py-2 rounded-lg">Simpan Data</button>
<button class="bg-gray-500 text-white px-4 py-2 rounded-lg">Reset</button>
<button class="bg-emerald-200 text-emerald-700 px-4 py-2 rounded-lg">Lihat Stok</button>
</div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow-sm p-6">
<h2 class="font-semibold mb-4">Inventory Terbaru</h2>
<table class="w-full text-sm">
<thead class="bg-gray-50">
<tr>
<th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Satuan</th><th>Cabang</th><th>Tanggal</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
<td>Sabun Premium</td>
<td><span class="badge">Sabun Cuci</span></td>
<td>25</td>
<td>Botol</td>
<td>Seturan</td>
<td>2024-01-15</td>
</tr>
</tbody>
</table>
</div>

</main>
</div>

<style>
.input{width:100%;padding:8px;border:1px solid #ddd;border-radius:8px}
.sidebar-item{display:block;padding:12px;border-radius:8px}
.sidebar-item:hover{background:#059669}
.badge{background:#d1fae5;color:#065f46;padding:4px 10px;border-radius:999px;font-size:12px}
</style>

</body>
</html>
