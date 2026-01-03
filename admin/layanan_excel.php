<?php
include "../config/koneksi.php";

// Query untuk mendapatkan data layanan
$query = "SELECT * FROM layanan";
$result = mysqli_query($koneksi, $query);

// Set header untuk ekspor Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=layanan.xls");

// Output data dalam format HTML (untuk Excel)
echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head>";
echo "<body>";

// Menambahkan teks deskripsi sebelum tabel
echo "<h2>Laporan Data Layanan</h2>";
echo "<p>Berikut adalah laporan data layanan yang tersedia. Tabel ini mencakup nama layanan, deskripsi, dan tanggal terbit layanan.</p>";
echo "<p>Silakan lihat tabel di bawah ini untuk informasi lebih lanjut.</p>";

echo "<br>";

// Membuat tabel data layanan
echo "<table>";
echo "<tr><th>No</th><th>Nama Layanan</th><th>Deskripsi</th><th>Tanggal Terbit</th></tr>";

// Menulis data layanan
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['nama_layanan'] . "</td>";
    echo "<td>" . $row['deskripsi'] . "</td>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";

exit;
?>
