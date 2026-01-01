<?php
// Koneksi ke database
include 'config/koneksi.php';

// Ambil data dari form
$nik = $_POST['nik'];
$nama_lengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Validasi form
if (empty($nik) || empty($nama_lengkap) || empty($email) || empty($password) || empty($confirm_password)) {
    die("Semua kolom harus diisi.");
}

// Cek apakah password dan konfirmasi password sama
if ($password !== $confirm_password) {
    die("Password dan konfirmasi password tidak sama.");
}

// Enkripsi password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Cek apakah email atau NIK sudah terdaftar
$sql = "SELECT * FROM users WHERE email = '$email' OR nik = '$nik'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    die("Email atau NIK sudah terdaftar. Silakan gunakan email atau NIK lain.");
}

// Simpan data pengguna ke dalam database
$sql = "INSERT INTO users (nik, nama_lengkap, email, password) 
        VALUES ('$nik', '$nama_lengkap', '$email', '$password_hash')";

if (mysqli_query($koneksi, $sql)) {
    echo "Pendaftaran berhasil. <a href='login.php'>Login sekarang</a>";
} else {
    echo "Terjadi kesalahan: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Informasi Pelayanan Terpadu Disnaker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

    <?php include "includes/header-index.php"; ?>

    <main class="main-content">
        <section class="login-section">
            <div class="container">
                <div class="login-form">
                    <h2>Daftar Pengguna</h2>
                    <p>Silakan isi data berikut untuk membuat akun baru.</p>

                    <form action="register-process.php" method="POST">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" name="nik" required placeholder="Masukkan NIK" />
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required placeholder="Masukkan nama lengkap" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Masukkan email" />
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi" />
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirm-password" name="confirm-password" required placeholder="Konfirmasi kata sandi" />
                        </div>

                        <button type="submit" class="btn-primary">Daftar</button>
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