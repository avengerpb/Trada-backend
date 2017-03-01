-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2017 at 04:43 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

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

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `shop_id`, `item_name`, `price`, `item_image_url`) VALUES
(8, 0, 'Iphone 6', 15000000, NULL),
(9, 0, 'Jeans', 200000, NULL),
(10, 0, 'Chicken', 200000, NULL);

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
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('10ta7rrfruc7jn3b7gulsf8luoktdcef', '::1', 1488266498, 0x4642524c485f73746174657c733a33323a226431393364333065646162353734353563373662363331333363663531643030223b),
('1k17j2snnhoa1t66pd9945tocp3gen3c', '::1', 1488291398, 0x4642524c485f73746174657c733a33323a226235636164313532363266656361323232633430346165623562303439393866223b),
('3mjbm4n4blavljpnmvj1rnlurla4j3h2', '::1', 1488267055, 0x4642524c485f73746174657c733a33323a223138636437346163303736386164333436323038323333633966616539633064223b),
('5fgvi8bkmku4l5egdfb7c4a0ruinj9s2', '::1', 1488137202, ''),
('6diuru9odoskmlfm0ma9nrlrjtbl8p2c', '::1', 1488291282, 0x4642524c485f73746174657c733a33323a226162333764356164303536323638383333363765666165646336363962663064223b),
('8anhag8njek689otgabm77a95gcpu6so', '::1', 1488168763, 0x4642524c485f73746174657c733a33323a223562336366656562643562313838353234313533646436333265313432343939223b5f5f63695f6c6173745f726567656e65726174657c693a313438383136383433353b),
('a3dpoliiofklesu0tjkelbjsu6p5majp', '::1', 1488251539, ''),
('a9fdb7mmivlagngnmij6d02gl1nnvqkh', '::1', 1488129484, 0x4642524c485f73746174657c733a33323a223935633035663530613832316263653265653032653966626336623735353833223b),
('adqdkbi547jl07feb6t51qfth6oh84rm', '::1', 1488266378, 0x4642524c485f73746174657c733a33323a223131643865653533633732653537383336323832353234623663363035363230223b),
('ale1ag5q4qb9eteun4unod4aq419e1nu', '::1', 1488199998, ''),
('cdmk5qflnd4egmojnm4sbi3kj7t0cooa', '::1', 1488274628, ''),
('clkf6odr917g1l3lg8n3ur437oogg0bs', '::1', 1488293729, ''),
('ct6brtrng40lplliup4krp1m6lpc6toi', '::1', 1488118173, 0x4642524c485f73746174657c733a33323a226634323537623262613435303034666437343335656232626631323064633330223b5f5f63695f6c6173745f726567656e65726174657c693a313438383131373930343b757365725f6e616d657c733a383a22736965756e68616e223b656d61696c7c733a32373a226e677579656e6d696e686475633138303340676d61696c2e636f6d223b66756c6c5f6e616d657c733a383a22736965756e68616e223b69735f6c6f676765645f696e7c693a313b757365725f696d6167655f75726c7c733a3132333a2268747470733a2f2f696d672e636c6970617274666573742e636f6d2f34376565373966363931353735386632663464376233333937326463386331375f626c616e6b2d70726f66696c652d636c69702d6172742d61742d636c69706172742d70726f66696c652d70696374757265735f3630302d3435302e706e67223b),
('d28q3a55gqt0gtnodaf6nfl8td27ka3m', '::1', 1488218089, ''),
('d6qhdicl7mt05djsmkmmkgf5mnf76evb', '::1', 1488137834, ''),
('djmon0dco02shnfucp3nql27oa1qknjh', '::1', 1488295376, 0x757365725f6e616d657c733a383a22736965756e68616e223b656d61696c7c733a32373a226e677579656e6d696e686475633138303340676d61696c2e636f6d223b66756c6c5f6e616d657c733a383a22736965756e68616e223b69735f6c6f676765645f696e7c693a313b757365725f696d6167655f75726c7c733a3132333a2268747470733a2f2f696d672e636c6970617274666573742e636f6d2f34376565373966363931353735386632663464376233333937326463386331375f626c616e6b2d70726f66696c652d636c69702d6172742d61742d636c69706172742d70726f66696c652d70696374757265735f3630302d3435302e706e67223b4642524c485f73746174657c733a33323a223732386435373364363165643061323562663966663434323834636337323065223b5f5f63695f6c6173745f726567656e65726174657c693a313438383239353238373b),
('dkmqmu698qdabopbhfha8jbbhmo9ao45', '::1', 1488291686, ''),
('ekcpnlrp4e11dnugd0qc3gj4r70i6rlc', '::1', 1488221711, 0x4642524c485f73746174657c733a33323a223263383938316339363930303031663366353835323638306564626364303432223b),
('fk9eln4qcpcfd4t5fddrqen95nelomr2', '::1', 1488203054, ''),
('hhl9nevo26hokbmirnmen01r5gaanb4f', '::1', 1488294784, 0x757365725f6e616d657c733a383a22736965756e68616e223b656d61696c7c733a32373a226e677579656e6d696e686475633138303340676d61696c2e636f6d223b66756c6c5f6e616d657c733a383a22736965756e68616e223b69735f6c6f676765645f696e7c693a313b757365725f696d6167655f75726c7c733a3132333a2268747470733a2f2f696d672e636c6970617274666573742e636f6d2f34376565373966363931353735386632663464376233333937326463386331375f626c616e6b2d70726f66696c652d636c69702d6172742d61742d636c69706172742d70726f66696c652d70696374757265735f3630302d3435302e706e67223b4642524c485f73746174657c733a33323a223732386435373364363165643061323562663966663434323834636337323065223b5f5f63695f6c6173745f726567656e65726174657c693a313438383239343032383b),
('hqqg3t3g12uacs8oetvucmflrkf7af5q', '::1', 1488291326, ''),
('j2vk7kai3b0t805n8c4oif7a6htr6o6u', '::1', 1488266527, ''),
('j5pu0ihi2n68bkuc18q30oea7bv19048', '::1', 1488211103, ''),
('j7pd6usad0u292g4oj46mkf7tbis9sac', '::1', 1488167008, 0x4642524c485f73746174657c733a33323a226539333961306139333037633634303266656361623433326535313539343766223b),
('jhsvchcputclnqf16go784n3gfp3r72p', '::1', 1488178987, ''),
('jjsu32hepurrigthj2f8r0bjpp3blbk3', '::1', 1488291432, 0x4642524c485f73746174657c733a33323a226431343831646137306438623732363237656239633139346630363866373565223b),
('lf9i3fg6lci10m94pdioudmpvplututq', '::1', 1488161987, ''),
('lsv4r8agn9v572d314884uhmo48nvcgg', '::1', 1488266520, ''),
('m3gvvp26ioprtjgreergiro3ev2v80ho', '::1', 1488293420, ''),
('nav8q5gl9975h427e5t223f9h8gdp5pr', '::1', 1488252322, 0x4642524c485f73746174657c733a33323a226136346566613265313864326133393436336139346336643865613665613761223b),
('ocl5ubq2sqh8ihk1qna3jhqp6effstsi', '::1', 1488266372, 0x4642524c485f73746174657c733a33323a223965636661343737303062386138323732623134343135333432323437313739223b),
('pf3nmpso5uktsl2pd9ba0dhbhucbiml5', '::1', 1488291343, ''),
('pg6tb4k29v3j0cbaqpl2gcf5grai2nfq', '::1', 1488137766, 0x4642524c485f73746174657c733a33323a226364663137616339353432636263303733393231616430323133336662333561223b),
('qip8qidpt76v04ms1i3drcsn5jrmgu58', '::1', 1488293094, 0x4642524c485f73746174657c733a33323a223233613763323832626533633662313939323131396639323064613539653032223b757365725f6e616d657c733a383a22736965756e68616e223b656d61696c7c733a32373a226e677579656e6d696e686475633138303340676d61696c2e636f6d223b66756c6c5f6e616d657c733a383a22736965756e68616e223b69735f6c6f676765645f696e7c693a313b757365725f696d6167655f75726c7c733a3132333a2268747470733a2f2f696d672e636c6970617274666573742e636f6d2f34376565373966363931353735386632663464376233333937326463386331375f626c616e6b2d70726f66696c652d636c69702d6172742d61742d636c69706172742d70726f66696c652d70696374757265735f3630302d3435302e706e67223b5f5f63695f6c6173745f726567656e65726174657c693a313438383239323733363b),
('r9cbjvp9h7hdd0f158k8r06jl5a20fr1', '::1', 1488293963, 0x4642524c485f73746174657c733a33323a226335313930373661366430363266646435663336646531663562346536333238223b),
('ral7oq9b76677ft7cork4n9in9mbr9q2', '127.0.0.1', 1486375785, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438363337353635343b656d61696c2f757365725f6e616d657c733a333a22616263223b69735f6c6f676765645f696e7c693a313b),
('rkv3tku8ptv3jpdd2076op21m2obsi4k', '::1', 1488137353, 0x4642524c485f73746174657c733a33323a223832663739616538383333383930303338663538613832353034323561346236223b),
('ro69g52f1nv2f1hbakckjfurr5h3to3b', '::1', 1488295284, 0x757365725f6e616d657c733a383a22736965756e68616e223b656d61696c7c733a32373a226e677579656e6d696e686475633138303340676d61696c2e636f6d223b66756c6c5f6e616d657c733a383a22736965756e68616e223b69735f6c6f676765645f696e7c693a313b757365725f696d6167655f75726c7c733a3132333a2268747470733a2f2f696d672e636c6970617274666573742e636f6d2f34376565373966363931353735386632663464376233333937326463386331375f626c616e6b2d70726f66696c652d636c69702d6172742d61742d636c69706172742d70726f66696c652d70696374757265735f3630302d3435302e706e67223b4642524c485f73746174657c733a33323a223732386435373364363165643061323562663966663434323834636337323065223b5f5f63695f6c6173745f726567656e65726174657c693a313438383239343738373b),
('u4dnt5tpquo2ee12m90t27f1o8anbbef', '::1', 1488222499, 0x4642524c485f73746174657c733a33323a226136303531376134373262343563316239373431636461353731336263343364223b5f5f63695f6c6173745f726567656e65726174657c693a313438383232313738333b66616365626f6f6b5f6163636573735f746f6b656e7c733a3138303a2245414151737769386433437342414d6c757139743755344271514b72716f525843517a46335a42576762536857734463774b417034445a424b5565486e594b4c624c476c32754e484453357a57354478554e7353356d777a5a4242725a42786d65795a435a4347455634504c313346377a4d3764743143326d36426a5253674c6c67795a426d5a423573536b6f4a4b6779516a79717932446555797152366f55446470576a3346675a427969425135675a445a44223b656d61696c7c733a32363a226e677579656e6d696e68647563313833407961686f6f2e636f6d223b757365725f6e616d657c733a31363a2231313134393034373238363139333230223b66756c6c5f6e616d657c733a31353a22c490e1bba963204e677579e1bb856e223b69735f6c6f676765645f696e7c693a313b757365725f696d6167655f75726c7c733a3134353a2268747470733a2f2f73636f6e74656e742e78782e666263646e2e6e65742f762f74312e302d312f7035307835302f31363430363438325f313130343030373936363337353636335f323832343133303433333031333732303030385f6e2e6a70673f6f683d3063393534643561383639386537383435383733373734316662663335326536266f653d3539324441443830223b),
('v7unb3cp3tpbgjm3da8nmf4os215jjns', '::1', 1488137481, '');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `fb_link` varchar(100) DEFAULT NULL,
  `shop_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `address`, `fb_link`, `shop_image_url`) VALUES
(1, 'TUTL', 'Ha Noi', NULL, NULL),
(2, 'LMAO', 'HCM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE `shop_category` (
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
  `user_image_url` varchar(255) NOT NULL DEFAULT 'https://img.clipartfest.com/47ee79f6915758f2f4d7b33972dc8c17_blank-profile-clip-art-at-clipart-profile-pictures_600-450.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `fb_link`, `user_name`, `password`, `level`, `admin`, `dob`, `location`, `user_image_url`) VALUES
(8, 'Đức Nguyễn', 'nguyenminhduc183@yahoo.com', 'https://www.facebook.com/app_scoped_user_id/1114904728619320/', '1114904728619320', '', 0, 0, '1996-03-18', 'Ha Noi', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/16406482_1104007966375663_2824130433013720008_n.jpg?oh=0c954d5a8698e78458737741fbf352e6&oe=592DAD80'),
(10, 'sieunhan', 'nguyenminhduc1803@gmail.com', NULL, 'sieunhan', '4573692e1e0e68f7c26244c792e70ed4', 0, 0, NULL, NULL, 'https://img.clipartfest.com/47ee79f6915758f2f4d7b33972dc8c17_blank-profile-clip-art-at-clipart-profile-pictures_600-450.png'),
(11, 'aaaaa', 'aaaaa@gmail.com', NULL, 'aaaa', 'ddddd', 0, 0, NULL, NULL, 'https://img.clipartfest.com/47ee79f6915758f2f4d7b33972dc8c17_blank-profile-clip-art-at-clipart-profile-pictures_600-450.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_shop`
--

CREATE TABLE `user_shop` (
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_shop`
--

INSERT INTO `user_shop` (`user_id`, `shop_id`) VALUES
(10, 1),
(10, 2);

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
  ADD PRIMARY KEY (`shop_id`,`category_id`),
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
  ADD PRIMARY KEY (`user_id`,`shop_id`),
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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
