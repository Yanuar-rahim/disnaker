<?php
// Mulai output PDF manual
ob_start();

// Ambil data dari database
include "../config/koneksi.php";
$query = "SELECT * FROM layanan";
$result = mysqli_query($koneksi, $query);

// Membuat PDF menggunakan HTML biasa
echo "<html><head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head><body>";

// Menambahkan teks deskripsi sebelum tabel
echo "<h2>Laporan Data Layanan</h2>";
echo "<p>Berikut adalah laporan data layanan yang tersedia. Tabel ini mencakup nama layanan, deskripsi, dan tanggal terbit layanan.</p>";
echo "<p>Silakan lihat tabel di bawah ini untuk informasi lebih lanjut.</p>";

echo "<br>";

// Membuat tabel data layanan
echo "<table>";
echo "<tr>
        <th style='text-align: center;'>No</th>
        <th>Nama Layanan</th>
        <th>Deskripsi</th>
        <th style='text-align: center;'>Tanggal Terbit</th>
    </tr>";

// Menulis data layanan
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td style='text-align: center;'>" . $no++ . "</td>";
    echo "<td>" . $row['nama_layanan'] . "</td>";
    echo "<td>" . $row['deskripsi'] . "</td>";
    echo "<td style='text-align: center;'>" . $row['created_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";

// Ambil HTML yang sudah dibangun dan output PDF dengan header
$html = ob_get_contents();
ob_end_clean();

// Output PDF
echo $html;
echo '<script>window.print();</script>';

exit;
?>
