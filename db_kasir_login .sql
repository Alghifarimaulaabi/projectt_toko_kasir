-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 03:07 AM
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
-- Database: `db_kasir_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `produk_id`, `nama_produk`, `harga`, `jumlah`, `subtotal`) VALUES
(1, 1, 2, 'HP', 1500000.00, 3, 4500000.00),
(2, 1, 3, 'PC', 15000000.00, 2, 30000000.00),
(3, 1, 4, 'sate', 50000.00, 3, 150000.00),
(4, 2, 6, 'casan', 600000.00, 1, 600000.00),
(5, 2, 2, 'HP', 1500000.00, 1, 1500000.00),
(6, 2, 3, 'PC', 15000000.00, 1, 15000000.00),
(8, 4, 11, 'HP', 25000000.00, 3, 75000000.00),
(9, 4, 9, 'PC RTX 3060', 59999000.00, 1, 59999000.00),
(10, 5, 11, 'HP', 25000000.00, 1, 25000000.00),
(11, 5, 12, 'Keyboard', 5499000.00, 2, 10998000.00),
(12, 5, 9, 'PC RTX 3060', 59999000.00, 1, 59999000.00),
(13, 6, 11, 'HP', 25000000.00, 2, 50000000.00),
(15, 8, 14, 'casan', 300000.00, 2, 600000.00),
(16, 9, 18, 'Iphonee', 23000000.00, 2, 46000000.00),
(17, 9, 17, 'PC', 11000000.00, 1, 11000000.00),
(18, 10, 22, 'iphone 17 pro max', 35000000.00, 2, 70000000.00),
(19, 10, 21, 'PC', 12999000.00, 1, 12999000.00),
(20, 11, 21, 'PC', 12999000.00, 1, 12999000.00),
(21, 12, 19, 'ayam goreng', 160000.00, 1, 160000.00),
(22, 13, 20, 'Es Jeruk', 700000.00, 1, 700000.00),
(23, 14, 24, 'iphone 17 pro max', 7000000.00, 2, 14000000.00),
(24, 14, 23, 'PC', 12998000.00, 1, 12998000.00),
(25, 15, 25, 'ayam goreng', 15000.00, 2, 30000.00),
(26, 15, 26, 'es jeruk', 59000.00, 2, 118000.00);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `uang_bayar` decimal(15,2) NOT NULL,
  `kembalian` decimal(15,2) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal`, `total`, `uang_bayar`, `kembalian`, `user_email`) VALUES
