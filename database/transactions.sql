-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2020 at 04:06 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apriori`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images\\product\\no-img.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `id_transaksi`, `id_barang`, `id_user`, `nama_barang`, `status`, `img`, `created_at`, `updated_at`) VALUES
(1, '1', 5, 1, 'roti tawar', 1, 'images\\product\\no-img.png', NULL, NULL),
(2, '1', 6, 1, 'susu', 1, 'images\\product\\no-img.png', NULL, NULL),
(3, '1', 1, 1, 'oreo', 1, 'images\\product\\no-img.png', NULL, NULL),
(4, '2', 1, 1, 'oreo', 1, 'images\\product\\no-img.png', NULL, NULL),
(5, '2', 6, 1, 'susu', 1, 'images\\product\\no-img.png', NULL, NULL),
(7, '2', 3, 1, 'lays keripik kentang', 1, 'images\\product\\no-img.png', NULL, NULL),
(8, '2', 4, 1, 'coklat silver queen', 1, 'images\\product\\no-img.png', NULL, NULL),
(9, '3', 6, 1, 'susu', 1, 'images\\product\\no-img.png', NULL, NULL),
(10, '3', 1, 1, 'oreo', 1, 'images\\product\\no-img.png', NULL, NULL),
(11, '4', 3, 1, 'lays keripik kentang', 1, 'images\\product\\no-img.png', NULL, NULL),
(12, '4', 7, 1, 'coca cola', 1, 'images\\product\\no-img.png', NULL, NULL),
(15, 'HXvAgJeptaiqeYzJeafAGBc7I', 6, 1, 'susu', 1, 'images\\product\\no-img.png', '2020-08-18 11:22:39', '2020-08-18 11:29:27'),
(17, 'HXvAgJeptaiqeYzJeafAGBc7I', 5, 1, 'roti tawar', 1, 'images\\product\\no-img.png', '2020-08-18 11:29:19', '2020-08-18 11:29:27'),
(18, 'HXvAgJeptaiqeYzJeafAGBc7I', 1, 1, 'oreo', 1, 'images\\product\\no-img.png', '2020-08-18 11:29:25', '2020-08-18 11:29:27'),
(39, 'DIBLqobplPB3lHeKwlN44Ihx5', 5, 1, 'roti tawar', 1, 'images\\product\\no-img.png', '2020-08-28 14:20:26', '2020-08-28 14:38:40'),
(40, 'DIBLqobplPB3lHeKwlN44Ihx5', 1, 1, 'oreo', 1, 'images\\product\\no-img.png', '2020-08-28 14:20:37', '2020-08-28 14:38:40'),
(41, 'DIBLqobplPB3lHeKwlN44Ihx5', 6, 1, 'susu', 1, 'images\\product\\no-img.png', '2020-08-28 14:23:44', '2020-08-28 14:38:40'),
(47, 'tEKtKW825LoehFvbjvPclJRUx', 7, 1, 'coca cola', 2, 'images\\transaksi\\Annotation 2020-08-29 235429.png', '2020-09-23 07:02:33', '2020-09-23 07:05:45'),
(48, 'tEKtKW825LoehFvbjvPclJRUx', 8, 1, 'sprite', 2, 'images\\transaksi\\Annotation 2020-08-29 235429.png', '2020-09-23 07:05:20', '2020-09-23 07:05:45'),
(49, 'tEKtKW825LoehFvbjvPclJRUx', 12, 1, 'vodka', 2, 'images\\transaksi\\Annotation 2020-08-29 235429.png', '2020-09-23 07:05:29', '2020-09-23 07:05:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
