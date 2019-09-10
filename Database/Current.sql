-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2019 at 10:19 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Id` int(3) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Name`) VALUES
(2, 'Capricosa'),
(3, 'Garlic'),
(4, 'Kathiyawadi'),
(5, 'Panjabi'),
(6, 'Gujarati'),
(7, 'Pizza'),
(8, 'Chinees'),
(9, 'Amarican'),
(10, 'Sauth'),
(11, 'Tropical');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitems`
--

CREATE TABLE `invoiceitems` (
  `Id` int(3) NOT NULL,
  `InvoiceId` int(3) NOT NULL,
  `ProductId` int(3) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Rate` double NOT NULL,
  `Amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoiceitems`
--

INSERT INTO `invoiceitems` (`Id`, `InvoiceId`, `ProductId`, `Quantity`, `Rate`, `Amount`) VALUES
(1, 1, 6, 1, 35, 35),
(2, 1, 8, 1, 105, 105),
(3, 1, 34, 1, 35, 35),
(4, 1, 35, 1, 99, 99),
(5, 1, 36, 1, 150, 150),
(6, 1, 38, 1, 20, 20),
(7, 1, 39, 1, 80, 80),
(8, 2, 17, 1, 85, 85),
(9, 2, 18, 1, 20, 20),
(10, 2, 19, 1, 80, 80),
(11, 2, 20, 1, 35, 35),
(12, 2, 35, 3, 99, 297),
(15, 3, 9, 4, 70, 280),
(16, 3, 11, 1, 70, 70),
(17, 3, 12, 4, 85, 340),
(18, 3, 13, 1, 80, 80),
(19, 3, 16, 1, 150, 150),
(20, 3, 34, 2, 35, 70),
(21, 3, 35, 1, 99, 99),
(22, 4, 11, 2, 70, 140),
(23, 4, 12, 3, 85, 255),
(24, 4, 13, 2, 80, 160),
(25, 4, 16, 3, 150, 450),
(26, 4, 24, 2, 20, 40),
(27, 4, 25, 3, 75, 225),
(28, 4, 34, 2, 35, 70),
(29, 4, 35, 2, 99, 198),
(37, 5, 26, 1, 35, 35),
(38, 5, 28, 1, 105, 105),
(39, 5, 29, 1, 70, 70),
(40, 5, 30, 1, 56, 56),
(41, 5, 31, 1, 70, 70),
(42, 5, 32, 1, 85, 85),
(43, 5, 33, 1, 80, 80),
(44, 6, 6, 3, 35, 105),
(45, 6, 8, 2, 105, 210),
(46, 6, 31, 3, 70, 210),
(47, 6, 33, 2, 80, 160),
(48, 6, 34, 1, 35, 35),
(49, 6, 35, 2, 99, 198),
(50, 6, 8, 0, 105, 0),
(51, 6, 8, 4, 105, 420),
(52, 6, 9, 5, 70, 350),
(53, 6, 6, 1, 35, 35),
(54, 6, 34, 3, 35, 105),
(55, 6, 35, 1, 99, 99),
(58, 6, 31, 2, 70, 140),
(59, 6, 33, 2, 80, 160),
(61, 6, 6, 2, 35, 70),
(62, 6, 7, 3, 55, 165),
(63, 6, 26, 5, 35, 175),
(64, 6, 28, 2, 105, 210),
(65, 6, 34, 5, 35, 175),
(66, 6, 35, 8, 99, 792),
(68, 6, 4, 0, 20, 0),
(69, 6, 5, 0, 75, 0),
(70, 6, 24, 0, 20, 0),
(71, 6, 25, 0, 75, 0),
(72, 6, 35, 0, 99, 0),
(73, 6, 6, 2, 35, 70),
(74, 6, 7, 1, 55, 55),
(75, 6, 8, 2, 105, 210),
(76, 6, 9, 2, 70, 140),
(77, 6, 34, 2, 35, 70),
(78, 6, 35, 2, 99, 198),
(80, 6, 8, 0, 105, 0),
(81, 6, 8, 0, 105, 0),
(82, 6, 6, 0, 35, 0),
(83, 6, 8, 0, 105, 0),
(85, 6, 8, 0, 105, 0),
(86, 6, 6, 0, 35, 0),
(87, 6, 8, 0, 105, 0),
(88, 6, 9, 0, 70, 0),
(89, 6, 31, 0, 70, 0),
(90, 6, 33, 0, 80, 0),
(92, 6, 8, 0, 105, 0),
(93, 6, 8, 0, 105, 0),
(94, 6, 6, 0, 35, 0),
(95, 6, 8, 0, 105, 0),
(97, 6, 6, 3, 35, 105),
(98, 6, 8, 2, 105, 210),
(99, 6, 9, 3, 70, 210),
(100, 6, 8, 0, 105, 0),
(101, 6, 6, 0, 35, 0),
(102, 6, 7, 0, 55, 0),
(103, 6, 8, 0, 105, 0),
(104, 6, 9, 0, 70, 0),
(108, 6, 18, 0, 20, 0),
(109, 6, 19, 0, 80, 0),
(110, 6, 20, 0, 35, 0),
(111, 7, 6, 0, 35, 0),
(112, 7, 8, 0, 105, 0),
(114, 8, 8, 0, 105, 0),
(115, 9, 20, 3, 35, 105),
(116, 10, 13, 3, 80, 240),
(117, 10, 16, 4, 150, 600),
(118, 10, 34, 3, 35, 105),
(119, 10, 35, 2, 99, 198),
(120, 11, 6, 5, 35, 175),
(121, 11, 8, 3, 105, 315);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `Id` int(3) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TableId` int(2) NOT NULL,
  `GrossAmount` double NOT NULL,
  `GSTP` double NOT NULL,
  `GSTRs` double NOT NULL,
  `TotalAmount` double NOT NULL,
  `Waiter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`Id`, `Time`, `TableId`, `GrossAmount`, `GSTP`, `GSTRs`, `TotalAmount`, `Waiter`) VALUES
