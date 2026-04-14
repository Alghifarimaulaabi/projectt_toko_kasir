<?php
session_start();
header('Content-Type: application/json');

require_once '../config/koneksi.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'getProdukTerlaris':
    try {
        $query = "SELECT nama_produk, SUM(jumlah) as total_terjual 
                  FROM detail_penjualan 
                  GROUP BY produk_id 
                  ORDER BY total_terjual DESC 
                  LIMIT 5";

        $stmt = $pdo->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $data]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    break;

    case 'getProduk':
        // Ambil semua produk yang memiliki stok > 0
        try {
            $query = "SELECT * FROM produk WHERE jumlah_stock > 0 ORDER BY nama_barang ASC";
            $stmt = $pdo->query($query);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
        
    case 'searchProduk':
        // Cari produk
        $keyword = $_GET['keyword'] ?? '';
        try {
            $query = "SELECT * FROM produk WHERE (nama_barang LIKE ? OR kategori LIKE ?) AND jumlah_stock > 0";
            $stmt = $pdo->prepare($query);
            $stmt->execute(["%$keyword%", "%$keyword%"]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
        
    case 'simpanTransaksi':
        // Simpan transaksi
        $items = json_decode($_POST['items'], true);
        $total = $_POST['total'];
        $uang_bayar = $_POST['uang_bayar'];
        $kembalian = $_POST['kembalian'];
        
        try {
            // Mulai transaksi database
            $pdo->beginTransaction();
            
            // Insert ke tabel penjualan
            $query = "INSERT INTO penjualan (tanggal, total, uang_bayar, kembalian, user_email) VALUES (NOW(), ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$total, $uang_bayar, $kembalian, $_SESSION['email']]);
            $penjualan_id = $pdo->lastInsertId();
            
            // Insert detail penjualan dan update stok
            foreach ($items as $item) {
                // Insert detail
                $query = "INSERT INTO detail_penjualan (penjualan_id, produk_id, nama_produk, harga, jumlah, subtotal) 
                          VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    $penjualan_id,
                    $item['id'],
                    $item['nama'],
                    $item['harga'],
                    $item['qty'],
                    $item['harga'] * $item['qty']
                ]);
                
                // Update stok produk
                $query = "UPDATE produk SET jumlah_stock = jumlah_stock - ? WHERE id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$item['qty'], $item['id']]);
            }
            
            $pdo->commit();
            echo json_encode(['success' => true, 'message' => 'Transaksi berhasil disimpan']);
            
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
        case 'getPenjualanHarian':
    try {
        $query = "SELECT DATE(tanggal) as tgl, SUM(total) as total_penjualan 
                  FROM penjualan
                  GROUP BY DATE(tanggal)
                  ORDER BY tgl ASC";

        $stmt = $pdo->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $data]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak valid']);
}
?>