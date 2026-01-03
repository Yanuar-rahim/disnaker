<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Ambil data pengguna dari sesi
$nama = $_SESSION['nama_lengkap'];
$user_id = $_SESSION['user_id'];

$alertSuccess = "";
$alertError = "";

// Query untuk mengambil layanan yang tersedia
$query = "SELECT * FROM layanan";
$result = mysqli_query($koneksi, $query);

// Menampilkan pesan sukses jika ada
if (isset($_SESSION['success'])) {
    $alertSuccess = $_SESSION['success'];
    unset($_SESSION['success']);
}

// Menampilkan pesan error jika ada
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
    <title>Ajukan Layanan | Disnaker</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php if ($alertError): ?>
        <div class="alert-error"><?= $alertError; ?></div>
    <?php endif; ?>

    <?php if ($alertSuccess): ?>
        <div class="alert-success"><?= $alertSuccess; ?></div>
    <?php endif; ?>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <span id="layanan"></span>
            <div class="hero-content">
                <h2>Ajukan Layanan</h2>
                <p>Silakan pilih layanan yang ingin Anda ajukan dan isi form di bawah ini.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h3>Pilih Layanan</h3>
                    <p>Pilih jenis layanan yang Anda butuhkan.</p>
                </div>

                <div class="grid">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="card">
                            <img src="../uploads/<?= $row['gambar']; ?>" alt="<?= $row['nama_layanan']; ?>" class="card-img">
                                <h4><?= $row['nama_layanan']; ?></h4>
                                <p><?= $row['deskripsi']; ?></p>
                            <a href="form_ajukan_layanan.php?id=<?= $row['id']; ?>" class="btn-primary">Ajukan Sekarang</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>
