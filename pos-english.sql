-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 04:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos-english`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `date`) VALUES
(1, 'building', '2021-07-19 13:07:52'),
(2, 'door', '2021-07-19 13:08:05'),
(3, 'supplies', '2021-07-19 13:08:18'),
(4, 'construct', '2021-07-19 13:08:32'),
(5, 'roof', '2021-07-19 13:09:13'),
(6, 'tower', '2021-07-22 12:31:16'),
(7, 'jam', '2021-07-27 11:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `totalpurchase` int(11) NOT NULL,
  `last_purchase` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `totalpurchase`, `last_purchase`, `date`) VALUES
(3, 'nariman', '(1234) 324-3432', '5 e hasarokan', 22, '2021-08-09 17:32:13', '2021-08-09 14:32:13'),
(14, 'gardi', '(2342) 343-5335', 'zanko', 10, '2021-08-09 14:16:22', '2021-08-09 12:10:06'),
(15, 'hama', '(1231) 323-4432', 'hasarok', 15, '2021-08-08 19:49:42', '2021-08-09 10:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL,
  `buy_price` float NOT NULL,
  `sell_price` float NOT NULL,
  `sell_quantity` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `code`, `description`, `image`, `stock`, `buy_price`, `sell_price`, `sell_quantity`, `date`) VALUES
(2, 1, '102', 'Float Plate for Palletizer', 'views/img/products/102/309.jpg', 5, 4500, 6300, 14, '2021-08-09 11:24:02'),
(3, 1, '103', 'Air Compressor for painting', 'views/img/products/103/327.jpg', 4, 3000, 4200, 15, '2021-08-09 14:32:13'),
(4, 1, '104', 'Adobe Cutter without Disk', 'views/img/products/104/562.jpg', 8, 4000, 5600, 7, '2021-08-06 15:25:50'),
(5, 1, '105', 'Floor Cutter without Disk', 'views/img/products/105/507.jpg', 10, 1540, 2156, 10, '2021-08-09 12:10:06'),
(6, 1, '106', 'Diamond Tip Disk', 'views/img/products/106/527.jpg', 16, 1100, 1540, 10, '2021-08-06 17:58:24'),
(7, 1, '107', 'Air extractor', '', 18, 1540, 2156, 6, '2021-08-06 17:58:24'),
(8, 1, '108', 'Mower', '', 19, 1540, 2156, 3, '2021-08-06 17:56:27'),
(9, 1, '109', 'Electric Water Washer', '', 19, 2600, 3640, 2, '2021-08-06 17:56:27'),
(10, 1, '110', 'Petrol pressure washer', '', 19, 2210, 3094, 1, '2021-08-06 17:56:14'),
(11, 1, '111', 'Gasoline motor pump', '', 19, 2860, 4004, 1, '2021-08-06 17:56:13'),
(12, 1, '112', 'Electric motor pump', '', 20, 2400, 3360, 4, '2021-08-06 15:19:29'),
(13, 1, '113', 'Circular saw', '', 18, 1100, 1540, 3, '2021-08-06 15:19:31'),
(14, 1, '114', 'Tungsten disc for circular saw', '', 20, 4500, 6300, 0, '0000-00-00 00:00:00'),
(15, 1, '115', 'Electric welder', '', 20, 1980, 2772, 0, '0000-00-00 00:00:00'),
(16, 1, '116', 'Welders face', '', 20, 4200, 5880, 0, '0000-00-00 00:00:00'),
(17, 1, '117', 'Illumination tower', '', 20, 1800, 2520, 0, '2021-07-27 11:27:38'),
(18, 2, '201', 'Floor Demolishing Hammer 110V', '', 20, 5600, 7840, 0, '0000-00-00 00:00:00'),
(19, 2, '202', 'Muela or chisel hammer demolishing floor', '', 20, 9600, 13440, 0, '0000-00-00 00:00:00'),
(20, 2, '203', 'Wall Wrecking Drill 110V', '', 20, 3850, 5390, 0, '0000-00-00 00:00:00'),
(21, 2, '204', 'Muela or chisel hammer demolition wall', '', 20, 9600, 13440, 0, '0000-00-00 00:00:00'),
(22, 2, '205', '1/2 Hammer Drill Wood and Metal', '', 20, 8000, 11200, 0, '0000-00-00 00:00:00'),
(23, 2, '206', 'Drill Percussion SDS Plus 110V', '', 20, 3900, 5460, 0, '0000-00-00 00:00:00'),
(24, 2, '207', 'Drill Percussion SDS Max 110V (Mining)', '', 20, 4600, 6440, 0, '0000-00-00 00:00:00'),
(25, 3, '301', 'Hanging scaffolding', '', 20, 1440, 2016, 0, '0000-00-00 00:00:00'),
(26, 3, '302', 'Scaffolding hanging spacer', '', 20, 1600, 2240, 0, '0000-00-00 00:00:00'),
(27, 3, '303', 'Modular scaffolding frame', '', 20, 900, 1260, 0, '0000-00-00 00:00:00'),
(28, 3, '304', 'Frame scaffolding scissors', '', 20, 100, 140, 0, '0000-00-00 00:00:00'),
(29, 3, '305', 'Scaffolding scissors', '', 20, 162, 227, 0, '0000-00-00 00:00:00'),
(30, 3, '306', 'Internal ladder for scaffolding', '', 20, 270, 378, 0, '0000-00-00 00:00:00'),
(31, 3, '307', 'Security handrails', '', 20, 75, 105, 0, '0000-00-00 00:00:00'),
(32, 3, '308', 'Rotating wheel for scaffolding', '', 20, 168, 235, 0, '0000-00-00 00:00:00'),
(33, 3, '309', 'safety harness', '', 20, 1750, 2450, 0, '0000-00-00 00:00:00'),
(34, 3, '310', 'Sling for harness', '', 20, 175, 245, 0, '0000-00-00 00:00:00'),
(35, 3, '311', 'Metallic Platform', '', 20, 420, 588, 0, '0000-00-00 00:00:00'),
(36, 4, '401', '6 Kva Diesel Power Plant', '', 20, 3500, 4900, 0, '0000-00-00 00:00:00'),
(37, 4, '402', '10 Kva Diesel Power Plant', '', 20, 3550, 4970, 0, '0000-00-00 00:00:00'),
(38, 4, '403', '20 Kva Diesel Power Plant', '', 20, 3600, 5040, 0, '0000-00-00 00:00:00'),
(39, 4, '404', '30 Kva Diesel Power Plant', '', 20, 3650, 5110, 0, '0000-00-00 00:00:00'),
(40, 4, '405', '60 Kva Diesel Power Plant', '', 20, 3700, 5180, 0, '0000-00-00 00:00:00'),
(41, 4, '406', '75 Kva Diesel Power Plant', '', 20, 3750, 5250, 0, '0000-00-00 00:00:00'),
(42, 4, '407', '100 Kva Diesel Power Plant', '', 20, 3800, 5320, 0, '0000-00-00 00:00:00'),
(43, 4, '408', '120 Kva Diesel Power Plant', '', 20, 3850, 5390, 0, '0000-00-00 00:00:00'),
(44, 5, '501', 'Aluminum Scissor Ladder', '', 20, 350, 490, 0, '0000-00-00 00:00:00'),
(45, 5, '502', 'Electric extension', '', 20, 370, 518, 0, '0000-00-00 00:00:00'),
(46, 5, '503', 'Tensioner cat', '', 20, 380, 532, 0, '0000-00-00 00:00:00'),
(47, 5, '504', 'Lamina Covers Gap', '', 20, 380, 532, 0, '0000-00-00 00:00:00'),
(48, 5, '505', 'Pipe wrench', '', 20, 480, 672, 0, '0000-00-00 00:00:00'),
(49, 5, '506', 'Manila by Metro', '', 20, 600, 840, 0, '0000-00-00 00:00:00'),
(50, 5, '507', '2-channel pulley', '', 20, 900, 1260, 0, '0000-00-00 00:00:00'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '0000-00-00 00:00:00'),
(52, 5, '509', 'Weighing machine', '', 20, 130, 182, 0, '0000-00-00 00:00:00'),
(53, 5, '510', 'Hydrostatic pump', '', 20, 770, 1078, 0, '0000-00-00 00:00:00'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '0000-00-00 00:00:00'),
(55, 5, '512', 'Concrete sample cylinder', '', 20, 400, 560, 0, '0000-00-00 00:00:00'),
(56, 5, '513', 'Lever Shear', '', 20, 450, 630, 0, '0000-00-00 00:00:00'),
(57, 5, '514', 'Scissor Shear', '', 20, 580, 812, 0, '0000-00-00 00:00:00'),
(58, 5, '515', 'Pneumatic tire car', 'views/img/products/515/713.jpg', 20, 420, 588, 0, '2021-08-06 20:34:01'),
(59, 5, '516', 'Cone slump', 'views/img/products/516/373.jpg', 20, 140, 196, 0, '2021-08-06 20:33:42'),
(60, 5, '517', 'Baldosin cutter', 'views/img/products/605/757.jpg', 20, 930, 1302, 0, '2021-07-26 17:28:38'),
(61, 4, '409', 'Concret Cement', 'views/img/products/604/898.png', 20, 1000, 1200, 0, '2021-07-26 17:28:45'),
(63, 6, '601', 'bena', 'views/img/products/605/757.jpg', 4, 12000, 20000, 0, '2021-07-26 17:28:35'),
(64, 6, '602', 'bena1', 'views/img/products/604/898.png', 3, 234, 32434, 0, '2021-07-26 17:28:43'),
(65, 6, '603', 'bena12', 'views/img/products/605/757.jpg', 12, 123342, 3000, 0, '2021-08-06 20:31:30'),
(66, 6, '604', 'bena122', 'views/img/products/604/898.png', 21, 12000, 3500, 0, '2021-08-06 20:31:42'),
(67, 6, '605', 'bena12', 'views/img/products/605/757.jpg', 10, 12000, 15000, 0, '2021-07-27 13:31:04'),
(68, 7, '7001', 'shusha', 'views/img/products/7001/951.jpg', 120, 10000, 15000, 0, '2021-08-06 17:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idSeller` int(11) NOT NULL,
  `products` text NOT NULL,
  `discount` float NOT NULL,
  `net` float NOT NULL,
  `total` float NOT NULL,
  `paymentMethod` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `idCustomer`, `idSeller`, `products`, `discount`, `net`, `total`, `paymentMethod`, `date`) VALUES
