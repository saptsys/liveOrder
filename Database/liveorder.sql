-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2019 at 01:58 PM
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
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Name`) VALUES
(1, 'Pizza'),
(2, 'Burger'),
(3, 'Kathiyavadi'),
(4, 'Coke'),
(5, 'Wine'),
(6, 'Desi'),
(7, 'Punjabi'),
(8, 'Chinese'),
(9, 'Ice-cremes'),
(10, 'Dosa');

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
  `TableId` int(3) NOT NULL,
  `ProductId` int(3) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Pending` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livetableorders`
--

INSERT INTO `livetableorders` (`Id`, `TableId`, `ProductId`, `Quantity`, `Pending`) VALUES
(1, 1, 1, 2, 1),
(2, 1, 2, 2, 2),
(3, 2, 3, 2, 1),
(4, 2, 4, 2, 2),
(5, 3, 5, 2, 3),
(6, 3, 6, 2, 1),
(7, 4, 7, 2, 2),
(8, 4, 8, 2, 2),
(9, 5, 9, 2, 3),
(10, 5, 10, 2, 1),
(12, 1, 1, 2, 2),
(13, 1, 2, 2, 1),
(14, 2, 3, 2, 3),
(15, 2, 4, 2, 4),
(16, 3, 5, 2, 3),
(17, 3, 6, 2, 0),
(18, 4, 7, 2, 3),
(19, 4, 8, 2, 3),
(20, 5, 9, 2, 3),
(21, 5, 10, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(3) NOT NULL,
  `CatId` int(3) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `CatId`, `Name`, `Price`) VALUES
(1, 1, 'margerita', 120),
(2, 1, 'mozzarella', 140),
(3, 2, 'chinese', 120),
(4, 2, 'indian', 120),
(5, 3, 'Kadhi', 1200),
(6, 3, 'Khichdi', 1204),
(7, 4, 'zero', 12),
(8, 4, 'red', 15),
(9, 5, 'Riesling', 124),
(10, 5, 'Chardonnay', 129),
(11, 6, 'batli', 20),
(12, 6, 'kothli', 30),
(13, 7, 'paneer tika', 120),
(14, 7, 'kaju kari', 160),
(15, 8, 'manchurian', 120),
(16, 8, 'Chowmein soup', 15),
(17, 9, 'vanilla', 120),
(18, 9, 'rajbhog', 120),
(19, 10, 'paper dosa', 120),
(20, 10, 'masala dosa', 120);

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
(2, '2', 6, 0),
(3, '3', 5, 0),
(4, '4', 6, 0),
(5, '5', 6, 0);

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
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
