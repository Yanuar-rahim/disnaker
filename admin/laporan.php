<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Query untuk mendapatkan jumlah pengajuan, lowongan kerja, dan layanan
$query_pengajuan = mysqli_query($koneksi, "SELECT * FROM pengajuan");
$total_pengajuan = mysqli_num_rows($query_pengajuan);

$query_lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan_kerja");
$total_lowongan = mysqli_num_rows($query_lowongan);

$query_layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
$total_layanan = mysqli_num_rows($query_layanan);

$query_pesan = mysqli_query($koneksi,"SELECT * FROM pesan_user");
$total_pesan = mysqli_num_rows($query_pesan);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <?php include "../includes/sidebar.php"; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <section class="dashboard">
            <h2>Laporan Dinas Ketenagakerjaan</h2>

            <!-- Card Jumlah Data -->
            <div class="report-cards">
                <div class="card">
                    <h3>Total Pengajuan</h3>
                    <p><?= $total_pengajuan; ?> Pengajuan</p>
                </div>
                <div class="card">
                    <h3>Total Lowongan Kerja</h3>
                    <p><?= $total_lowongan; ?> Lowongan</p>
                </div>
                <div class="card">
                    <h3>Total Layanan</h3>
                    <p><?= $total_layanan; ?> Layanan</p>
                </div>
                <div class="card">
                    <h3>Total Pesan</h3>
                    <p><?= $total_pesan; ?> Pesan</p>
                </div>
            </div>

            <!-- Tabel Data Pengajuan -->
            <div class="lowongan-tabel">
                <h3>Data Pengajuan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pemohon</th>
                            <th>NIK</th>
                            <th>Jenis Layanan</th>
                            <th style="text-align: center;">Tanggal Pengajuan</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_pengajuan_data = "SELECT * FROM pengajuan LIMIT 3";
                        $result_pengajuan_data = mysqli_query($koneksi, $query_pengajuan_data); 
                        ?>
                        <?php if (mysqli_num_rows($result_pengajuan_data) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($result_pengajuan_data)) : ?>
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
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="empty-data">Tidak ada data ajuan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Data Lowongan Kerja -->
            <div class="lowongan-tabel">
                <h3>Data Lowongan Kerja</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Jumlah Lowongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_lowongan_data = "SELECT * FROM lowongan_kerja LIMIT 3";
                        $result_lowongan_data = mysqli_query($koneksi, $query_lowongan_data);
                        ?>
                        <?php if (mysqli_num_rows($result_lowongan_data) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($result_lowongan_data)): ?>
                                <tr>
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
                                    <td style="text-align: center;"><?= $row['jumlah_lowongan']; ?> Lowongan</td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="empty-data">Tidak ada lowongan pekerjaan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Data Layanan -->
            <div class="lowongan-tabel">
                <h3>Data Layanan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th style="text-align: center;">Tanggal Terbit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_layanan_data = "SELECT * FROM layanan LIMIT 3";
                        $result_layanan_data = mysqli_query($koneksi, $query_layanan_data);
                        ?>
                        <?php if (mysqli_num_rows($result_layanan_data) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($result_layanan_data)): ?>
                                <tr>
                                    <td><?= $row['nama_layanan']; ?></td>
                                    <td><?= $row['deskripsi']; ?></td>
                                    <td style="text-align: center;"><?= $row['created_at']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="empty-data">Tidak ada layanan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="lowongan-tabel">
                <h3>Pesan Dari User</h3>
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 10px;">No.</th>
                            <th style="text-align: center;">Nama Pengirim</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_pesan_user = mysqli_query($koneksi, "SELECT * FROM pesan_user LIMIT 3");
                        if (mysqli_num_rows($query_pesan_user) > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($data = mysqli_fetch_array($query_pesan_user)): ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++ ?></td>
                                    <td><?= $data['nama_lengkap'] ?></td>
                                    <td><?= $data['email'] ?></td>
                                    <td><?= $data['pesan'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-data">Tidak ada pesan masuk</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </form>
            </div>

        </section>
    </div>

</body>

</html>