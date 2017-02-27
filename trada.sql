-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2017 at 05:34 PM
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
  `category_description` varchar(300) DEFAULT NULL,
  `group_cate_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `group_cate_id`, `priority`) VALUES
(1, 'Clothes', NULL, 0, 2),
(2, 'T-Shirts', NULL, 1, 0),
(3, 'Sextoys', NULL, 0, 6),
(4, 'Vibration', NULL, 3, 0),
(5, 'Houseware', NULL, 0, 4),
(6, 'Fridge', NULL, 5, 1),
(7, 'TV', NULL, 5, 2),
(8, 'Medical', NULL, 0, 5),
(9, 'Electronics Devices', NULL, 0, 3),
(10, 'Accessories', NULL, 0, 1);

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
  `item_description` varchar(300) NOT NULL,
  `item_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `shop_id`, `item_name`, `price`, `item_description`, `item_image_url`) VALUES
(0, 0, 'Demo', 1234, '', ''),
(1, 0, 'Demo', 123, '', ''),
(2, 0, 'Demo', 123, '', ''),
(3, 0, 'Demo', 123, '', NULL),
(4, 0, 'Demo', 123, '', NULL),
(5, 0, 'demo', 123, '', NULL),
(6, 0, 'demo', 123, '', NULL),
(7, 0, 'Demo', 123, '', NULL),
(8, 0, 'Demo', 123, '', NULL),
(9, 0, 'Demo', 123, '', NULL),
(10, 0, 'Demo', 123, '', NULL),
(11, 0, 'Demo', 123, '', NULL),
(15, 0, 'test', 234, '', 'http://localhost/trada-backend/item_images/9005_718769958222419_5163879303044560145_n1.jpg');

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
('0dhucpf982sti2o8s60lajecinisks5g', '::1', 1487676374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637363337343b),
('1o6pqu0ui92ehmcaclodl30qb82k9tvn', '::1', 1487585047, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538353034373b),
('1vpf6nr08eckon0622dmkmvqv4c70f8k', '::1', 1487538187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533383138373b),
('3fa95stb9507hut9bqnltbbh6v77t9mm', '::1', 1487856631, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373835363633313b),
('3hnpsds7ajro9d9botsrd1fh0au40fkb', '::1', 1487658134, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373635383133343b),
('3td0tbv0mfsl85agl1ko0r7qod3al6ln', '::1', 1487777542, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737373534323b),
('4fmf4fki58iunjuao0pl8gebdnnbutsd', '::1', 1487582499, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538323439393b),
('4gjs7cbr3gpccgueafkpg2fp5k36sh2b', '::1', 1487681227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638313232373b),
('4jv83sp0fkk6jtlj0801uve8uk7ulo5s', '::1', 1487864356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836343335363b),
('5g62lc1nr19vq7uikhl2ns0vlado9jh3', '::1', 1487678838, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637383833383b),
('5i5ovid6vtc4i0rv9ne1v7b30f4dlc15', '::1', 1487678139, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637383133393b),
('5iem5fpa5gi4i8bdvvse23t77ivsjd2f', '::1', 1487676863, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637363836333b),
('5j6so65ogucp9gmggsjig800val3dlet', '::1', 1487509854, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373530393835343b),
('5pncb21s5otppg682q6up17skn02732m', '::1', 1487686355, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638363335353b),
('5uj0s30e5cemlg6t9hvl6m76ckpqp5j7', '::1', 1487778243, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737383234333b),
('685da641djm6jdsraiq4due29udhgm1i', '::1', 1487510912, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373531303931323b),
('6e9llalhajkvo7snuvkjs2rs418odvff', '::1', 1487536439, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533363433393b),
('6f3hjqrcf3dj9ijir9uce88gs3ui2duv', '::1', 1487764527, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373736343532373b),
('6m3ed7sm8dpu4l1j2gh8huakjvtqdeno', '::1', 1487761230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373736313233303b),
('76kj3i4vc4vqht6so5fvdsv40clrcfkd', '::1', 1487584598, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538343539383b),
('79bbp96lvbfcco706fut1usi73j62kkv', '::1', 1487403643, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430333634333b),
('7uguslnb5mohv3nlc7nrf6orc57qg83h', '::1', 1487401301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430313330313b6974656d7c733a38373a223c64697620636c6173733d22616c65727420616c6572742d737563636573732220726f6c653d22616c657274223e546865206974656d20776173207375636365737366756c6c792064656c6574656420213c2f6469763e223b5f5f63695f766172737c613a313a7b733a343a226974656d223b733a333a226f6c64223b7d),
('7vfv4nhbhqi5vtd0a9onu42dn8vblipk', '::1', 1487780159, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738303135383b),
('8mlco2fa9vv3t1eg38f5keh5dq6ugj96', '::1', 1487855834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373835353833343b),
('8ou976tns66lfk6jqpotlcuvu8f7je2a', '::1', 1487404542, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430343534323b),
('91f947h9f4aepklu3j2r5oju93ltfqa2', '::1', 1487761709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373736313730393b),
('950m3g91ocnhkp8qvhspjk5ka7u6ml4p', '::1', 1487692991, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639323939313b),
('9ai9o6gdv6fucuaqggljivkjq9oqn2do', '::1', 1487675705, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637353730353b),
('9mo9l3t6cpfmbsjtko0f5lcj7ad3k5gu', '::1', 1487676014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637363031343b),
('aa8a1h74g8rr395q40a88sr7klr6q95f', '::1', 1487538187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533383138373b),
('atrkjptndmggh0feia7ua8b7qpvlrhof', '::1', 1487581961, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538313936313b),
('b1tef6pad22dbt8avip5cl0v9r5oiepc', '::1', 1487402999, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430323939393b),
('bkh4ir03jaadibbo7kbshrgm14afio71', '::1', 1487679870, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637393837303b),
('bo4aoih66qe7ie9qfaid2u1ulmcjm0hv', '::1', 1487584218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538343231383b),
('brm00knm953jqas44lkckrukcvf204th', '::1', 1487749647, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373734393634373b),
('c6aaptjafp5p399hnevdirn3b5srqfu6', '::1', 1487864360, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836343335363b),
('c9vgo5hme8mv9506phe69re2cedm68mf', '::1', 1487686745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638363734353b),
('clveo7p1unk1ncifqvbi33f349kn76g8', '::1', 1487586780, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538363738303b),
('cm9heubs36phna9rlu9mqev6hh4cmuq1', '::1', 1487773458, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737333435383b),
('d0eqincum41db81dq4fs6h5ms8ghbj9r', '::1', 1487776904, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737363930343b),
('d4mnd1m6tjnjg5hbb87ecrmmh8pr4l6q', '::1', 1487689533, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638393533333b),
('d9ajemdepsr6mlnralc0p2vpppia2esg', '::1', 1487510487, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373531303438373b),
('dncdobr5blgjssc8ljri1e627etehhee', '::1', 1487675311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637353331313b),
('dqsp5edutoqsb79i5m00ugv17qi2u48g', '::1', 1487402562, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430323536323b),
('e00kigiqt9eio5djdr8gkf2i029rtdvu', '::1', 1487505581, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373530353538313b),
('e36v903omr6a5ajqa1btgbrc1s7tjedh', '::1', 1487693061, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639323939313b),
('e74s2ajm711urmhrh1th5viutach9csc', '::1', 1487403314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430333331343b),
('edo0e0uc1v5fd9genrrjfcri98m20nb6', '::1', 1487658308, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373635383133343b),
('eh45kfm6l601r9esnpm3b9iqa9kn9pv6', '::1', 1487402261, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430323236313b),
('fj70t4auej3ce00t3kuaop0fiijsmqrc', '::1', 1487532802, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533323830323b),
('fkupdgr290d4v1tjk3uq4gemo3jbo538', '::1', 1487583215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538333231353b),
('fpu3mnndjskua1m0r5ambq36gmnouc2g', '::1', 1487690669, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639303636393b),
('hn91kgk1n73k0dq944kkok0mopmmgpdg', '::1', 1487585993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538353939333b),
('hsfv2gkt6l42mg58ovpds9km00vmlcki', '::1', 1487511109, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373531303931323b),
('ibd8ipmuv4sq52penu0dndrsogude7vl', '::1', 1487405955, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430353637363b),
('ischko0084v0qgpi4m2r9cq2h4r2c3i0', '::1', 1487749180, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373734393138303b),
('iu1s00n1gnkcbn0mf66sfasn7t3jt7dk', '::1', 1487401960, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430313936303b),
('jqsgkodf0qckl50jlob6lvjqot737prq', '::1', 1487774736, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737343733363b),
('k3m6jvsd7hqj6v86tik8fe71a0r4sjs6', '::1', 1487405676, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373430353637363b),
('k4cb3rru3m5uvk8ier9hpl53p4e4b5mt', '::1', 1487587311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538373331313b),
('lqo9mhv6hcu7efro2dr0fv3dg3ectpbr', '::1', 1487692529, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639323532393b),
('m9jjlkjpnrb5bpgfdktesdp11n1ofqe8', '::1', 1487508405, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373530383430353b),
('mq1frn6sq3bmt1p5t1ht7j11ngk0g8od', '::1', 1487581511, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538313531313b),
('mtnecgtbelcj0ligreuohinakm4nqv7k', '::1', 1487774196, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737343139363b),
('nerjegqdcdvo124g767h76igtbp0jt0r', '::1', 1487776475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737363437353b),
('nmtdrktpotqe4evs56bqoiqogr3rmd2l', '::1', 1487685167, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638353136373b),
('nt4iqj8s38ivj13ot1hf5jtd7vq1sj21', '::1', 1487533126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533333132363b),
('o06hlehdt013p2hhbafq4dgaq2ffdkhr', '::1', 1487686010, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638363031303b),
('o42sfmkh27oj9ukv9o7k3k5605hcjnui', '::1', 1487537819, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533373831393b),
('oaaliv8jthiq9orbuajv84jlmcu9705i', '::1', 1487677523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637373532333b),
('odsi3g2f78t9kdlf8bp8q79dp8p7ur6v', '::1', 1487683988, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638333938383b),
('ogrfanr1orele1c2k1ol54dap4ksir54', '::1', 1487683032, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638333033323b),
('olrrhjdf54575r4piepb9ck5djqqt82u', '::1', 1487779132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737393133323b),
('oukmblsahdptjcnvrcjv664iaunlpdpb', '::1', 1487680587, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638303538373b),
('overaij5m76cmih86tho2sr41he1hcdf', '::1', 1487775920, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737353932303b),
('p4nq6a4saph80tfif2d2p7kijf30m370', '::1', 1487685630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638353633303b),
('pl11av21hjl4eks36qierbhgd6rsegdb', '::1', 1487690971, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639303937313b),
('q0hdkkftuhe5t37ms8fbecrgqit8sk9e', '::1', 1487749647, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373734393634373b),
('q4k7a020ubagont9lpkl2dte7i7tktfg', '::1', 1487764770, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373736343532373b),
('q5u15dj1s8hm4qmu654u1u7hmpmnmu7t', '::1', 1487533892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533333839323b),
('qhgu822hpve879f7h0mocfqfu5rv4g2m', '::1', 1487773784, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737333738343b),
('r4g7vg8nom1m5hpi2d2omhbbtvuslj6v', '::1', 1487775307, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737353330373b),
('r4jn7cq8i48ps22hpp70k2pm0kplri6m', '::1', 1487582835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538323833353b),
('rgcvuuq9omn7hv6df615g596dlkaam5i', '::1', 1487507794, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373530373739343b),
('rjedu5g3fvni8boq6lhm2e5lgoeh47ed', '::1', 1487762434, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373736323433343b),
('rml6n91t46dfpu7lpch3luik0q19qj47', '::1', 1487534262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533343236323b),
('sd1n21bqtcouvhaqtncj6bueherp33fg', '::1', 1487536131, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533363133313b),
('se0pariqsc7npghi5on5c29me2g5312i', '::1', 1487780158, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738303135383b),
('soqbrjvek1krs41neah2ubraqn2ltifv', '::1', 1487682099, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638323039393b),
('t5n1seed0446gtnrbbdgtqke9toe6a9j', '::1', 1487690000, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639303030303b),
('tapkmcs3s413sjttpbggmvh8etnkaoac', '::1', 1487692228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639323232383b),
('tdloqolpe672ld78dorub9iqi9ssji2m', '::1', 1487532433, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373533323433333b),
('tvcq7t13ut7nkuq3ldfh76tubm5l1g7g', '::1', 1487587311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538373331313b),
('u0djc2cufuvu8gogmjfrsne2rmt59d1q', '::1', 1487772988, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737323938383b),
('v5mm7reprcj1te8ldgsjpe9flo5qrlhs', '::1', 1487677188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373637373138383b),
('v80asi9v7m5obo6tbifd8j19pueor83o', '::1', 1487586301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373538363330313b),
('vr02h3v54h5ofd3k5febma1a2c1q2p8v', '::1', 1487857215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373835373231353b),
('vve442bmtkg8u57qvppktmhrcgbi28ot', '::1', 1487684599, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638343539393b);

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
(6, '', 'datlequoc96@gmail.com', NULL, 'abc', '37cd769165eef9ba6ac6b4a0fdb7ef36', 0, 0, NULL, NULL, NULL),
(7, 'Ngoc An', 'anngoc.4595@gmail.com', 'facebook.com/ngocankl', 'ngocankl', 'a81cf072a28bb1d366c6d1414333db38', 1, 0, '0000-00-00', 'Hanoi', NULL),
(9, 'Minh Duc', 'lmao@gmail.com', 'facebook.com/lmao', 'lmao', '6271c3a9b237c29ac0cfa48d9e933b0a', 0, 0, '2000-03-24', 'Laos', NULL),
(10, 'Fuck', 'fuck@yahoo.com', 'facebook.com/fuck', 'fuck', '2e4b3f49539d4c0f2d176d0721438df4', 0, 0, '1001-12-12', 'Brunei', NULL);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
