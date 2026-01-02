<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Menangani pengiriman pertanyaan dari formulir
if (isset($_POST["kirim"])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pertanyaan = $_POST['pertanyaan'];

    // Query untuk menyimpan pertanyaan ke database
    $query = mysqli_query($koneksi, "INSERT INTO pesan_user (nama_lengkap, email, pesan, status) VALUES ('$nama', '$email', '$pertanyaan', 'unread')");
    
    if ($query) {
        $_SESSION['success'] = "Pertanyaan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.";
        header("Location: bantuan.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat mengirim pertanyaan. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan | Disnaker</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert-error"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php include "../includes/navbar.php"; ?>

    <main class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Pusat Bantuan</h2>
                <p>Temukan jawaban atas pertanyaan Anda atau hubungi kami untuk bantuan lebih lanjut.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <!-- FAQ Section -->
                <div class="card-faq" style="margin-bottom: 40px;">
                    <h3>Frequently Asked Questions (FAQ)</h3>
                    <div class="faq-list">
                        <div class="faq-item">
                            <h4>1. Bagaimana cara mengajukan layanan?</h4>
                            <p>Anda dapat mengajukan layanan dengan memilih layanan yang ingin diajukan pada halaman
                                "Ajukan Layanan". Setelah itu, lengkapi formulir dan klik tombol ajukan.</p>
                        </div>
                        <div class="faq-item">
                            <h4>2. Apa yang harus dilakukan jika status pengajuan saya belum berubah?</h4>
                            <p>Jika status pengajuan Anda belum berubah dalam waktu yang lama, silakan hubungi kami
                                melalui fitur "Hubungi Kami" di halaman Pusat Bantuan atau melalui email.</p>
                        </div>
                        <div class="faq-item">
                            <h4>3. Bagaimana cara mengetahui status pengajuan saya?</h4>
                            <p>Untuk mengecek status pengajuan, Anda dapat mengunjungi halaman "Cek Status Pengajuan"
                                dan masukkan nomor pengajuan atau informasi yang diminta.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Us Section -->
                <div class="card-faq">
                    <h3>Hubungi Kami</h3>
                    <p>Jika Anda tidak menemukan jawaban untuk pertanyaan Anda, silakan kirim pertanyaan Anda melalui
                        formulir di bawah ini dan tim kami akan segera menghubungi Anda.</p>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nama">Nama Anda</label>
                            <input type="text" name="nama" id="nama" value="<?= $_SESSION['nama_lengkap']; ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label for="email">Email Anda</label>
                            <input type="email" name="email" id="email" value="<?= $_SESSION['email'] ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label for="pertanyaan">Pertanyaan Anda</label>
                            <textarea name="pertanyaan" id="pertanyaan" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="kirim" class="btn-primary" style="width: 20%;">Kirim Pertanyaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>
