<?php
include "../config/koneksi.php";

// Ambil data dari database
$query = "SELECT * FROM lowongan_kerja";
$result = mysqli_query($koneksi, $query);

// Set header untuk ekspor Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=lowongan_pekerjaan.xls");

// Output data dalam format HTML (untuk Excel)
echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head>";
echo "<body>";

// Menambahkan teks deskripsi sebelum tabel
echo "<h2>Laporan Data Lowongan Pekerjaan</h2>";
echo "<p>Berikut adalah laporan detail lowongan pekerjaan yang tersedia di perusahaan kami. Data ini <br> 
mencakup informasi posisi pekerjaan, perusahaan, status lowongan, dan jumlah lowongan yang tersedia. <br>
Silakan lihat tabel di bawah ini untuk informasi lebih lanjut tentang setiap lowongan pekerjaan yang tersedia.</p>";

// Menambahkan baris kosong
echo "<br>";

// Membuat tabel data lowongan
echo "<table>";
echo "<tr><th>No</th><th>Posisi</th><th>Perusahaan</th><th>Status</th><th>Jumlah Lowongan</th></tr>";

// Menulis data lowongan
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['posisi'] . "</td>";
    echo "<td>" . $row['perusahaan'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['jumlah_lowongan'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";

exit;
?>