(24, 10001, 3, 1, '[{\"id\":\"2\",\"description\":\"Float Plate for Palletizer\",\"stock\":\"8\",\"quantity\":\"2\",\"price\":\"6300\",\"totalprice\":\"12600\"}]', 1512, 12600, 11088, 'cash', '2021-07-10 12:35:26'),
(25, 10002, 14, 1, '[{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"stock\":\"9\",\"quantity\":\"1\",\"price\":\"4200\",\"totalprice\":\"4200\"},{\"id\":\"4\",\"description\":\"Adobe Cutter without Disk\",\"stock\":\"9\",\"quantity\":\"1\",\"price\":\"5600\",\"totalprice\":\"5600\"}]', 1176, 9800, 8624, 'cash', '2021-08-04 17:36:46'),
(26, 10003, 14, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"stock\":\"24\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 0, 2156, 2156, 'cash', '2021-08-04 12:55:05'),
(27, 10004, 3, 1, '[{\"id\":\"2\",\"description\":\"Float Plate for Palletizer\",\"stock\":\"6\",\"quantity\":\"2\",\"price\":\"6300\",\"totalprice\":\"12600\"},{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"stock\":\"7\",\"quantity\":\"2\",\"price\":\"4200\",\"totalprice\":\"8400\"}]', 2100, 21000, 18900, 'cash', '2021-07-04 15:00:23'),
(30, 10005, 3, 1, '[{\"id\":\"4\",\"description\":\"Adobe Cutter without Disk\",\"stock\":\"8\",\"quantity\":\"1\",\"price\":\"5600\",\"totalprice\":\"5600\"}]', 0, 5600, 5600, 'cash', '2021-01-05 14:41:44'),
(31, 10006, 14, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"stock\":\"23\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 0, 2156, 2156, 'cash', '2021-02-05 15:04:33'),
(32, 10007, 3, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"stock\":\"22\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 258.72, 2156, 1897.28, 'cash', '2021-03-01 15:05:20'),
(33, 10008, 3, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"stock\":\"21\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 0, 2156, 2156, 'cash', '2021-04-05 16:05:30'),
(34, 10009, 3, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"stock\":\"20\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 0, 2156, 2156, 'cash', '2021-05-05 16:05:42'),
(38, 10010, 3, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"stock\":\"10\",\"quantity\":\"10\",\"price\":\"2156\",\"totalprice\":\"21560\"}]', 0, 21560, 21560, 'cash', '2021-06-06 12:41:27'),
(39, 10011, 15, 1, '[{\"id\":\"6\",\"description\":\"Diamond Tip Disk\",\"stock\":\"17\",\"quantity\":\"3\",\"price\":\"1540\",\"totalprice\":\"4620\"}]', 0, 4620, 4620, 'cash', '2021-08-06 17:50:05'),
(40, 10012, 15, 2, '[{\"id\":\"11\",\"description\":\"Gasoline motor pump\",\"stock\":\"19\",\"quantity\":\"1\",\"price\":\"4004\",\"totalprice\":\"4004\"},{\"id\":\"10\",\"description\":\"Petrol pressure washer\",\"stock\":\"19\",\"quantity\":\"1\",\"price\":\"3094\",\"totalprice\":\"3094\"}]', 0, 7098, 7098, 'cash', '2021-08-06 17:56:14'),
(41, 10013, 15, 2, '[{\"id\":\"9\",\"description\":\"Electric Water Washer\",\"stock\":\"19\",\"quantity\":\"1\",\"price\":\"3640\",\"totalprice\":\"3640\"},{\"id\":\"8\",\"description\":\"Mower\",\"stock\":\"19\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 0, 5796, 5796, 'cash', '2021-08-06 17:56:27'),
(43, 10014, 15, 3, '[{\"id\":\"6\",\"description\":\"Diamond Tip Disk\",\"stock\":\"16\",\"quantity\":\"1\",\"price\":\"1540\",\"totalprice\":\"1540\"},{\"id\":\"7\",\"description\":\"Air extractor\",\"stock\":\"18\",\"quantity\":\"1\",\"price\":\"2156\",\"totalprice\":\"2156\"}]', 0, 3696, 3696, 'cash', '2021-08-06 17:58:24'),
(49, 10015, 15, 1, '[{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"stock\":\"5\",\"quantity\":\"1\",\"price\":\"4200\",\"totalprice\":\"4200\"}]', 504, 4200, 3696, 'cash', '2021-08-09 14:17:21'),
(50, 10016, 14, 1, '[{\"id\":\"2\",\"description\":\"Float Plate for Palletizer\",\"stock\":\"0\",\"quantity\":\"5\",\"price\":\"6300\",\"totalprice\":\"31500\"}]', 0, 31500, 31500, 'cash', '2021-08-11 11:05:51'),
(52, 10017, 3, 1, '[{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"stock\":\"4\",\"quantity\":\"1\",\"price\":\"4200\",\"totalprice\":\"4200\"}]', 0, 4200, 4200, 'cash', '2021-08-09 14:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `user` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `profile` text COLLATE utf8_spanish_ci NOT NULL,
  `photo` text COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `profile`, `photo`, `status`, `lastLogin`, `date`) VALUES
(1, 'Ahmad Gardi', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'administrator', 'views/img/users/admin/636.jpg', 1, '2021-09-06 17:09:19', '2021-09-06 14:09:19'),
(2, 'Ana', 'ana', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'seller', 'views/img/users/ana/960.jpg', 1, '2021-08-22 18:13:13', '2021-08-22 15:13:13'),
(3, 'juan', 'juan', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'special', 'views/img/users/juan/215.jpg', 1, '2021-08-20 00:12:51', '2021-08-19 21:12:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
