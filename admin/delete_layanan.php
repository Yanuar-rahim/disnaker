<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

if (!isset($_GET['id'])) {
    header("Location: layanan.php");
    exit();
}

$id = $_GET['id'];

// Query untuk menghapus layanan
$query = "DELETE FROM layanan WHERE id = $id";

if (mysqli_query($koneksi, $query)) {
    $_SESSION['success'] = "Layanan berhasil dihapus.";
    header("Location: layanan.php");
    exit();
} else {
    $_SESSION['error'] = "Terjadi kesalahan saat menghapus layanan.";
    header("Location: layanan.php");
    exit();
}
?>
