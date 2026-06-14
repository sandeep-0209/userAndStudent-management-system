-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2026 at 07:43 AM
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
-- Database: `userandstudent_management_system1`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `mobile`, `course`, `city`, `created_at`) VALUES
(4, 'avadesh kumar gupta', 'avadhesh12@gmail.com', '8787675466', 'PHP Developer', 'Kaushambi', '2026-06-11 10:50:32'),
(7, 'Akash maurya', 'akshmaurya12@gmail.com', '9878765423', 'Full stack', 'Lucknow', '2026-06-12 12:54:30'),
(8, 'Mohit yadav', 'mohityadav123@gmail.com', '9876543', 'Chemical eng', 'Raibarelly', '2026-06-12 13:46:50'),
(9, 'Deepak kumar', 'deepak1234@gmai.com', '8787675643', 'ADCA', 'Manjhanpur', '2026-06-12 13:52:56'),
(11, 'shri prakash singh', 'shriprakash12@gmail.com', '9889764543', 'Mobile development', 'Raibareely', '2026-06-13 05:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(6, 'Akash Maurya', 'akash957@gmail.com', '$2y$10$P5rInjrO2GrM3KAWDqj6MezQeNdaX49lLSNf2F6YmxRojQOc1PWEe', '2026-06-11 07:02:51'),
(8, 'Sanjeet kumar', 'sanjeet143@gmail.com', '$2y$10$fRvPod6/PGDzoCfvRlW/muPc0SPO1wJp/QtBv8IlihCcKjXSiJOI6', '2026-06-11 07:47:41'),
(10, 'Kamal singh', 'kamal183@gmail.co', '$2y$10$UA7rq.3eRHmgRVS77jGWyuSg5ov37whJw7REd8pB5eHYf8UFBDq9u', '2026-06-11 09:07:30'),
(12, 'Ankita keshri', 'ankita12@gmail.com', '$2y$10$1gn3Tivq1hEJnG8nrmCFBuvXkZ6a8Ximq/bYzZ5E1PizDISbchYaO', '2026-06-11 09:25:36'),
(13, 'Deepu maurya', 'deepu1234@gmail.com', '$2y$10$LSm7P4xglIvuC.GAuuuPauBIfHfk4ivlH92yd8EVYIRUA0WMdPv.q', '2026-06-11 11:05:11'),
(15, 'Anjali shingh', 'anjalisingh12@gmail.com', '$2y$10$E/VdfoOdtVqWOFkrXdDO9uISje242Ub59e/awVTfD3NsrpS8u.FRq', '2026-06-11 12:36:53'),
(17, 'Vidita sharma', 'viditasharma12@gmail.com', '$2y$10$4dpRvEE1qdA83HysiG9FWuaSFrG15cqhgE7fyWUwtuQ41Uw6AZvk.', '2026-06-11 12:38:38'),
(19, 'Dilip singhania', 'dilipsingh12@gmail.com', '$2y$10$ZjooayGjbFUxAXsHVWBYbOR7SrnoEFQi7MABqsMUZSxKuXkLbzrEO', '2026-06-12 13:45:19'),
(20, 'shri prakash singh', 'shriprakash12@gmail.com', '$2y$10$DumvLU4IxCjejt6tBH.GROYXDhal.9oSTY4w49gw/Og.iU5.HLn3G', '2026-06-13 05:44:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
