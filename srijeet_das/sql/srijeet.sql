-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 204.11.58.166:3306
-- Generation Time: Sep 01, 2026 at 04:27 PM
-- Server version: 8.0.39
-- PHP Version: 8.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srijeet`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `aid` tinyint NOT NULL,
  `account` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `settings` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user` text COLLATE utf8mb4_general_ci NOT NULL,
  `account_status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`aid`, `account`, `description`, `settings`, `user`, `account_status`) VALUES
(1, 'ADMIN', '<p>Description</p>', 'All', 'Add,Edit,View,Download,List,List_all,Myaccount,Remove,Report', 'Active'),
(2, 'USER', '<p>Description</p>', '', 'Add,Edit,View,Download,List,Myaccount', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `setting_id` int NOT NULL,
  `setting_name` varchar(1000) NOT NULL,
  `setting_value` varchar(1000) DEFAULT 'true',
  `setting_group_name` varchar(100) NOT NULL DEFAULT 'General',
  `order_by` int NOT NULL,
  `setting_description` varchar(1000) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_value`, `setting_group_name`, `order_by`, `setting_description`, `status`) VALUES
(1, 'App_Name', 'SRIJEET', 'General', 1, '', 'Inactive'),
(2, 'App_Title', 'Practice Project', 'General', 1, '', 'Active'),
(3, 'Email_protocol', 'smtp', 'Email', 2, '', 'Active'),
(4, 'SMTP_mailtype', 'html', 'Email', 2, '', 'Active'),
(5, 'SMTP_hostname', 'SMTP_hostname', 'Email', 2, '', 'Inactive'),
(6, 'SMTP_username', 'SMTP_username', 'Email', 2, '', 'Inactive'),
(7, 'SMTP_password', 'SMTP_password', 'Email', 2, '', 'Inactive'),
(8, 'SMTP_port', '465', 'Email', 2, '', 'Inactive'),
(9, 'Language_direction', 'ltr', 'General', 1, '', 'Inactive'),
(10, 'Enable_google_chart', 'true', 'General', 1, '', 'Active'),
(11, 'Enable_dompdf', 'true', 'General', 1, '', 'Active'),
(12, 'Enable_user_registration', 'true', 'General', 1, '', 'Active'),
(13, 'Verify_user_email', 'true', 'Email', 2, '', 'Active'),
(14, 'secretid', '2198f0011288666d3694ccf4e7d16c29', 'General', 1, '', 'Inactive'),
(15, 'Activation_email_subject', 'Action required to verify your account', 'Template', 2, '', 'Active'),
(16, 'Activation_email_message', 'Hi, \\r\\n Thank you for registering with us. Please click below link to verify your email address.\\r\\n <a href=\'[verilink]\'>[verilink]</a> \\r\\n or \\r\\n Copy below link and visit in browser \\r\\n [verilink] \\r\\n \\r\\n Thanks', 'Template', 2, '', 'Active'),
(17, 'Password_change_subject', 'Reset Password', 'Template', 1, '', 'Active'),
(18, 'Password_change_message', 'Hi [name], \\r\\n Your password reset link is: [resetlink] \\r\\n Or <a href=[resetlink]>Click Here</a><br><br>Thanks.<br><br>CCI India Digital Survey', 'Template', 1, '', 'Active'),
(19, 'secretkey', 'f7115915ae4efc1bdab7ae9fc686348848f8cc2e7bf4a9', 'General', 1, '', 'Inactive'),
(26, 'No_reply_email', 'no_reply@technobrains.net.in', 'Email', 1, '', 'Active'),
(29, 'Tinymce_editor', 'true', 'Editor', 3, '', 'Active'),
(32, 'Verify_user_email', 'true', 'Email', 2, '', 'Active'),
(33, 'Enable_user_registration', 'true', 'General', 1, '', 'Inactive'),
(34, 'Master_password', 'techno', 'General', 1, '', 'Active'),
(35, 'Default_account_id', '2', 'General', 1, '', 'Active'),
(36, 'SMTP_crypto', 'ssl', 'Email', 1, '', 'Active'),
(37, 'Admin_email', 'admin@technobrains.net.in', 'Email', 1, '', 'Active'),
(38, 'Admin_name', 'SRIJEET', 'Email', 1, '', 'Active'),
(42, 'Logout_timer', '120', 'General', 1, 'Time to automatically logout for inactivity (in minutes)', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `su` tinyint NOT NULL DEFAULT '0',
  `inserted_by` tinyint NOT NULL DEFAULT '0',
  `registered_date` varchar(20) NOT NULL,
  `verify_code` tinyint NOT NULL,
  `validation_date` varchar(20) NOT NULL,
  `user_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `address`, `email`, `gender`, `mobile`, `password`, `picture`, `su`, `inserted_by`, `registered_date`, `verify_code`, `validation_date`, `user_status`) VALUES
(1, 'ADMIN', 'GAYESHPUR', 'das.sajal1024@gmail.com', 'Male', '9123778722', 'ufYvgy69kyiHCpE0/N/XJA==', '6a96d60fed0e4.jpeg', 1, 1, '1788201000', 0, '1788201000', 'Active'),
(2, 'SAJAL KR DAS', 'ALIPURDUAR', 'user@example.com', 'Male', '9830895640', 'ufYvgy69kyiHCpE0/N/XJA==', '6a96d74bda372.jpeg', 1, 1, '1788201000', 0, '1788201000', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `aid` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
