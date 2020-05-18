-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 12, 2020 at 04:05 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokemania`
--
CREATE DATABASE IF NOT EXISTS `pokemania` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pokemania`;

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

DROP TABLE IF EXISTS `owns`;
CREATE TABLE IF NOT EXISTS `owns` (
  `idO` int(11) NOT NULL,
  `idU` int(11) NOT NULL,
  `idP` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`idO`),
  KEY `owns_fk0` (`idU`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participates`
--

DROP TABLE IF EXISTS `participates`;
CREATE TABLE IF NOT EXISTS `participates` (
  `idT` int(11) NOT NULL,
  `idU` int(11) NOT NULL,
  `cntWin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idT`,`idU`),
  KEY `participates_fk1` (`idU`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

DROP TABLE IF EXISTS `registered`;
CREATE TABLE IF NOT EXISTS `registered` (
  `idT` int(11) NOT NULL,
  `idU` int(11) NOT NULL,
  PRIMARY KEY (`idT`,`idU`),
  KEY `registered_fk1` (`idU`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

DROP TABLE IF EXISTS `tournament`;
CREATE TABLE IF NOT EXISTS `tournament` (
  `idT` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `prize` int(11) NOT NULL,
  `minLevel` int(11) NOT NULL,
  `maxLevel` int(11) NOT NULL,
  `entryFee` int(11) NOT NULL,
  `endDate` datetime NOT NULL,
  PRIMARY KEY (`idT`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `bAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `cntBalls` int(11) NOT NULL DEFAULT '3',
  `cntCash` int(11) NOT NULL DEFAULT '500',
  `cntFruits` int(11) NOT NULL DEFAULT '0',
  `cntPokemons` int(11) NOT NULL DEFAULT '1',
  `trainer` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idU`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
