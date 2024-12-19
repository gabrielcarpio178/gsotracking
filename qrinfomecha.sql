-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 06:07 PM
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
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_history`
--

INSERT INTO `equipment_history` (`id`, `equiment_id`, `usercode`, `action`, `transaction_date`) VALUES
(1, 19, 202400018, 'borrowed', '2024-12-20 00:56:30'),
(2, 19, 202400018, 'borrowed', '2024-12-20 00:58:25'),
(3, 18, 202400018, 'borrowed', '2024-12-20 01:04:07'),
(4, 16, 202400018, 'borrowed', '2024-12-20 01:04:12'),
(5, 17, 202400018, 'borrowed', '2024-12-20 01:04:12');

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
(1, 18, '2024-12-12 01:02:55'),
(2, 11, '2024-12-12 01:03:14');

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
(7, 'purchase_request', 1, 0, 1, '2024-12-15 20:32:31'),
(8, 'request_maintenance', 1, 0, 0, '2024-12-15 20:32:31'),
(9, 'purchase_request', 1, 0, 0, '2024-12-15 20:32:31'),
(10, 'purchase_request', 1, 0, 1, '2024-12-15 20:32:31'),
(11, 'purchase_request', 1, 0, 1, '2024-12-15 20:32:31'),
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
(35, 'purchase_request', 1, 0, 1, '2024-12-16 14:11:56');

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
(6, 9, 2024005, '2024-12-11 01:29:18', 1, 'pending'),
(7, 10, 2024006, '2024-12-11 01:39:19', 1, 'pending'),
(8, 11, 2024007, '2024-12-11 01:42:08', 1, 'pending'),
(9, 20, 2024008, '2024-12-11 13:59:20', 1, 'pending'),
(10, 21, 2024009, '2024-12-11 14:01:29', 1, 'pending'),
(11, 22, 2024010, '2024-12-11 14:04:55', 1, 'accept'),
(12, 25, 2024011, '2024-12-11 16:16:54', 1, 'accept'),
(13, 35, 2024012, '2024-12-16 14:11:55', 1, 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_list`
--

