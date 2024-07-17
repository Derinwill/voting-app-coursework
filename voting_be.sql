-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 06:43 PM
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
-- Database: `voting_be`
--
CREATE DATABASE 'voting_be'
-- --------------------------------------------------------

--
-- Table structure for table `election_date`
--

CREATE TABLE `election_date` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `userType` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phoneNumber` varchar(250) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `picture` varchar(1000) NOT NULL,
  `location` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `userType`, `password`, `phoneNumber`, `address`, `picture`, `location`) VALUES
(1, 'Obi', 'Uche', 'Ucheobikingsley@gmail.com', 'voter', '1234', '0812321212312', '1 bingo street', 'aaa.png', 'blackpool'),
(2, 'James', 'jimmy', 'jamesjimmy@gmail.com', 'election_officer', '1234', '12341', 'Molding street', '0148adf7997918cf71ea6d97d1448b65.png', ''),
(4, 'james maison', 'obi', 'obi@gmail.com', 'admin', '1234', '090294211111', '', 'nathan-forbes-58uZ3FW7FB4-unsplash 1.png', 'bristol'),
(5, 'maison', 'james', 'maisonjames@gmail.com', 'voter', '12345', '', '', '', 'blackpool');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `election_date`
--
ALTER TABLE `election_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `election_date`
--
ALTER TABLE `election_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
