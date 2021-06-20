-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2021 at 07:52 AM
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
  `phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `lastName`, `email`, `phone`) VALUES
(1, 'John', 'Due', 'john.due@mail.com', '123456789'),
(2, 'Samuel', 'Jackson', 'samuel.jackson@mail.com', '112341232'),
(3, 'John', 'Smit', 'john.smith@mail.com', '23456789'),
(4, 'Jane', 'Due', 'jane.due@mail.com', '98765432'),
(5, 'Bruno', 'Diaz', 'bruno.diaz@mail.com', '1234567891'),
(6, 'Jose', 'Perez', 'jose.perez@mail.com', NULL),
(7, 'Fulano', 'Merengano', 'fulano.merengano@mail.com', NULL),
(8, 'Baby', 'Due', 'baby.due@mail.com', NULL),
(9, 'Juana', 'Perez', 'juana.perez@mail.com', NULL),
(10, 'Emiliano', 'Gonzalez', 'emiliano.gonzalez@mail.com', NULL),
(11, 'Steve', 'Jobs', 'steve.jobs@mail.com', NULL),
(12, 'Bill', 'Gates', 'bill.gates@mail.com', '1213456666');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
