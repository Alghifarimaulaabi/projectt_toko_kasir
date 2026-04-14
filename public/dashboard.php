<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


?>

<?php require_once '../view/layouts/header.php'?>

<!-- nama halaman -->
<?php $title = "Dashboard"; ?>


<?php require_once '../view/layouts/sidebar.php'?>

<?php require_once '../view/layouts/cLogout.php'?>

<?php require_once '../view/layouts/footer.php'?>