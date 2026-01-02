<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$nama = $_SESSION['nama_lengkap'];

$pengajuan = mysqli_query($koneksi, "SELECT * FROM pengajuan");
$total_pengajuan = mysqli_num_rows($pengajuan);
$baru = mysqli_query($koneksi, "SELECT * FROM pengajuan WHERE status = 'baru'");
$pengajuan_baru = mysqli_num_rows($baru);
$diproses = mysqli_query($koneksi, "SELECT * FROM pengajuan WHERE status = 'diproses'");
$pengajuan_diproses = mysqli_num_rows($diproses);
$selesai = mysqli_query($koneksi, "SELECT * FROM pengajuan WHERE status = 'selesai'");
$pengajuan_selesai = mysqli_num_rows($selesai);

// Menambahkan Query Lowongan Pekerjaan
$lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan_kerja");
$total_lowongan = mysqli_num_rows($lowongan);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            <h2>Dashboard Admin</h2>
            <p>Selamat datang, <?= $_SESSION['nama_lengkap']; ?>! Berikut adalah statistik layanan pengajuan.</p>

            <!-- Statistikan Pengajuan -->
            <div class="statistik">
                <div class="stat-item">
                    <h4>Total Pengajuan</h4>
                    <p><?= $total_pengajuan; ?> Pengajuan</p>
                </div>
                <div class="stat-item">
                    <h4>Pengajuan Baru</h4>
                    <p><?= $pengajuan_baru; ?> Pengajuan</p>
                </div>
                <div class="stat-item">
                    <h4>Pengajuan Diproses</h4>
                    <p><?= $pengajuan_diproses; ?> Pengajuan</p>
                </div>
                <div class="stat-item">
                    <h4>Pengajuan Selesai</h4>
                    <p><?= $pengajuan_selesai; ?> Pengajuan</p>
                </div>
            </div>

            <!-- Tabel Statistik dengan Badge Status -->
            <div class="statistik-tabel">
                <h3>Data Pengajuan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Status Pengajuan</th>
                            <th>Jumlah Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge badge-new">Pengajuan Baru</span></td>
                            <td><?= $pengajuan_baru; ?></td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-process">Pengajuan Diproses</span></td>
                            <td><?= $pengajuan_diproses; ?></td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-completed">Pengajuan Selesai</span></td>
                            <td><?= $pengajuan_selesai; ?></td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-total">Total Pengajuan</span></td>
                            <td><?= $total_pengajuan; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Lowongan Pekerjaan -->
            <div class="lowongan-tabel">
                <h3>Data Lowongan Pekerjaan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center" width="10%">Jumlah Lowongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($lowongan) > 0): ?>
                            <?php while ($lowongan_data = mysqli_fetch_assoc($lowongan)): ?>
                                <tr>
                                    <td><?= $lowongan_data['posisi']; ?></td>
                                    <td><?= $lowongan_data['perusahaan']; ?></td>
                                    <td style="text-align: center"><span class="badge badge-new"><?= $lowongan_data['status']; ?></span></td>
                                    <td style="text-align: center"><?= $lowongan_data['jumlah_lowongan']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="empty-data">Tidak ada lowongan pekerjaan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </section>
    </div>
</body>

</html>