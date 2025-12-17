-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2025 at 05:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','planning','completed') DEFAULT 'planning',
  `members` int(11) DEFAULT 1,
  `date` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `status`, `members`, `date`, `created_at`) VALUES
(1, 'Website Redesign', 'Revamping the company homepage with new branding.', 'active', 3, 'Oct 24', '2025-12-16 12:23:49'),
(2, 'Q4 Marketing Campaign', 'Planning social media assets and ad spend.', 'planning', 3, 'Nov 01', '2025-12-16 12:23:49'),
(8, 'fdsfsdf', 'dsfsadfasdfsad', 'completed', 3, 'Just now', '2025-12-16 13:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `project_comments`
--

CREATE TABLE `project_comments` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_comments`
--

INSERT INTO `project_comments` (`id`, `project_id`, `author`, `comment_text`, `comment_date`, `created_at`) VALUES
(171, 8, 'Current User', 'sadfsadf', '16/12/2025, 15:54:07', '2025-12-16 16:02:49'),
(172, 8, 'Current User', 'sdfsdfsdf', '16/12/2025, 15:54:27', '2025-12-16 16:02:49'),
(173, 8, 'Current User', 'asdfsadf', '16/12/2025, 15:54:29', '2025-12-16 16:02:49'),
(174, 8, 'Current User', 'dfergerg', '16/12/2025, 17:43:48', '2025-12-16 16:02:49'),
(175, 8, 'Current User', 'ergergerger', '16/12/2025, 17:43:50', '2025-12-16 16:02:49'),
(176, 8, 'Current User', 'faaaan', '16/12/2025, 17:43:54', '2025-12-16 16:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `project_id`, `filename`, `filesize`, `created_at`) VALUES
(135, 8, 'config.php', '0 Bytes', '2025-12-16 16:02:49'),
(136, 8, 'project.php', '49.34 KB', '2025-12-16 16:02:49'),
(137, 8, 'calendar.php', '0 Bytes', '2025-12-16 16:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE `project_users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `project_id`, `username`) VALUES
(22, 2, 'John Doe'),
(23, 2, 'Jane Smith'),
(66, 8, 'eleni'),
(67, 8, 'Fanis');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `email`, `role`, `department`, `phone`, `status`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', 'Developer', 'Engineering', NULL, 'active', '2025-12-16 14:01:58'),
(2, 'Jonh Smith', 'jane@example.com', 'Designer', 'Design', '', 'active', '2025-12-16 14:01:58'),
(3, 'Mike Johnson', 'mike@example.com', 'Manager', 'Management', NULL, 'active', '2025-12-16 14:01:58'),
(4, 'Sarah Williams', 'sarah@example.com', 'Developer', 'Engineering', NULL, 'active', '2025-12-16 14:01:58'),
(5, 'Tom Brown', 'tom@example.com', 'Marketing', 'Marketing', NULL, 'active', '2025-12-16 14:01:58'),
(7, 'Fanis', '------', '--------', '', '', 'active', '2025-12-16 15:46:40'),
(9, 'giorgos', 'pappa', '', '', '', 'active', '2025-12-16 15:56:11'),
(10, 'eleni', 'elenimilona@gmail.com', '', '', '', 'active', '2025-12-16 15:56:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_comments`
--
ALTER TABLE `project_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_users`
--
ALTER TABLE `project_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_comments`
--
ALTER TABLE `project_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_comments`
--
ALTER TABLE `project_comments`
  ADD CONSTRAINT `project_comments_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_files`
--
ALTER TABLE `project_files`
  ADD CONSTRAINT `project_files_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_users`
--
ALTER TABLE `project_users`
  ADD CONSTRAINT `project_users_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
