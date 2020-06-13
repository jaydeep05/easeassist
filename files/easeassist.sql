-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2020 at 03:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easeassist`
--

-- --------------------------------------------------------

--
-- Table structure for table `affirm`
--

CREATE TABLE `affirm` (
  `id` int(11) NOT NULL,
  `affirm` text NOT NULL,
  `centroid` text DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `cred_name` text NOT NULL,
  `cred_key` text NOT NULL,
  `proj_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `cred_name`, `cred_key`, `proj_id`, `user_id`, `date_created`) VALUES
(1, 'sdfg', '', 24, 2, '2020-06-08 19:49:05'),
(2, 'we', 'e04731899f1c6f9d48d6aceffda87c50', 26, 2, '2020-06-08 20:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `deny`
--

CREATE TABLE `deny` (
  `id` int(11) NOT NULL,
  `deny` text NOT NULL,
  `centroid` text DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `greet`
--

CREATE TABLE `greet` (
  `id` int(11) NOT NULL,
  `greet` text NOT NULL,
  `centroid` text DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inform`
--

CREATE TABLE `inform` (
  `id` int(11) NOT NULL,
  `inform` text NOT NULL,
  `centroid` text DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` text NOT NULL,
  `company_name` text NOT NULL,
  `developer_name` text NOT NULL,
  `project_type` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `company_name`, `developer_name`, `project_type`, `user_id`, `status`, `date_created`) VALUES
(24, 'test_project 1', 'test company', 'test dev', 'test project type', 2, 1, '2020-06-08 13:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `ques` text NOT NULL,
  `replys` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `ques`, `replys`, `user_id`, `pro_id`, `date_created`) VALUES
(9, 'question1', 'answer1', 2, 12, '2020-02-28 00:43:20'),
(10, 'question2', 'anser2', 2, 12, '2020-02-28 00:43:43'),
(11, 'thereq', 'ansq', 1, 13, '2020-02-28 00:45:21'),
(12, 'esuryuesiyr', 'sedjfshjk', 1, 13, '2020-02-28 00:45:26'),
(13, 'weqwe', 'qweqweq231324', 2, 14, '2020-02-28 01:01:42'),
(14, 'asdf', 'asdf', 2, 15, '2020-02-28 01:18:01'),
(15, 'question12', 'asd', 2, 16, '2020-02-28 04:05:40'),
(16, 'question13', 'asd', 2, 16, '2020-02-28 04:06:46'),
(17, 'asd', '1hello', 2, 16, '2020-02-28 05:28:41'),
(18, 'check the name', 'ok done', 2, 17, '2020-02-28 05:56:30'),
(19, 'helle this is a new question', 'this is a answer', 2, 18, '2020-02-28 06:10:45'),
(20, 'demo_question', 'demo_answer', 2, 19, '2020-02-28 07:44:50'),
(21, 'k_question', 'k_answer', 2, 20, '2020-02-28 09:15:59'),
(22, 'just_to_check', 'ccheck_ans', 2, 21, '2020-02-28 09:18:09'),
(23, 'asasa', 'asasa', 2, 22, '2020-02-28 09:35:20'),
(24, 'hello_test', 'hi', 2, 23, '2020-03-03 08:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `remainders`
--

CREATE TABLE `remainders` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `detail` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(100) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`id`, `question`, `answer`) VALUES
(32, 'quw1', 'ans1'),
(33, 'quw2', 'ans2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'urja112', '', '1234'),
(2, 'asd', 'jd', 'asd'),
(3, 'vas', 'vas', 'vas'),
(4, 'kri', 'kri', 'kri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affirm`
--
ALTER TABLE `affirm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proj_id` (`proj_id`);

--
-- Indexes for table `deny`
--
ALTER TABLE `deny`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `greet`
--
ALTER TABLE `greet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inform`
--
ALTER TABLE `inform`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_fk_user` (`user_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ques` (`ques`) USING HASH;

--
-- Indexes for table `remainders`
--
ALTER TABLE `remainders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affirm`
--
ALTER TABLE `affirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deny`
--
ALTER TABLE `deny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `greet`
--
ALTER TABLE `greet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inform`
--
ALTER TABLE `inform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `remainders`
--
ALTER TABLE `remainders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
