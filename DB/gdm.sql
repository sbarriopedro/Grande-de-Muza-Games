-- phpMyAdmin SQL DumpID
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Server: localhost:8889
-- Generation time: 13-01-2020 a las 17:12:00
-- Server Version: 5.5.42
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gdm`
--
CREATE DATABASE IF NOT EXISTS `gdm` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gdm`;

-- --------------------------------------------------------

--
-- Structure for `games` table
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `gameID` tinyint(3) unsigned NOT NULL,
  `gameName` varchar(100) NOT NULL COMMENT 'Game name',
  `gameDesc` varchar(500) NOT NULL COMMENT 'Game description',
  `gamePublish` char(4) NOT NULL COMMENT 'Yes/No option to publish the game',
  `gameRoute` varchar(255) NOT NULL COMMENT 'The route where the game is located'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Structure for `users` table (only admin needed for now)
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	`userID` tinyint(5) unsigned NOT NULL,
    `userName` varchar(50) NOT NULL COMMENT 'Username',
    `userPass` varchar(50) NOT NULL COMMENT 'Hashed password',
    `userLevel` tinyint(1) NOT NULL COMMENT 'User admission level. 1 = admin, 2 = normal user, etc'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Inserts in 'users' table
--

INSERT INTO `users` (`userID`, `userName`, `userPass`,`userLevel`) VALUES
(1, 'admin', 'admin', 1),
(2, 'user', 'user', 2);

-- Index for tables
--
--
-- Index for 'games' table
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameID`);
--
-- Index for 'users' table
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);
--
-- AUTO_INCREMENT of tables
--
--
-- AUTO_INCREMENT of 'games' table
--
ALTER TABLE `games`
  MODIFY `gameID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT of 'users' table
--
ALTER TABLE `users`
  MODIFY `userID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;