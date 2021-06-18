-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2021 at 09:14 PM
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
  `lastName` varchar(40) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `lastName`, `email`, `phone`, `status`) VALUES
(1, 'John', 'Due', 'john.due@mail.com', '123456789', 0),
(2, 'Samuel', 'Jackson', 'samuel.jackson@mail.com', '112341232', 1),
(3, 'John', 'Smit', 'john.smith@mail.com', '23456789', 1),
(4, 'Jane', 'Due', 'jane.due@mail.com', '98765432', 1),
(5, 'Bruno', 'Diaz', 'bruno.diaz@mail.com', NULL, 1),
(6, 'Jose', 'Perez', 'jose.perez@mail.com', NULL, 1),
(7, 'Fulano', 'Merengano', 'fulano.merengano@mail.com', NULL, 1),
(8, 'Baby', 'Due', 'baby.due@mail.com', NULL, 1),
(9, 'Juana', 'Perez', 'juana.perez@mail.com', NULL, 1),
(10, 'Emiliano', 'Gonzalez', 'emiliano.gonzalez@mail.com', NULL, 1),
(11, 'Steve', 'Jobs', 'steve.jobs@mail.com', NULL, 0),
(12, 'Bill', 'Gates', 'bill.gates@mail.com', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
