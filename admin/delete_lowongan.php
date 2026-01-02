<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Mendapatkan ID lowongan yang akan dihapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk menghapus lowongan berdasarkan ID
    $delete_query = "DELETE FROM lowongan_kerja WHERE id = $id";
    
    if (mysqli_query($koneksi, $delete_query)) {
        $_SESSION['success'] = "Lowongan pekerjaan berhasil dihapus.";
        header("Location: lowongan-kerja.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menghapus lowongan.";
        header("Location: lowongan-kerja.php");
        exit();
    }
}
?>
