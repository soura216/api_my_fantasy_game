-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2020 at 07:25 AM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_dbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `login_type` varchar(250) NOT NULL,
  `user_type` int(155) NOT NULL,
  `name` varchar(250) NOT NULL,
  `device_token` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `login_type`, `user_type`, `name`, `device_token`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'mobile', 0, 'Admin', 'b22d5a1d42209cc5e12def812ad3ecc0'),
(7, 'soura216@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'mobile', 1, 'Soura', '40213d22107f2114178d42a074eeccb5'),
(8, 'farman52@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'mobile', 1, 'Farman', '1b5a29681efd595c1d8e6a3408c52e75');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(150) NOT NULL,
  `video_category_id` int(150) NOT NULL,
  `url` varchar(250) NOT NULL,
  `thumbnail_img` varchar(250) NOT NULL,
  `user_id` int(150) NOT NULL,
  `language` varchar(255) NOT NULL,
  `is_trending` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

CREATE TABLE `video_category` (
  `id` int(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_category`
--

INSERT INTO `video_category` (`id`, `name`, `icon`, `created_at`) VALUES
(1, 'Marvel Vs DC', '2020-05-17_09:27:06-494efc18f31f4bfa7812f9de2ee40cc017d6a350.jpeg', '2020-05-17 09:27:06'),
(2, 'The Joker', '2020-05-17_09:28:42-9111_preview.png', '2020-05-17 09:28:42'),
(3, 'DC Cat Woman', '2020-05-17_09:29:14-Char_GetToKnow_Catoman_5c9c20bd512929.90002553.png', '2020-05-17 09:29:14'),
(4, 'Avenger', '2020-05-17_09:29:41-dc-Cover-652ovhkibhg82kh6on274ihkn1-20171208011414.Medi.jpeg', '2020-05-17 09:29:41'),
(5, 'Justice league', '2020-05-17_09:30:29-download.jfif', '2020-05-17 09:30:29'),
(6, 'Justice League: The Flashpoint Paradox', '2020-05-17_09:31:11-images1.jfif', '2020-05-17 09:31:11'),
(7, 'Bat Man Vs Spider Man', '2020-05-17_09:32:11-images2.jfif', '2020-05-17 09:32:11'),
(8, 'Captain Marvel', '2020-05-17_09:32:45-images3.jfif', '2020-05-17 09:32:45'),
(9, 'Avenger Warrior', '2020-05-17_09:33:12-images4.jfif', '2020-05-17 09:33:13'),
(10, 'Marvel Women', '2020-05-17_09:33:44-images.jfif', '2020-05-17 09:33:44'),
(11, 'Captain Marvel Vs BatMan Vs Captain America', '2020-05-17_09:34:41-K7gg2QywQYL36B7yDEGncm.jpg', '2020-05-17 09:34:41'),
(12, 'Avengers: Age of Ultron', '2020-05-17_09:35:42-maxresdefault.jpg', '2020-05-17 09:35:43'),
(13, 'The Dark Knight Rises', '2020-05-17_09:37:04-Superhero-movies-on-Netflix-1366x768.jpg', '2020-05-17 09:37:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_category`
--
ALTER TABLE `video_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_category`
--
ALTER TABLE `video_category`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
