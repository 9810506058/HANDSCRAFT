-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 05:47 AM
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
(19, 'prashant', 'prashant', '202cb962ac59075b964b07152d234b70');

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
(24, '-vandina', 'item_Category_458.png', 'Yes', 'Yes'),
(26, 'ornaments', 'item_Category_161.jpg', 'Yes', 'Yes');

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
(34, 'wall canva', 'this canva is specially designed to  furnish the  meeting room and it is specially handmade', 'enhance the ambiance of your room', 1050.00, 'item-Name-9372.png', 22, 'Yes', 'Yes'),
(35, 'buddha wall poster', 'description here', 'peaceful', 1040.00, 'item-Name-7669.png', 23, 'Yes', 'Yes'),
(36, 'woolen bags', 'a pure woolean bag ', ' handmade bag', 450.00, 'item-Name-8982.jpg', 21, 'Yes', 'Yes'),
(37, 'vandina ko item', 'j lekda ne hunxa', 'nalekda ne hunxa', 100.00, 'item-Name-5552.png', 24, 'Yes', 'Yes'),
(39, 'ornaments', 'a special type of the  ornament made by the precious metal', 'unisex ornaments', 2400.00, 'item-Name-4551.jpg', 26, 'Yes', 'Yes'),
(40, 'Mr.', 'this is a comment', 'this is a comment', 4500.00, '', 21, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `joinDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `password`, `joinDate`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 1111111111, '$2y$10$AAfxRFOYbl7FdN17rN3fgeiPu/xQrx6MnvRGzqjVHlGqHAM4d9T1i', '2021-04-11 11:40:58'),
(2, 'prashant', 'happy', 'vandina', 'prashant@gmail.com', 1050050505, '$2y$10$oQea3tt9XZvadRKpAGftI.XQ8X1WUKGYp9HsH0xx5y4AAzyEuL8BS', '2024-02-26 12:41:51'),
(3, 'prashant11', 'happy', 'customer', 'prashant@gmail.com', 1050050505, '$2y$10$AvugEpV4ddSXqmZhpkQhVOnx/1YZpA5QAACy70LNnfbnnI9vDTF4y', '2024-03-15 01:22:49'),
(4, 'enjal', 'my first name', 'customer', 'me@mydomain.com', 1234566691, '$2y$10$xpZUUs12J3QyFAmo0EBy.e/HKIewAZ/USvJFzXeSitK3fG0hfVBSa', '2024-03-15 01:27:39'),
(5, 'enjal11', 'my first name', 'customer', 'me@mydomain.com', 1234566691, '$2y$10$AxTQyI6wdwFys9dPBgQcNOVF45Ii1rmSde4UPXaXsPb7EjCvpxFpS', '2024-03-15 01:30:42'),
(6, 'enjal112', 'my first name', 'customer', 'me@mydomain.com', 1234566691, '$2y$10$CdcYP.Qh7HUfWxfLu86Om.nU6lqAkBOETLqJ2J4I8HVHLVOR.YhbC', '2024-03-15 01:31:25');

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
(43, 35, 1, 4, '2024-03-15 09:48:05'),
(44, 34, 1, 4, '2024-03-15 09:55:13'),
(45, 34, 1, 0, '2024-03-15 10:05:21');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `itemId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
