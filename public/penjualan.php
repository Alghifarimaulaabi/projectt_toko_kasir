<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<!-- nama halaman -->
<?php $title = "Transaksi Penjualan"; ?>

<?php require_once '../view/layouts/header.php'; ?>
<?php require_once '../view/layouts/sidebar.php'; ?>

<div class="ml-64 p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Transaksi Penjualan</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Daftar Produk -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Daftar Produk</h2>
                    <input type="text" id="searchProduk" placeholder="Cari produk..." class="mt-2 w-full px-3 py-2 border rounded-lg">
                </div>
                <div id="daftarProduk" class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4 max-h-96 overflow-y-auto">
                    <!-- Produk akan dimuat via AJAX -->
                </div>
            </div>
            
            <!-- Keranjang Belanja -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Keranjang Belanja</h2>
                </div>
                <div id="keranjang" class="max-h-96 overflow-y-auto">
                    <!-- Keranjang akan ditampilkan di sini -->
                </div>
                <div class="p-4 border-t">
                    <div class="space-y-2">
                        <div class="flex justify-between font-semibold">
                            <span>Total:</span>
                            <span id="totalHarga">Rp 0</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Uang Bayar</label>
                            <input type="number" id="uangBayar" class="w-full px-3 py-2 border rounded-lg" placeholder="Masukkan jumlah uang">
                        </div>
                        <div class="flex justify-between font-semibold text-green-600">
                            <span>Kembalian:</span>
                            <span id="kembalian">Rp 0</span>
                        </div>
                        <button onclick="prosesTransaksi()" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                            Proses Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let keranjang = [];

// Load daftar produk
function loadProduk() {
    $.ajax({
        url: 'ajax_penjualan.php',
        type: 'GET',
        data: { action: 'getProduk' },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayProduk(response.data);
            }
        }
    });
}

// Tampilkan produk
function displayProduk(produk) {
    let html = '';
    produk.forEach(item => {
        html += `
            <div class="border rounded-lg p-3 hover:shadow-lg transition">
                <img src="../uploads/${item.foto}" alt="${item.nama_barang}" class="w-full h-32 object-cover rounded mb-2">
                <h3 class="font-semibold">${item.nama_barang}</h3>
                <p class="text-sm text-gray-600">Stok: ${item.jumlah_stock}</p>
                <p class="text-blue-600 font-bold">Rp ${formatRupiah(item.harga_jual)}</p>
                <button onclick="tambahKeKeranjang(${item.id}, '${item.nama_barang}', ${item.harga_jual}, ${item.jumlah_stock}, '${item.foto}')" 
                        class="mt-2 w-full bg-blue-600 text-white py-1 rounded hover:bg-blue-700">
                    Tambah
                </button>
            </div>
        `;
    });
    $('#daftarProduk').html(html);
}

// Tambah ke keranjang
function tambahKeKeranjang(id, nama, harga, stok, foto) {
    let existingItem = keranjang.find(item => item.id === id);
    
    if (existingItem) {
        if (existingItem.qty < stok) {
            existingItem.qty++;
        } else {
            alert('Stok tidak mencukupi!');
            return;
        }
    } else {
        keranjang.push({
            id: id,
            nama: nama,
            harga: harga,
            qty: 1,
            stok: stok,
            foto: foto
        });
    }
    
    updateKeranjang();
}

