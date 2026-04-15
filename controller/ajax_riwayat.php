<?php
session_start();
header('Content-Type: application/json');

require_once '../config/koneksi.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'getRiwayat':
        $tanggal = $_GET['tanggal'] ?? '';
        
        try {
            $query = "SELECT p.*, 
                      (SELECT COUNT(*) FROM detail_penjualan WHERE penjualan_id = p.id) as total_items
                      FROM penjualan p 
                      WHERE p.user_email = ?";
            $params = [$_SESSION['email']];
            
            if ($tanggal) {
                $query .= " AND DATE(p.tanggal) = ?";
                $params[] = $tanggal;
            }
            
            $query .= " ORDER BY p.tanggal DESC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
        
    case 'getDetailTransaksi':
        $penjualan_id = $_GET['penjualan_id'] ?? 0;
        
        try {
            // Ambil detail transaksi
            $query = "SELECT * FROM detail_penjualan WHERE penjualan_id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$penjualan_id]);
            $detail = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Ambil info transaksi
            $query = "SELECT * FROM penjualan WHERE id = ? AND user_email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$penjualan_id, $_SESSION['email']]);
            $transaksi = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true, 
                'transaksi' => $transaksi,
                'detail' => $detail
            ]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak valid']);
}
?>