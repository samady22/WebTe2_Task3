-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 12:18 PM
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
-- Database: `sam`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `lon` decimal(10,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `ip`, `country_name`, `country_code`, `flag`, `city`, `lat`, `lon`, `created_at`, `updated_at`) VALUES
(2, '147.175.250.129', 'Afg', '93', NULL, 'mazar', 36.000000, 67.000000, '2023-05-03 13:44:56', '2023-05-03 21:59:23'),
(4, '125.175.163.245', 'Germany', '420', NULL, 'Berlin', 37.000000, 40.000000, '2023-05-04 08:51:21', '2023-05-04 08:51:21'),
(6, '147.175.250.129', 'Afg', '93', NULL, 'mazar', 36.000000, 67.000000, '2023-05-04 07:15:18', '2023-05-04 08:14:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
