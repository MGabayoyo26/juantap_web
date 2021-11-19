-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 08:36 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `rfid` int(10) NOT NULL,
  `gcan` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`rfid`, `gcan`, `types`) VALUES
(56987655, '2021112001509575', 'Ordinary'),
(3691215, '3273429NU6559TA7', 'Ordinary'),
(3691215, '574J1905P760U9AT', 'Ordinary'),
(2002680, '5A4380J09UN357A6', 'Discount - PWD'),
(481216, '7P08N8073TA6A1U2', 'Ordinary'),
(4325245, '8162432371839538', 'Driver'),
(826200, 'P3262J0810416599', 'Discount - Student');

-- --------------------------------------------------------

--
-- Table structure for table `drivers_tbl`
--

CREATE TABLE `drivers_tbl` (
  `id` int(11) NOT NULL,
  `driver_accountNo` int(16) NOT NULL,
  `driver_name` varchar(64) NOT NULL,
  `driver_mobileNum` int(11) NOT NULL,
  `driver_email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers_tbl`
--

INSERT INTO `drivers_tbl` (`id`, `driver_accountNo`, `driver_name`, `driver_mobileNum`, `driver_email`) VALUES
(2, 45654645, 'ytyrty', 645645, 'yrtyrty'),
(3, 345464, 'jgjghj', 67567, 'hgjghjg');

-- --------------------------------------------------------

--
-- Table structure for table `jeeps`
--

CREATE TABLE `jeeps` (
  `id` int(11) NOT NULL,
  `platenumber` varchar(30) NOT NULL,
  `station` varchar(30) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jeeps`
--

INSERT INTO `jeeps` (`id`, `platenumber`, `station`, `comment`) VALUES
(1, 'RB 0827', 'Roces 1', 'Under Maintenance'),
(2, 'DFF 327', 'Roces 1', ''),
(3, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(30) NOT NULL,
  `station_from` int(30) NOT NULL,
  `station_to` int(30) NOT NULL,
  `adult_price` float NOT NULL,
  `student_price` float NOT NULL,
  `senior_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `station_from`, `station_to`, `adult_price`, `student_price`, `senior_price`) VALUES
(1, 1, 2, 15, 13, 13),
(2, 1, 3, 20, 18, 18),
(3, 1, 4, 25, 23, 23),
(4, 1, 5, 30, 28, 28),
(5, 1, 6, 35, 33, 33),
(6, 2, 1, 15, 13, 13),
(7, 2, 3, 15, 13, 13),
(8, 2, 4, 20, 18, 18),
(9, 2, 5, 25, 23, 23),
(10, 2, 6, 30, 28, 28),
(11, 3, 1, 20, 18, 18),
(12, 3, 2, 15, 13, 13),
(13, 3, 4, 15, 13, 13),
(14, 3, 5, 20, 18, 18),
(15, 3, 6, 25, 23, 23),
(16, 4, 1, 25, 23, 23),
(17, 4, 2, 20, 18, 18),
(18, 4, 3, 15, 13, 13),
(19, 4, 5, 15, 13, 13),
(20, 4, 6, 20, 18, 18),
(21, 5, 1, 30, 28, 28),
(22, 5, 2, 25, 23, 23),
(23, 5, 3, 20, 18, 18),
(24, 5, 4, 15, 13, 13),
(25, 5, 6, 15, 13, 13),
(26, 6, 1, 35, 33, 33),
(27, 6, 2, 30, 28, 28),
(28, 6, 3, 25, 23, 23),
(29, 6, 4, 20, 18, 18),
(30, 6, 5, 15, 13, 13),
(31, 8, 7, 15, 15, 15),
(32, 7, 8, 15, 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(30) NOT NULL,
  `station` varchar(200) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `station`, `address`) VALUES
(7, 'Roces 1', ''),
(8, 'Cubao', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Juantap', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(30) NOT NULL,
  `ticket_no` int(30) NOT NULL,
  `station_from` int(30) NOT NULL,
  `station_to` int(30) NOT NULL,
  `price` float NOT NULL,
  `passenger_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= Adult,2=Student,3=Senior',
  `processed_by` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_no`, `station_from`, `station_to`, `price`, `passenger_type`, `processed_by`, `date_created`) VALUES
(1, 2147483647, 3, 2, 15, 1, 1, '2020-11-03 14:21:12'),
(2, 2147483647, 3, 2, 15, 1, 1, '2020-11-03 14:21:12'),
(3, 2147483647, 3, 2, 15, 1, 1, '2020-11-03 14:21:12'),
(4, 2147483647, 3, 2, 15, 1, 1, '2020-11-03 14:21:12'),
(5, 2147483647, 3, 6, 25, 1, 1, '2020-11-03 14:47:20'),
(6, 2147483647, 3, 6, 23, 2, 1, '2020-11-03 14:47:20'),
(7, 2147483647, 3, 6, 23, 2, 1, '2020-11-03 14:47:20'),
(8, 2147483647, 3, 6, 23, 3, 1, '2020-11-03 14:47:20'),
(9, 2147483647, 3, 1, 20, 1, 1, '2020-11-03 14:50:41'),
(10, 2147483647, 3, 1, 20, 1, 1, '2020-11-03 14:50:41'),
(11, 2147483647, 3, 1, 18, 2, 1, '2020-11-03 14:50:41'),
(12, 2147483647, 3, 1, 18, 2, 1, '2020-11-03 14:50:41'),
(13, 2147483647, 1, 3, 20, 1, 2, '2020-11-03 15:45:13'),
(14, 2147483647, 1, 3, 20, 1, 2, '2020-11-03 15:45:13'),
(15, 2147483647, 1, 6, 35, 1, 2, '2020-11-03 15:46:38'),
(16, 2147483647, 1, 6, 33, 2, 2, '2020-11-03 15:46:38'),
(17, 2147483647, 1, 6, 33, 2, 2, '2020-11-03 15:46:38'),
(18, 2147483647, 1, 6, 33, 3, 2, '2020-11-03 15:46:38'),
(19, 2147483647, 1, 6, 33, 3, 2, '2020-11-03 15:46:38'),
(20, 2147483647, 3, 1, 15, 1, 1, '2021-10-30 22:35:32'),
(21, 2147483647, 7, 8, 15, 2, 2, '2021-11-02 23:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=Admin,2=Staff',
  `station_id` int(30) NOT NULL COMMENT 'for staff only'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `station_id`) VALUES
(3, 'Station 2 Staff', 'staff2', '8452ceee4febd49448f5f26c7299d56f', 2, 7),
(4, 'via', 'viyangzxc', '705f09f5246f935efd5f1f6ce304bc1f', 1, 0),
(5, 'Administrator', 'adminn', '0192023a7bbd73250516f069df18b500', 1, 0),
(7, 'taylor', 'tayswift', '4cdbd8808a5f3366d00df62af8673717', 2, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`gcan`);

--
-- Indexes for table `drivers_tbl`
--
ALTER TABLE `drivers_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `jeeps`
--
ALTER TABLE `jeeps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
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
-- AUTO_INCREMENT for table `drivers_tbl`
--
ALTER TABLE `drivers_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jeeps`
--
ALTER TABLE `jeeps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
