-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 27, 2019 at 08:17 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a111`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address_city` varchar(50) DEFAULT 'lahore',
  `address_town` varchar(50) DEFAULT NULL,
  `address_street_no` int(11) DEFAULT NULL,
  `address_house_no` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id`) VALUES
(1, '', '', 0, 0, 1),
(2, '', '', 0, 0, 2),
(3, '123', '0', 0, 0, 3),
(4, '123231', '0', 0, 0, 4),
(5, '123123231', '0', 0, 0, 5),
(6, '123123231234', '0', 0, 0, 6),
(7, '234', '0', 0, 0, 7),
(8, '', '', 0, 0, 8),
(9, '0', '0', 0, 0, 9),
(10, '12', '0', 0, 0, 10),
(11, '0', '0', 0, 0, 11),
(12, '0', '0', 0, 0, 12),
(13, '0', '0', 0, 0, 13),
(14, '0', '0', 0, 0, 14),
(15, '123', '0', 0, 0, 15),
(16, 'lahore', '123', 123, 0, 15),
(17, 'lahore', '123', 123, 0, 15),
(18, 'lahore', '234', 234, 0, 15),
(19, '123', '0', 0, 0, 16),
(20, 'lahore', '234', 0, 0, 16),
(21, 'lahore', '2134', 0, 0, 16),
(22, 'lahore', '132', 0, 0, 16),
(23, 'lahore', '234qw123', 0, 0, 16),
(24, '123', '', 0, 0, 17),
(25, '', '', 0, 0, 18),
(26, '2112', '212', 0, 0, 19),
(27, '0', '0', 0, 0, 20),
(28, '123', '0', 0, 0, 21),
(29, 'lahore', '12312', 123, 123, 21),
(30, '', '', 0, 0, 22),
(31, '', '', 0, 0, 23),
(32, '', '', 0, 0, 24),
(33, '', '', 0, 0, 25),
(34, '', '', 0, 0, 26),
(35, '', '', 0, 0, 27),
(36, '', '', 0, 0, 28),
(37, '', '', 0, 0, 29),
(38, '243234', '243234', 0, 0, 30),
(39, '234', '0', 0, 0, 31),
(40, '2342', '0', 0, 0, 32),
(41, 'lahore', '23432234werewrwerewrwerwer', 2147483647, 234234, 32),
(42, '0', '0', 0, 0, 33),
(43, '0', '0', 0, 0, 34),
(44, '121', '0', 0, 0, 35),
(45, '0', '0', 0, 0, 36),
(46, 'lahore', '1212', 0, 0, 36),
(47, '0', '0', 0, 0, 37),
(48, 'lahore', '123', 0, 0, 37),
(49, 'lahore', '123', 123, 0, 37),
(50, '0', '0', 0, 0, 38),
(51, 'lahore', '1212', 0, 0, 38),
(52, '0', '0', 0, 0, 39),
(53, 'lahore', '123', 0, 0, 39),
(54, 'lahore', '', 0, 0, 37),
(55, '0', '0', 0, 0, 40),
(56, 'lahore', '123', 0, 0, 40),
(57, '123231', '', 0, 0, 41),
(58, '123123', '', 0, 0, 42),
(59, 'lahore', '123312', 123, 0, 40),
(60, 'lahore', '24', 0, 0, 40);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `name` varchar(45) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `isExpire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`name`, `id`, `dish_id`, `isExpire`) VALUES
('324', 1, 7, NULL),
('23', 2, 34, NULL),
('12312', 3, 37, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_name`
--

CREATE TABLE `attribute_name` (
  `id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `attribute_id` int(11) NOT NULL,
  `dish_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_name`
--

INSERT INTO `attribute_name` (`id`, `quantity`, `attribute_id`, `dish_detail_id`) VALUES
(1, 123, 1, 11),
(2, 213, 3, 29);

-- --------------------------------------------------------

--
-- Table structure for table `catering`
--

CREATE TABLE `catering` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catering`
--

INSERT INTO `catering` (`id`, `name`, `expire`, `image`, `location_id`, `company_id`) VALUES
(1, '332432423334222233', NULL, '../images/catering/Apple.png', NULL, 2),
(2, 'NKFC', NULL, '../images/catering/Banana.png', NULL, 3),
(3, '2121', NULL, '../../images/catering/Banana.png', NULL, 3),
(4, '232', NULL, '../../../images/catering/Orange.png', NULL, 3),
(5, '323', NULL, '../images/catering/Banana.png', NULL, 3),
(6, 'asdaassad', NULL, '', NULL, 3),
(7, '', NULL, '', NULL, 3),
(8, '1231', NULL, '', NULL, 3),
(9, '23123', NULL, '', NULL, 3),
(10, 'rwe', NULL, '', NULL, 3),
(11, '3453453', NULL, '', NULL, 3),
(12, '324', NULL, '', NULL, 3),
(13, '12312', NULL, '', NULL, 3),
(14, '123', NULL, '', NULL, 3),
(15, '12312', NULL, '', NULL, 5),
(16, '123', NULL, '', NULL, 5),
(17, '23434232412', NULL, '', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `hall_id` int(11) DEFAULT NULL,
  `catering_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `comment` tinytext,
  `email` varchar(60) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire`) VALUES
(3, NULL, 1, '432', '23432', '2019-11-11 12:23:33', NULL),
(3, NULL, 2, '234234', '234234', '2019-11-11 12:23:38', NULL),
(7, NULL, 3, '3r324', '234324', '2019-11-11 12:24:19', NULL),
(7, NULL, 4, '23423423', '2343242342#22', '2019-11-11 12:26:19', NULL),
(7, NULL, 5, 'DSFWEFEWR2', '34234', '2019-11-11 12:26:38', NULL),
(12, NULL, 6, 'wqewqe', '23423', '2019-11-11 12:48:27', NULL),
(12, NULL, 7, '23423', '23432', '2019-11-11 12:48:32', NULL),
(12, NULL, 8, '423423', '234234', '2019-11-11 12:48:35', NULL),
(13, NULL, 9, '1231231321313123123123123123123123123', '123131231', '2019-11-11 12:51:04', NULL),
(3, NULL, 10, '21e212', '12e132e13', '2019-12-17 17:18:42', NULL),
(15, NULL, 11, '13213', '123123', '2019-12-26 22:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `expire`, `user_id`) VALUES
(1, '1221', NULL, 1),
(2, '2111', NULL, 2),
(3, 'slkjdkjnsda', NULL, 3),
(4, 'assdsad', NULL, 4),
(5, 'asdda', NULL, 5),
(6, 'shaheeen', NULL, 11),
(7, '123456', NULL, 12),
(8, '12321', NULL, 13),
(9, '123123123', NULL, 14),
(10, '1232132321', NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `name` varchar(30) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `dish_type_id` int(11) NOT NULL,
  `isExpire` datetime DEFAULT NULL,
  `catering_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`name`, `id`, `image`, `dish_type_id`, `isExpire`, `catering_id`) VALUES
