-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2015 at 11:17 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ismart_irestaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `permission_lvl` int(11) NOT NULL,
  `last_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(11) NOT NULL,
  `category_title_en` varchar(255) NOT NULL,
  `category_title_ru` varchar(255) NOT NULL,
  `category_title_de` varchar(255) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title_en`, `category_title_ru`, `category_title_de`, `category_icon`, `order_id`, `created_date`) VALUES
(1, 'Pizza', 'Пицца', 'Pizza', '/category/pizza.png', 1, '2015-01-19 14:56:15'),
(2, 'Desert Cake', 'Десерт', 'woestijn Cake', '/category/cake.png', 2, '2015-01-19 14:56:29'),
(3, 'Coctail', 'Кокталь', 'Coctail', '/category/coctail.png', 3, '2015-01-19 14:56:49'),
(4, 'Ice Cream', 'Мороженное', 'Roomijs', '/category/ice_cream.png', 4, '2015-01-19 14:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`location_id` int(11) NOT NULL,
  `location_name_en` varchar(150) NOT NULL,
  `location_name_ru` varchar(150) NOT NULL,
  `location_name_de` varchar(150) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `location_phone_numbers` varchar(50) NOT NULL,
  `location_lat_long` varchar(150) NOT NULL,
  `open_time` varchar(150) NOT NULL,
  `order_id` int(3) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name_en`, `location_name_ru`, `location_name_de`, `location_address`, `location_phone_numbers`, `location_lat_long`, `open_time`, `order_id`, `modified_date`) VALUES
(1, 'test en', 'test ru', 'test de', 'address', '99292929', '43.48932,165,324324', '34324324', 23, '2015-01-20 04:31:42'),
(2, 'test 1 ', 'test 1 ', 'test 1 ', 'address 2 ', '23123', '', '23432', 2, '2015-01-20 04:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `location_image`
--

CREATE TABLE IF NOT EXISTS `location_image` (
`image_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location_image`
--

INSERT INTO `location_image` (`image_id`, `location_id`, `image_url`) VALUES
(1, 1, '/location/1/1.jpg'),
(2, 1, '/location/1/2.jpg'),
(3, 2, '/location/2/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`product_id` int(11) NOT NULL,
  `product_name_en` varchar(150) NOT NULL,
  `product_name_ru` varchar(150) NOT NULL,
  `product_name_de` varchar(150) NOT NULL,
  `product_description_en` varchar(1500) NOT NULL,
  `product_description_ru` varchar(1500) NOT NULL,
  `product_description_de` varchar(1500) NOT NULL,
  `product_price` int(11) NOT NULL,
  `currency_type` varchar(5) NOT NULL DEFAULT 'USD',
  `product_category` int(2) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name_en`, `product_name_ru`, `product_name_de`, `product_description_en`, `product_description_ru`, `product_description_de`, `product_price`, `currency_type`, `product_category`, `modified_date`) VALUES
(1, 'test1', 'test1', 'test1', 'test desct1', 'test desct1', 'test desct1', 23213, 'USD', 1, '2015-01-18 16:00:00'),
(2, 'test2', 'test2', 'test2', 'test desc2', 'test desct1', 'test desct1', 321321, 'USD', 2, '2015-01-19 12:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
`image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `image_url`) VALUES
(1, 1, '/product/1/1.jpg'),
(2, 1, '/product/1/2.jpg'),
(3, 2, '/product/2/1.jpg'),
(4, 2, '/product/2/2.jpg'),
(5, 1, '/product/1/3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `location_image`
--
ALTER TABLE `location_image`
 ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
 ADD PRIMARY KEY (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `location_image`
--
ALTER TABLE `location_image`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
