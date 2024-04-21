-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 05:47 PM
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
(24, 11, 44, 1);

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
(27, 'sialm takma', 'item_Category_299.jpg', 'No', 'Yes');

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
(35, 'buddha wall poster', 'description here  mna', 'peacefulbbb', 1040.00, 'item-Name-7669.png', 23, 'No', 'No'),
(42, 'silamtakma', 'this is specially designed by our best artist miss eshu raut. she is a very humble girl ,very talented', 'sasto saman aayo', 450.00, 'item-Name-9708.jpg', 27, 'Yes', 'Yes'),
(43, 'cotton bags', 'bags made with pure 100%cotton', '100% pure', 700.00, 'item-Name-1086.jpg', 21, 'Yes', 'Yes'),
(44, 'fancy bag', 'specially made by our yangri brothers', 'a black bag', 700.00, 'item-Name-9967.jpg', 21, 'Yes', 'Yes'),
(45, 'white color bag', 'a white color bag', 'a bag', 750.00, 'item-Name-5795.jpg', 21, 'Yes', 'Yes');

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
(7, 'admin', 1, 'itahari', 9810506058, 3500, '0', '0', '2024-03-25 13:13:03'),
(8, 'admin', 1, 'full street address', 1050050505, 4050, '0', '0', '2024-03-25 13:15:01'),
(9, 'admin', 1, 'full street address', 1050050505, 700, '0', '0', '2024-03-25 15:12:53'),
(10, 'enjal', 4, 'itahari', 9810506058, 1850, '0', '0', '2024-03-25 17:21:44'),
(11, 'sampey', 21, 'itahari', 1050050505, 1850, '0', '0', '2024-04-12 09:54:20');

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
(16, 'prashant', 'my first name', 'my last name', 'prashant@gmail.com', 9810506058, '$2y$10$qvwq0oIkPRVSn5P5Kdi1vOCWGfp9oNMz2rABpYdSzxGTi65r8hXLG', '2024-03-25 17:27:49', 'itahari'),
(18, 'enjal', '', '', 'me@mydomain.com', 9810506058, '$2y$10$zEk7oFvHJazskHjI8o.vc.5TyAbmTNO2mhRMCM0v4CiEibIzRIdXu', '2024-03-25 17:33:13', 'itahari'),
(19, 'admin', '', '', 'me@mydomain.com', 9810506058, '$2y$10$ti/7/qB8N4LXydG6BTeFgOxYWukTy2VhHwGPElcgXEwESgdmpwTpq', '2024-03-25 17:33:52', 'itahari'),
(20, 'kabin', 'kabin ', 'rai', 'kabin69@gmail.com', 9765378356, '$2y$10$g6o.IPBc5pVBfTRftwWJOemESQn./D4cLjUcc14Zqk60FfV77ma5q', '2024-03-25 17:35:44', 'full street address'),
(21, 'sampey', 'sampanna', 'Adhikari', 'sampanna@gmail.com', 1050050505, '$2y$10$JbZEbqqQFTifhe.Nsliy0OB7fAI3nI0s2KWfBKpN/C6w/ve5nB2Ee', '2024-04-12 09:53:29', 'itahari');

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
(92, 44, 1, 16, '2024-03-25 17:45:01'),
(93, 43, 1, 16, '2024-03-25 17:45:08'),
(94, 42, 1, 16, '2024-03-25 17:45:17'),
(95, 45, 1, 16, '2024-03-25 17:45:20');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `itemId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
