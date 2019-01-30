-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2019 at 03:31 PM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Id` int(3) NOT NULL,
  `productId` int(20) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `price` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `productId`, `Name`, `price`) VALUES
(1, 1, 'Margherita', 110),
(2, 1, 'Calzone', 120),
(3, 2, 'jain', 540),
(4, 2, 'chinese', 150),
(5, 3, 'burger cat 1', 140),
(6, 3, 'burger cat 4', 170),
(7, 9, 'batli', 20),
(8, 9, 'kothli', 10),
(9, 10, 'royal stag', 450),
(10, 10, 'jack danials', 740);

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

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `Id` int(3) NOT NULL,
  `TableId` int(2) NOT NULL,
  `GrossAmount` double NOT NULL,
  `DiscountP` double NOT NULL,
  `DiscountRs` double NOT NULL,
  `GSTP` double NOT NULL,
  `GSTRs` double NOT NULL,
  `TotalAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `livetableorders`
--

CREATE TABLE `livetableorders` (
  `Id` int(3) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TableId` int(3) NOT NULL,
  `productId` int(3) NOT NULL,
  `catId` int(20) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Pending` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livetableorders`
--

INSERT INTO `livetableorders` (`Id`, `time`, `TableId`, `productId`, `catId`, `Quantity`, `Pending`) VALUES
(1, '2019-01-30 13:21:00', 1, 1, 1, 2, 1),
(2, '2019-01-30 02:41:08', 1, 1, 2, 2, 1),
(3, '2019-01-30 13:10:00', 1, 6, 0, 0, 1),
(4, '2019-01-30 12:21:00', 1, 7, 0, 0, 1),
(5, '2019-01-30 13:21:00', 1, 8, 0, 0, 1),
(6, '2019-01-30 13:21:00', 2, 4, 0, 0, 1),
(7, '2019-01-30 13:21:00', 2, 9, 7, 5, 2),
(8, '2019-01-30 13:21:00', 3, 2, 2, 0, 1),
(9, '2019-01-30 13:21:00', 3, 10, 0, 0, 2),
(10, '2019-01-30 13:21:00', 4, 6, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(3) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `haveCat` tinyint(1) NOT NULL DEFAULT '0',
  `price` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `haveCat`, `price`) VALUES
(1, 'Pizza', 1, 0),
(2, 'Pav-Bhaji', 1, 0),
(3, 'Burger', 1, 0),
(4, 'Dabeli', 0, 0),
(5, 'VadaPav', 0, 0),
(6, 'Coke', 0, 0),
(7, 'Rum', 0, 0),
(8, 'Wine', 0, 0),
(9, 'Desi', 1, 0),
(10, 'Vilayati', 1, 0);

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
(1, '1', 5, 0),
(2, '2', 6, 1);

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
-- Indexes for table `livetableorders`
--
ALTER TABLE `livetableorders`
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
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livetableorders`
--
ALTER TABLE `livetableorders`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