CREATE TABLE `purchase_request_list` (
  `id` int(11) NOT NULL,
  `purchase_request_code` int(11) NOT NULL,
  `requester_code` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(11,2) NOT NULL,
  `specs` varchar(255) NOT NULL,
  `maintance` int(11) DEFAULT 62,
  `doingMaintenance` datetime DEFAULT current_timestamp(),
  `request_maintenance` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_request_list`
--

INSERT INTO `purchase_request_list` (`id`, `purchase_request_code`, `requester_code`, `item_name`, `quantity`, `price`, `specs`, `maintance`, `doingMaintenance`, `request_maintenance`, `status`) VALUES
(1, 2024, 202400018, 'printer', 1, 20000.00, 'any brand', 62, '2024-12-11 23:58:26', NULL, 'pending'),
(2, 2024001, 202400018, 'laptop', 1, 20000.00, 'any brand', 62, '2024-12-11 00:11:19', '2024-12-11 00:59:36', 'pending'),
(3, 2024002, 202400018, 'amplay', 1, 2000.00, 'any', 62, '2024-12-11 01:13:16', '2024-12-11 01:14:43', 'pending'),
(4, 2024003, 202400018, 'speaker', 1, 5000.00, 'any brand', 62, '2024-12-11 01:15:42', '2024-12-11 01:15:56', 'pending'),
(5, 2024004, 202400018, 'flashlight', 2, 500.00, 'any brand', 62, '2024-12-11 01:19:39', NULL, 'pending'),
(6, 2024005, 202400018, 'tv', 1, 50000.00, 'smart tb samsung 12inc', 62, '2024-12-11 23:37:46', NULL, 'pending'),
(7, 2024005, 202400018, 'microphone', 2, 1500.00, 'wireless', 62, '2024-08-11 23:37:46', NULL, 'pending'),
(8, 2024006, 202400002, 'stand fun', 5, 500.00, 'camel', 62, '2024-12-11 01:44:45', '2024-12-11 16:16:16', 'pending'),
(9, 2024006, 202400002, 'aircon', 2, 25000.00, 'any brand', 62, '2024-12-11 01:44:45', NULL, 'pending'),
(10, 2024007, 202400002, 'table', 5, 15000.00, '5', 62, '2024-12-11 01:43:46', NULL, 'pending'),
(11, 2024007, 202400018, 'chear', 10, 100.00, 'any brand', 62, '2024-12-12 01:03:14', NULL, 'pending'),
(12, 2024008, 202400018, 'mouse', 2, 150.00, 'any brand', 62, '2024-12-11 13:59:20', NULL, 'pending'),
(13, 2024008, 202400018, 'keyboard', 2, 250.00, 'any brand', 62, '2024-12-11 13:59:20', NULL, 'pending'),
(14, 2024009, 202400018, 'keyboard', 2, 150.00, 'any', 62, '2024-12-11 14:01:29', NULL, 'pending'),
(15, 2024009, 202400018, 'mouse', 2, 150.00, 'any brand', 62, '2024-12-11 14:01:29', NULL, 'pending'),
(16, 2024010, 202400018, 'keyboard', 2, 100.00, 'any', 62, '2024-12-20 01:04:12', NULL, '1152473961'),
(17, 2024010, 202400018, 'mouse', 2, 100.00, 'any', 62, '2024-12-12 01:25:39', '2024-12-15 20:57:15', 'pending'),
(18, 2024011, 202400018, 'flashlight', 1, 1000.00, 'any', 62, '2024-12-20 01:04:06', '2024-12-15 20:55:21', '2520778022'),
(19, 2024012, 202400018, 'monitor', 2, 5000.00, '13inc', 62, '2024-12-20 00:58:25', NULL, '4997816944');

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
(1, '202400018', 16, 2, '2024-12-11 00:40:08', 0),
(2, '202400018', 17, 2, '2024-12-11 00:42:10', 0),
(3, '202400018', 3, 2, '2024-12-11 00:46:23', 0),
(4, '202400018', 6, 1, '2024-12-11 00:51:32', 0),
(6, '202400018', 2, 1, '2024-12-11 00:58:23', 0),
(7, '202400018', 18, 2, '2024-12-11 00:59:36', 0),
(8, '202400018', 19, 1, '2024-12-11 00:59:48', 0),
(9, '202400018', 4, 3, '2024-12-11 01:14:43', 0),
(10, '202400018', 6, 4, '2024-12-11 01:15:56', 0),
(11, '202400018', 8, 5, '2024-12-11 01:19:52', 1),
(12, '202400018', 12, 8, '2024-12-11 01:45:03', 1),
(13, '202400018', 13, 9, '2024-12-11 01:46:26', 1),
(14, '202400018', 14, 11, '2024-12-11 01:47:18', 1),
(15, '202400018', 15, 10, '2024-12-11 01:50:21', 1),
(17, '202400018', 23, 8, '2024-12-11 16:15:11', 1),
(18, '202400018', 24, 8, '2024-12-11 16:16:16', 0),
(19, '202400018', 32, 18, '2024-12-15 20:50:26', 1),
(20, '202400018', 33, 18, '2024-12-15 20:55:21', 0),
(21, '202400018', 34, 17, '2024-12-15 20:57:15', 0);

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
(3, 202400001, 'romerojanssen052501@gmail.com', '6V4oQAUMOM48CbumL7B2KHhFT0RyQ0ZiZGJjdC9Vc3poYzVlVHc9PQ==', '09928513133', 'janssen rey romero', '2001-05-25', 'male', 'admin', '', '', '../../profile/boy.jpeg', 'active'),
(4, 202400017, 'sig@gmail.com', 'rodmgm0BTLYcnbSVWvH0gE9CWXdIS25ZWVZzSTJodGtsLzVGZHc9PQ==', '09928513133', 'Sigfredo Fernandez', '2024-07-10', 'male', 'client', '', '', NULL, 'active'),
(26, 202400003, 'admin1@example.com', '4w43jTH4D3GL+WwbZGNrf3Q0Q3lkK25XTncrVVU2dWxrKzFzRUE9PQ==', '01234567890', 'Admin User One', '1980-01-15', 'male', 'storekeeper', '', '', '../../profile/girl.jpeg', 'active'),
(27, 202400004, 'admin2@example.com', 'hFnu3147KkylLe9S2vfRyDRTbFlMTWNaRTFwSWxwTDl6bzRYRFE9PQ==', '02345678901', 'Admin User Two', '1982-03-20', 'female', 'staff', '', '', NULL, 'active'),
(28, 202400005, 'admin3@example.com', '6qFAI9nZ1V+3f5VXPjyxTGVHWlA1bERSZ3FWNVRpMW8xamFJTnc9PQ==', '03456789012', 'Hawk Tuah', '1984-05-25', 'male', 'client', '', '', NULL, 'active'),
(29, 202400006, 'admin4@example.com', 'Vd/ZHvMjEb2KTJsruR7FKWc4NldmWG1QRDFvTXJkUExJWjY2cWc9PQ==', '4567890123', 'Admin User Four', '1986-07-30', 'female', 'client', '', '', NULL, 'active'),
(30, 202400007, 'admin5@example.com', 'iBj3ZS/qOuAw8H1eCqR7NlgwaU5SYmtVU212YUhOMndleUI2Snc9PQ==', '5678901234', 'Admin User Five', '1988-09-10', 'male', 'client', '', '', NULL, 'active'),
(31, 202400008, 'admin6@example.com', 'mKNte+fy0JPSAaQYcKaJLWRoS0N6UnBJK3dGelVBQ1dMcWE4eUE9PQ==', '6789012345', 'Admin User Six', '1990-11-15', 'female', 'admin', '', '', NULL, 'active'),
(32, 202400009, 'admin7@example.com', 'RJR5mOGcETYnlGQ1JSd37FRIR01QdkNrQTlLYjdRTmYycG9NVlE9PQ==', '7890123456', 'Admin User Seven', '1992-01-05', 'male', 'admin', '', '', NULL, 'active'),
(33, 202400010, 'admin8@example.com', '5ypI7ysfor+k8TyBzBiRAkVvT1BkTVdvcVFFZi9LbUpVZ2E1dVE9PQ==', '8901234567', 'Admin User Eight', '1994-03-12', 'female', 'mayor', '', '', NULL, 'active'),
(34, 202400011, 'admin9@example.com', '1eyUC6gp3YAUwDAMaMi90jAxVjdLZDZkMjhCb2xucThCVkpuenc9PQ==', '9012345678', 'Admin User Nine', '1996-05-18', 'male', 'finance department', '', '', NULL, 'active'),
(35, 202400012, 'admin10@example.com', 'AqhY07aClJ/1bGjuwMF5JkZzQkJoZ0pzdnJ1UGdudHhCOEF6R1E9PQ==', '123456789', 'Admin User Ten', '1998-07-22', 'female', 'department head', '', '', NULL, 'active'),
(36, 202400013, 'japitanachrisfel@gmail.com', 'YEeIo9rujZuyNGUC5lhgGWovUVRQUjNJQzVIYUY3ZndOWXFPTFE9PQ==', '12423423421', 'Chrisfel Japitana', '2002-06-03', 'female', 'client', '', '', '../../profile/fellyci.jpg', 'active'),
(37, 202400014, 'mayannmaco@gmail.com', 'mP+YNwgndb/ZrK9tx+63HmRnTm5Eb21jbjJvM2hmN2RmL3puK1E9PQ==', '12356745787', 'mayann maco', '2002-07-16', 'female', 'staff', '', '', NULL, 'active'),
(38, 202400015, 'jesryl@gmail.com', 'Wo4CnqpueKr3o8mOatwqOVE4c3pZUURvOXZYbjBrZGFjbSthaVE9PQ==', '21312313131', 'jesryl palmes', '2001-08-14', 'male', 'storekeeper', '', '', '../../profile/jesryl.jpg', 'active'),
(39, 202400016, 'mayannmaco2020@gmail.com', '6TAt/Ezs3N7arqok40KLi0w4TjRzeCtHVTBRN0EyalRkU2MxTHc9PQ==', '09563666571', 'ming maco', '2000-01-12', 'female', 'department head', 'BUDGET', 'department head', NULL, 'active'),
(41, 202400018, 'sigfred@gmail.com', 'L58DCgMWfcerFJSVbeBnEiswcTdUSXdKMWF5TXpBeFZUTmRHZEE9PQ==', '12121212121', 'Sigfredo Fernandez', '2002-08-19', 'male', 'client', 'ASSESSOR', 'sample', '../../profile/boy.jpeg', 'active'),
(42, 202400019, 'cheazzyy090@gmail.com', 'jSWyQRedRpn6JmVT/KkGyDRheFlKc0ljdjRMZ1hUcFVyYWpsVHc9PQ==', '09105005202', 'John Michael Emilia', '2001-12-10', 'male', 'client', 'BUDGET', 'sample', NULL, 'active'),
(48, 202400002, 'gabrielcarpio178@gmail.com', 'H1p9ZU9wC9H1MyP/Sbq/bi9OQjdQL2NtbTFTNkNVNlhQbExjMWc9PQ==', '09123456789', 'gabriel carpio', '2000-05-01', 'male', 'client', 'LIBRARY', 'department head', NULL, 'active'),
(49, 234567890, 'gracelynjoyceplimones@gmail.com', 'JHRAfVhRxWL0Wz9qi4rAV0VsWHhmNnNCSWlLU3lnVDl1MWk2WGc9PQ==', '09123456789', 'Gracelyn Joyce Plimones', '2003-06-07', 'female', 'client', 'LIBRARY', 'Liblarian', NULL, 'active'),
(50, 102812662, 'fellycidad@gmail.com', 'pY0KfUtOCGaNmQC4blzv2W13dHZKcE9lbkNZdlRPOU15ZzBqZ2c9PQ==', '09930788284', 'Fellycidad', '2002-12-10', 'female', 'client', 'CTO CASH', 'cashier', NULL, 'active'),
(51, 102812667, 'osorioallen4@gmail.com', 'XerdeumkNmWGlvxd1hFmSTl5OG5hWWVYUG93ditrOXhaWFdaT3c9PQ==', '09156063491', 'Allen Osorio', '2003-06-05', 'male', 'client', 'LIBRARY', 'Liblarian', NULL, 'active');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_request_list`
--
ALTER TABLE `purchase_request_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `request_maintenance`
--
ALTER TABLE `request_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
