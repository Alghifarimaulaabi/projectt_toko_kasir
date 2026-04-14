<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>


<!-- nama halaman -->
<?php $title = "Riwayat"; ?>


<?php
  require_once '../view/layouts/header.php';  
?>
<?php
  require_once '../view/layouts/sidebar.php';  
?>
<?php
  require_once '../view/layouts/footer.php';  
?>