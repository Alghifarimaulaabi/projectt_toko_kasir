<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<?php $title = "Transaksi Penjualan"; ?>

<?php require_once '../view/layouts/header.php'; ?>
<?php require_once '../view/layouts/sidebar.php'; ?>

<div class="ml-64 p-6 bg-gray-100 min-h-screen">
    <h1 class="f font-bold text-4xl text-[#1a1a1a] mb-2 md:hidden">
        Toko <?= $_SESSION['toko'] ?? 'Toko Saya' ?>
    </h1>
    <h1 class="text-2xl font-bold mb-6">Transaksi Penjualan</h1>
    
    
    <div class="flex gap-6 flex-col md:flex-row">
        
        <!-- DAFTAR PRODUK -->
        <div class="flex-1 bg-white rounded-2xl p-4">
            <div class="mb-4">
                <h2 class="text-lg font-semibold">Daftar Produk</h2>
                <input type="text" id="searchProduk" placeholder="Cari produk..."
                    class="w-full mt-2 p-2 border rounded-2xl bg-gray-200">
                
            </div>

            <div id="daftarProduk" class="grid grid-cols-1 gap-4 md:grid-cols-3">
                
            </div>
        </div>

        <!-- KERANJANG -->
        <div class="w-full md:w-96 bg-white rounded-xl shadow flex flex-col">
            
            <!-- Header -->
            <div class="p-4 border-b">
                <h2 class="font-bold text-lg">Keranjang</h2>
            </div>

            <!-- List Item -->
            <div id="keranjang" class="flex-1 overflow-y-auto p-3 space-y-3">
                <div class="text-gray-400 text-center">Keranjang kosong</div>
            </div>

            <div class="p-4 border-t space-y-3">
                
                <div class="flex justify-between font-semibold">
                    <span>Total</span>
                    <span id="totalHarga">Rp 0</span>
                </div>

                <div>
                    <label class="text-sm">Uang Bayar</label>
                    <input type="number" id="uangBayar" min="0"
                        class="w-full border rounded p-2 mt-1"
                        placeholder="Masukkan uang">
                </div>

                <div class="flex justify-between font-semibold">
                    <span>Kembalian</span>
                    <span id="kembalian">Rp 0</span>
                </div>

                <button onclick="prosesTransaksi()"
                    class="w-full bg-go text-white py-2 rounded hover:bg-green-300">
                    Proses Transaksi
                </button>
            </div>

        </div>
    </div>
</div>

<div class="tambahan"></div>

<?php require_once '../view/layouts/cLogout.php'?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./js/penjualan.js"></script>

<?php require_once '../view/layouts/footer.php'?>