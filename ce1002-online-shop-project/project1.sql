-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2013 at 10:13 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project1`
--
CREATE DATABASE IF NOT EXISTS `project1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project1`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `bookid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  `bookname` varchar(30) NOT NULL,
  `author` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `type`, `bookname`, `author`, `quantity`, `price`) VALUES
(1, 'Science Fiction', 'Allegiant( Divergent,#3)', 'Veronica Roth', 100, 25),
(2, 'Science Fiction', 'Shades of Earth', 'Beth Revis', 100, 28),
(3, 'Fantasy', 'The House of Hades', 'Rick Riordan', 100, 30),
(4, 'Romance', 'The Clockwork Princess', 'Cassandra Clare', 100, 25),
(5, 'Science Fiction', 'Insurgent ( Divergent #2)', 'Veronica Roth', 100, 35),
(6, 'Young Adult', 'City of Lost Souls', 'Cassandra Clare', 100, 42),
(7, 'Romance', 'Pandemonium (Delirium #3)', 'Lauren Oliver', 100, 24),
(8, 'Romance', 'Requiem (Delirium #2)', 'Lauren Oliver', 100, 30),
(9, 'Satire', 'Pride & Prejudice', 'Jane Austen', 100, 22),
(10, 'Autobiography', 'The Diary of Anne Frank', 'Anne Frank', 100, 32),
(11, 'Fiction', 'Wuthering Heights', 'Emily Bronte', 100, 30),
(12, 'Fiction', 'A Game of Thrones', 'George Martin', 100, 25),
(13, 'Fiction', 'Kane and Abel', 'Jeffrey Archer', 100, 30),
(14, 'Fiction', 'Only Time Will Tell', 'Jeffrey Archer', 100, 20),
(15, 'Science Fiction', 'The Hunger Games', 'Suzanne Collins', 100, 23),
(16, 'Fiction', 'A Prisoner Of Birth', 'Jeffrey Archer', 100, 30);

-- --------------------------------------------------------

--
-- Table structure for table `userbaskets`
--

CREATE TABLE IF NOT EXISTS `userbaskets` (
  `buyid` int(4) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `bookid` int(11) NOT NULL,
  `bookname` text NOT NULL,
  `author` text NOT NULL,
  `type` text NOT NULL,
  `quantity` int(3) NOT NULL,
  `totalprice` int(11) NOT NULL,
  PRIMARY KEY (`buyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` varchar(6) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `lasttime` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`username`, `password`, `type`, `firstname`, `lastname`, `phone`, `email`, `address`, `lasttime`) VALUES
('john001', 'abcd1234', 'normal', 'John', 'A.', 12345678, 'john@john.com', 'NTU', '09/11/2013 15:41:50'),
('admin', 'admin', 'admin', 'Bill', 'A', 123458960, 'admin@admin.com', 'NTU', '09/11/2013 10:22:11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
