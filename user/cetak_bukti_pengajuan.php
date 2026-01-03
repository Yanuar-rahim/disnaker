<?php
include "../config/koneksi.php";

// Pastikan ID pengajuan diterima
if (!isset($_GET['id'])) {
    die("ID pengajuan tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data pengajuan berdasarkan ID
$query = "SELECT * FROM pengajuan WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data pengajuan tidak ditemukan
if (!$data) {
    die("Pengajuan tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pengajuan</title>
    <style>
        @media print {
            button.print-button {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            margin: 0;
            color: #4CAF50;
        }

        .card-body {
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card-body p {
            font-size: 16px;
            color: #555;
            margin: 8px 0;
        }

        .card-body .badge-completed {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .row {
            display: flex;
            align-items: center;
        }

        .row p {
            width: 30%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            width: 30%;
        }

        .print-button {
            display: inline-block;
            width: 200px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 20px auto;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-header">
            <h2>Bukti Pengajuan</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <p><strong>Nama Layanan</strong></p>
                <span><?= $data['jenis_pengajuan']; ?></span>
            </div>
            <div class="row">
                <p><strong>Tanggal Pengajuan</strong></p>
                <span><?= $data['tanggal_pengajuan']; ?></span>
            </div>
            <div class="row">
                <p><strong>Status</strong></p> 
                <span>
                    <?php
                    if ($data['status'] == 'selesai') {
                        echo '<span class="badge-completed">Pengajuan Selesai</span>';
                    }
                    ?>
                    </span>
            </div>
            <div class="row">
                <p><strong>Nama Pemohon</strong></p>
                <span><?= $data['nama_lengkap']; ?></span>
            </div>
            <div class="row">
                <p><strong>NIK</strong></p>
                <span><?= $data['nik']; ?></span>
            </div>
        </div>

        <table>
            <tr>
                <th>Jenis Pengajuan</th>
                <td><?= $data['jenis_pengajuan']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td><?= $data['tanggal_pengajuan']; ?></td>
            </tr>
            <tr>
                <th>Status Pengajuan</th>
                <td><?= $data['status']; ?></td>
            </tr>
        </table>

        <div class="row" style="margin-top: 10px; align-items: baseline;">
            <p><strong>Pesan</strong></p>
            <span style="width: 70%; line-height: 1.6;">Harap disimpan dengan baik. Dokumen ini yang nantinya menjadi bukti bahwa anda sudah mengajukan <?= $data['jenis_pengajuan']; ?>.</span>
        </div>

        <div style="text-align: center;">
            <button class="print-button" onclick="window.print()">Cetak Bukti Pengajuan</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Dinas Ketenagakerjaan. All Rights Reserved.</p>
    </footer>

</body>

</html>