('23eeeeee', 3, '../../../images/dishImages/Orange.png', 3, NULL, 1),
('32eeee', 4, '../../../images/dishImages/Banana.png', 3, NULL, 1),
('23ee', 5, '../../../images/dishImages/Banana.png', 4, NULL, 2),
('32e', 6, '../../../images/dishImages/Orange.png', 4, NULL, 2),
('23342324', 7, '../../../images/dishImages/Orange.png', 5, NULL, 1),
('23ee', 8, '../../images/dishImages/Banana.png', 6, NULL, 3),
('32e', 9, '../../images/dishImages/Apple.png', 6, NULL, 3),
('23ee', 10, '../../images/dishImages/Banana.png', 7, NULL, 4),
('32e', 11, '../../images/dishImages/Apple.png', 7, NULL, 4),
('23ee', 12, '../../images/dishImages/Banana.png', 8, NULL, 5),
('32e', 13, '../../images/dishImages/Apple.png', 8, NULL, 5),
('23ee', 14, '../../images/dishImages/Banana.png', 9, NULL, 6),
('32e', 15, '../../images/dishImages/Apple.png', 9, NULL, 6),
('23ee', 16, '../../images/dishImages/Banana.png', 10, NULL, 7),
('32e', 17, '../../images/dishImages/Apple.png', 10, NULL, 7),
('23ee', 18, '../../images/dishImages/Banana.png', 11, NULL, 8),
('32e', 19, '../../images/dishImages/Apple.png', 11, NULL, 8),
('23ee', 20, '../../images/dishImages/Banana.png', 12, NULL, 9),
('32e', 21, '../../images/dishImages/Apple.png', 12, NULL, 9),
('23ee', 22, '../../images/dishImages/Banana.png', 13, NULL, 10),
('32e', 23, '../../images/dishImages/Apple.png', 13, NULL, 10),
('23ee', 24, '../../images/dishImages/Banana.png', 14, NULL, 11),
('32e', 25, '../../images/dishImages/Apple.png', 14, NULL, 11),
('23ee', 26, '../../images/dishImages/Banana.png', 15, NULL, 12),
('32e', 27, '../../images/dishImages/Apple.png', 15, NULL, 12),
('23ee', 28, '../../images/dishImages/Banana.png', 16, NULL, 13),
('32e', 29, '../../images/dishImages/Apple.png', 16, NULL, 13),
('23ee', 30, '../../images/dishImages/Banana.png', 17, NULL, 14),
('32e', 31, '../../images/dishImages/Apple.png', 17, NULL, 14),
('23ee', 32, '../../images/dishImages/Banana.png', 18, NULL, 15),
('32e', 33, '../../images/dishImages/Apple.png', 18, NULL, 15),
('23ee', 34, '../../images/dishImages/Banana.png', 19, NULL, 16),
('23ee', 35, '../../images/dishImages/Banana.png', 20, NULL, 17),
('32e', 36, '../../images/dishImages/Apple.png', 20, NULL, 17),
('123123123', 37, '../../../images/dishImages/Banana.png', 21, NULL, 17);

-- --------------------------------------------------------

--
-- Table structure for table `dish_detail`
--

