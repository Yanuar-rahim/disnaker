<?php
include 'config/koneksi.php';

$error = "";
$success = "";

// Ambil data dari form
if (isset($_POST['register'])) {
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validasi form
    if (empty($nik) || empty($nama_lengkap) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Semua kolom harus diisi.";
    } else {
        // Cek apakah password dan konfirmasi password sama
        if ($password !== $confirm_password) {
            $error = "Password dan konfirmasi password tidak sama.";
        } else {
            // Enkripsi password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            // Cek apakah email atau NIK sudah terdaftar
            $sql = "SELECT * FROM users WHERE email = '$email' OR nik = '$nik'";
            $result = mysqli_query($koneksi, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $error = "Email atau NIK sudah terdaftar. Silakan gunakan email atau NIK lain.";
            } else {
                // Simpan data pengguna ke dalam database
                $sql = "INSERT INTO users (nik, nama_lengkap, email, password) 
                VALUES ('$nik', '$nama_lengkap', '$email', '$password_hash')";
        
                if (mysqli_query($koneksi, $sql)) {
                    $success = "Pendaftaran berhasil. <a href='login.php'>Login sekarang</a>";
                } else {
                    $error = "Terjadi kesalahan: " . mysqli_error($koneksi);
                }
            }
        }
    }
}
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Informasi Pelayanan Terpadu Disnaker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>

    <?php include "includes/header-index.php"; ?>

    <main class="main-content">
        <section class="login-section">
            <div class="container-auth">
                <div class="login-form">
                    <h2>Daftar Pengguna</h2>
                    <p>Silakan isi data berikut untuk membuat akun baru.</p>

                    <?php if ($error): ?>
                        <div class="alert error"><?= $error; ?></div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert success"><?= $success; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" name="nik" required placeholder="Masukkan NIK" />
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required
                                placeholder="Masukkan nama lengkap" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Masukkan email" />
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" required
                                placeholder="Masukkan kata sandi" />
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirm-password" name="confirm-password" required
                                placeholder="Konfirmasi kata sandi" />
                        </div>

                        <button type="submit" class="btn-primary" name="register">Daftar</button>
                    </form>

                    <div class="footer-login">
                        <p>Sudah punya akun? <a href="login.php">Login sekarang</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>

</body>

</html>