-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2024 at 12:55 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mathartdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(4) NOT NULL,
  `userID` int(4) NOT NULL,
  `bookingDate` date NOT NULL,
  `numberOfGuests` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `userID`, `bookingDate`, `numberOfGuests`) VALUES
(1, 1, '2024-02-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(4) NOT NULL,
  `UserID` int(20) NOT NULL,
  `TotalCost` float NOT NULL,
  `Date` date NOT NULL,
  `Processed` varchar(256) DEFAULT NULL COMMENT 'unprocessed OR processed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `TotalCost`, `Date`, `Processed`) VALUES
(4, 1, 0, '2024-02-22', 'processed'),
(6, 1, 0, '2024-02-28', 'processed'),
(7, 1, 0, '2024-02-28', 'processed'),
(8, 1, 0, '2024-02-28', 'processed'),
(9, 1, 0, '2024-02-28', 'unprocessed'),
(10, 8, 0, '2024-02-28', 'processed'),
(11, 8, 0, '2024-02-28', 'unprocessed'),
(12, 8, 0, '2024-02-28', 'processed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(4) NOT NULL,
  `productTitle` varchar(100) NOT NULL,
  `productImageLink` varchar(256) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `productCost` float NOT NULL,
  `stock` int(4) NOT NULL,
  `releaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productTitle`, `productImageLink`, `description`, `productCost`, `stock`, `releaseDate`) VALUES
(1, 'Product 1', './assets/product-assets/dodecagonalLoop.jpg', 'This is the first product!', 200, 1, '2024-01-01'),
(2, 'Product 2', './assets/product-assets/dragonCurve.jpg', 'This is the second product.', 150.5, 3, '2024-01-01'),
(3, 'Product 3', './assets/product-assets/mathematicalConcepts.jpg', 'This is the 3rd product', 49.99, 2, '2024-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SaleID` int(4) NOT NULL,
  `OrderID` int(4) NOT NULL,
  `ProductID` int(4) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SaleID`, `OrderID`, `ProductID`, `Quantity`, `Subtotal`) VALUES
(6, 6, 3, 1, '50'),
(7, 6, 3, 1, '50'),
(9, 4, 3, 1, '50'),
(10, 4, 2, 1, '151'),
(11, 8, 1, 1, '200'),
(12, 8, 2, 1, '151'),
(13, 8, 3, 1, '50'),
(14, 10, 3, 1, '50'),
(15, 10, 3, 1, '50');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `userID` int(4) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(225) DEFAULT '',
  `email` varchar(64) DEFAULT NULL,
  `firstName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'John',
  `lastName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'doe',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`userID`, `username`, `password`, `email`, `firstName`, `lastName`, `isAdmin`) VALUES
(1, 'slay', '$2y$10$VIGOOUxaeoNW6pcZMZ7t8.eUDn1Onl4i9ecs9vO88MEqYgw.M3NvO', 'shennyboi06@mathart.com', 'Sean', 'Lay', 1),
(8, 'angelom21', '$2y$10$Y7wpKE8QTXqZ0Dyedr5hI.qcU3ZN/ujaNInGqXQlGHoMjkj8cl3im', 'Angelom21@mathart.uk', 'Michael', 'Angelo', 0),
(10, 'Siva', '$2y$10$uC9vJumL7fSqs7KqwIRgJeeYa6BSJNph6E7pwJVpBvB2ox95GEVA6', 'Siva@Siva.com', 'Siva', 'Siva', 0),
(11, 'Bananas', '$2y$10$Sv9qPwOqQHnp9XpIftKvCO.tLmWgExlSbyX73TUFcjvykzoWZ4dQO', 'Bananas@gmail.com', 'Yash', 'Singh', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `FOREIGN` (`userID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `OrderID` (`OrderID`),
  ADD KEY `Foreign User ID` (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SaleID`),
  ADD KEY `foreignOrder-ProductID` (`OrderID`,`ProductID`),
  ADD KEY `productID` (`ProductID`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SaleID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `useraccounts` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
