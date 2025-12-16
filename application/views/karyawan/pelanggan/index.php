<!DOCTYPE html>
<html lang="id">
<head>
</head>

<body class="bg-gray-100">
<div class="flex min-h-screen">

<aside class="w-64 bg-emerald-700 text-white flex flex-col">
    <div class="px-6 py-6 text-3xl font-bold italic">
        Kix<span class="text-emerald-300">Era</span>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <a class="sidebar-item">Dashboard</a>
        <a class="sidebar-item">Pesanan</a>
        <a class="sidebar-item bg-emerald-600">Pelanggan</a>
        <a class="sidebar-item">Inventory</a>
        <a class="sidebar-item">Pengaturan</a>
    </nav>

    <div class="p-4">
        <button class="w-full bg-red-500 py-3 rounded-lg">Logout</button>
    </div>
</aside>

<!-- Main -->
<main class="flex-1">

<!-- Topbar -->
<div class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Kelola Pelanggan</h1>

    <div class="flex gap-3">
        <input type="text" placeholder="Search..."
            class="border px-4 py-2 rounded-lg text-sm">
        <select class="border px-4 py-2 rounded-lg text-sm">
            <option>Semua Cabang</option>
        </select>
        <button class="bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-user-plus"></i> Tambah Pelanggan
        </button>
    </div>
</div>

<!-- Table -->
<div class="p-6">
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-gray-50">
<tr>
<th class="px-4 py-3">Pelanggan ID</th>
<th class="px-4 py-3">Nama</th>
<th class="px-4 py-3">Telepon</th>
<th class="px-4 py-3">Email</th>
<th class="px-4 py-3">Total Pesanan</th>
<th class="px-4 py-3">Status</th>
<th class="px-4 py-3">Actions</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
<td class="px-4 py-3">#C001</td>
<td class="px-4 py-3 font-medium">Rizki Pangestu</td>
<td class="px-4 py-3">+62 812-3456-7890</td>
<td class="px-4 py-3">rizkipangestu@email.com</td>
<td class="px-4 py-3 text-center">24</td>
<td class="px-4 py-3">
<span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">VIP</span>
</td>
<td class="px-4 py-3 flex gap-3">
<i class="fas fa-eye text-emerald-600"></i>
<i class="fas fa-pen text-blue-600"></i>
</td>
</tr>

<tr class="border-t">
<td class="px-4 py-3">#C002</td>
<td class="px-4 py-3 font-medium">Rayan</td>
<td class="px-4 py-3">+62 813-4567-8901</td>
<td class="px-4 py-3">siti.nur@email.com</td>
<td class="px-4 py-3 text-center">12</td>
<td class="px-4 py-3">
<span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs">Regular</span>
</td>
<td class="px-4 py-3 flex gap-3">
<i class="fas fa-eye text-emerald-600"></i>
<i class="fas fa-pen text-blue-600"></i>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</main>
</div>
</body>
</html>
