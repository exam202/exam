-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 02:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_advice_group`
--

-- --------------------------------------------------------

--
-- Table structure for table `health_tracker`
--

CREATE TABLE `health_tracker` (
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `steps_taken` int(11) NOT NULL,
  `calories_burnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_tracker`
--

INSERT INTO `health_tracker` (`user_id`, `date`, `steps_taken`, `calories_burnt`) VALUES
(8, '2023-03-10', 12446, 2340),
(8, '2023-03-09', 10000, 1444),
(8, '2023-03-06', 10000, 143423),
(8, '2023-03-05', 10000, 42),
(10, '2023-03-15', 10000, 2340),
(10, '2023-03-14', 12413, 2423),
(10, '2023-03-13', 23234, 3000),
(10, '2023-03-12', 9000, 2010),
(10, '2023-03-11', 14243, 3443),
(10, '2023-03-16', 12413, 1525),
(12, '2023-03-16', 12314, 1435),
(11, '2023-03-16', 12314, 1435),
(11, '2023-03-23', 4134, 414),
(11, '2023-02-04', 40, 124);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `user_id` int(11) NOT NULL,
  `wind` tinyint(1) NOT NULL DEFAULT 1,
  `air_quality` tinyint(1) NOT NULL DEFAULT 1,
  `humidity` tinyint(1) NOT NULL DEFAULT 1,
  `uv_level` tinyint(1) NOT NULL DEFAULT 1,
  `sun` tinyint(1) NOT NULL DEFAULT 1,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `precipitation` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`user_id`, `wind`, `air_quality`, `humidity`, `uv_level`, `sun`, `visibility`, `precipitation`) VALUES
(8, 1, 1, 1, 1, 1, 1, 1),
(9, 1, 1, 1, 1, 1, 1, 1),
(10, 1, 1, 1, 1, 1, 1, 1),
(11, 1, 1, 1, 1, 1, 1, 1),
(12, 1, 1, 1, 1, 1, 1, 1),
(13, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(63) NOT NULL,
  `issue` varchar(2047) NOT NULL,
  `solved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `title`, `issue`, `solved`) VALUES
(3, 8, 'example issue 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0),
(4, 8, 'example issue 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1),
(5, 12, 'test', 'this is a test report', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `preference` varchar(15) NOT NULL,
  `tip` varchar(63) NOT NULL,
  `severity` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `preference`, `tip`, `severity`) VALUES
(1, 'wind', 'wind fdadsfasdf ', 1),
(2, 'humidity', 'this is a humidity tip', 1),
(3, 'wind', 'wind vczvcxzvzxcv', 2),
(4, 'uv_level', 'uv-level dfasdfasdf', 2),
(5, 'air_quality', 'air quality fsadfsadfasdfads', 1),
(6, 'wind', 'fadfsadsf', 1),
(7, 'humidity', 'this is an example tip for humidity with low severity', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(63) NOT NULL,
  `password` varchar(63) NOT NULL,
  `first_name` varchar(63) NOT NULL,
  `last_name` varchar(63) NOT NULL,
  `country` varchar(15) NOT NULL,
  `postcode` varchar(15) NOT NULL,
  `preferences` int(11) DEFAULT NULL,
  `theme` varchar(21) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `country`, `postcode`, `preferences`, `theme`, `level`) VALUES
(8, 'callum.jolly1@gmail.com', '$2y$10$.OhtzQztzHVjLI7kXi52EO96Jt2AnAJy9d5rcmu28epLiWQfHudLW', 'callum', 'jolly', 'United Kingdom', 'Tr14 8ry', 1, 'sandstone.css', 'admin'),
(9, 'callum.jolly3@gmail.com', '$2y$10$Xp9C/lNOD9M0OszGvA4w8.k4fX8WWiWzrx0C/lkJCB6zON9cu3PTm', 'callum', 'jolly', 'United Kingdom', 'Tr14 8ry', 0, 'sandstone.css', 'user'),
(10, 'callum.jolly10@gmail.com', '$2y$10$3W56H0KnY.LdDxGkCH/mpOw8JNxnW/57f1eEy7el/Jkbbq2yb.Dbe', 'callum', 'jolly', 'United Kingdom', 'Tr1 3xx', 1, 'sandstone.css', 'user'),
(11, 'admin@admin.com', '$2y$10$KgsAJbQEAwdQyesG0wGmCeRoWXz7rVuwKUduXBaN29nL.ouiIbDOe', 'admin', 'admin', 'United Kingdom', 'tr1 3xx', 1, 'journal.css', 'admin'),
(12, 'test@test.com', '$2y$10$uhOKilb3vugoWl69t5rHLO9iI.SvoyDm9JGYU4kxTO.ug0KFvxTJS', 'test', 'test', 'United Kingdom', 'tr1 1aa', 1, 'journal.css', 'user'),
(13, 'admi2n@admin.com', '$2y$10$nrsYm0I83FqllpAmqcpqnegK/c8W/Llb/DZTH8/XSa5ZJZvtTlArq', 'gsa', 'asdf', 'United Kingdom', 'tr148ry', 0, 'sandstone.css', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `health_tracker`
--
ALTER TABLE `health_tracker`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferences` (`preferences`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `health_tracker`
--
ALTER TABLE `health_tracker`
  ADD CONSTRAINT `health_tracker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
