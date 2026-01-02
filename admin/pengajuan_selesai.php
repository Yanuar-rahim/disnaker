<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$id = $_GET['id'];

// Query untuk mengambil data pengajuan berdasarkan ID
$query = "SELECT * FROM pengajuan WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

$updateQuery = "UPDATE pengajuan SET status = 'selesai' WHERE id = '$id'";
if (mysqli_query($koneksi, $updateQuery)) {
    $_SESSION['success'] = "Pengajuan selesai diproses.";
    header("Location: data-pengajuan.php");
    exit();
} else {
    $_SESSION['error'] = "Gagal menolak pengajuan.";
}
?>