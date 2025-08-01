-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2025 at 03:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(4, 'Communication Equipment'),
(1, 'Firearms & Ammunition'),
(5, 'Forensic Equipment'),
(8, 'Medical Supplies'),
(6, 'Office Supplies'),
(7, 'Protective Gear'),
(9, 'Surveillance Equipment'),
(2, 'Tactical Gear'),
(10, 'Uniforms & Accessories'),
(3, 'Vehicles');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(3, 'glock 17.jpeg', 'image/jpeg'),
(4, 'Taser X26.jpeg', 'image/jpeg'),
(5, 'Bulletproof Vest.jpeg', 'image/jpeg'),
(6, 'Police Radio.jpeg', 'image/jpeg'),
(7, 'Riot Shield.jpeg', 'image/jpeg'),
(8, 'Body Camera.jpeg', 'image/jpeg'),
(9, 'Crime Scene Kit.jpeg', 'image/jpeg'),
(10, 'Fingerprint Scanner.jpeg', 'image/jpeg'),
(11, 'Patrol Car.jpeg', 'image/jpeg'),
(12, 'Motorbike.jpeg', 'image/jpeg'),
(13, 'Surveillance Drone.jpeg', 'image/jpeg'),
(14, 'Night Vision Goggles.jpeg', 'image/jpeg'),
(15, 'First Aid Kit.jpeg', 'image/jpeg'),
(16, 'CPR Mask.jpeg', 'image/jpeg'),
(17, 'HP LaserJet Pro MFP Printer.jpeg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `expire_date` date NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_date`, `expire_date`, `categorie_id`, `media_id`, `date`, `price`) VALUES
(16, 'Glock 17', '19', '2024-01-15', '2030-01-15', 1, 3, '2024-01-16 20:50:56', 500.00),
(17, 'Taser X26', '15', '2024-02-10', '2030-02-10', 1, 4, '2024-02-12 20:51:36', 300.00),
(18, 'Bulletproof Vest', '18', '2023-12-05', '2033-12-05', 7, 5, '2023-04-18 20:51:54', 200.00),
(19, 'Riot Shield', '8', '2024-01-20', '2035-01-20', 7, 7, '2024-03-08 20:52:10', 150.00),
(20, 'Police Radio', '25', '2024-03-01', '2032-03-01', 4, 6, '2025-03-06 20:52:20', 100.00),
(21, 'Body Camera', '18', '2024-03-05', '2032-03-05', 4, 8, '2024-03-07 20:52:35', 250.00),
(22, 'Crime Scene Kit', '12', '2023-11-20', '2030-11-20', 5, 9, '2023-11-22 20:52:45', 400.00),
(23, 'Fingerprint Scanner', '10', '2024-02-28', '2031-02-28', 5, 10, '2024-03-01 20:53:05', 350.00),
(24, 'Patrol Car', '5', '2023-10-15', '2040-10-15', 3, 11, '2023-10-16 20:53:17', 25000.00),
(25, 'Motorbike', '7', '2023-09-10', '2035-09-10', 3, 12, '2023-09-12 20:53:37', 8000.00),
(26, 'Surveillance Drone', '6', '2024-03-12', '2035-03-12', 9, 13, '2024-03-14 20:53:53', 5000.00),
(27, 'Night Vision Goggles', '3', '2024-02-18', '2034-02-18', 9, 14, '2024-02-20 20:54:20', 1200.00),
(28, 'First Aid Kit', '20', '2024-01-30', '2029-01-30', 8, 15, '2024-01-31 20:54:40', 50.00),
(29, 'CPR Mask', '15', '2024-02-15', '2030-02-15', 8, 16, '2024-02-20 20:54:56', 25.00),
(30, 'HP LaserJet Pro MFP Printer', '3', '2025-03-12', '2030-06-05', 6, 17, '2025-03-26 17:12:05', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`) VALUES
(1, 16, 1, 500.00, '2025-03-28'),
(11, 18, 2, 400.00, '2025-03-28'),
(12, 22, 2, 400.00, '2025-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Shruti', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2025-03-30 23:27:01'),
(2, 'Saloni ', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.png', 1, '2025-03-30 22:50:39'),
(3, 'Rohit', 'User', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.png', 1, '2025-03-30 22:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
