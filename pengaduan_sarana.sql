-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 02:04 AM
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
-- Database: `pengaduan_sarana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(5) NOT NULL,
  `status` enum('Menunggu','Proses','Selesai') DEFAULT 'Menunggu',
  `id_kategori` int(5) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `status`, `id_kategori`, `feedback`, `username`) VALUES
(1, 'Selesai', NULL, '0', NULL),
(2, 'Selesai', NULL, '0', NULL),
(3, 'Proses', NULL, '0', NULL),
(4, 'Selesai', NULL, '0', NULL),
(5, 'Selesai', 1, 'akan saya perbaiki', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int(5) NOT NULL,
  `nis` int(10) DEFAULT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Menunggu',
  `feedback` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `tgl_pelaporan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `status`, `feedback`, `foto`, `tgl_pelaporan`) VALUES
(5, 321123, 1, '12 rpl 5', 'sapu patah', 'Proses', 'yow', '', '2026-02-15'),
(6, 222222, 1, '12 rpl 1', 'gaada spidol', 'Menunggu', NULL, '', '2026-02-15'),
(7, 12345678, 1, '12 rpl 4', 'kipas angin pelan harus di perbaiki', 'Selesai', 'sudh saya perbaiki', '', '2026-02-15'),
(8, 12345678, 1, '12 rpl 4', 'meja rusakk', 'Selesai', 'tunguan atuh mpruyyy', '', '2026-02-15'),
(9, 12345678, 1, '12 rpl 4', 'kursi rusak', 'Selesai', 'udah bener', '', '2026-02-15'),
(10, 12345, 1, '12 rpl 5', 'yow', 'Selesai', 'okey', '', '2026-02-15'),
(11, 12345, 1, '12 rpl 5', 'kursi kelebihan', 'Selesai', 'iya', '', '2026-02-15'),
(15, 12345, 1, '12 rpl 5', 'papan tulis rusak', 'Selesai', 'sudah diperbaiki', '', '2026-02-15'),
(17, 12345, 1, '12 rpl 5', 'lampu rusak', 'Selesai', 'sudah di perbaiki', '', '2026-02-15'),
(24, 12345, 1, '12 rpl 5', 'huyyyyyyy', 'Proses', 'ya', '', '2026-02-15'),
(44, 12, 1, '12 rpl 1', 'rusak lampu', 'Selesai', 'sudah', '', '2026-02-15'),
(45, 12, 1, '12 rpl 1', 'rusak lampu', 'Selesai', 'okeee', '', '2026-02-15'),
(50, 12, 1, '12 rpl 1', 'hfbdhbdhjfbjdbfj', 'Menunggu', '', '6991c69f5591a.jpg', '2026-02-15'),
(52, 12, 1, '12 rpl 4', 'rusak tv', 'Proses', 'fgefr', '', '2026-02-20'),
(53, 12, 1, 'gitar rusak', 'kelas', 'Menunggu', '', '69986ba952a90.jpg', '2026-02-20'),
(55, 50, 1, 'TK', 'RUSAKKKKKKKKKKKKKKKKKKKKKKKKKKKKK', 'Proses', 'y', '', '2026-02-20'),
(56, 12, 1, '12 rpl 5', 'rusak', 'Selesai', 'sudah diperbaiki', '', '2026-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Ruang Kelas'),
(2, 'Laboratorium'),
(3, 'Sarana Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `kelas`, `password`) VALUES
(12, 'lil', '', '21'),
(50, 'ABILLA CANTIK', '', '05'),
(12345, '', 'XII RPL 4', '54321'),
(123456, 'pa dian', '', '654321'),
(212121, '', 'Siswa', ''),
(222222, '', 'Siswa', ''),
(321123, '', 'Siswa', ''),
(12345678, 'yuril giparisi', 'XII RPL 4', '$2y$10$v0k.5Uo8ZbPhjaHIroKYzudNh.rfitYYXBLUk5o0Yzqsj9s06nRWC'),
(123456789, 'yuril giparisiiii', '', '987654321'),
(202107072, 'HANIF NASRULLOH', '', '123'),
(2147483647, '', 'Siswa', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `fk_admin_ke_aspirasi` (`username`);

--
-- Indexes for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_admin_ke_aspirasi` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Constraints for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `input_aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
