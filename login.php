<?php
session_start();
include 'config/koneksi.php';

$error = "";
$success = "";

if (isset($_POST['login'])) {
    // Mengambil input dari form dan memfilter untuk mencegah SQL Injection
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Semua kolom harus diisi.";
    } else {
        // Query untuk mencari pengguna berdasarkan email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) == 0) {
            $error = "Email tidak terdaftar.";
        } else {
            $user = mysqli_fetch_assoc($result);

            // Memeriksa password yang dimasukkan dengan password yang terenkripsi
            if (password_verify($password, $user['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['role']; // Menyimpan role
                $_SESSION['success'] = "Berhasil login! Selamat datang, " . $user['nama_lengkap'] . ".";

                // Mengarahkan ke halaman dashboard sesuai role
                if ($user['role'] === 'admin') {
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: user/index.php");
                }
                exit();
            } else {
                $error = "Password salah.";
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
    <title>Login - Sistem Informasi Pelayanan Terpadu Disnaker</title>
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
                    <h2>Login Pengguna</h2>
                    <p>Masukkan email dan kata sandi Anda untuk melanjutkan.</p>

                    <?php if ($error): ?>
                        <div class="alert error"><?= $error; ?></div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert success"><?= $success; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Masukkan email" />
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" required
                                placeholder="Masukkan kata sandi" />
                        </div>

                        <button type="submit" class="btn-primary" name="login">Login</button>
                    </form>

                    <div class="footer-login">
                        <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>

</body>

</html>