-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2019 at 03:20 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) NOT NULL,
  `captcha_time` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(360, 1551433255, '::1', 'Hi'),
(361, 1551433264, '::1', 'Hi'),
(362, 1551433265, '::1', 'Hi'),
(363, 1551433589, '::1', 'Hi'),
(364, 1551433599, '::1', 'Hi'),
(365, 1551433599, '::1', 'Hi'),
(366, 1551434317, '::1', 'nur6tGmn'),
(367, 1551434771, '::1', 'Hi'),
(368, 1551434776, '::1', 'Hi'),
(369, 1551435550, '::1', 'Hi'),
(370, 1551435550, '::1', 'Hi'),
(371, 1551435555, '::1', 'Hi'),
(372, 1551435555, '::1', 'Hi'),
(373, 1551435733, '::1', 'Hi'),
(374, 1551435763, '::1', 'Hi'),
(375, 1551435763, '::1', 'Hi'),
(376, 1551435923, '::1', 'Hi'),
(377, 1551436136, '::1', 'Hi'),
(378, 1551436182, '::1', 'Hi'),
(379, 1551436247, '::1', 'Hi'),
(380, 1551436259, '::1', 'Hi'),
(381, 1551436279, '::1', 'Hi'),
(382, 1551436293, '::1', 'Hi'),
(383, 1551436328, '::1', 'EzsNZWLE'),
(384, 1551532638, '::1', 'wDczVNiJ'),
(385, 1551532638, '::1', 'pV2rKW66');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `elink` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `email`, `date`, `elink`, `status`) VALUES
(36, 'tricky', '$2y$12$Rpa3zR.lZoc9rmi2V0e5PO7lygopKOw7SWCa0E6cFOQdxYFeG6AZK', 'trickyicky83@gmail.com', '2019-02-28 07:44:17', 'scgS9ojCV4QKfZzaok', 1),
(39, 'tricky', '$2y$12$tKHkXmHJ2UWZmHF5k7nDWu3DyQj6DxI96oshW0M9P3q.gHYxcLELW', 'rajarshi.bose@gmail.com', '2019-03-01 09:46:47', 'AEMXpuN3Zl5msTkvok', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
