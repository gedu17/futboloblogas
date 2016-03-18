-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 m. Kov 18 d. 16:50
-- Server version: 10.0.24-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pinkpong_g`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL,
  `date` int(20) NOT NULL,
  `text` text NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `polls`
--

INSERT INTO `polls` (`id`, `name`, `active`) VALUES
(2, 'Nauja apklausa1', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `poll_answers`
--

CREATE TABLE IF NOT EXISTS `poll_answers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `poll` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `poll_votes` (
  `id` int(10) NOT NULL,
  `poll` int(10) NOT NULL,
  `answer` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `poll_votes`
--

INSERT INTO `poll_votes` (`id`, `poll`, `answer`, `uid`) VALUES
(4, 2, 8, 1),
(5, 2, 9, 1),
(6, 2, 10, 1),
(7, 2, 7, 1),
(8, 2, 9, 1),
(9, 2, 9, 1),
(10, 2, 9, 1),
(11, 2, 8, 4),
(12, 2, 10, 5);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  `text` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  `activation_code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `temp_id` varchar(255) NOT NULL,
  `password_recovery` varchar(255) NOT NULL,
  `active` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `activation_code`, `temp_id`, `password_recovery`, `active`) VALUES
(1, 'admin', '$2y$10$F/pOtNAPN9KTe1R6tH8fCukqYxbslXa84vOYx/ety7PJzHHa3hKBy', 'dulskasg@gmail.com', 9, '1231', '7b0089f4e2a4a177c25a0f2cb915d462443e75fb2919782770a7501216fcf5ee', '', 1),
(4, 'testas', '$2y$10$6lgCecwUOPsJlUHbak.twuO9R9niN0HTEylJTnaG70wUP0xRK4Hfu', 'naujokas33@dtiltas.lt', 1, '8f8c4320d5e752e109b33193649eaf885dfd4845322f5b16aa1d92f4522921e4', '16467733e30cb0830cb3a5a511743302755af05603fa75f62075373886eac8a0', '', 1),
(5, 'testas2', '$2y$10$IemxkvVuW/cMFkvXK8.zvOmCT0LIDGRWnw/GY9jYt8ppvLErUoxqS', 'naujokas3@yahoo.com', 1, '09b68af4f3640f5c4bba09b4d5bf9cbbfcf8b63c27ab893e817ed94c5ec586fa', '10e013e5e50e16c4a75c50e33b02c7dac9411524831d4f66ba4bbbfb8dd8a0bb', '94c5d34bc0b11a38609106043c4aaa98f1752bc1a682b4215ff19f87b4c3b573', 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
