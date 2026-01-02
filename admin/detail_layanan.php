<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Mengambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data lowongan berdasarkan ID
$query = "SELECT * FROM layanan WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <?php include "../includes/sidebar.php"; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <section class="dashboard">
            <h2>Detail Layanan</h2>
            
            <table class="detail">
                <tr>
                    <th>Nama Layanan</th>
                    <td><?= $row['nama_layanan']; ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><?= $row['deskripsi']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Terbit</th>
                    <td><?= $row['created_at']; ?></td>
                    
                </tr>
            </table>

            <div style="margin-top: 20px;">
                <a href="lowongan-kerja.php" class="btn-action">Kembali</a>
            </div>
        </section>
    </div>

</body>
</html>
