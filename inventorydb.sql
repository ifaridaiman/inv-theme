-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2020 at 06:59 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Drinks', 'Juices, coffee, energy drinks and cold and warm soda'),
(2, 'Sweets and snacks', 'Candy products, chips, chewing gum, canned puddings and sweet cakes'),
(3, 'Eggs and Dairy Products', 'Milk, Butter, Cottage Cheese, Sour Cream and Egg'),
(4, 'Medication', 'Panadol, cough medicine, lip balm and throat lozenges'),
(5, 'Dry and Canned Goods', 'Bread, hot dog and hamburger buns, and dinner rolls. Canned soup, canned vege, canned meat and chili'),
(6, 'Meats and produce', 'Chicken, Meet');

-- --------------------------------------------------------

--
-- Table structure for table `defectlog`
--

CREATE TABLE `defectlog` (
  `defectlog_id` int(11) NOT NULL,
  `defectlog_qty` int(11) NOT NULL,
  `defect_desc` varchar(360) NOT NULL,
  `defectlog_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `inv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `defectlog`
--

INSERT INTO `defectlog` (`defectlog_id`, `defectlog_qty`, `defect_desc`, `defectlog_timestamp`, `inv_id`) VALUES
(13, 10, 'EXPIRED', '2020-01-21 03:40:43', 31);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inv_id` int(11) NOT NULL,
  `inv_qty` int(11) NOT NULL,
  `inv_ideal_qty` int(11) NOT NULL,
  `inv_warning_qty` int(11) NOT NULL,
  `prd_sku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inv_id`, `inv_qty`, `inv_ideal_qty`, `inv_warning_qty`, `prd_sku`) VALUES
(31, 35, 30, 15, 'med 1'),
(33, 50, 70, 20, 'mayo 1'),
(34, 2900, 1000, 500, 'mineral 12'),
(39, 0, 100, 50, 'LOCAL1');

-- --------------------------------------------------------

--
-- Table structure for table `inventorylog`
--

CREATE TABLE `inventorylog` (
  `invlog_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `invlog_qty` int(11) NOT NULL,
  `invlog_activity` varchar(250) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `invlog_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorylog`
--

INSERT INTO `inventorylog` (`invlog_id`, `store_id`, `invlog_qty`, `invlog_activity`, `inv_id`, `invlog_timestamp`) VALUES
(30, 1, 0, 'Stock Register', 31, '2020-01-20 11:24:27'),
(32, 1, 0, 'Stock Register', 33, '2020-01-20 11:24:31'),
(33, 1, 0, 'Stock Register', 34, '2020-01-20 11:24:33'),
(34, 1, 45, 'Stock in', 31, '2020-01-20 11:24:35'),
(36, 1, 50, 'Stock in', 33, '2020-01-20 11:24:38'),
(37, 1, 2900, 'Stock in', 34, '2020-01-20 11:24:40'),
(50, 1, 0, 'Stock Register', 39, '2020-01-21 03:34:04'),
(51, 1, 10, 'Defect Item out', 31, '2020-01-21 03:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `mgt_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage`
--

INSERT INTO `manage` (`mgt_id`, `usr_id`, `store_id`) VALUES
(1, 1234, 1),
(2, 1234, 2),
(3, 3214, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `order_id` int(11) NOT NULL,
  `prd_sku` varchar(250) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`order_id`, `prd_sku`, `order_qty`, `store_id`, `status`) VALUES
(28, 'med 1', 50, 1, 1),
(30, 'mayo 1', 50, 1, 1),
(31, 'mineral 12', 3000, 1, 1),
(35, 'LOCAL1', 100, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prd_sku` varchar(250) NOT NULL,
  `prd_name` varchar(250) NOT NULL,
  `prd_desc` varchar(250) NOT NULL,
  `prd_img` blob NOT NULL,
  `prd_price` float NOT NULL,
  `prd_cost` float NOT NULL,
  `prd_taxes` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_sku`, `prd_name`, `prd_desc`, `prd_img`, `prd_price`, `prd_cost`, `prd_taxes`, `category_id`, `supplier_id`) VALUES
('LOCAL1', 'LOCAL', 'LOCAL', '', 25, 20, 0.06, 1, 1),
('mayo 1', 'Mayonaise Kecil', 'Mayo putih', '', 7, 6, 0.06, 3, 11),
('med 1', 'Panadol', 'Cytron', '', 5, 4.5, 0.06, 1, 13),
('mineral 12', 'Air mineral', 'Air Mineral', '', 1, 0.8, 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `purchaselog`
--

CREATE TABLE `purchaselog` (
  `purchaseid` int(11) NOT NULL,
  `receivabletime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_id` int(11) NOT NULL,
  `receiveqty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaselog`
--

INSERT INTO `purchaselog` (`purchaseid`, `receivabletime`, `order_id`, `receiveqty`) VALUES
(17, '2020-01-20 10:34:41', 28, 45),
(19, '2020-01-20 10:34:56', 30, 50),
(20, '2020-01-20 10:35:05', 31, 2900);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(180) NOT NULL,
  `store_address` varchar(250) NOT NULL,
  `store_phonenum` varchar(20) NOT NULL,
  `store_email` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_address`, `store_phonenum`, `store_email`) VALUES
(1, 'Muhibah mini market seksyen 7', 'cawangan seksyen 7', '0123456789', 'muhibah7@gmail.com'),
(2, 'Muhibah Mini Market Seksyen 2', 'cawangan seksyen 2', '0132456789', 'muhibah2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(250) NOT NULL,
  `supplier_address` varchar(250) NOT NULL,
  `supplier_phonenum` varchar(250) NOT NULL,
  `supplier_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phonenum`, `supplier_email`) VALUES
(1, 'Maju Trading', 'Shah alam', '0345678910', 'majutrading@gmail.com'),
(2, 'Wipro Unza Sdn. Bhd.', '', '', ''),
(3, 'Nestle', 'Lot 3, Jalan Pelabur 23/1', '03-55423228', 'customer_service@ gardenia.com.my'),
(11, 'Siswa berjaya sdn bhd', 'Lot 123, Jalan ABC, Bandar XYZ, ABC, 123456', '0345678912', 'siwa@berjaya.com'),
(12, 'Etika Sdn Bhd', 'Lot 7 Jln p/2 654234 Jalan KL, 12345, Sungai Buloh', '1300-30-1300', 'customercareline@etikaholdings.com'),
(13, 'Cytron', 'Cytron centre1', '8975468791', 'cytron@cytron.com'),
(14, 'Gardenia Sales', 'Lot 3, Jalan pelabur 23/1, Mukim Ulu Sg, Kota Tinggi, Johor\r\n', '0355423228', 'sales@gardenia.my');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL,
  `usr_email` varchar(150) NOT NULL,
  `usr_password` varchar(80) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usr_id`, `usr_email`, `usr_password`, `role_id`) VALUES
(1234, 'adm@adm.com', '0000', 1),
(3214, 'staff@staff.com', '0000', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `defectlog`
--
ALTER TABLE `defectlog`
  ADD PRIMARY KEY (`defectlog_id`),
  ADD KEY `inv_id` (`inv_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inv_id`),
  ADD UNIQUE KEY `prd_sku` (`prd_sku`);

--
-- Indexes for table `inventorylog`
--
ALTER TABLE `inventorylog`
  ADD PRIMARY KEY (`invlog_id`),
  ADD KEY `inv_id` (`inv_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`mgt_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `prd_sku` (`prd_sku`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prd_sku`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `purchaselog`
--
ALTER TABLE `purchaselog`
  ADD PRIMARY KEY (`purchaseid`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `store_phonenum` (`store_phonenum`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_email` (`supplier_email`),
  ADD UNIQUE KEY `supplier_phonenum` (`supplier_phonenum`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_email` (`usr_email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `defectlog`
--
ALTER TABLE `defectlog`
  MODIFY `defectlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `inventorylog`
--
ALTER TABLE `inventorylog`
  MODIFY `invlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `manage`
--
ALTER TABLE `manage`
  MODIFY `mgt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `purchaselog`
--
ALTER TABLE `purchaselog`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `defectlog`
--
ALTER TABLE `defectlog`
  ADD CONSTRAINT `defectlog_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `inventory` (`inv_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`prd_sku`) REFERENCES `product` (`prd_sku`);

--
-- Constraints for table `inventorylog`
--
ALTER TABLE `inventorylog`
  ADD CONSTRAINT `inventorylog_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `inventory` (`inv_id`),
  ADD CONSTRAINT `inventorylog_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `manage_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`),
  ADD CONSTRAINT `manage_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`prd_sku`) REFERENCES `product` (`prd_sku`),
  ADD CONSTRAINT `orderproduct_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `purchaselog`
--
ALTER TABLE `purchaselog`
  ADD CONSTRAINT `purchaselog_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orderproduct` (`order_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
