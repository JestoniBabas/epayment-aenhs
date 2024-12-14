-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 04:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epayment-aenhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `pid` int(11) NOT NULL,
  `payment_for` varchar(30) NOT NULL,
  `payment_val` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`pid`, `payment_for`, `payment_val`) VALUES
(1, 'Journalism Fee', '90'),
(2, 'SSLG Fee', '60'),
(3, 'Athletics Fee', '20'),
(4, 'Red Cross Fee', '10'),
(5, 'Anti TB Fee', '5'),
(6, 'Guard Fee', '120'),
(7, 'GPTA Fee', '100'),
(8, 'GSP/BSP', '50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notid` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `icon` varchar(60) NOT NULL,
  `notification` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notif_counter`
--

CREATE TABLE `notif_counter` (
  `notif_counter_id` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(11) NOT NULL,
  `lrn` varchar(50) NOT NULL,
  `studid` varchar(40) NOT NULL,
  `studname` varchar(80) NOT NULL,
  `studtype` varchar(30) NOT NULL,
  `section` varchar(20) NOT NULL,
  `teacher` varchar(80) NOT NULL,
  `payment_for` varchar(40) NOT NULL,
  `payment_val` varchar(40) NOT NULL,
  `payment_bal` varchar(40) NOT NULL,
  `sy_from` varchar(20) NOT NULL,
  `sy_to` varchar(20) NOT NULL,
  `dt` datetime NOT NULL DEFAULT curtime(),
  `ref` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studid` int(11) NOT NULL,
  `lrn` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `xname` varchar(20) NOT NULL,
  `sex` varchar(12) NOT NULL,
  `studtype` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `teacher` varchar(60) NOT NULL,
  `uid` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_history`
--

CREATE TABLE `students_history` (
  `studid` int(11) NOT NULL,
  `lrn` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `xname` varchar(20) NOT NULL,
  `sex` varchar(12) NOT NULL,
  `studtype` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `teacher` varchar(60) NOT NULL,
  `sy_from` varchar(20) NOT NULL,
  `sy_to` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `syid` int(11) NOT NULL,
  `sy_from` varchar(20) NOT NULL,
  `sy_to` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `utype` varchar(20) NOT NULL,
  `studtype` varchar(30) NOT NULL,
  `section` varchar(40) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fullname`, `email`, `uname`, `pwd`, `utype`, `studtype`, `section`, `avatar`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'admin@gmail.com', 'admin', '$2y$12$cj09wMln3pmk.C48dDJpJuQXtV9AZ6EqbMqdqGwu2ZazfQDLF60EO', 'admin', '', '-', '4271d1998d5f71206bbc7c3ae49f25dd1733536003.png', '2024-12-07 09:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `year_level_section`
--

CREATE TABLE `year_level_section` (
  `ylsid` int(11) NOT NULL,
  `studtype` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notid`);

--
-- Indexes for table `notif_counter`
--
ALTER TABLE `notif_counter`
  ADD PRIMARY KEY (`notif_counter_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studid`);

--
-- Indexes for table `students_history`
--
ALTER TABLE `students_history`
  ADD PRIMARY KEY (`studid`);

--
-- Indexes for table `sy`
--
ALTER TABLE `sy`
  ADD PRIMARY KEY (`syid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `year_level_section`
--
ALTER TABLE `year_level_section`
  ADD PRIMARY KEY (`ylsid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notif_counter`
--
ALTER TABLE `notif_counter`
  MODIFY `notif_counter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_history`
--
ALTER TABLE `students_history`
  MODIFY `studid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sy`
--
ALTER TABLE `sy`
  MODIFY `syid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `year_level_section`
--
ALTER TABLE `year_level_section`
  MODIFY `ylsid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
