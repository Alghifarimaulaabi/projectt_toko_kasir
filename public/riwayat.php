<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<?php $title = "Riwayat Transaksi"; ?>

<?php require_once '../view/layouts/header.php'; ?>
<?php require_once '../view/layouts/sidebar.php'; ?>

<div class="ml-64 p-6 bg-gray-100 min-h-screen">
    <h1 class="f font-bold text-4xl text-[#1a1a1a] mb-2 md:hidden">
        Toko <?= $_SESSION['toko'] ?? 'Toko Saya' ?>
    </h1>
    <h1 class="text-2xl font-bold mb-6">Riwayat Transaksi Penjualan</h1>
    
    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-wrap gap-4 items-center md:flex-row">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter Tanggal</label>
                <input type="date" id="filterTanggal" class="border w-full rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <button onclick="filterByDate()" class="bg-go mt-6 text-white px-2 h-10 rounded-lg hover:bg-green-300 transition">
                Filter
            </button>
            <button onclick="resetFilter()" class="bg-gy mt-6 text-white h-10 px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                Lihat Semua
            </button>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div id="riwayatContainer" class="space-y-4">
        <!-- Data akan dimuat via AJAX -->
        <div class="text-center text-gray-500 py-8">Memuat data...</div>
    </div>
</div>

<!-- Template untuk item riwayat -->
<template id="templateRiwayat">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header Transaksi -->
        <div class="p-4 border-b bg-gray-50">
            <div class="flex gap-2">
                    <button onclick="toggleDetail(this)" class="btn-detail px-4 py-2 bg-go text-white rounded-lg hover:bg-green-300 transition">
                        Detail
                    </button>
                    <button onclick="cetakTransaksi(this)" class="btn-cetak px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-300 transition">
                        Cetak
                    </button>
                </div>
            <div class="flex justify-between items-center">
                <div>
                    <span class="font-semibold text-lg">Transaksi #<span class="transaksi-id"></span></span>
                    <span class="ml-4 text-gray-600 transaksi-tanggal"></span>
                </div>
                
            </div>
            <div class="mt-2 text-gray-700">
                Total: <span class="font-bold text-lg transaksi-total"></span>
            </div>
        </div>
        
        <!-- Detail Transaksi (Dropdown) -->
        <div class="detail-container hidden">
            <div class="p-4 bg-gray-50 border-t">
                <h4 class="font-semibold mb-3">Detail Penjualan:</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="detail-items bg-white divide-y divide-gray-200 text-lg">
                            <!-- Detail items akan dimasukkan di sini -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 p-3 bg-white rounded-lg">
                    <div class="flex justify-between">
                        <span class="font-semibold">Uang Bayar:</span>
                        <span class="uang-bayar"></span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="font-semibold">Kembalian:</span>
                        <span class="kembalian"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<div class="tambahan"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Library untuk generate PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script src="./js/riwayat.js"></script>

<?php require_once '../view/layouts/footer.php'; ?>