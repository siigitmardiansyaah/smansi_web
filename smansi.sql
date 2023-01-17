-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 09:36 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbabsen`
--

CREATE TABLE `tbabsen` (
  `id_absen` int(80) NOT NULL,
  `id_jadwal` int(20) NOT NULL,
  `id_qr` int(80) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `waktu_absen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbabsen`
--

INSERT INTO `tbabsen` (`id_absen`, `id_jadwal`, `id_qr`, `id_siswa`, `waktu_absen`, `keterangan`) VALUES
(51, 24, 102, 3, '2022-08-05 05:14:05', 'Hadir'),
(60, 24, 103, 3, '2023-01-15 20:12:00', 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `tbguru`
--

CREATE TABLE `tbguru` (
  `nip` int(20) NOT NULL,
  `nama_guru` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbguru`
--

INSERT INTO `tbguru` (`nip`, `nama_guru`, `password`) VALUES
(1, 'Guru Wijanarko', '098f6bcd4621d373cade4e832627b4f6');

-- --------------------------------------------------------

--
-- Table structure for table `tbjadwal`
--

CREATE TABLE `tbjadwal` (
  `id_jadwal` int(20) NOT NULL,
  `id_mapel` int(20) NOT NULL,
  `id_kelas` int(20) NOT NULL,
  `nip` int(20) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbjadwal`
--

INSERT INTO `tbjadwal` (`id_jadwal`, `id_mapel`, `id_kelas`, `nip`, `waktu`) VALUES
(24, 16, 8, 1, '2022-08-08 14:45:00'),
(25, 15, 8, 1, '2023-01-09 14:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbjadwal_siswa`
--

CREATE TABLE `tbjadwal_siswa` (
  `id_jadwalsiswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jadwal_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbjadwal_siswa`
--

INSERT INTO `tbjadwal_siswa` (`id_jadwalsiswa`, `id_siswa`, `id_jadwal_guru`) VALUES
(3, 3, 24),
(4, 4, 24),
(5, 4, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbkelas`
--

CREATE TABLE `tbkelas` (
  `id_kelas` int(20) NOT NULL,
  `nama_kelas` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbkelas`
--

INSERT INTO `tbkelas` (`id_kelas`, `nama_kelas`) VALUES
(8, 'TKJ 1'),
(9, 'TKJ 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbmapel`
--

CREATE TABLE `tbmapel` (
  `id_mapel` int(20) NOT NULL,
  `nama_mapel` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbmapel`
--

INSERT INTO `tbmapel` (`id_mapel`, `nama_mapel`) VALUES
(15, 'Pemograman Komputer'),
(16, 'Algoritma Dasar');

-- --------------------------------------------------------

--
-- Table structure for table `tbqr`
--

CREATE TABLE `tbqr` (
  `id_qr` int(80) NOT NULL,
  `nip` int(20) NOT NULL,
  `qr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbqr`
--

INSERT INTO `tbqr` (`id_qr`, `nip`, `qr`, `waktu_buat`) VALUES
(91, 1, '24-1-TKJ 1-1-1659620576', '2022-08-04 13:42:57'),
(92, 1, '24-92-TKJ 1-1-1659620656', '2022-08-04 13:44:16'),
(93, 1, '24-93-TKJ 1-1-1659620701', '2022-08-04 13:45:01'),
(94, 1, '24-94-TKJ 1-1-1659620716', '2022-08-04 13:45:16'),
(95, 1, '24-95-TKJ 1-1-1659622342-16', '2022-08-04 14:12:22'),
(96, 1, '24-96-TKJ 1-1-1659626106-16', '2022-08-04 15:15:06'),
(97, 1, '24-97-TKJ 1-1-1659626183-16', '2022-08-04 15:16:23'),
(98, 1, '24-98-TKJ 1-1-1659627372-16', '2022-08-04 15:36:12'),
(99, 1, '24-99-TKJ 1-1-1659627543-16', '2022-08-04 15:39:03'),
(100, 1, '24-100-TKJ 1-1-1659627989-16', '2022-08-04 15:46:29'),
(101, 1, '24-101-TKJ 1-1-1659628061-16', '2022-08-04 15:47:41'),
(102, 1, '24-102-TKJ 1-1-1659632511-16', '2022-12-14 02:00:00'),
(103, 1, '24-103-TKJ 1-1-1673854274-16', '2023-01-16 07:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbsiswa`
--

CREATE TABLE `tbsiswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(20) NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` int(20) NOT NULL,
  `no_wa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbsiswa`
--

INSERT INTO `tbsiswa` (`id_siswa`, `nis`, `nama`, `password`, `device_id`, `id_kelas`, `no_wa`) VALUES
(3, 1, 'Sigit Mardiansyah', '098f6bcd4621d373cade4e832627b4f6', 'd9c84cb1d7681ebb', 8, '081213925602'),
(4, 2, 'Yongki Herdiansah', '', NULL, 8, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbabsen`
--
ALTER TABLE `tbabsen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_qr` (`id_qr`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `tbguru`
--
ALTER TABLE `tbguru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbjadwal`
--
ALTER TABLE `tbjadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_matkul` (`id_mapel`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tbjadwal_siswa`
--
ALTER TABLE `tbjadwal_siswa`
  ADD PRIMARY KEY (`id_jadwalsiswa`),
  ADD KEY `fk_siswa` (`id_siswa`),
  ADD KEY `fk_jadwal` (`id_jadwal_guru`);

--
-- Indexes for table `tbkelas`
--
ALTER TABLE `tbkelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tbmapel`
--
ALTER TABLE `tbmapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tbqr`
--
ALTER TABLE `tbqr`
  ADD PRIMARY KEY (`id_qr`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `tbmahasiswa_ibfk_1` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbabsen`
--
ALTER TABLE `tbabsen`
  MODIFY `id_absen` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbjadwal`
--
ALTER TABLE `tbjadwal`
  MODIFY `id_jadwal` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbjadwal_siswa`
--
ALTER TABLE `tbjadwal_siswa`
  MODIFY `id_jadwalsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbkelas`
--
ALTER TABLE `tbkelas`
  MODIFY `id_kelas` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbmapel`
--
ALTER TABLE `tbmapel`
  MODIFY `id_mapel` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbqr`
--
ALTER TABLE `tbqr`
  MODIFY `id_qr` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbabsen`
--
ALTER TABLE `tbabsen`
  ADD CONSTRAINT `tbabsen_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `tbjadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbabsen_ibfk_2` FOREIGN KEY (`id_qr`) REFERENCES `tbqr` (`id_qr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbabsen_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `tbsiswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbjadwal`
--
ALTER TABLE `tbjadwal`
  ADD CONSTRAINT `tbjadwal_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `tbmapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbjadwal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tbkelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbjadwal_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `tbguru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbjadwal_siswa`
--
ALTER TABLE `tbjadwal_siswa`
  ADD CONSTRAINT `fk_jadwal` FOREIGN KEY (`id_jadwal_guru`) REFERENCES `tbjadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tbsiswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbqr`
--
ALTER TABLE `tbqr`
  ADD CONSTRAINT `tbqr_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tbguru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbkelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
