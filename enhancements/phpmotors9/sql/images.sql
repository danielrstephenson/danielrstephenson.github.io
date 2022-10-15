-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2020 at 01:01 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(1, 3, 'adventador.jpg', '/phpmotors9/images/vehicles/adventador.jpg', '2020-02-05 20:31:11', 1),
(2, 3, 'adventador-tn.jpg', '/phpmotors9/images/vehicles/adventador-tn.jpg', '2020-02-05 20:31:11', 1),
(3, 1, 'wrangler.jpg', '/phpmotors9/images/vehicles/wrangler.jpg', '2020-02-05 20:31:56', 1),
(4, 1, 'wrangler-tn.jpg', '/phpmotors9/images/vehicles/wrangler-tn.jpg', '2020-02-05 20:31:56', 1),
(5, 2, 'model-t.jpg', '/phpmotors9/images/vehicles/model-t.jpg', '2020-02-05 20:32:11', 1),
(6, 2, 'model-t-tn.jpg', '/phpmotors9/images/vehicles/model-t-tn.jpg', '2020-02-05 20:32:11', 1),
(7, 4, 'monster-truck.jpg', '/phpmotors9/images/vehicles/monster-truck.jpg', '2020-02-05 20:32:26', 1),
(8, 4, 'monster-truck-tn.jpg', '/phpmotors9/images/vehicles/monster-truck-tn.jpg', '2020-02-05 20:32:26', 1),
(9, 5, 'mechanic.jpg', '/phpmotors9/images/vehicles/mechanic.jpg', '2020-02-05 20:32:39', 1),
(10, 5, 'mechanic-tn.jpg', '/phpmotors9/images/vehicles/mechanic-tn.jpg', '2020-02-05 20:32:39', 1),
(11, 6, 'batmobile.jpg', '/phpmotors9/images/vehicles/batmobile.jpg', '2020-02-05 20:32:57', 1),
(12, 6, 'batmobile-tn.jpg', '/phpmotors9/images/vehicles/batmobile-tn.jpg', '2020-02-05 20:32:57', 1),
(13, 7, 'mystery-van.jpg', '/phpmotors9/images/vehicles/mystery-van.jpg', '2020-02-05 20:33:13', 1),
(14, 7, 'mystery-van-tn.jpg', '/phpmotors9/images/vehicles/mystery-van-tn.jpg', '2020-02-05 20:33:13', 1),
(15, 8, 'fire-truck.jpg', '/phpmotors9/images/vehicles/fire-truck.jpg', '2020-02-05 20:33:23', 1),
(16, 8, 'fire-truck-tn.jpg', '/phpmotors9/images/vehicles/fire-truck-tn.jpg', '2020-02-05 20:33:23', 1),
(17, 9, 'crwn-vic.jpg', '/phpmotors9/images/vehicles/crwn-vic.jpg', '2020-02-05 20:33:36', 1),
(18, 9, 'crwn-vic-tn.jpg', '/phpmotors9/images/vehicles/crwn-vic-tn.jpg', '2020-02-05 20:33:36', 1),
(19, 10, 'camaro.jpg', '/phpmotors9/images/vehicles/camaro.jpg', '2020-02-05 20:33:52', 1),
(20, 10, 'camaro-tn.jpg', '/phpmotors9/images/vehicles/camaro-tn.jpg', '2020-02-05 20:33:52', 1),
(21, 11, 'escalade.jpg', '/phpmotors9/images/vehicles/escalade.jpg', '2020-02-05 20:34:03', 1),
(22, 11, 'escalade-tn.jpg', '/phpmotors9/images/vehicles/escalade-tn.jpg', '2020-02-05 20:34:03', 1),
(23, 12, 'hummer.jpg', '/phpmotors9/images/vehicles/hummer.jpg', '2020-02-05 20:34:14', 1),
(24, 12, 'hummer-tn.jpg', '/phpmotors9/images/vehicles/hummer-tn.jpg', '2020-02-05 20:34:14', 1),
(25, 13, 'aerocar.jpg', '/phpmotors9/images/vehicles/aerocar.jpg', '2020-02-05 20:34:27', 1),
(26, 13, 'aerocar-tn.jpg', '/phpmotors9/images/vehicles/aerocar-tn.jpg', '2020-02-05 20:34:27', 1),
(27, 14, 'van.jpg', '/phpmotors9/images/vehicles/van.jpg', '2020-02-05 20:34:41', 1),
(28, 14, 'van-tn.jpg', '/phpmotors9/images/vehicles/van-tn.jpg', '2020-02-05 20:34:41', 1),
(29, 15, 'no-image.png', '/phpmotors9/images/vehicles/no-image.png', '2020-02-05 20:35:00', 1),
(30, 15, 'no-image-tn.png', '/phpmotors9/images/vehicles/no-image-tn.png', '2020-02-05 20:35:00', 1),
(31, 16, 'delorean.jpg', '/phpmotors9/images/vehicles/delorean.jpg', '2020-02-05 20:35:13', 1),
(32, 16, 'delorean-tn.jpg', '/phpmotors9/images/vehicles/delorean-tn.jpg', '2020-02-05 20:35:13', 1),
(35, 1, 'wrangler-truck.jpg', '/phpmotors9/images/vehicles/wrangler-truck.jpg', '2020-02-05 21:17:41', 1),
(36, 1, 'wrangler-truck-tn.jpg', '/phpmotors9/images/vehicles/wrangler-truck-tn.jpg', '2020-02-05 21:17:41', 1),
(39, 17, 'model-t-truck.jpg', '/phpmotors9/images/vehicles/model-t-truck.jpg', '2020-02-06 18:49:29', 1),
(40, 17, 'model-t-truck-tn.jpg', '/phpmotors9/images/vehicles/model-t-truck-tn.jpg', '2020-02-06 18:49:29', 1),
(43, 17, 'model-t-truck-2.jpg', '/phpmotors9/images/vehicles/model-t-truck-2.jpg', '2020-02-12 01:31:51', 0),
(44, 17, 'model-t-truck-2-tn.jpg', '/phpmotors9/images/vehicles/model-t-truck-2-tn.jpg', '2020-02-12 01:31:51', 0),
(45, 14, 'survan.jpg', '/phpmotors9/images/vehicles/survan.jpg', '2020-02-14 00:11:14', 0),
(46, 14, 'survan-tn.jpg', '/phpmotors9/images/vehicles/survan-tn.jpg', '2020-02-14 00:11:14', 0),
(47, 10, 'camaro-2019.jpg', '/phpmotors9/images/vehicles/camaro-2019.jpg', '2020-02-14 01:18:09', 0),
(48, 10, 'camaro-2019-tn.jpg', '/phpmotors9/images/vehicles/camaro-2019-tn.jpg', '2020-02-14 01:18:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
