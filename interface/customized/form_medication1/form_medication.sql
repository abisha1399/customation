-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 03, 2021 at 01:09 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nt_theraphy`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_medication`
--

DROP TABLE IF EXISTS `form_medication`;
CREATE TABLE IF NOT EXISTS `form_medication` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `encounter` int(10) NOT NULL,
  `input1` varchar(150) NOT NULL,
  `input2` varchar(150) NOT NULL,
  `input3` varchar(150) NOT NULL,
  `input4` varchar(150) NOT NULL,
  `input5` varchar(150) NOT NULL,
  `input6` varchar(150) NOT NULL,
  `input7` varchar(150) NOT NULL,
  `input8` varchar(150) NOT NULL,
  `input9` varchar(150) NOT NULL,
  `input10` varchar(150) NOT NULL,
  `input11` varchar(150) NOT NULL,
  `input12` varchar(150) NOT NULL,
  `input13` varchar(150) NOT NULL,
  `input14` varchar(150) NOT NULL,
  `input15` varchar(150) NOT NULL,
  `input16` varchar(150) NOT NULL,
  `input17` varchar(150) NOT NULL,
  `input18` varchar(150) NOT NULL,
  `input19` varchar(150) NOT NULL,
  `input20` varchar(150) NOT NULL,
  `input21` varchar(150) NOT NULL,
  `input22` varchar(150) NOT NULL,
  `input23` varchar(150) NOT NULL,
  `input24` varchar(150) NOT NULL,
  `input25` varchar(150) NOT NULL,
  `input26` varchar(150) NOT NULL,
  `input27` varchar(150) NOT NULL,
  `input28` varchar(150) NOT NULL,
  `input29` varchar(150) NOT NULL,
  `input30` varchar(150) NOT NULL,
  `input31` varchar(150) NOT NULL,
  `input32` varchar(150) NOT NULL,
  `input33` varchar(150) NOT NULL,
  `input34` varchar(150) NOT NULL,
  `input35` varchar(150) NOT NULL,
  `input36` varchar(150) NOT NULL,
  `input37` varchar(150) NOT NULL,
  `input38` varchar(150) NOT NULL,
  `input39` varchar(150) NOT NULL,
  `input40` varchar(150) NOT NULL,
  `input41` varchar(150) NOT NULL,
  `input42` varchar(150) NOT NULL,
  `input43` varchar(150) NOT NULL,
  `input44` varchar(150) NOT NULL,
  `input45` varchar(150) NOT NULL,
  `input46` varchar(150) NOT NULL,
  `input47` varchar(150) NOT NULL,
  `input48` varchar(150) NOT NULL,
  `input49` varchar(150) NOT NULL,
  `input50` varchar(150) NOT NULL,
  `input51` varchar(150) NOT NULL,
  `input52` varchar(150) NOT NULL,
  `input53` varchar(150) NOT NULL,
  `input54` varchar(150) NOT NULL,
  `input55` varchar(150) NOT NULL,
  `input56` varchar(150) NOT NULL,
  `input57` varchar(150) NOT NULL,
  `input58` varchar(150) NOT NULL,
  `input59` varchar(150) NOT NULL,
  `input60` varchar(150) NOT NULL,
  `input61` varchar(150) NOT NULL,
  `input62` varchar(150) NOT NULL,
  `input63` varchar(150) NOT NULL,
  `input64` varchar(150) NOT NULL,
  `input65` varchar(150) NOT NULL,
  `input66` varchar(150) NOT NULL,
  `input67` varchar(150) NOT NULL,
  `input68` varchar(150) NOT NULL,
  `input69` varchar(150) NOT NULL,
  `input70` varchar(150) NOT NULL,
  `input71` varchar(150) NOT NULL,
  `input72` varchar(150) NOT NULL,
  `input73` varchar(150) NOT NULL,
  `input74` varchar(150) NOT NULL,
  `input75` varchar(150) NOT NULL,
  `input76` varchar(150) NOT NULL,
  `input77` varchar(150) NOT NULL,
  `input78` varchar(150) NOT NULL,
  `input79` varchar(150) NOT NULL,
  `input80` varchar(150) NOT NULL,
  `input81` varchar(150) NOT NULL,
  `input82` varchar(150) NOT NULL,
  `input83` varchar(150) NOT NULL,
  `input84` varchar(150) NOT NULL,
  `input85` varchar(150) NOT NULL,
  `input86` varchar(150) NOT NULL,
  `input87` varchar(150) NOT NULL,
  `input88` varchar(150) NOT NULL,
  `input89` varchar(150) NOT NULL,
  `input90` varchar(150) NOT NULL,
  `input91` varchar(150) NOT NULL,
  `input92` varchar(150) NOT NULL,
  `input93` varchar(150) NOT NULL,
  `input94` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
