-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 12:40 PM
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
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

CREATE TABLE `consumer` (
  `demand_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `consumption_rate` enum('Low','Medium','High') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`demand_id`, `product_id`, `consumption_rate`) VALUES
(6, '101', 'Low'),
(7, '107', 'High'),
(8, '108', 'Medium'),
(9, '109', 'Low'),
(10, '110', 'Medium'),
(19, '112', 'High');

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `variety` varchar(100) NOT NULL,
  `seasionality` varchar(100) NOT NULL,
  `h_price` varchar(100) NOT NULL,
  `c_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `product_name`, `type`, `variety`, `seasionality`, `h_price`, `c_price`) VALUES
(16, 'Onions', 'Large', 'Indian', 'All', '250', '300'),
(20, 'Rice', 'Mini-Cut', 'Deshi', 'All', '158', '250'),
(22, 'Tomato', 'Red', 'Deshi', 'Winter', '20', '35'),
(23, 'Potato', 'Red', 'Pakistan', 'Winter', '120', '145'),
(28, 'Brinjal', 'Round', 'Bangladeshi', 'Winter', '120', '135'),
(31, 'Cucumber', 'Large', 'Deshi', 'All Time', '350', '550');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryschedule`
--

CREATE TABLE `deliveryschedule` (
  `id` int(11) NOT NULL,
  `logistic_name` varchar(255) NOT NULL,
  `remark` text DEFAULT NULL,
  `delivery_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryschedule`
--

INSERT INTO `deliveryschedule` (`id`, `logistic_name`, `remark`, `delivery_date`) VALUES
(2, 'PRAN', 'GOOD', '2024-12-02'),
(3, 'SUNDARBAN', 'GOOD', '2024-12-02'),
(9, 'STEADFAST', 'PERFECT', '2024-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `PrimaryID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `warehouseID` varchar(50) NOT NULL,
  `storage_quantity_kg` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`PrimaryID`, `name`, `warehouseID`, `storage_quantity_kg`) VALUES
(17, 'Potato', '404', 250.00),
(20, 'Rice', '405', 195.00),
(22, 'Wheat', '404', 50.00),
(25, 'Corn', '406', 145.00);

-- --------------------------------------------------------

--
-- Table structure for table `logistics`
--

CREATE TABLE `logistics` (
  `ProductID` int(11) NOT NULL,
  `LogisticID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logistics`
--

INSERT INTO `logistics` (`ProductID`, `LogisticID`, `name`, `delivery_date`) VALUES
(101, 1, 'Axis Cargo', '2024-12-02'),
(102, 2, 'Apex Cargo', '2024-12-20'),
(103, 3, 'True Path', '2024-12-29'),
(104, 4, 'Karim Cargo', '2024-12-04'),
(105, 5, 'Moto Auto', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(7) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `variety` varchar(20) NOT NULL,
  `seasonality` varchar(20) NOT NULL,
  `hprice` double NOT NULL,
  `pprice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `variety`, `seasonality`, `hprice`, `pprice`) VALUES
(228, 'tomato', 'red', 'indian', 'summer', 300, 20);

-- --------------------------------------------------------

--
-- Table structure for table `productiondata`
--

CREATE TABLE `productiondata` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `acreage` decimal(10,2) NOT NULL,
  `yield` decimal(10,2) NOT NULL,
  `cost_per_hectare` decimal(10,2) NOT NULL,
  `FSOfficeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productiondata`
--

INSERT INTO `productiondata` (`id`, `product_id`, `product_name`, `acreage`, `yield`, `cost_per_hectare`, `FSOfficeID`) VALUES
(27, 'P027', 'Onion', 3.00, 3.00, 3.00, NULL),
(29, 'P028', 'Garlics', 1.00, 11.00, 1.00, NULL),
(30, 'P030', 'Rice', 2.00, 2.00, 2.00, NULL),
(31, 'P031', 'Tomato', 11.00, 11.00, 22.00, NULL),
(36, 'P032', 'Corn', 120.00, 11.00, 123.00, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consumer`
--
ALTER TABLE `consumer`
  ADD PRIMARY KEY (`demand_id`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryschedule`
--
ALTER TABLE `deliveryschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`PrimaryID`);

--
-- Indexes for table `logistics`
--
ALTER TABLE `logistics`
  ADD PRIMARY KEY (`LogisticID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productiondata`
--
ALTER TABLE `productiondata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumer`
--
ALTER TABLE `consumer`
  MODIFY `demand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `deliveryschedule`
--
ALTER TABLE `deliveryschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `PrimaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `logistics`
--
ALTER TABLE `logistics`
  MODIFY `LogisticID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `productiondata`
--
ALTER TABLE `productiondata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
