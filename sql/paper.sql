-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2011 at 08:57 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `paper`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE IF NOT EXISTS `approval` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `reqid` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `manager` int(10) NOT NULL,
  `created` int(20) NOT NULL,
  `modified` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `reqid` int(20) NOT NULL AUTO_INCREMENT,
  `forename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(150) NOT NULL,
  `dor` int(20) NOT NULL,
  `doa` int(20) NOT NULL,
  `leavetype` int(10) NOT NULL,
  `information` longtext NOT NULL,
  PRIMARY KEY (`reqid`),
  UNIQUE KEY `reqid` (`reqid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;



--
-- Table structure for table `req_lesson`
--

CREATE TABLE IF NOT EXISTS `req_lesson` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reqid` int(10) NOT NULL,
  `lesson` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_group`
--

CREATE TABLE IF NOT EXISTS `s_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_leave`
--

CREATE TABLE IF NOT EXISTS `s_leave` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_lesson`
--

CREATE TABLE IF NOT EXISTS `s_lesson` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_manager`
--

CREATE TABLE IF NOT EXISTS `s_manager` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_office`
--

CREATE TABLE IF NOT EXISTS `s_office` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_user`
--

CREATE TABLE IF NOT EXISTS `s_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `forename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `initials` varchar(3) NOT NULL,
  `office` int(10) NOT NULL DEFAULT '0',
  `role` int(10) NOT NULL DEFAULT '0',
  `group` int(10) NOT NULL DEFAULT '0',
  `level` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
