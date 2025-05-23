-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2023 at 02:51 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21534139_finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `policynum` int(11) NOT NULL,
  `policyname` varchar(50) NOT NULL,
  `count` int(1) NOT NULL,
  `response` varchar(100) NOT NULL,
  `totalStudent` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policynum`, `policyname`, `count`, `response`, `totalStudent`) VALUES
(3, 'Absent', 3, 'Upload JPG File', 0),
(4, 'Use of Mobile Phones', 1, 'Construct Explanatory Letter', 0),
(5, 'No ID inside of Class', 1, 'Construct Explanatory Letter', 0),
(6, 'Accessing social networking site', 1, 'Construct Explanatory Letter', 0),
(7, 'Wearing Caps', 1, 'Construct Explanatory Letter', 0),
(8, 'Tardiness', 3, 'Upload JPG File', 0);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `violation_id` int(11) DEFAULT NULL,
  `jpg` longblob DEFAULT NULL,
  `paragraph` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`violation_id`, `jpg`, `paragraph`) VALUES
(3, NULL, 'Sorry for all the things I have done'),
(5, NULL, 'dsadsa'),
(4, NULL, 'dasdsad'),
(10, NULL, 'Sorry'),
(17, NULL, 'Forgot my ID'),
(18, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(18, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(18, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(22, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(21, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(27, NULL, ''),
(34, NULL, 'Forgot my ID'),
(37, NULL, 'Forgot my ID'),
(31, NULL, 'Forgot my ID'),
(28, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(35, NULL, ''),
(45, NULL, ''),
(42, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(39, 0x3430303734393434385f313038323535363537393432393639385f313338363432353539303534323039303230335f6e2e6a7067, NULL),
(46, NULL, ''),
(47, NULL, ''),
(48, NULL, ''),
(50, 0x52656769737465722e706870, NULL),
(49, NULL, ''),
(53, 0x47726f75702034202d2046696e616c73204c61622045786572636973652031302e706466, NULL),
(59, NULL, ''),
(60, NULL, 'sorry'),
(56, 0x46696e616c73204c61622045786572636973652031302e646f6378, NULL),
(61, NULL, 'Helllo I am sorry'),
(8, 0x4e6574776f726b204f7065726174696f6e73204c6561642e6a7067, NULL),
(64, NULL, 'hehe');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `studentid` int(4) NOT NULL,
  `restriction` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `studentid`, `restriction`) VALUES
('Admin ', 'One', 'admin1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 123, 0),
('Teacher ', 'Sample', 'TS@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1111, 1),
('Kel', 'Mike', 'Kel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2222, 2),
('Jet Boy', 'Abordaje', 'jetboy.abordaje@my.jru.edu', '93ee427ddd0880487be25eaff1d75c3f', 22260369, 2);

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `violation_id` int(11) NOT NULL,
  `studentid` int(11) DEFAULT NULL,
  `policynum` int(11) DEFAULT NULL,
  `violationcount` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`violation_id`, `studentid`, `policynum`, `violationcount`) VALUES
(65, 2222, 3, 3),
(68, 2222, 8, 1),
(74, 22260369, 5, 1),
(75, 22260369, 3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policynum`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`violation_id`),
  ADD UNIQUE KEY `unique_violation_constraint` (`studentid`,`policynum`),
  ADD KEY `policynum` (`policynum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policynum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `violation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `violations_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `users` (`studentid`),
  ADD CONSTRAINT `violations_ibfk_2` FOREIGN KEY (`policynum`) REFERENCES `policy` (`policynum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
