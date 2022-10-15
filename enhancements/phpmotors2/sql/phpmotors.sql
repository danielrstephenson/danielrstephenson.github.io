-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2020 at 05:02 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE images;
DROP TABLE inventory;
DROP TABLE carclassification;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(10) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--
# CREATE TABLE `clients` (
#   `clientId` int(10) UNSIGNED NOT NULL,
#   `clientFirstname` varchar(15) NOT NULL,
#   `clientLastname` varchar(25) NOT NULL,
#   `clientEmail` varchar(40) NOT NULL,
#   `clientPassword` varchar(255) NOT NULL,
#   `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
#   `comment` text DEFAULT NULL
# ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--
#
# INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
# (1, 'Tony', 'Stark', 'tony@stark.com', '$2y$10$GH5RdSyXYP23qJZrzD3y9.rltWAkNormG7Oy7ub4uDIIUpRz7T46O', '1', NULL),
# (2, 'Tiny', 'Tim', 'TinyTim@tulips.com', '$2y$10$dNLOpN6byr.LysCDeSWe0e.4oMxJ.fLGMRhOC4vgis26GgiLWFX3O', '1', NULL),
# (3, 'Sally', 'Jones', 'sally@jones.com', '$2y$10$7dwMhOouiyfVrw/aiMN8C.HGtQk1ztEj3gAaykDfFxblgDLmB/KN6', '1', NULL),
# (4, 'Admin', 'User', 'admin@cit336.net', '$2y$10$lyuqCGoanVy0muzQ4nCh1ehzZisRDvp6G.0CPoUutG0CxoaqPYUFW', '3', NULL),
# (10, 'David', 'King', 'kingdavid@israel.com', '$2y$10$4HCVtCJMoBdurPUy0K9LoujKtQdsW5o/.dxqqPKCzeHrb.WSwctGm', '1', NULL);

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
(1, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2020-02-05 20:31:11', 1),
(2, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2020-02-05 20:31:11', 1),
(3, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2020-02-05 20:31:56', 1),
(4, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2020-02-05 20:31:56', 1),
(5, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2020-02-05 20:32:11', 1),
(6, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2020-02-05 20:32:11', 1),
(7, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2020-02-05 20:32:26', 1),
(8, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2020-02-05 20:32:26', 1),
(9, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2020-02-05 20:32:39', 1),
(10, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2020-02-05 20:32:39', 1),
(11, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2020-02-05 20:32:57', 1),
(12, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2020-02-05 20:32:57', 1),
(13, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2020-02-05 20:33:13', 1),
(14, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2020-02-05 20:33:13', 1),
(15, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2020-02-05 20:33:23', 1),
(16, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2020-02-05 20:33:23', 1),
(17, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2020-02-05 20:33:36', 1),
(18, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2020-02-05 20:33:36', 1),
(19, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2020-02-05 20:33:52', 1),
(20, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2020-02-05 20:33:52', 1),
(21, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2020-02-05 20:34:03', 1),
(22, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2020-02-05 20:34:03', 1),
(23, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2020-02-05 20:34:14', 1),
(24, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2020-02-05 20:34:14', 1),
(25, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2020-02-05 20:34:27', 1),
(26, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2020-02-05 20:34:27', 1),
(27, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2020-02-05 20:34:41', 1),
(28, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2020-02-05 20:34:41', 1),
(29, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2020-02-05 20:35:00', 1),
(30, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2020-02-05 20:35:00', 1),
(31, 16, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2020-02-05 20:35:13', 1),
(32, 16, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2020-02-05 20:35:13', 1),
(35, 1, 'wrangler-truck.jpg', '/phpmotors/images/vehicles/wrangler-truck.jpg', '2020-02-05 21:17:41', 1),
(36, 1, 'wrangler-truck-tn.jpg', '/phpmotors/images/vehicles/wrangler-truck-tn.jpg', '2020-02-05 21:17:41', 1),
(39, 17, 'model-t-truck.jpg', '/phpmotors/images/vehicles/model-t-truck.jpg', '2020-02-06 18:49:29', 1),
(40, 17, 'model-t-truck-tn.jpg', '/phpmotors/images/vehicles/model-t-truck-tn.jpg', '2020-02-06 18:49:29', 1),
(43, 17, 'model-t-truck-2.jpg', '/phpmotors/images/vehicles/model-t-truck-2.jpg', '2020-02-12 01:31:51', 0),
(44, 17, 'model-t-truck-2-tn.jpg', '/phpmotors/images/vehicles/model-t-truck-2-tn.jpg', '2020-02-12 01:31:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(16, 'DMC', 'Delorean', 'Classic Back to the Future vehicle. The Flux Capacitor is an add-on for this model.', '/phpmotors/images/vehicles/delorean.jpg', '      /phpmotors/images/vehicles/delorean-tn.jpg', '45000', 1, 'Silver', 2),
(17, 'Ford', 'Model T Truck', 'This is a class truck. For those who are passionate about collecting pristine vehicles, this is the one.', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', '35000', 1, 'Forest Green', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
# ALTER TABLE `clients`
#   ADD PRIMARY KEY (`clientId`),
#   ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
# ALTER TABLE `clients`
#   MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
