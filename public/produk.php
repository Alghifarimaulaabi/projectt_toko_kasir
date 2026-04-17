<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<!-- nama halaman -->
<?php $title = "Produk"; ?>

<?php require_once '../view/layouts/header.php'; ?>
<?php require_once '../view/layouts/sidebar.php'; ?>

<div class="ml-64 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Produk</h1>
            <button type="button" onclick="resetForm()" 
                class="bg-[#1F6F5F] hover:bg-[#6FCF97] cursor-pointer text-white px-4 py-2 rounded-lg flex items-center gap-2 transition duration-200"
                id="btnTambahProduk">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Produk
            </button>
        </div>

        <!-- Tabel Data Produk -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Modal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Jual</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">QTY</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="produkData" class="bg-white divide-y divide-gray-200">
                        <!-- Data akan dimuat via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Produk -->
<div id="modalProduk" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Tambah Produk</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- PERBAIKAN: Tambahkan onsubmit="return false;" -->
        <form id="formProduk" enctype="multipart/form-data" onsubmit="return false;">
            <input type="hidden" name="id" id="produkId">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" id="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang <span class="text-red-500">*</span></label>
                <input type="text" name="nama_barang" id="nama_barang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Foto Barang</label>
                <!-- PERBAIKAN: Tambahkan onchange untuk preview dan stopPropagation --> 
                <input type="file" name="foto" id="foto" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" accept="image/*" onchange="previewFoto(this)">
                <p class="text-xs text-gray-500 mt-1" required>Format: JPG, PNG, JPEG (Max 2MB)</p>
                <div id="fotoPreview" class="mt-2"></div>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga Modal <span class="text-red-500">*</span></label>
                <input type="number" name="harga_modal" id="harga_modal" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" step="1000" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga Jual <span class="text-red-500">*</span></label>
                <input type="number" name="harga_jual" id="harga_jual" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" step="1000" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Stock <span class="text-red-500">*</span></label>
                <input type="number" name="jumlah_stock" id="jumlah_stock" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            
            <div class="flex gap-3 mt-6">                
                <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200 cursor-pointer">Batal</button>
                <button type="button" id="btnSimpan" class="flex-1 px-4 py-2 bg-gy text-white rounded-lg hover:bg-green-400 transition duration-200 cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Popup Hapus Konfirmasi -->
<div id="modalHapus" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-40 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mt-2">Apakah Anda yakin ingin menghapus produk ini?</p>
            <input type="hidden" id="deleteId">
        </div>
        <div class="flex gap-3 mt-6">
            <button type="button" onclick="closeModalHapus()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">Batal</button>
            <button type="button" onclick="deleteProduk()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">Hapus</button>
        </div>
    </div>
</div>

<script src="./src/script.js"></script>

<?php require_once '../view/layouts/footer.php'; ?>

<!-- Script AJAX dengan jQuery -->
<script src="./js/produk.js"></script>
<!-- Tambahan CSS untuk animasi -->
<style>
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slideIn 0.3s ease-out;
}

.loader {
    border: 2px solid #f3f3f3;
    border-top: 2px solid #3498db;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin-right: 8px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Sembunyikan scrollbar saat modal terbuka */
body.overflow-hidden {
    overflow: hidden;
}
</style>