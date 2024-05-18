-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 05:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handscrafts-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `deliveryBoyName` varchar(35) NOT NULL,
  `deliveryBoyPhoneNo` bigint(25) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliverydetails`
--

INSERT INTO `deliverydetails` (`id`, `orderId`, `deliveryBoyName`, `deliveryBoyPhoneNo`, `deliveryTime`, `dateTime`) VALUES
(2, 20, 'messi ', 1152252552, 45, '2024-05-17 23:33:12'),
(3, 23, 'prashant', 9810506058, 45, '2024-05-17 23:40:49'),
(4, 24, 'Nirakar  Bhattarai', 9765378356, 60, '2024-05-18 00:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `itemId` int(21) NOT NULL,
  `itemQuantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `itemId`, `itemQuantity`) VALUES
(1, 1, 23, 1),
(2, 1, 24, 1),
(3, 1, 22, 1),
(4, 2, 35, 1),
(5, 2, 36, 1),
(6, 2, 44, 1),
(7, 2, 42, 1),
(8, 3, 36, 1),
(9, 3, 42, 1),
(10, 4, 35, 1),
(11, 5, 42, 1),
(12, 6, 43, 3),
(13, 7, 43, 5),
(14, 8, 45, 2),
(15, 8, 44, 1),
(16, 8, 43, 2),
(17, 8, 42, 1),
(18, 9, 43, 1),
(19, 10, 42, 1),
(20, 10, 43, 1),
(21, 10, 44, 1),
(22, 11, 42, 1),
(23, 11, 43, 1),
(24, 11, 44, 1),
(25, 12, 43, 1),
(26, 13, 35, 1),
(27, 13, 44, 1),
(28, 14, 43, 1),
(29, 14, 42, 1),
(30, 14, 45, 1),
(31, 15, 43, 1),
(32, 16, 45, 1),
(33, 16, 44, 1),
(34, 17, 46, 1),
(35, 18, 49, 1),
(36, 19, 47, 1),
(37, 19, 49, 1),
(38, 20, 51, 1),
(39, 21, 50, 1),
(40, 21, 51, 1),
(41, 22, 51, 1),
(42, 23, 50, 1),
(43, 24, 50, 1),
(44, 24, 51, 1),
(45, 25, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(15, 'kabin', 'kabin', '202cb962ac59075b964b07152d234b70'),
(21, 'prashant', 'prashant', '202cb962ac59075b964b07152d234b70'),
(23, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`categoryId`, `title`, `image_name`, `featured`, `active`) VALUES
(21, 'bag', 'item_Category_631.jpg', 'Yes', 'Yes'),
(22, 'canva_messi', 'item_Category_609.jpg', 'Yes', 'Yes'),
(23, 'buddha_Canva', 'item_Category_172.png', 'Yes', 'Yes'),
(27, 'sialm takma', 'item_Category_299.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `itemId` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `sub_description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`itemId`, `title`, `description`, `sub_description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(50, 'messi canva', 'messi photo available', 'messisiiiiii', 1050.00, 'item-Name-9808.jpeg', 22, 'Yes', 'Yes'),
(51, 'bag', 'bag here', 'white bag', 1050.00, 'item-Name-3140.jpg', 21, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `orderId` int(21) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `amount` int(200) NOT NULL,
  `paymentMode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=cash on delivery, \r\n1=online ',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `orderDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`orderId`, `username`, `userId`, `address`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) VALUES
(23, 'prashant', 25, 'Itahari', 9810506058, 1050, '0', '1', '2024-05-17 23:40:19'),
(24, 'motey', 27, 'balgram', 9810506058, 2100, '0', '1', '2024-05-17 23:58:29'),
(25, 'kabin', 20, 'nepal', 1234566691, 1050, '0', '0', '2024-05-18 00:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `password`, `joinDate`, `address`) VALUES
(20, 'kabin', 'kabin ', 'rai', 'kabin69@gmail.com', 9765378356, '$2y$10$g6o.IPBc5pVBfTRftwWJOemESQn./D4cLjUcc14Zqk60FfV77ma5q', '2024-03-25 17:35:44', 'full street address'),
(21, 'sampey', 'sampanna', 'Adhikari', 'sampanna@gmail.com', 1050050505, '$2y$10$JbZEbqqQFTifhe.Nsliy0OB7fAI3nI0s2KWfBKpN/C6w/ve5nB2Ee', '2024-04-12 09:53:29', 'itahari'),
(25, 'prashant', 'my first name', 'my last name', 'prashant@gmail.com', 9765378356, '$2y$10$.x7RY3gcOayf8PVUHwgCOu9LDoiP.3eTNWgZBzAP8jRmQ7OiTCDKW', '2024-05-13 11:51:23', 'balgram'),
(27, 'motey', 'saman', 'bhattarai', 'samanbhattarai@gmail.com', 1234566691, '$2y$10$1rhiYAxGbl/kfGgykApWH.5eBIabFnVNVLzdcbr1NSQmwYHuOdZAq', '2024-05-17 23:57:08', 'balgram');

-- --------------------------------------------------------

--
-- Table structure for table `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viewcart`
--

INSERT INTO `viewcart` (`cartItemId`, `itemId`, `itemQuantity`, `userId`, `addedDate`) VALUES
(42, 35, 1, 0, '2024-03-15 08:34:38'),
(45, 34, 1, 0, '2024-03-15 10:05:21'),
(53, 35, 5, 7, '2024-03-15 15:20:13'),
(54, 36, 1, 7, '2024-03-15 15:20:18'),
(55, 34, 1, 7, '2024-03-15 15:22:26'),
(56, 37, 10, 7, '2024-03-15 15:22:30'),
(57, 39, 6, 7, '2024-03-15 15:22:34'),
(58, 42, 2, 7, '2024-03-15 15:22:38'),
(68, 36, 4, 11, '2024-03-18 10:30:10'),
(69, 34, 1, 11, '2024-03-18 10:30:59'),
(70, 34, 2, 12, '2024-03-18 11:47:46'),
(71, 34, 1, 13, '2024-03-18 12:47:07'),
(72, 36, 170, 14, '2024-03-18 17:14:30'),
(105, 44, 1, 19, '2024-05-12 09:07:54'),
(106, 43, 1, 16, '2024-05-12 12:09:08'),
(107, 44, 1, 16, '2024-05-12 12:09:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `itemId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`categoryId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