(1, '2026-04-13 18:00:43', 34650000.00, 35000000.00, 350000.00, 'gelas@gmail.com'),
(2, '2026-04-14 16:37:40', 17100000.00, 18000000.00, 900000.00, 'gelas@gmail.com'),
(3, '2026-04-16 12:36:44', 3000000.00, 10000000.00, 7000000.00, 'budi@gmail.com'),
(4, '2026-04-17 15:25:50', 134999000.00, 134999000.00, 0.00, 'gelas@gmail.com'),
(5, '2026-04-17 15:39:19', 95997000.00, 100000000.00, 4003000.00, 'gelas@gmail.com'),
(6, '2026-04-17 17:31:31', 50000000.00, 60000000.00, 10000000.00, 'gelas@gmail.com'),
(7, '2026-04-18 10:16:50', 3000000.00, 4000000.00, 1000000.00, 'budi@gmail.com'),
(8, '2026-04-18 14:48:08', 600000.00, 649999.00, 49999.00, 'gelas@gmail.com'),
(9, '2026-04-19 12:24:52', 57000000.00, 57000000.00, 0.00, 'aliza@gmail.com'),
(10, '2026-04-19 12:51:41', 82999000.00, 82999999.00, 999.00, 'layla@gmail.com'),
(11, '2026-04-19 12:53:51', 12999000.00, 120000000.00, 107001000.00, 'layla@gmail.com'),
(12, '2026-04-19 12:55:31', 160000.00, 200000.00, 40000.00, 'budi@gmail.com'),
(13, '2026-04-19 13:05:27', 700000.00, 750000.00, 50000.00, 'budi@gmail.com'),
(14, '2026-04-19 13:40:43', 26998000.00, 27000000.00, 2000.00, 'maula@gmail.com'),
(15, '2026-04-19 13:47:09', 148000.00, 148000.00, 0.00, 'ayam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `harga_modal` decimal(15,2) NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `jumlah_stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori`, `nama_barang`, `foto`, `harga_modal`, `harga_jual`, `jumlah_stock`, `created_at`, `user_email`) VALUES
(2, 'Elektronik', 'HP', '1775989404_ALIZALOGO.jpg', 1000000.00, 1500000.00, 1, '2026-04-12 10:23:24', NULL),
(3, 'Elektronik', 'PC', '1775993075_nradit99.jpeg', 10000000.00, 15000000.00, 5, '2026-04-12 11:24:36', NULL),
(4, 'Makanan', 'sate', '1775993132_Fundodeescritriodesfocadoescritriodesfocadoparafundodeapresentao_image.jpeg', 50000.00, 50000.00, 7, '2026-04-12 11:25:32', NULL),
(6, 'Elektronik', 'casan', '1776143224_339288663_699795258812421_6202978252455366487_n.jpg', 500000.00, 600000.00, 4, '2026-04-14 05:07:04', NULL),
(9, 'Elektronik', 'PC RTX 3060', '1776177440_nradit99.jpeg', 50000000.00, 59999000.00, 1, '2026-04-14 14:37:20', 'gelas@gmail.com'),
(11, 'Elektronik', 'HP', '1776344563_AppleiPhone17ProbrichtmitaltenGewohnheiten_IstdasdasiPhoneaufdasallegewartethaben_.jpeg', 20000000.00, 25000000.00, 6, '2026-04-16 13:02:43', 'gelas@gmail.com'),
(12, 'Elektronik', 'Keyboard', '1776344630_RedragonKumaraK552-RGBLEDBacklitUSBMechanicalGamingKeyboardWithoutNumlockKeysBla___.jpeg', 5000000.00, 5499000.00, 3, '2026-04-16 13:03:50', 'gelas@gmail.com'),
(14, 'Elektronik', 'casan', '1776498455_Desaintanpajudul.png', 200000.00, 300000.00, 3, '2026-04-18 07:47:35', 'gelas@gmail.com'),
(16, 'Elektronik', 'PC', '1776507948_nradit99.jpeg', 20000000.00, 24999000.00, 5, '2026-04-18 10:25:49', 'rafa@gmail.com'),
(17, 'Elektronik', 'PC', '1776576081_nradit99.jpeg', 10000000.00, 11000000.00, 9, '2026-04-19 05:21:21', 'aliza@gmail.com'),
(18, 'Elektronik', 'Iphonee', '1776576182_AppleiPhone17ProbrichtmitaltenGewohnheiten_IstdasdasiPhoneaufdasallegewartethaben_.jpeg', 22000000.00, 23000000.00, 8, '2026-04-19 05:22:19', 'aliza@gmail.com'),
(19, 'Makanan', 'ayam goreng', '1776576832_SavoryFriedChickenWithFreshVegetablesAndChiliSauceChickenFriedFoodPNGTransparentClipartImageandPSDFileforFreeDownload.jpeg', 150000.00, 160000.00, 99, '2026-04-19 05:33:52', 'budi@gmail.com'),
(20, 'Minuman', 'Es Jeruk', '1776576856_FreshlySqueezedOrangeJuice.jpeg', 500000.00, 700000.00, 99, '2026-04-19 05:34:16', 'budi@gmail.com'),
(21, 'Elektronik', 'PC', '1776577727_nradit99.jpeg', 12000000.00, 12999000.00, 8, '2026-04-19 05:48:47', 'layla@gmail.com'),
(22, 'Elektronik', 'iphone 17 pro max', '1776577822_AppleiPhone17ProMax1TBUnlockedRenewed.jpeg', 30000000.00, 35000000.00, 13, '2026-04-19 05:49:39', 'layla@gmail.com'),
(23, 'Elektronik', 'PC', '1776580666_nradit99.jpeg', 12000000.00, 12998000.00, 9, '2026-04-19 06:37:46', 'maula@gmail.com'),
(24, 'Elektronik', 'iphone 17 pro max', '1776580752_AppleiPhone17ProbrichtmitaltenGewohnheiten_IstdasdasiPhoneaufdasallegewartethaben_.jpeg', 6000000.00, 7000000.00, 98, '2026-04-19 06:38:32', 'maula@gmail.com'),
(25, 'Makanan', 'ayam goreng', '1776581168_SavoryFriedChickenWithFreshVegetablesAndChiliSauceChickenFriedFoodPNGTransparentClipartImageandPSDFileforFreeDownload.jpeg', 15000.00, 15000.00, 98, '2026-04-19 06:46:08', 'ayam@gmail.com'),
(26, 'Minuman', 'es jeruk', '1776581202_FreshlySqueezedOrangeJuice.jpeg', 50000.00, 59000.00, 3, '2026-04-19 06:46:42', 'ayam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `toko` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `toko`, `email`) VALUES
(1, 'Alghifari', '$2y$10$cxKl/9PnVw.Y0Z503J4vc.TwAw73CKYFBc2WDI3xPxIcF2w4bovhC', NULL, NULL, NULL),
(2, 'maula', '$2y$10$x.toEEsHYbz5Hma4xzVEU.jGnuMwZGhLx3eT8ub/oV5vZU2eT8oyS', NULL, NULL, NULL),
(3, 'abi', '$2y$10$Zm3Y5Z0ueU6ex6ypw6Q4Fe.sNCAO2qYQf0VTBOk8OcaA2l1S.xsIS', NULL, NULL, NULL),
(4, 'dilkimulyana', '$2y$10$c0lrguqr205OJxR4HIjzue5qQNQpeNrxMjPhpQgzvT9F5uAzp31Oy', NULL, NULL, NULL),
(5, 'yeybfwebf@gmail.com', '$2y$10$IdHhnW4SmfUZKnLHrYB/y.SC8kIqgAOvJ5X39py30.a2JYBzQtVZi', NULL, NULL, NULL),
(6, 'ghifari maula', '$2y$10$kKshPiczQ07/O9SbcTEssOl42bT3ydPMmJ6/sAA/6JasVowREzv96', NULL, 'Toko Aliza', 'ghifar@gmail.com'),
(7, NULL, '$2y$10$r6NU/tGOlmBQsoJ0BJIBquKplM2cR1XHiABGf9FJNW9JCdkBFYYTK', 'maulaabi', 'setrika', 'ilhamjuliandirefan@gmail.com'),
(8, NULL, '$2y$10$5PGswwAt2PewRFFJJrjVa.DP6HXT6B6VAVksdIMKLzyBFPAWUAlPm', 'karpet', 'karpettt', 'aaa@gmail.com'),
(9, NULL, '$2y$10$G.QFA9NlMaiWHL9BXCiqt.d/6NO/PqHLknqzFi1Kxw7V6lKZR9Cii', 'maulaabi', 'gelas', 'gelas@gmail.com'),
(10, NULL, '$2y$10$vP0HFNwrQrYfVzVsymmM0e.1tiXBZnhUBTqC5M6Z1LPESJCZ1FA/q', 'alghifari maula', 'ytta', 'ytta@gmail.com'),
(11, NULL, '$2y$10$x4dEyyN0deUsM58ZlDk8RuS3xu6ImtAggaDvjR4S0Nlpl6NewzVPK', 'lupa', 'lupa', 'lupa@gmail.com'),
(12, NULL, '$2y$10$Wz8a.FPqIleFGM8v6nzvQONHgmnz7zltvI2z.MaDxVD59Nt3nxdf6', 'budi', 'MBG', 'budi@gmail.com'),
(13, NULL, '$2y$10$zxXe8FtHjd.Qj1Jla/G1X.Vcqq8I4MqN57thEfLwuMVvX2NsiaEKe', 'alghifari', 'aliza', 'alghifari@gmail.com'),
(14, NULL, '$2y$10$DcU/.B/nz4CuKPeiFnw5qOO7rMaj5QIIwH4lWp/tBqnpVIQ8jwChG', 'rafa', 'Aliza', 'rafa@gmail.com'),
(15, NULL, '$2y$10$qrXlN.3y5QGKEWhD8b7uK.KaZ0dAHiY9rBeFE.LxZeWK/0df0n6uK', 'ghifari', 'aliza', 'aliza@gmail.com'),
(16, NULL, '$2y$10$/mj2rUf.yHrZBy7nHF3ScunGMlJqPNYG54jJ2sYZQNpDHiqdFKLVu', 'layla', 'layla', 'layla@gmail.com'),
(17, NULL, '$2y$10$MQBK7sfFORQsE9Xu3zsSwOkbJTEpM/OdLTXgeNuaukMqgiSF5LWzW', 'maula', 'elektronik', 'maula@gmail.com'),
(18, NULL, '$2y$10$iICrc6Ah7DGW7whlWhh8n.tnkzOV3gj5s4vu.nWMAlXsKk39rzCLa', 'ayam', 'makanan', 'ayam@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
