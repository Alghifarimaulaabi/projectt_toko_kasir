window.jsPDF = window.jspdf.jsPDF;

// Load riwayat saat halaman dimuat
$(document).ready(function() {
    loadRiwayat();
});

// Fungsi untuk memuat data riwayat
function loadRiwayat(tanggal = '') {
    let url = '../controller/ajax_riwayat.php?action=getRiwayat';
    if (tanggal) {
        url += '&tanggal=' + tanggal;
    }
    
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayRiwayat(response.data);
            } else {
                $('#riwayatContainer').html('<div class="text-center text-red-500 py-8">Gagal memuat data</div>');
            }
        },
        error: function() {
            $('#riwayatContainer').html('<div class="text-center text-red-500 py-8">Terjadi kesalahan</div>');
        }
    });
}

// Fungsi untuk menampilkan data riwayat
function displayRiwayat(data) {
    const container = $('#riwayatContainer');
    container.empty();
    
    if (data.length === 0) {
        container.html('<div class="text-center text-gray-500 py-8 bg-white rounded-lg shadow">Tidak ada data transaksi</div>');
        return;
    }
    
    data.forEach(function(transaksi) {
        const template = document.getElementById('templateRiwayat');
        const clone = document.importNode(template.content, true);
        
        // Format tanggal
        const tanggal = new Date(transaksi.tanggal);
        const tanggalStr = tanggal.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        // Isi data
        $(clone).find('.transaksi-id').text(transaksi.id);
        $(clone).find('.transaksi-tanggal').text(tanggalStr);
        $(clone).find('.transaksi-total').text(formatRupiah(transaksi.total));
        
        // Simpan data transaksi untuk digunakan nanti
        const element = $(clone);
        element.find('.btn-detail').attr('data-id', transaksi.id);
        element.find('.btn-cetak').attr('data-id', transaksi.id);
        
        container.append(element);
    });
}

// Fungsi untuk toggle detail
function toggleDetail(button) {
    const container = $(button).closest('.bg-white');
    const detailContainer = container.find('.detail-container');
    const transaksiId = $(button).data('id');
    
    if (detailContainer.hasClass('hidden')) {
        // Load detail transaksi
        loadDetailTransaksi(transaksiId, detailContainer);
        detailContainer.removeClass('hidden');
        $(button).text('Sembunyikan');
    } else {
        detailContainer.addClass('hidden');
        $(button).text('Detail');
    }
}

// Fungsi untuk memuat detail transaksi
function loadDetailTransaksi(id, container) {
    $.ajax({
        url: '../controller/ajax_riwayat.php?action=getDetailTransaksi&penjualan_id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayDetailTransaksi(response, container);
            }
        }
    });
}

// Fungsi untuk menampilkan detail transaksi
function displayDetailTransaksi(data, container) {
    const tbody = container.find('.detail-items');
    tbody.empty();
    
    // Tampilkan detail items
    data.detail.forEach(function(item, index) {
        const row = `
            <tr>
                <td class="px-4 py-2">${index + 1}</td>
                <td class="px-4 py-2">${item.nama_produk}</td>
                <td class="px-4 py-2">${formatRupiah(item.harga)}</td>
                <td class="px-4 py-2">${item.jumlah}</td>
                <td class="px-4 py-2">${formatRupiah(item.subtotal)}</td>
            </tr>
        `;
        tbody.append(row);
    });
    
    // Tampilkan info pembayaran
    container.find('.uang-bayar').text(formatRupiah(data.transaksi.uang_bayar));
    container.find('.kembalian').text(formatRupiah(data.transaksi.kembalian));
}

// Fungsi untuk filter berdasarkan tanggal
function filterByDate() {
    const tanggal = $('#filterTanggal').val();
    if (tanggal) {
        loadRiwayat(tanggal);
    }
}

// Fungsi untuk reset filter
function resetFilter() {
    $('#filterTanggal').val('');
    loadRiwayat();
}

// Fungsi untuk cetak transaksi ke PDF
async function cetakTransaksi(button) {
    const transaksiId = $(button).data('id');
    
    try {
        // Ambil data transaksi
        const response = await $.ajax({
            url: '../controller/ajax_riwayat.php?action=getDetailTransaksi&penjualan_id=' + transaksiId,
            type: 'GET',
            dataType: 'json'
        });
        
        if (response.success) {
            generatePDF(response.transaksi, response.detail);
        }
    } catch (error) {
        alert('Gagal memuat data untuk cetak');
    }
}

// Fungsi untuk generate PDF
function generatePDF(transaksi, detail) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Format tanggal
    const tanggal = new Date(transaksi.tanggal);
    const tanggalStr = tanggal.toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    
    // Header
    doc.setFontSize(16);
    doc.text('STRUK PENJUALAN', 105, 20, { align: 'center' });
    
    doc.setFontSize(10);
    doc.text(`No. Transaksi: ${transaksi.id}`, 14, 35);
    doc.text(`Tanggal: ${tanggalStr}`, 14, 42);
    
    // Tabel detail
    const tableData = detail.map((item, index) => [
        index + 1,
        item.nama_produk,
        formatRupiah(item.harga),
        item.jumlah,
        formatRupiah(item.subtotal)
    ]);
    
    doc.autoTable({
        startY: 50,
        head: [['No', 'Nama Produk', 'Harga', 'Jumlah', 'Subtotal']],
        body: tableData,
        theme: 'grid',
        headStyles: {
            fillColor: [31, 111, 95],
            textColor: 255,
            fontStyle: 'bold'
        },
        styles: {
            fontSize: 9,
            cellPadding: 3
        },
        columnStyles: {
            0: { cellWidth: 10 },
            1: { cellWidth: 60 },
            2: { cellWidth: 35, halign: 'right' },
            3: { cellWidth: 20, halign: 'center' },
            4: { cellWidth: 40, halign: 'right' }
        }
    });
    
    // Total dan pembayaran
    const finalY = doc.lastAutoTable.finalY + 10;
    
    doc.setFontSize(10);
    doc.text(`Total: ${formatRupiah(transaksi.total)}`, 150, finalY, { align: 'right' });
    doc.text(`Uang Bayar: ${formatRupiah(transaksi.uang_bayar)}`, 150, finalY + 7, { align: 'right' });
    doc.text(`Kembalian: ${formatRupiah(transaksi.kembalian)}`, 150, finalY + 14, { align: 'right' });
    
    // Footer
    doc.setFontSize(8);
    doc.text('Terima kasih telah berbelanja', 105, finalY + 30, { align: 'center' });
    doc.text('Semoga hari Anda menyenangkan!', 105, finalY + 37, { align: 'center' });
    
    // Simpan PDF
    doc.save(`Transaksi_${transaksi.id}_${tanggal.toISOString().split('T')[0]}.pdf`);
}

// Fungsi helper untuk format rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
}