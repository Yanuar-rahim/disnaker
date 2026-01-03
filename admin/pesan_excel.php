<?php
include "../config/koneksi.php";

// Ambil data pesan
$query = "SELECT * FROM pesan_user";
$result = mysqli_query($koneksi, $query);

// Set header untuk file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pesan_user.xls");

// Tulis data dalam format Excel (HTML)
echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head>";
echo "<body>";

// Menambahkan teks deskripsi sebelum tabel
echo "<h2>Laporan Data Pesan Pengguna</h2>";
echo "<p>Berikut adalah laporan data pesan yang masuk dari pengguna, termasuk nama pengirim, email, dan pesan.</p>";
echo "<p>Silakan lihat tabel di bawah ini untuk detail lebih lanjut.</p>";

echo "<br>";

// Tampilkan tabel data pesan
echo "<table>";
echo "<tr><th>No</th><th>Nama Pengirim</th><th>Email</th><th>Pesan</th></tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['nama_lengkap'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['pesan'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";

exit;
?>
