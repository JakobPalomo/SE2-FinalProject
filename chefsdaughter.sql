-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 01:14 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chefsdaughter`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted`
--

CREATE TABLE `accepted` (
  `id` int(11) NOT NULL,
  `user_session_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `delivery_address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_option` varchar(50) NOT NULL,
  `delivery_option` varchar(50) NOT NULL,
  `preparation_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Accepted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2024-01-26 16:21:18', '27-01-2024 04:00:55 PM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Bulk Orders', 'Food Trays With M,L,XL,XXL Sizing', '2024-04-10 13:28:17', NULL),
(2, 'Special Deals', '', '2024-04-10 13:34:34', NULL),
(3, 'Lechon Baboy', '', '2024-04-10 13:34:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gcashpayments`
--

CREATE TABLE `gcashpayments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_session_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `delivery_address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_option` varchar(255) NOT NULL,
  `delivery_option` varchar(255) NOT NULL,
  `delivery_time` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_screenshot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gcashpayments`
--

INSERT INTO `gcashpayments` (`id`, `order_id`, `user_session_id`, `name`, `contact`, `email`, `items`, `delivery_address`, `total_price`, `payment_option`, `delivery_option`, `delivery_time`, `status`, `payment_screenshot`) VALUES
(1, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png'),
(2, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png'),
(3, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png'),
(4, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png'),
(5, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png'),
(6, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png'),
(7, 1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'image_2024-04-10_223234071.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(1, 1, 'To Pay', '', '2024-04-10 14:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `id` int(11) NOT NULL,
  `user_session_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `delivery_address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_option` varchar(50) NOT NULL,
  `delivery_option` varchar(50) NOT NULL,
  `preparation_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending`
--

INSERT INTO `pending` (`id`, `user_session_id`, `name`, `contact`, `email`, `items`, `delivery_address`, `total_price`, `payment_option`, `delivery_option`, `preparation_date`, `delivery_time`, `status`) VALUES
(1, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '2024-04-20', '22:32:00', 'Paid'),
(2, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"1\";s:12:\"productImage\";s:39:\"admin/productimages/1/Spicy Chicken.jpg\";s:11:\"productName\";s:13:\"Spicy Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'Gcash', 'Delivery', '2024-04-15', '09:11:00', 'Pending'),
(3, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:2:\"34\";s:12:\"productImage\";s:47:\"admin/productimages/34/cheesy baked bangus.jpeg\";s:11:\"productName\";s:27:\"Cheesy Baked Boneles Bangus\";s:8:\"quantity\";i:2;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:4400;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '4400.00', 'COD', 'Delivery', '2024-04-26', '07:14:00', 'Pending'),
(4, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"5\";s:12:\"productImage\";s:43:\"admin/productimages/5/Chicken caldereta.jpg\";s:11:\"productName\";s:17:\"Chicken Caldereta\";s:8:\"quantity\";i:2;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:4400;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '4400.00', 'COD', 'Delivery', '2024-04-26', '07:13:00', 'Pending'),
(5, 1, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:2:\"36\";s:12:\"productImage\";s:55:\"admin/productimages/36/kapampangan relyenong bangus.jpg\";s:11:\"productName\";s:28:\"Kapampangan Relyehong Bangus\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:2200;s:10:\"totalPrice\";i:2200;}}', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '2200.00', 'COD', 'Delivery', '2024-04-19', '07:15:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subCategory` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `mediumPrice` decimal(10,2) NOT NULL,
  `largePrice` decimal(10,2) NOT NULL,
  `xlPrice` decimal(10,2) NOT NULL,
  `xxlPrice` decimal(10,2) NOT NULL,
  `productDescription` text NOT NULL,
  `productImage1` varchar(255) NOT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `productAvailability` varchar(50) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `mediumPrice`, `largePrice`, `xlPrice`, `xxlPrice`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(1, '1', '1', 'Spicy Chicken', '1200.00', '1400.00', '1700.00', '2200.00', '', 'Spicy Chicken.jpg', '', '', 'In Stock', '2024-04-10 13:40:42', '2024-04-10 13:40:42'),
(2, '1', '1', 'Chicken Karaage', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Chicken Karaage.jpg', '', '', 'In Stock', '2024-04-10 13:46:12', '2024-04-10 13:46:12'),
(3, '1', '1', 'Chicken Shawarma', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'chicken shawarma.png', '', '', 'In Stock', '2024-04-10 13:51:18', '2024-04-10 13:51:18'),
(4, '1', '1', 'Kapampangan Chicken Asado', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', '423686854_7136901539680477_3077292866098800232_n (1).jpg', '', '', 'In Stock', '2024-04-10 13:54:24', '2024-04-10 13:58:36'),
(5, '1', '1', 'Chicken Caldereta', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Chicken caldereta.jpg', '', '', 'In Stock', '2024-04-10 13:58:21', '2024-04-10 13:58:21'),
(6, '1', '1', 'Chicken Cordon Blue', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Cordon Blue.jpg', '', '', 'In Stock', '2024-04-10 14:02:01', '2024-04-10 14:02:01'),
(7, '1', '1', 'Creamy Chicken Pastel', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Creamy Chicken Pastel.jpg', '', '', 'In Stock', '2024-04-10 14:04:36', '2024-04-10 14:04:36'),
(8, '1', '1', 'Classic Fried Chicken', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Classic Fried Chicken.jpg', '', '', 'In Stock', '2024-04-10 14:05:35', '2024-04-10 14:05:35'),
(9, '1', '1', 'Creamy Chicken With Mushroom', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Creamy-Garlic-Butter-Mushroom-Chicken-.jpg', '', '', 'In Stock', '2024-04-10 14:09:35', '2024-04-10 14:09:35'),
(10, '1', '1', 'Honey Lemon Chicken Wings', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'IMG_7991.jpg', '', '', 'In Stock', '2024-04-10 14:12:38', '2024-04-10 14:12:38'),
(11, '1', '1', 'Buffallo Chicken Wings', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Buffalo Chicken WIngs.jpg', '', '', 'In Stock', '2024-04-10 14:14:01', '2024-04-10 14:14:01'),
(12, '1', '1', 'Salted Egg Chicken Wings', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'Salted egg Chicken wings.jpg', '', '', 'In Stock', '2024-04-10 14:15:04', '2024-04-10 14:15:04'),
(13, '1', '2', 'Spicy Pork', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'spicy pork.jpg', '', '', 'In Stock', '2024-04-10 14:25:23', '2024-04-10 14:35:21'),
(14, '1', '2', 'Crispy Pork Kare Kare', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'c05423dc2537f4147563b545929d88d2.jpg', '', '', 'In Stock', '2024-04-10 14:27:40', '2024-04-10 14:37:23'),
(15, '1', '2', 'Kapampangan Pork Embutido', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'Embutido.jpg', '', '', 'In Stock', '2024-04-10 14:29:55', '2024-04-10 14:29:55'),
(16, '1', '2', 'Pork Shawarma', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'pork shawarma.jpeg', '', '', 'In Stock', '2024-04-10 14:44:01', '2024-04-10 14:44:01'),
(17, '1', '2', 'Kapampangan Pork Asado', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'asado.jpg', '', '', 'In Stock', '2024-04-10 14:45:38', '2024-04-10 14:45:38'),
(18, '1', '2', 'Sweet and Sour Pork', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'IMG_2941.jpg', '', '', 'In Stock', '2024-04-10 14:47:33', '2024-04-10 14:47:33'),
(19, '1', '2', 'Pork Caldereta', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'IMG_0759.jpg', '', '', 'In Stock', '2024-04-10 14:49:21', '2024-04-10 14:49:21'),
(20, '1', '2', 'Pork Menudo', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'IMG_6910.jpg', '', '', 'In Stock', '2024-04-10 14:51:43', '2024-04-10 14:51:43'),
(21, '1', '2', 'Pork Lumpiang Shanghai', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'IMG_9325.jpg', '', '', 'In Stock', '2024-04-10 14:53:08', '2024-04-10 14:53:08'),
(22, '1', '2', 'Sisig Kapampangan', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', 'IMG_3933.jpg', '', '', 'In Stock', '2024-04-10 14:54:55', '2024-04-10 14:54:55'),
(23, '1', '2', 'Filipino Pork Ribs Steak', '1400.00', '1700.00', '2200.00', '2700.00', '<br>', '421829-e854b0e4cec44a90925c50b15efa516f.jpg', '', '', 'In Stock', '2024-04-10 14:57:06', '2024-04-10 14:57:06'),
(24, '1', '3', 'Spicy Shrimp', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'chefs_daughter_spicy_shrimp.jpg', '', '', 'In Stock', '2024-04-10 22:36:25', '2024-04-10 22:36:25'),
(25, '1', '3', 'Seafood Cajun Delight', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'cajun_delight.jpg', '', '', 'In Stock', '2024-04-10 22:37:03', '2024-04-10 22:37:03'),
(26, '1', '8', 'Seafood Medley Salpicao', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'seafood salpicao.jpg', '', '', 'In Stock', '2024-04-10 22:37:55', '2024-04-10 22:37:55'),
(27, '1', '3', 'Buttered Garlic Shrimp', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'buttered_garlic_shrimp.jpg', '', '', 'In Stock', '2024-04-10 22:38:37', '2024-04-10 22:38:37'),
(28, '1', '5', 'Beef Shawarma', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'beef shawarma.jpg', '', '', 'In Stock', '2024-04-10 22:39:13', '2024-04-10 22:39:13'),
(29, '1', '5', 'Creamy Roast Beef', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'creamy roast beef.jpg', '', '', 'In Stock', '2024-04-10 22:39:51', '2024-04-10 22:39:51'),
(30, '1', '5', 'Kapampangan Lengua', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'kapampangan lengua.jpg', '', '', 'In Stock', '2024-04-10 22:40:46', '2024-04-10 22:40:46'),
(31, '1', '5', 'Beef Salpicao', '1700.00', '2200.00', '2700.00', '3200.00', '<br>', 'beef salpicao.jpg', '', '', 'In Stock', '2024-04-10 22:41:24', '2024-04-10 22:41:24'),
(32, '1', '5', 'Beef Bulgogi Bibimbop', '1700.00', '2200.00', '2700.00', '2200.00', '<br>', 'beef bulgogi bibimbap.jpg', '', '', 'In Stock', '2024-04-10 22:42:48', '2024-04-10 22:42:48'),
(33, '1', '4', 'Classic Inihaw Boneless Bangus', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'inihaw na bangus.jpg', '', '', 'In Stock', '2024-04-10 22:44:15', '2024-04-10 22:44:15'),
(34, '1', '4', 'Cheesy Baked Boneles Bangus', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'cheesy baked bangus.jpeg', '', '', 'In Stock', '2024-04-10 22:44:53', '2024-04-10 22:44:53'),
(35, '1', '4', 'Creamy Dory Fish Fillet', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'cream dory fish fillet.jpg', '', '', 'In Stock', '2024-04-10 22:45:32', '2024-04-10 22:45:32'),
(36, '1', '4', 'Kapampangan Relyehong Bangus', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'kapampangan relyenong bangus.jpg', '', '', 'In Stock', '2024-04-10 22:46:12', '2024-04-10 22:46:12'),
(37, '1', '4', 'Sweet and Sour Fish', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'sweet and sour fish.jpg', '', '', 'In Stock', '2024-04-10 22:47:01', '2024-04-10 22:47:01'),
(38, '1', '6', 'Kapampangan Sipo Egg', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'kapampangan_sipo_egg.jpg', '', '', 'In Stock', '2024-04-10 22:47:34', '2024-04-10 22:47:34'),
(39, '1', '6', 'Chopsuey', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'chopseuy.jpg', '', '', 'In Stock', '2024-04-10 22:48:15', '2024-04-10 22:48:15'),
(40, '1', '6', 'Stir Fried Mixed Vegetables', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'stir mixed vegetables.jpg', '', '', 'In Stock', '2024-04-10 22:49:05', '2024-04-10 22:49:05'),
(41, '1', '6', 'Chopsuey', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'chopseuy.jpg', '', '', 'In Stock', '2024-04-10 22:50:28', '2024-04-10 22:50:28'),
(42, '1', '7', 'Tortufa Truffle Pasta', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'tartufo truffle pasta.jpg', '', '', 'In Stock', '2024-04-10 22:54:25', '2024-04-10 22:54:25'),
(43, '1', '7', 'Carbonara Deluxe', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'carbonara deluxe.jpg', '', '', 'In Stock', '2024-04-10 22:55:15', '2024-04-10 22:55:15'),
(44, '1', '7', 'Lasagna Supreme', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'lasagna supreme.jpg', '', '', 'In Stock', '2024-04-10 22:55:57', '2024-04-10 22:55:57'),
(45, '1', '7', 'Creamy Chicken Alfredo', '1200.00', '1400.00', '1700.00', '3200.00', '<br>', 'creamy chicken alfredo.jpg', '', '', 'In Stock', '2024-04-10 22:56:56', '2024-04-10 22:56:56'),
(46, '1', '7', 'Classic Filipino Spaghetti', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'spaghetti.jpg', '', '', 'In Stock', '2024-04-10 22:57:38', '2024-04-10 22:57:38'),
(47, '1', '7', 'Bolognese Italian Spaghetti', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'spaghetti bolognese.jpg', '', '', 'In Stock', '2024-04-10 22:58:07', '2024-04-10 22:58:07'),
(48, '1', '7', 'Traditional Filipino Pancit Guisado', '700.00', '900.00', '1200.00', '1500.00', '<br>', 'pancit guisado.jpg', '', '', 'In Stock', '2024-04-10 22:58:53', '2024-04-10 22:58:53'),
(49, '1', '7', 'Traditional Filipino Pancit Canton', '700.00', '900.00', '1200.00', '2200.00', '<br>', 'pancit-canton.jpg', '', '', 'In Stock', '2024-04-10 22:59:39', '2024-04-10 22:59:39'),
(50, '1', '7', 'Traditional Filipino Pancit Palabok', '700.00', '900.00', '1200.00', '1500.00', '<br>', 'pancit palabok.jpg', '', '', 'In Stock', '2024-04-10 23:00:16', '2024-04-10 23:00:16'),
(51, '1', '8', 'BLT and Cheese Salad', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'bacon lettuce tomato and cheese salad.jpg', '', '', 'In Stock', '2024-04-10 23:01:03', '2024-04-10 23:01:03'),
(52, '1', '8', 'All Mango Salad', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'ali mango salad.jpg', '', '', 'In Stock', '2024-04-10 23:01:33', '2024-04-10 23:01:33'),
(53, '1', '8', 'Chicken Macaroni Salad', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'chicken_macaroni_salad.jpg', '', '', 'In Stock', '2024-04-10 23:02:14', '2024-04-10 23:02:14'),
(54, '1', '8', 'Nachos Supreme Salad', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'nachos supreme salad.jpg', '', '', 'In Stock', '2024-04-10 23:03:51', '2024-04-10 23:03:51'),
(55, '1', '9', 'Yema Balls', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'yema balls.jpg', '', '', 'In Stock', '2024-04-10 23:04:23', '2024-04-10 23:04:23'),
(56, '1', '9', 'Puto Flan', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'puto flan.jpg', '', '', 'In Stock', '2024-04-10 23:04:57', '2024-04-10 23:04:57'),
(57, '1', '9', 'Buko Pandan Salad', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'buko_pandan_salad.jpg', '', '', 'In Stock', '2024-04-10 23:05:27', '2024-04-10 23:05:27'),
(58, '1', '9', 'Classic Maja Blanca', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'maja blanca.jpg', '', '', 'In Stock', '2024-04-10 23:06:20', '2024-04-10 23:06:20'),
(59, '1', '8', 'Fruit Salad', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'fruit_salad.jpg', '', '', 'In Stock', '2024-04-10 23:06:55', '2024-04-10 23:06:55'),
(60, '1', '9', 'Buchi', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'cheesy kutsinta.jpg', '', '', 'In Stock', '2024-04-10 23:07:38', '2024-04-10 23:07:38'),
(61, '1', '9', 'Sapin Sapin', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'sapin sapin.jpg', '', '', 'In Stock', '2024-04-10 23:08:12', '2024-04-10 23:08:12'),
(62, '1', '9', 'Oreo Mallow Graham', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'oreo mallow.jpg', '', '', 'In Stock', '2024-04-10 23:09:22', '2024-04-10 23:09:22'),
(63, '1', '9', 'Mango Graham Float', '1200.00', '1400.00', '1700.00', '2200.00', '<br>', 'mango graham float.jpg', '', '', 'In Stock', '2024-04-10 23:09:58', '2024-04-10 23:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(1, 1, 'Chicken', '2024-04-10 13:28:27', NULL),
(2, 1, 'Pork', '2024-04-10 13:28:35', NULL),
(3, 1, 'Seafood', '2024-04-10 13:28:43', NULL),
(4, 1, 'Fish', '2024-04-10 13:28:51', NULL),
(5, 1, 'Beef', '2024-04-10 13:29:09', NULL),
(6, 1, 'Vegetable', '2024-04-10 13:29:25', NULL),
(7, 1, 'Pasta', '2024-04-10 13:33:17', NULL),
(8, 1, 'Sides and Salad', '2024-04-10 13:33:32', NULL),
(9, 1, 'Dessert', '2024-04-10 13:33:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `to_pay`
--

CREATE TABLE `to_pay` (
  `id` int(11) NOT NULL,
  `user_session_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `delivery_address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_option` varchar(50) NOT NULL,
  `delivery_option` varchar(50) NOT NULL,
  `preparation_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'To Pay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userorders`
--

CREATE TABLE `userorders` (
  `order_id` int(11) NOT NULL,
  `user_session_id` varchar(255) DEFAULT NULL,
  `items` text DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment_option` varchar(50) DEFAULT NULL,
  `delivery_option` varchar(50) DEFAULT NULL,
  `preparation_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `verify_status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `contact`, `address`, `password`, `verify_token`, `verify_status`) VALUES
(1, 'Ezequiel', 'Gonzalez', 'ezequiel.gonzalez.cics@ust.edu.ph', '09762909844', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '$2y$10$t00tU8GM1O9yQUgPiCo.9.RJY6tEqtgGJynGMrW3nEAwAQ./hbSci', 'f6e38145a5af151f37d89b877e8f31bc', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gcashpayments`
--
ALTER TABLE `gcashpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userorders`
--
ALTER TABLE `userorders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gcashpayments`
--
ALTER TABLE `gcashpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userorders`
--
ALTER TABLE `userorders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
