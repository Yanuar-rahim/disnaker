<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Proses tambah layanan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_layanan = $_POST['nama_layanan'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO layanan (nama_layanan, deskripsi) VALUES ('$nama_layanan', '$deskripsi')";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Layanan berhasil ditambahkan.";
        header("Location: layanan.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan layanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Layanan - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <?php include "../includes/sidebar.php"; ?>

    <div class="main-content">
        <section class="dashboard">
            <h2>Tambah Layanan</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert-error"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <form method="POST" class="form-input">
                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" name="nama_layanan" id="nama_layanan" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-crud">Tambah Layanan</button>
                    <a href="layanan.php" class="btn-back">Kembali</a>
                </div>
            </form>
        </section>
    </div>

</body>

</html>