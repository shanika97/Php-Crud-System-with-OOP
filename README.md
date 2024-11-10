
    Server: 127.0.0.1 via TCP/IP
    Server type: MariaDB
    Server connection: SSL is not being used Documentation
    Server version: 10.4.32-MariaDB - mariadb.org binary distribution
    Protocol version: 10
    User: root@localhost
    Server charset: UTF-8 Unicode (utf8mb4)

Web server

    Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    Database client version: libmysql - mysqlnd 8.2.12
    PHP extension: mysqli Documentation curl Documentation mbstring Documentation
    PHP version: 8.2.12

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 11:41 AM
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
-- Database: `php_dev_shanika`
--

-- --------------------------------------------------------

--
-- Table structure for table `ds_division`
--

CREATE TABLE `ds_division` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ds_division`
--

INSERT INTO `ds_division` (`id`, `name`) VALUES
(1, 'Colombo 1'),
(2, 'Colombo 2'),
(3, 'Colombo 3'),
(4, 'Gampaha 1'),
(5, 'Kandy 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ds_division`
--
ALTER TABLE `ds_division`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ds_division`
--
ALTER TABLE `ds_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 11:41 AM
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
-- Database: `php_dev_shanika`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `summary` text DEFAULT NULL CHECK (`summary` = ucase(`summary`)),
  `dsDivisionId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Id`, `firstName`, `lastName`, `dateOfBirth`, `summary`, `dsDivisionId`) VALUES
(1, 'Shanika', 'Gamage', '1997-11-05', '', 4),
(2, 'Saman', 'Rupasinghe  ACCURA', '1980-11-10', 'Accura', 1),
(6, 'Wasana', 'weerasinghe ACCURA', '2024-11-29', 'accura', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_dsdivision` (`dsDivisionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_dsdivision` FOREIGN KEY (`dsDivisionId`) REFERENCES `ds_division` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
