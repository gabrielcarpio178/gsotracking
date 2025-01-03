-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 05:48 PM
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
-- Database: `qrinfomecha`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `eq_unicode` varchar(11) NOT NULL,
  `equipment` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `date_stored` datetime NOT NULL,
  `category` varchar(50) NOT NULL,
  `specs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specs`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `eq_unicode`, `equipment`, `quantity`, `price`, `date_stored`, `category`, `specs`) VALUES
(1, 'EQ0001', 'Laptop', 10, 1000, '2023-01-15 00:00:00', 'Office', '{\"processor\": \"Intel i7\", \"ram\": \"16GB\", \"storage\": \"512GB SSD\", \"screen_size\": \"15.6 inches\"}'),
(2, 'EQ0002', 'Desktop Computer', 19, 800, '2022-08-10 00:00:00', 'Office', '{\"processor\": \"Intel i5\", \"ram\": \"8GB\", \"storage\": \"1TB HDD\", \"monitor\": \"24 inches\"}'),
(3, 'EQ0003', 'Printer', 11, 300, '2021-11-20 00:00:00', 'Office', '{\"type\": \"Laser\", \"color\": \"Black and White\", \"connectivity\": \"Wi-Fi, USB\"}'),
(4, 'EQ0004', 'Projector', 1, 500, '2020-05-05 00:00:00', 'Electronics', '{\"resolution\": \"1080p\", \"brightness\": \"3000 lumens\", \"type\": \"DLP\"}'),
(5, 'EQ0005', 'Scanner', 30, 200, '2022-03-18 00:00:00', 'Office', '{\"type\": \"Flatbed\", \"resolution\": \"1200 dpi\", \"color_depth\": \"48-bit\"}'),
(6, 'EQ0006', 'Smartphone', 45, 600, '2023-02-12 00:00:00', 'Electronics', '{\"processor\": \"Snapdragon 888\", \"ram\": \"8GB\", \"storage\": \"128GB\", \"screen_size\": \"6.5 inches\"}'),
(7, 'EQ0007', 'Tablet', 89, 450, '2021-09-29 00:00:00', 'Electronics', '{\"processor\": \"Apple A14 Bionic\", \"ram\": \"4GB\", \"storage\": \"64GB\", \"screen_size\": \"10.2 inches\"}'),
(8, 'EQ0008', 'Router', 40, 150, '2021-07-14 00:00:00', 'IT', '{\"speed\": \"1200 Mbps\", \"frequency\": \"Dual-band\", \"ports\": \"4 Ethernet\"}'),
(9, 'EQ0009', 'Server', 10, 5000, '2019-12-30 00:00:00', 'IT', '{\"processor\": \"Xeon E5\", \"ram\": \"64GB\", \"storage\": \"4TB RAID\", \"rackmount\": \"Yes\"}'),
(10, 'EQ0010', 'Photocopier', 30, 1000, '2022-06-21 00:00:00', 'Office', '{\"type\": \"Multifunction\", \"speed\": \"30 ppm\", \"color\": \"Color\"}'),
(11, 'EQ0011', 'Bulldozer', 50, 150000, '2020-04-17 00:00:00', 'Construction', '{\"engine\": \"Caterpillar C9\", \"horsepower\": \"250 HP\", \"weight\": \"25 tons\"}'),
(12, 'EQ0012', 'Excavator', 6, 120000, '2021-11-11 00:00:00', 'Construction', '{\"bucket_capacity\": \"1.5 cubic meters\", \"dig_depth\": \"5 meters\", \"weight\": \"20 tons\"}'),
(13, 'EQ0013', 'Cement Mixer', 5, 8000, '2022-01-05 00:00:00', 'Construction', '{\"capacity\": \"400 liters\", \"type\": \"Drum\", \"engine\": \"Diesel\"}'),
(14, 'EQ0014', 'Drill Machine', 8, 2500, '2020-07-09 00:00:00', 'Construction', '{\"power\": \"1.5 kW\", \"speed\": \"500 RPM\", \"type\": \"Pneumatic\"}'),
(15, 'EQ0015', 'Crane', 4, 200000, '2019-08-23 00:00:00', 'Construction', '{\"capacity\": \"10 tons\", \"height\": \"20 meters\", \"type\": \"Tower Crane\"}'),
(16, 'EQ0016', 'Dump Truck', 6, 90000, '2021-05-15 00:00:00', 'Construction', '{\"capacity\": \"20 cubic meters\", \"engine\": \"Cummins\", \"weight\": \"30 tons\"}'),
(17, 'EQ0017', 'Concrete Pump', 8, 70000, '2022-03-28 00:00:00', 'Construction', '{\"output\": \"80 cubic meters/hour\", \"type\": \"Truck-mounted\", \"reach\": \"30 meters\"}'),
(18, 'EQ0018', 'Grader', 6, 95000, '2020-10-22 00:00:00', 'Construction', '{\"blade_length\": \"4 meters\", \"engine\": \"Volvo\", \"weight\": \"25 tons\"}'),
(19, 'EQ0019', 'Loader', 5, 105000, '2021-12-03 00:00:00', 'Construction', '{\"bucket_capacity\": \"2.5 cubic meters\", \"engine\": \"John Deere\", \"weight\": \"15 tons\"}'),
(20, 'EQ0020', 'Compactor', 5, 60000, '2022-08-17 00:00:00', 'Construction', '{\"type\": \"Vibratory\", \"weight\": \"10 tons\", \"frequency\": \"60 Hz\"}'),
(21, 'EQ0021', 'Scanner', 42, 121, '2024-08-25 00:00:00', 'Office', '{\"type\": \"Sheet-fed\", \"resolution\": \"600 dpi\", \"speed\": \"25 ppm\"}'),
(24, 'EQ0024', 'Ipad', 55, 9999, '2024-08-25 00:00:00', 'IT', '{\"processor\": \"A15 Bionic\", \"ram\": \"8GB\", \"storage\": \"256GB\", \"screen_size\": \"10.9 inches\"}'),
(25, '', 'tuak chu', 11, 150, '2024-09-09 00:00:00', 'office', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_history`
--

CREATE TABLE `equipment_history` (
  `id` int(11) NOT NULL,
  `equiment_id` int(11) NOT NULL,
  `usercode` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `isDisabled` varchar(100) NOT NULL DEFAULT 'working',
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_history`
--

INSERT INTO `equipment_history` (`id`, `equiment_id`, `usercode`, `action`, `isDisabled`, `transaction_date`) VALUES
(1, 21, 202400018, 'Purchase Equipment', 'working', '2024-12-20 23:55:51'),
(2, 21, 202400002, 'Transfer Equipment', 'working', '2024-12-20 23:58:55'),
(4, 16, 202400018, 'Purchase Equipment', 'working', '2024-12-21 00:04:49'),
(5, 17, 202400018, 'Purchase Equipment', 'working', '2024-12-21 00:04:50'),
(6, 16, 202400018, 'Transfer Equipment', 'working', '2024-12-21 13:25:57'),
(7, 21, 202400018, 'Transfer Equipment', 'working', '2024-12-21 13:25:57'),
(8, 16, 202400002, 'Transfer Equipment', 'working', '2024-12-21 13:29:19'),
(9, 21, 202400002, 'Transfer Equipment', 'working', '2024-12-21 13:29:19'),
(10, 16, 202400018, 'Transfer Equipment', 'working', '2024-12-21 13:30:08'),
(11, 21, 202400018, 'Transfer Equipment', 'working', '2024-12-21 13:30:08'),
(12, 19, 202400018, 'Purchase Equipment', 'working', '2024-12-21 13:30:27'),
(13, 14, 202400018, 'Purchase Equipment', 'working', '2024-12-21 13:33:05'),
(14, 15, 202400018, 'Purchase Equipment', 'working', '2024-12-21 13:33:05'),
(15, 19, 202400018, 'Maintenance', 'working', '2024-12-21 13:41:33'),
(16, 14, 202400018, 'Maintenance', 'working', '2024-12-21 14:14:19'),
(17, 15, 202400002, 'Transfer Equipment', 'working', '2024-12-21 14:23:16'),
(18, 16, 202400002, 'Transfer Equipment', 'need maintenance', '2024-12-21 14:23:16'),
(19, 21, 202400002, 'Transfer Equipment', 'disabled', '2024-12-21 14:23:16'),
(20, 20, 202400018, 'Purchase Equipment', 'working', '2024-12-21 14:28:03'),
(21, 18, 202400018, 'Purchase Equipment', 'working', '2024-12-21 14:29:05'),
(22, 12, 202400018, 'Purchase Equipment', 'working', '2024-12-21 14:29:36'),
(23, 13, 202400018, 'Purchase Equipment', 'working', '2024-12-21 14:29:36'),
(25, 22, 202400018, 'Purchase Equipment', 'working', '2024-12-21 14:44:54'),
(27, 11, 202400018, 'Purchase Equipment', 'working', '2024-12-21 20:48:00'),
(32, 6, 202400018, 'Purchase Equipment', 'working', '2024-12-21 20:56:29'),
(33, 7, 202400018, 'Purchase Equipment', 'working', '2024-12-21 20:56:29'),
(34, 12, 202400018, 'Purchase Equipment', 'working', '2024-12-21 21:55:15'),
(35, 13, 202400018, 'Purchase Equipment', 'working', '2024-12-21 21:55:16'),
(36, 10, 202400018, 'Purchase Equipment', 'working', '2024-12-21 21:57:59'),
(37, 11, 202400018, 'Purchase Equipment', 'working', '2024-12-21 21:57:59'),
(38, 8, 202400018, 'Purchase Equipment', 'working', '2024-12-21 22:01:06'),
(39, 9, 202400018, 'Purchase Equipment', 'working', '2024-12-21 22:01:06'),
(40, 23, 123456789, 'Purchase Equipment', 'working', '2024-12-21 17:58:59'),
(41, 23, 123456789, 'Maintenance', 'working', '2024-12-21 18:02:01'),
(42, 24, 123456789, 'Purchase Equipment', 'working', '2024-12-21 18:12:46'),
(43, 17, 123456789, 'Transfer Equipment', 'working', '2024-12-21 18:41:29'),
(44, 18, 123456789, 'Transfer Equipment', 'working', '2024-12-21 18:41:29'),
(45, 17, 202400019, 'Transfer Equipment', 'working', '2024-12-21 19:02:33'),
(46, 18, 202400019, 'Transfer Equipment', 'working', '2024-12-21 19:02:33'),
(47, 23, 202400019, 'Transfer Equipment', 'working', '2024-12-21 19:02:33'),
(48, 24, 202400019, 'Transfer Equipment', 'working', '2024-12-21 19:02:33'),
(49, 17, 200211646, 'Transfer Equipment', 'working', '2024-12-21 19:07:11'),
(50, 18, 200211646, 'Transfer Equipment', 'working', '2024-12-21 19:07:11'),
(51, 23, 200211646, 'Transfer Equipment', 'working', '2024-12-21 19:07:11'),
(52, 24, 200211646, 'Transfer Equipment', 'working', '2024-12-21 19:07:11'),
(53, 25, 200211646, 'Purchase Equipment', 'working', '2024-12-22 03:34:54'),
(54, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 03:43:27'),
(55, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 03:50:42'),
(56, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 03:50:43'),
(57, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 03:50:44'),
(58, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 03:50:45'),
(59, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 03:52:08'),
(60, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 03:52:30'),
(61, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 03:54:06'),
(62, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 03:54:59'),
(63, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 04:01:34'),
(64, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 04:06:52'),
(65, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 04:07:55'),
(66, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 04:10:19'),
(67, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 04:11:48'),
(68, 25, 200211646, 'Transfer Equipment', 'working', '2024-12-22 04:13:15'),
(69, 25, 123456789, 'Transfer Equipment', 'working', '2024-12-22 04:13:47'),
(70, 25, 202400019, 'Transfer Equipment', 'working', '2024-12-22 04:14:27'),
(71, 26, 123456789, 'Purchase Equipment', 'working', '2024-12-22 05:08:56'),
(72, 27, 123456789, 'Purchase Equipment', 'working', '2024-12-22 05:08:56'),
(73, 26, 200211646, 'Transfer Equipment', 'working', '2024-12-22 05:10:24'),
(74, 27, 200211646, 'Transfer Equipment', 'working', '2024-12-22 05:10:24'),
(75, 26, 123456789, 'Transfer Equipment', 'working', '2024-12-22 03:30:32'),
(76, 27, 123456789, 'Transfer Equipment', 'working', '2024-12-22 03:30:32'),
(77, 26, 202400018, 'Transfer Equipment', 'working', '2024-12-22 03:31:52'),
(78, 27, 202400018, 'Transfer Equipment', 'working', '2024-12-22 03:31:52'),
(79, 26, 202400013, 'Transfer Equipment', 'working', '2024-12-22 11:49:28'),
(80, 27, 202400013, 'Transfer Equipment', 'working', '2024-12-22 11:49:28'),
(81, 28, 202400013, 'Purchase Equipment', 'working', '2024-12-22 11:51:37'),
(82, 27, 200211646, 'Transfer Equipment', 'working', '2024-12-22 11:54:23'),
(83, 28, 200211646, 'Transfer Equipment', 'working', '2024-12-22 11:54:23'),
(84, 29, 202400018, 'Purchase Equipment', 'working', '2024-12-23 00:31:08'),
(85, 28, 202400013, 'Transfer Equipment', 'working', '2024-12-23 00:46:19'),
(86, 29, 202400018, 'Maintenance', 'working', '2024-12-23 01:08:31'),
(87, 29, 202400018, 'Maintenance', 'working', '2024-12-29 14:45:20'),
(88, 30, 202400018, 'Purchase Equipment', 'working', '2024-12-29 14:53:31'),
(91, 31, 202400018, 'Purchase Equipment', 'working', '2025-01-02 00:52:24'),
(92, 32, 202400018, 'Purchase Equipment', 'working', '2025-01-02 00:54:44'),
(93, 33, 202400018, 'Purchase Equipment', 'working', '2025-01-02 00:55:40'),
(94, 34, 202400018, 'Purchase Equipment', 'working', '2025-01-02 00:57:45'),
(95, 37, 202400018, 'Purchase Equipment', 'working', '2025-01-02 01:13:41'),
(96, 29, 202400018, 'Maintenance', 'working', '2025-01-02 12:46:02'),
(97, 36, 202400018, 'Purchase Equipment', 'working', '2025-01-02 13:10:37'),
(98, 35, 202400018, 'Purchase Equipment', 'working', '2025-01-02 13:11:36'),
(99, 37, 202400018, 'Maintenance', 'working', '2025-01-03 19:44:28'),
(100, 34, 202400018, 'Maintenance', 'working', '2025-01-03 19:45:16'),
(101, 26, 202400013, 'Maintenance', 'working', '2025-01-03 19:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `purchase_request_list_id` int(11) NOT NULL,
  `maintenance_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `purchase_request_list_id`, `maintenance_datetime`) VALUES
(1, 19, '2024-12-21 13:41:33'),
(2, 14, '2024-12-21 14:14:19'),
(3, 16, '2024-12-21 14:29:59'),
(4, 23, '2024-12-21 18:02:01'),
(5, 29, '2024-12-23 01:08:31'),
(6, 29, '2024-12-29 14:45:20'),
(7, 29, '2025-01-02 12:46:02'),
(8, 37, '2025-01-03 19:44:29'),
(9, 34, '2025-01-03 19:45:16'),
(10, 26, '2025-01-03 19:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `message` varchar(256) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `status`, `datetime`) VALUES
(10, '202400013', '202400001', 'huhuhu delulu nmn si self', 'active', '2024-09-05 12:44:54'),
(11, '202400013', '202400013', 'LOLOL', 'active', '2024-09-05 12:55:32'),
(12, '202400001', '202400001', 'hahahaha', 'active', '2024-09-05 13:35:44'),
(13, '202400001', '202400013', 'GEGE', 'active', '2024-09-05 13:42:12'),
(14, '202400013', '202400014', 'aga pata mads kay kita una ma present 45% nani PROMISE!', 'active', '2024-09-05 13:43:25'),
(16, '202400013', '202400014', 'hahahahaha', 'active', '2024-09-05 13:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `request_type` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `client` tinyint(1) NOT NULL DEFAULT 0,
  `storekeeper` tinyint(1) NOT NULL DEFAULT 0,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `request_type`, `admin`, `client`, `storekeeper`, `transaction_date`) VALUES
(1, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(2, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(3, 'purchase_request', 1, 0, 1, '2024-12-15 20:32:31'),
(4, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(5, 'purchase_request', 1, 0, 1, '2024-12-15 20:32:31'),
(6, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(7, 'purchase_request', 1, 1, 1, '2024-12-15 20:32:31'),
(8, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(9, 'purchase_request', 1, 1, 0, '2024-12-15 20:32:31'),
(10, 'purchase_request', 1, 0, 1, '2024-12-15 20:32:31'),
(11, 'purchase_request', 1, 1, 1, '2024-12-15 20:32:31'),
(12, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(13, 'request_maintenance', 1, 1, 0, '2024-12-15 20:32:31'),
(14, 'request_maintenance', 1, 1, 0, '2024-12-15 20:32:31'),
(15, 'request_maintenance', 1, 1, 0, '2024-12-15 20:32:31'),
(16, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(17, 'request_maintenance\r\n', 1, 0, 0, '2024-12-15 20:32:31'),
(18, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(19, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(20, 'purchase_request', 1, 1, 0, '2024-12-15 20:32:31'),
(21, 'purchase_request', 1, 1, 0, '2024-12-15 20:32:31'),
(22, 'purchase_request', 1, 1, 1, '2024-12-15 20:32:31'),
(23, 'request_maintenance', 1, 1, 0, '2024-12-15 20:32:31'),
(24, 'request_maintenance', 1, 1, 0, '2024-12-15 20:32:31'),
(25, 'purchase_request', 1, 1, 1, '2024-12-15 20:32:31'),
(32, 'request_maintenance', 1, 0, 0, '2024-12-15 20:54:26'),
(33, 'request_maintenance', 1, 0, 0, '2024-12-15 20:56:53'),
(34, 'request_maintenance', 1, 0, 0, '2024-12-15 20:58:45'),
(35, 'purchase_request', 1, 1, 1, '2024-12-16 14:11:56'),
(36, 'transfer_account', 0, 0, 0, '2024-12-20 13:03:38'),
(37, 'transfer_account', 0, 0, 0, '2024-12-20 13:06:36'),
(38, 'transfer_account', 0, 0, 0, '2024-12-20 13:17:45'),
(39, 'transfer_account', 0, 0, 0, '2024-12-20 13:19:11'),
(40, 'transfer_account', 0, 0, 0, '2024-12-20 13:22:03'),
(41, 'transfer_account', 0, 0, 0, '2024-12-20 13:44:56'),
(42, 'transfer_account', 0, 0, 0, '2024-12-20 14:12:35'),
(43, 'transfer_account', 0, 0, 0, '2024-12-20 23:58:55'),
(44, 'purchase_request', 1, 1, 0, '2024-12-21 17:58:11'),
(45, 'request_maintenance', 1, 1, 0, '2024-12-21 18:00:30'),
(46, 'request_maintenance', 1, 1, 0, '2024-12-21 18:03:42'),
(47, 'purchase_request', 1, 1, 0, '2024-12-21 18:12:12'),
(48, 'purchase_request', 1, 0, 0, '2024-12-22 03:34:45'),
(49, 'purchase_request', 1, 0, 0, '2024-12-22 05:08:48'),
(50, 'purchase_request', 1, 0, 0, '2024-12-22 11:51:04'),
(51, 'purchase_request', 1, 1, 0, '2024-12-23 00:30:40'),
(52, 'request_maintenance', 1, 0, 0, '2024-12-23 01:00:36'),
(53, 'request_maintenance', 1, 0, 0, '2024-12-23 01:01:29'),
(54, 'request_maintenance', 1, 1, 0, '2025-01-01 23:42:13'),
(55, 'request_maintenance', 1, 1, 0, '2025-01-02 00:40:24'),
(56, 'request_maintenance', 1, 1, 0, '2025-01-02 00:42:13'),
(57, 'purchase_request', 1, 0, 0, '2025-01-02 00:52:12'),
(58, 'purchase_request', 1, 0, 1, '2025-01-02 00:54:37'),
(59, 'purchase_request', 1, 0, 1, '2025-01-02 00:55:31'),
(60, 'purchase_request', 1, 0, 1, '2025-01-02 00:57:37'),
(61, 'request_maintenance', 1, 0, 0, '2025-01-02 00:58:28'),
(62, 'request_maintenance', 1, 0, 0, '2025-01-02 01:02:32'),
(63, 'request_maintenance', 1, 0, 0, '2025-01-02 01:03:31'),
(64, 'purchase_request', 1, 0, 0, '2025-01-02 01:11:27'),
(65, 'purchase_request', 1, 0, 1, '2025-01-02 01:12:40'),
(66, 'request_maintenance', 1, 0, 0, '2025-01-02 01:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `purchase_request_code` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `isSeen` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`id`, `notification_id`, `purchase_request_code`, `datetime`, `isSeen`, `status`) VALUES
(1, 1, 2024, '2024-12-01 00:06:32', 1, 'pending'),
(2, 2, 2024001, '2024-12-11 00:10:15', 1, 'pending'),
(3, 3, 2024002, '2024-12-11 01:12:36', 1, 'pending'),
(4, 5, 2024003, '2024-12-11 01:15:34', 1, 'pending'),
(5, 7, 2024004, '2024-12-11 01:19:29', 1, 'pending'),
(6, 9, 2024005, '2024-12-11 01:29:18', 1, 'accept'),
(7, 10, 2024006, '2024-12-11 01:39:19', 1, 'accept'),
(8, 11, 2024007, '2024-12-11 01:42:08', 1, 'accept'),
(9, 20, 2024008, '2024-12-11 13:59:20', 1, 'accept'),
(10, 21, 2024009, '2024-12-11 14:01:29', 1, 'accept'),
(11, 22, 2024010, '2024-12-11 14:04:55', 1, 'accept'),
(12, 25, 2024011, '2024-12-11 16:16:54', 1, 'accept'),
(13, 35, 2024012, '2024-12-16 14:11:55', 1, 'accept'),
(14, 41, 2024013, '2024-12-20 13:28:33', 1, 'pending'),
(15, 41, 2024014, '2024-12-20 13:29:30', 1, 'accept'),
(16, 41, 2024015, '2024-12-20 13:31:50', 1, 'accept'),
(17, 44, 2024016, '2024-12-21 14:33:16', 1, 'accept'),
(18, 44, 2024017, '2024-12-21 17:58:11', 1, 'accept'),
(19, 47, 2024018, '2024-12-21 18:12:12', 1, 'accept'),
(20, 48, 2024019, '2024-12-22 03:34:44', 1, 'accept'),
(21, 49, 2024020, '2024-12-22 05:08:47', 1, 'accept'),
(22, 50, 2024021, '2024-12-22 11:51:04', 1, 'accept'),
(23, 51, 2024022, '2024-12-23 00:30:39', 1, 'accept'),
(24, 54, 2024023, '2024-12-29 14:53:10', 1, 'accept'),
(25, 57, 2025, '2025-01-02 00:52:11', 1, 'accept'),
(26, 58, 2025001, '2025-01-02 00:54:35', 1, 'accept'),
(27, 59, 2025002, '2025-01-02 00:55:30', 1, 'accept'),
(28, 60, 2025003, '2025-01-02 00:57:36', 1, 'accept'),
(29, 64, 2025004, '2025-01-02 01:10:25', 1, 'accept'),
(30, 64, 2025005, '2025-01-02 01:11:12', 1, 'accept'),
(31, 65, 2025006, '2025-01-02 01:12:38', 1, 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_list`
--

CREATE TABLE `purchase_request_list` (
  `id` int(11) NOT NULL,
  `purchase_request_code` int(11) NOT NULL,
  `usercode` int(11) NOT NULL,
  `requester_code` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(11,2) NOT NULL,
  `specs` varchar(255) NOT NULL,
  `maintance` int(11) DEFAULT 62,
  `doingMaintenance` datetime DEFAULT current_timestamp(),
  `request_maintenance` datetime DEFAULT NULL,
  `isDisabled` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_request_list`
--

INSERT INTO `purchase_request_list` (`id`, `purchase_request_code`, `usercode`, `requester_code`, `item_name`, `quantity`, `price`, `specs`, `maintance`, `doingMaintenance`, `request_maintenance`, `isDisabled`, `status`) VALUES
(25, 2024019, 200211646, 202400019, 'Laptop', 10, 50000.00, '8gb RAM\n500gb SSD\nAcer/Lenovo', 62, '2024-12-22 03:34:53', NULL, 'working', '3740895262'),
(26, 2024020, 123456789, 202400013, 'Printer', 1, 20000.00, 'EPSON L300', 62, '2025-01-03 19:45:40', NULL, 'working', '8897516064'),
(27, 2024020, 123456789, 202400013, 'TV', 1, 60000.00, 'SAMSUNG/LG SMART TV 53 INCHES', 62, '2024-12-22 05:08:56', NULL, 'working', '3249199562'),
(28, 2024021, 202400013, 202400013, 'Laptop', 30, 30000.00, 'ACER 8gb', 62, '2024-12-22 11:51:37', NULL, 'working', '8507118912'),
(29, 2024022, 202400018, 202400018, 'Laptop', 2, 42000.00, 'Asus 8gb', 1, '2025-01-02 12:46:02', NULL, 'working', '5424705347'),
(30, 2024023, 202400018, 202400018, 'TV', 13, 50000.00, 'Samsung Smart TV', 62, '2024-12-29 15:05:57', NULL, 'working', '8609057759'),
(31, 2025, 202400018, 202400018, 'asd', 21, 231.00, 'asd', 62, '2025-01-02 00:52:24', NULL, 'working', '6647281066'),
(32, 2025001, 202400018, 202400018, 'sample', 2, 23.00, 'sample', 62, '2025-01-02 00:54:44', NULL, 'working', '4544476874'),
(33, 2025002, 202400018, 202400018, 'sample', 2, 31.00, 'sample', 62, '2025-01-02 00:55:40', NULL, 'working', '9643526019'),
(34, 2025003, 202400018, 202400018, 'sample', 2, 312.00, 'sample', 62, '2025-01-03 19:45:16', NULL, 'working', '4478769656'),
(35, 2025004, 202400018, 202400018, 'sample', 2, 230.00, 'sample', 62, '2025-01-02 13:11:36', NULL, 'working', '1896460981'),
(36, 2025005, 202400018, 202400018, 'sample', 3, 23.00, 'sample', 62, '2025-01-02 13:10:37', NULL, 'working', '5369802411'),
(37, 2025006, 202400018, 202400018, 'sample', 2, 23.00, 'sample', 62, '2025-01-03 19:44:28', NULL, 'working', '1958351939');

-- --------------------------------------------------------

--
-- Table structure for table `request_maintenance`
--

CREATE TABLE `request_maintenance` (
  `id` int(11) NOT NULL,
  `usercode` varchar(100) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `purchase_request_list_id` int(11) NOT NULL,
  `request_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `request_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_maintenance`
--

INSERT INTO `request_maintenance` (`id`, `usercode`, `notification_id`, `purchase_request_list_id`, `request_datetime`, `request_status`) VALUES
(1, '202400018', 44, 22, '2024-12-21 22:03:30', 0),
(2, '123456789', 45, 23, '2024-12-21 18:00:22', 1),
(3, '123456789', 46, 23, '2024-12-21 18:03:42', 0),
(4, '202400018', 52, 29, '2024-12-23 01:00:36', 1),
(5, '202400013', 53, 28, '2024-12-23 01:01:28', 1),
(7, '202400018', 54, 30, '2025-01-01 23:42:12', 1),
(8, '202400018', 55, 29, '2025-01-02 00:40:23', 1),
(9, '202400018', 56, 30, '2025-01-02 00:42:12', 1),
(10, '202400018', 61, 34, '2025-01-02 00:58:27', 1),
(11, '202400018', 62, 34, '2025-01-02 01:02:31', 1),
(12, '202400018', 63, 33, '2025-01-02 01:03:30', 1),
(13, '202400018', 66, 37, '2025-01-02 01:17:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `id` int(11) NOT NULL,
  `usercode` int(11) NOT NULL,
  `equipment` varchar(50) NOT NULL,
  `equipment_id` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `type` varchar(256) NOT NULL,
  `location` varchar(256) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `notes` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_log`
--

INSERT INTO `transaction_log` (`id`, `usercode`, `equipment`, `equipment_id`, `time`, `date`, `type`, `location`, `admin`, `notes`) VALUES
(3, 202400003, 'Computer', 'EQ001', '09:00:00', '2024-08-16', 'Digital Office Equipment', 'Office A', 'Admin1', 'Routine check'),
(4, 202400004, 'Printer/Scanner', 'EQ002', '10:30:00', '2024-08-16', 'Digital Office Equipment', 'Office B', 'Admin2', 'Maintenance'),
(5, 202400005, 'Monitor', 'EQ003', '11:00:00', '2024-08-16', 'Digital Office Equipment', 'Office C', 'Admin3', 'Operational'),
(6, 202400006, 'Telephone', 'EQ004', '12:15:00', '2024-08-16', 'Digital Office Equipment', 'Office D', 'Admin4', 'Installation'),
(7, 202400007, 'Projector', 'EQ005', '13:00:00', '2024-08-16', 'Digital Office Equipment', 'Conference Room', 'Admin5', 'Ready for meeting'),
(8, 202400008, 'Router/Modem', 'EQ006', '14:30:00', '2024-08-16', 'Digital Office Equipment', 'IT Room', 'Admin6', 'Configuration complete'),
(9, 202400009, 'Smartphone', 'EQ007', '15:00:00', '2024-08-16', 'Digital Office Equipment', 'Office E', 'Admin7', 'Distributed to staff'),
(10, 2024000010, 'Digital Whiteboard', 'EQ008', '16:45:00', '2024-08-16', 'Digital Office Equipment', 'Training Room', 'Admin8', 'Installed and tested'),
(11, 202400003, 'VoIP Phone System', 'EQ009', '17:00:00', '2024-08-16', 'Digital Office Equipment', 'Office F', 'Admin9', 'System operational'),
(12, 202400005, 'Smart Speakers', 'EQ010', '18:30:00', '2024-08-16', 'Digital Office Equipment', 'Office G', 'Admin10', 'Setup complete'),
(13, 202400003, 'Bulldozer', 'EQ011', '07:30:00', '2024-08-16', 'Construction Road Equipment', 'Site A', 'Admin11', 'Leveling ground'),
(14, 202400004, 'Excavator', 'EQ012', '08:00:00', '2024-08-16', 'Construction Road Equipment', 'Site B', 'Admin12', 'Digging foundation'),
(15, 202400005, 'Grader', 'EQ013', '09:30:00', '2024-08-16', 'Construction Road Equipment', 'Site C', 'Admin13', 'Smoothing surface'),
(16, 202400006, 'Asphalt Paver', 'EQ014', '10:00:00', '2024-08-16', 'Construction Road Equipment', 'Site D', 'Admin14', 'Laying asphalt'),
(17, 202400007, 'Road Roller', 'EQ015', '11:15:00', '2024-08-16', 'Construction Road Equipment', 'Site E', 'Admin15', 'Compacting asphalt'),
(18, 202400007, 'Dump Truck', 'EQ016', '12:00:00', '2024-08-16', 'Construction Road Equipment', 'Site F', 'Admin16', 'Transporting materials'),
(19, 202400008, 'Concrete Mixer', 'EQ017', '13:45:00', '2024-08-16', 'Construction Road Equipment', 'Site G', 'Admin17', 'Mixing concrete'),
(20, 202400009, 'Loader', 'EQ018', '14:30:00', '2024-08-16', 'Construction Road Equipment', 'Site H', 'Admin18', 'Loading materials'),
(21, 2024000010, 'Skid Steer Loader', 'EQ019', '15:00:00', '2024-08-16', 'Construction Road Equipment', 'Site I', 'Admin19', 'Grading and digging'),
(22, 202400004, 'Backhoe Loader', 'EQ020', '16:15:00', '2024-08-16', 'Construction Road Equipment', 'Site J', 'Admin20', 'Excavation work');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_history`
--

CREATE TABLE `transfer_history` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `from_user` varchar(50) DEFAULT NULL,
  `to_user` varchar(50) DEFAULT NULL,
  `transferred_by` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `transfer_date` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_history`
--

INSERT INTO `transfer_history` (`id`, `item_name`, `from_user`, `to_user`, `transferred_by`, `quantity`, `transfer_date`, `status`) VALUES
(5, 'Laptop', '200211646', '123456789', '202400001', 1, '2024-12-22 04:13:48', 'Completed'),
(6, 'Laptop', '123456789', '202400019', '202400001', 1, '2024-12-22 04:14:28', 'Completed'),
(7, 'Printer', '123456789', '200211646', '202400001', 1, '2024-12-22 05:10:25', 'Completed'),
(8, 'TV', '123456789', '200211646', '202400001', 1, '2024-12-22 05:10:26', 'Completed'),
(9, 'Printer', '200211646', '123456789', '202400001', 1, '2024-12-22 03:30:33', 'Completed'),
(10, 'TV', '200211646', '123456789', '202400001', 1, '2024-12-22 03:30:33', 'Completed'),
(11, 'Printer', '123456789', '202400018', '202400018', 1, '2024-12-22 03:31:53', 'Completed'),
(12, 'TV', '123456789', '202400018', '202400018', 1, '2024-12-22 03:31:53', 'Completed'),
(13, 'Printer', '202400018', '202400013', '202400013', 1, '2024-12-22 11:49:29', 'Completed'),
(14, 'TV', '202400018', '202400013', '202400013', 1, '2024-12-22 11:49:29', 'Completed'),
(15, 'TV', '202400013', '200211646', '202400001', 1, '2024-12-22 11:54:24', 'Completed'),
(16, 'Laptop', '202400013', '200211646', '202400001', 1, '2024-12-22 11:54:24', 'Completed'),
(17, 'Laptop', '200211646', '202400013', '202400001', 1, '2024-12-23 00:46:20', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usercode` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usercode`, `email`, `password`, `phone_number`, `fullname`, `birthdate`, `gender`, `role`, `department`, `position`, `profile`, `status`) VALUES
(3, 202400001, 'admin@gmail.com', '5e5pvx8QtBzR/tdMaGvgPW5lUzIyeUVBVTZxL3BwUituMEhOeEE9PQ==', '09105005202', 'John Michael Emilia', '2001-10-12', 'male', 'admin', '', '', '../../profile/cuc.jpg', 'active'),
(26, 202400003, 'storekeeper@gmail.com', '6nzmJPULyyDt2dFGPXRH8WZDa3RFRmY3Q1pvbm42bUNxUVB0cGc9PQ==', '09563666571', 'mewthoow', '2002-02-10', 'female', 'storekeeper', '', '', '../../profile/nigg.jfif', 'active'),
(36, 202400013, 'japitanachrisfel@gmail.com', 'YEeIo9rujZuyNGUC5lhgGWovUVRQUjNJQzVIYUY3ZndOWXFPTFE9PQ==', '12423423421', 'Chrisfel Japitana', '2002-06-03', 'female', 'client', '', '', '../../profile/fellyci.jpg', 'active'),
(41, 202400018, 'sigfred@gmail.com', 'L58DCgMWfcerFJSVbeBnEiswcTdUSXdKMWF5TXpBeFZUTmRHZEE9PQ==', '12121212121', 'Sigfredo Fernandez', '2002-08-19', 'male', 'client', 'ASSESSOR', 'sample', '../../profile/boy.jpeg', 'active'),
(52, 123456789, 'mewthoow2002@gmail.com', 'wvqXQ8bDwyXlEOOuLEzxW2JCOHBaY3p0ZmtIK0dlamRRaGFSd2c9PQ==', '09563666571', 'mew thoow', '2002-02-10', 'female', 'client', 'CMO TRAFFIC', 'SECRETARY', '../../profile/462578911_1294958045180131_3174777377344810426_n.jpg', 'active'),
(53, 200211646, 'imaqthoeee@gmail.com', 'vSTme7jNoqQiADRsKIek71BCUHU3TEhacFA0NktvV0JaMkV2MlE9PQ==', '09105005202', 'Michael', '2001-10-12', 'male', 'client', 'CEO', 'President', NULL, 'active'),
(54, 102812345, 'andreaandrade062902@gmail.com', 'p+QxB7GEGXsM3xluiok5/Tkxb2lUVTBhSFNCc2taQlF2Rm0xRFE9PQ==', '09513442746', 'Andrea Andrade', '2002-12-23', 'female', 'client', 'CTO CASH', 'Cashier', NULL, 'active'),
(55, 678654356, 'tonyasm19@gmail.com', 'ijSafwGaitXNBeOyZH5N/G1QSW0yYVQyUWVuNmhJamNIQzFBdXc9PQ==', '09234556778', 'Anthony Malabanan', '2024-12-03', 'male', 'client', 'DEPED', 'Department Head', NULL, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_history`
--
ALTER TABLE `equipment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_request_list`
--
ALTER TABLE `purchase_request_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_maintenance`
--
ALTER TABLE `request_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_history`
--
ALTER TABLE `transfer_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `equipment_history`
--
ALTER TABLE `equipment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `purchase_request_list`
--
ALTER TABLE `purchase_request_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `request_maintenance`
--
ALTER TABLE `request_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transfer_history`
--
ALTER TABLE `transfer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
