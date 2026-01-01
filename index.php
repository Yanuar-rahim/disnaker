<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Pelayanan Terpadu Disnaker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

    <?php include "includes/header-index.php"; ?>

    <main class="main-content">

        <section class="hero">
            <div class="hero-content">
                <h2>Sistem Informasi Pelayanan Terpadu</h2>
                <p>Dinas Ketenagakerjaan Berbasis Web untuk Masyarakat Umum</p>
                <div class="hero-btn">
                    <a href="login.php" class="btn-primary">Ajukan Layanan</a>
                    <a href="public/cek_status.php" class="btn-secondary">Cek Status</a>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h3>Layanan Kami</h3>
                    <p>Berbagai layanan ketenagakerjaan untuk masyarakat</p>
                </div>

                <div class="grid">
                    <div class="card">
                        <h4>Kartu Pencari Kerja (AK1)</h4>
                        <p>Pendaftaran dan pencetakan kartu pencari kerja secara online.</p>
                    </div>
                    <div class="card">
                        <h4>Pelatihan Kerja</h4>
                        <p>Informasi dan pendaftaran pelatihan keterampilan kerja.</p>
                    </div>
                    <div class="card">
                        <h4>Lowongan Kerja</h4>
                        <p>Informasi lowongan kerja dari perusahaan mitra.</p>
                    </div>
                    <div class="card">
                        <h4>Pengaduan Ketenagakerjaan</h4>
                        <p>Layanan pengaduan masalah ketenagakerjaan.</p>
                    </div>
                </div>
            </div>
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

    <script>
        function toggleMenu() {
            document.querySelector("nav ul").classList.toggle("active");
        }
    </script>
</body>
</html>