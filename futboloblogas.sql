-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 m. Kov 24 d. 17:55
-- Server version: 10.0.24-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `comments`
--

INSERT INTO `comments` (`id`, `date`, `text`, `post_id`, `user_id`) VALUES
(1, 1458832057, 'Labai &scaron;aunus puslapis !', 1, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `polls`
--

INSERT INTO `polls` (`id`, `name`, `active`) VALUES
(1, 'Ar gražus puslapis?', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `poll_answers`
--

CREATE TABLE IF NOT EXISTS `poll_answers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `poll` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `name`, `poll`) VALUES
(1, 'Labai!', 1),
(2, 'OK', 1),
(3, 'Nelabai', 1),
(4, 'Baisus puslapis', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `poll_votes`
--

CREATE TABLE IF NOT EXISTS `poll_votes` (
  `id` int(10) NOT NULL,
  `poll` int(10) NOT NULL,
  `answer` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Pavyzdinis įrašas', 1457950538, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a justo velit. Nam sed tincidunt mi. Ut a tincidunt lacus, eu dapibus velit. In eu feugiat lorem. Duis eu ligula fringilla, vulputate sapien non, vulputate dolor. Sed eget odio at ligula luctus volutpat in eu erat. Donec aliquet quis neque sit amet consectetur. Vestibulum erat quam, interdum non ligula egestas, condimentum suscipit urna. Aliquam erat volutpat. Cras tempus, quam non porta consectetur, odio mi tempor libero, eu vulputate odio arcu vitae nisl. Phasellus faucibus gravida nibh, nec accumsan nisl molestie et. Cras rutrum nisl ex, lacinia consequat mauris semper quis. Proin faucibus iaculis leo eu lacinia. Etiam egestas at lorem at dignissim. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam non lectus convallis arcu gravida ornare.\r\n\r\nInteger eros tortor, rutrum sed ex quis, sollicitudin malesuada felis. Duis maximus feugiat commodo. Nulla ut sapien vel purus facilisis semper. Suspendisse vulputate lacus ac turpis aliquet luctus. Donec quis neque pulvinar, porttitor sapien vitae, convallis elit. Duis id porta lacus. Suspendisse lacus nisi, tristique at cursus a, consectetur ut purus.\r\n\r\nVestibulum eu neque ut purus tristique fringilla. Nullam blandit condimentum eros eget pellentesque. Etiam in magna sit amet sapien scelerisque tempor nec at justo. In felis velit, pellentesque at placerat ac, fermentum non lectus. Praesent rutrum orci vel mollis feugiat. Quisque condimentum vel lorem sed interdum. Pellentesque eget elementum quam. Fusce porta diam elit, in ullamcorper turpis fringilla in. Mauris ut dui sed dolor mattis mattis.', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `activation_code`, `temp_id`, `password_recovery`, `active`) VALUES
(1, 'admin', '$2y$10$r6VkTrwroHXSXQRH3USlHOzkN2Fg95NkxJh0R3KzhGSuMDpj7i8Hi', 'dulskasg@gmail.com', 9, '', 'caa1b810e234af44fbd9b847f0abddb22887e48601c953e198c0c87c42718a63', '', 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
