-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2026 at 07:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facility_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `approved_by` int DEFAULT NULL,
  `person_in_charge` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `notes` text,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `booking_id`, `approved_by`, `person_in_charge`, `status`, `notes`, `approved_at`) VALUES
(8, 8, NULL, 'bassyam', 'rejected', 'nothing', '2026-01-20 14:33:43'),
(10, 10, NULL, 'azrie', 'approved', 'good', '2026-01-26 14:58:52'),
(11, 11, NULL, 'azrie', 'approved', 'alhamdulillah', '2026-01-26 14:20:43'),
(12, 12, NULL, 'Nakib', 'approved', 'Accepted', '2026-01-31 14:55:40'),
(14, 14, NULL, NULL, 'pending', NULL, NULL),
(15, 15, NULL, NULL, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `facility_id` int NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `purpose` text,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `facility_id`, `booking_date`, `start_time`, `end_time`, `purpose`, `status`, `created_at`) VALUES
(8, 19, 2, '2026-02-25', '08:00:00', '12:00:00', 'Discussion', 'rejected', '2026-01-20 06:31:59'),
(9, 20, 2, '2026-01-22', '17:30:00', '18:30:00', 'discussion', 'approved', '2026-01-20 08:24:47'),
(10, 20, 2, '2026-01-27', '15:15:00', '16:15:00', 'jamuan', 'approved', '2026-01-26 05:17:35'),
(11, 20, 1, '2026-02-28', '12:00:00', '14:00:00', 'team building', 'approved', '2026-01-26 06:10:36'),
(12, 21, 1, '2026-03-28', '14:45:00', '17:00:00', 'MPP Meeting', 'approved', '2026-01-28 18:42:18'),
(14, 21, 1, '2026-03-28', '14:45:00', '17:00:00', 'MPP Meeting', 'pending', '2026-01-28 19:03:46'),
(15, 21, 3, '2026-03-28', '12:30:00', '17:30:00', 'Concert', 'pending', '2026-01-29 16:29:46');

--
-- Triggers `bookings`
--
DELIMITER $$
CREATE TRIGGER `after_booking_insert` AFTER INSERT ON `bookings` FOR EACH ROW BEGIN 
  INSERT INTO approvals (booking_id) VALUES (NEW.id); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`) VALUES
(1, 'Faculty of Information Science', ''),
(2, 'Faculty of Electrical Engineering', ''),
(3, 'Faculty of Mechanical Engineering', '');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `department_id` int DEFAULT NULL,
  `capacity` int DEFAULT '1',
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `description`, `department_id`, `capacity`, `image_url`) VALUES
(1, 'Bilik Seminar', '', 2, 10, 'https://kl.utm.my/wp-content/uploads/2017/09/Dewan-Seminar-400x284.jpg'),
(2, 'Dewan Kuliah', '', 1, 50, ''),
(3, 'Dewan Azman Hashim', '', 3, 200, ''),
(5, 'Bilik Ilmuan 1', '', 3, 20, ''),
(6, 'Bilik Ilmuan 2', '', 2, 20, ''),
(7, 'Bilik Ilmuan 3', '', 1, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  `department_id` int DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `department_id`, `phone`, `created_at`) VALUES
(14, 'admin2', 'admin2@example.com', '12345', 'admin', 2, '01123456789', '2026-01-19 20:09:14'),
(19, 'mirul', 'mirul@gmail.com', '12345', 'user', 2, '01254879652', '2026-01-20 06:30:19'),
(20, 'nakib', 'nakib@gmail.com', '12345', 'user', 1, '01123456789', '2026-01-20 08:23:13'),
(21, 'bassyam nizam', 'bassyam@gmail.com', '12345', 'user', 1, '0172597239', '2026-01-28 18:40:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `idx_bookings_date_facility` (`booking_date`,`facility_id`),
  ADD KEY `idx_bookings_status` (`status`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `idx_users_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `approvals_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `facilities`
--
ALTER TABLE `facilities`
  ADD CONSTRAINT `facilities_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
