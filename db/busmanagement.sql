-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 07:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `journey_id` int(11) NOT NULL,
  `ticket_amount` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `customer_id`, `journey_id`, `ticket_amount`, `status`) VALUES
(44, 41, 2, 3, 'Paid'),
(57, 45, 6, 1, 'Unpaid'),
(59, 46, 13, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(255) NOT NULL,
  `bus_plate_number` varchar(255) NOT NULL,
  `bus_make` varchar(255) NOT NULL,
  `bus_model` varchar(255) NOT NULL,
  `driver_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_plate_number`, `bus_make`, `bus_model`, `driver_id`, `status`) VALUES
(9, 'RAE 333 X', 'Toyoto', 'Coaster', 3, 'Operational'),
(10, 'RAD 888 B', 'Yutong', 'Yutong', 3, 'Operational'),
(11, 'RAD 777 C', 'Hiace', 'Minibus', 2, 'Operational'),
(12, 'RAB 650 P', 'Toyota', 'Coaster', 2, 'Operational'),
(13, 'iii', 'jdj', 'ksks', 4, 'Operational'),
(14, 'rae 800 x', 'hyundai', 'hilux', 4, 'Operational');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `card_id` int(50) NOT NULL,
  `card_number` int(50) NOT NULL,
  `card_amount` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`card_id`, `card_number`, `card_amount`) VALUES
(1, 1990, 1500),
(2, 1991, 940);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `dob` date NOT NULL,
  `country` varchar(100) NOT NULL,
  `gender` varchar(19) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nid` bigint(16) NOT NULL,
  `credit_card` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `dob`, `country`, `gender`, `phone`, `email`, `password`, `nid`, `credit_card`) VALUES
(39, 'IKKIREZI', 'Jean', '1997-01-01', 'Rwanda', 'Male', 789887766, 'peace@gmail.com', 'badddd', 1990887, NULL),
(41, 'Amazing ', 'Man', '1998-11-04', 'Uganda', 'Male', 788407847, 'amazing@gmail.com', 'password', 1199880035678123, NULL),
(42, 'Joselyne', 'UWABAHIRE', '1998-05-01', 'Rwanda', 'Female', 788778877, 'jose@gmail.com', 'password', 0, NULL),
(43, 'Joel', 'HIGILO', '1998-09-01', 'DRC', 'Male', 788635273, 'joelhigilo@gmail.com', 'passpass', 0, NULL),
(44, 'ntakabumwe ', 'regis', '1998-03-13', 'rwanda', 'Male', 783456127, 'ntakaregis@gmail.com', 'regis', 12343465656756, NULL),
(45, 'irambona', 'mark', '1998-07-21', 'rwanda', 'Male', 785678123, 'kiki@gmail.com', 'kiki', 123456789045678, NULL),
(46, 'ishi', 'ma', '2023-03-21', 'rwanda', 'Male', 785678123, 'admin@gmail.com', '123', 112222090903909093, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salary` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `fname`, `lname`, `dob`, `gender`, `tel`, `email`, `salary`) VALUES
(2, 'Emmanuel', 'IRABONA', '1998-12-01', 'Male', '0789189791', 'irumva@gmail.com', 50000),
(3, 'Joselyne', 'UWABAHIRE', '1997-04-04', 'Female', '0788764488', 'jose@gmail.com', 100000),
(4, 'Richard', 'MUGABO', '1970-01-01', 'Male', '0734455667', 'richard@gmail.com', 45000);

-- --------------------------------------------------------

--
-- Table structure for table `journey`
--

CREATE TABLE `journey` (
  `journey_id` int(255) NOT NULL,
  `journey_origin` varchar(255) NOT NULL,
  `journey_destination` varchar(255) NOT NULL,
  `bus_id` int(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `tickets` int(255) NOT NULL,
  `journey_date` date NOT NULL,
  `journey_start_time` time NOT NULL,
  `route_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journey`
--

INSERT INTO `journey` (`journey_id`, `journey_origin`, `journey_destination`, `bus_id`, `route`, `price`, `tickets`, `journey_date`, `journey_start_time`, `route_id`) VALUES
(7, 'Kigali', 'musanze', 0, '', 1900, 0, '2023-03-17', '15:00:00', 0),
(8, 'muhanga', 'rusizi', 0, '', 9098, 0, '2023-03-21', '02:00:00', 0),
(9, 'rubavu', 'rusizi', 13, '', 1100, 0, '2023-03-23', '16:17:00', 0),
(10, 'jjkjk', 'jkk', 0, '', 10000, 0, '2023-03-21', '16:27:00', 0),
(11, 'hjhk', 'ioi', 0, '', 222, 0, '2023-03-21', '18:35:00', 0),
(12, 'iiii', 'ioi', 0, '', 999, 0, '2023-03-21', '17:34:00', 0),
(13, 'rubavu', 'jkljkl', 10, '', 900, 8, '2023-03-22', '20:48:00', 0),
(14, '', '', 13, '', 0, 88, '2023-03-21', '22:27:00', 0),
(15, '', '', 13, '', 0, 7, '2023-03-22', '21:28:00', 0),
(16, '', '', 11, '', 0, 8979, '2023-03-28', '22:34:00', 0),
(17, '', '', 12, '', 0, 18, '2023-03-21', '22:35:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paid_services`
--

CREATE TABLE `paid_services` (
  `pid` int(11) NOT NULL,
  `journey_id` int(11) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `paid_dates` varchar(20) NOT NULL,
  `pais_phone` varchar(20) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transID` varchar(255) NOT NULL,
  `transaction_momo` varchar(255) NOT NULL,
  `trans_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payee`
--

CREATE TABLE `payee` (
  `id` int(11) NOT NULL,
  `transactionId` varchar(200) NOT NULL,
  `usedPhone` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payee`
--

INSERT INTO `payee` (`id`, `transactionId`, `usedPhone`, `amount`, `status`) VALUES
(1, '8c5b1b80cbdf11ed8d4a97599ea65359', '250781352115', '900', 'valid'),
(2, '5a0ba9a0cbe011ed8d4a97599ea65359', '250781352115', '900', 'pending'),
(5, '67ee9c30cbea11ed8d4a97599ea65359', '250781352115', '900', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(255) NOT NULL,
  `journey_origin` varchar(255) NOT NULL,
  `journey_destination` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `journey_origin`, `journey_destination`, `price`) VALUES
(0, 'kigali', 'musanze', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(76) NOT NULL,
  `lname` varchar(245) NOT NULL,
  `user_role` varchar(80) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salary` int(100) NOT NULL,
  `password` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `user_role`, `phone`, `email`, `salary`, `password`) VALUES
(1, 'Fred', 'fred', 'Admin', '07888992', 'fred@gmail.com', 400000, 'fred1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD UNIQUE KEY `bus_plate_number` (`bus_plate_number`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `journey`
--
ALTER TABLE `journey`
  ADD PRIMARY KEY (`journey_id`);

--
-- Indexes for table `paid_services`
--
ALTER TABLE `paid_services`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `payee`
--
ALTER TABLE `payee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `card_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `journey`
--
ALTER TABLE `journey`
  MODIFY `journey_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `paid_services`
--
ALTER TABLE `paid_services`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payee`
--
ALTER TABLE `payee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
