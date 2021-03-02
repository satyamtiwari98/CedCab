-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2021 at 10:57 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(10) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `distance` varchar(30) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', '0', 1),
(2, 'Indira_Nagar', '10', 1),
(3, 'BBD', '30', 1),
(4, 'Barabanki', '60', 1),
(5, 'Faizabad', '100', 1),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1),
(13, 'Gomti_Nagar', '145', 0),
(14, 'Sudhanshu', '6789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(10) NOT NULL,
  `ride_date` date DEFAULT NULL,
  `from` varchar(30) DEFAULT NULL,
  `to` varchar(30) DEFAULT NULL,
  `cab_type` varchar(40) NOT NULL,
  `total_distance` varchar(30) DEFAULT NULL,
  `luggage` varchar(30) DEFAULT NULL,
  `total_fare` bigint(30) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `customer_user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `from`, `to`, `cab_type`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(1, '2021-02-20', 'charbagh', 'BBD', 'cedmini', '120', '20', 4000, 2, 2),
(2, '2021-02-23', 'Charbagh', 'Gorakhpur', 'cedmini', '2230', '34', 210, 2, 2),
(3, '2021-02-23', 'Charbagh', 'Gorakhpur', 'CedSUV', '3460', '88', 210, 2, 2),
(4, '2021-02-23', 'Charbagh', 'Gorakhpur', 'CedSUV', '3460', '88', 210, 0, 2),
(5, '2021-02-24', 'Charbagh', 'Basti', 'CedSUV', '2470', '10', 150, 0, 2),
(6, '2021-02-24', 'Charbagh', 'Faizabad', 'CedMini', '1593', '88', 100, 0, 2),
(7, '2021-02-24', 'Charbagh', 'Barabanki', 'CedMicro', '785', '0', 60, 2, 2),
(8, '2021-02-24', 'Basti', 'Barabanki', 'CedMicro', '1091', '0', 90, 0, 2),
(9, '2021-02-24', 'Gorakhpur', 'Charbagh', 'CedMicro', '2230', '0', 210, 2, 2),
(10, '2021-02-24', 'Charbagh', 'Faizabad', 'CedMicro', '1193', '0', 100, 0, 2),
(11, '2021-02-24', 'Charbagh', 'Barabanki', 'CedMini', '995', '9', 60, 0, 3),
(12, '2021-02-25', 'Charbagh', 'Indira_Nagar', 'CedSUV', '815', '50', 10, 2, 2),
(13, '2021-02-25', 'BBD', 'Basti', 'CedMini', '1885', '88', 120, 0, 2),
(14, '2021-02-25', 'Charbagh', 'Faizabad', 'CedMini', '1443', '7', 100, 0, 2),
(15, '2021-02-25', 'Charbagh', 'Gorakhpur', 'CedSUV', '3460', '67', 210, 0, 27),
(16, '2021-02-25', 'charbagh', 'BBD', 'CedSUV', '5009', '67', 6543, 2, 27),
(17, '2021-02-25', 'Gorakhpur', 'Faizabad', 'CedMicro', '1380', '0', 110, 0, 2),
(18, '2021-02-25', 'Indira_Nagar', 'Barabanki', 'CedMini', '865', '10', 50, 0, 2),
(19, '2021-02-25', 'Charbagh', 'Basti', 'CedMini', '2020', '10', 150, 0, 2),
(20, '2021-02-25', 'Charbagh', 'Faizabad', 'CedMicro', '1193', '0', 100, 0, 2),
(21, '2021-02-25', 'Charbagh', 'Faizabad', 'CedMini', '1443', '10', 100, 0, 2),
(22, '2021-02-25', 'Charbagh', 'Basti', 'CedMicro', '150', '0', 1720, 0, 2),
(23, '2021-02-26', 'Charbagh', 'Basti', 'CedRoyal', '150', '34', 2370, 0, 2),
(24, '2021-02-26', 'Charbagh', 'Gorakhpur', 'CedRoyal', '210', '10', 2850, 0, 2),
(25, '2021-02-26', 'Charbagh', 'Faizabad', 'CedMicro', '100', '0', 1193, 0, 2),
(26, '2021-02-26', 'Charbagh', 'Gorakhpur', 'CedSUV', '210', '8678', 3460, 1, 2),
(27, '2021-02-26', 'Charbagh', 'Gorakhpur', 'CedMicro', '210', '0', 2230, 2, 2),
(28, '2021-02-26', 'Faizabad', 'BBD', 'CedSUV', '70', '7879', 1697, 1, 27),
(29, '2021-02-26', 'Charbagh', 'Barabanki', 'CedMini', '60', '7', 995, 1, 2),
(30, '2021-02-26', 'BBD', 'Barabanki', 'CedRoyal', '30', '89798', 835, 1, 2),
(31, '2021-02-26', 'Basti', 'BBD', 'CedMini', '120', '10', 1735, 0, 27),
(32, '2021-02-26', 'Indira_Nagar', 'Basti', 'CedMini', '140', '89798', 2075, 1, 27),
(33, '2021-02-26', 'BBD', 'Barabanki', 'CedMini', '30', '7', 605, 1, 27),
(34, '2021-02-27', 'Charbagh', 'Gomti_Nagar', 'CedRoyal', '300', '88', 3945, 1, 27),
(35, '2021-02-27', 'Charbagh', 'Barabanki', 'CedMini', '60', '45', 1145, 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) NOT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `dateofsignup` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email_id`, `name`, `dateofsignup`, `mobile`, `status`, `password`, `is_admin`, `img`) VALUES
(1, 'admin@gmail.com', 'admin', '2021-02-20', '999999', 1, 'Password123$', 1, 'shreeRam.jpg'),
(2, 'satyamtiwari1598@gmail.com', 'Satyam Tiwari', '2021-02-20', '99999', 1, 'password', 0, 'modi.jpg'),
(3, 'satyam@gmail.com', 'Satyam Tiwari', '2021-02-20', '9984695465', 1, '12345', 0, 'shreeRam.jpg'),
(4, 'wahid@gmail.com', 'Satyam Tiwari', '2021-02-22', '1233378478', 1, 'jshajdh', 0, 'shreeRam.jpg'),
(5, 'satyamtiwari@gmail.com', 'Satyam Tiwari', '2021-02-22', '9876543210', 1, '67543', 0, 'shreeRam.jpg'),
(6, 'satya598@gl.com', 'Sudhanshu', '2021-02-22', '635328', 0, 'hjdhkj', 0, 'shreeRam.jpg'),
(7, 'wsa@gmail.com', 'wahid', '2021-02-22', '9984695445', 0, 'jnasdjf', 0, 'shreeRam.jpg'),
(8, 'satyamtiwari15@gmail.com', 'Satyam Tiwari', '2021-02-22', '', 0, '', 0, 'shreeRam.jpg'),
(10, 'satyamtiwari598@gmail.com', 'Satyam Tiwari', '2021-02-22', '99846954', 1, '677', 0, 'shreeRam.jpg'),
(11, 'faheemn4865@gmail.com', 'Sudhanshu', '2021-02-22', '9695465', 0, '687jk', 0, 'shreeRam.jpg'),
(12, 'wahid123@gmail.com', 'wahid', '2021-02-22', '6768', 1, '787ihj', 0, NULL),
(13, 'honey@gmail.com', 'Honey Singh', '2021-02-22', '21329479', 1, 'hkdsjfk', 0, 'shreeRam.jpg'),
(14, 'shg@gmail.com', 'shgd', '2021-02-22', '2243253', 1, 'hj34', 0, 'shreeRam.jpg'),
(15, 'satyam3883@gmail.com', 'Satyam Tiwari', '2021-02-22', '7879', 1, 'jbjbjn', 0, 'shreeRam.jp'),
(16, 'satyamtiwari159@gmail.com', 'Satyam Tiwari', '2021-02-22', '989809', 1, 'uij', 0, 'shreeRam.jpg'),
(20, 'wahidhusain33@gmail.com', 'Satyam Tiwari', '2021-02-22', '990098', 1, 'kjk', 0, 'shreeRam.jpg'),
(21, 'email@gmail.com', 'Sudhanshu', '2021-02-22', '345222', 1, '8348', 0, 'shreeRam.jpg'),
(22, 'shudhanshu@gmail.com', 'Sudhanshu agarwal', '2021-02-23', '98439943', 1, '899898', 0, 'shreeRam.jpg'),
(23, 'faheemkhan4865@gmail.com', 'Satyam Tiwari', '2021-02-23', '798989', 1, 'gjhg', 0, 'shreeRam.jpg'),
(24, 'shreeram@gmail.com', 'ShreeRam', '2021-02-25', '1234567890', 1, 'password', 0, 'shreeRam.jpg'),
(25, 'sunny@gmail.com', 'sunny', '2021-02-25', '3497593', 0, 'jshdjh', 0, 'shreeRam.jpg'),
(26, 'rahulgandhi@gmail.com', 'Rahul Gandhi', '2021-02-25', '8878675757', 1, 'dhfjksn', 0, 'rahul.png'),
(27, 'narendramodi@gmail.com', 'Narendra modi', '2021-02-25', '99895465', 1, '12345', 0, 'modi.jpg'),
(28, 'arjitsingh@gmail.com', 'Arjit Singh', '2021-02-27', '467328', 0, '12345', 0, 'pic02.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `customer_user_id` (`customer_user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD CONSTRAINT `tbl_ride_ibfk_1` FOREIGN KEY (`customer_user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
