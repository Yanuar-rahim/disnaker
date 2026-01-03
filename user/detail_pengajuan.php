<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

$id = $_GET['id'];

// Query untuk mengambil detail pengajuan berdasarkan ID
$query = "SELECT * FROM pengajuan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

// Cek apakah pengajuan ditemukan
if (!$data) {
    $_SESSION['error'] = "Pengajuan tidak ditemukan.";
    header("Location: pengajuan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">

    <!-- CSS untuk mencetak -->
    <style>
        @media print {
            .navbar, .footer, .btn-primary, .hero {
                display: none;
            }

            .main-content {
                padding: 0;
            }

            table.detail th, table.detail td {
                padding: 10px;
                border: 1px solid #000;
                color: #000;
            }

            span {
                color: #000;
            }

            .section {
                margin-top: 20px;
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
                <h2>Detail Pengajuan</h2>
                <p>Berikut adalah detail pengajuan Anda.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <!-- Menampilkan pesan error jika ada -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert-error"><?= $_SESSION['error']; ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <h3>Informasi Pengajuan</h3>
                <table class="detail">
                    <tr>
                        <th>Nama Layanan</th>
                        <td><?= $data['jenis_pengajuan']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td><?= $data['tanggal_pengajuan']; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            $status = $data['status'];
                            if ($status == 'baru') {
                                echo '<span class="badge badge-new">Pengajuan Baru</span>';
                            } elseif ($status == 'diproses') {
                                echo '<span class="badge badge-process">Pengajuan Diproses</span>';
                            } elseif ($status == 'selesai') {
                                echo '<span class="badge badge-completed">Pengajuan Selesai</span>';
                            }
                            ?>
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 20px; height: 20px;">
                    <button class="btn-primary" onclick="history.back();">Kembali ke daftar pengajuan</button>
                    <button class="btn-primary" onclick="window.print();">Cetak</button>
                </div>
            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>
