-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2020 at 07:54 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(9) NOT NULL,
  `title` varchar(90) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(9) NOT NULL,
  `img_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img_url`) VALUES
(1, 'Samsung Galaxy S20 5G smartphone 12/128GB (cloud blue)', 'Samsung Galaxy S20 is a line of smartphones designed, developed, marketed, and manufactured by Samsung Electronics as part of its Galaxy S series. They collectively serve as the successor to the Galaxy S10. The S20 line consists of flagship Galaxy S20 and Galaxy S20+ models differentiated primarily by screen size, as well as a larger camera-focused model, the Galaxy S20 Ultra. Key upgrades over the previous model, in addition to improved specifications, include a display with a 120 Hz refresh rate, an improved camera system supporting 8K video recording and a super-resolution zoom of 30–100×, depending on the model.', 11000, 'samsung_galaxy_S20.png'),
(2, 'iPhone 11 64 GB (svart)', 'The iPhone 11 is a smartphone designed, developed, and marketed by Apple Inc. It is the thirteenth generation lower-priced iPhone, succeeding the iPhone XR. The prominent changes compared with the iPhone XR are the Apple A13 Bionic chip, and an ultra wide dual camera system. While the iPhone 11 Pro comes with an 18 W Lightning to USB-C fast charger, the iPhone 11 comes with the same 5 W charger found on previous iPhones, even though this faster charger is compatible with both models. ', 8500, 'iphone_11.png'),
(3, 'Huawei P30 Pro', 'The P30 Pro is a very impressive piece of kit. It has a gorgeous dual-curved design on the front and back that makes the mammoth 6.47-inch OLED display almost manageable in one-hand. And while it doesn\'t match the Galaxy S10 or iPhone XS in terms of fit-and-finish, there\'s no doubt this is a well-made smartphone. Zoom in to explore the mystery of the celestial at night, watch an eagle hovering over trees or examine the delicate details of crystal. Capture the best things in the moment and create your vision for the future. The HUAWEI P30 Pro is accentuating a new peak of smartphone photography.', 8000, 'huawei_p30_pro.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
