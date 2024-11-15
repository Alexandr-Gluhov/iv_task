-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 12:08 AM
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
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `reception_hour_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `reception_hour_id`, `user_id`) VALUES
(1, 1, 1, 6),
(2, 1, 2, NULL),
(3, 4, 3, NULL),
(4, 4, 1, NULL),
(5, 2, 5, NULL),
(7, 3, 2, 7),
(8, 5, 3, 6),
(9, 6, 2, 7),
(10, 7, 4, NULL),
(11, 8, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specialist_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specialist_id`, `name`) VALUES
(1, 1, 'Петров А. Б.'),
(2, 1, 'Иванов А. Г.'),
(3, 2, 'Коновалова А. А.'),
(4, 1, 'Матросов С. В.'),
(5, 2, 'Перцев Г. С.'),
(6, 4, 'Серебрин А. Д.'),
(7, 5, 'Кавалина И. В.'),
(8, 3, 'Кузнев И. И.');

-- --------------------------------------------------------

--
-- Table structure for table `reception_hours`
--

CREATE TABLE `reception_hours` (
  `id` int(11) NOT NULL,
  `hour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reception_hours`
--

INSERT INTO `reception_hours` (`id`, `hour`) VALUES
(1, '2024-11-18 10:00:00'),
(2, '2024-11-18 11:00:00'),
(3, '2024-11-18 12:00:00'),
(4, '2024-11-19 11:00:00'),
(5, '2024-11-19 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`id`, `name`) VALUES
(1, 'Терапевт'),
(2, 'Офтальмолог'),
(3, 'Гастроэнтеролог'),
(4, 'Алерголог'),
(5, 'Отоларинголог');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` enum('F','M') NOT NULL,
  `blood_type` tinyint(11) NOT NULL,
  `factor` enum('+','-') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `salt`, `birth_date`, `sex`, `blood_type`, `factor`) VALUES
(6, 'AlexandrTRS@yandex.ru', 'Глухов Александр Владимирович', '$2y$10$LyNTNJ4rlSQ1WOXarnL34uuhjuGtck6zWUVR.OkrNjlSUOFgUr1iS', '062c2776086adb8c8f', '2004-05-25', 'M', 4, '-'),
(7, 'sbdy@example.com', 'Иванов Иван Иванович', '$2y$10$.rQ3g.aI9IES75Eh1Y4TUuviiRsVU3c5lWY62qcvjP5GtltjKU/KS', '0269262ed1a14b69d7b4', '2014-05-25', 'M', 2, '+');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `reception_hour_id` (`reception_hour_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialist_id` (`specialist_id`);

--
-- Indexes for table `reception_hours`
--
ALTER TABLE `reception_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reception_hours`
--
ALTER TABLE `reception_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`reception_hour_id`) REFERENCES `reception_hours` (`id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`specialist_id`) REFERENCES `specialists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
