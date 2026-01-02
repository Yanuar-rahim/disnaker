<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Mengambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data pengajuan berdasarkan ID
$query = "SELECT * FROM pengajuan WHERE id = '$id'";
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
            <h2>Detail Pengajuan</h2>
            
            <table class="detail">
                <tr>
                    <th>Nama Pemohon</th>
                    <td><?= $row['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td><?= $row['nik']; ?></td>
                </tr>
                <tr>
                    <th>Jenis Layanan</th>
                    <td><?= $row['jenis_pengajuan']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td><?= $row['tanggal_pengajuan']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php 
                        $status = $row['status'];
                        if ($status == 'baru') {
                            echo '<span class="badge badge-new">Pengajuan Baru</span>';
                        } elseif ($status == 'diproses') {
                            echo '<span class="badge badge-process">Pengajuan Diproses</span>';
                        } elseif ($status == 'selesai') {
                            echo '<span class="badge badge-completed">Pengajuan Selesai</span>';
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <div style="margin-top: 20px;">
                <a href="data-pengajuan.php" class="btn-action">Kembali</a>
                <a href="pengajuan_selesai.php?id=<?= $row['id']; ?>" class="btn-action">Selesai</a>
                <a href="verifikasi_pengajuan.php?id=<?= $row['id']; ?>" class="btn-action">Verifikasi</a>
                <a href="tolak_pengajuan.php?id=<?= $row['id']; ?>" class="btn-action">Tolak</a>
            </div>
        </section>
    </div>

</body>
</html>