// Update tampilan keranjang
function updateKeranjang() {
    let html = '';
    let total = 0;
    
    keranjang.forEach((item, index) => {
        total += item.harga * item.qty;
        html += `
            <div class="flex items-center gap-3 p-3 border-b">
                <img src="../uploads/${item.foto}" class="w-12 h-12 object-cover rounded">
                <div class="flex-1">
                    <h4 class="font-semibold text-sm">${item.nama}</h4>
                    <p class="text-xs text-gray-600">Rp ${formatRupiah(item.harga)}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <button onclick="ubahJumlah(${index}, 'kurang')" class="w-6 h-6 bg-gray-200 rounded hover:bg-gray-300">-</button>
                        <span class="w-8 text-center">${item.qty}</span>
                        <button onclick="ubahJumlah(${index}, 'tambah')" class="w-6 h-6 bg-gray-200 rounded hover:bg-gray-300">+</button>
                        <button onclick="hapusItem(${index})" class="ml-2 text-red-500 text-xs">Hapus</button>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold">Rp ${formatRupiah(item.harga * item.qty)}</p>
                </div>
            </div>
        `;
    });
    
    if (keranjang.length === 0) {
        html = '<div class="p-4 text-center text-gray-500">Keranjang kosong</div>';
    }
    
    $('#keranjang').html(html);
    $('#totalHarga').text('Rp ' + formatRupiah(total));
    
    // Hitung kembalian jika uang bayar sudah diisi
    hitungKembalian();
}

// Ubah jumlah barang
function ubahJumlah(index, aksi) {
    if (aksi === 'tambah') {
        if (keranjang[index].qty < keranjang[index].stok) {
            keranjang[index].qty++;
        } else {
            alert('Stok tidak mencukupi!');
        }
    } else if (aksi === 'kurang') {
        if (keranjang[index].qty > 1) {
            keranjang[index].qty--;
        } else {
            hapusItem(index);
            return;
        }
    }
    updateKeranjang();
}

// Hapus item dari keranjang
function hapusItem(index) {
    keranjang.splice(index, 1);
    updateKeranjang();
}

// Hitung kembalian
function hitungKembalian() {
    let total = 0;
    keranjang.forEach(item => {
        total += item.harga * item.qty;
    });
    
    let uangBayar = parseInt($('#uangBayar').val()) || 0;
    let kembalian = uangBayar - total;
    
    if (kembalian >= 0) {
        $('#kembalian').text('Rp ' + formatRupiah(kembalian));
        $('#kembalian').css('color', 'green');
    } else {
        $('#kembalian').text('Rp ' + formatRupiah(Math.abs(kembalian)));
        $('#kembalian').css('color', 'red');
    }
}

// Proses transaksi
function prosesTransaksi() {
    if (keranjang.length === 0) {
        alert('Keranjang masih kosong!');
        return;
    }
    
    let total = 0;
    keranjang.forEach(item => {
        total += item.harga * item.qty;
    });
    
    let uangBayar = parseInt($('#uangBayar').val()) || 0;
    
    if (uangBayar < total) {
        alert('Uang bayar kurang dari total belanja!');
        return;
    }
    
    let kembalian = uangBayar - total;
    
    if (confirm(`Total: Rp ${formatRupiah(total)}\nUang Bayar: Rp ${formatRupiah(uangBayar)}\nKembalian: Rp ${formatRupiah(kembalian)}\n\nLanjutkan transaksi?`)) {
        $.ajax({
            url: 'ajax_penjualan.php',
            type: 'POST',
            data: {
                action: 'simpanTransaksi',
                items: JSON.stringify(keranjang),
                total: total,
                uang_bayar: uangBayar,
                kembalian: kembalian
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Transaksi berhasil!');
                    keranjang = [];
                    updateKeranjang();
                    $('#uangBayar').val('');
                    loadProduk(); // Reload produk untuk update stok
                } else {
                    alert('Gagal menyimpan transaksi: ' + response.message);
                }
            }
        });
    }
}

// Format rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

// Event listener untuk uang bayar
$(document).on('input', '#uangBayar', function() {
    hitungKembalian();
});

// Cari produk
$(document).on('input', '#searchProduk', function() {
    let keyword = $(this).val();
    $.ajax({
        url: 'ajax_penjualan.php',
        type: 'GET',
        data: { action: 'searchProduk', keyword: keyword },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayProduk(response.data);
            }
        }
    });
});

// Load produk saat halaman dibuka
$(document).ready(function() {
    loadProduk();
});
</script>

<style>
.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<?php require_once '../view/layouts/footer.php'; ?>