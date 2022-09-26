-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2022 at 11:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Vikas Yadav', 'username', 'dc2504f1ef58c7f00c17a50b82998ce2'),
(7, 'Sunny', 'sunnykumar', '827ccb0eea8a706c4c34a16891f84e7b'),
(11, 'Vikas Yadav', 'vikas', '827ccb0eea8a706c4c34a16891f84e7b'),
(12, 'Rad Developer', 'developer', 'bebe68374a49cb41b7c9219e97250044'),
(13, 'RAD TECH', 'rad', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(24, 'Bihari Food', 'Food_category_532.jpg', 'Yes', 'Yes'),
(29, 'UP Food', 'Food_category_762.webp', 'Yes', 'Yes'),
(30, 'MP Foods', 'Food_category_854.jpg', 'Yes', 'Yes'),
(31, 'Gujrati Foods', 'Food_category_925.jpg', 'Yes', 'Yes'),
(32, 'Rajasthani Food', 'Food_category_935.webp', 'Yes', 'Yes'),
(33, 'Bengali Foods', 'Food_category_136.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(13, 'Litti Chokha', 'It is a Bihari dish most delicious and popular food. Litti and chokha combinedly favorite of all.', '60.00', 'Food-Name-4212.jpg', 24, 'Yes', 'Yes'),
(14, 'Anarsa', 'It is a Bihari sweet, It is most popular sweet of Bihar.', '80.00', 'Food-Name-8847.png', 24, 'Yes', 'Yes'),
(15, 'Khasta Kachori', 'It is dish of UP and it very spicy and tasty. It is one of the popular food of UP.', '40.00', 'Food-Name-2344.jpg', 29, 'Yes', 'Yes'),
(16, 'Lucknowi Biryani', 'It is non-veg food made up with fry chicken with lots of spices. It is main course food.', '450.00', 'Food-Name-4288.jpg', 29, 'Yes', 'Yes'),
(17, 'Malpua', 'it is dish of MP, it is a sweet dish and very tasty and delicious food mainly made on occasion.', '60.00', 'Food-Name-6634.jpg', 30, 'Yes', 'Yes'),
(18, 'Imarti', 'It is a sweet dish is just like Jalebi with spiral design with different taste. It is popular Sweet of MP.', '100.00', 'Food-Name-6520.crdownload', 30, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(13, 'Aaloo Tikki Burger', '60.00', 2, '120.00', '0000-00-00 00:00:00', 'ordered', 'Vikas Kumar', '8358883274', 'vkyadav2609@gmail.com', 'Dehri On Sone'),
(14, 'Veg Steamed Momo', '150.00', 3, '450.00', '0000-00-00 00:00:00', 'ordered', 'Shubham Sharma', '7632889236', 'imnaughty1111@gmil.com', 'Purnea'),
(15, 'Non Veg Supreme Pizza', '700.00', 2, '1400.00', '0000-00-00 00:00:00', 'ordered', 'Vikas', '537286328672', 'imnaughty1111@gmil.com', 'dehri'),
(16, 'Mexican Green Wave Pizza', '699.00', 2, '1398.00', '0000-00-00 00:00:00', 'ordered', 'Vikas', '8358883274', 'vkyadav2609@gmail.com', 'Sasaram'),
(17, 'Litti Chokha', '60.00', 2, '120.00', '0000-00-00 00:00:00', 'ordered', 'Vikas Kumar Yadav', '8358883274', 'vkyadav2609@gmail.com', 'Jamuhar'),
(18, 'Litti Chokha', '60.00', 1, '60.00', '0000-00-00 00:00:00', 'ordered', ',,', 'jkkkk', 'abc@gmail.com', 'erirjr');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
