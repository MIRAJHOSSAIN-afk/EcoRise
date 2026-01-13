-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2025 at 11:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecorise`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `goal` varchar(255) NOT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `raised_amount` decimal(15,2) DEFAULT 0.00,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `location`, `goal`, `target_amount`, `raised_amount`, `image_url`, `created_at`) VALUES
(1, 'Global warming campaign', 'Dhaka, Bangladesh', 'A global warming campaign aims to raise awareness, advocate for policy change, and encourage individual actions to combat climate change, with examples ranging from the UN\'s ActNow campaign for individual actions and media initiatives like \"Promise of 1.5', 11000.00, 100.00, 'assets/campaigns/image68c1df8746d658.26539443.png', '2025-09-10 20:28:55'),
(4, 'Prakritir Jonno Sishura\' - \'Children for Nature', '64/8/A, North East Kafrul, Dhaka Cant, Dhaka.', '\'Prakritir Jonno Sishura\' - \'Children for Nature\': Workshop on Protecting Wildlife, Nature, and the Environment  Held weekly in primary schools across different districts of the country  Organized by: EcoRise .    Protecting nature is a responsibility we ', 20000.00, 0.00, 'assets/campaigns/image68c5f921676561.01182187.png', '2025-09-13 23:07:13'),
(5, 'Tree Plantation Campaign: World Environment Day programme.', 'Kuril,Dhaka', 'The **National Tree Plantation Campaign** aims to expand green coverage, combat climate change, and conserve biodiversity by planting trees across the country. It seeks to raise public awareness, especially among children and youth, about the importance o', 17000.00, 0.00, 'assets/campaigns/image68c5fbf568e450.01890503.jpeg', '2025-09-13 23:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `supported_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `user_id`, `campaign_id`, `amount`, `supported_at`) VALUES
(1, 2, 1, 100.00, '2025-09-10 20:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','user') DEFAULT 'user',
  `user_status` enum('active','inactive') DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Address` varchar(255) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `user_status`, `created_at`, `Address`, `Contact`) VALUES
(1, 'Hasibul Hasan', 'admin@gmail.com', '$2a$12$PUICc1t0pymMzw80jc0xUuP47fGYHhyG2DcqCr9rLPGbCINICL98G', 'admin', 'active', '2025-09-10 19:33:09', NULL, NULL),
(2, 'Rezaul Islam', 'rezaul@gmail.com', '$2y$10$rYhP1zvGHujO49NEtolmyOQPpjE.6PbTu1f3y9QCMtyze4PxuXfv2', 'user', 'active', '2025-09-10 19:40:38', 'DHaka,Tangail', '01700110011'),
(3, 'sourav saha', 'sourav@gmail.com', '$2y$10$BxWPlm4VnCg74IOxhF6UOubv6Y7NvLPcyc7Lne8r9JCuuit/P1kA2', 'user', 'active', '2025-09-11 06:39:08', NULL, NULL),
(4, 'rezaul islam', 'rezaul01@gmail.com', '$2y$10$r6izqOIYGHQklTEp.mrZK.XbrSKp3rmFsJrSVsJZpPkybySiokjNW', 'admin', 'active', '2025-09-12 19:02:10', NULL, NULL),
(5, 'Rayan Alam', 'rayan@gmail.com', '$2y$10$yZaLBW6mYmN6x1V0HxZIPeRgz/u2ueSDA6etiexrp6adsCtJd2uTa', 'user', 'active', '2025-09-13 06:04:22', 'DHaka', '01700110011');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `campaign_id` (`campaign_id`);

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
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `support_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
