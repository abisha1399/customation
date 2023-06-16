-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 14, 2022 at 10:43 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_networktheraphy`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_personal_drug`
--

DROP TABLE IF EXISTS `form_personal_drug`;
CREATE TABLE IF NOT EXISTS `form_personal_drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `encounter` int(11) NOT NULL,
  `date` date NOT NULL,
  `activity` int(11) NOT NULL,
  `stydu` varchar(250) NOT NULL,
  `main_id` int(11) NOT NULL,
  `main_date` date NOT NULL,
  `point` int(11) NOT NULL,
  `raid` varchar(250) NOT NULL,
  `drugpoint_1` int(11) NOT NULL,
  `drugpoint_2` int(11) NOT NULL,
  `drugpoint_3` int(11) NOT NULL,
  `drugpoint_4` int(11) NOT NULL,
  `drugpoint_5` int(11) NOT NULL,
  `drugpoint_6` int(11) NOT NULL,
  `drugpoint_7` int(11) NOT NULL,
  `drugpoint_8` int(11) NOT NULL,
  `drugpoint_9` int(11) NOT NULL,
  `drugpoint_10` int(11) NOT NULL,
  `drugpoint_11` int(11) NOT NULL,
  `drugpoint_12` int(11) NOT NULL,
  `drugpoint_13` int(11) NOT NULL,
  `drugpoint_14` int(11) NOT NULL,
  `drugpoint_15` int(11) NOT NULL,
  `drugpoint_16` int(11) NOT NULL,
  `drugpoint_17` int(11) NOT NULL,
  `drugpoint_18` int(11) NOT NULL,
  `drugpoint_19` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
