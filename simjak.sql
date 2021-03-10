-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2020 at 04:14 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simjak`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_lain`
--

CREATE TABLE `biaya_lain` (
  `id` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `kantor` int(20) DEFAULT NULL,
  `gaji` int(20) DEFAULT NULL,
  `bonus` int(20) DEFAULT NULL,
  `transport` int(20) DEFAULT NULL,
  `listrik` int(20) DEFAULT NULL,
  `keamanan` int(20) DEFAULT NULL,
  `kesehatan` int(20) DEFAULT NULL,
  `konsumsi` int(20) DEFAULT NULL,
  `air` int(20) DEFAULT NULL,
  `lain_lain` int(20) DEFAULT NULL,
  `biaya_lain` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biaya_lain`
--

INSERT INTO `biaya_lain` (`id`, `tahun`, `kantor`, `gaji`, `bonus`, `transport`, `listrik`, `keamanan`, `kesehatan`, `konsumsi`, `air`, `lain_lain`, `biaya_lain`) VALUES
(1, 2019, 9400000, 108000000, 1200000, 30600000, 6600000, 360000, 2400000, 18000000, 3600000, 300000, 180460000),
(48, 2020, 0, 0, 0, 0, 0, 0, 0, 0, 0, 180460000, 180460000);

-- --------------------------------------------------------

--
-- Table structure for table `laba_rugi`
--

CREATE TABLE `laba_rugi` (
  `id` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `bahan_baku` int(11) NOT NULL,
  `tktl` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `biaya_lain` int(11) NOT NULL,
  `laba_rugi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laba_rugi`
--

INSERT INTO `laba_rugi` (`id`, `tahun`, `penjualan`, `bahan_baku`, `tktl`, `hpp`, `biaya_lain`, `laba_rugi`) VALUES
(19, 2019, 1271060900, 1016848720, 1040848720, 230212180, 180460000, 49752180),
(20, 2020, 2035899300, 1628719440, 1652719440, 383179860, 180460000, 202719860);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `url`, `icon`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-home'),
(2, 'Pajak Badan', 'pajakbadan', 'fas fa-book'),
(3, 'Pajak Pribadi', 'pajakpribadi', 'fas fa-address-book'),
(4, 'Biaya Lain', 'biayalain', 'fas fa-cubes'),
(5, 'Laba Rugi', 'labarugi', 'fas fa-chart-line'),
(6, 'Neraca', 'neraca', 'fas fa-balance-scale'),
(7, 'Laporan', 'laporan', 'fas fa-file-pdf');

-- --------------------------------------------------------

--
-- Table structure for table `neraca`
--

CREATE TABLE `neraca` (
  `id` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `modal` int(11) NOT NULL,
  `laba_rugi` int(11) NOT NULL,
  `kas` int(11) NOT NULL,
  `neraca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neraca`
--

INSERT INTO `neraca` (`id`, `tahun`, `modal`, `laba_rugi`, `kas`, `neraca`) VALUES
(3, 2019, 50000000, 49752180, 99752180, 99752180),
(4, 2020, 50000000, 202719860, 252719860, 252719860);

-- --------------------------------------------------------

--
-- Table structure for table `pajak_badan`
--

CREATE TABLE `pajak_badan` (
  `id` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `bulan` varchar(9) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `pajak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pajak_badan`
--

INSERT INTO `pajak_badan` (`id`, `tahun`, `bulan`, `penjualan`, `pajak`) VALUES
(1, 2019, 'Januari', 94847250, 474236),
(2, 2019, 'Februari', 170241900, 851210),
(3, 2019, 'Maret', 200187500, 1000938),
(4, 2019, 'April', 90115900, 450580),
(5, 2019, 'Mei', 77008000, 385040),
(6, 2019, 'Juni', 19620000, 98100),
(7, 2019, 'Juli', 93418000, 467090),
(8, 2019, 'Agustus', 89493300, 447467),
(9, 2019, 'September', 104160000, 520800),
(10, 2019, 'Oktober', 122472200, 612361),
(11, 2019, 'November', 102821750, 514109),
(56, 2019, 'Desember', 106675100, 533376),
(72, 2020, 'Januari', 131821000, 659105),
(73, 2020, 'Februari', 120167000, 600835),
(74, 2020, 'Maret', 125675100, 628376),
(75, 2020, 'April', 142512000, 712560),
(76, 2020, 'Mei', 148472200, 742361),
(77, 2020, 'Juni', 164250000, 821250),
(78, 2020, 'Juli', 170540000, 852700),
(79, 2020, 'Agustus', 186215000, 931075),
(80, 2020, 'September', 191653000, 958265),
(81, 2020, 'Oktober', 208568000, 1042840),
(82, 2020, 'November', 216237000, 1081185),
(83, 2020, 'Desember', 229789000, 1148945);

-- --------------------------------------------------------

--
-- Table structure for table `pajak_pribadi`
--

CREATE TABLE `pajak_pribadi` (
  `id` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `bulan` varchar(9) NOT NULL,
  `penghasilan` int(11) NOT NULL,
  `pajak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pajak_pribadi`
--

INSERT INTO `pajak_pribadi` (`id`, `tahun`, `bulan`, `penghasilan`, `pajak`) VALUES
(1, 2019, 'Januari', 4200000, 42000),
(2, 2019, 'Februari', 4100000, 41000),
(3, 2019, 'Maret', 4100000, 41000),
(4, 2019, 'April', 4200000, 42000),
(5, 2019, 'Mei', 4300000, 43000),
(6, 2019, 'Juni', 4200000, 42000),
(7, 2019, 'Juli', 4300000, 43000),
(8, 2019, 'Agustus', 4200000, 42000),
(9, 2019, 'September', 4100000, 41000),
(10, 2019, 'Oktober', 4400000, 44000),
(11, 2019, 'November', 4200000, 42000),
(12, 2019, 'Desember', 4100000, 41000),
(26, 2020, 'September', 5278000, 52780);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(1) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'teknik', '$2y$10$Ul92.NE/ziqs1skgH5IdaOH1yhaJ0el60gf4RGhfD8vyE22Ie.qDa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_lain`
--
ALTER TABLE `biaya_lain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`);

--
-- Indexes for table `laba_rugi`
--
ALTER TABLE `laba_rugi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neraca`
--
ALTER TABLE `neraca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`);

--
-- Indexes for table `pajak_badan`
--
ALTER TABLE `pajak_badan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pajak_pribadi`
--
ALTER TABLE `pajak_pribadi`
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
-- AUTO_INCREMENT for table `biaya_lain`
--
ALTER TABLE `biaya_lain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `laba_rugi`
--
ALTER TABLE `laba_rugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `neraca`
--
ALTER TABLE `neraca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pajak_badan`
--
ALTER TABLE `pajak_badan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pajak_pribadi`
--
ALTER TABLE `pajak_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laba_rugi`
--
ALTER TABLE `laba_rugi`
  ADD CONSTRAINT `laba_rugi_ibfk_1` FOREIGN KEY (`tahun`) REFERENCES `biaya_lain` (`tahun`);

--
-- Constraints for table `neraca`
--
ALTER TABLE `neraca`
  ADD CONSTRAINT `neraca_ibfk_1` FOREIGN KEY (`tahun`) REFERENCES `laba_rugi` (`tahun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
