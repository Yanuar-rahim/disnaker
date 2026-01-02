-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2026 at 11:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disnaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `deskripsi`, `created_at`) VALUES
(1, 'Kartu Pencari Kerja (AK1)', 'Pendaftaran dan pencetakan kartu pencari kerja secara online.', '2026-01-02 06:17:48'),
(2, 'Pelatihan Kerja', 'Informasi dan pendaftaran pelatihan keterampilan kerja.', '2026-01-02 06:17:48'),
(3, 'Lowongan Kerja', 'Informasi lowongan kerja dari perusahaan mitra.', '2026-01-02 06:17:48'),
(4, 'Pengaduan Ketenagakerjaan', 'Layanan pengaduan masalah ketenagakerjaan.', '2026-01-02 06:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_kerja`
--

CREATE TABLE `lowongan_kerja` (
  `id` int(11) NOT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `status` enum('Tersedia','Kosong') DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah_lowongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan_kerja`
--

INSERT INTO `lowongan_kerja` (`id`, `perusahaan`, `posisi`, `status`, `deskripsi`, `jumlah_lowongan`) VALUES
(13, 'PT. Teknologi Canggih', 'Software Engineer', 'Tersedia', 'Bergabung dengan tim pengembang untuk mengembangkan aplikasi perangkat lunak berbasis web.', 5),
(14, 'CV. Maju Jaya', 'Marketing Executive', 'Tersedia', 'Mencari kandidat yang dapat mengelola dan memperluas jaringan pemasaran perusahaan.', 3),
(15, 'PT. Sukses Bersama', 'Accountant', 'Tersedia', 'Bertanggung jawab atas pencatatan transaksi keuangan perusahaan serta penyusunan laporan keuangan.', 2),
(16, 'PT. Digital Vision', 'Graphic Designer', 'Tersedia', 'Desain materi visual untuk berbagai media promosi dan branding perusahaan.', 4),
(17, 'CV. Abadi Sejahtera', 'Customer Service', 'Tersedia', 'Melakukan pelayanan pelanggan dan penyelesaian masalah yang dihadapi pelanggan.', 6),
(18, 'PT. Global Technology', 'Network Engineer', 'Tersedia', 'Bertanggung jawab untuk memelihara dan memperbaiki jaringan komputer perusahaan.', 3),
(19, 'PT. Sinergi Solusi', 'Human Resources Manager', 'Tersedia', 'Merekrut, mengelola, dan mengembangkan karyawan untuk mencapai tujuan perusahaan.', 1),
(20, 'PT. Mitra Karya', 'Web Developer', 'Tersedia', 'Bergabung untuk mengembangkan aplikasi web berbasis teknologi terkini.', 4),
(21, 'CV. Kreatif Inovasi', 'UI/UX Designer', 'Tersedia', 'Merancang dan meningkatkan pengalaman pengguna pada aplikasi berbasis digital.', 2),
(22, 'PT. Alpha Group', 'Product Manager', 'Tersedia', 'Mengelola produk dari tahap pengembangan hingga peluncuran ke pasar, termasuk riset dan pengembangan.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jenis_pengajuan` varchar(100) NOT NULL,
  `status` enum('baru','diproses','selesai','ditolak') DEFAULT 'baru',
  `tanggal_pengajuan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `nama_lengkap`, `nik`, `jenis_pengajuan`, `status`, `tanggal_pengajuan`) VALUES
(11, 'Andi Saputra', '3201010101010001', 'AK1', 'diproses', '2026-01-01'),
(12, 'Budi Santoso', '3201010101010002', 'Pelatihan Kerja', 'ditolak', '2026-01-02'),
(13, 'Citra Dewi', '3201010101010003', 'Lowongan Kerja', 'selesai', '2026-01-03'),
(14, 'Dewi Rahma', '3201010101010004', 'AK1', 'diproses', '2026-01-04'),
(15, 'Eko Wijaya', '3201010101010005', 'Pelatihan Kerja', 'diproses', '2026-01-05'),
(16, 'Fadli Ardiansyah', '3201010101010006', 'Lowongan Kerja', 'selesai', '2026-01-06'),
(17, 'Gita Handayani', '3201010101010007', 'AK1', 'baru', '2026-01-07'),
(18, 'Hadi Setiawan', '3201010101010008', 'Pelatihan Kerja', 'diproses', '2026-01-08'),
(19, 'Indah Pratiwi', '3201010101010009', 'Lowongan Kerja', 'selesai', '2026-01-09'),
(20, 'Joko Sutrisno', '3201010101010010', 'AK1', 'baru', '2026-01-10'),
(34, 'La Ode Yanuar Rahim', '7472050901050002', 'Lowongan Kerja', 'baru', '2026-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_user`
--

CREATE TABLE `pesan_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('read','unread','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama_lengkap`, `email`, `password`, `role`, `created_at`) VALUES
(14, '7472050901050002', 'La Ode Yanuar Rahim', 'yanuarrahim519@gmail.com', '$2y$10$aLcK8kZp7k85AoPlH95.9.QhJGnP4ORkYEYcnELlMxJ.UM8Ap5uq2', 'user', '2026-01-02 02:10:14'),
(15, 'Admin', 'La Ode Yanuar Rahim', 'admin@gmail.com', '$2y$10$YtUNcXlJAjNC80NCBLJg7uFQGxlYit7sSpuIsUKpdGlEBnlis.DOS', 'admin', '2026-01-02 04:19:32'),
(16, '747230129508', 'Vyora Naumira', 'vyora@gmail.com', '$2y$10$WkVxIarOuC4LDpDOTm.5PODJsLXAlVXfmc9Ywg6RWFCo4Jc9CxOXe', 'user', '2026-01-02 11:16:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_user`
--
ALTER TABLE `pesan_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pesan_user`
--
ALTER TABLE `pesan_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
