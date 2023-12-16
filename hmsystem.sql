-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 01:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmsystem`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `full_names`, `username`, `password`) VALUES
(8, 'Mutooro', 'Mr Babe', 'pklillian');

-- --------------------------------------------------------

--
-- Table structure for table `alert_message_tbl`
--

CREATE TABLE `alert_message_tbl` (
  `message_id` int(11) NOT NULL,
  `message_desc` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hostel_name`
--

INSERT INTO `hostel_name` (`hostel_id`, `name`, `description`, `call_number_1`, `call_number`) VALUES
(8, 'Olympia hotels', 'Its a self-contained mixed hostel located in Makerere Kikoni with both single and double rooms. ', '0707064552', '0765500498'),
(9, 'Akwata Mpola Hostel', 'mixed hostel located around Makerere Kikoni with self-contained single and double rooms', '0775417998', '0778014917'),
(10, 'Edith Hetty Hostel', 'Girls hostel located a few miles off Sir Apollo Kaggwa road - Makerere Kikoni', '0775417982', '0781131396'),
(11, 'Helican Hostel', 'Mixed hostel located in Kikumi Kikumi with self contained and non self contained single and double rooms ', '0763763106', '0774290052');

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `id` int(150) NOT NULL,
  `not_date` varchar(20) NOT NULL,
  `not_desc` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`id`, `not_date`, `not_desc`) VALUES
(16, '02-Dec-2023', 'Thank you dear user for trusting and choosing our system, The system will make it easy to apply for hostels that have better accomodation at a relatively low price.'),
(17, '03-Dec-2023', 'Hello users, as the semester is getting done, those who wish to continue using our system should make some book as early as possible');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hostel_name`, `seater`, `fee`, `cooking`, `room_image_1`, `space_availability`) VALUES
(18, 'Akwata Mpola Hostel', 2, 150, 'Allowed', '1701587753_olympia.jpeg', '2'),
(19, 'Akwata Mpola Hostel', 3, 750, 'NOT allowed', '1701587803_olympia.jpeg', '3');

-- --------------------------------------------------------

--
-- Table structure for table `student_add_tbl`
--

CREATE TABLE `student_add_tbl` (
  `student_reg_no` varchar(150) NOT NULL,
  `Year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_add_tbl`
--

INSERT INTO `student_add_tbl` (`student_reg_no`, `Year`) VALUES
('2000701195', '2000');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`f_name`, `l_name`, `gender`, `student_no`, `address`, `student_reg_no`, `course`, `emmercence_no`, `father_names`, `place`, `occupation`, `phone_1`, `phone_2`, `email`, `password`) VALUES
('nakaziba', 'Immy', 'F', '0707064552', 'Bwaise', '2000701195', 'Degree', '0765500498', 'Muto', 'Bwaise', 'IT', '0775417899', '0763763106', 'mutoorom@gmail.com', 'pass1234');

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
  MODIFY `admin_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel_name`
--
ALTER TABLE `hostel_name`
  MODIFY `hostel_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `receipts_tbl`
--
ALTER TABLE `receipts_tbl`
  MODIFY `receipt_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
