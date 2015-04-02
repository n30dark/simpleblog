-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2015 at 02:03 AM
-- Server version: 5.5.40-36.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `simpleblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `slug`, `text`, `date`) VALUES
(1, '', 'test', 'huisckjgvyusbjfnj\r\napgkajnodbg\\o\r\nhda\r\nhs\r\n[dospbosd\r\nfnghosdnjo[gjhsopdgjhgiojdsopo\r\n[jbo[', '2015-04-01 22:09:56'),
(3, 'hsdukhdyghjk', '', 'hjkhjkjkhjk', '2015-04-01 23:23:21'),
(2, 'Test', 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus maximus ac lectus ut posuere. Aliquam erat volutpat. Suspendisse sem augue, dapibus at dictum vel, cursus nec nunc. Mauris faucibus quam dolor, vel pretium turpis ultrices ac. Nam lobortis vitae nisi vitae maximus. Integer rhoncus varius mauris eu sagittis. Nunc ut cursus felis.', '2015-04-01 22:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
-- pass: password_123
--

INSERT INTO `user` (`id`, `user`, `password`) VALUES
(1, 'admin', 'd9ac0dc422bf74936143ccdb4c7bbb6d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;