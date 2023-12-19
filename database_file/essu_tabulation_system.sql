-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 07:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essu_tabulation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `mobile_number`, `birthday`, `sex`, `address`) VALUES
(1, 'Isabella Cruz', '09123456789', '2023-12-16', 'Female', 'Sample Address'),
(2, 'Olivia Chen', '09123456789', '2023-12-16', 'Female', 'Sample Address'),
(3, 'Sophia Williams', '09123456789', '2023-12-16', 'Female', 'Sample Address'),
(4, 'Ava Johnson', '09123456789', '2023-12-16', 'Female', 'Sample Address'),
(5, 'Emily Nguyen', '09123456789', '2023-12-16', 'Female', 'Sample Address'),
(6, 'Ethan Wilson', '09123456789', '2023-12-16', 'Male', 'Sample Address'),
(7, 'Alexander Rivera', '09123456789', '2023-12-16', 'Male', 'Sample Address'),
(8, 'Noah Khan', '09123456789', '2023-12-16', 'Male', 'Sample Address'),
(9, 'Daniel Cooper', '09123456789', '2023-12-16', 'Male', 'Sample Address'),
(10, 'Jameson Lee', '09123456789', '2023-12-16', 'Male', 'Sample Address');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Production', 'This category is a grand display of creativity and showmanship, where contestants showcase their stage presence, charisma, and ability to captivate the audience through a themed performance. It often involves choreography, music, costumes, and props, allowing contestants to exhibit their confidence, grace, and overall presentation skills.'),
(2, 'Evening Gown', 'The Evening Gown segment is a moment of elegance and sophistication, focusing on the contestants poise, style, and grace. Here, participants wear exquisite evening gowns that reflect their personal taste and individuality. This category emphasizes not just fashion but also how each contestant carries herself, exuding confidence and gracefulness while walking the stage.'),
(3, 'Question & Answer', 'The Q&A segment tests contestants intelligence, eloquence, and ability to think on their feet. Contestants are asked thought-provoking questions, ranging from current events to personal opinions. This segment is pivotal as it allows contestants to articulate their thoughts clearly, demonstrate their knowledge, and convey their values and opinions effectively.'),
(4, 'Semi-Finals', 'The Semi-Finals mark a crucial stage where contestants are evaluated based on their overall performance throughout the competition. Judges consider various factors including confidence, personality, stage presence, and how well contestants have presented themselves across different categories. This round narrows down the pool of contestants, selecting those who will advance to the Final round.'),
(5, 'Finals', 'The Finals are the pinnacle of the competition, where the top contestants showcase their best attributes and vie for the crown. It typically includes all the major categories—Production, Evening Gown, and Q&A. Contestants exhibit their utmost confidence, grace, intelligence, and personality, striving to leave a lasting impression on the judges and audience. The Final round determines the winner who embodies the values and essence of the beauty pageant.');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `category_id`, `status`) VALUES
(1, 1, 'Pending'),
(2, 2, 'Pending'),
(3, 3, 'Pending'),
(4, 4, 'Pending'),
(5, 5, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `judges`
--

CREATE TABLE `judges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_type`) VALUES
(1, 'Administrator', 'admin', '$2y$10$qZaaUdNw9dwAlnMZDFfqSOj5mVKvlNC86XHgRRWs/UaKyQMHZINby', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
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
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `judges`
--
ALTER TABLE `judges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