CREATE TABLE `dish_detail` (
  `id` int(11) NOT NULL,
  `describe` text,
  `price` int(11) DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dish_id` int(11) NOT NULL,
  `orderDetail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dish_detail`
--

INSERT INTO `dish_detail` (`id`, `describe`, `price`, `expire_date`, `quantity`, `dish_id`, `orderDetail_id`) VALUES
(1, '234', 23, NULL, 23, 3, 9),
(2, '123', 123, NULL, 123, 3, 9),
(3, '23', 23, NULL, 123, 4, 9),
(4, '13212', 2132222, NULL, 123121212, 3, 12),
(5, '232', 232, NULL, 23, 3, 15),
(6, 'ASSDAD', 100, NULL, 2, 4, 15),
(7, '234', 23, NULL, 234, 3, 17),
(8, '23', 234, NULL, 23, 4, 17),
(9, '2343242', 234, NULL, 2342, 3, 18),
(10, '234234', 23423222, NULL, 23423, 4, 18),
(11, '12312', 123, '2019-12-26 23:54:17', 123, 7, 18),
(12, '12312321safda', 3123, '2019-12-26 23:54:13', 12, 3, 18),
(13, '123123', 213, NULL, 123, 4, 20),
(14, '1234', 234, NULL, 123, 4, 20),
(15, '123', 23213, NULL, 123, 3, 22),
(16, '', 123, NULL, 123, 3, 24),
(17, '12321', 123, NULL, 123, 5, 26),
(18, '123', 123, NULL, 123, 3, 27),
(19, '', 123, NULL, 123, 3, 27),
(20, '', 1231231, NULL, 231221, 5, 27),
(21, '12312', 1231, NULL, 23, 3, 27),
(22, '132123213213', 12312, NULL, 12312, 3, 27),
(23, '12321', 232132, NULL, 132213, 3, 27),
(24, '123312', 123213, NULL, 213231, 3, 27),
(25, '23123123', 132213123, NULL, 312213, 3, 27),
(26, '123231123', 123213, NULL, 13221123, 3, 27),
(27, '213231312', 123123123, NULL, 123213213, 3, 27),
(28, '123123', 123123, NULL, 12312, 3, 28),
(29, 'werwererererer', 123, NULL, 123, 37, 28),
(30, '35534535', 435, NULL, 35, 33, 29);

-- --------------------------------------------------------

--
-- Table structure for table `dish_type`
--

CREATE TABLE `dish_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `isExpire` datetime DEFAULT NULL,
  `catering_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dish_type`
--

INSERT INTO `dish_type` (`id`, `name`, `isExpire`, `catering_id`) VALUES
(3, '3222', NULL, 1),
(4, '32', NULL, 2),
(5, '233333', NULL, 1),
(6, '32', NULL, 3),
(7, '32', NULL, 4),
(8, '32', NULL, 5),
(9, '32', NULL, 6),
(10, '32', NULL, 7),
(11, '32', NULL, 8),
(12, '32', NULL, 9),
(13, '32', NULL, 10),
(14, '32', NULL, 11),
(15, '32', NULL, 12),
(16, '32', NULL, 13),
(17, '32', NULL, 14),
(18, '32', NULL, 15),
(19, '32', NULL, 16),
(20, '32', NULL, 17),
(21, '12312321', NULL, 17);

-- --------------------------------------------------------

--
-- Table structure for table `hall`
--

CREATE TABLE `hall` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `max_guests` int(11) DEFAULT NULL,
  `function_per_Day` varchar(45) DEFAULT NULL,
  `noOfPartitions` int(11) DEFAULT NULL,
  `ownParking` tinyint(4) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `image` tinytext,
  `hallType` varchar(45) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`id`, `name`, `max_guests`, `function_per_Day`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id`, `company_id`) VALUES
(1, '21', 12, '', 21, 0, NULL, '', '1', 4, 1),
(2, 'GGGG', 32, '', 234, 1, NULL, '../images/hall/Apple.png', '1', 4, 3),
(3, '32434', 123, '', 123, 0, NULL, '', '1', 4, 3),
(4, 'NKFC 4', 231232, '', 231232, 1, '2019-10-23 05:00:00', '../images/hall/Orange.png', '0', 4, 3),
(5, 'sdfsdfs', 243, '', 12, 1, NULL, '', '0', 5, 3),
(6, '', 0, '', 0, 0, NULL, '', '0', 1, 3),
(7, '213', 12, '', 12, 1, NULL, '', '1', 1, 3),
(8, '123', 123, '', 1, 1, NULL, '', '0', 2, 3),
(9, '', 12, '', 12, 1, NULL, '', '0', 4, 3),
(10, '123', 123, '', 12, 1, NULL, '', '0', 2, 3),
(11, '12312', 0, '', 0, 0, NULL, '../images/hall/images (1).png', '1', 5, 3),
(12, '121', 12, '', 12, 1, NULL, '', '0', 1, 5),
(13, '12312', 321, '', 123, 1, NULL, '', '1', 2, 5),
(14, '12312', 123, '', 123, 1, NULL, '', '1', NULL, 5),
(15, '12321', 1232123, '', 12321, 1, NULL, '', '0', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `hallprice`
--

CREATE TABLE `hallprice` (
  `id` int(11) NOT NULL,
  `month` varchar(45) DEFAULT NULL,
  `isFood` tinyint(4) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `describe` tinytext,
  `dayTime` varchar(45) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `hall_id` int(11) NOT NULL,
  `package_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hallprice`
--

INSERT INTO `hallprice` (`id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name`) VALUES
(37, 'January', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(38, 'February', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(39, 'March', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(40, 'April', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(41, 'May', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(42, 'June', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(43, 'July', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(44, 'August', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(45, 'September', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(46, 'October', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(47, 'November', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(48, 'December', 0, 0, NULL, 'Morning', NULL, 1, NULL),
(49, 'January', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(50, 'February', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(51, 'March', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(52, 'April', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(53, 'May', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(54, 'June', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(55, 'July', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(56, 'August', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(57, 'September', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(58, 'October', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(59, 'November', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(60, 'December', 0, 0, NULL, 'Afternoon', NULL, 1, NULL),
(61, 'January', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(62, 'February', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(63, 'March', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(64, 'April', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(65, 'May', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(66, 'June', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(67, 'July', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(68, 'August', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(69, 'September', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(70, 'October', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(71, 'November', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(72, 'December', 0, 0, NULL, 'Evening', NULL, 1, NULL),
(73, 'January', 1, 123223, 'hello g', 'Morning', NULL, 1, '222'),
(74, 'January', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(75, 'February', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(76, 'March', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(77, 'April', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(78, 'May', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(79, 'June', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(80, 'July', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(81, 'August', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(82, 'September', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(83, 'October', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(84, 'November', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(85, 'December', 0, 0, NULL, 'Morning', NULL, 2, NULL),
(86, 'January', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(87, 'February', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(88, 'March', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(89, 'April', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(90, 'May', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(91, 'June', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(92, 'July', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(93, 'August', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(94, 'September', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(95, 'October', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(96, 'November', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(97, 'December', 0, 0, NULL, 'Afternoon', NULL, 2, NULL),
(98, 'January', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(99, 'February', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(100, 'March', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(101, 'April', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(102, 'May', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(103, 'June', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(104, 'July', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(105, 'August', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(106, 'September', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(107, 'October', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(108, 'November', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(109, 'December', 0, 0, NULL, 'Evening', NULL, 2, NULL),
(110, 'January', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(111, 'February', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(112, 'March', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(113, 'April', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(114, 'May', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(115, 'June', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(116, 'July', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(117, 'August', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(118, 'September', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(119, 'October', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(120, 'November', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(121, 'December', 0, 0, NULL, 'Morning', NULL, 3, NULL),
(122, 'January', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(123, 'February', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(124, 'March', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(125, 'April', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(126, 'May', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(127, 'June', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(128, 'July', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(129, 'August', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(130, 'September', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(131, 'October', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(132, 'November', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(133, 'December', 0, 0, NULL, 'Afternoon', NULL, 3, NULL),
(134, 'January', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(135, 'February', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(136, 'March', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(137, 'April', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(138, 'May', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(139, 'June', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(140, 'July', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(141, 'August', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(142, 'September', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(143, 'October', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(144, 'November', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(145, 'December', 0, 0, NULL, 'Evening', NULL, 3, NULL),
(146, 'January', 0, 123122130, NULL, 'Morning', NULL, 4, NULL),
(147, 'February', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(148, 'March', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(149, 'April', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(150, 'May', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(151, 'June', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(152, 'July', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(153, 'August', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(154, 'September', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(155, 'October', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(156, 'November', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(157, 'December', 0, 0, NULL, 'Morning', NULL, 4, NULL),
(158, 'January', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(159, 'February', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(160, 'March', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(161, 'April', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(162, 'May', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(163, 'June', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(164, 'July', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(165, 'August', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(166, 'September', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(167, 'October', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(168, 'November', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(169, 'December', 0, 0, NULL, 'Afternoon', NULL, 4, NULL),
(170, 'January', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(171, 'February', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(172, 'March', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(173, 'April', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(174, 'May', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(175, 'June', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(176, 'July', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(177, 'August', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(178, 'September', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(179, 'October', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(180, 'November', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(181, 'December', 0, 0, NULL, 'Evening', NULL, 4, NULL),
(182, 'January', 1, 324, '1232131', 'Morning', NULL, 4, 'wqddw'),
(183, 'January', 1, 1231, '12312', 'Morning', NULL, 4, '1321'),
(184, 'January', 1, 222, '2222222', 'Morning', NULL, 4, '123'),
(185, 'January', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(186, 'February', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(187, 'March', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(188, 'April', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(189, 'May', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(190, 'June', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(191, 'July', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(192, 'August', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(193, 'September', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(194, 'October', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(195, 'November', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(196, 'December', 0, 0, NULL, 'Morning', NULL, 5, NULL),
(197, 'January', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(198, 'February', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(199, 'March', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(200, 'April', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(201, 'May', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(202, 'June', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(203, 'July', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(204, 'August', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(205, 'September', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(206, 'October', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(207, 'November', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(208, 'December', 0, 0, NULL, 'Afternoon', NULL, 5, NULL),
(209, 'January', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(210, 'February', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(211, 'March', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(212, 'April', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(213, 'May', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(214, 'June', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(215, 'July', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(216, 'August', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(217, 'September', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(218, 'October', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(219, 'November', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(220, 'December', 0, 0, NULL, 'Evening', NULL, 5, NULL),
(221, 'February', 1, 123, '123123123', 'Morning', NULL, 5, '123123'),
(222, 'December', 1, 2000, 'sadasdsad', 'Evening', NULL, 2, 'chiecken menu'),
(223, 'December', 1, 123312, '123231', 'Morning', NULL, 2, '13212'),
(224, 'December', 1, 342543, '3454532', 'Morning', NULL, 3, '321425'),
(225, 'January', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(226, 'February', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(227, 'March', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(228, 'April', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(229, 'May', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(230, 'June', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(231, 'July', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(232, 'August', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(233, 'September', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(234, 'October', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(235, 'November', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(236, 'December', 0, 0, NULL, 'Morning', NULL, 6, NULL),
(237, 'January', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(238, 'February', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(239, 'March', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(240, 'April', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(241, 'May', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(242, 'June', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(243, 'July', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(244, 'August', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(245, 'September', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(246, 'October', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(247, 'November', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(248, 'December', 0, 0, NULL, 'Afternoon', NULL, 6, NULL),
(249, 'January', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(250, 'February', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(251, 'March', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(252, 'April', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(253, 'May', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(254, 'June', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(255, 'July', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(256, 'August', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(257, 'September', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(258, 'October', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(259, 'November', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(260, 'December', 0, 0, NULL, 'Evening', NULL, 6, NULL),
(261, 'January', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(262, 'February', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(263, 'March', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(264, 'April', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(265, 'May', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(266, 'June', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(267, 'July', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(268, 'August', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(269, 'September', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(270, 'October', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(271, 'November', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(272, 'December', 0, 0, NULL, 'Morning', NULL, 7, NULL),
(273, 'January', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(274, 'February', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(275, 'March', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(276, 'April', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(277, 'May', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(278, 'June', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(279, 'July', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(280, 'August', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(281, 'September', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(282, 'October', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(283, 'November', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(284, 'December', 0, 0, NULL, 'Afternoon', NULL, 7, NULL),
(285, 'January', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(286, 'February', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(287, 'March', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(288, 'April', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(289, 'May', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(290, 'June', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(291, 'July', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(292, 'August', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(293, 'September', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(294, 'October', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(295, 'November', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(296, 'December', 0, 0, NULL, 'Evening', NULL, 7, NULL),
(297, 'January', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(298, 'February', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(299, 'March', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(300, 'April', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(301, 'May', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(302, 'June', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(303, 'July', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(304, 'August', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(305, 'September', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(306, 'October', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(307, 'November', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(308, 'December', 0, 0, NULL, 'Morning', NULL, 8, NULL),
(309, 'January', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(310, 'February', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(311, 'March', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(312, 'April', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(313, 'May', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(314, 'June', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(315, 'July', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(316, 'August', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(317, 'September', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(318, 'October', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(319, 'November', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(320, 'December', 0, 0, NULL, 'Afternoon', NULL, 8, NULL),
(321, 'January', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(322, 'February', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(323, 'March', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(324, 'April', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(325, 'May', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(326, 'June', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(327, 'July', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(328, 'August', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(329, 'September', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(330, 'October', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(331, 'November', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(332, 'December', 0, 0, NULL, 'Evening', NULL, 8, NULL),
(333, 'January', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(334, 'February', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(335, 'March', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(336, 'April', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(337, 'May', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(338, 'June', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(339, 'July', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(340, 'August', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(341, 'September', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(342, 'October', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(343, 'November', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(344, 'December', 0, 0, NULL, 'Morning', NULL, 9, NULL),
(345, 'January', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(346, 'February', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(347, 'March', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(348, 'April', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(349, 'May', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(350, 'June', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(351, 'July', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(352, 'August', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(353, 'September', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(354, 'October', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(355, 'November', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(356, 'December', 0, 0, NULL, 'Afternoon', NULL, 9, NULL),
(357, 'January', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(358, 'February', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(359, 'March', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(360, 'April', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(361, 'May', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(362, 'June', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(363, 'July', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(364, 'August', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(365, 'September', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(366, 'October', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(367, 'November', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(368, 'December', 0, 0, NULL, 'Evening', NULL, 9, NULL),
(369, 'January', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(370, 'February', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(371, 'March', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(372, 'April', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(373, 'May', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(374, 'June', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(375, 'July', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(376, 'August', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(377, 'September', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(378, 'October', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(379, 'November', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(380, 'December', 0, 0, NULL, 'Morning', NULL, 10, NULL),
(381, 'January', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(382, 'February', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(383, 'March', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(384, 'April', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(385, 'May', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(386, 'June', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(387, 'July', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(388, 'August', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(389, 'September', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(390, 'October', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(391, 'November', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(392, 'December', 0, 0, NULL, 'Afternoon', NULL, 10, NULL),
(393, 'January', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(394, 'February', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(395, 'March', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(396, 'April', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(397, 'May', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(398, 'June', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(399, 'July', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(400, 'August', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(401, 'September', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(402, 'October', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(403, 'November', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(404, 'December', 0, 0, NULL, 'Evening', NULL, 10, NULL),
(405, 'January', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(406, 'February', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(407, 'March', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(408, 'April', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(409, 'May', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(410, 'June', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(411, 'July', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(412, 'August', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(413, 'September', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(414, 'October', 0, 123, NULL, 'Morning', NULL, 11, NULL),
(415, 'November', 0, 0, NULL, 'Morning', NULL, 11, NULL),
(416, 'December', 0, 0, NULL, 'Morning', NULL, 11, NULL),
(417, 'January', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(418, 'February', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(419, 'March', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(420, 'April', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(421, 'May', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(422, 'June', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(423, 'July', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(424, 'August', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(425, 'September', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(426, 'October', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(427, 'November', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(428, 'December', 0, 0, NULL, 'Afternoon', NULL, 11, NULL),
(429, 'January', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(430, 'February', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(431, 'March', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(432, 'April', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(433, 'May', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(434, 'June', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(435, 'July', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(436, 'August', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(437, 'September', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(438, 'October', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(439, 'November', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(440, 'December', 0, 0, NULL, 'Evening', NULL, 11, NULL),
(441, 'November', 1, 12112, '121', 'Morning', NULL, 11, '111212121212'),
(442, 'January', 1, 121, '', 'Morning', NULL, 11, '12121'),
(443, 'January', 1, 2112, '12112', 'Morning', NULL, 2, '222'),
(444, 'January', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(445, 'February', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(446, 'March', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(447, 'April', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(448, 'May', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(449, 'June', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(450, 'July', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(451, 'August', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(452, 'September', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(453, 'October', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(454, 'November', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(455, 'December', 0, 0, NULL, 'Morning', NULL, 12, NULL),
(456, 'January', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(457, 'February', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(458, 'March', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(459, 'April', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(460, 'May', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(461, 'June', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(462, 'July', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(463, 'August', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(464, 'September', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(465, 'October', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(466, 'November', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(467, 'December', 0, 0, NULL, 'Afternoon', NULL, 12, NULL),
(468, 'January', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(469, 'February', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(470, 'March', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(471, 'April', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(472, 'May', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(473, 'June', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(474, 'July', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(475, 'August', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(476, 'September', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(477, 'October', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(478, 'November', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(479, 'December', 0, 0, NULL, 'Evening', NULL, 12, NULL),
(480, 'January', 1, 12112, '121', 'Morning', NULL, 12, '111212121212'),
(481, 'January', 1, 12112, '121', 'Morning', NULL, 12, '111212121212'),
(482, 'February', 1, 123223, 'hello g', 'Morning', NULL, 12, '222'),
(483, 'March', 1, 1212, '121', 'Morning', '2019-11-10 13:05:20', 12, 'qsqq'),
(484, 'January', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(485, 'February', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(486, 'March', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(487, 'April', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(488, 'May', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(489, 'June', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(490, 'July', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(491, 'August', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(492, 'September', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(493, 'October', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(494, 'November', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(495, 'December', 0, 0, NULL, 'Morning', NULL, 13, NULL),
(496, 'January', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(497, 'February', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(498, 'March', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(499, 'April', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(500, 'May', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(501, 'June', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(502, 'July', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(503, 'August', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(504, 'September', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(505, 'October', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(506, 'November', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(507, 'December', 0, 0, NULL, 'Afternoon', NULL, 13, NULL),
(508, 'January', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(509, 'February', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(510, 'March', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(511, 'April', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(512, 'May', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(513, 'June', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(514, 'July', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(515, 'August', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(516, 'September', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(517, 'October', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(518, 'November', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(519, 'December', 0, 0, NULL, 'Evening', NULL, 13, NULL),
(520, 'January', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(521, 'February', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(522, 'March', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(523, 'April', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(524, 'May', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(525, 'June', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(526, 'July', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(527, 'August', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(528, 'September', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(529, 'October', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(530, 'November', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(531, 'December', 0, 0, NULL, 'Morning', NULL, 14, NULL),
(532, 'January', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(533, 'February', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(534, 'March', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(535, 'April', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(536, 'May', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(537, 'June', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(538, 'July', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(539, 'August', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(540, 'September', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(541, 'October', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(542, 'November', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(543, 'December', 0, 0, NULL, 'Afternoon', NULL, 14, NULL),
(544, 'January', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(545, 'February', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(546, 'March', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(547, 'April', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(548, 'May', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(549, 'June', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(550, 'July', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(551, 'August', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(552, 'September', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(553, 'October', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(554, 'November', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(555, 'December', 0, 0, NULL, 'Evening', NULL, 14, NULL),
(556, 'January', 0, 1123, NULL, 'Morning', NULL, 15, NULL),
(557, 'February', 0, 12321, NULL, 'Morning', NULL, 15, NULL),
(558, 'March', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(559, 'April', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(560, 'May', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(561, 'June', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(562, 'July', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(563, 'August', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(564, 'September', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(565, 'October', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(566, 'November', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(567, 'December', 0, 0, NULL, 'Morning', NULL, 15, NULL),
(568, 'January', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(569, 'February', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(570, 'March', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(571, 'April', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(572, 'May', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(573, 'June', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(574, 'July', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(575, 'August', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(576, 'September', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(577, 'October', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(578, 'November', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(579, 'December', 0, 0, NULL, 'Afternoon', NULL, 15, NULL),
(580, 'January', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(581, 'February', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(582, 'March', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(583, 'April', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(584, 'May', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(585, 'June', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(586, 'July', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(587, 'August', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(588, 'September', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(589, 'October', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(590, 'November', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(591, 'December', 0, 0, NULL, 'Evening', NULL, 15, NULL),
(592, 'January', 1, 123, '23121', 'Morning', NULL, 15, 'chiecken package'),
(593, 'April', 1, 123, '23121', 'Morning', NULL, 15, '1321'),
(594, 'January', 1, 123, '23121', 'Morning', NULL, 15, '1321123');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` tinytext,
  `expire` datetime DEFAULT NULL,
  `catering_id` int(11) DEFAULT NULL,
  `hall_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `expire`, `catering_id`, `hall_id`) VALUES
(1, '../../images/hall/IMG_20171230_230717815.mp4', NULL, NULL, 2),
(2, '../../images/hall/IMG_20171230_230717815.mp4', NULL, NULL, 2),
(3, '../../images/hall/IMG_20171230_230717815.mp4', NULL, NULL, 2),
(4, '../../images/hall/IMG_20171230_230717815.mp4', NULL, NULL, 2),
(5, '../../images/hall/IMG_20171230_230717815.mp4', NULL, NULL, 2),
(6, '../../images/hall/IMG_20171230_230717815.mp4', NULL, NULL, 2),
(7, '../../images/hall/Banana.png', NULL, NULL, 2),
(8, '../../images/hall/Banana.png', NULL, NULL, 2),
(9, '../../images/catering/Apple.png', NULL, 2, NULL),
(10, '../../images/catering/IMG_20171230_230717815.mp4', NULL, 2, NULL),
(11, '../../images/catering/IMG_20171230_230717815.mp4', NULL, 2, NULL),
(12, '../../images/catering/dolar.jpeg', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `longitude`, `latitude`, `expire`, `country`, `city`) VALUES
(1, 74.3587, 31.5204, NULL, 'Pakistan', NULL),
(2, 74.3587, 31.5204, NULL, 'Pakistan', NULL),
(4, 74.3587, 123.23, NULL, 'Pakistan', NULL),
(5, 45.343, 31.5204, NULL, 'Pakistan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `dishname` varchar(45) DEFAULT NULL,
  `image` tinytext,
  `expire` datetime DEFAULT NULL,
  `hallprice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `dishname`, `image`, `expire`, `hallprice_id`) VALUES
