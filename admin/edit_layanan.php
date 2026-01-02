<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

if (!isset($_GET['id'])) {
    header("Location: layanan.php");
    exit();
}

$id = $_GET['id'];

// Query untuk mendapatkan data layanan yang akan diedit
$query = "SELECT * FROM layanan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_layanan = $_POST['nama_layanan'];
    $deskripsi = $_POST['deskripsi'];

    $update_query = "UPDATE layanan SET nama_layanan = '$nama_layanan', deskripsi = '$deskripsi' WHERE id = $id";

    if (mysqli_query($koneksi, $update_query)) {
        $_SESSION['success'] = "Layanan berhasil diperbarui.";
        header("Location: layanan.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat memperbarui layanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layanan - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include "../includes/sidebar.php"; ?>

    <div class="main-content">
        <section class="dashboard">
            <h2>Edit Layanan</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert-error"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <form method="POST" class="form-input">
                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" name="nama_layanan" id="nama_layanan" value="<?= $data['nama_layanan']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required><?= $data['deskripsi']; ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-crud">Perbarui Layanan</button>
                    <a href="layanan.php" class="btn-back">Kembali</a>
                </div>
            </form>
        </section>
    </div>

</body>
</html>
