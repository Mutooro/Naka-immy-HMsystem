-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql311.byetcluster.com
-- Generation Time: May 12, 2022 at 09:51 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_29222218_hms_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(150) NOT NULL,
  `full_names` varchar(500) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `full_names`, `username`, `password`) VALUES
(1, 'Sydney Kibanga', 'sydney2323', '12345'),
(6, 'adminTest-1', 'admin', 'admin12345'),
(7, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `alert_message_tbl`
--

CREATE TABLE `alert_message_tbl` (
  `message_id` int(11) NOT NULL,
  `message_desc` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(150) NOT NULL,
  `room_id` varchar(150) NOT NULL,
  `student_reg_no` varchar(200) NOT NULL,
  `fee` varchar(150) NOT NULL,
  `payment_status` text NOT NULL,
  `new_fee` varchar(150) NOT NULL,
  `days_number` varchar(15) NOT NULL,
  `start_date` varchar(35) NOT NULL,
  `end_date` varchar(35) NOT NULL,
  `payment_number` varchar(250) NOT NULL,
  `TransactionReference` varchar(250) NOT NULL,
  `TransactionID` varchar(250) NOT NULL,
  `ConversationID` varchar(300) NOT NULL,
  `ThirdPartyConversationID` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_name`
--

CREATE TABLE `hostel_name` (
  `hostel_id` int(150) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `call_number_1` varchar(15) NOT NULL,
  `call_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_name`
--

INSERT INTO `hostel_name` (`hostel_id`, `name`, `description`, `call_number_1`, `call_number`) VALUES
(2, 'Mbezi Rous Hostel', 'Mbezi Rous Hostel ni hostel bomba na zenye viwango vizuri kabisa karibu', '123456789 ', '123456789'),
(3, 'Home Alone Hostel', 'Home alone ni hostel bomba na zenye viwango vizuri kabisa karibu', '0123456789', '12345678'),
(5, 'Macheni Hostel', 'macheni ni hosteli zenye ubora na zinapatika kilomita chache tu kutoka chuo', '0123456789 ', '0123456789'),
(7, 'Magufuli Hostel', 'karibu temboni kwa huduma bora na nzuri wasiiana nasi', '123456789 ', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `id` int(150) NOT NULL,
  `not_date` varchar(20) NOT NULL,
  `not_desc` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`id`, `not_date`, `not_desc`) VALUES
(12, '21-Jul-2021', 'Thank you dear user for trusting and choosing our system, The system will make it easy to apply for hostels that have better accomodation at a relatively low price.'),
(15, '12-Aug-2021', 'Hellow dear user. Macheni Hostel is current full per now.. Please choose other hostels. By admin');

-- --------------------------------------------------------

--
-- Table structure for table `receipts_tbl`
--

CREATE TABLE `receipts_tbl` (
  `receipt_id` int(200) NOT NULL,
  `student_reg_no` varchar(150) NOT NULL,
  `amount_paid` varchar(150) NOT NULL,
  `receipt_number` varchar(150) NOT NULL,
  `receipt_match` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipts_tbl`
--

INSERT INTO `receipts_tbl` (`receipt_id`, `student_reg_no`, `amount_paid`, `receipt_number`, `receipt_match`) VALUES
(51, 'null', '2600', 'adc123', 'No'),
(53, 'null', 'ADC123', '235', 'No'),
(55, '19851001055', '6500', 'null123', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(150) NOT NULL,
  `hostel_name` varchar(500) NOT NULL,
  `seater` int(10) NOT NULL,
  `fee` int(10) NOT NULL,
  `cooking` text NOT NULL,
  `room_image_1` varchar(200) NOT NULL,
  `space_availability` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hostel_name`, `seater`, `fee`, `cooking`, `room_image_1`, `space_availability`) VALUES
(9, 'Magufuli Hostel', 3, 1900, 'Allowed', '1625394842_img-3.jpg', '2'),
(10, 'Mbezi Rous Hostel', 3, 2000, 'NOT allowed', '1625394462_img-1.jpg', '4'),
(11, 'Macheni Hostel', 1, 2150, 'Allowed', '1625394509_download (1).jpg', '0'),
(12, 'Magufuli Hostel', 6, 2500, 'Allowed', '1625394549_img-8.jpg', '3'),
(13, 'Macheni Hostel', 5, 1850, 'Allowed', '1626594746_img-2.jpg', '4'),
(14, 'Macheni Hostel', 3, 2320, 'Allowed', '1627733855_img-7.jpg', '4'),
(15, 'Mbezi Rous Hostel', 3, 2235, 'NOT allowed', '1627733901_img-5.jpg', '1'),
(16, 'Home Alone Hostel', 5, 1950, 'Allowed', '1627733973_img-6.jpg', '0'),
(17, 'Home Alone Hostel', 2, 1950, 'Allowed', '1628741924_img-4.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `student_add_tbl`
--

CREATE TABLE `student_add_tbl` (
  `student_reg_no` varchar(150) NOT NULL,
  `Year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_add_tbl`
--

INSERT INTO `student_add_tbl` (`student_reg_no`, `Year`) VALUES
('2021', '2021'),
('2022', '2'),
('543', '3345'),
('543678', '3345'),
('5678', '5678'),
('567856', 'fgh'),
('56rtgihkjl', 'tryuil');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `gender` text NOT NULL,
  `student_no` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `student_reg_no` varchar(100) NOT NULL,
  `course` varchar(200) NOT NULL,
  `emmercence_no` varchar(15) NOT NULL,
  `father_names` varchar(250) NOT NULL,
  `place` varchar(200) NOT NULL,
  `occupation` varchar(150) NOT NULL,
  `phone_1` varchar(15) NOT NULL,
  `phone_2` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`f_name`, `l_name`, `gender`, `student_no`, `address`, `student_reg_no`, `course`, `emmercence_no`, `father_names`, `place`, `occupation`, `phone_1`, `phone_2`, `email`, `password`) VALUES
('joseph', 'charles', 'M', '692173146', 'dar', '19851001055', 'Diploma', '0757839029', 'charles ishebabakaki', 'arusha', 'retired', '078945734', '0654789214', 'ishebakakjoseph@yahoo.com ', 'charzjose'),
('Andalwisye', 'Mwakyoma', 'M', '0654040579', 'dar es salaam', '20201015021', 'Diploma', '0621118821', 'Alfred', 'Mbeya', 'Business man', '0756536842', '0767001417', 'andalwisye1@gmail.com', 'Mwakyoma1'),
('test', 'user', 'M', '0744010005', 'dar es salaam', '2021', 'Diploma', '0789945433', 'juma john', 'kitunda dar es salaam', 'farmer', '0744010005', '0744010005', 'siddysidney@gmail.com', '12345'),
('Mwakasege', ' John', 'M', '1234567890', 'sydney@gmail.com', '2022', 'Diploma', '1234567890', 'John', 'Dar', 'farmer', '1234567890', '1234567890', 'sydneykb38@gmail.com', '12345'),
('jumna', 'jumaq', 'F', '1234567', 'kladjqehof', '2026', 'Diploma', '23456', 'dkjfvhew', 'LKDJF', 'lkjfja', '12345', '12345', 'juma@gmail.com', '12345'),
('steven', 'stanley', 'M', '754614990', 'malamba mawili', '20260017016', 'Diploma', '0673788286', 'Mary .A.Msangi', 'malamba mawili', 'business woman', '0657354900', '0629090640', 'stevenstanley48@gmail.com', '2000.Steven'),
('jumna', 'jumaq', 'M', '2345', 'dfght', '2027', 'Diploma', '23456', 'cdfg', 'dsdrt', 'eWART', '23456', '13245', 'juma@gmail.com', '234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `hostel_name`
--
ALTER TABLE `hostel_name`
  ADD PRIMARY KEY (`hostel_id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts_tbl`
--
ALTER TABLE `receipts_tbl`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `student_add_tbl`
--
ALTER TABLE `student_add_tbl`
  ADD PRIMARY KEY (`student_reg_no`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel_name`
--
ALTER TABLE `hostel_name`
  MODIFY `hostel_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `receipts_tbl`
--
ALTER TABLE `receipts_tbl`
  MODIFY `receipt_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
