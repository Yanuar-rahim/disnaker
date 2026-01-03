<?php
include "config/koneksi.php";
$sql = mysqli_query($koneksi, "SELECT * FROM layanan");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Pelayanan Terpadu Disnaker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <span id="home"></span>
    <?php include "includes/header-index.php"; ?>

    <main class="main-content">

        <section class="hero">
            <div class="hero-content">
                <h2>Sistem Informasi Pelayanan Terpadu Dinas Ketenagakerjaan</h2>
                <p>Melayani masyarakat secara cepat, transparan, dan berbasis digital</p>
                <div class="hero-btn">
                    <a href="login.php" class="btn-primary">Ajukan Layanan</a>
                    <a href="login.php" class="btn-secondary">Cek Status</a>
                </div>
            </div>
            <span id="layanan"></span>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h3>Layanan Kami</h3>
                    <p>Berbagai layanan ketenagakerjaan untuk masyarakat</p>
                </div>

                <div class="grid">
                    <?php if (mysqli_num_rows($sql) > 0): ?>
                        <?php while ($row = mysqli_fetch_array($sql)): ?>
                            <div class="card-index">
                                <h4><?= $row['nama_layanan'] ?></h4>
                                <p><?= $row['deskripsi'] ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="card-index">
                            <h4>Tidak ada layanan</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <span id="informasi"></span>
        </section>

        <section class="section bg-light">
            <div class="container">
                <div class="section-title">
                    <h3>Informasi Terbaru</h3>
                </div>

                <div class="grid">
                    <div class="card">
                        <h4>Pengumuman Pelatihan</h4>
                        <p>Pendaftaran pelatihan kerja tahun ini telah dibuka.</p>
                    </div>
                    <div class="card">
                        <h4>Regulasi Ketenagakerjaan</h4>
                        <p>Peraturan terbaru terkait ketenagakerjaan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container" style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
                <div>
                    <h3>Gunakan Layanan Disnaker Sekarang</h3>
                    <p>Login untuk mengajukan layanan secara online</p>
                </div>
                <a href="register.php" class="btn-primary cta-btn">Daftar Sekarang!</a>
            </div>
        </section>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>