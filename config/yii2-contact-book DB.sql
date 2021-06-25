-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2021 at 01:07 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2-contact-book`
--
DROP DATABASE IF EXISTS `yii2-contact-book`;
CREATE DATABASE IF NOT EXISTS `yii2-contact-book` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `yii2-contact-book`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lastName` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `lastName`) VALUES
(1, 'John', 'Due'),
(2, 'Samuel', 'Jackson'),
(3, 'John', 'Smit'),
(4, 'Jane', 'Due'),
(5, 'Bruno', 'Diaz'),
(6, 'Jose', 'Perez'),
(7, 'Fulano', 'Merengano'),
(9, 'Juana', 'Perez'),
(10, 'Emiliano', 'Gonzalez'),
(11, 'Steve', 'Jobs'),
(12, 'Bill', 'Gates'),
(17, 'Daniel Edited', 'Viveros'),
(18, 'Test', 'Testtt'),
(19, 'Jose Gilberto', 'Perez Molina'),
(20, 'Sor Juana', 'Ines'),
(22, 'Temp', 'Temp'),
(26, 'Mr', 'Gates');

-- --------------------------------------------------------

--
-- Table structure for table `emailContact`
--

DROP TABLE IF EXISTS `emailContact`;
CREATE TABLE `emailContact` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emailContact`
--

INSERT INTO `emailContact` (`id`, `email`, `type_id`, `contact_id`) VALUES
(22, 'bill.gates@mail.com', 2, 12),
(23, 'daniel.gates@mail.com', 4, 17),
(24, 'gaming.test@mail.com', 4, 17),
(25, 'gaming.tes3t@mail.com', 4, 17),
(26, 'daniel.gatesd@mail.com', 4, 17),
(27, 'gilberto.perez@mail.com', 4, 19),
(28, 'dviveros90@gmail.com', 4, 19),
(29, 'sor.juana@mail.com', 2, 20),
(32, 'bxill.gates@mail.com', 4, 26);

-- --------------------------------------------------------

--
-- Table structure for table `phoneContact`
--

DROP TABLE IF EXISTS `phoneContact`;
CREATE TABLE `phoneContact` (
  `id` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `type_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phoneContact`
--

INSERT INTO `phoneContact` (`id`, `phone`, `type_id`, `contact_id`) VALUES
(1, '9981158175', 2, 17),
(2, '9988938651', 1, 17),
(3, '19981158175', 4, 19),
(4, '19981158175', 4, 20),
(5, '9981158175', 4, 22),
(7, '1234567891', 4, 26);

-- --------------------------------------------------------

--
-- Table structure for table `typeInput`
--

DROP TABLE IF EXISTS `typeInput`;
CREATE TABLE `typeInput` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `typeInput`
--

INSERT INTO `typeInput` (`id`, `name`) VALUES
(4, 'Gaming'),
(1, 'Home'),
(2, 'Personal'),
(3, 'Work');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailContact`
--
ALTER TABLE `emailContact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_TypeInput_id_EmailContact` (`type_id`),
  ADD KEY `fk_Contact_id_EmailContact` (`contact_id`);

--
-- Indexes for table `phoneContact`
--
ALTER TABLE `phoneContact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_TypeInput_id` (`type_id`),
  ADD KEY `fk_Contact_id` (`contact_id`);

--
-- Indexes for table `typeInput`
--
ALTER TABLE `typeInput`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `emailContact`
--
ALTER TABLE `emailContact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `phoneContact`
--
ALTER TABLE `phoneContact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `typeInput`
--
ALTER TABLE `typeInput`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emailContact`
--
ALTER TABLE `emailContact`
  ADD CONSTRAINT `fk_Contact_id_EmailContact` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TypeInput_id_EmailContact` FOREIGN KEY (`type_id`) REFERENCES `typeInput` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phoneContact`
--
ALTER TABLE `phoneContact`
  ADD CONSTRAINT `fk_Contact_id` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TypeInput_id` FOREIGN KEY (`type_id`) REFERENCES `typeInput` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
