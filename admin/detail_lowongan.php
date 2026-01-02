<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Mengambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data lowongan berdasarkan ID
$query = "SELECT * FROM lowongan_kerja WHERE id = '$id'";
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
            <h2>Detail Lowongan Pekerjaan</h2>
            
            <table class="detail">
                <tr>
                    <th>Nama Perusahaan</th>
                    <td><?= $row['perusahaan']; ?></td>
                </tr>
                <tr>
                    <th>Posisi</th>
                    <td><?= $row['posisi']; ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><?= $row['deskripsi']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php 
                        $status = $row['status'];
                        if ($status == 'Tersedia') {
                            echo '<span class="badge badge-new">Lowongan Tersedia</span>';
                        } elseif ($status == 'Kosong') {
                            echo '<span class="badge badge-cancel">Tidak ada lowongan</span>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Lowongan</th>
                    <td><?= $row['jumlah_lowongan']; ?></td>
                    
                </tr>
            </table>

            <div style="margin-top: 20px;">
                <a href="lowongan-kerja.php" class="btn-action">Kembali</a>
            </div>
        </section>
    </div>

</body>
</html>
