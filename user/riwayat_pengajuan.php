<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];
$nama = $_SESSION['nama_lengkap'];
$user_id = $_SESSION['user_id'];

// Query untuk mengambil semua pengajuan milik pengguna yang sedang login
$query = "SELECT * FROM pengajuan WHERE id = '$user_id'";
$result = mysqli_query($koneksi, $query);

// Menangani pesan sukses atau error
$alertSuccess = "";
$alertError = "";
if (isset($_SESSION['success'])) {
    $alertSuccess = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $alertError = $_SESSION['error'];
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan - Pengguna</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Daftar Pengajuan Anda</h2>
                <p>Berikut adalah pengajuan yang telah Anda ajukan. Anda dapat melihat status dan detail pengajuan Anda.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">

                <!-- Menampilkan alert jika ada pesan sukses atau error -->
                <?php if ($alertError): ?>
                    <div class="alert-error"><?= $alertError; ?></div>
                <?php endif; ?>

                <?php if ($alertSuccess): ?>
                    <div class="alert-success"><?= $alertSuccess; ?></div>
                <?php endif; ?>

                <!-- Tabel Pengajuan -->
                <table class="detail">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Layanan</th>
                            <th style="text-align: center;">Tanggal Pengajuan</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
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
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <a href="detail_pengajuan.php?id=<?= $row['id']; ?>" class="btn-action">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>
