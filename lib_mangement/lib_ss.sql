-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2015 at 09:13 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lib_ss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_name` varchar(50) NOT NULL,
  `admin_pass` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_name`, `admin_pass`) VALUES
('admin', 'shsagor');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `ref_number` varchar(15) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_writers` varchar(255) NOT NULL,
  `book_edition` varchar(5) NOT NULL,
  `book_isbn` varchar(30) DEFAULT NULL,
  `book_avail` int(3) NOT NULL,
  `ebook_link` varchar(255) DEFAULT NULL,
  `browed_to` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ref_number`, `book_name`, `book_writers`, `book_edition`, `book_isbn`, `book_avail`, `ebook_link`, `browed_to`) VALUES
('001', 'The Godfather', 'Mario Pujo', '1st', '4254562452', 3, 'not available', '11227047'),
('002', 'The da Vinci Code', 'Dan Brown', '33rd', '1231234345889', 10, 'www.mediafire.com/flhvojhbojfhvfc', '11227046'),
('123325445', 'Lost Island', 'Am', '123', '23453485', 4, NULL, NULL),
('132234', 'The Lost Symbol', 'Dan Brown', '12', '1233567', 5, NULL, NULL),
('24325', 'Inferno', 'Dan Brown', '12', '432576878', 6, NULL, '12324');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE IF NOT EXISTS `login_details` (
  `id` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `access_level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `password`, `access_level`) VALUES
('11227048', '11227048', 2),
('librarian', 'librarian', 1),
('shsagor', 'shsagor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE IF NOT EXISTS `officials` (
  `off_id` int(8) NOT NULL,
  `off_name` varchar(50) NOT NULL,
  `off_dob` date NOT NULL,
  `off_desig` varchar(50) NOT NULL,
  `off_mob` varchar(11) NOT NULL,
  `off_mail` varchar(50) NOT NULL,
  `off_pass` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`off_id`, `off_name`, `off_dob`, `off_desig`, `off_mob`, `off_mail`, `off_pass`) VALUES
(0, 'adag', '1966-09-09', 'dhdgh', '098079t', 'sa@dfh.com', 'asfagdgfdg'),
(11, 'A name', '1980-12-13', 'Librarian', '01987654321', 'aname@domain.com', 'asdflkjh'),
(12313, 'c name', '1976-09-09', 'Libb', '098765756', 'axd@gfs.com', 'asdfasdf'),
(123123, 'B name', '1976-09-09', 'Lb', '0989789687', 'asda@sdfg.com', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `std_id` int(8) NOT NULL,
  `std_name` varchar(50) NOT NULL,
  `std_dob` date NOT NULL,
  `std_prog` varchar(10) NOT NULL,
  `std_batch` varchar(5) NOT NULL,
  `std_mob` varchar(11) NOT NULL,
  `std_mail` varchar(50) NOT NULL,
  `std_pass` varchar(16) NOT NULL,
  `book_browed` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`std_id`, `std_name`, `std_dob`, `std_prog`, `std_batch`, `std_mob`, `std_mail`, `std_pass`, `book_browed`) VALUES
(11227048, 'Shaharul Hossain', '1992-05-31', 'BCSE', '27th', '01923376233', 'sagor.city@gmail.com', '11227048', '11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_name`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ref_number`), ADD UNIQUE KEY `ebook_link` (`ebook_link`), ADD UNIQUE KEY `book_isbn` (`book_isbn`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`off_id`), ADD UNIQUE KEY `off_mail` (`off_mail`), ADD UNIQUE KEY `off_mob` (`off_mob`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`std_id`), ADD UNIQUE KEY `std_mob` (`std_mob`), ADD UNIQUE KEY `std_mail` (`std_mail`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
