<!DOCTYPE html>
<html lang="id">
<head>
</head>

<body class="bg-gray-100">

<!-- Topbar -->
<div class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <h1 class="text-xl font-semibold text-gray-800">Kelola Pesanan</h1>
        <span class="bg-emerald-100 text-emerald-600 text-sm px-3 py-1 rounded-full">
            1,247 Total Pesanan
        </span>
    </div>

    <div class="flex items-center gap-3">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input
                type="text"
                placeholder="Search by customer name or order"
                class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500"
            >
        </div>

        <select class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
            <option>All Status</option>
            <option>Selesai</option>
            <option>Dalam Proses</option>
            <option>Menunggu</option>
            <option>Dibatalkan</option>
        </select>

        <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Pesanan
        </button>
    </div>
</div>

<!-- Content -->
<div class="p-6">

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Total Pesanan Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-800">126</h3>
            </div>
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-bag-shopping text-emerald-600"></i>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Pesanan Selesai</p>
                <h3 class="text-2xl font-bold text-gray-800">89</h3>
            </div>
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-emerald-600"></i>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Dalam Proses</p>
                <h3 class="text-2xl font-bold text-gray-800">32</h3>
            </div>
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-spinner text-yellow-600"></i>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Dibatalkan</p>
                <h3 class="text-2xl font-bold text-gray-800">5</h3>
            </div>
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-xmark text-red-600"></i>
            </div>
        </div>

    </div>

    <!-- Tabel Pesanan -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-500">ID Pesanan</th>
                    <th class="px-4 py-3 text-left text-gray-500">Tanggal Masuk</th>
                    <th class="px-4 py-3 text-left text-gray-500">Nama Pelanggan</th>
                    <th class="px-4 py-3 text-left text-gray-500">Cabang</th>
                    <th class="px-4 py-3 text-left text-gray-500">Jenis Layanan</th>
                    <th class="px-4 py-3 text-left text-gray-500">Total</th>
                    <th class="px-4 py-3 text-left text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">#KX001</td>
                    <td class="px-4 py-3">12 Jan 2024</td>
                    <td class="px-4 py-3">Ahmad Rizki</td>
                    <td class="px-4 py-3">Kota Gede</td>
                    <td class="px-4 py-3">Cuci Premium</td>
                    <td class="px-4 py-3 font-semibold">Rp 35.000</td>
                    <td class="px-4 py-3">
                        <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs">
                            Selesai
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                            Update
                        </button>
                    </td>
                </tr>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">#KX002</td>
                    <td class="px-4 py-3">12 Jan 2024</td>
                    <td class="px-4 py-3">Sari Dewi</td>
                    <td class="px-4 py-3">Seturan</td>
                    <td class="px-4 py-3">Whitening</td>
                    <td class="px-4 py-3 font-semibold">Rp 45.000</td>
                    <td class="px-4 py-3">
                        <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs">
                            Dalam Proses
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                            Update
                        </button>
                    </td>
                </tr>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">#KX003</td>
                    <td class="px-4 py-3">11 Jan 2024</td>
                    <td class="px-4 py-3">Budi Santoso</td>
                    <td class="px-4 py-3">Condongcatur</td>
                    <td class="px-4 py-3">Cuci Reguler</td>
                    <td class="px-4 py-3 font-semibold">Rp 25.000</td>
                    <td class="px-4 py-3">
                        <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                            Menunggu
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                            Update
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>
</body>
</html>
