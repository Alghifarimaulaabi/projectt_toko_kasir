<?php
session_start();
header('Content-Type: application/json');

require_once '../config/koneksi.php';


$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'getProdukTerlaris':
    try {
        $query = "SELECT dp.nama_produk, SUM(dp.jumlah) as total_terjual 
                  FROM detail_penjualan dp
                  JOIN penjualan p ON dp.penjualan_id = p.id
                  WHERE p.user_email = ?
                  GROUP BY dp.produk_id 
                  ORDER BY total_terjual DESC 
                  LIMIT 5";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['email']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $data]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    break;

    case 'getDashboardSummary':
    try {
        $email = $_SESSION['email'];

        // Total Penjualan (sementara dianggap profit)
        $query1 = "SELECT SUM(total) as total_penjualan 
                   FROM penjualan 
                   WHERE user_email = ?";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute([$email]);
        $total_penjualan = $stmt1->fetch(PDO::FETCH_ASSOC)['total_penjualan'] ?? 0;

        // Total Transaksi Hari Ini
        $query2 = "SELECT COUNT(*) as total_transaksi 
                   FROM penjualan 
                   WHERE user_email = ? 
                   AND tanggal >= CURDATE() 
                   AND tanggal < CURDATE() + INTERVAL 1 DAY";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([$email]);
        $total_transaksi = $stmt2->fetch(PDO::FETCH_ASSOC)['total_transaksi'] ?? 0;

        // Pengeluaran (sementara 0 dulu)
        $pengeluaran = 0;

        echo json_encode([
            'success' => true,
            'data' => [
                'profit' => $total_penjualan,
                'pengeluaran' => $pengeluaran,
                'transaksi' => $total_transaksi
            ]
        ]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    break;

    case 'getProduk':
        // Ambil semua produk yang memiliki stok > 0
        try {
            $query = "SELECT * FROM produk WHERE jumlah_stock > 0 AND user_email = ? ORDER BY nama_barang ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_SESSION['email']]);
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
            $query = "SELECT * FROM produk WHERE (nama_barang LIKE ? OR kategori LIKE ?) AND jumlah_stock > 0 AND user_email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(["%$keyword%", "%$keyword%", $_SESSION   ['email']]);
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
          WHERE user_email = ?
          GROUP BY DATE(tanggal)
          ORDER BY tgl ASC";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['email']]);
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