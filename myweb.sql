-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 m. Kov 17 d. 16:13
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myweb`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `date` int(20) NOT NULL,
  `text` text NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `comments`
--

INSERT INTO `comments` (`id`, `date`, `text`, `post_id`, `user_id`) VALUES
(3, 1457964066, 'lalaila!!', 1, 1),
(4, 1458222310, 'Mano komentaras :))))', 1, 1),
(5, 1458222428, 'NAISLAAAAAAAA', 1, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `polls`
--

CREATE TABLE `polls` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `polls`
--

INSERT INTO `polls` (`id`, `name`, `active`) VALUES
(2, 'Nauja apklausa1', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `poll` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `name`, `poll`) VALUES
(7, 'Gerai atrodo?2', 2),
(8, 'Labai gerai?3', 2),
(9, 'Nelabai gerai :(4', 2),
(10, 'Baisiai :&lt;5', 2);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id` int(10) NOT NULL,
  `poll` int(10) NOT NULL,
  `answer` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `poll_votes`
--

INSERT INTO `poll_votes` (`id`, `poll`, `answer`, `uid`) VALUES
(4, 2, 8, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  `text` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `posts`
--

INSERT INTO `posts` (`id`, `title`, `date`, `text`, `active`) VALUES
(1, 'Testas', 1457950538, 'Testas12313', 1),
(2, 'Testas2', 1457950590, 'Testavone12313123131', 1),
(3, 'Testas123', 1458136801, 'nwa ! ! ! ! ! ! ))) ) ) ) ) ) ) )', 1),
(4, 'Q XzzzQ q a s A', 1458136840, 'zxzz\r\nasd\r\nasd\r\nasd\r\nasdazx', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  `activation_code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `temp_id` varchar(255) NOT NULL,
  `active` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `activation_code`, `temp_id`, `active`) VALUES
(1, 'admin', '$2y$10$93bJxR3S4nzKR6VJAWRCMOdRZCxvVehuZV.cLne0CxmqJTKtM1FBi', 'dulskasg@gmail.com', 9, '1231', '$2y$10$zK5XKVkrCFWP.UGNXeUi0O4AJCKaLsJgDW/LKZVGLkBdqMKs7Ivjy', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
