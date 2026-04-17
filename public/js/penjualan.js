let keranjang = [];

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

function displayProduk(produk) {
    let html = '';
    produk.forEach(item => {
        html += `
            <div class="border p-3 rounded-2xl">
                <img src="../uploads/${item.foto}" class="w-full h-32 object-cover">
                <h3 class="font-semibold">${item.nama_barang}</h3>
                <p>Rp ${formatRupiah(item.harga_jual)}</p>
                <button onclick="tambahKeKeranjang(${item.id}, '${item.nama_barang}', ${item.harga_jual}, ${item.jumlah_stock}, '${item.foto}')"
                    class="mt-2 bg-gy text-white px-2 py-1 rounded">
                    Tambah
                </button>
            </div>
        `;
    });
    $('#daftarProduk').html(html);
}

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
            id, nama, harga, qty: 1, stok, foto
        });
    }
    
    updateKeranjang();
}

function updateKeranjang() {
    let html = '';
    let total = 0;
    
    keranjang.forEach((item, index) => {
        total += item.harga * item.qty;

        html += `
        <div class="flex gap-3 border-b pb-2 items-center">
            
            <img src="../uploads/${item.foto}" 
                 class="w-12 h-12 object-cover rounded">

            <div class="flex-1">
                <h4 class="text-sm font-semibold">${item.nama}</h4>
                <p class="text-xs text-gray-500">Rp ${formatRupiah(item.harga)}</p>

                <div class="flex items-center gap-2 mt-1">
                    <button onclick="ubahJumlah(${index}, 'kurang')"
                        class="w-6 h-6 bg-gray-200 rounded">-</button>

                    <span>${item.qty}</span>

                    <button onclick="ubahJumlah(${index}, 'tambah')"
                        class="w-6 h-6 bg-gray-200 rounded">+</button>

                    <button onclick="hapusItem(${index})"
                        class="text-red-500 text-xs ml-2">Hapus</button>
                </div>
            </div>

            <div class="text-sm font-bold">
                Rp ${formatRupiah(item.harga * item.qty)}
            </div>
        </div>
        `;
    });
    
    if (keranjang.length === 0) {
        html = '<div class="text-center text-gray-400">Keranjang kosong</div>';
    }
    
    $('#keranjang').html(html);
    $('#totalHarga').text('Rp ' + formatRupiah(total));

    $('#uangBayar').val('');
    $('#kembalian').text('Rp 0');
    $('#kembalian').removeClass('text-green-600 text-red-600');
    
}

function ubahJumlah(index, aksi) {
    if (aksi === 'tambah') {
        if (keranjang[index].qty < keranjang[index].stok) {
            keranjang[index].qty++;
        } else {
            alert('Stok tidak mencukupi!');
        }
    } else {
        if (keranjang[index].qty > 1) {
            keranjang[index].qty--;
        } else {
            hapusItem(index);
            return;
        }
    }
    updateKeranjang();
}

function hapusItem(index) {
    keranjang.splice(index, 1);
    updateKeranjang();
}

function hitungKembalian() {
    let total = 0;
    keranjang.forEach(item => total += item.harga * item.qty);
    
    let uangInput = $('#uangBayar').val();

    // ❗ kalau belum isi, jangan tampilkan apa-apa
    if (uangInput === '' || parseInt(uangInput) === 0) {
        $('#kembalian').text('Rp 0');
        $('#kembalian').removeClass('text-green-600 text-red-600');
        return;
    }

    let uangBayar = parseInt(uangInput);

    // ❗ cegah minus
    if (uangBayar < 0) {
        uangBayar = 0;
        $('#uangBayar').val(0);
    }

    let kembalian = uangBayar - total;

    if (uangBayar < total) {
        // ❌ uang kurang → jangan tampilkan kembalian
        $('#kembalian').text('Uang kurang');
        $('#kembalian').removeClass('text-green-600').addClass('text-red-600');
    } else {
        // ✅ uang cukup → tampilkan kembalian
        $('#kembalian').text('Rp ' + formatRupiah(kembalian));
        $('#kembalian').removeClass('text-red-600').addClass('text-green-600');
    }
}


function prosesTransaksi() {
    if (keranjang.length === 0) {
        alert('Keranjang kosong!');
        return;
    }

    let total = keranjang.reduce((sum, item) => sum + item.harga * item.qty, 0);
    let uangBayar = parseInt($('#uangBayar').val()) || 0;

    if (uangBayar < total) {
        alert('Uang kurang!');
        return;
    }

    let kembalian = uangBayar - total;

    if (confirm(`Total: Rp ${formatRupiah(total)}\nKembalian: Rp ${formatRupiah(kembalian)}`)) {
        $.post('ajax_penjualan.php', {
            action: 'simpanTransaksi',
            items: JSON.stringify(keranjang),
            total,
            uang_bayar: uangBayar,
            kembalian
        }, function(res) {
            if (res.success) {
                alert('Berhasil!');
                keranjang = [];
                updateKeranjang();
                $('#uangBayar').val('');
                loadProduk();
            }
        }, 'json');
    }
}

function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

$(document).on('input', '#uangBayar', hitungKembalian);

$(document).on('input', '#searchProduk', function() {
    $.get('ajax_penjualan.php', {
        action: 'searchProduk',
        keyword: $(this).val()
    }, function(res) {
        if (res.success) displayProduk(res.data);
    }, 'json');
});

$(document).ready(loadProduk);