(1, '23ee', '../../images/dishImages/Banana.png', NULL, 73),
(2, '32e', '../../images/dishImages/Apple.png', NULL, 73),
(3, '23ee', '../../images/dishImages/Banana.png', NULL, 182),
(4, '32e', '../../images/dishImages/Apple.png', NULL, 182),
(5, '32e', '../../images/dishImages/Apple.png', NULL, 183),
(6, '23ee', '../../images/dishImages/Banana.png', NULL, 183),
(7, '23ee', '../../images/dishImages/Banana.png', NULL, 184),
(8, '23ee', '../../images/dishImages/Banana.png', NULL, 221),
(9, '32e', '../../images/dishImages/Apple.png', NULL, 221),
(10, '23ee', '../../images/dishImages/Banana.png', NULL, 222),
(11, '32e', '../../images/dishImages/Apple.png', NULL, 222),
(12, '23ee', '../../images/dishImages/Banana.png', '2019-11-02 18:17:32', 223),
(13, '32e', '../../images/dishImages/Apple.png', '2019-11-02 18:17:14', 223),
(14, '23ee', '../../images/dishImages/Banana.png', NULL, 224),
(15, '32e', '../../images/dishImages/Apple.png', NULL, 224),
(16, '23ee', '../../images/dishImages/Banana.png', NULL, 441),
(17, '32e', '../../images/dishImages/Apple.png', NULL, 441),
(18, '23ee', '../../images/dishImages/Banana.png', NULL, 442),
(19, '32e', '../../images/dishImages/Apple.png', NULL, 442),
(20, '', '../../images/dishImages/Apple.png', '2019-11-02 18:22:36', 223),
(21, '123213', '', '2019-11-02 18:22:36', 223),
(22, '23ee', '../../images/dishImages/Banana.png', '2019-11-02 18:22:35', 223),
(23, '32e', '../../images/dishImages/Apple.png', '2019-11-02 18:22:35', 223),
(24, '0', '../../images/dishImages/', '2019-11-02 18:22:34', 223),
(25, '0', '../../images/dishImages/', '2019-11-02 18:22:34', 223),
(26, '0', '../../images/dishImages/', '2019-11-02 18:22:34', 223),
(27, '213', '../../images/dishImages/', '2019-11-02 18:22:34', 223),
(28, '12312', '../../images/dishImages/dolar.jpeg', '2019-11-02 18:22:33', 223),
(29, 'erw', '../../images/dishImages/ba7e0e993da6bdc90056ecaa959f4b42.jpg', '2019-11-02 18:22:34', 223),
(30, '123', '', '2019-11-02 18:22:33', 223),
(31, '123', '', '2019-11-02 18:22:33', 223),
(32, '123', '', '2019-11-02 18:22:33', 223),
(33, '123', '', '2019-11-02 18:22:33', 223),
(34, 'qwe', '', '2019-11-02 18:22:32', 223),
(35, '123', '', '2019-11-02 18:22:33', 223),
(36, 'qew', '', '2019-11-02 18:22:32', 223),
(37, '123', '', '2019-11-02 18:22:32', 223),
(38, '123', '', '2019-11-02 18:22:32', 223),
(39, '123', '', '2019-11-02 18:22:32', 223),
(40, '324', '', '2019-11-02 18:22:31', 223),
(41, '324', '', '2019-11-02 18:22:32', 223),
(42, '324', '', '2019-11-02 18:22:31', 223),
(43, '123', '', '2019-11-02 18:22:31', 223),
(44, '123', '', '2019-11-02 18:22:31', 223),
(45, '123', '', '2019-11-02 18:22:31', 223),
(46, '324', '', '2019-11-02 18:22:30', 223),
(47, '13', '', '2019-11-02 18:22:31', 223),
(48, '11111111', '', '2019-11-02 18:22:30', 223),
(49, '111111', '', '2019-11-02 18:22:30', 223),
(50, '2323', '', '2019-11-02 18:22:30', 223),
(51, '23e', '', '2019-11-02 18:22:30', 223),
(52, '12', '', '2019-11-02 18:22:29', 223),
(53, '243', '', '2019-11-02 18:22:30', 223),
(54, '222222222', '', '2019-11-02 18:22:29', 223),
(55, 'qwe', '', '2019-11-02 18:22:29', 223),
(56, '123', '', '2019-11-02 18:22:29', 223),
(57, '12323', '', '2019-11-02 18:22:29', 223),
(58, '123213', '', '2019-11-02 18:22:28', 223),
(59, '23ee', '../../images/dishImages/Banana.png', '2019-11-02 18:25:59', 223),
(60, '32e', '../../images/dishImages/Apple.png', '2019-11-02 18:25:59', 223),
(61, '0', '../../images/dishImages/', '2019-11-02 18:25:59', 223),
(62, '0', '../../images/dishImages/', '2019-11-02 18:25:59', 223),
(63, '0', '../../images/dishImages/', '2019-11-02 18:25:59', 223),
(64, '213', '../../images/dishImages/', '2019-11-02 18:25:59', 223),
(65, '12312', '../../images/dishImages/dolar.jpeg', '2019-11-02 18:26:00', 223),
(66, 'erw', '../../images/dishImages/ba7e0e993da6bdc90056ecaa959f4b42.jpg', '2019-11-02 18:26:00', 223),
(67, '123', '', '2019-11-02 18:26:00', 223),
(68, '123', '', '2019-11-02 18:26:00', 223),
(69, '123', '', '2019-11-02 18:26:00', 223),
(70, '123', '', '2019-11-02 18:26:01', 223),
(71, 'qwe', '', '2019-11-02 18:26:01', 223),
(72, '123', '', '2019-11-02 18:26:01', 223),
(73, 'qew', '', '2019-11-02 18:26:01', 223),
(74, '123', '', '2019-11-02 18:26:01', 223),
(75, '123', '', '2019-11-02 18:26:02', 223),
(76, '123', '', '2019-11-02 18:26:02', 223),
(77, '324', '', '2019-11-02 18:26:02', 223),
(78, '324', '', '2019-11-02 18:26:02', 223),
(79, '324', '', '2019-11-02 18:26:02', 223),
(80, '123', '', '2019-11-02 18:26:02', 223),
(81, '123', '', '2019-11-02 18:26:03', 223),
(82, '123', '', '2019-11-02 18:26:03', 223),
(83, '324', '', '2019-11-02 18:26:03', 223),
(84, '13', '', '2019-11-02 18:26:03', 223),
(85, '11111111', '', '2019-11-02 18:26:03', 223),
(86, '111111', '', '2019-11-02 18:26:04', 223),
(87, '2323', '', '2019-11-02 18:26:04', 223),
(88, '23e', '', '2019-11-02 18:26:04', 223),
(89, '12', '', '2019-11-02 18:26:04', 223),
(90, '243', '', '2019-11-02 18:26:04', 223),
(91, '222222222', '', '2019-11-02 18:26:04', 223),
(92, 'qwe', '', '2019-11-02 18:26:05', 223),
(93, '123', '', '2019-11-02 18:26:05', 223),
(94, '12323', '', '2019-11-02 18:26:52', 223),
(95, '123213', '', '2019-11-02 18:26:52', 223),
(96, '23ee', '../../images/dishImages/Banana.png', NULL, 223),
(97, '32e', '../../images/dishImages/Apple.png', NULL, 223),
(98, '0', '../../images/dishImages/', NULL, 223),
(99, '0', '../../images/dishImages/', NULL, 223),
(100, '0', '../../images/dishImages/', NULL, 223),
(101, '213', '../../images/dishImages/', NULL, 223),
(102, '12312', '../../images/dishImages/dolar.jpeg', NULL, 223),
(103, 'erw', '../../images/dishImages/ba7e0e993da6bdc90056ecaa959f4b42.jpg', NULL, 223),
(104, '123', '', NULL, 223),
(105, '123', '', NULL, 223),
(106, '123', '', NULL, 223),
(107, '123', '', NULL, 223),
(108, 'qwe', '', NULL, 223),
(109, '123', '', NULL, 223),
(110, 'qew', '', NULL, 223),
(111, '123', '', NULL, 223),
(112, '123', '', NULL, 223),
(113, '123', '', NULL, 223),
(114, '324', '', NULL, 223),
(115, '324', '', NULL, 223),
(116, '324', '', NULL, 223),
(117, '123', '', NULL, 223),
(118, '123', '', NULL, 223),
(119, '123', '', NULL, 223),
(120, '324', '', NULL, 223),
(121, '13', '', NULL, 223),
(122, '11111111', '', NULL, 223),
(123, '111111', '', NULL, 223),
(124, '2323', '', NULL, 223),
(125, '23e', '', NULL, 223),
(126, '12', '', NULL, 223),
(127, '243', '', NULL, 223),
(128, '222222222', '', NULL, 223),
(129, 'qwe', '', NULL, 223),
(130, '123', '', NULL, 223),
(131, '12323', '', NULL, 223),
(132, '123213', '', NULL, 223),
(133, '222222222', '', '2019-11-02 18:41:20', 443),
(134, '222222222', '', '2019-11-02 18:41:22', 443),
(135, 'qwe', '', '2019-11-02 18:41:21', 443),
(136, '23ee', '../../images/dishImages/Banana.png', NULL, 481),
(137, '32e', '../../images/dishImages/Apple.png', NULL, 481),
(138, '23ee', '../../images/dishImages/Banana.png', NULL, 482),
(139, '32e', '../../images/dishImages/Apple.png', NULL, 482),
(140, '23ee', '../../images/dishImages/Banana.png', NULL, 483),
(141, '32e', '../../images/dishImages/Apple.png', NULL, 483),
(142, '23ee', '../../images/dishImages/Banana.png', '2019-12-26 21:29:13', 592),
(143, '23ee', '../../images/dishImages/Banana.png', NULL, 593),
(144, '32e', '../../images/dishImages/Apple.png', NULL, 592),
(145, '32e', '../../images/dishImages/Apple.png', NULL, 594);

