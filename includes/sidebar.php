<?php
$queryPesan = mysqli_query($koneksi, "SELECT * FROM pesan_user WHERE status = 'unread'");
$totalPesan = mysqli_num_rows($queryPesan);
?>

<div class="sidebar">
    <div class="logo">
        <h1>Admin Disnaker</h1>
    </div>

    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="data-pengajuan.php">Data Pengajuan</a></li>
            <li><a href="lowongan-kerja.php">Lowongan Kerja</a></li>
            <li><a href="layanan.php">Layanan</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li>
                <a href="pesan.php" style="display: flex; justify-content: start;">
                    Pesan
                    <?php if ($totalPesan > 0): ?>
                        <span class="badge-notif"><?= $totalPesan ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</div>