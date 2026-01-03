<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mendapatkan data pengajuan
$query = "SELECT * FROM pengajuan
            WHERE 
                nama_lengkap LIKE '%$search%' OR
                nik LIKE '%$search%' OR 
                jenis_pengajuan LIKE '%$search%'
        ";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert-error"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php include "../includes/sidebar.php"; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <section class="dashboard">
            <h2>Data Pengajuan</h2>

            <!-- Button Ekspor PDF/Excel dan Pencarian -->
            <div class="actions">
                <form method="get" action="">
                    <input type="text" name="search" placeholder="Cari Nama, NIK, dan Jenis Pengajuan..."
                        class="search-input">
                    <button type="submit" class="btn-search">Cari</button>
                </form>
                <div>
                    <button class="btn-export" onclick="window.location.href='pengajuan_excel.php'">Ekspor ke Excel</button>
                    <button class="btn-export" onclick="window.location.href='pengajuan_pdf.php'">Ekspor ke PDF</button>
                </div>
            </div>

            <!-- Tabel Data Pengajuan -->
            <div class="lowongan-tabel">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pemohon</th>
                            <th>NIK</th>
                            <th>Jenis Layanan</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['nama_lengkap']; ?></td>
                                    <td><?= $row['nik']; ?></td>
                                    <td><?= $row['jenis_pengajuan']; ?></td>
                                    <td style="text-align: center;"><?= $row['tanggal_pengajuan']; ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        $status = $row['status'];
                                        if ($status == 'baru') {
                                            echo '<span class="badge badge-new">Pengajuan Baru</span>';
                                        } elseif ($status == 'diproses') {
                                            echo '<span class="badge badge-process">Pengajuan Diproses</span>';
                                        } elseif ($status == 'selesai') {
                                            echo '<span class="badge badge-completed">Pengajuan Selesai</span>';
                                        } elseif ($status == 'ditolak') {
                                            echo '<span class="badge badge-cancel">Pengajuan Ditolak</span>';
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="detail_pengajuan.php?id=<?= $row['id']; ?>" class="btn-action">Detail</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-data">Tidak ada ajuan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</body>

</html>