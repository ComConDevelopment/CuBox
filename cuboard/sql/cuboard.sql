-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Apr 2014 um 16:46
-- Server Version: 5.6.14
-- PHP-Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `cuboard`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `cid` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `code` int(6) unsigned NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `control`
--

INSERT INTO `control` (`cid`, `name`, `status`, `code`) VALUES
(9, 'Badlicht', 0, 100012),
(10, 'Wohnzimmerlampe', 0, 100104);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'Jero', '81dc9bdb52d04dc20036dbd8313ed055');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
