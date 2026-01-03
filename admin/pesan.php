<?php
include "../config/koneksi.php";
include "../includes/auth_check.php";

$required_role = $_SESSION['role'];

// Menangani pencarian
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Mengambil pesan berdasarkan filter pencarian
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM pesan_user 
            WHERE 
                nama_lengkap LIKE '%$search%' OR 
                email LIKE '%$search%' OR
                pesan LIKE '%$search%'
            ORDER BY id DESC"
);

$pesan = mysqli_query($koneksi, "UPDATE pesan_user SET status = 'read'");

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Pengguna - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script>
        // Fungsi untuk memilih/deselect semua checkbox
        function pilihSemua(checkbox) {
            var checkboxes = document.getElementsByName('pesan_ids[]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkbox.checked;
            }
        }
    </script>
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

    <?php include "../includes/sidebar.php"; ?>

    <main class="main-content">
        <section class="dashboard">
            <h2>Pesan dari Pengguna</h2>
            <div class="actions">
                <!-- Form pencarian -->
                <form action="" method="get">
                    <input type="text" name="search" placeholder="Cari pesan..." class="search-input">
                    <button type="submit" class="btn-search">Cari</button>
                </form>

                <!-- Aksi untuk ekspor atau hapus pesan -->
                <div>
                    <button class="btn-export" onclick="window.location.href='pesan_excel.php'">Ekspor ke Excel</button>
                    <button class="btn-export" onclick="window.location.href='pesan_pdf.php'">Ekspor ke PDF</button>
                </div>
            </div>

            <!-- Tabel Pesan -->
            <div class="lowongan-tabel">
                <form method="POST" action="hapus_pesan.php">
                    <table>
                        <thead>
                            <tr>
                                <th width="10px"><input type="checkbox" onclick="pilihSemua(this)"></th>
                                <th style="text-align: center; width: 10px;">No.</th>
                                <th style="text-align: center;">Nama Pengirim</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($query) > 0): ?>
                                <?php $no = 1; ?>
                                <?php while ($data = mysqli_fetch_array($query)): ?>
                                    <tr>
                                        <td><input type="checkbox" name="pesan_ids[]" value="<?= $data['id'] ?>"></td>
                                        <td style="text-align: center;"><?= $no++ ?></td>
                                        <td><?= $data['nama_lengkap'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['pesan'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty-data">Tidak ada pesan masuk</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <form method="POST" action="hapus_pesan.php ">
                            <button type="submit" name="hapus" class="btn-danger" onclick="return confirm('Hapus pesan yang dipilih?')">Hapus Terpilih</button>
                        </form>
                    </table>
                </form>
            </div>
        </section>
    </main>

</body>

</html>