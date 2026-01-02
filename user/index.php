<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$alertSuccess = "";
if (isset($_SESSION['success'])) {
    $alertSuccess = $_SESSION['success'];
    unset($_SESSION['success']);
}

$nama = $_SESSION['nama_lengkap'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | Disnaker</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert-error"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if ($alertSuccess): ?>
        <div class="alert-success"><?= $alertSuccess; ?></div>
    <?php endif; ?>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Selamat Datang, <?= $_SESSION['nama_lengkap']; ?>!</h2>
                <p><?= $_SESSION['role']; ?>Halaman ini menyediakan layanan yang dapat Anda akses sebagai pengguna terdaftar.</p>
                <div class="hero-btn">
                    <a href="services.php" class="btn-primary">Lihat Layanan</a>
                    <a href="cek_status.php" class="btn-secondary">Cek Status Pengajuan</a>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h3>Layanan</h3>
                    <p>Berbagai layanan ketenagakerjaan untuk masyarakat</p>
                </div>

                <div class="grid">
                    <div class="card">
                        <h4>Kartu Pencari Kerja (AK1)</h4>
                        <p>Ajukan dan cetak kartu pencari kerja secara online.</p>
                        <a href="ajukan_ak1.php" class="btn-primary">Ajukan Sekarang</a>
                    </div>
                    <div class="card">
                        <h4>Pelatihan Kerja</h4>
                        <p>Daftar pelatihan keterampilan kerja untuk meningkatkan kemampuan Anda.</p>
                        <a href="pelatihan_kerja.php" class="btn-primary">Daftar Pelatihan</a>
                    </div>
                    <div class="card">
                        <h4>Lowongan Kerja</h4>
                        <p>Lihat berbagai lowongan kerja dari perusahaan mitra kami.</p>
                        <a href="lowongan_kerja.php" class="btn-primary">Lihat Lowongan</a>
                    </div>
                    <div class="card">
                        <h4>Pengaduan Ketenagakerjaan</h4>
                        <p>Laporkan masalah terkait ketenagakerjaan yang Anda alami.</p>
                        <a href="pengaduan.php" class="btn-primary">Lapor Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container" style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
                <div>
                    <h3>Butuh Bantuan?</h3>
                    <p>Jika Anda membutuhkan bantuan lebih lanjut, hubungi kami atau kunjungi pusat bantuan.</p>
                </div>
                <a href="bantuan.php" class="btn-secondary">Pusat Bantuan</a>
            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>