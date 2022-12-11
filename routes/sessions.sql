-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2022 at 12:30 PM
-- Server version: 5.7.35
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futurepl_an`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asked1` int(100) NOT NULL DEFAULT '0',
  `option2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asked2` int(100) NOT NULL DEFAULT '0',
  `option3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asked3` int(100) NOT NULL DEFAULT '0',
  `option4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `mobile`, `option1`, `asked1`, `option2`, `asked2`, `option3`, `asked3`, `option4`, `status`, `created_at`, `updated_at`) VALUES
(15, '254704800563', '1', 1, 'Y', 1, '1', 0, NULL, '1', '2022-12-09 11:13:05', '2022-12-10 19:32:36'),
(16, '254704800563', '1', 1, 'Y', 1, '1', 0, NULL, '1', '2022-12-09 11:13:58', '2022-12-10 19:32:36'),
(17, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:15:37', '2022-12-10 19:32:36'),
(18, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:17:29', '2022-12-10 19:32:36'),
(19, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:29:37', '2022-12-10 19:32:36'),
(20, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:30:18', '2022-12-10 19:32:36'),
(21, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:30:45', '2022-12-10 19:32:36'),
(22, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:34:01', '2022-12-10 19:32:36'),
(23, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:34:18', '2022-12-10 19:32:36'),
(24, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:35:44', '2022-12-10 19:32:36'),
(25, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:38:12', '2022-12-10 19:32:36'),
(26, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:39:12', '2022-12-10 19:32:36'),
(27, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 11:41:02', '2022-12-10 12:49:13'),
(28, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 11:41:14', '2022-12-10 12:49:13'),
(29, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 11:41:36', '2022-12-10 12:49:13'),
(30, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 11:41:52', '2022-12-10 12:49:13'),
(31, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 11:42:10', '2022-12-10 12:49:13'),
(32, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 11:42:25', '2022-12-10 12:49:13'),
(33, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:42:47', '2022-12-10 19:32:36'),
(34, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:43:17', '2022-12-10 19:32:36'),
(35, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:45:01', '2022-12-10 19:32:36'),
(36, '254741379431', '3', 1, '2', 1, NULL, 0, NULL, '1', '2022-12-09 11:49:28', '2022-12-09 11:50:32'),
(37, '254741379431', '3', 1, '2', 1, NULL, 0, NULL, '1', '2022-12-09 11:50:16', '2022-12-09 11:50:32'),
(38, '254741379431', NULL, 1, NULL, 0, NULL, 0, NULL, '0', '2022-12-09 11:51:13', '2022-12-09 11:51:13'),
(39, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 11:53:23', '2022-12-10 19:32:36'),
(40, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 12:00:36', '2022-12-10 19:32:36'),
(41, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 12:00:46', '2022-12-10 19:32:36'),
(42, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 12:01:48', '2022-12-10 19:32:36'),
(43, '254701557755', '3', 1, '1', 1, NULL, 0, NULL, '1', '2022-12-09 14:20:27', '2022-12-09 14:21:10'),
(44, '254701557755', '3', 1, '1', 1, NULL, 0, NULL, '1', '2022-12-09 14:20:55', '2022-12-09 14:21:10'),
(45, '254704800563', '1', 1, 'Y', 1, NULL, 0, NULL, '1', '2022-12-09 14:26:20', '2022-12-10 19:32:36'),
(46, '254745682815', '3', 1, '6885', 1, NULL, 0, NULL, '1', '2022-12-09 16:16:57', '2022-12-10 12:49:13'),
(47, '254704800563', NULL, 1, NULL, 0, NULL, 0, NULL, '1', '2022-12-09 16:30:46', '2022-12-10 19:32:36'),
(48, '254745682815', NULL, 1, NULL, 0, NULL, 0, NULL, '1', '2022-12-10 08:23:11', '2022-12-10 12:49:13'),
(49, '254701557755', NULL, 1, NULL, 0, NULL, 0, NULL, '0', '2022-12-11 07:49:33', '2022-12-11 07:49:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