(1, '2019-02-04 15:48:49', 1, 524, 18, 94.32, 618.32, 'tonystark'),
(2, '2019-02-04 15:49:41', 6, 517, 18, 93.06, 610.06, 'tonystark'),
(3, '2019-02-04 15:55:04', 2, 1089, 18, 196.02, 1285.02, 'tonystark'),
(4, '2019-02-04 15:56:28', 2, 1538, 18, 276.84, 1814.84, 'tonystark'),
(5, '2019-02-04 16:04:02', 3, 501, 18, 90.18, 591.18, 'tonystark'),
(6, '2019-08-20 17:00:18', 1, 5082, 18, 914.76, 5996.76, 'tonystark'),
(7, '2019-08-20 17:01:31', 1, 0, 18, 0, 0, 'tonystark'),
(8, '2019-08-20 17:42:52', 1, 0, 18, 0, 0, 'tonystark'),
(9, '2019-08-27 12:54:36', 1, 105, 18, 18.9, 123.9, 'tonystark'),
(10, '2019-08-27 12:56:49', 1, 1143, 18, 205.74, 1348.74, 'tonystark'),
(11, '2019-09-05 04:30:48', 1, 490, 18, 88.2, 578.2, 'tonystark');

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
  `Pending` int(2) NOT NULL,
  `isReady` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(3) NOT NULL,
  `CatId` int(3) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` double NOT NULL,
  `IsAvailable` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `CatId`, `Name`, `Price`, `IsAvailable`) VALUES
(6, 2, 'Chees', 35, '1'),
(7, 2, 'Olive Oil', 55, '1'),
(8, 2, 'Bacon', 105, '1'),
(9, 2, 'Chees', 70, '1'),
(10, 2, 'Olive Oil', 56, '1'),
(11, 3, 'Chees', 70, '1'),
(12, 3, 'Oil', 85, '1'),
(13, 3, 'Bread', 80, '1'),
(14, 3, 'Regular', 35, '1'),
(15, 3, 'Paubhaji', 99, '1'),
(16, 3, 'Double Chees', 150, '1'),
(17, 4, 'Souce', 85, '1'),
(18, 4, 'Oil', 20, '1'),
(19, 4, 'Bread', 80, '1'),
(20, 4, 'Regular Panir tika', 35, '1'),
(21, 5, 'Chees', 30, '1'),
(22, 5, 'Sauce', 15, '1'),
(23, 5, 'Ham', 45, '1'),
(24, 6, 'Bacon', 20, '1'),
(25, 6, 'Pineapple', 75, '1'),
(26, 7, 'Chees', 35, '1'),
(27, 7, 'Olive Oil', 55, '1'),
(28, 7, 'Bacon', 105, '1'),
(29, 7, 'Chees', 70, '1'),
(30, 8, 'Olive Oil', 56, '1'),
(31, 8, 'Chees', 70, '1'),
(32, 8, 'Oil', 85, '1'),
(33, 8, 'Bread', 80, '1'),
(34, 9, 'Regular', 35, '1'),
(35, 9, 'Paubhaji', 99, '1'),
(36, 10, 'Double Chees', 150, '1'),
(37, 10, 'Souce', 85, '1'),
(38, 10, 'Oil', 20, '1'),
(39, 10, 'Bread', 80, '1'),
(40, 10, 'Regular Panir tika', 35, '1'),
(41, 11, 'Chees', 30, '1'),
(42, 11, 'Sauce', 15, '1'),
(43, 11, 'Ham', 45, '1'),
(44, 11, 'Bacon', 20, '1'),
(45, 11, 'Pineapple', 75, '1'),
(46, 11, 'Dosa', 60, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `Id` int(3) NOT NULL,
  `Name` varchar(10) DEFAULT NULL,
  `Capacity` int(2) DEFAULT NULL,
  `IsOccupied` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`Id`, `Name`, `Capacity`, `IsOccupied`) VALUES
(1, 'TB1', 4, 0),
(2, 'TB2', 5, 0),
(3, 'TB3', 4, 0),
(4, 'TB4', 4, 0),
(5, 'TB5', 5, 0),
(6, 'TB6', 4, 0),
(7, 'TB7', 4, 0),
(8, 'TB8', 4, 0),
(9, 'TB9', 4, 0),
(10, 'TB10', 4, 0),
(11, 'TB11', 4, 0),
(12, 'TB12', 5, 0),
(13, 'TB13', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(2) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Waiter','Chef','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Username`, `Password`, `Role`) VALUES
(1, 'tony', 'stark', 'tonystark', '9c16b045a32525f294494e95b3bc44ba36016c8e', 'Waiter'),
(2, 'bat', 'man', 'batman', '48e7a6364bdfa17a1d8627f043347e293abfc271', 'Chef'),
(3, 'super', 'man', 'superman', '25564cc3fe5b4cf47f1eba6029e58067290ee03d', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `kitchen`
--
ALTER TABLE `kitchen`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kitchen`
--
ALTER TABLE `kitchen`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
