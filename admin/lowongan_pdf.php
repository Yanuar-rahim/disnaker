<?php
// Mulai output PDF manual
ob_start();

// Ambil data dari database
include "../config/koneksi.php";
$query = "SELECT * FROM lowongan_kerja";
$result = mysqli_query($koneksi, $query);

// Membuat PDF menggunakan HTML biasa
echo "<html><head><style>";
echo "table {border-collapse: collapse; width: 100%;} ";
echo "td, th {border: 1px solid black; padding: 8px; text-align: left;} ";
echo "</style></head><body>";

// Menambahkan teks deskripsi sebelum tabel
echo "<h2>Laporan Data Lowongan Pekerjaan</h2>";
echo "<p>Berikut adalah laporan detail lowongan pekerjaan yang tersedia di perusahaan kami. Data ini mencakup informasi posisi pekerjaan, perusahaan, status lowongan, dan jumlah lowongan yang tersedia.</p>";
echo "<p>Silakan lihat tabel di bawah ini untuk informasi lebih lanjut tentang setiap lowongan pekerjaan yang tersedia.</p>";

// Menambahkan baris kosong
echo "<br>";

// Membuat tabel data lowongan
echo "<table>";
echo "<tr>
        <th>No</th>
        <th>Posisi</th>
        <th>Perusahaan</th>
        <th style='text-align: center;'>Status</th>
        <th style='text-align: center;'>Jumlah Lowongan</th>
    </tr>";

// Menulis data lowongan
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['posisi'] . "</td>";
    echo "<td>" . $row['perusahaan'] . "</td>";
    echo "<td style='text-align: center;'>" . $row['status'] . "</td>";
    echo "<td style='text-align: center;'>" . $row['jumlah_lowongan'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";

// Ambil HTML yang sudah dibangun dan output PDF dengan header
$html = ob_get_contents();
ob_end_clean();

// Menghasilkan PDF dari HTML tanpa menggunakan library eksternal
echo $html;
echo '<script>window.print();</script>';

exit;
?>
