-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2026 at 08:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `no_hp`) VALUES
(1, 'Dr. Wulan Putri Ramadhani', 'Dokter Obgyn', '089945617834'),
(2, 'Dr. Hani feyia', 'Dokter Anestesi', '087855643219'),
(3, 'Dr. Jeman Wilson', 'Dokter Bedah', '891023648890'),
(4, 'Dr. Gavin Arlover', 'Dokter Umum', '085568943211'),
(6, 'Dr. Luke Betteryu', 'Dokter  Anak', '087654382911');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_hp`) VALUES
(1, 'Jang Wounyoung', 'Perempuan', '2004-08-31', 'Jl. Seoul cemara chinggu, No. 22, Paris', '869067474311'),
(2, 'Cherry Hawson', 'Laki-laki', '2002-09-14', 'Jl. Kenangan citra biru, No. 15, Bandung', '089598342344'),
(3, 'Na Jaemin', 'Laki-laki', '2000-08-13', 'Jl. Jeju forever high, No. 09, Busan', '862033426750'),
(4, 'Cassie Maevely', 'Perempuan', '2012-02-04', 'Jl. Nihaou family sukses , No. 42, Shanghai', '098765546790'),
(7, 'Bluey Savana', 'Perempuan', '2008-09-23', 'Jl. Bumi Cahaya Gemini, No. 10', '082366789410');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` text NOT NULL,
  `diagnosa` text NOT NULL,
  `jenis_pembayaran` varchar(20) NOT NULL DEFAULT 'Umum',
  `total_biaya` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `id_pasien`, `id_dokter`, `tanggal`, `keluhan`, `diagnosa`, `jenis_pembayaran`, `total_biaya`) VALUES
(1, 1, 1, '2025-02-05', 'Haid tidak teratur/Terlambat', 'Ketidakseimbangan Hormon', 'Umum', 300000.00),
(2, 2, 2, '2026-07-17', 'Takut terbangun atau merasa sakit saat operasi', 'Preoperative anxiety(Kecemasan pra-bedah)', 'BPJS', 0.00),
(3, 3, 3, '2016-11-29', 'Ada benjolan kemerahan di kulit saya, rasanya cenat-cenut, panas, dan makin lama ada nanahnya.', 'Karbunkel atau Abses Kulit(bisul atau kumpulan nanah akibat infeksi bakteri).', 'BPJS', 0.00),
(4, 4, 4, '2026-08-21', 'Demam, batuk kering atau berdahak, pilek, hidung tersumbat, dan sakit tenggorokan', 'ISPA (Infeksi Saluran Pernapasan Akut)', 'Umum', 600000.00),
(6, 7, 6, '2026-09-10', 'Demam yang tidak turun-turun, Gangguan Pencernaan, dan Hilangnya nafsu makan', 'Tipes', 'BPJS', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'kyupeng', '1234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `fk_pemeriksaan_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `fk_pemeriksaan_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
