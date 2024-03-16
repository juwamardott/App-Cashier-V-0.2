-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 02:38 PM
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
-- Database: `db-toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_all_transaksi`
--

CREATE TABLE `tb_all_transaksi` (
  `id_all_transaksi` int(11) NOT NULL,
  `kode_all_transaksi` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_all_transaksi`
--

INSERT INTO `tb_all_transaksi` (`id_all_transaksi`, `kode_all_transaksi`, `nama_barang`, `harga_barang`, `qty`, `total`) VALUES
(1, 'BR13', 'L BAIK', 12000, 1, 12000),
(2, 'BR16', 'IN MILD MENTOL', 22000, 2, 44000),
(4, 'BRS01', 'BERAS C4 5kg', 68000, 1, 68000),
(5, 'DRF02', 'DRAF DUS', 325000, 1, 325000),
(6, 'MLB03', 'MALHBORO PUTIH', 32000, 1, 32000),
(7, 'IN02', 'IN MILD MENTOL', 22000, 1, 22000),
(8, 'CC01', 'COCA COLA TANGGUNG', 6000, 2, 12000),
(9, 'SPT02', 'SPRITE BESAR', 11000, 1, 11000),
(10, 'SR01', 'SURYA 12', 25000, 1, 25000),
(11, 'TLR01', 'TELUR', 2000, 5, 10000),
(12, 'DJS01', 'DJI SAMSOE REFIL', 21000, 1, 21000),
(13, 'LB01', 'L BAIK', 12000, 2, 24000),
(14, 'MIE02', 'MIE INDOMIE GORENG', 3500, 4, 14000),
(15, 'MIE01', 'MIE SEDAP GORENG', 3500, 2, 7000),
(16, 'FLR01', 'FLORIDINA', 4000, 1, 4000),
(17, 'RS01', 'RINSO DAIA BESAR', 5000, 1, 5000),
(18, 'TLR01', 'TELUR', 2000, 2, 4000),
(19, 'MIE03', 'MIE INDOMIE KUAH', 3500, 1, 3500),
(20, 'BRS04', 'BERAS OSING 10Kg', 130000, 1, 130000),
(21, 'DRF01', 'DRAF ECER', 30000, 5, 150000),
(22, 'MIE03', 'MIE INDOMIE KUAH', 3500, 5, 17500),
(23, 'DJS01', 'DJI SAMSOE REFIL', 21000, 1, 21000),
(24, 'AR01', 'ARAK 25', 25000, 1, 25000),
(25, 'AR02', 'ARAK 30', 30000, 2, 60000),
(26, 'AR03', 'ARAK MOJITO', 25000, 1, 25000),
(27, 'KP03', 'KOPI WARKOP BESAR', 20000, 2, 40000),
(28, 'FLR01', 'FLORIDINA', 4000, 1, 4000),
(29, 'SR02', 'SURYA 16', 36000, 2, 72000),
(30, 'SMP01', 'SAMPOERNA MILD', 32000, 1, 32000),
(31, 'MLB02', 'MALHBORO MENTOL', 32000, 1, 32000),
(32, 'IN01', 'IN MILD', 22000, 7, 154000),
(33, 'IN01', 'IN MILD', 22000, 1, 22000),
(34, 'IN02', 'IN MILD MENTOL', 22000, 1, 22000),
(35, 'PR01', 'PERMEN', 1000, 3, 3000),
(36, 'CC01', 'COCA COLA TANGGUNG', 6000, 1, 6000),
(37, 'FLR01', 'FLORIDINA', 4000, 2, 8000),
(38, 'ULT01', 'ULTRA', 21000, 1, 21000),
(39, 'IN01', 'IN MILD', 22000, 2, 44000),
(40, 'SR01', 'SURYA 12', 25000, 1, 25000),
(41, 'DRF02', 'DRAF DUS', 325000, 5, 1625000),
(42, 'IN01', 'IN MILD', 22000, 5, 110000),
(43, 'LB01', 'L BAIK', 12000, 2, 24000),
(44, 'MLB01', 'MALHBORO MERAH', 32000, 2, 64000),
(45, 'DRF02', 'DRAF DUS', 325000, 5, 1625000),
(46, 'IN01', 'IN MILD', 22000, 5, 110000),
(47, 'LB01', 'L BAIK', 12000, 2, 24000),
(48, 'MLB01', 'MALHBORO MERAH', 32000, 2, 64000),
(49, 'CC02', 'COCA COLA BESAR', 11000, 2, 22000),
(50, 'SPT02', 'SPRITE BESAR', 11000, 2, 22000),
(51, 'MLB02', 'MALHBORO MENTOL', 32000, 1, 32000),
(52, 'DRF01', 'DRAF ECER', 30000, 2, 60000),
(53, 'SR01', 'SURYA 12', 25000, 1, 25000),
(54, 'LB01', 'L BAIK', 12000, 1, 12000),
(55, 'SR01', 'SURYA 12', 25000, 1, 25000),
(56, 'LB01', 'L BAIK', 12000, 1, 12000),
(57, 'SR01', 'SURYA 12', 25000, 1, 25000),
(58, 'LB01', 'L BAIK', 12000, 1, 12000),
(59, 'SR01', 'SURYA 12', 25000, 1, 25000),
(60, 'LB01', 'L BAIK', 12000, 1, 12000),
(61, 'ULT01', 'ULTRA', 21000, 1, 21000),
(62, 'LB01', 'L BAIK', 12000, 1, 12000),
(63, 'DRF01', 'DRAF ECER', 30000, 2, 60000),
(64, 'DRF02', 'DRAF DUS', 325000, 2, 650000),
(65, 'ULT01', 'ULTRA', 21000, 1, 21000),
(66, 'MLB02', 'MALHBORO MENTOL', 32000, 1, 32000),
(67, 'DRF01', 'DRAF ECER', 30000, 3, 90000),
(68, 'KC02', 'KACANG GARUDA', 5000, 3, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(250) NOT NULL,
  `stock_barang` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga_barang`, `stock_barang`) VALUES
