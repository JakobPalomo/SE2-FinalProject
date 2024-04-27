-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 03:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `mediumPrice`, `largePrice`, `xlPrice`, `xxlPrice`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(1, '1', '1', 'Spicy Chicken', 1200.00, 1400.00, 1700.00, 2200.00, 'Test', 'Spicy Chicken.jpg', '', '', 'Remove', '2024-04-10 13:40:42', '2024-04-26 12:47:14'),
(2, '1', '1', 'Chicken Karaage', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Chicken Karaage.jpg', '', '', 'In Stock', '2024-04-10 13:46:12', '2024-04-10 13:46:12'),
(3, '1', '1', 'Chicken Shawarma', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'chicken shawarma.png', '', '', 'In Stock', '2024-04-10 13:51:18', '2024-04-10 13:51:18'),
(4, '1', '1', 'Kapampangan Chicken Asado', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', '423686854_7136901539680477_3077292866098800232_n (1).jpg', '', '', 'In Stock', '2024-04-10 13:54:24', '2024-04-10 13:58:36'),
(5, '1', '1', 'Chicken Caldereta', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Chicken caldereta.jpg', '', '', 'In Stock', '2024-04-10 13:58:21', '2024-04-10 13:58:21'),
(6, '1', '1', 'Chicken Cordon Blue', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Cordon Blue.jpg', '', '', 'In Stock', '2024-04-10 14:02:01', '2024-04-10 14:02:01'),
(7, '1', '1', 'Creamy Chicken Pastel', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Creamy Chicken Pastel.jpg', '', '', 'In Stock', '2024-04-10 14:04:36', '2024-04-10 14:04:36'),
(8, '1', '1', 'Classic Fried Chicken', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Classic Fried Chicken.jpg', '', '', 'In Stock', '2024-04-10 14:05:35', '2024-04-10 14:05:35'),
(9, '1', '1', 'Creamy Chicken With Mushroom', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Creamy-Garlic-Butter-Mushroom-Chicken-.jpg', '', '', 'In Stock', '2024-04-10 14:09:35', '2024-04-10 14:09:35'),
(10, '1', '1', 'Honey Lemon Chicken Wings', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'IMG_7991.jpg', '', '', 'In Stock', '2024-04-10 14:12:38', '2024-04-10 14:12:38'),
(11, '1', '1', 'Buffallo Chicken Wings', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Buffalo Chicken WIngs.jpg', '', '', 'In Stock', '2024-04-10 14:14:01', '2024-04-10 14:14:01'),
(12, '1', '1', 'Salted Egg Chicken Wings', 1200.00, 1400.00, 1700.00, 2200.00, '<br>', 'Salted egg Chicken wings.jpg', '', '', 'In Stock', '2024-04-10 14:15:04', '2024-04-10 14:15:04'),
(13, '1', '2', 'Spicy Pork', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'spicy pork.jpg', '', '', 'In Stock', '2024-04-10 14:25:23', '2024-04-10 14:35:21'),
(14, '1', '2', 'Crispy Pork Kare Kare', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'c05423dc2537f4147563b545929d88d2.jpg', '', '', 'In Stock', '2024-04-10 14:27:40', '2024-04-10 14:37:23'),
(15, '1', '2', 'Kapampangan Pork Embutido', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'Embutido.jpg', '', '', 'In Stock', '2024-04-10 14:29:55', '2024-04-10 14:29:55'),
(16, '1', '2', 'Pork Shawarma', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'pork shawarma.jpeg', '', '', 'In Stock', '2024-04-10 14:44:01', '2024-04-10 14:44:01'),
(17, '1', '2', 'Kapampangan Pork Asado', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'asado.jpg', '', '', 'In Stock', '2024-04-10 14:45:38', '2024-04-10 14:45:38'),
(18, '1', '2', 'Sweet and Sour Pork', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'IMG_2941.jpg', '', '', 'In Stock', '2024-04-10 14:47:33', '2024-04-10 14:47:33'),
(19, '1', '2', 'Pork Caldereta', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'IMG_0759.jpg', '', '', 'In Stock', '2024-04-10 14:49:21', '2024-04-10 14:49:21'),
(20, '1', '2', 'Pork Menudo', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'IMG_6910.jpg', '', '', 'In Stock', '2024-04-10 14:51:43', '2024-04-10 14:51:43'),
(21, '1', '2', 'Pork Lumpiang Shanghai', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'IMG_9325.jpg', '', '', 'In Stock', '2024-04-10 14:53:08', '2024-04-10 14:53:08'),
(22, '1', '2', 'Sisig Kapampangan', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', 'IMG_3933.jpg', '', '', 'In Stock', '2024-04-10 14:54:55', '2024-04-10 14:54:55'),
(23, '1', '2', 'Filipino Pork Ribs Steak', 1400.00, 1700.00, 2200.00, 2700.00, '<br>', '421829-e854b0e4cec44a90925c50b15efa516f.jpg', '', '', 'In Stock', '2024-04-10 14:57:06', '2024-04-10 14:57:06');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `contact`, `address`, `password`, `verify_token`, `verify_status`) VALUES
(1, 'Ezequiel', 'Gonzalez', 'ezequiel.gonzalez.cics@ust.edu.ph', '09762909844', '06, Purok Centro, Sta Lucia,, Lubao, Pampanga, 2005', '$2y$10$XXrGj7jl7YAjzxF/.wHnNuNqqr3P4S4f1nLSnk4tlVVVO/X.ESLfK', 'f6e38145a5af151f37d89b877e8f31bc', 1),
(2, 'Rico', 'Nieto', 'iamddx567@gmail.com', '09270376718', 'There, There, Here, There, 31, 2432', '$2y$10$d63ObOr77EAA/hpGxcFJQuN2JwUTqtWdV6TDrPAJ2F7ZDNhBosYLW', '418d1cc3af32330bce39d30b3c03c5cb', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
