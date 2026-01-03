<?php
include "../config/koneksi.php";

// Ambil data dari database
$query = "SELECT * FROM pengajuan";
$result = mysqli_query($koneksi, $query);

// Set header untuk ekspor Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_pengajuan.xls");

// Output data dalam format HTML (untuk Excel)
echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head>";
echo "<body>";

// Menambahkan teks deskripsi sebelum tabel
echo "<h2>Laporan Data Pengajuan</h2>";
echo "<p>Berikut adalah laporan detail pengajuan yang diterima dari pengguna. Data ini mencakup informasi seperti <br> nama pemohon, NIK, jenis layanan, tanggal pengajuan, dan status pengajuan. Data ini diambil langsung dari database pengajuan yang telah diajukan oleh pengguna. Data yang tertera <br> di bawah ini dapat digunakan untuk analisis lebih lanjut mengenai status pengajuan yang sedang diproses. Pastikan untuk memeriksa status setiap pengajuan secara teratur untuk <br> mempercepat proses.</p>";

// Menambahkan baris kosong
echo "<br>";

// Membuat tabel data pengajuan
echo "<table>";
echo "<tr><th>Nama Pemohon</th><th>NIK</th><th>Jenis Layanan</th><th>Tanggal Pengajuan</th><th>Status</th></tr>";

// Menulis data pengajuan
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['nama_lengkap'] . "</td>";
    echo "<td>" . $row['nik'] . "</td>";
    echo "<td>" . $row['jenis_pengajuan'] . "</td>";
    echo "<td>" . $row['tanggal_pengajuan'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";

exit;
?>
