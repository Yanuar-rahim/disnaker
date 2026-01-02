<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

// Ambil data dari sesi pengguna
$nama = $_SESSION['nama_lengkap'];
$user_id = $_SESSION['user_id'];
$nik = $_SESSION['nik'];

// Jika ID layanan diteruskan di URL, ambil data layanan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM layanan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    // Proses pengajuan layanan
    if ($data) {
        $layanan = $data['nama_layanan'];
        $tanggal_pengajuan = date('Y-m-d');

        // Query untuk memasukkan data pengajuan
        $queryInsert = "INSERT INTO pengajuan (nama_lengkap, nik, jenis_pengajuan, tanggal_pengajuan, status) 
                        VALUES ('$nama', '$nik', '$layanan', '$tanggal_pengajuan', 'baru')";

        // Eksekusi query pengajuan
        if (mysqli_query($koneksi, $queryInsert)) {
            // Jika berhasil, redirect atau tampilkan pesan sukses
            $_SESSION['success'] = "Pengajuan layanan '$layanan' berhasil diajukan.";
            header('Location: ajukan_layanan.php'); // Redirect ke halaman sukses
            exit();
        } else {
            // Jika gagal, beri pesan error
            $_SESSION['error'] = "Terjadi kesalahan saat mengajukan layanan '$layanan'. Silakan coba lagi.";
            header('Location: ajukan_layanan.php'); // Redirect ke halaman error
            exit();
        }
    } else {
        // Jika ID layanan tidak ditemukan
        $_SESSION['error'] = "Layanan tidak ditemukan.";
        header('Location: ajukan_layanan.php'); // Redirect ke halaman error
        exit();
    }
} else {
    // Jika ID layanan tidak diteruskan, beri pesan error
    $_SESSION['error'] = "Layanan tidak dipilih. Harap coba lagi.";
    header('Location: ajukan_layanan.php'); // Redirect ke halaman error
    exit();
}
?>
