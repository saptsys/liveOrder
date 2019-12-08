-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2019 at 04:21 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8558475_liveorder`
--
--CREATE DATABASE IF NOT EXISTS `liveorder` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
--USE `liveorder`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `categories`
--

TRUNCATE TABLE `categories`;
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Name`) VALUES
(8, 'Chinees'),
(14, 'Drink Soda'),
(15, 'Amarican'),
(16, 'Pizza'),
(17, 'Gujarati'),
(18, 'Panjabi'),
(19, 'Kathiyawadi'),
(20, 'Garlic'),
(21, 'South Indian');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitems`
--

CREATE TABLE IF NOT EXISTS `invoiceitems` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `InvoiceId` int(3) NOT NULL,
  `ProductId` int(3) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Rate` double NOT NULL,
  `Amount` double NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `invoiceitems`
--

TRUNCATE TABLE `invoiceitems`;
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
(121, 11, 8, 3, 105, 315),
(122, 12, 11, 2, 70, 140),
(123, 12, 12, 1, 85, 85),
(124, 12, 16, 1, 150, 150),
(125, 12, 34, 2, 35, 70),
(126, 12, 35, 2, 99, 198);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Time` timestamp NOT NULL DEFAULT current_timestamp(),
  `TableId` int(2) NOT NULL,
  `GrossAmount` double NOT NULL,
  `GSTP` double NOT NULL,
  `GSTRs` double NOT NULL,
  `TotalAmount` double NOT NULL,
  `Waiter` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `invoices`
--

TRUNCATE TABLE `invoices`;
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
(11, '2019-09-05 04:30:48', 1, 490, 18, 88.2, 578.2, 'tonystark'),
(12, '2019-12-08 15:33:07', 6, 643, 18, 115.74, 758.74, 'tonystark');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen`
--

CREATE TABLE IF NOT EXISTS `kitchen` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TableId` int(3) NOT NULL,
  `ProductId` int(3) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Pending` int(2) NOT NULL,
  `isReady` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `kitchen`
--

TRUNCATE TABLE `kitchen`;
-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `CatId` int(3) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` double NOT NULL,
  `IsAvailable` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `products`
--

TRUNCATE TABLE `products`;
--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `CatId`, `Name`, `Price`, `IsAvailable`) VALUES
(30, 8, 'Olive Oil', 56, '1'),
(31, 8, 'Chees', 70, '1'),
(32, 8, 'Oil', 85, '1'),
(33, 8, 'Bread', 80, '1'),
(56, 14, 'Cock', 15, '1'),
(57, 14, 'Thumbsup', 17, '1'),
(58, 14, 'Sprite', 20, '1'),
(59, 14, 'Maza', 20, '1'),
(60, 14, 'Fanta', 20, '1'),
(61, 15, 'Burger', 35, '1'),
(62, 15, 'Paubhaji', 99, '1'),
(63, 16, 'Peppy Paneer', 35, '1'),
(64, 16, 'Margherita', 55, '1'),
(65, 16, 'Deluxe Veggie', 105, '1'),
(66, 17, 'Dhokla', 40, '1'),
(67, 17, 'Gujarati Samosa', 75, '1'),
(68, 17, 'Undhiyu', 80, '1'),
(69, 17, 'Aam Shrikhand with Mango Salad', 150, '1'),
(70, 17, 'Patra', 70, '1'),
(71, 18, 'Dal Makhani', 30, '1'),
(72, 18, 'Dhaba Dal', 15, '1'),
(73, 18, 'Paneer Tikka', 45, '1'),
(74, 19, 'Thepla', 85, '1'),
(75, 19, 'Khandvi', 20, '1'),
(76, 19, 'Fafda-Jalebi', 80, '1'),
(77, 19, 'Kachori', 35, '1'),
(78, 20, 'Cheese', 70, '1'),
(79, 20, 'Oil', 85, '1'),
(80, 20, 'Bread', 80, '1'),
(81, 20, 'Double Chees', 150, '1'),
(82, 21, 'Dosa', 90, '1'),
(83, 21, 'Mendu Wada', 50, '1'),
(84, 21, 'Dal wada', 60, '1'),
(85, 21, 'Idli sambar', 50, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) DEFAULT NULL,
  `Capacity` int(2) DEFAULT NULL,
  `IsOccupied` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `tables`
--

TRUNCATE TABLE `tables`;
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

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(2) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Waiter','Chef','Admin') NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Username`, `Password`, `Role`) VALUES
(1, 'tony', 'stark', 'tonystark', '9c16b045a32525f294494e95b3bc44ba36016c8e', 'Waiter'),
(2, 'bat', 'man', 'batman', '48e7a6364bdfa17a1d8627f043347e293abfc271', 'Chef'),
(3, 'super', 'man', 'superman', '25564cc3fe5b4cf47f1eba6029e58067290ee03d', 'Admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
