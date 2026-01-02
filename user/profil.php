<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

// Mendapatkan ID user dari sesi
$user_id = $_SESSION['user_id'];

// Query untuk mengambil data profil pengguna berdasarkan ID
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

// Cek jika data user tidak ditemukan
if (!$data) {
    $_SESSION['error'] = "Pengguna tidak ditemukan.";
    header("Location: index.php");
    exit();
}

// Proses pembaruan profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update profil
    if (isset($_POST['update_profile'])) {
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $nik = $_POST['nik'];

        // Query untuk memperbarui data profil
        $update_query = "UPDATE users SET nama_lengkap = '$nama_lengkap', email = '$email', nik = '$nik' WHERE id = $user_id";

        if (mysqli_query($koneksi, $update_query)) {
            $_SESSION['success'] = "Profil Anda berhasil diperbarui.";
            header("Location: profil.php");
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat memperbarui profil.";
        }
    }

    // Ganti password
    if (isset($_POST['change_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Verifikasi password lama
        if (password_verify($old_password, $data['password'])) {
            if ($new_password === $confirm_password) {
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                // Query untuk memperbarui password
                $update_password_query = "UPDATE users SET password = '$new_password_hash' WHERE id = $user_id";

                if (mysqli_query($koneksi, $update_password_query)) {
                    $_SESSION['success'] = "Password Anda berhasil diperbarui.";
                } else {
                    $_SESSION['error'] = "Terjadi kesalahan saat memperbarui password.";
                }
            } else {
                $_SESSION['error'] = "Konfirmasi password tidak cocok.";
            }
        } else {
            $_SESSION['error'] = "Password lama yang Anda masukkan salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Profil Pengguna</h2>
                <p>Perbarui informasi profil Anda di sini.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <!-- Menampilkan pesan error jika ada -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert-error"><?= $_SESSION['error']; ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Menampilkan pesan sukses jika ada -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert-success"><?= $_SESSION['success']; ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <!-- Form Pembaruan Profil -->
                 <div class="form-card">
                     <form method="POST" action="">
                         <div class="form-group">
                             <label for="nama_lengkap">Nama Lengkap</label>
                             <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $data['nama_lengkap']; ?>" required />
                         </div>
     
                         <div class="form-group">
                             <label for="email">Email</label>
                             <input type="email" name="email" id="email" value="<?= $data['email']; ?>" required />
                         </div>
     
                         <div class="form-group">
                             <label for="nik">Nomor Induk Kependudukan</label>
                             <input type="text" name="nik" id="nik" value="<?= $data['nik']; ?>" required />
                         </div>
     
                         <div class="form-group">
                             <button type="submit" class="btn-primary" name="update_profile" style="width: 218px;">Perbarui Profil</button>
                         </div>
                     </form>
                 </div>


                <!-- Form Ganti Password -->
                 <div class="form-card">
                     <form method="POST" action="">
                         <h3>Ganti Password</h3>
                         <div class="form-group">
                             <label for="old_password">Password Lama</label>
                             <input type="password" name="old_password" id="old_password" required />
                         </div>
     
                         <div class="form-group">
                             <label for="new_password">Password Baru</label>
                             <input type="password" name="new_password" id="new_password" required />
                         </div>
     
                         <div class="form-group">
                             <label for="confirm_password">Konfirmasi Password Baru</label>
                             <input type="password" name="confirm_password" id="confirm_password" required />
                         </div>
     
                         <div class="form-group">
                             <button type="submit" class="btn-primary" name="change_password" style="width: 218px;">Ganti Password</button>
                         </div>
                     </form>
                 </div>

                <div class="form-group">
                    <a href="index.php" class="btn-primary">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>
