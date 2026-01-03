<?php
include "../config/koneksi.php";

// Ambil data dari database
$query = "SELECT * FROM pengajuan";
$result = mysqli_query($koneksi, $query);

// Mulai output HTML
$html = '
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Pengajuan</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Pemohon</th>
                <th>NIK</th>
                <th>Jenis Layanan</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
';

// Menambahkan baris data ke dalam tabel
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '
    <tr>
        <td>' . $row['nama_lengkap'] . '</td>
        <td>' . $row['nik'] . '</td>
        <td>' . $row['jenis_pengajuan'] . '</td>
        <td style="text-align: center;">' . $row['tanggal_pengajuan'] . '</td>
        <td style="text-align: center;">' . $row['status'] . '</td>
    </tr>
    ';
}

$html .= '
        </tbody>
    </table>
</body>
</html>
';

// Outputkan HTML ke browser untuk dicetak atau diubah menjadi PDF
echo $html;
echo '<script>window.print();</script>';
exit;

?>