-- --------------------------------------------------------

--
-- Table structure for table `number`
--

CREATE TABLE `number` (
  `number` varchar(30) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `is_number_active` tinyint(4) DEFAULT '1',
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `number`
--

INSERT INTO `number` (`number`, `id`, `is_number_active`, `person_id`) VALUES
('234324', 2, 1, 2),
('24332', 3, 1, 3),
('12312', 4, 1, 4),
('1231212', 5, 1, 5),
('1231212342423', 6, 1, 6),
('4324', 7, 1, 7),
('12321', 8, 1, 8),
('2342321332', 9, 1, 9),
('21321', 10, 1, 10),
('32222', 11, 1, 11),
('23324', 12, 1, 12),
('424324444', 13, 1, 13),
('432', 14, 1, 14),
('12213', 15, 1, 15),
('12213', 16, 1, 16),
('324324432', 19, 1, 1),
('123213213', 20, 1, 17),
('233', 21, 1, 18),
('232', 22, 1, 18),
('212222', 23, 1, 19),
('3424324', 24, 1, 20),
('32434', 25, 1, 21),
('12321312', 26, 1, 22),
('12312213', 27, 1, 8),
('12312', 28, 1, 23),
('123123', 29, 1, 24),
('123456', 30, 1, 25),
('121212', 31, 1, 26),
('12321', 32, 1, 27),
('123456', 33, 1, 28),
('123426', 34, 1, 29),
('242342', 35, 1, 30),
('3432', 36, 1, 31),
('2342', 37, 1, 32),
('234', 38, 1, 32),
('23', 39, 1, 33),
('12123', 40, 1, 34),
('121', 41, 1, 35),
('321', 42, 1, 36),
('123321', 43, 1, 37),
('1212', 44, 1, 38),
('1231', 45, 1, 39),
('123', 46, 1, 40),
('123123321', 47, 1, 41),
('123213231', 48, 1, 42);

-- --------------------------------------------------------

--
-- Table structure for table `orderDetail`
--

CREATE TABLE `orderDetail` (
  `id` int(11) NOT NULL,
  `hall_id` int(11) DEFAULT NULL,
  `catering_id` int(11) DEFAULT NULL,
  `hallprice_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sheftCatering` int(11) DEFAULT NULL,
  `sheftHall` int(11) DEFAULT NULL,
  `sheftCateringUser` int(11) DEFAULT NULL,
  `sheftHallUser` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  `total_amount` int(11) DEFAULT '0',
  `total_person` int(11) DEFAULT NULL,
  `status_hall` varchar(30) DEFAULT '0',
  `destination_date` date DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `destination_time` time DEFAULT NULL,
  `status_catering` varchar(30) DEFAULT NULL,
  `notice` varchar(30) DEFAULT NULL,
  `describe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderDetail`
--

INSERT INTO `orderDetail` (`id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, `sheftCatering`, `sheftHall`, `sheftCateringUser`, `sheftHallUser`, `address_id`, `person_id`, `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, `status_catering`, `notice`, `describe`) VALUES
(1, 1, NULL, 183, 1, NULL, NULL, NULL, NULL, NULL, 1, 23342, 23333, 'Clear', '2019-01-01', '2019-10-05', '09:00:00', 'Running', 'alert', 'dfsfdsdasassda'),
(2, 1, NULL, 73, 1, NULL, NULL, NULL, NULL, NULL, 7, 7000, 333, 'Running', '2019-01-01', '2019-10-05', '09:00:00', 'Running', 'alert', 'asdsads'),
(3, 2, NULL, 74, 1, NULL, NULL, NULL, NULL, NULL, 9, 213, 213213, 'Cancel', '2019-01-01', '2019-10-05', '09:00:00', 'Cancel', '', ''),
(4, 2, NULL, 83, 1, NULL, NULL, NULL, NULL, NULL, 10, 213, 23423434, 'Running', '2019-10-01', '2019-10-05', '09:00:00', 'Cancel', '', ''),
(5, 2, NULL, 83, 1, NULL, NULL, NULL, NULL, NULL, 11, 23, 23, 'Running', '2019-10-01', '2019-10-05', '09:00:00', 'Cancel', '', 'dlfmlsdmfmsd;f'),
(6, 2, NULL, 73, 1, NULL, NULL, NULL, NULL, NULL, 12, 23432, 0, 'Running', '2019-01-01', '2019-10-09', '09:00:00', 'Running', 'alert', 'qw'),
(7, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, 21, 16, 0, 2134, NULL, '0421-12-23', '2019-10-09', '00:43:00', 'Running', '', ''),
(8, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, 22, 16, 0, 12, NULL, '3312-03-12', '2019-10-09', '00:31:00', 'Running', '', ''),
(9, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, 23, 16, 1212, 23343, NULL, '0012-12-12', '2019-10-09', '12:31:00', 'Delieved', '', 'weweqasdweqweq'),
(10, 2, NULL, 74, 1, NULL, NULL, NULL, NULL, NULL, 19, 232424, 2000, 'Running', '2019-01-01', '2019-10-23', '09:00:00', 'Cancel', '', '234234'),
(11, 2, NULL, 74, 1, NULL, NULL, NULL, NULL, NULL, 20, 34534, 2343, 'Deliever', '2019-01-01', '2019-10-25', '09:00:00', 'Cancel', '', '34354'),
(12, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, 29, 21, 0, 1233232, NULL, '2222-11-23', '2019-10-25', '00:23:00', 'Running', '', '23423243323'),
(13, 11, NULL, 415, 1, NULL, NULL, NULL, NULL, NULL, 30, 0, 42234, 'Running', '2019-11-13', '2019-11-02', '09:00:00', '', '', ''),
(14, 2, NULL, 84, 4, NULL, NULL, NULL, NULL, NULL, 13, 0, 43324, 'Running', '2019-11-20', '2019-11-02', '09:00:00', 'Cancel', '', ''),
(15, 12, NULL, 478, 5, NULL, NULL, NULL, NULL, NULL, 31, 234232332, 343, 'Deliever', '2019-11-05', '2019-11-11', '12:00:00', 'Deliever', '', '234'),
(16, 13, NULL, 494, 5, NULL, NULL, NULL, NULL, NULL, 8, 12312, 123123, 'Running', '2019-11-01', '2019-11-11', '09:00:00', '', '', '1231'),
(17, 12, 16, 480, 5, NULL, NULL, NULL, NULL, NULL, 13, 12231123, 1232, 'Cancel', '2019-01-01', '2019-11-12', '09:00:00', 'Cancel', '', 'asdsadssddsadsadssdaasddsasdasddsads'),
(18, NULL, 15, NULL, 1, NULL, NULL, NULL, NULL, 41, 32, 0, 234, NULL, '2019-12-16', '2019-12-17', '14:23:00', 'Running', '', '23ee3e32ee2e3eewwefwfwefwf'),
(19, 12, NULL, 455, 5, NULL, NULL, NULL, NULL, NULL, 35, 12, 12, 'Running', '2019-12-03', '2019-12-20', '09:00:00', '', '', '121'),
(20, NULL, 12, NULL, 5, NULL, NULL, NULL, NULL, 49, 37, 0, 1231, NULL, '0123-03-12', '2019-12-20', '12:31:00', 'Running', '', ''),
(21, NULL, 15, NULL, 5, NULL, NULL, NULL, NULL, 51, 38, 0, 1212, NULL, NULL, '2019-12-20', '00:12:00', 'Running', '', ''),
(22, NULL, 15, NULL, 5, NULL, NULL, NULL, NULL, 53, 39, 0, 12313, NULL, '0031-12-23', '2019-12-20', '02:31:00', 'Running', '', '12313'),
(23, 12, NULL, 455, 5, NULL, NULL, NULL, NULL, NULL, 37, 123, 123, 'Running', '2019-12-03', '2019-12-20', '09:00:00', '', '', '132'),
(24, NULL, 15, NULL, 5, NULL, NULL, NULL, NULL, 54, 37, 0, 123, NULL, '0312-12-23', '2019-12-20', '12:31:00', 'Running', '', ''),
(25, 12, NULL, 447, 5, NULL, NULL, NULL, NULL, NULL, 38, 23423, 234324, 'Running', '0242-04-23', '2019-12-22', '09:00:00', '', '', '23423'),
(26, 12, NULL, 455, 5, NULL, NULL, NULL, NULL, NULL, 37, 12321, 123211, 'Running', '2019-12-17', '2019-12-22', '09:00:00', 'Cancel', '', '231'),
(27, NULL, 16, NULL, 5, NULL, NULL, NULL, NULL, 56, 40, 0, 123123, NULL, '0031-12-23', '2019-12-22', '12:31:00', 'Running', '', ''),
(28, NULL, 15, NULL, 5, NULL, NULL, NULL, NULL, 59, 40, 0, 132123, NULL, '0000-00-00', '2019-12-26', '12:31:00', 'Running', '', ''),
(29, NULL, 15, NULL, 5, NULL, NULL, NULL, NULL, 60, 40, 0, 2442, NULL, '0004-02-24', '2019-12-27', '02:42:00', 'Running', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `nameCustomer` varchar(45) DEFAULT NULL,
  `receive` datetime DEFAULT NULL,
  `personality` text,
  `rating` int(11) DEFAULT NULL,
  `IsReturn` tinyint(4) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sendingStatus` int(11) DEFAULT '0',
  `orderDetail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `nameCustomer`, `receive`, `personality`, `rating`, `IsReturn`, `user_id`, `sendingStatus`, `orderDetail_id`) VALUES
(1, 132, 'qwe', '2019-10-09 21:56:55', 'ads', 3, 0, 1, 0, 9),
(2, 342, '2342', '2019-10-09 22:12:11', '23342342342', 3, 0, 1, 0, 9),
(3, 12312, '213321', '2019-10-25 13:39:58', '12321', 3, 0, 1, 0, 2),
(4, 12321, '12321', '2019-10-25 13:40:13', '213123232112', 3, 1, 1, 0, 2),
(5, 0, '', '2019-10-25 13:43:47', '', 5, 0, 1, 2, 2),
(6, 24243243, '4223', '2019-11-02 18:53:46', '243234243324343', 3, 0, 1, 1, 3),
(7, 1231, '12321', '2019-11-11 12:53:48', '12312312', 3, 1, 1, 0, 16),
(8, 2332412, '32324', '2019-12-17 19:39:55', '', 3, 0, 1, 0, 18),
(9, 234, '324', '2019-12-20 00:51:30', '', 3, 0, 5, 0, 17),
(10, 1231, '12321', '2019-12-22 16:56:19', '12312', 3, 0, 5, 0, 26);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `name` varchar(30) DEFAULT NULL,
  `cnic` varchar(30) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `image` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`name`, `cnic`, `id`, `date`, `image`) VALUES
('122223442334', '2222', 1, '2019-10-02', '../../images/users/Apple.png'),
('2343', '', 2, '2019-10-05', '../../images/users/Banana.png'),
('dsfffd', '132231', 3, '2019-10-05', ''),
('sdsadds', '321', 4, '2019-10-05', ''),
('sdsadds123', '321123', 5, '2019-10-05', ''),
('sdsadds123242', '321123234', 6, '2019-10-05', ''),
('23423', '2342', 7, '2019-10-05', '../images/customerimage/9e6.jpg'),
('12321123213123123', '213123', 8, '2019-10-05', NULL),
('asdsda', '324', 9, '2019-10-05', ''),
('1231', '1231', 10, '2019-10-05', ''),
('e32e32', '3e23', 11, '2019-10-05', ''),
('dsdfsfsd', '23442', 12, '2019-10-09', ''),
('shshshh', '345', 13, '2019-10-09', ''),
('234', '234', 14, '2019-10-09', ''),
('123', '0', 15, '2019-10-09', ''),
('123', '0', 16, '2019-10-09', ''),
('12312', '12312123', 17, '2019-10-22', NULL),
('23323', '2323', 18, '2019-10-23', NULL),
('21212w', '1221', 19, '2019-10-23', '../images/customerimage/9e6.jpg'),
('23432', '234324', 20, '2019-10-25', ''),
('2342', '123123', 21, '2019-10-25', ''),
('adsdads', '', 22, '2019-10-29', ''),
('1231', '', 23, '2019-11-02', '../images/users/fullsizeoutput_2cae-500x400.jpeg'),
('123123', '', 24, '2019-11-02', '../../images/users/fullsizeoutput_2cae-500x400.jpeg'),
('123456', '', 25, '2019-11-02', '../../images/users/fullsizeoutput_2cae-500x400.jpeg'),
('121212', '', 26, '2019-11-02', '../../images/users/fullsizeoutput_2cae-500x400.jpeg'),
('qwdwq', '', 27, '2019-11-02', ''),
('123456', '', 28, '2019-11-02', ''),
('123426', '', 29, '2019-11-02', ''),
('234234', '234234', 30, '2019-11-02', ''),
('23432', '23432', 31, '2019-11-11', ''),
('23', '332', 32, '2019-12-17', ''),
('123', '0', 33, '2019-12-17', ''),
('123', '0', 34, '2019-12-20', ''),
('121', '121', 35, '2019-12-20', ''),
('121', '0', 36, '2019-12-20', ''),
('shahzad', '1231213', 37, '2019-12-20', ''),
('121', '0', 38, '2019-12-20', ''),
('123', '123', 39, '2019-12-20', ''),
('1231', '123123', 40, '2019-12-22', ''),
('12321', '12312', 41, '2019-12-24', ''),
('1231321', '123123', 42, '2019-12-24', '');

-- --------------------------------------------------------

--
-- Table structure for table `SystemAttribute`
--

CREATE TABLE `SystemAttribute` (
  `name` varchar(45) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `isExpire` datetime DEFAULT NULL,
  `systemDish_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `systemDish`
--

CREATE TABLE `systemDish` (
  `name` varchar(30) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `isExpire` datetime DEFAULT NULL,
  `systemDishType_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemDish`
--

INSERT INTO `systemDish` (`name`, `id`, `image`, `isExpire`, `systemDishType_id`) VALUES
('23ee', 1, '../../images/dishImages/Banana.png', NULL, 1),
('32e', 2, '../../images/dishImages/Apple.png', NULL, 1),
('0', 3, '../../images/dishImages/', NULL, NULL),
('0', 4, '../../images/dishImages/', NULL, NULL),
('0', 5, '../../images/dishImages/', NULL, NULL),
('213', 6, '../../images/dishImages/', NULL, NULL),
('12312', 7, '../../images/dishImages/dolar.jpeg', NULL, NULL),
('erw', 8, '../../images/dishImages/ba7e0e993da6bdc90056ecaa959f4b42.jpg', NULL, NULL),
('123', 9, '', NULL, NULL),
('123', 10, '', NULL, NULL),
('123', 11, '', NULL, NULL),
('123', 12, '', NULL, NULL),
('qwe', 13, '', NULL, NULL),
('123', 14, '', NULL, NULL),
('qew', 15, '', NULL, NULL),
('123', 16, '', NULL, NULL),
('123', 17, '', NULL, NULL),
('123', 18, '', NULL, NULL),
('324', 19, '', NULL, NULL),
('324', 20, '', NULL, NULL),
('324', 21, '', NULL, NULL),
('123', 22, '', NULL, NULL),
('123', 23, '', NULL, NULL),
('123', 24, '', NULL, NULL),
('324', 25, '', NULL, NULL),
('13', 26, '', NULL, NULL),
('11111111', 27, '', NULL, NULL),
('111111', 28, '', NULL, NULL),
('2323', 29, '', NULL, NULL),
('23e', 30, '', NULL, NULL),
('12', 31, '', NULL, NULL),
('243', 32, '', NULL, NULL),
('222222222', 33, '', NULL, NULL),
('qwe', 34, '', NULL, NULL),
('123', 35, '', NULL, NULL),
('12323', 36, '', NULL, NULL),
('123213', 37, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `systemDishType`
--

CREATE TABLE `systemDishType` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `isExpire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemDishType`
--

INSERT INTO `systemDishType` (`id`, `name`, `isExpire`) VALUES
(1, '32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `systemITems`
--

CREATE TABLE `systemITems` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `images` varchar(200) DEFAULT NULL,
  `expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `Isconfirm` datetime DEFAULT NULL,
  `senderTimeDate` datetime DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Isget` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `Isconfirm`, `senderTimeDate`, `payment_id`, `user_id`, `Isget`) VALUES
(1, '2019-10-26 20:29:11', '2019-10-26 18:49:05', 5, 2, 1),
(2, '2019-10-26 20:29:26', '2019-10-26 19:11:31', 3, 2, 0),
(3, NULL, '2019-11-02 18:54:36', 6, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  `isExpire` datetime DEFAULT NULL,
  `isowner` tinyint(4) DEFAULT '0',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `person_id`, `isExpire`, `isowner`, `company_id`) VALUES
(1, '1221212', '12211', 1, '2019-10-02 05:00:00', 1, 3),
(2, '2', '2', 2, NULL, 1, 3),
(3, 'sads', 'adssas', 8, NULL, 1, 3),
(4, '3', '3', 17, NULL, 1, 3),
(5, '1', '1', 18, NULL, 1, 5),
(6, '1', '1', 22, NULL, 1, 1),
(7, '123456', '123456', 23, NULL, 1, NULL),
(8, '123444', '123444', 24, NULL, 1, NULL),
(9, '123452', '123452', 25, NULL, 0, NULL),
(10, 'shahzad', '123452', 26, NULL, 0, 3),
(11, '121212', '121212', 27, NULL, 1, NULL),
(12, '123426', '123426', 28, NULL, 1, NULL),
(13, 'weewed', '123426', 29, NULL, 1, NULL),
(14, '12321312', '1111111', 41, NULL, 1, NULL),
(15, '12311233', '1111111', 42, NULL, 1, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_address_person1_idx` (`person_id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_attribute_dish1_idx` (`dish_id`);

--
-- Indexes for table `attribute_name`
--
ALTER TABLE `attribute_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_attribute_name_attribute1_idx` (`attribute_id`),
  ADD KEY `fk_attribute_name_dish_detail1_idx` (`dish_detail_id`);

--
-- Indexes for table `catering`
--
ALTER TABLE `catering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_catering_location1_idx` (`location_id`),
  ADD KEY `fk_catering_company1_idx` (`company_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_table1_hall1_idx` (`hall_id`),
  ADD KEY `fk_table1_catering1_idx` (`catering_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_user1_idx` (`user_id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dish_dish_type1_idx` (`dish_type_id`),
  ADD KEY `fk_dish_catering1_idx` (`catering_id`);

--
-- Indexes for table `dish_detail`
--
ALTER TABLE `dish_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dish_detail_dish1_idx` (`dish_id`),
  ADD KEY `fk_dish_detail_orderDetail1_idx` (`orderDetail_id`);

--
-- Indexes for table `dish_type`
--
ALTER TABLE `dish_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dish_type_catering1_idx` (`catering_id`);

--
-- Indexes for table `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hall_location1_idx` (`location_id`),
  ADD KEY `fk_hall_company1_idx` (`company_id`);

--
-- Indexes for table `hallprice`
--
ALTER TABLE `hallprice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hallprice_hall1_idx` (`hall_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_catering1_idx` (`catering_id`),
  ADD KEY `fk_images_hall1_idx` (`hall_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_hallprice1_idx` (`hallprice_id`);

--
-- Indexes for table `number`
--
ALTER TABLE `number`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_number_person1_idx` (`person_id`);

--
-- Indexes for table `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderDetail_hall1_idx` (`hall_id`),
  ADD KEY `fk_orderDetail_catering1_idx` (`catering_id`),
  ADD KEY `fk_orderDetail_hallprice1_idx` (`hallprice_id`),
  ADD KEY `fk_orderDetail_user1_idx` (`user_id`),
  ADD KEY `fk_orderDetail_address1_idx` (`address_id`),
  ADD KEY `fk_orderDetail_person1_idx` (`person_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_user1_idx` (`user_id`),
  ADD KEY `fk_payment_orderDetail1_idx` (`orderDetail_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SystemAttribute`
--
ALTER TABLE `SystemAttribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_SystemAttribute_systemDish1_idx` (`systemDish_id`);

--
-- Indexes for table `systemDish`
--
ALTER TABLE `systemDish`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_systemDish_systemDishType1_idx` (`systemDishType_id`);

--
-- Indexes for table `systemDishType`
--
ALTER TABLE `systemDishType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemITems`
--
ALTER TABLE `systemITems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transfer_payment1_idx` (`payment_id`),
  ADD KEY `fk_transfer_user1_idx` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_person1_idx` (`person_id`),
  ADD KEY `fk_user_company1_idx` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_name`
--
ALTER TABLE `attribute_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catering`
--
ALTER TABLE `catering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `dish_detail`
--
ALTER TABLE `dish_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `dish_type`
--
ALTER TABLE `dish_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hall`
--
ALTER TABLE `hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hallprice`
--
ALTER TABLE `hallprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `number`
--
ALTER TABLE `number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orderDetail`
--
ALTER TABLE `orderDetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `SystemAttribute`
--
ALTER TABLE `SystemAttribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemDish`
--
ALTER TABLE `systemDish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `systemDishType`
--
ALTER TABLE `systemDishType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `systemITems`
--
ALTER TABLE `systemITems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `attribute`
--
ALTER TABLE `attribute`
  ADD CONSTRAINT `fk_attribute_dish1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `attribute_name`
--
ALTER TABLE `attribute_name`
  ADD CONSTRAINT `fk_attribute_name_attribute1` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attribute_name_dish_detail1` FOREIGN KEY (`dish_detail_id`) REFERENCES `dish_detail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `catering`
--
ALTER TABLE `catering`
  ADD CONSTRAINT `fk_catering_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_catering_location1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_table1_catering1` FOREIGN KEY (`catering_id`) REFERENCES `catering` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_hall1` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_company_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `fk_dish_catering1` FOREIGN KEY (`catering_id`) REFERENCES `catering` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dish_dish_type1` FOREIGN KEY (`dish_type_id`) REFERENCES `dish_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dish_detail`
--
ALTER TABLE `dish_detail`
  ADD CONSTRAINT `fk_dish_detail_dish1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dish_detail_orderDetail1` FOREIGN KEY (`orderDetail_id`) REFERENCES `orderDetail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dish_type`
--
ALTER TABLE `dish_type`
  ADD CONSTRAINT `fk_dish_type_catering1` FOREIGN KEY (`catering_id`) REFERENCES `catering` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hall`
--
ALTER TABLE `hall`
  ADD CONSTRAINT `fk_hall_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hall_location1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hallprice`
--
ALTER TABLE `hallprice`
  ADD CONSTRAINT `fk_hallprice_hall1` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_catering1` FOREIGN KEY (`catering_id`) REFERENCES `catering` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_images_hall1` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_hallprice1` FOREIGN KEY (`hallprice_id`) REFERENCES `hallprice` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `number`
--
ALTER TABLE `number`
  ADD CONSTRAINT `fk_number_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD CONSTRAINT `fk_orderDetail_address1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orderDetail_catering1` FOREIGN KEY (`catering_id`) REFERENCES `catering` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orderDetail_hall1` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orderDetail_hallprice1` FOREIGN KEY (`hallprice_id`) REFERENCES `hallprice` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orderDetail_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orderDetail_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_orderDetail1` FOREIGN KEY (`orderDetail_id`) REFERENCES `orderDetail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `SystemAttribute`
--
ALTER TABLE `SystemAttribute`
  ADD CONSTRAINT `fk_SystemAttribute_systemDish1` FOREIGN KEY (`systemDish_id`) REFERENCES `systemDish` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `systemDish`
--
ALTER TABLE `systemDish`
  ADD CONSTRAINT `fk_systemDish_systemDishType1` FOREIGN KEY (`systemDishType_id`) REFERENCES `systemDishType` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `fk_transfer_payment1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transfer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
