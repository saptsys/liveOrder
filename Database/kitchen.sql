-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2019 at 11:56 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liveorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `kitchen`
--

CREATE TABLE `kitchen` (
  `Id` int(3) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TableId` int(3) NOT NULL,
  `ProductId` int(3) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Pending` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen`
--

INSERT INTO `kitchen` (`Id`, `time`, `TableId`, `ProductId`, `Quantity`, `Pending`) VALUES
(1, '2019-02-01 11:47:41', 1, 1, 54, 5),
(2, '2019-02-01 11:47:37', 1, 2, 5, 4),
(3, '2019-02-01 13:07:27', 2, 3, 8, 54),
(4, '2019-02-01 16:08:54', 2, 4, 26, 8),
(5, '2019-02-01 16:08:47', 3, 5, 4608, 5),
(6, '2019-02-01 16:08:51', 3, 6, 6, 6),
(7, '2019-02-01 13:07:36', 4, 7, 4, 54),
(8, '2019-02-01 16:08:44', 4, 8, 21, 4),
(9, '2019-02-01 16:08:57', 5, 9, 23, 9),
(10, '2019-02-01 11:47:55', 5, 10, 3, 11),
(12, '2019-02-01 11:48:01', 1, 1, 5, 13),
(13, '2019-02-01 11:47:53', 1, 2, 2, 10),
(14, '2019-02-02 10:43:56', 2, 3, 199, 0),
(15, '2019-02-01 16:09:09', 2, 4, 15, 5),
(16, '2019-02-01 13:07:32', 3, 5, 8, 20),
(17, '2019-02-01 11:47:50', 3, 6, 6, 9),
(18, '2019-02-01 16:09:04', 4, 7, 64, 4),
(19, '2019-02-01 11:47:48', 4, 8, 6, 8),
(20, '2019-02-01 16:09:06', 5, 9, 44, 5),
(21, '2019-02-01 13:06:54', 5, 10, 14, 58),
(22, '2019-02-02 10:49:04', 4, 11, 12, 4),
(23, '2019-02-02 10:47:04', 4, 11, 0, 0),
(24, '2019-02-02 10:47:55', 4, 12, 0, 3),
(25, '2019-02-02 10:47:00', 4, 12, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kitchen`
--
ALTER TABLE `kitchen`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kitchen`
--
ALTER TABLE `kitchen`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
