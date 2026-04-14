<?php
session_start();
header('Content-Type: application/json');

// Include koneksi database Anda
require_once '../config/koneksi.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Folder upload foto
$uploadDir = '../uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

switch ($action) {
    case 'get':
        // Ambil semua data produk
        try {
            $query = "SELECT * FROM produk WHERE user_email = ? ORDER BY id DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_SESSION['email']]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengambil data: ' . $e->getMessage()]);
        }
        break;
        
    case 'getOne':
        // Ambil satu data produk
        $id = $_GET['id'] ?? 0;
        try {
            $query = "SELECT * FROM produk WHERE id = ? AND user_email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id, $_SESSION['email']]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($data) {
                echo json_encode(['success' => true, 'data' => $data]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengambil data: ' . $e->getMessage()]);
        }
        break;
        
    case 'create':
        // VALIDASI FOTO
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Foto wajib diupload!'
            ]);
            exit;
        }

        // Tambah produk baru
        $kategori = $_POST['kategori'] ?? '';
        $nama_barang = $_POST['nama_barang'] ?? '';
        $harga_modal = $_POST['harga_modal'] ?? 0;
        $harga_jual = $_POST['harga_jual'] ?? 0;
        $jumlah_stock = $_POST['jumlah_stock'] ?? 0;
        
        // Upload foto
        $foto = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png'];
            $filename = $_FILES['foto']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $filesize = $_FILES['foto']['size'];
            
            if (in_array($ext, $allowed) && $filesize <= 2 * 1024 * 1024) {
                $foto = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
                move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . $foto);
            }
        }
        
        try {
            $query = "INSERT INTO produk (kategori, nama_barang, foto, harga_modal, harga_jual, jumlah_stock, user_email) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$kategori, $nama_barang, $foto, $harga_modal, $harga_jual, $jumlah_stock, $_SESSION['email']]);
            
            echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal menambahkan produk: ' . $e->getMessage()]);
        }
        break;
        
    case 'update':
        // Update produk
        $id = $_POST['id'] ?? 0;
        $kategori = $_POST['kategori'] ?? '';
        $nama_barang = $_POST['nama_barang'] ?? '';
        $harga_modal = $_POST['harga_modal'] ?? 0;
        $harga_jual = $_POST['harga_jual'] ?? 0;
        $jumlah_stock = $_POST['jumlah_stock'] ?? 0;
        
        try {
            // Cek foto lama
            $query = "SELECT foto FROM produk WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);
            $oldData = $stmt->fetch(PDO::FETCH_ASSOC);
            $foto = $oldData['foto'] ?? '';
            
            // Upload foto baru jika ada
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png'];
                $filename = $_FILES['foto']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $filesize = $_FILES['foto']['size'];
                
                if (in_array($ext, $allowed) && $filesize <= 2 * 1024 * 1024) {
                    // Hapus foto lama
                    if ($foto && file_exists($uploadDir . $foto)) {
                        unlink($uploadDir . $foto);
                    }
                    $foto = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
                    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . $foto);
                }
            }
            
           $query = "UPDATE produk SET kategori=?, nama_barang=?, foto=?, harga_modal=?, harga_jual=?, jumlah_stock=? WHERE id=? AND user_email=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
    $kategori, $nama_barang, $foto, $harga_modal, $harga_jual, $jumlah_stock, $id, $_SESSION['email']
]);
            
            echo json_encode(['success' => true, 'message' => 'Produk berhasil diupdate']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengupdate produk: ' . $e->getMessage()]);
        }
        break;
        
    case 'delete':
        // Hapus produk
        $id = $_POST['id'] ?? 0;
        
        try {
            // Ambil nama foto untuk dihapus
            $query = "SELECT foto FROM produk WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($data && $data['foto'] && file_exists($uploadDir . $data['foto'])) {
                unlink($uploadDir . $data['foto']);
            }
            
            $query = "DELETE FROM produk WHERE id = ? AND user_email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id, $_SESSION['email']]);
            
            echo json_encode(['success' => true, 'message' => 'Produk berhasil dihapus']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus produk: ' . $e->getMessage()]);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak valid']);
}
?>