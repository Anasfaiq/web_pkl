-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2026 at 06:42 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webpkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_material`
--

CREATE TABLE `data_material` (
  `id` int NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kondisi` enum('Baik','Dismantle','Rekondisi','Ex project') NOT NULL,
  `zona` enum('A','B','C','D') NOT NULL,
  `rak` enum('Level 1','Level 2','Level 3','Level 4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_material`
--

INSERT INTO `data_material` (`id`, `kode`, `nama`, `kondisi`, `zona`, `rak`) VALUES
(1, 'MT-09', 'WIFI RUIJIE', 'Baik', 'A', 'Level 1'),
(2, 'MR-20', 'KABEL LAN', 'Rekondisi', 'B', 'Level 3'),
(3, 'RT-12', 'KABEL FO', 'Baik', 'D', 'Level 4');

-- --------------------------------------------------------

--
-- Table structure for table `foto_material`
--

CREATE TABLE `foto_material` (
  `id` int NOT NULL,
  `nomor_material` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `foto_material`
--

INSERT INTO `foto_material` (`id`, `nomor_material`, `nama`, `detail`, `foto`) VALUES
(1, 1234567890, 'WIFI RUJIE', 'AH0081', 'fotonya anu '),
(2, 1234567899, 'SFP 6COM', '1220 M 1.5G ', 'BLOM'),
(3, 987654321, 'SFB XR 6 COM', '1550 M 1.5G 1000BASE', 'BELUM'),
(4, 1234444444, 'SFP 7COM', '1220 M 2G', 'iconweb/material_1767701504.png');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_gangguan`
--

CREATE TABLE `laporan_gangguan` (
  `id` int NOT NULL,
  `mulai` datetime NOT NULL,
  `selesai` datetime NOT NULL,
  `durasi` int NOT NULL,
  `penyebab` varchar(100) NOT NULL,
  `solusi` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_gangguan`
--

INSERT INTO `laporan_gangguan` (`id`, `mulai`, `selesai`, `durasi`, `penyebab`, `solusi`, `lokasi`) VALUES
(1, '2025-11-19 11:08:44', '2025-11-19 15:08:44', 130, 'WEDIOKDASKDNWOD', 'WIAODKMNRHYWEUDJIJN DBH', 'EJKDMSNCFJDSKMD NEJWK'),
(2, '2025-11-19 11:08:00', '2025-11-19 16:08:00', 300, 'TEDGYWHUDSJXN', 'DWDASDEWFRGEFD', 'EUJOIKDJLWKDOEWIDL'),
(3, '2025-11-19 11:11:18', '2025-11-19 13:11:18', 70, 'WEDHJKSMDWJQOIDJ', 'QDNOIQKMDMWQD', 'QKWDOPLQMDJ');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_petugas`
--

CREATE TABLE `penilaian_petugas` (
  `id` int NOT NULL,
  `tanggal_cek` date NOT NULL,
  `tanggal_insiden` date NOT NULL,
  `nama_mitra` varchar(100) NOT NULL,
  `nama_petugas_close` varchar(100) NOT NULL,
  `sbu` enum('RBNT','RJBB','RJBT','RJKB','RJTG','RKLM','RSBS','RSBT','RSBU','RSLW') NOT NULL,
  `kp` varchar(30) NOT NULL,
  `penyebab` varchar(100) NOT NULL,
  `evd_k3` enum('Ada','Tidak ada') NOT NULL,
  `evd_summary` enum('Ada','Tidak ada') NOT NULL,
  `foto_penyebab` enum('Ada','Tidak ada') NOT NULL,
  `foto_perbaikan` enum('Ada','Tidak ada') NOT NULL,
  `kesesuaian` enum('Ada','Tidak ada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penilaian_petugas`
--

INSERT INTO `penilaian_petugas` (`id`, `tanggal_cek`, `tanggal_insiden`, `nama_mitra`, `nama_petugas_close`, `sbu`, `kp`, `penyebab`, `evd_k3`, `evd_summary`, `foto_penyebab`, `foto_perbaikan`, `kesesuaian`) VALUES
(5, '2025-11-19', '2025-11-18', 'PT. Sejahtera Jaya', 'Totong Santoso', 'RBNT', 'Bali', 'FOC - CORE BENDING,TERJEPIT DI FDT', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada'),
(6, '2025-11-18', '2025-11-19', 'PT. AUU', 'Dendeng Sugeng', 'RJBB', 'Depok', 'FOC - CORE BENDING,\r\nPATCHCORD BENDING\r\n', 'Ada', 'Tidak ada', 'Tidak ada', 'Ada', 'Ada'),
(7, '2025-11-17', '2025-11-19', 'PT. Cahaya Lestari', 'Sunday', 'RBNT', 'Bali', 'FOC - PUTUS CORE,\r\nCORE RAPUH\r\n', 'Tidak ada', 'Tidak ada', 'Tidak ada', 'Tidak ada', 'Tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `id`, `nama`, `password`) VALUES
('admin', 1, 'admin', '$2y$10$1stMnuk4mkksihtybPrIyesIS5KUo.ZhtRHD5NhgGwzFakm4BTDfW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_material`
--
ALTER TABLE `data_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_material`
--
ALTER TABLE `foto_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_gangguan`
--
ALTER TABLE `laporan_gangguan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian_petugas`
--
ALTER TABLE `penilaian_petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_material`
--
ALTER TABLE `data_material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foto_material`
--
ALTER TABLE `foto_material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan_gangguan`
--
ALTER TABLE `laporan_gangguan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian_petugas`
--
ALTER TABLE `penilaian_petugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
