-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2026 at 10:15 AM
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
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_type` enum('task','reminder','meeting','deadline') DEFAULT 'task',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `all_day` tinyint(1) DEFAULT 0,
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `status` enum('pending','in-progress','completed','cancelled') DEFAULT 'pending',
  `assigned_to` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `title`, `description`, `event_type`, `start_date`, `end_date`, `start_time`, `end_time`, `all_day`, `priority`, `status`, `assigned_to`, `project_id`, `created_at`, `updated_at`) VALUES
(2, 'Project Deadline', 'Website redesign completion', 'deadline', '2025-12-20', NULL, NULL, NULL, 1, 'high', 'pending', NULL, NULL, '2025-12-17 10:43:40', '2025-12-17 11:16:33'),
(5, 'review code 1', 'sdffewfwef', 'reminder', '2025-12-28', '2025-12-30', '05:11:00', '11:59:00', 0, 'high', 'pending', NULL, NULL, '2025-12-17 11:12:15', '2025-12-17 11:15:39'),
(8, 'wsdwsdsd', 'awdawdwdw', 'deadline', '2025-12-17', NULL, NULL, NULL, 1, 'medium', 'in-progress', NULL, NULL, '2025-12-17 12:50:27', '2025-12-18 12:00:49'),
(11, 'fffff', 'fffff', 'deadline', '2025-12-19', NULL, NULL, NULL, 1, 'medium', 'pending', NULL, NULL, '2025-12-17 12:51:40', '2025-12-17 12:51:52'),
(13, 'test test', 'test test test test', 'reminder', '2025-12-18', NULL, NULL, NULL, 1, 'low', 'pending', NULL, 2, '2025-12-18 11:02:11', '2025-12-18 11:42:31'),
(15, 'test tes', 'test ets', 'task', '2025-12-17', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 12:13:08', '2025-12-18 12:13:08'),
(16, 'sdcwedw', 'wcwdcwdcwd', 'task', '2025-12-18', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 12:13:24', '2025-12-18 12:13:24'),
(17, 'dcwdcwdfwdcwd', 'dwcwdc', 'task', '2025-12-18', NULL, NULL, NULL, 1, 'high', 'pending', NULL, NULL, '2025-12-18 12:13:37', '2025-12-18 12:13:37'),
(18, 'dcsdc', 'dcdscvdv', 'task', '2025-12-17', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 13:32:52', '2025-12-18 13:32:52'),
(19, 'xcvdfv', 'fdvsdfvsfbfdb', 'task', '2025-12-18', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 13:36:30', '2025-12-18 13:36:30'),
(20, 'zcvsdcsd', 'csxvsdvsdv', 'task', '2025-12-17', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 13:44:32', '2025-12-18 13:44:32'),
(21, 'drger', 'g ergerg', 'task', '2025-12-19', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 13:45:00', '2025-12-18 13:45:00'),
(22, 'df efef', 'degefgwefg', 'deadline', '2025-12-19', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2025-12-18 13:45:13', '2025-12-18 13:45:13'),
(23, 'test test', 'test', 'task', '2025-12-23', NULL, NULL, NULL, 1, 'medium', 'pending', NULL, NULL, '2025-12-23 15:38:08', '2025-12-23 15:38:08'),
(24, 'ddfwdf', 'sdfdfef', 'task', '2026-01-06', '2026-01-06', NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2026-01-05 12:29:19', '2026-01-05 12:29:19'),
(25, 'sdvdsv', 'dsvasdvdf', 'task', '2026-01-05', '2026-01-07', NULL, NULL, 1, 'high', 'in-progress', NULL, NULL, '2026-01-05 14:19:43', '2026-01-05 14:19:43'),
(26, 'sdvsdf', 'sdfadffsgsd', 'meeting', '2026-01-05', '2026-01-08', NULL, NULL, 0, 'low', 'pending', NULL, NULL, '2026-01-05 14:26:34', '2026-01-05 14:26:34'),
(34, 'σδωσδω', 'δωσδωσδω', 'meeting', '2026-01-10', NULL, NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2026-01-07 15:27:25', '2026-01-07 15:27:25'),
(35, 'σψσψ', 'ασψδσψσδ', 'deadline', '2026-01-11', NULL, NULL, NULL, 0, 'low', 'pending', NULL, NULL, '2026-01-07 15:34:35', '2026-01-07 15:34:35'),
(36, 'SCASC', 'ASCASCA', 'reminder', '2026-01-10', '2026-01-11', NULL, NULL, 1, 'high', 'in-progress', 1, 23, '2026-01-09 12:47:02', '2026-01-09 12:47:02'),
(37, 'sdwsdw', 'wdfwdfwdf', 'reminder', '2026-01-09', '2026-01-11', NULL, NULL, 1, 'high', 'pending', NULL, NULL, '2026-01-09 13:21:19', '2026-01-09 13:21:19'),
(38, 'sdcsdvsd', 'sdvsdvwDV', 'task', '2026-01-13', '2026-01-15', NULL, NULL, 0, 'medium', 'pending', NULL, NULL, '2026-01-12 09:09:04', '2026-01-12 09:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `link`, `type`, `is_read`, `created_at`) VALUES
(1, 'New Project Created', 'Project \'sdfsdf\' has been added.', 'project.php', 'project', 1, '2026-01-07 15:01:00'),
(2, 'New Project Created', 'Project \'zzxzxzzx\' has been added.', 'project.php', 'project', 1, '2026-01-07 15:01:34'),
(3, 'New Project Created', 'Project \'dvsdf\' has been added.', 'project.php', 'project', 1, '2026-01-07 15:20:06'),
(4, 'New Event Added', 'Event \'σδωσδω\' is scheduled for 2026-01-10.', 'calendar.php', 'event', 1, '2026-01-07 15:27:25'),
(5, 'New Event Added', 'Event \'σψσψ\' is scheduled for 2026-01-11.', 'calendar.php', 'event', 1, '2026-01-07 15:34:35'),
(6, 'New Project Created', 'Project \'δσφσδψσδφ\' has been added.', 'project.php', 'project', 1, '2026-01-07 15:39:32'),
(7, 'New Project Created', 'Project \'zxasxscs\' has been added.', 'project.php', 'project', 1, '2026-01-08 15:22:16'),
(8, 'New Project Created', 'Project \'dcdvv\' has been added.', 'project.php', 'project', 1, '2026-01-08 15:22:29'),
(9, 'New Project Created', 'Project \'asdqdqwe\' has been added.', 'project.php', 'project', 1, '2026-01-08 15:32:20'),
(10, 'New Project Created', 'Project \'sdvsdf\' has been added.', 'project.php', 'project', 1, '2026-01-08 16:06:23'),
(11, 'New Project Created', 'Project \'fffffff\' has been added.', 'project.php', 'project', 1, '2026-01-09 08:35:18'),
(12, 'New Project Created', 'Project \'tyjfidfghj\' has been added.', 'project.php', 'project', 1, '2026-01-09 09:48:56'),
(13, 'New Comment', 'Current User commented on \'tyjfidfghj\': ascscdscsdc...', 'project.php', 'comment', 1, '2026-01-09 11:01:38'),
(14, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 1, '2026-01-09 11:16:05'),
(15, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 1, '2026-01-09 11:16:05'),
(16, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 1, '2026-01-09 12:01:32'),
(17, 'New Comment', 'Current User commented on \'fffffff\'', 'project.php', 'comment', 1, '2026-01-09 12:43:33'),
(18, 'New Comment', 'Current User commented on \'δσφσδψσδφ\'', 'project.php', 'comment', 1, '2026-01-09 12:46:09'),
(19, 'New Event Added', 'Event \'SCASC\' is scheduled for 2026-01-10.', 'calendar.php', 'event', 1, '2026-01-09 12:47:02'),
(20, 'File Uploaded', 'New file \'Untitled 8.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(21, 'File Uploaded', 'New file \'Untitled 2 copy.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(22, 'File Uploaded', 'New file \'diastasis-ftero-ftero.docx\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(23, 'File Uploaded', 'New file \'IMG_0947.PNG\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(24, 'File Uploaded', 'New file \'IMG_0732.JPEG\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(25, 'File Uploaded', 'New file \'IMG_0736.JPG\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(26, 'File Uploaded', 'New file \'Untitled 3.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:07:45'),
(27, 'File Uploaded', 'New file \'Untitled 3.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(28, 'File Uploaded', 'New file \'Untitled 8.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(29, 'File Uploaded', 'New file \'Untitled 2 copy.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(30, 'File Uploaded', 'New file \'diastasis-ftero-ftero.docx\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(31, 'File Uploaded', 'New file \'IMG_0947.PNG\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(32, 'File Uploaded', 'New file \'IMG_0732.JPEG\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(33, 'File Uploaded', 'New file \'IMG_0736.JPG\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(34, 'File Uploaded', 'New file \'Untitled 4.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(35, 'File Uploaded', 'New file \'Untitled 3.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(36, 'File Uploaded', 'New file \'Untitled 2.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(37, 'File Uploaded', 'New file \'Untitled 2 copy.tiff\' added to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:11:26'),
(38, 'File Uploaded', 'New file \'Untitled 7.tiff\' added to project \'sdvsdf\'.', 'project.php', 'file', 1, '2026-01-09 13:12:44'),
(39, 'File Uploaded', 'New file \'IMG_5275 (1) (1) (1).jpeg\' added to project \'sdvsdf\'.', 'project.php', 'file', 1, '2026-01-09 13:12:44'),
(40, 'File Uploaded', 'New file \'Untitled 2.tiff\' added to project \'sdvsdf\'.', 'project.php', 'file', 1, '2026-01-09 13:12:44'),
(41, 'File Uploaded', 'New file \'Untitled 2 copy.tiff\' added to project \'sdvsdf\'.', 'project.php', 'file', 1, '2026-01-09 13:12:44'),
(42, 'File Uploaded', 'New file \'Untitled 2.tiff\' added to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 13:13:34'),
(43, 'File Uploaded', 'New file \'Untitled 2 copy.tiff\' added to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 13:13:34'),
(44, 'File Uploaded', 'New file \'Untitled 2.tiff\' added to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 13:13:48'),
(45, 'File Uploaded', 'New file \'Untitled 2 copy.tiff\' added to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 13:13:48'),
(46, 'File Uploaded', 'New file \'Untitled 4.tiff\' added to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 13:13:48'),
(47, 'File Uploaded', 'New file \'Untitled 5.tiff\' added to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 13:13:48'),
(48, 'New Event Added', 'Event \'sdwsdw\' is scheduled for 2026-01-09.', 'calendar.php', 'event', 1, '2026-01-09 13:21:19'),
(49, 'Files Uploaded', 'Uploaded 3 file(s): Untitled 3.tiff, Untitled 2.tiff + 1 more to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:36:49'),
(50, 'Files Uploaded', 'Uploaded 6 file(s): Untitled 3.tiff, Untitled 2.tiff + 4 more to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:37:45'),
(51, 'Files Uploaded', 'Uploaded 6 file(s): Untitled 2.tiff, IMG_0736.JPG + 4 more to project \'fffffff\'.', 'project.php', 'file', 1, '2026-01-09 13:44:14'),
(52, 'Files Uploaded', 'Uploaded 6 file(s): Untitled 2.tiff, Untitled 6.tiff + 4 more to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 13:51:14'),
(53, 'Files Uploaded', 'Uploaded 7 file(s): Untitled 4.tiff, Untitled 5.tiff + 5 more to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-09 14:00:54'),
(54, 'Files Uploaded', 'Uploaded 9 file(s): Untitled 2.tiff, Untitled 3.tiff + 7 more to project \'sdvsdf\'.', 'project.php', 'file', 1, '2026-01-09 14:14:12'),
(55, 'Files Uploaded', 'Uploaded 6 file(s): —Pngtree—instagram white icon free logo_3570433.png, —Pngtree—white icon_3570420.png + 4 more to project \'dvsdf\'.', 'project.php', 'file', 1, '2026-01-09 15:06:29'),
(56, 'New Comment', 'Current User commented on \'fffffff\'', 'project.php', 'comment', 1, '2026-01-09 15:07:04'),
(57, 'Files Uploaded', 'Uploaded 8 file(s): —Pngtree—white icon_3570420.png, —Pngtree—instagram white icon free logo_3570433.png + 6 more to project \'fffffff\'.', 'project.php', 'file', 1, '2026-01-09 15:07:04'),
(58, 'New Comment', 'Current User commented on \'dcdvv\'', 'project.php', 'comment', 1, '2026-01-09 15:07:37'),
(59, 'Files Uploaded', 'Uploaded 4 file(s): Untitled 4.tiff, Untitled 5.tiff + 2 more to project \'dcdvv\'.', 'project.php', 'file', 1, '2026-01-09 15:07:37'),
(60, 'New Comment', 'Current User commented on \'fffffff\'', 'project.php', 'comment', 1, '2026-01-09 15:16:30'),
(61, 'New Comment', 'Current User commented on \'fffffff\'', 'project.php', 'comment', 1, '2026-01-09 15:21:28'),
(62, 'New Comment', 'Current User commented on \'zxasxscs\'', 'project.php', 'comment', 1, '2026-01-09 15:21:39'),
(63, 'New Comment', 'Current User commented on \'zxasxscs\'', 'project.php', 'comment', 1, '2026-01-09 15:22:32'),
(64, 'Files Uploaded', 'Uploaded 5 file(s): 1630B489-47C9-49E1-90B1-2DAE0858A7FD.jpg, 1234.jpg + 3 more to project \'zxasxscs\'.', 'project.php', 'file', 1, '2026-01-09 15:22:32'),
(65, 'New Comment', 'Current User commented on \'fffffff\'', 'project.php', 'comment', 0, '2026-01-09 15:37:41'),
(66, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 0, '2026-01-09 15:40:04'),
(67, 'New Comment', 'Current User commented on \'fffffff\'', 'project.php', 'comment', 0, '2026-01-09 15:44:11'),
(68, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 0, '2026-01-09 15:54:23'),
(69, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 0, '2026-01-12 09:05:20'),
(70, 'Files Uploaded', 'Uploaded 1 new file(s): 0_zWCTHFNFdGAgSw2d.jpg to project \'tttttttttt\'.', 'project.php', 'file', 1, '2026-01-12 09:05:41'),
(71, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 0, '2026-01-12 09:06:15'),
(72, 'Files Uploaded', 'Uploaded 2 new file(s): 5D5BF9AB-AFC0-4101-A8B4-5C4ECCFCB0D6.jpg, 6BDBFD61-86BD-44F5-BA58-A8C6AEE34B1F.jpg to project \'tttttttttt\'.', 'project.php', 'file', 0, '2026-01-12 09:07:54'),
(73, 'New Comment', 'Current User commented on \'sdvsdf\'', 'project.php', 'comment', 0, '2026-01-12 09:08:27'),
(74, 'New Event Added', 'Event \'sdcsdvsd\' is scheduled for 2026-01-13.', 'calendar.php', 'event', 0, '2026-01-12 09:09:04'),
(75, 'New Comment', 'Current User commented on \'sdvsdf\'', 'project.php', 'comment', 0, '2026-01-12 09:11:58'),
(76, 'New Comment', 'Current User commented on \'tttttttttt\'', 'project.php', 'comment', 0, '2026-01-12 09:12:47');

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
(8, 'fdsfsdf', 'dsfsadfasdfsad', 'completed', 3, 'Just now', '2025-12-16 13:54:11'),
(18, 'sdfsdf', 'sdfsdfdf', 'planning', 3, '', '2026-01-07 15:01:00'),
(19, 'zzxzxzzx', 'xxxzxxxzz', 'planning', 3, '', '2026-01-07 15:01:34'),
(20, 'dvsdf', 'sdvsd', 'planning', 1, '', '2026-01-07 15:20:06'),
(21, 'δσφσδψσδφ', 'σδωψδωψσδωσδφ', 'planning', 3, '', '2026-01-07 15:39:32'),
(22, 'zxasxscs', 'cascascqscq', 'planning', 1, '', '2026-01-08 15:22:16'),
(23, 'dcdvv', 'dvedvwedvwe', 'planning', 1, '', '2026-01-08 15:22:28'),
(25, 'sdvsdf', 'sdfvsdvfef', 'planning', 0, '', '2026-01-08 16:06:23'),
(26, 'fffffff', 'fffffffff', 'planning', 3, '', '2026-01-09 08:35:18'),
(27, 'tttttttttt', 'tttttt', 'planning', 0, '', '2026-01-09 09:48:56');

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
(210, 8, 'Current User', 'sadfsadf', '16/12/2025, 15:54:07', '2026-01-05 12:27:20'),
(211, 8, 'Current User', 'sdfsdfsdf', '16/12/2025, 15:54:27', '2026-01-05 12:27:20'),
(212, 8, 'Current User', 'asdfsadf', '16/12/2025, 15:54:29', '2026-01-05 12:27:20'),
(213, 8, 'Current User', 'dfergerg', '16/12/2025, 17:43:48', '2026-01-05 12:27:20'),
(214, 8, 'Current User', 'ergergerger', '16/12/2025, 17:43:50', '2026-01-05 12:27:20'),
(215, 8, 'Current User', 'faaaan', '16/12/2025, 17:43:54', '2026-01-05 12:27:20'),
(219, 18, 'Current User', 'sdfsdf', '07/01/2026, 17:00:57', '2026-01-07 15:01:00'),
(330, 23, 'Current User', 'zxcsdvv', '09/01/2026, 17:07:35', '2026-01-09 15:07:37'),
(335, 21, 'Current User', 'DSCDC', '09/01/2026, 14:46:08', '2026-01-09 12:46:09'),
(336, 21, 'Current User', 'σδφδσδφ', '07/01/2026, 17:39:31', '2026-01-07 15:39:32'),
(362, 19, 'Current User', 'xxzzxxzx', '07/01/2026, 17:01:33', '2026-01-07 15:01:34'),
(364, 26, 'Current User', 'vdafbdfbsfgbnfg', '09/01/2026, 17:37:39', '2026-01-09 15:37:41'),
(365, 26, 'Current User', 'asdfwdcswdvv', '09/01/2026, 17:21:27', '2026-01-09 15:21:28'),
(366, 26, 'Current User', 'asxqsxqsxcqsc', '09/01/2026, 17:16:29', '2026-01-09 15:16:30'),
(367, 26, 'Current User', 'qwdqwdwdwefefe', '09/01/2026, 17:07:03', '2026-01-09 15:07:04'),
(368, 26, 'Current User', 'ascasdcscvsdVSDVSDV', '09/01/2026, 14:43:31', '2026-01-09 12:43:33'),
(369, 26, 'Current User', 'fanis test fanis test', '09/01/2026, 10:36:27', '2026-01-09 08:36:29'),
(370, 26, 'Current User', 'ascasdcdcd', '09/01/2026, 17:44:09', '2026-01-09 15:44:11'),
(376, 22, 'Current User', 'ascascdc', '09/01/2026, 17:22:31', '2026-01-09 15:22:32'),
(377, 22, 'Current User', 'adadscdv', '09/01/2026, 17:21:39', '2026-01-09 15:21:39'),
(421, 25, 'Current User', 'dfbfbhaefbh', '12/01/2026, 11:08:26', '2026-01-12 09:08:27'),
(422, 25, 'Current User', 'sddvasdfvfv', '09/01/2026, 10:34:24', '2026-01-09 08:34:48'),
(423, 25, 'Current User', 'ASCDSCWDV', '12/01/2026, 11:11:56', '2026-01-12 09:11:58'),
(424, 27, 'Current User', 'adfvdafbv', '12/01/2026, 11:06:14', '2026-01-12 09:06:15'),
(425, 27, 'Current User', 'sefwergfre', '12/01/2026, 11:05:19', '2026-01-12 09:05:20'),
(426, 27, 'Current User', 'adscfqw dfwev', '09/01/2026, 17:54:22', '2026-01-09 15:54:23'),
(427, 27, 'Current User', 'asascsdc', '09/01/2026, 17:40:02', '2026-01-09 15:40:04'),
(428, 27, 'Current User', 'dsvfsfergferge', '09/01/2026, 14:01:30', '2026-01-09 12:01:32'),
(429, 27, 'Current User', 'sadsdscasc', '09/01/2026, 13:15:59', '2026-01-09 11:16:05'),
(430, 27, 'Current User', 'dddddd', '09/01/2026, 13:16:03', '2026-01-09 11:16:05'),
(431, 27, 'Current User', 'ascscdscsdc', '09/01/2026, 13:01:22', '2026-01-09 11:03:28'),
(432, 27, 'Current User', 'ASCASC', '12/01/2026, 11:12:45', '2026-01-12 09:12:47');

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
(147, 8, 'config.php', '0 Bytes', '2026-01-05 12:27:20'),
(148, 8, 'project.php', '49.34 KB', '2026-01-05 12:27:20'),
(149, 8, 'calendar.php', '0 Bytes', '2026-01-05 12:27:20'),
(335, 23, 'Untitled 4.tiff', '464.83 KB', '2026-01-09 13:13:48'),
(336, 23, 'Untitled 5.tiff', '1.91 MB', '2026-01-09 13:13:48'),
(337, 23, 'Untitled 2.tiff', '542.01 KB', '2026-01-09 13:13:34'),
(338, 23, 'Untitled 2 copy.tiff', '1.04 MB', '2026-01-09 13:13:34'),
(347, 21, '77r1dgt943xfwhv8rjsmqa1w0f_image.svg', '63.21 KB', '2026-01-09 14:21:36'),
(348, 21, '1630B489-47C9-49E1-90B1-2DAE0858A7FD.jpg', '253.1 KB', '2026-01-09 14:21:36'),
(349, 21, '1234.jpg', '497.11 KB', '2026-01-09 14:21:36'),
(350, 21, '5f768089-19cc-4416-a3c6-7de6a57d5f68_7d29a3d3-8c4f-4d87-ab90-0fcb7cd47d46.jpg', '102.3 KB', '2026-01-09 14:13:17'),
(351, 21, '2-col-impact-living-clp.webp', '167.65 KB', '2026-01-09 14:13:17'),
(352, 21, '5D5BF9AB-AFC0-4101-A8B4-5C4ECCFCB0D6.jpg', '226.01 KB', '2026-01-09 14:13:17'),
(353, 21, '7081289_3542719.png', '16.82 KB', '2026-01-09 15:16:55'),
(354, 21, '7081289_3542719 (3).png', '14.41 KB', '2026-01-09 15:16:55'),
(432, 22, '1630B489-47C9-49E1-90B1-2DAE0858A7FD.jpg', '253.1 KB', '2026-01-09 15:21:53'),
(433, 22, '1234.jpg', '497.11 KB', '2026-01-09 15:21:53'),
(434, 22, 'IMG_0732.JPEG', '1.46 MB', '2026-01-09 12:12:27'),
(435, 22, 'IMG_0945.jpg', '2.32 MB', '2026-01-09 12:12:27'),
(436, 22, 'IMG_0736.JPG', '1.81 MB', '2026-01-09 12:12:27'),
(437, 22, 'freepik-geometric-abstract-echos-web-design-agency-logo-20251224115913dNSn.png', '38.87 KB', '2026-01-09 15:53:53'),
(438, 22, 'freepik-geometric-abstract-echos-web-design-agency-logo-20251224120109JcxL.png', '6.28 KB', '2026-01-09 15:53:53'),
(479, 25, '11518988_4762141.png', '31.37 KB', '2026-01-09 15:17:27'),
(480, 25, '13706161_2012.i032.017.isometric medical operating room horizontal banner (1).png', '211.25 KB', '2026-01-09 15:17:27'),
(481, 25, 'Untitled 2.tiff', '542.01 KB', '2026-01-09 13:55:44'),
(482, 25, 'Untitled 3.tiff', '590.59 KB', '2026-01-09 13:55:44'),
(483, 25, 'Untitled 4.tiff', '464.83 KB', '2026-01-09 13:55:44'),
(484, 25, 'Untitled 2 copy.tiff', '1.04 MB', '2026-01-09 13:55:44'),
(485, 25, 'Untitled 5.tiff', '1.91 MB', '2026-01-09 13:55:44'),
(486, 25, 'Untitled 2.tiff', '542.01 KB', '2026-01-09 13:12:44'),
(487, 25, 'Untitled 2 copy.tiff', '1.04 MB', '2026-01-09 13:12:44'),
(488, 25, 'Untitled 7.tiff', '525.46 KB', '2026-01-09 12:54:50'),
(489, 25, 'IMG_5275 (1) (1) (1).jpeg', '2.54 MB', '2026-01-09 08:34:48'),
(490, 27, '5D5BF9AB-AFC0-4101-A8B4-5C4ECCFCB0D6.jpg', '226.01 KB', '2026-01-12 09:07:53'),
(491, 27, '6BDBFD61-86BD-44F5-BA58-A8C6AEE34B1F.jpg', '253.1 KB', '2026-01-12 09:07:53'),
(492, 27, '0_zWCTHFNFdGAgSw2d.jpg', '6.81 KB', '2026-01-12 09:05:41'),
(493, 27, 'Untitled 5.tiff', '1.91 MB', '2026-01-09 13:59:45'),
(494, 27, 'Untitled 7.tiff', '525.46 KB', '2026-01-09 13:59:16'),
(495, 27, 'Untitled 6.tiff', '517.46 KB', '2026-01-09 13:59:16'),
(496, 27, 'Untitled 8.tiff', '1.21 MB', '2026-01-09 13:59:16');

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
(89, 8, 'Jonh Smith'),
(90, 8, 'Mike Johnson'),
(106, 18, 'John Doe'),
(107, 18, 'Jonh Smith'),
(154, 21, 'John Doe'),
(155, 21, 'Jonh Smith'),
(162, 19, 'John Doe'),
(163, 19, 'Jonh Smith'),
(166, 26, 'John Doe'),
(167, 26, 'Jonh Smith');

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
(1, 'John Doe', 'john@example.com', 'Developer', 'Engineering', '', 'inactive', '2025-12-16 14:01:58'),
(2, 'Jonh Smith', 'jane@example.com', 'Designer', 'Design', '', 'active', '2025-12-16 14:01:58'),
(3, 'Mike Johnson', 'mike@example.com', 'Manager', 'Management', NULL, 'active', '2025-12-16 14:01:58'),
(4, 'Sarah Williams', 'sarah@example.com', 'Developer', 'Engineering', NULL, 'active', '2025-12-16 14:01:58'),
(5, 'Tom Brown', 'tom@example.com', 'Marketing', 'Marketing', NULL, 'active', '2025-12-16 14:01:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `project_comments`
--
ALTER TABLE `project_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=497;

--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD CONSTRAINT `calendar_events_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `team_members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `calendar_events_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

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