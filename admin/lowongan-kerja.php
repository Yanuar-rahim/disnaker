<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$search = isset($_GET['search']) ? $_GET['search'] : "";

// Query untuk mendapatkan data lowongan pekerjaan
$query = "SELECT * FROM lowongan_kerja
            WHERE 
                perusahaan LIKE '%$search%' OR
                posisi LIKE '%$search%'
        ";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Pekerjaan - Admin</title>
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
            <h2>Lowongan Pekerjaan</h2>

            <!-- Button Ekspor PDF/Excel, Pencarian, dan Tambah Lowongan -->
            <div class="actions">
                <form method="get" action="">
                    <input type="text" name="search" placeholder="Cari lowongan..." class="search-input">
                    <button type="submit" class="btn-search">Cari</button>
                </form>
                <div>
                    <button class="btn-export" onclick="exportData('excel')">Ekspor ke Excel</button>
                    <button class="btn-export" onclick="exportData('pdf')">Ekspor ke PDF</button>
                    <a href="tambah_lowongan.php" class="btn-export" style="text-decoration: none;">Tambah Lowongan</a>
                </div>
            </div>

            <!-- Tabel Data Lowongan Pekerjaan -->
            <div class="lowongan-tabel">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Jumlah Lowongan</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['posisi']; ?></td>
                                    <td><?= $row['perusahaan']; ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        $status = $row['status'];
                                        if ($status == 'Tersedia') {
                                            echo '<span class="badge badge-new">Tersedia</span>';
                                        } elseif ($status == 'Kosong') {
                                            echo '<span class="badge badge-process" style="background-color: red;">Kosong</span>';
                                        }
                                        ?>
                                    </td>
                                    <td width="10%" style="text-align: center;"><?= $row['jumlah_lowongan']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="detail_lowongan.php?id=<?= $row['id']; ?>" class="btn-action">Detail</a>
                                        <a href="edit_lowongan.php?id=<?= $row['id']; ?>" class="btn-action">Edit</a>
                                        <a href="delete_lowongan.php?id=<?= $row['id']; ?>" class="btn-action"
                                            onclick="return confirm('Hapus lowongan ini?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-data">Tidak ada data lowongan pekerjaan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</body>

</html>