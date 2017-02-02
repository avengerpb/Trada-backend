-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 04:43 PM
-- Server version: 5.7.16-log
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trada`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category_item`
--

CREATE TABLE `category_item` (
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `item_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_shop`
--

CREATE TABLE `item_shop` (
  `shop_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag`
--

CREATE TABLE `item_tag` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text,
  `point` int(11) NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `shop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` datetime NOT NULL,
  `data` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
(1, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484373218;'),
(2, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484373249;'),
(3, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484373299;'),
(4, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484373302;'),
(5, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374091;'),
(6, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374091;'),
(7, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374278;'),
(8, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374279;'),
(9, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374396;'),
(10, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374397;'),
(11, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374427;'),
(12, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374698;'),
(13, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374757;'),
(14, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374760;'),
(15, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374795;'),
(16, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484374801;'),
(17, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375088;'),
(18, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375094;'),
(19, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375101;'),
(20, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375293;'),
(21, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375294;'),
(22, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375300;'),
(23, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375784;'),
(24, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484375792;'),
(25, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376089;'),
(26, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376094;'),
(27, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376278;'),
(28, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376342;'),
(29, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376345;'),
(30, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376351;'),
(31, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376388;'),
(32, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376392;'),
(33, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376397;'),
(34, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376512;'),
(35, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376587;'),
(36, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376594;'),
(37, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376597;'),
(38, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376633;'),
(39, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376635;'),
(40, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376635;'),
(41, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376641;'),
(42, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376644;'),
(43, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376853;'),
(44, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376855;'),
(45, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376860;'),
(46, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376867;'),
(47, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376870;'),
(48, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376878;email|b:1;is_logged_in|i:1'),
(49, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484376879;'),
(50, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377069;'),
(51, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377070;'),
(52, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377077;'),
(53, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377080;'),
(54, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377086;email|b:1;is_logged_in|i:1'),
(55, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377086;'),
(56, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377449;'),
(57, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377457;'),
(58, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377534;'),
(59, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377536;'),
(60, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377541;'),
(61, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377556;'),
(62, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377690;'),
(63, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377696;'),
(64, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377709;'),
(65, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377714;email|s:24:"baodoan1131996'),
(66, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484377714;'),
(67, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484540816;'),
(68, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484540835;'),
(69, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484540841;'),
(70, '::1', '0000-00-00 00:00:00', '__ci_last_regenerate|i:1484541163;');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(45) DEFAULT NULL,
  `addrerss` varchar(100) DEFAULT NULL,
  `fb_link` varchar(100) DEFAULT NULL,
  `shop_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE `shop_category` (
  `list_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(45) NOT NULL,
  `tag_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `keyid` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`id`, `email`, `password`, `keyid`, `user_name`) VALUES
(1, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '2b9b23e93b9d78d702b925b9fccf80f7', ''),
(2, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '7d1b798c35b8c2d025fc6b86ecdb7905', ''),
(3, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '5695107ee4ae92638a88c6ab6eaf214d', ''),
(4, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '4266684a9d96640817cab6b6b65fea07', ''),
(5, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '054cd062764b640e5f2bcd87f15a146e', ''),
(6, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', 'ff3002f99bb5c2ff3dbd6fbf4b9db6d5', ''),
(7, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '1a4b3abd531ebc3f88449b2408f2520e', ''),
(8, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', '6a4091f329d97e820a2f1aa13ef275fd', ''),
(9, 'baodoan1131996@gmail.com', '202cb962ac59075b964b07152d234b70', 'ab051a480d9cf6520e6c2ec6a3af81e9', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `email` varchar(45) NOT NULL,
  `fb_link` varchar(100) DEFAULT NULL,
  `user_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `level` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `location` varchar(60) DEFAULT NULL,
  `user_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `fb_link`, `user_name`, `password`, `level`, `admin`, `dob`, `location`, `user_image_url`) VALUES
(2, '', 'baodoan1131996@gmail.com', NULL, '', '202cb962ac59075b964b07152d234b70', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_shop`
--

CREATE TABLE `user_shop` (
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_item`
--
ALTER TABLE `category_item`
  ADD PRIMARY KEY (`category_id`,`item_id`),
  ADD KEY `fk_category_item_item1_idx` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id_UNIQUE` (`item_id`);

--
-- Indexes for table `item_shop`
--
ALTER TABLE `item_shop`
  ADD PRIMARY KEY (`shop_id`,`item_id`),
  ADD KEY `fk_item_shop_item1_idx` (`item_id`);

--
-- Indexes for table `item_tag`
--
ALTER TABLE `item_tag`
  ADD PRIMARY KEY (`item_id`,`tag_id`),
  ADD KEY `fk_has_tag_items1_idx` (`item_id`),
  ADD KEY `fk_has_tag_tags1_idx` (`tag_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_Users1_idx` (`user_id`),
  ADD KEY `fk_review_shop1_idx` (`shop_id`),
  ADD KEY `fk_review_category1_idx` (`category_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Sess_id_UNIQUE` (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `Shop_id_UNIQUE` (`shop_id`);

--
-- Indexes for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `fk_contain_category_categories1_idx` (`category_id`),
  ADD KEY `fk_contain_category_Shops1_idx` (`shop_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `User_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `Email_UNIQUE` (`email`),
  ADD UNIQUE KEY `Username_UNIQUE` (`user_name`);

--
-- Indexes for table `user_shop`
--
ALTER TABLE `user_shop`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_own_Shops1_idx` (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_item`
--
ALTER TABLE `category_item`
  ADD CONSTRAINT `fk_category_item_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_category_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_shop`
--
ALTER TABLE `item_shop`
  ADD CONSTRAINT `fk_item_shop_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_shop_shop1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_tag`
--
ALTER TABLE `item_tag`
  ADD CONSTRAINT `fk_has_tag_items1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_has_tag_tags1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_review_shop1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reviews_Users1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD CONSTRAINT `fk_contain_category_Shops1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contain_category_categories1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_shop`
--
ALTER TABLE `user_shop`
  ADD CONSTRAINT `fk_own_Shops1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_shop_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
