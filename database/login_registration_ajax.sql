-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2020 at 01:04 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_registration_ajax`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `languages` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `act_code` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `activated` enum('0','1') DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `u_name`, `u_email`, `gender`, `languages`, `country`, `password`, `signup_date`, `last_login`, `act_code`, `note`, `activated`) VALUES
(32, 'Najmul', 'nazmulovi999@gmail.com', 'm', 'English,Bangla', 'Bangladesh', '$2y$10$kpi97tvdsSCagYPEkW5f1O6yCgaEfdANpQJNy7x9X4UApm7YnSzK.', '2020-07-18 00:14:51', '2020-07-18 00:17:29', '9919785d855564cd95e0ca201699f048150933c21d6d0770', '', '1'),
(33, 'Kazi  Imam', 'neberhossain@gmail.com', 'm', 'English,Bangla,Hindi', 'Bangladesh', '$2y$10$yz93k93A6BaW3/CefUhSs.nLFoDRJpoay4byFF8HoRAQyPmVc0Y9.', '2020-07-23 01:51:16', '2020-07-23 02:05:56', '5fe41040c7799756057795a51b4004e7283b604b40a4a7df', '655898294611542', '1'),
(31, 'Najmeen', 'najmeen@gmail.com', 'f', 'English,Bangla', 'India', '$2y$10$GikcbpYmznJ7wnknBpjZNeKXdeQ.3HpIQRwDlbqJJynksbqwrCQry', '2020-07-17 12:06:56', '2020-07-17 12:06:56', '3a0f52252f406186458365f69955023d14ee5d8a9d99d474', '', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
