-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2017 at 12:11 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_matrix`
--

CREATE TABLE `access_matrix` (
  `access_id` int(10) NOT NULL,
  `module` varchar(20) NOT NULL,
  `menu` varchar(20) NOT NULL,
  `sub_menu` varchar(20) NOT NULL,
  `action` varchar(10) NOT NULL,
  `requestor` int(1) NOT NULL,
  `requestor_and_approver` int(1) NOT NULL,
  `it` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_notif`
--

CREATE TABLE `email_notif` (
  `notif_id` int(10) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `request_status` varchar(10) NOT NULL,
  `template_status` varchar(10) NOT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_details`
--

CREATE TABLE `request_details` (
  `request_no` int(10) NOT NULL,
  `request_type_id` int(10) NOT NULL,
  `description` longtext NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_date` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `approved_date` datetime(6) DEFAULT NULL,
  `disapproved_date` datetime(6) DEFAULT NULL,
  `approved_by` int(10) NOT NULL,
  `assigned_to` int(10) NOT NULL,
  `resolved_date` datetime(6) DEFAULT NULL,
  `on_hold_date` datetime(6) DEFAULT NULL,
  `on_hold_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_type`
--

CREATE TABLE `request_type` (
  `request_type_id` int(10) NOT NULL,
  `type` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `subcategory` varchar(30) NOT NULL,
  `selection_status` varchar(10) NOT NULL,
  `created_date` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `created_by` int(10) NOT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_details`
--

CREATE TABLE `survey_details` (
  `survey_id` int(10) NOT NULL,
  `rate_description` varchar(10) NOT NULL,
  `selected` varchar(50) NOT NULL,
  `deselected` varchar(50) NOT NULL,
  `rate_status` varchar(10) NOT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `account_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `user_type_id` int(10) NOT NULL,
  `google_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`account_id`, `username`, `email`, `firstname`, `lastname`, `user_type_id`, `google_id`) VALUES
(9, 'ralph.vitto@solarphilippines.ph', 'ralph.vitto@solarphilippines.ph', 'Ralph', 'Vitto', 1, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_type_id` int(10) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `type`) VALUES
(1, 'requestor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_matrix`
--
ALTER TABLE `access_matrix`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `email_notif`
--
ALTER TABLE `email_notif`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `account_id_email` (`update_by`);

--
-- Indexes for table `request_details`
--
ALTER TABLE `request_details`
  ADD PRIMARY KEY (`request_no`),
  ADD KEY `request_type_id` (`request_type_id`);

--
-- Indexes for table `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`request_type_id`),
  ADD KEY `account_id` (`created_by`),
  ADD KEY `account_id2` (`update_by`);

--
-- Indexes for table `survey_details`
--
ALTER TABLE `survey_details`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `google_id` (`google_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_matrix`
--
ALTER TABLE `access_matrix`
  MODIFY `access_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_notif`
--
ALTER TABLE `email_notif`
  MODIFY `notif_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_details`
--
ALTER TABLE `request_details`
  MODIFY `request_no` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `request_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `survey_details`
--
ALTER TABLE `survey_details`
  MODIFY `survey_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_notif`
--
ALTER TABLE `email_notif`
  ADD CONSTRAINT `account_id_email` FOREIGN KEY (`update_by`) REFERENCES `users` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_details`
--
ALTER TABLE `request_details`
  ADD CONSTRAINT `request_type_id` FOREIGN KEY (`request_type_id`) REFERENCES `request_type` (`request_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_type`
--
ALTER TABLE `request_type`
  ADD CONSTRAINT `account_id` FOREIGN KEY (`created_by`) REFERENCES `users` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_id2` FOREIGN KEY (`update_by`) REFERENCES `users` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
