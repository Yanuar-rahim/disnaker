<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Query untuk mengambil detail lowongan berdasarkan ID
$query = "SELECT * FROM lowongan_kerja WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">

    <!-- CSS untuk mencetak -->
    <style>
        @media print {
            /* Menyembunyikan navbar, footer, dan tombol cetak saat dicetak */
            .navbar, .footer, .btn-primary, .hero {
                display: none;
            }

            .main-content {
                padding: 0;
            }

            .card {
                border: 1px solid #ccc;
                padding: 20px;
                margin: 20px;
                page-break-inside: avoid;
            }

            .card-text {
                margin: 10px;
            }

            .card-header, .card-footer {
                background-color: #f4f4f4;
                padding: 10px;
                font-weight: bold;
            }

            .container {
                width: 80%;
            }
        }
    </style>
</head>

<body>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Detail Lowongan Pekerjaan</h2>
                <p>Berikut adalah detail lowongan pekerjaan yang Anda pilih.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="card">
                    <div class="card-text">
                        <div class="card-header">
                            <h4><?= $data['perusahaan']; ?></h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Posisi:</strong> <?= $data['posisi']; ?></p>
                            <p><strong>Status:</strong> <?= $data['status']; ?></p>
                            <p><strong>Deskripsi:</strong> <?= nl2br($data['deskripsi']); ?></p>
                            <p><strong>Jumlah Lowongan:</strong> <?= $data['jumlah_lowongan']; ?></p>
                        </div>
                        <div class="card-footer">
                            <button class="btn-primary" onclick="history.back();">Kembali ke daftar lowongan</button>
                            <button class="btn-primary" onclick="window.print();">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>
