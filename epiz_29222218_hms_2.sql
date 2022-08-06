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
-- Database: `epiz_29222218_hms_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(150) NOT NULL,
  `full_names` varchar(500) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `m_password` varchar(200) NOT NULL
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
  `receipt_number` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_id`, `student_reg_no`, `fee`, `payment_status`, `receipt_number`) VALUES
(57, '13', '19851001055', '20000', 'Verified', '1234EQ'),
(58, '12', '19851001055', '35000', 'Verified', '456EQ');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_name`
--

CREATE TABLE `hostel_name` (
  `hostel_id` int(150) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `payment_number` varchar(50) NOT NULL,
  `call_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_name`
--

INSERT INTO `hostel_name` (`hostel_id`, `name`, `description`, `payment_number`, `call_number`) VALUES
(2, 'Mbezi Rous Hostel', 'Mbezi Rous Hostel ni hostel bomba na zenye viwango vizuri kabisa karibu', '123456789 TIGO', '123456789'),
(3, 'Home Alone Hostel', 'Home alone ni hostel bomba na zenye viwango vizuri kabisa karibu', '0123456789 VODACOM', '12345678'),
(5, 'Macheni Hostel', 'macheni ni hosteli zenye ubora na zinapatika kilomita chache tu kutoka chuo', '0123456789 AIRTEL', '0123456789'),
(7, 'Magufuli Hostel', 'karibu temboni kwa huduma bora na nzuri wasiiana nasi', '123456789 TIGO', '123456789');

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
(14, '21-Jul-2021', 'Hi There, next month we shall add more rooms in MAGUFULI HOSTEL.');

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
(35, '19851001055', '20000', '1234EQ', 'Yes'),
(36, '19851001055', '35000', '456EQ', 'Yes'),
(39, 'null', '2345', '123AD', 'No'),
(40, 'null', '2345', '123ADS', 'No');

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
(9, 'Magufuli Hostel', 3, 20000, 'Allowed', '1625394842_img-3.jpg', '3'),
(10, 'Mbezi Rous Hostel', 3, 20000, 'NOT allowed', '1625394462_img-1.jpg', '4'),
(11, 'Macheni Hostel', 1, 2000, 'Allowed', '1625394509_download (1).jpg', '2'),
(12, 'Magufuli Hostel', 6, 35000, 'Allowed', '1625394549_img-8.jpg', '3'),
(13, 'Macheni Hostel', 5, 20000, 'Allowed', '1626594746_img-2.jpg', '2');

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
('19851001055', '2021'),
('2026-1017-015', '2012'),
('2026-17-015', '2013');

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
('jumna', 'jumaq', 'F', '1234567', 'kladjqehof', '2026', 'Diploma', '23456', 'dkjfvhew', 'LKDJF', 'lkjfja', '12345', '12345', 'juma@gmail.com', '12345'),
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
  MODIFY `admin_id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `hostel_name`
--
ALTER TABLE `hostel_name`
  MODIFY `hostel_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `receipts_tbl`
--
ALTER TABLE `receipts_tbl`
  MODIFY `receipt_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
