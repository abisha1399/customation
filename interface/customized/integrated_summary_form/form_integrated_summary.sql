-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 19, 2022 at 04:37 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `network_therapy`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_integrated_summary`
--

DROP TABLE IF EXISTS `form_integrated_summary`;
CREATE TABLE IF NOT EXISTS `form_integrated_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `encounter` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `activity` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `integrated1` varchar(50) DEFAULT NULL,
  `integrated2` varchar(50) DEFAULT NULL,
  `integrated3` varchar(50) DEFAULT NULL,
  `integrated4` varchar(50) DEFAULT NULL,
  `integrated5` varchar(50) DEFAULT NULL,
  `integrated6` varchar(50) DEFAULT NULL,
  `integrated7` varchar(50) DEFAULT NULL,
  `integrated8` varchar(50) DEFAULT NULL,
  `integrated9` varchar(50) DEFAULT NULL,
  `integrated10` varchar(50) DEFAULT NULL,
  `integrated11` varchar(50) DEFAULT NULL,
  `integrated12` varchar(50) DEFAULT NULL,
  `integrated13` varchar(50) DEFAULT NULL,
  `integrated14` varchar(50) DEFAULT NULL,
  `integrated15` varchar(50) DEFAULT NULL,
  `integrated16` varchar(50) DEFAULT NULL,
  `integrated17` varchar(50) DEFAULT NULL,
  `integrated18` varchar(50) DEFAULT NULL,
  `integrated19` varchar(50) DEFAULT NULL,
  `integrated20` varchar(50) DEFAULT NULL,
  `integrated21` varchar(50) DEFAULT NULL,
  `integrated22` varchar(50) DEFAULT NULL,
  `integrated23` varchar(50) DEFAULT NULL,
  `integrated24` varchar(50) DEFAULT NULL,
  `integrated_date` varchar(20) DEFAULT NULL,
  `text1` text DEFAULT NULL,
  `text2` text DEFAULT NULL,
  `text3` text DEFAULT NULL,
  `text4` text DEFAULT NULL,
  `text5` text DEFAULT NULL,
  `text6` text DEFAULT NULL,
  `text7` text DEFAULT NULL,
  `text8` text DEFAULT NULL,
  `text9` text DEFAULT NULL,
  `text10` text DEFAULT NULL,
  `text11` text DEFAULT NULL,
  `text12` text DEFAULT NULL,
  `text13` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_integrated_summary`
--

INSERT IGNORE INTO `form_integrated_summary` (`id`, `pid`, `encounter`, `user`, `date`, `activity`, `first_name`, `last_name`, `integrated1`, `integrated2`, `integrated3`, `integrated4`, `integrated5`, `integrated6`, `integrated7`, `integrated8`, `integrated9`, `integrated10`, `integrated11`, `integrated12`, `integrated13`, `integrated14`, `integrated15`, `integrated16`, `integrated17`, `integrated18`, `integrated19`, `integrated20`, `integrated21`, `integrated22`, `integrated23`, `integrated24`, `integrated_date`) VALUES
(1, 7, 31, 'admin', '2022-09-17', 1, 'boomi', '', 'dfgd', '', 'dsfg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 7, 31, 'admin', '2022-09-19', 1, 'xcv', 'xcv', 'xcv', 'xcv', 'xcv', 'xcv', 'xcv', 'sdfg', 'xc', 'xcv', 'xcv', 'xcv', 'xcv', 'xcv', 'xcv', 'xc', 'xcv', 'xcv', 'xcv', 'xc', 'cxv', 'xcv', 'xcv', 'xc', 'xcv', 'cxv', '2022-09-20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
