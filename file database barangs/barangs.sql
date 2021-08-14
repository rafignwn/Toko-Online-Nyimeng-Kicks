-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2021 at 03:00 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko_sepatu42`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `gambar`, `harga`, `stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Sepatu Converse 70s Black Egret', 'black_egret.jpg', 800000, 12, 'Hanya tersedia ukuran 42', '2021-08-12 10:31:11', '2021-08-12 21:42:32'),
(2, 'Sepatu Converse 70s Sun Flower', 'sun_flower.jpg', 899000, 6, 'Hanya tersedia ukuran 42', '2021-08-12 10:32:25', '2021-08-13 11:13:37'),
(3, 'Sepatu Converse 70s Navy Blue', 'navy_blue.jpg', 799000, 10, 'Hanya tersedia ukuran 42', '2021-08-12 10:34:33', '2021-08-13 11:13:37'),
(4, 'Sepatu Converse 70s Cargo Army', 'green_cargo.jpg', 999000, 4, 'Hanya tersedia ukuran 42', '2021-08-12 10:34:33', '2021-08-12 21:09:15'),
(5, 'Sepatu Converse One Star OX Black/White', 'one_star.jpg', 950000, 10, 'Hanya tersedia ukuran 42, Setiap pembelian Converse One Star dapat satu parfum sepatu', '2021-08-13 01:34:06', '2021-08-13 01:36:11'),
(6, 'Sepatu Converse 70s X Dr.Wo Black Egret', 'converse_x_drwo.jpg', 1000000, 5, 'Hanya tersedia ukuran 42, Setiap pembelian Converse X Dr.Wo dapat bonus tali sepatu', '2021-08-13 01:34:06', '2021-08-13 01:36:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
