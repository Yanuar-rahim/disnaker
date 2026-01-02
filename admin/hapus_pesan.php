<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

if (isset($_POST['hapus'])) {
    $pesan_ids = $_POST['pesan_ids'];
    $ids = implode(',', $pesan_ids);

    // Query untuk menghapus pesan yang dipilih
    $delete_query = "DELETE FROM pesan_user WHERE id IN ($ids)";
    if (mysqli_query($koneksi, $delete_query)) {
        $_SESSION['success'] = "Pesan berhasil dihapus.";
        header("Location: pesan.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menghapus pesan.";
        header("Location: pesan.php");
        exit();
    }
}
?>