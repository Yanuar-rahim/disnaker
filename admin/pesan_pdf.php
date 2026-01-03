<?php
// Ambil data dari database
include "../config/koneksi.php";
$query = "SELECT * FROM pesan_user";
$result = mysqli_query($koneksi, $query);

// Mulai output PDF
ob_start();

// HTML untuk tampilan PDF
echo "<html><head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head><body>";

echo "<h2>Laporan Data Pesan Pengguna</h2>";
echo "<p>Berikut adalah laporan pesan yang masuk dari pengguna:</p>";
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
echo "</body></html>";

// Output PDF
$html = ob_get_contents();
ob_end_clean();

// Outputkan PDF
echo $html;
echo '<script>window.print();</script>';
exit;
?>
