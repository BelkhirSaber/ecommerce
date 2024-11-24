-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2024 at 09:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b3s_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_b3s_options`
--

CREATE TABLE `t_b3s_options` (
  `PK_OPTIONS` int(11) NOT NULL,
  `S_NAME_OPTION` varchar(255) NOT NULL,
  `S_VALUE_OPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_b3s_options`
--

INSERT INTO `t_b3s_options` (`PK_OPTIONS`, `S_NAME_OPTION`, `S_VALUE_OPTION`) VALUES
(1, 'sidebar_expand', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `t_b3s_product`
--

CREATE TABLE `t_b3s_product` (
  `PK_PRODUCT` int(11) NOT NULL,
  `FK_CATEGORY` int(11) NOT NULL,
  `FK_REVIEW` int(11) NOT NULL,
  `FK_PROMO_CODE` int(11) DEFAULT NULL,
  `SLUG` varchar(255) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `SHORT_DESCRIPTION` varchar(255) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `DISCOUNT` int(3) NOT NULL DEFAULT 0,
  `IN_STOCK` tinyint(1) NOT NULL DEFAULT 1,
  `SHOW_IN_STORE` tinyint(1) NOT NULL DEFAULT 1,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_b3s_settings`
--

CREATE TABLE `t_b3s_settings` (
  `PK_SETTINGS` int(11) NOT NULL,
  `S_STORE_NAME` varchar(50) NOT NULL,
  `S_STORE_LOGO` varchar(255) NOT NULL,
  `S_STORE_DESCRIPTION` mediumtext NOT NULL,
  `S_LANG` varchar(10) NOT NULL,
  `S_CURRENCY` varchar(10) NOT NULL,
  `I_TAX` int(3) NOT NULL,
  `S_EMAIL` varchar(100) NOT NULL,
  `S_PHONE1` varchar(15) NOT NULL,
  `S_PHONE2` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_b3s_user`
--

CREATE TABLE `t_b3s_user` (
  `PK_USER` int(11) NOT NULL,
  `S_FIRSTNAME` varchar(25) NOT NULL,
  `S_LASTNAME` varchar(25) NOT NULL,
  `S_EMAIL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_b3s_options`
--
ALTER TABLE `t_b3s_options`
  ADD PRIMARY KEY (`PK_OPTIONS`);

--
-- Indexes for table `t_b3s_product`
--
ALTER TABLE `t_b3s_product`
  ADD PRIMARY KEY (`PK_PRODUCT`);

--
-- Indexes for table `t_b3s_settings`
--
ALTER TABLE `t_b3s_settings`
  ADD PRIMARY KEY (`PK_SETTINGS`);

--
-- Indexes for table `t_b3s_user`
--
ALTER TABLE `t_b3s_user`
  ADD PRIMARY KEY (`PK_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_b3s_options`
--
ALTER TABLE `t_b3s_options`
  MODIFY `PK_OPTIONS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_b3s_product`
--
ALTER TABLE `t_b3s_product`
  MODIFY `PK_PRODUCT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_b3s_settings`
--
ALTER TABLE `t_b3s_settings`
  MODIFY `PK_SETTINGS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_b3s_user`
--
ALTER TABLE `t_b3s_user`
  MODIFY `PK_USER` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
