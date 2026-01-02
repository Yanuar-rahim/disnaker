<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Menangani form submit
if (isset($_POST["tambah"])) {
    $posisi = $_POST['posisi'];
    $perusahaan = $_POST['perusahaan'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah_lowongan = $_POST['jumlah_lowongan'];

    // Query untuk menyimpan data lowongan baru
    $query = "INSERT INTO lowongan_kerja (posisi, perusahaan, status, deskripsi, jumlah_lowongan) 
              VALUES ('$posisi', '$perusahaan', '$status', '$deskripsi', '$jumlah_lowongan')";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Lowongan pekerjaan berhasil ditambahkan.";
        header("Location: lowongan-kerja.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan lowongan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lowongan - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <?php include "../includes/sidebar.php"; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <section class="dashboard">
            <h2>Tambah Lowongan Pekerjaan</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert-error"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" action="" class="form-input">
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" name="posisi" id="posisi" required />
                </div>

                <div class="form-group">
                    <label for="perusahaan">Perusahaan</label>
                    <input type="text" name="perusahaan" id="perusahaan" required />
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Kosong">Kosong</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="jumlah_lowongan">Jumlah Lowongan</label>
                    <input type="number" name="jumlah_lowongan" id="jumlah_lowongan" required />
                </div>

                <button type="submit"class="btn-crud" name="tambah">Tambah Lowongan</button>
                <a href="lowongan-kerja.php" class="btn-back">Kembali</a>
            </form>
        </section>
    </div>

</body>

</html>
