-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2018 at 01:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `blog`;

-- --------------------------------------------------------

--
-- Table structure for table `blogposts`
--

CREATE TABLE `blogposts` (
  `postid` int(11) NOT NULL,
  `username` text COLLATE utf8_bin NOT NULL,
  `post` varchar(1000) COLLATE utf8_bin NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `summary` text COLLATE utf8_bin,
  `headpicture` text COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentNum` int(11) NOT NULL,
  `likesNum` int(11) NOT NULL,
  `draft` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blogposts`
--

INSERT INTO `blogposts` (`postid`, `username`, `post`, `title`, `summary`, `headpicture`, `timestamp`, `commentNum`, `likesNum`, `draft`) VALUES
(18, 'Poofpoo', '<p>asdasdasfasdasd</p><figure class=\"image\"><img src=\"/Blog/userfiles/files/pexels-photo-248797.jpeg\"><figcaption>asdasd</figcaption></figure>', 'My blogsafasd', 'This is a test blog', 'images/nophoto.jpg', '2018-09-08 10:44:06', 0, 0, 0),
(19, 'Poofpoo', '<figure class=\"image\"><img src=\"/Blog/userfiles/files/image.jpg\"><figcaption>Lucian</figcaption></figure>', 'My blog', 'This is another test blog ', 'userfiles/Poofpoo/asdasd.jpg', '2018-09-08 10:46:53', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `sessionverification` text COLLATE utf8_bin NOT NULL,
  `firstname` text COLLATE utf8_bin NOT NULL,
  `lastname` text COLLATE utf8_bin NOT NULL,
  `country` text COLLATE utf8_bin NOT NULL,
  `state` text COLLATE utf8_bin NOT NULL,
  `city` text COLLATE utf8_bin NOT NULL,
  `gender` text COLLATE utf8_bin NOT NULL,
  `quote` text COLLATE utf8_bin NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `admin`, `active`, `sessionverification`, `firstname`, `lastname`, `country`, `state`, `city`, `gender`, `quote`, `ID`) VALUES
('Poofpoo', '4e59015f30c22d3ff216be570ffe12c2', 'gasparovic123@gmail.com', 1, 1, 'ba4j781apgm33snvakbai35odm', 'Ivan', 'Gašparović', 'Croatia', 'Slavonija', 'Osijek', 'Male', 'What is love, baby don\'t hurt me', 3),
('Aedan', '4e59015f30c22d3ff216be570ffe12c2', 'sakuno666@gmail.com', 0, 0, '4d9f1bj1i2h6i4ed8nau336mjb', '', '', '', '', '', '', '', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogposts`
--
ALTER TABLE `blogposts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
