-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 06:33 PM
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

--
-- Dumping data for table `accepted`
--

INSERT INTO `accepted` (`id`, `user_session_id`, `name`, `contact`, `email`, `items`, `delivery_address`, `total_price`, `payment_option`, `delivery_option`, `preparation_date`, `delivery_time`, `status`) VALUES
(4, 6, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"2\";s:12:\"productImage\";s:35:\"admin/productimages/2/download.jfif\";s:11:\"productName\";s:14:\"Chicken Inasal\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:400;s:10:\"totalPrice\";i:400;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '400.00', 'Gcash', 'Delivery', '2024-02-17', '21:14:00', 'Accepted'),
(7, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"2\";s:12:\"productImage\";s:35:\"admin/productimages/2/download.jfif\";s:11:\"productName\";s:14:\"Chicken Inasal\";s:8:\"quantity\";i:1;s:4:\"size\";s:5:\"Large\";s:9:\"sizePrice\";i:200;s:10:\"totalPrice\";i:200;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '200.00', 'COD', 'Delivery', '2024-03-08', '23:22:00', 'Accepted');

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
(8, 'Bulk Order', 'big orders for big pricing\r\n', '2024-01-27 08:15:00', '27-01-2024 04:12:14 PM'),
(9, 'Short Order', 'short orders for single pricing', '2024-01-27 10:40:57', NULL);

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
(1, 20, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"3\";s:12:\"productImage\";s:39:\"admin/productimages/3/download (1).jfif\";s:11:\"productName\";s:14:\"Orange Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:800;s:10:\"totalPrice\";i:800;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '800.00', 'Gcash', 'Delivery', '0000-00-00 00:00:00', 'Paid', 'Cover .png');

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
(1, 4, 'Accepted', 'dadadddadad', '2024-03-06 14:14:42'),
(2, 5, 'Accepted', 'ew', '2024-03-06 14:48:55'),
(3, 4, 'Accepted', 'Banger', '2024-03-06 15:13:11'),
(4, 7, 'Accepted', 'te', '2024-03-06 15:23:26'),
(5, 4, 'To Pay', 'dada', '2024-03-06 15:35:32'),
(6, 7, 'To Pay', 'da', '2024-03-06 16:02:41'),
(7, 8, 'Accepted', '', '2024-04-04 11:46:06'),
(8, 9, 'Accepted', '', '2024-04-05 05:09:03'),
(9, 10, 'Accepted', '', '2024-04-05 05:10:16'),
(10, 5, 'Declined', '', '2024-04-08 12:21:03'),
(11, 5, 'Declined', 'Too Early', '2024-04-08 12:21:44'),
(12, 11, 'Declined', 'di kaya lods', '2024-04-08 12:23:16'),
(13, 12, 'Declined', '', '2024-04-08 16:01:38'),
(14, 18, 'To Pay', '', '2024-04-08 16:04:21'),
(15, 19, 'To Pay', '', '2024-04-08 16:13:53'),
(16, 20, 'To Pay', '', '2024-04-08 16:24:23');

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
(6, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"2\";s:12:\"productImage\";s:35:\"admin/productimages/2/download.jfif\";s:11:\"productName\";s:14:\"Chicken Inasal\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:400;s:10:\"totalPrice\";i:400;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '400.00', 'Gcash', 'Delivery', '2024-03-07', '22:05:00', 'Paid'),
(18, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:2:\"11\";s:12:\"productImage\";s:37:\"admin/productimages/11/sampol.jpg.jpg\";s:11:\"productName\";s:5:\"Aglio\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:400;s:10:\"totalPrice\";i:400;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '400.00', 'Gcash', 'Delivery', '2024-04-13', '00:04:00', 'Paid'),
(19, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:2:\"12\";s:12:\"productImage\";s:32:\"admin/productimages/12/aglio.jpg\";s:11:\"productName\";s:12:\"RICO CHICKEN\";s:8:\"quantity\";i:2;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:400;s:10:\"totalPrice\";i:800;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '800.00', 'Gcash', 'Delivery', '2024-04-13', '00:15:00', 'Paid'),
(20, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"3\";s:12:\"productImage\";s:39:\"admin/productimages/3/download (1).jfif\";s:11:\"productName\";s:14:\"Orange Chicken\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:800;s:10:\"totalPrice\";i:800;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '800.00', 'COD', 'Delivery', '2024-04-13', '00:26:00', 'Paid');

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
(1, '8', '14', 'Chicken Parmesan', '100.00', '200.00', '300.00', '500.00', 'Yummers', 'project.jpg', '', '', 'In Stock', '2024-01-30 13:31:36', '2024-04-05 05:05:09'),
(2, '8', '14', 'Chicken Inasal', '100.00', '200.00', '300.00', '400.00', 'Yummerz', 'download.jfif', '', '', 'In Stock', '2024-01-30 14:16:08', '2024-01-30 14:16:08'),
(3, '8', '14', 'Orange Chicken', '200.00', '400.00', '600.00', '800.00', 'yummerz', 'download (1).jfif', '', '', 'In Stock', '2024-01-30 14:16:34', '2024-01-30 16:06:30'),
(11, '8', '14', 'Aglio', '100.00', '200.00', '300.00', '400.00', '<br>', 'sampol.jpg.jpg', '', '', 'In Stock', '2024-04-08 14:59:51', '2024-04-08 14:59:51'),
(12, '8', '14', 'RICO CHICKEN', '100.00', '200.00', '300.00', '400.00', '<br>', 'aglio.jpg', '', '', 'In Stock', '2024-04-08 15:00:48', '2024-04-08 15:00:48'),
(13, '8', '17', 'Aglio', '100.00', '200.00', '300.00', '400.00', '<br>', 'Cover .png', '', '', 'In Stock', '2024-04-08 15:02:04', '2024-04-08 15:02:04'),
(14, '8', '14', 'Aglio', '100.00', '200.00', '300.00', '400.00', '<br>', 'Cover .png', '', '', 'In Stock', '2024-04-08 15:19:07', '2024-04-08 15:19:07');

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
(14, 8, 'Chicken', '2024-01-27 08:38:05', '27-01-2024 04:12:39 PM'),
(16, 8, 'Pasta', '2024-02-10 04:54:35', NULL),
(17, 8, 'Beef', '2024-04-05 05:03:08', NULL);

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

--
-- Dumping data for table `to_pay`
--

INSERT INTO `to_pay` (`id`, `user_session_id`, `name`, `contact`, `email`, `items`, `delivery_address`, `total_price`, `payment_option`, `delivery_option`, `preparation_date`, `delivery_time`, `status`) VALUES
(4, 6, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"2\";s:12:\"productImage\";s:35:\"admin/productimages/2/download.jfif\";s:11:\"productName\";s:14:\"Chicken Inasal\";s:8:\"quantity\";i:1;s:4:\"size\";s:3:\"Xxl\";s:9:\"sizePrice\";i:400;s:10:\"totalPrice\";i:400;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '400.00', 'Gcash', 'Delivery', '2024-02-17', '21:14:00', 'To Pay'),
(7, 7, 'Ezequiel Gonzalez', '09762909844', 'ezequiel.gonzalez.cics@ust.edu.ph', 'a:1:{i:0;a:7:{s:9:\"productId\";s:1:\"2\";s:12:\"productImage\";s:35:\"admin/productimages/2/download.jfif\";s:11:\"productName\";s:14:\"Chicken Inasal\";s:8:\"quantity\";i:1;s:4:\"size\";s:5:\"Large\";s:9:\"sizePrice\";i:200;s:10:\"totalPrice\";i:200;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '200.00', 'COD', 'Delivery', '2024-03-08', '23:22:00', 'To Pay');

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

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(1, 'test', 'test@gmail.com', 9009857868, 'f925916e2754e5e03f75dd58a5733251', 'Test', 'Test', 'Test', 110001, 'Test', 'Test Manila', 'Test Manila', 110092, '2024-02-26 22:58:24', '');

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

--
-- Dumping data for table `userorders`
--

INSERT INTO `userorders` (`order_id`, `user_session_id`, `items`, `delivery_address`, `total_price`, `payment_option`, `delivery_option`, `preparation_date`, `status`, `created_at`) VALUES
(4, '1', 'a:3:{i:0;a:4:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}i:1;a:4:{s:9:\"productId\";i:2;s:11:\"productName\";s:14:\"Chicken Inasal\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}i:2;a:4:{s:9:\"productId\";i:3;s:11:\"productName\";s:14:\"Orange Chicken\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '600.00', '', 'Delivery', '0000-00-00', 'pending', '2024-02-03 17:19:25'),
(5, '1', 'a:3:{i:0;a:4:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}i:1;a:4:{s:9:\"productId\";i:2;s:11:\"productName\";s:14:\"Chicken Inasal\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}i:2;a:4:{s:9:\"productId\";i:3;s:11:\"productName\";s:14:\"Orange Chicken\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '600.00', 'COD', 'Delivery', '0000-00-00', 'pending', '2024-02-03 17:19:39'),
(6, '1', 'a:3:{i:0;a:4:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}i:1;a:4:{s:9:\"productId\";i:2;s:11:\"productName\";s:14:\"Chicken Inasal\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}i:2;a:4:{s:9:\"productId\";i:3;s:11:\"productName\";s:14:\"Orange Chicken\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '600.00', 'Gcash', 'Delivery', '0000-00-00', 'pending', '2024-02-03 17:19:52'),
(7, '1', 'a:2:{i:0;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";s:10:\"totalPrice\";i:100;}i:1;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:3:\"XXL\";s:8:\"quantity\";s:1:\"5\";s:10:\"totalPrice\";N;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '2600.00', 'COD', 'Delivery', '2024-02-16', 'pending', '2024-02-03 17:29:47'),
(8, '1', 'a:3:{i:0;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";s:10:\"totalPrice\";i:100;}i:1;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:3:\"XXL\";s:8:\"quantity\";s:1:\"5\";s:10:\"totalPrice\";N;}i:2;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:3:\"XXL\";s:8:\"quantity\";s:1:\"5\";s:10:\"totalPrice\";N;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '5100.00', '', 'Delivery', '0000-00-00', 'pending', '2024-02-03 17:31:58'),
(9, '1', 'a:2:{i:0;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:1:\"M\";s:8:\"quantity\";s:1:\"1\";s:10:\"totalPrice\";i:100;}i:1;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:3:\"XXL\";s:8:\"quantity\";s:1:\"5\";s:10:\"totalPrice\";N;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '5100.00', '', 'Delivery', '0000-00-00', 'pending', '2024-02-03 17:32:38'),
(10, '1', 'a:1:{i:0;a:5:{s:9:\"productId\";i:1;s:11:\"productName\";s:16:\"Chicken Parmesan\";s:4:\"size\";s:3:\"XXL\";s:8:\"quantity\";s:1:\"5\";s:10:\"totalPrice\";N;}}', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '4900.00', '', 'Delivery', '0000-00-00', 'pending', '2024-02-03 17:33:32');

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
(7, 'Ezequiel', 'Gonzalez', 'ezequiel.gonzalez.cics@ust.edu.ph', '09762909844', '06, Purok Centro, Sta Lucia,, LUBAO, PAMPANGA, 2005', '$2y$10$b.o13CPlVoMExv14eameK.0/EQFGXS0/PEcRfUjr.pTLSUgaZjapu', 'c1085225d359e373e179d247db091f4dcd', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gcashpayments`
--
ALTER TABLE `gcashpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userorders`
--
ALTER TABLE `userorders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
