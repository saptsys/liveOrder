@@ -0,0 +1,227 @@
-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2019 at 11:35 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `Id` int(3) NOT NULL,
  `Name` varchar(10) DEFAULT NULL,
  `Capacity` int(2) DEFAULT NULL,
  `IsOccupied` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(2) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Role` enum('Waiter','Chef','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Username`, `Password`, `Role`) VALUES
(1, 'tony', 'stark', 'tonystark', 'tonystark', 'Waiter'),
(2, 'bat', 'man', 'batman', 'batman', 'Chef'),
(3, 'super', 'man', 'superman', 'superman', 'Admin');

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
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

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
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;