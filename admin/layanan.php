<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$search = isset($_GET['search']) ? $_GET['search'] : "";

// Query untuk mendapatkan data layanan
$query = "SELECT * FROM layanan WHERE nama_layanan LIKE '%$search%'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - Admin</title>
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
            <h2>Layanan</h2>

            <!-- Button Ekspor PDF/Excel, Pencarian, dan Tambah Layanan -->
            <div class="actions">
                <form method="get" action="">
                    <input type="text" name="search" placeholder="Cari layanan..." class="search-input">
                    <button type="submit" class="btn-search">Cari</button>
                </form>
                <div>
                    <button class="btn-export" onclick="exportData('excel')">Ekspor ke Excel</button>
                    <button class="btn-export" onclick="exportData('pdf')">Ekspor ke PDF</button>
                    <a href="tambah_layanan.php" class="btn-export" style="text-decoration: none;">Tambah Layanan</a>
                </div>
            </div>

            <!-- Tabel Data Layanan -->
            <div class="lowongan-tabel">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th style="text-align: center;">Tanggal Terbit</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++; ?></td>
                                    <td><?= $row['nama_layanan']; ?></td>
                                    <td><?= substr($row['deskripsi'], 0, 31); ?>...</td>
                                    <td style="text-align: center;"><?= $row['created_at']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="detail_layanan.php?id=<?= $row['id']; ?>" class="btn-action">Detail</a>
                                        <a href="edit_layanan.php?id=<?= $row['id']; ?>" class="btn-action">Edit</a>
                                        <a href="delete_layanan.php?id=<?= $row['id']; ?>" class="btn-action"
                                            onclick="return confirm('Hapus layanan ini?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-data">Tidak ada layanan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</body>

</html>