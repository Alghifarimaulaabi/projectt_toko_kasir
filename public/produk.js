    $(document).ready(function() {
    loadProduk();
    
    // Event untuk tombol tambah produk
    $('#btnTambahProduk').click(function(e) {
        e.preventDefault();
        resetForm();
        openModal();
    });
    
    // PERBAIKAN: Event untuk tombol simpan
    $('#btnSimpan').click(function(e) {
        e.preventDefault();
        saveProduk();
    });
    
    // PERBAIKAN: Prevent form submit on enter key
    $('#formProduk input, #formProduk select').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            return false;
        }
    });
});

// PERBAIKAN: Fungsi preview foto baru
function previewFoto(input) {
    // Prevent default behavior
    if (window.event) {
        window.event.preventDefault();
        window.event.stopPropagation();
    }
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#fotoPreview').html(`
                <div class="mt-2">
                    <img src="${e.target.result}" class="w-24 h-24 object-cover rounded border">
                    <p class="text-xs text-green-600 mt-1">✓ Foto siap diupload</p>
                </div>
            `);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function loadProduk() {
    $.ajax({
        url: 'ajax_produk.php?action=get',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let html = '';
            if (response.data && response.data.length > 0) {
                $.each(response.data, function(index, item) {
                    let fotoHtml = item.foto ? 
                        `<img src="../uploads/${item.foto}" class="w-12 h-12 object-cover rounded">` : 
                        `<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>`;
                    
                    html += `
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${fotoHtml}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.kategori}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${item.nama_barang}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp ${formatNumber(item.harga_modal)}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp ${formatNumber(item.harga_jual)}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full ${item.jumlah_stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'}">
                                    ${item.jumlah_stock}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button onclick="editProduk(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                <button onclick="confirmDelete(${item.id})" class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = `
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            Belum ada data produk
                        </td>
                    </tr>
                `;
            }
            $('#produkData').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showAlert('Gagal memuat data', 'error');
        }
    });
}

function saveProduk() {
    // Validasi form
    if (!$('#kategori').val()) {
        showAlert('Kategori harus diisi!', 'error');
        $('#kategori').focus();
        return false;
    }
    if (!$('#nama_barang').val()) {
        showAlert('Nama barang harus diisi!', 'error');
        $('#nama_barang').focus();
        return false;
    }
    if (!$('#harga_modal').val()) {
        showAlert('Harga modal harus diisi!', 'error');
        $('#harga_modal').focus();
        return false;
    }
    if (!$('#harga_jual').val()) {
        showAlert('Harga jual harus diisi!', 'error');
        $('#harga_jual').focus();
        return false;
    }
    if (!$('#jumlah_stock').val()) {
        showAlert('Jumlah stock harus diisi!', 'error');
        $('#jumlah_stock').focus();
        return false;
    }
    
    let formData = new FormData($('#formProduk')[0]);
    let action = $('#produkId').val() ? 'update' : 'create';
    formData.append('action', action);
    
    // Tampilkan loading
    let saveBtn = $('#btnSimpan');
    saveBtn.html('<div class="loader"></div> Menyimpan...').prop('disabled', true);
    
    $.ajax({
        url: 'ajax_produk.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                closeModal();
                resetForm();
                loadProduk();
            } else {
                showAlert('Error: ' + response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menyimpan data', 'error');
        },
        complete: function() {
            saveBtn.html('Simpan').prop('disabled', false);
        }
    });
    
    return false;
}

function editProduk(id) {
    $.ajax({
        url: 'ajax_produk.php?action=getOne&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                let data = response.data;
                $('#produkId').val(data.id);
                $('#kategori').val(data.kategori);
                $('#nama_barang').val(data.nama_barang);
                $('#harga_modal').val(data.harga_modal);
                $('#harga_jual').val(data.harga_jual);
                $('#jumlah_stock').val(data.jumlah_stock);
                
                if (data.foto) {
                    $('#fotoPreview').html(`
                        <div class="mt-2">
                            <img src="../uploads/${data.foto}" class="w-24 h-24 object-cover rounded border">
                            <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                        </div>
                    `);
                } else {
                    $('#fotoPreview').html('');
                }
                
                $('#modalTitle').text('Edit Produk');
                openModal();
            } else {
                showAlert('Gagal mengambil data produk', 'error');
            }
        },
        error: function() {
            showAlert('Terjadi kesalahan saat mengambil data', 'error');
        }
    });
}

function confirmDelete(id) {
    $('#deleteId').val(id);
    $('#modalHapus').removeClass('hidden');
}

function deleteProduk() {
    let id = $('#deleteId').val();
    
    $.ajax({
        url: 'ajax_produk.php',
        type: 'POST',
        data: {
            action: 'delete',
            id: id
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                closeModalHapus();
                loadProduk();
            } else {
                showAlert('Error: ' + response.message, 'error');
            }
        },
        error: function() {
            showAlert('Terjadi kesalahan saat menghapus data', 'error');
        }
    });
}

function resetForm() {
    $('#formProduk')[0].reset();
    $('#produkId').val('');
    $('#fotoPreview').html('');
    $('#modalTitle').text('Tambah Produk');
}

function openModal() {
    $('#modalProduk').removeClass('hidden');
    $('body').addClass('overflow-hidden');
}

function closeModal() {
    $('#modalProduk').addClass('hidden');
    $('body').removeClass('overflow-hidden');
    resetForm();
}

function closeModalHapus() {
    $('#modalHapus').addClass('hidden');
}

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function showAlert(message, type) {
    let alertDiv = $(`
        <div class="fixed top-20 right-4 z-50 animate-slide-in">
            <div class="rounded-lg shadow-lg p-4 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white min-w-[300px]">
                <div class="flex items-center gap-2">
                    ${type === 'success' ? 
                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                    }
                    <span>${message}</span>
                </div>
            </div>
        </div>
    `);
    
    $('body').append(alertDiv);
    
    setTimeout(() => {
        alertDiv.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
