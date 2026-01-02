<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Mendapatkan ID lowongan yang akan diedit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM lowongan_kerja WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}

// Menangani form submit untuk update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posisi = $_POST['posisi'];
    $perusahaan = $_POST['perusahaan'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah_lowongan = $_POST['jumlah_lowongan'];

    // Query untuk update data lowongan
    $update_query = "UPDATE lowongan_kerja SET posisi='$posisi', perusahaan='$perusahaan', 
                     status='$status', deskripsi='$deskripsi', jumlah_lowongan='$jumlah_lowongan' WHERE id=$id";
    
    if (mysqli_query($koneksi, $update_query)) {
        $_SESSION['success'] = "Lowongan pekerjaan berhasil diperbarui.";
        header("Location: lowongan-kerja.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat memperbarui lowongan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <?php include "../includes/sidebar.php"; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <section class="dashboard">
            <h2>Edit Lowongan Pekerjaan</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert-error"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" name="posisi" id="posisi" value="<?= $data['posisi']; ?>" required />
                </div>

                <div class="form-group">
                    <label for="perusahaan">Perusahaan</label>
                    <input type="text" name="perusahaan" id="perusahaan" value="<?= $data['perusahaan']; ?>" required />
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="Tersedia" <?= ($data['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="Kosong" <?= ($data['status'] == 'Kosong') ? 'selected' : ''; ?>>Kosong</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"><?= $data['deskripsi']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="jumlah_lowongan">Jumlah Lowongan</label>
                    <input type="number" name="jumlah_lowongan" id="jumlah_lowongan" value="<?= $data['jumlah_lowongan']; ?>" required />
                </div>

                <button type="submit" class="btn-crud">Perbarui Lowongan</button>
                <a href="lowongan-kerja.php" class="btn-back">Kembali</a>
            </form>
        </section>
    </div>

</body>

</html>
