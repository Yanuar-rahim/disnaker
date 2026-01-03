<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Query untuk mengambil data lowongan pekerjaan
$query = "SELECT * FROM lowongan_kerja WHERE status = 'tersedia'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Pekerjaan</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Lowongan Pekerjaan</h2>
                <p>Berikut adalah daftar lowongan pekerjaan yang tersedia.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: 30px;">Lowongan Pekerjaan</h2>
                <div class="card-container">
                    <?php while ($data = mysqli_fetch_assoc($result)): ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-text">
                                    <h4><?= $data['perusahaan']; ?></h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>Posisi:</strong> <?= $data['posisi']; ?></p>
                                    <p><strong>Status:</strong> <?= $data['status']; ?></p>
                                    <p><strong>Jumlah Lowongan:</strong> <?= $data['jumlah_lowongan']; ?></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="detail_lowongan.php?id=<?= $data['id']; ?>" class="btn-action">Detail</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>