(50, 'IN01', 'IN MILD', 22000, 20),
(51, 'IN02', 'IN MILD MENTOL', 22000, 18),
(52, 'MLB01', 'MALHBORO MERAH', 32000, 16),
(53, 'MLB02', 'MALHBORO MENTOL', 32000, 17),
(54, 'MLB03', 'MALHBORO PUTIH', 32000, 19),
(55, 'ULT01', 'ULTRA', 21000, 17),
(56, 'LB01', 'L BAIK', 12000, 9),
(57, 'SMP01', 'SAMPOERNA MILD', 32000, 19),
(58, 'SR01', 'SURYA 12', 25000, 14),
(59, 'SR02', 'SURYA 16', 36000, 18),
(60, 'DRF01', 'DRAF ECER', 30000, 88),
(61, 'DRF02', 'DRAF DUS', 325000, 7),
(62, 'CC01', 'COCA COLA TANGGUNG', 6000, 7),
(63, 'CC02', 'COCA COLA BESAR', 11000, 18),
(64, 'SPT01', 'SPRITE TANGGUNG', 6000, 20),
(65, 'SPT02', 'SPRITE BESAR', 11000, 17),
(66, 'FLR01', 'FLORIDINA', 4000, 16),
(67, 'AR01', 'ARAK 25', 25000, 49),
(68, 'AR02', 'ARAK 30', 30000, 48),
(69, 'AR03', 'ARAK MOJITO', 25000, 19),
(70, 'KP01', 'KOPI WARKOP KECIL', 5000, 20),
(71, 'KP02', 'KOPI WARKOP SEDANG', 14000, 20),
(72, 'KP03', 'KOPI WARKOP BESAR', 20000, 18),
(73, 'TLR01', 'TELUR', 2000, 33),
(74, 'BRS01', 'BERAS C4 5kg', 68000, 19),
(75, 'BRS02', 'BERAS C4 10Kg', 120000, 20),
(76, 'BRS03', 'BERAS OSING 5kg', 72000, 20),
(77, 'BRS04', 'BERAS OSING 10Kg', 130000, 19),
(78, 'UC01', 'UC', 11000, 20),
(79, 'DJS01', 'DJI SAMSOE REFIL', 21000, 18),
(80, 'MIE01', 'MIE SEDAP GORENG', 3500, 28),
(81, 'MIE02', 'MIE INDOMIE GORENG', 3500, 16),
(82, 'MIE03', 'MIE INDOMIE KUAH', 3500, 10),
(83, 'GL01', 'GALON ISI ULANG', 7000, 10),
(84, 'GL02', 'GALON AQUA', 19000, 10),
(85, 'AL01', 'ALE-ALE', 1000, 10),
(86, 'KC01', 'KACANG MACAN', 2000, 20),
(87, 'KC02', 'KACANG GARUDA', 5000, 7),
(88, 'RS01', 'RINSO DAIA BESAR', 5000, 9),
(89, 'RS02', 'RINSO DAIA KECIL', 2000, 20),
(90, 'RS03', 'RINSO VANISH SACHET', 2000, 20),
(91, 'DS01', 'DESIS', 22000, 10),
(92, 'PAS01', 'PASPOR 25CM', 5000, 20),
(93, 'PAS02', 'PASPOR 30CM', 7000, 10),
(94, 'PR01', 'PERMEN', 1000, 997),
(95, 'MS01', 'MASAK0', 1000, 20),
(96, 'TM01', 'TEMULAWAK', 6000, 10),
(97, 'AQ01', 'AQUA Besar', 5000, 20),
(98, 'AQ02', 'AQUA tanggung', 3000, 10),
(99, 'SHP01', 'SHAMPO PHANTENE', 1000, 20),
(100, 'SHP02', 'SHAMPO SUNSHILK', 1000, 20),
(101, 'MYK01', 'MINYAK GORENG SANIA', 19000, 20),
(102, 'MYK02', 'MINYAK GORENG SABRINA', 170000, 10),
(103, 'SNK01', 'WALUT', 1000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`) VALUES
(7, 'oke', '$2y$10$CEBSNWy2fRkMNOzfy0mTU.7AZPKJ9nAAYMN7WaA9A1PzUIQ4aW3PO'),
(8, 'admin', '$2y$10$8ibT0svGrvZw.yIRHLZpA.aonLpXdNY1FHP8aybehLTg0IrL38e4S'),
(9, 'mardood', '$2y$10$hYJxYHDEWf8BIw1l2Oxo7O5rxyM6pxbFAbFDuvd1CVp6OGmRVy96O'),
(10, 'kadek', '$2y$10$64Oc.8ZtbYgI5R948xbYye9x5smRpFXjMl4SIhGK5W5TAUMvBj4jC'),
(11, 'ok', '$2y$10$aWm1AxotwQwtVMLmBiqkWeW3SVY7UkkosQzJaAnBGNGxdH0.qtODS'),
(12, 'o', '$2y$10$NLb4jVhZkfogrBEWSAbti.lxNxsopNGsqKbO967TucIUz87SAAqjK'),
(13, 'w', '$2y$10$9LCXSc8CQr/A56us14Mqqui/F2ydZG33TMK4K1H7h3bwtOxRWsxgu'),
(14, 'juwamardott@gmail.com', '$2y$10$Cijp8obMEvLURIzjGN6GmecRIvQfaKcEQn3LL173H0xwk0OcaT6fa'),
(15, 'arihandayani@gmai.com', '$2y$10$4H2u2jS4um3f6qSkybpp..Poqw83j1j6JoVUxDwKc5YtZ3prsCszu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_all_transaksi`
--
ALTER TABLE `tb_all_transaksi`
  ADD PRIMARY KEY (`id_all_transaksi`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_all_transaksi`
--
ALTER TABLE `tb_all_transaksi`
  MODIFY `id_all_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
