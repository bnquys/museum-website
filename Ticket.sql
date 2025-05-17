-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2025 at 03:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `museum`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ticket`
--

CREATE TABLE `Ticket` (
  `Id` varchar(20) NOT NULL,
  `Name` text DEFAULT NULL,
  `Price` float DEFAULT 0,
  `Description` text DEFAULT NULL,
  `IsShow` tinyint(1) DEFAULT 1,
  `DisplayOrder` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Ticket`
--

INSERT INTO `Ticket` (`Id`, `Name`, `Price`, `Description`, `IsShow`, `DisplayOrder`) VALUES
('TK001', 'Adult Ticket', 15, 'Standard adult admission', 1, 0),
('TK002', 'Child Ticket', 7.5, 'Admission for children under 12', 1, 1),
('TK003', 'Senior Ticket', 10, 'Discounted ticket for seniors aged 65 and above', 1, 2),
('TK004', 'Student Ticket', 9, 'Admission for students with valid ID', 1, 3),
('TK005', 'Family Package', 32, '2 adults + 2 children combo deal', 1, 4),
('TK006', 'Group Ticket', 12, 'Discounted rate for groups of 10 or more', 1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ticket`
--
ALTER TABLE `Ticket`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
