-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2022 at 11:54 AM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitstrin_profiles_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_log`
--

CREATE TABLE `action_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `action_type` enum('created','updated','deleted') CHARACTER SET utf8 NOT NULL,
  `model` enum('login','user','category','product','kyc-approval','profile-plan','order','faq') CHARACTER SET utf8 NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL,
  `chaged_data` longtext CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_log`
--

INSERT INTO `action_log` (`id`, `user_id`, `action_type`, `model`, `record_id`, `chaged_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 'created', 'login', 10, '{\"login\":\"2021-11-24 12:57:36\"}', '2021-11-24 12:57:36', '2021-11-24 12:57:36', NULL),
(2, 10, 'created', 'login', 10, '{\"login\":\"2021-11-30 14:03:39\"}', '2021-11-30 14:03:39', '2021-11-30 14:03:39', NULL),
(3, 10, 'created', 'login', 10, '{\"login\":\"2021-11-30 14:11:37\"}', '2021-11-30 14:11:37', '2021-11-30 14:11:37', NULL),
(4, 9, 'created', 'login', 9, '{\"login\":\"2021-12-02 10:33:39\"}', '2021-12-02 10:33:39', '2021-12-02 10:33:39', NULL),
(5, 9, 'created', 'login', 9, '{\"login\":\"2021-12-02 14:29:04\"}', '2021-12-02 14:29:04', '2021-12-02 14:29:04', NULL),
(6, 9, 'created', 'login', 9, '{\"login\":\"2021-12-02 14:31:38\"}', '2021-12-02 14:31:38', '2021-12-02 14:31:38', NULL),
(7, 10, 'created', 'login', 10, '{\"login\":\"2021-12-03 19:06:39\"}', '2021-12-03 19:06:39', '2021-12-03 19:06:39', NULL),
(8, 10, 'created', 'login', 10, '{\"login\":\"2021-12-06 10:21:52\"}', '2021-12-06 10:21:52', '2021-12-06 10:21:52', NULL),
(9, 10, 'created', 'login', 10, '{\"login\":\"2021-12-06 11:19:29\"}', '2021-12-06 11:19:29', '2021-12-06 11:19:29', NULL),
(10, 10, 'created', 'login', 10, '{\"login\":\"2021-12-06 11:26:04\"}', '2021-12-06 11:26:04', '2021-12-06 11:26:04', NULL),
(11, 10, 'updated', 'user', 10, '{\"message\":\"change password\"}', '2021-12-06 11:26:54', '2021-12-06 11:26:54', NULL),
(12, 9, 'created', 'login', 9, '{\"login\":\"2021-12-06 12:20:18\"}', '2021-12-06 12:20:18', '2021-12-06 12:20:18', NULL),
(13, 9, 'created', 'login', 9, '{\"login\":\"2021-12-10 17:13:10\"}', '2021-12-10 17:13:10', '2021-12-10 17:13:10', NULL),
(14, 10, 'created', 'login', 10, '{\"login\":\"2021-12-13 11:38:29\"}', '2021-12-13 11:38:29', '2021-12-13 11:38:29', NULL),
(15, 9, 'created', 'login', 9, '{\"login\":\"2021-12-13 16:34:43\"}', '2021-12-13 16:34:43', '2021-12-13 16:34:43', NULL),
(16, 11, 'created', 'login', 11, '{\"login\":\"2021-12-13 16:36:13\"}', '2021-12-13 16:36:13', '2021-12-13 16:36:13', NULL),
(17, 11, 'created', 'login', 11, '{\"login\":\"2021-12-13 16:38:52\"}', '2021-12-13 16:38:52', '2021-12-13 16:38:52', NULL),
(18, 9, 'created', 'login', 9, '{\"login\":\"2021-12-13 18:07:28\"}', '2021-12-13 18:07:28', '2021-12-13 18:07:28', NULL),
(19, 9, 'created', 'login', 9, '{\"login\":\"2022-01-05 23:43:47\"}', '2022-01-05 23:43:47', '2022-01-05 23:43:47', NULL),
(20, 9, 'created', 'login', 9, '{\"login\":\"2022-01-06 10:01:59\"}', '2022-01-06 10:01:59', '2022-01-06 10:01:59', NULL),
(21, 9, 'created', 'login', 9, '{\"login\":\"2022-01-06 10:19:36\"}', '2022-01-06 10:19:36', '2022-01-06 10:19:36', NULL),
(22, 10, 'created', 'login', 10, '{\"login\":\"2022-01-06 10:20:07\"}', '2022-01-06 10:20:07', '2022-01-06 10:20:07', NULL),
(23, 10, 'created', 'login', 10, '{\"login\":\"2022-01-06 10:24:41\"}', '2022-01-06 10:24:41', '2022-01-06 10:24:41', NULL),
(24, 10, 'created', 'login', 10, '{\"login\":\"2022-01-06 10:35:10\"}', '2022-01-06 10:35:10', '2022-01-06 10:35:10', NULL),
(25, 11, 'created', 'login', 11, '{\"login\":\"2022-01-06 17:25:51\"}', '2022-01-06 17:25:51', '2022-01-06 17:25:51', NULL),
(26, 9, 'created', 'login', 9, '{\"login\":\"2022-01-07 11:47:30\"}', '2022-01-07 11:47:30', '2022-01-07 11:47:30', NULL),
(27, 10, 'updated', 'user', 10, '{\"message\":\"change password\"}', '2022-01-10 09:47:37', '2022-01-10 09:47:37', NULL),
(28, 9, 'created', 'login', 9, '{\"login\":\"2022-01-10 13:43:21\"}', '2022-01-10 13:43:21', '2022-01-10 13:43:21', NULL),
(29, 9, 'created', 'login', 9, '{\"login\":\"2022-01-10 14:09:12\"}', '2022-01-10 14:09:12', '2022-01-10 14:09:12', NULL),
(30, 9, 'created', 'login', 9, '{\"login\":\"2022-01-10 15:56:52\"}', '2022-01-10 15:56:52', '2022-01-10 15:56:52', NULL),
(31, 9, 'created', 'login', 9, '{\"login\":\"2022-01-12 10:29:08\"}', '2022-01-12 10:29:08', '2022-01-12 10:29:08', NULL),
(32, 10, 'created', 'login', 10, '{\"login\":\"2022-01-13 14:00:47\"}', '2022-01-13 14:00:47', '2022-01-13 14:00:47', NULL),
(33, 9, 'created', 'login', 9, '{\"login\":\"2022-01-13 14:36:07\"}', '2022-01-13 14:36:07', '2022-01-13 14:36:07', NULL),
(34, 9, 'created', 'login', 9, '{\"login\":\"2022-01-18 16:16:14\"}', '2022-01-18 16:16:14', '2022-01-18 16:16:14', NULL),
(35, 9, 'created', 'login', 9, '{\"login\":\"2022-02-02 14:36:57\"}', '2022-02-02 14:36:57', '2022-02-02 14:36:57', NULL),
(36, 9, '', 'user', 10, '{\"id\":\"10\",\"fname\":\"Chinchulata\",\"lname\":\"Nair\",\"email\":\"hr@bitstringit.com\",\"mobile\":\"8999206632\",\"password\":\"$2y$10$Wk\\/NutxxSNOWTavghvIl3eviAbMCHtF5I7fwR4QuEII2FZXrdupUa\",\"status\":\"1\",\"selected_role\":[{\"id\":\"3\",\"role_name\":\"hr\",\"display_name\":\"HR\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:36\",\"updated_at\":\"2021-06-02 11:59:36\",\"deleted_at\":null}],\"changePassword\":true}', '2022-02-02 14:38:56', '2022-02-02 14:38:56', NULL),
(37, 10, 'created', 'login', 10, '{\"login\":\"2022-02-02 14:39:39\"}', '2022-02-02 14:39:39', '2022-02-02 14:39:39', NULL),
(38, 10, 'created', 'login', 10, '{\"login\":\"2022-02-02 14:42:11\"}', '2022-02-02 14:42:11', '2022-02-02 14:42:11', NULL),
(39, 9, 'created', 'login', 9, '{\"login\":\"2022-02-02 14:51:10\"}', '2022-02-02 14:51:10', '2022-02-02 14:51:10', NULL),
(40, 9, 'created', 'login', 9, '{\"login\":\"2022-02-03 09:57:40\"}', '2022-02-03 09:57:40', '2022-02-03 09:57:40', NULL),
(41, 9, 'created', 'login', 9, '{\"login\":\"2022-02-03 19:02:32\"}', '2022-02-03 19:02:32', '2022-02-03 19:02:32', NULL),
(42, 9, '', 'user', 12, '{\"id\":\"12\",\"fname\":\"Kavita\",\"lname\":\"Admin\",\"email\":\"admin@bitstringit.com\",\"mobile\":\"9370139243\",\"password\":\"$2y$10$hZ93HX52IFk4g0pqDq5XoOUvQBfBZANBawXt8Kw0d72tyHuygU.cC\",\"status\":\"1\",\"selected_role\":[{\"id\":\"7\",\"role_name\":\"accountant\",\"display_name\":\"Accountant\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}],\"changePassword\":true}', '2022-02-03 19:05:32', '2022-02-03 19:05:32', NULL),
(43, 12, 'created', 'login', 12, '{\"login\":\"2022-02-03 19:06:12\"}', '2022-02-03 19:06:12', '2022-02-03 19:06:12', NULL),
(44, 12, 'created', 'login', 12, '{\"login\":\"2022-02-04 12:00:29\"}', '2022-02-04 12:00:29', '2022-02-04 12:00:29', NULL),
(45, 9, 'created', 'login', 9, '{\"login\":\"2022-02-08 11:07:48\"}', '2022-02-08 11:07:48', '2022-02-08 11:07:48', NULL),
(46, 9, 'created', 'login', 9, '{\"login\":\"2022-02-08 18:58:17\"}', '2022-02-08 18:58:17', '2022-02-08 18:58:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

CREATE TABLE `capabilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `capability` varchar(50) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`id`, `capability`, `module`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'user/add', 'user', '2021-12-01 11:24:48', NULL, NULL),
(4, 'user/edit', 'user', '2021-12-01 11:24:48', NULL, NULL),
(5, 'user/delete', 'user', '2021-12-01 11:24:48', NULL, NULL),
(6, 'user/report', 'user', '2021-12-01 11:24:48', NULL, NULL),
(7, 'profiles/add', 'profiles', '2021-12-01 11:24:48', NULL, NULL),
(8, 'profiles/edit', 'profiles', '2021-12-01 11:24:48', NULL, NULL),
(9, 'profiles/delete', 'profiles', '2021-12-01 11:24:48', NULL, NULL),
(10, 'profiles/report', 'profiles', '2021-12-01 11:24:48', NULL, NULL),
(11, 'joining_form/add', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(12, 'joining_form/edit', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(13, 'joining_form/delete', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(14, 'joining_form/report', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(15, 'user/view', 'user', '2021-12-01 11:24:48', NULL, NULL),
(16, 'profiles/view', 'profiles', '2021-12-01 11:24:48', NULL, NULL),
(17, 'joining_form/view', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(18, 'roles/view', 'roles', '2021-12-01 11:24:48', NULL, NULL),
(19, 'roles/add', 'roles', '2021-12-01 11:24:48', NULL, NULL),
(20, 'roles/edit', 'roles', '2021-12-01 11:24:48', NULL, NULL),
(21, 'roles/delete', 'roles', '2021-12-01 11:24:48', NULL, NULL),
(22, 'roles/report', 'roles', '2021-12-01 11:24:48', NULL, NULL),
(23, 'joining_form/update_personal_details', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(24, 'joining_form/update_bank_details', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(25, 'joining_form/update_education_details', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(26, 'joining_form/update_employment', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(27, 'joining_form/update_background_info', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(28, 'joining_form/update_mediclaim_details', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(29, 'joining_form/update_documents', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(30, 'joining_form/approve', 'joining_form', '2021-12-01 11:24:48', NULL, NULL),
(31, 'joining_form/update_approved', 'joining_form', '2021-12-01 11:24:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `certification` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `logo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HSBC', 'assets/clients/1644326230_d01078111df7847bbfa9.png', 1, '2022-02-08 18:44:48', '2022-02-08 18:47:10', NULL),
(2, 'Infosys', NULL, 1, '2022-02-08 18:45:02', '2022-02-08 18:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_contacts`
--

CREATE TABLE `client_contacts` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department` varchar(225) DEFAULT NULL,
  `additional_info` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `educational_qualification`
--

CREATE TABLE `educational_qualification` (
  `id` int(11) NOT NULL,
  `joining_form_id` int(11) NOT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `from_date` varchar(20) DEFAULT NULL,
  `to_date` varchar(20) DEFAULT NULL,
  `course_type` varchar(50) DEFAULT NULL,
  `percentage` varchar(5) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educational_qualification`
--

INSERT INTO `educational_qualification` (`id`, `joining_form_id`, `degree`, `university`, `institution`, `from_date`, `to_date`, `course_type`, `percentage`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'M.Sc. Computer Science', 'Dr Babasaheb Ambedkar Marathwada University', 'Dr Babasaheb Ambedkar Marathwada University, Aurangabad, Maharashtra, India', 'Jul 1992', 'Jun 1994', 'Full Time', '74', 'form_2/1637740359_2455ddd855a4fbb9e55a.pdf', '2021-11-24 13:22:39', '2021-12-13 17:15:31', NULL),
(2, 2, 'B.Sc. Electronics', 'Nagpur University', 'Nagpur University, Nagpur, Maharashtra, India', 'Jul 1989', 'May 1992', 'Full Time', '57', 'form_2/1637740482_49247e4650f216604455.png', '2021-11-24 13:24:42', '2021-12-13 17:16:00', NULL),
(5, 6, 'B.com (computers)', 'Acharya Nagarjuna University', 'The Bapatla arts and science college,Baptla,near bustand Guntur(D),A.P 522101', 'Jun 2012', 'May 2015', 'Full Time', '59', 'form_6/1638777199_2058f49eb62fecbda5a2.pdf', '2021-12-06 13:23:19', '2021-12-06 13:23:19', NULL),
(6, 6, '12th', 'Board of Intermediate  A.P', 'The Salvation Army Junior College Bapatla', 'Aug 2009', 'Mar 2012', 'Full Time', '59', 'form_6/1638779846_6bb8142757d82ddb957e.pdf', '2021-12-06 14:07:26', '2021-12-06 14:07:26', NULL),
(7, 6, '10th Standard', 'board of secondary education', 'Z.P.H School Vedullapali,Bapatla Road', 'Jun 2008', 'Mar 2009', 'Full time', '58', 'form_6/1638780014_e4c0336950a0fcaefdac.pdf', '2021-12-06 14:10:14', '2021-12-06 14:10:14', NULL),
(8, 7, 'Bachelors of Engineering', 'Pune University', 'PDEA\'s College of Engineering, Hadapsar', 'Jun 2020', 'Dec 2003', 'Full Time', '56%', 'form_7/1639376468_bc2bbc508649d0f429e2.pdf', '2021-12-13 11:51:08', '2021-12-13 11:51:08', NULL),
(9, 8, 'MS Software Engineering', 'BITS Pilani', 'Birla Institute of Technology and Science', 'Jan 2011', 'Dec 2014', 'Off Campus', '5.9', 'form_8/1641469079_07f423b464effc9c8d56.jpeg', '2022-01-06 11:44:52', '2022-01-06 17:07:59', NULL),
(10, 8, 'BSC Computer Science', 'Andhra University', 'ABN&PRR College of Science', 'Jun 2007', 'Apr 2010', 'Full time', '67%', 'form_8/1641469183_a6edada0203fa0cdbe41.jpeg', '2022-01-06 11:47:39', '2022-01-06 17:09:43', NULL),
(11, 10, 'MCA', 'Andhra University', 'AU College of Enginneering, Visakhapatnam', 'AUG-1999', 'MAR-2002', 'FULL tIME', '61', 'form_10/1641804270_c1c4ded0af5f01de3485.pdf', '2022-01-10 14:14:30', '2022-01-10 14:14:30', NULL),
(12, 9, 'BTECH', 'JNTU Kukatpally', 'Jyothishmathi Instiute of technology and science', 'Sep 2007', 'Jul 2011', 'Full Time', '55', 'form_9/1641825506_ce9ba305210ab20e75a0.jpg', '2022-01-10 20:08:26', '2022-01-10 20:08:26', NULL),
(13, 10, 'BSC', 'Nagarjuna University', 'ABM Degree College, Ongole', 'Aug-1996', 'Mar-1999', 'Full Time', '70', 'form_10/1641834953_9efca0f64d25a1e65111.jpg', '2022-01-10 22:39:03', '2022-01-10 22:45:53', NULL),
(14, 10, 'Intermediate', 'Board of intermediate', 'ABM Junior College, Ongole', 'Aug-1994', 'Mar-1996', 'Full Time', '55', 'form_10/1641835112_5246220a987536d24860.pdf', '2022-01-10 22:40:03', '2022-01-10 22:48:32', NULL),
(15, 10, 'SSC', 'Board of Secondary Education', 'ABM High School, Ongole', 'Jul-1993', 'Mar-1994', 'Full Time', '65', 'form_10/1641835133_b3a53372c4fa245d0e9b.pdf', '2022-01-10 22:41:04', '2022-01-10 22:48:53', NULL),
(16, 9, 'intermediate', 'intermediate education', 'F466+76H, Saleh Nagar, Karimnagar, Telangana 505001/trinity Junior college', 'Jun 2005', 'Apr 2007', 'fullTime', '89', 'form_9/1641887980_9aa0d32c9b1c1246b11d.jpeg', '2022-01-11 13:29:40', '2022-01-11 13:29:40', NULL),
(17, 9, 'secondary school', 'secondary education', 'C4PQ+CF5, Ahmed Pura, Ashoknagar, Karimnagar, Telangana 505001/Sarvodaya high school', 'Jun 2004', 'Apr 2005', 'Fulltime', '63', 'form_9/1641888465_1e4469e085ec8094ae5c.jpg', '2022-01-11 13:37:45', '2022-01-11 13:37:45', NULL),
(18, 12, 'BSC', 'Bharathidasan university', 'AVVM Sri Pushpam college', 'Jun 1992', 'Apr 1995', 'Full Time', '67', 'form_12/1643814055_1f953ac3ebf1ffd3dcd8.pdf', '2022-02-02 16:04:53', '2022-02-02 20:30:55', NULL),
(19, 12, 'Higher Secondary', 'School', 'Rajahs HSS Thanjavur', 'Mar 1990', 'Mar 1992', 'Full Time', '65', 'form_12/1643881610_2fc87c16179974d88ccb.png', '2022-02-03 15:09:23', '2022-02-03 15:16:50', NULL),
(20, 12, 'Secondary School', 'School', 'St. Peter Secondary school', 'Jun 1989', 'Apr 1990', 'Full time', '60', 'form_12/1643883737_c987199c143bf10f66b7.png', '2022-02-03 15:52:17', '2022-02-03 15:52:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_joining_form_details`
--

CREATE TABLE `employee_joining_form_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `kids_name` mediumtext,
  `email_primary` varchar(100) DEFAULT NULL,
  `mobile_primary` varchar(20) DEFAULT NULL,
  `aadhar_number` varchar(20) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `education_qualification` mediumtext,
  `professional_qualification` mediumtext,
  `employment_history` mediumtext,
  `background_info` mediumtext,
  `employee_other_details` mediumtext,
  `documents` mediumtext,
  `verification_code` varchar(10) DEFAULT NULL,
  `is_accept_declaration` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `approval_dt` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_joining_form_details`
--

INSERT INTO `employee_joining_form_details` (`id`, `first_name`, `last_name`, `father_name`, `mother_name`, `spouse_name`, `kids_name`, `email_primary`, `mobile_primary`, `aadhar_number`, `pan_number`, `dob`, `place_of_birth`, `nationality`, `education_qualification`, `professional_qualification`, `employment_history`, `background_info`, `employee_other_details`, `documents`, `verification_code`, `is_accept_declaration`, `created_by`, `updated_by`, `status`, `approval_dt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Someshwar', 'Badade', 'Macchindranath', 'Suman', 'Rekha', NULL, 'somesh@bitstringit.in', '8806056756', '976587282062', 'BZCPB4691N', '11-Aug-1986', 'Ahmednagar', 'Indian', NULL, NULL, NULL, NULL, '{\"marital_status\":\"Married\",\"uan_number\":\"\",\"emergency_contact_name\":\"Rekah(wife)\",\"emergency_contact_mobile\":\"8007978464\",\"bank_name_branch\":\"ICICI Bank, Bundgarden road\",\"bank_account_number\":\"000501667961\",\"bank_ifsc_code\":\"ICIC0000005\",\"gender\":\"Male\",\"blood_group\":\"AB+\",\"medical_condition\":\"no\",\"total_experience\":\"5\",\"nature_of_job_hired\":\"Full Time\",\"present_address\":\"GAJANAN MAHARAJ NAGAR, NR B.U. BHANDARI, DIGHI, PUNE\",\"permanent_address\":\"KHASBAG KHADKAD ROAD, NEAR TELEPHONE OFFICE, ASHTI, BEED\",\"present_address_postcode\":\"411015\",\"permanent_address_postcode\":\"414203\",\"present_address_residing_duration\":\"3\"}', '{\"pan_card\":{\"path\":\"form_1\\/1637739277_14d960d322bba306d3d7.jpg\",\"file_name\":\"Someshwar_PAN_card (1).jpg\"},\"aadhar_card\":{\"path\":\"form_1\\/1637739293_38f7d19f940254498a10.jpg\",\"file_name\":\"Someshwar_aadhar_card (1).jpg\"}}', '14916595', NULL, NULL, 10, 0, NULL, '2021-11-24 12:59:27', '2021-12-02 11:49:27', NULL),
(2, 'Ravindra', 'Deshmukh', 'Shrihari', 'Anusaya', 'Manisha', 'Anagha, Rudra', 'ravi.deshmukh@bitstringit.com', '9960154585', '480797927521', 'AATPD1661P', '14-Apr-1972', 'Lakhandur', NULL, NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"Project Manager\",\"from_date\":\"May 2006\",\"to_date\":\"Aug 2019\",\"company\":\"HSBC Software Development  India\",\"department\":\"IT Infra Delivery\",\"nature_of_job\":\"Full Time\",\"address\":\"Kalyaninagar\",\"city\":\"Pune\",\"telephone\":\"\",\"job_responsibilities\":\"Leading Technology Deliveries\",\"annual_ctc\":\"\",\"reporting_manager\":\"Lakshmikanth Lingam\",\"contact_number_manager\":\"9999999999\",\"email_manager\":\"lakshmikanthlingam@hsbc.co.in\",\"reason_of_leaving\":\"Personal\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":0,\"O02\":0,\"O03\":0,\"O04\":0},\"previous_address\":[{\"address\":\"R 103, Mayurnagari Phase 2,  Pimple Gurav,  PUNE\",\"postcode\":\"411061\",\"dates\":\"\",\"from_date\":\"Nov 2007\",\"to_date\":\"APR 2014\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Married\",\"uan_number\":\"\",\"emergency_contact_name\":\"Manisha Deshmukh\",\"emergency_contact_mobile\":\"9763584914\",\"bank_name_branch\":\"HSBC\",\"bank_account_number\":\"105353114006\",\"bank_ifsc_code\":\"HSBC0411002\",\"gender\":\"Male\",\"blood_group\":\"O+\",\"total_experience\":\"300\",\"nature_of_job_hired\":\"Full Time\",\"present_address\":\"S NO 257, PLOT NO 35, LANE 6, KHESE PARK, LOHGAON AFS ROAD  rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr\",\"present_address_postcode\":\"411032\",\"present_address_residing_duration\":\"8\",\"permanent_address\":\"S NO 257, PLOT NO 35, LANE 6, KHESE PARK, LOHGAON AFS ROAD\",\"permanent_address_postcode\":\"411032\",\"date_of_joining\":\"01-Apr-2020\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true,\"present_address_city\":\"Pune\",\"permanent_address_city\":\"Pune\"}', '{\"cheque\":{\"path\":\"form_2\\/1637740817_f84c35f6ea00cc1ea0cc.jpeg\",\"file_name\":\"Cheque-Leaf-Ravi HSBC.jpeg\"},\"pan_card\":{\"path\":\"form_2\\/1637740836_bb45ee9f1882758bdd55.jpg\",\"file_name\":\"PAN - Ravi -Signed.jpg\"},\"aadhar_card\":{\"path\":\"form_2\\/1637740851_eb4e0cf9e4548722dd1e.png\",\"file_name\":\"AADHAR-RAVI.PNG\"}}', '25246099', NULL, NULL, 10, 0, NULL, '2021-11-24 13:09:39', '2022-01-07 11:29:31', NULL),
(3, 'Someshwar', 'Badade', NULL, NULL, 'Rekha', NULL, 'someshbadade@gmail.com', '8806056756', '000000000000', 'PANNN1234N', '11-Aug-1986', NULL, NULL, NULL, NULL, NULL, NULL, '{\"marital_status\":\"Married\",\"uan_number\":\"\",\"emergency_contact_name\":\"Rekha\",\"emergency_contact_mobile\":\"8007978464\",\"bank_name_branch\":\"ICICI\",\"bank_account_number\":\"0005555\",\"bank_ifsc_code\":\"ICIC0000001\",\"gender\":\"Male\",\"blood_group\":\"AB+\",\"present_address\":\"Dighi\",\"permanent_address\":\"dighi\",\"present_address_postcode\":\"411015\",\"permanent_address_postcode\":\"411015\",\"present_address_residing_duration\":\"5\",\"date_of_joining\":\"01-Jul-2020\"}', '{\"aadhar_card\":{\"path\":\"form_3\\/1638262624_4a6b00396df016219a79.jpg\",\"file_name\":\"IMG-20181129-WA0013.jpg\"},\"pan_card\":{\"path\":\"form_3\\/1638262635_ca6306037d9b8431a3f2.jpg\",\"file_name\":\"Someshwar_PAN_card (1).jpg\"},\"cheque\":{\"path\":\"form_3\\/1638262647_0b6c4e9fc13d0cac81db.jpg\",\"file_name\":\"Someshwar_address_proof.jpg\"}}', '12724551', NULL, NULL, 10, 0, NULL, '2021-11-30 14:15:52', '2021-12-02 11:46:12', NULL),
(4, 'Ravindra', 'Deshmukh', NULL, NULL, NULL, NULL, 'deshmukh.ravi@gmail.com', NULL, '480797927521', 'AATPD1661P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27124973', NULL, NULL, 10, 0, NULL, '2021-12-01 16:44:01', '2021-12-01 16:44:01', NULL),
(5, 'Avinash', 'Gunjkar', NULL, NULL, NULL, NULL, 'avinash.gunjkar@bitstringit.in', NULL, '761155389857', 'AXJPG4046N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47198339', NULL, NULL, 9, 0, NULL, '2021-12-02 14:37:54', '2022-01-07 11:51:15', NULL),
(6, 'Kiran', 'Kumar Papana', 'Venkata rao', 'Sulochana', '', NULL, 'kirankumarpapana@gmail.com', '7989075141', '457841160623', 'CQHPP7301J', '24-Jun-1993', 'Bapatla.A.P', 'Indian', NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"System Associate\",\"from_date\":\"Nov 2017\",\"to_date\":\"May 2021\",\"company\":\"Moonstone infotech Pvt Ltd\",\"department\":\"Development\",\"nature_of_job\":\"IT\",\"address\":\"Level 2, Plot No.18,Oval Building,hyderabad ,T.S\",\"city\":\"Hyderabad ,telangana\",\"telephone\":\"\",\"job_responsibilities\":\"ServiceNow admin and development\",\"annual_ctc\":\"5.6\",\"reporting_manager\":\"Dhanalaxmi\",\"contact_number_manager\":\"040-40273660\",\"email_manager\":\"palaparthi.dhanalaxmi@mstoneinfotech.com\",\"reason_of_leaving\":\"Career Growth\",\"hr_name\":\"kanakala sanjeev\",\"hr_contact_number\":\"040-40273660\",\"hr_email\":\"kanakala.sanjeev@mstoneinfotech.com\",\"hr_designation\":\"HR manager\"},{\"position_held\":\"Associate Technical Service Engineer\",\"from_date\":\"May 2021\",\"to_date\":\"Aug 2021\",\"company\":\"Fujitsu consulting india Pvt Ltd\",\"department\":\"Development\",\"nature_of_job\":\"IT\",\"address\":\"Hyderabad ,telangana\",\"city\":\"Hyderabad ,telangana\",\"telephone\":\"\",\"job_responsibilities\":\"ServiceNow admin and development\",\"annual_ctc\":\"8.5\",\"reporting_manager\":\"Sandeep\",\"contact_number_manager\":\"9345371615\",\"email_manager\":\"G09GM-Employment.Verification@fujitsu.com\",\"reason_of_leaving\":\"Personal health issue\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":false,\"C02\":false,\"C03\":false,\"C04\":false,\"C05\":false,\"C06\":false,\"C07\":false,\"C08\":false},\"business_interest\":{\"B01\":false,\"B02\":false,\"B03\":false,\"B04\":false},\"other_disqualification\":{\"O01\":false,\"O02\":false,\"O03\":false,\"O04\":false},\"previous_address\":[{\"address\":\"H.No 59-74,Degalavarinagar,Kavurivaripalem,Gavinivaripalem,Chirala(M)Praksam(D) A.P\",\"postcode\":\"523166\",\"dates\":\"\",\"from_date\":\"Jan 2014\",\"to_date\":\"Dec 2021\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Single\",\"uan_number\":\"101120522321\",\"emergency_contact_name\":\"Venkatarao,Father\",\"emergency_contact_mobile\":\"7286885889\",\"bank_name_branch\":\"ICICI Bank\",\"bank_account_number\":\"238601502141\",\"bank_ifsc_code\":\"ICIC0002386\",\"gender\":\"Male\",\"blood_group\":\"A+\",\"nature_of_job_hired\":\"Contract\",\"date_of_joining\":\"06-Dec-2021\",\"present_address\":\"H.No :59-74,Degalavarinagar,kavurivaripalem,Near Ankammatali temple,Gavinivarpalem (post)\",\"present_address_postcode\":\"523166\",\"permanent_address\":\"H.No :59-74,Degalavarinagar,kavurivaripalem,Near Ankammatali temple,Gavinivarpalem (post)\",\"permanent_address_postcode\":\"523166\",\"present_address_residing_duration\":\"60\",\"total_experience\":\"40\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true,\"permanent_address_city\":\"Gavinivarpalem\",\"present_address_city\":\"Gavinivarpalem\"}', '{\"pan_card\":{\"path\":\"form_6\\/1638779466_2f1ebcecfeec87a9ace2.jpg\",\"file_name\":\"Pan card.jpg\"},\"aadhar_card\":{\"path\":\"form_6\\/1638779486_1c5f6938acf20e658a2a.jpeg\",\"file_name\":\"Kiran Adhar.jpeg\"},\"cheque\":{\"path\":\"form_6\\/1638781014_d36aa7a9a22345dafaa8.pdf\",\"file_name\":\"Cancelled chq.pdf\"}}', '16331931', NULL, NULL, 10, 0, NULL, '2021-12-06 11:28:32', '2022-01-07 12:52:13', NULL),
(7, 'Kaustubh', 'Deshpande', 'Vishwas Deshpande', 'Vidula Deshpande', 'Sheetal Deshpande', 'Asmi Deshpande', 'kaustubhde@gmail.com', '9922192393', '756783415309', 'AINPD4675R', '21-Jul-1982', 'Pune, MH', 'Indian', NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"Manager - Projects\",\"from_date\":\"Sep 2009\",\"to_date\":\"Dec 2020\",\"company\":\"Cognizant Technology Solutions\",\"department\":\"Various\",\"nature_of_job\":\"Consulting, Project Management\",\"address\":\"Hinjewadi\",\"city\":\"Pune\",\"telephone\":\"02066535400\",\"job_responsibilities\":\"Consulting, Project Management\",\"annual_ctc\":\"21,35,000\",\"reporting_manager\":\"Nikhilesh Pant\",\"contact_number_manager\":\"9881136727\",\"email_manager\":\"Nikhilesh.Pant@Cognizant.com\",\"reason_of_leaving\":\"Wanted to work on a personal project\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Sr. Software Engineer\",\"from_date\":\"Apr 2006\",\"to_date\":\"Sep 2009\",\"company\":\"L&T Infotech\",\"department\":\"Insurance\",\"nature_of_job\":\"Quality Lead\",\"address\":\"4 Godrej Eternia-A, Old Mumbai Rd, Shivajinagar, P\",\"city\":\"Pune\",\"telephone\":\"02066416262\",\"job_responsibilities\":\"Quality Lead\",\"annual_ctc\":\"\",\"reporting_manager\":\"Mukund Mandke\",\"contact_number_manager\":\"9326787092\",\"email_manager\":\"mukundmandke@gmail.com\",\"reason_of_leaving\":\"Better opportunities\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Associate System Analyst\",\"from_date\":\"Sep 2005\",\"to_date\":\"Feb 2006\",\"company\":\"NSE.IT\",\"department\":\"Quality\",\"nature_of_job\":\"Software Quality Analyst\",\"address\":\"Trade Globe, Andheri-Kurla Road, Andheri (East)\",\"city\":\"Mumbai\",\"telephone\":\"02228277600\",\"job_responsibilities\":\"Software Quality Analyst\",\"annual_ctc\":\"\",\"reporting_manager\":\"Meghana Deshpande\",\"contact_number_manager\":\"9820755895\",\"email_manager\":\"m.deshpande@hotmail.com\",\"reason_of_leaving\":\"Better opportunities\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Sr. QA Associate\",\"from_date\":\"Jun 2004\",\"to_date\":\"Sep 2015\",\"company\":\"Brainvisa Technlogies (Indecomm -> Encora)\",\"department\":\"QA\",\"nature_of_job\":\"Quality Assurance\",\"address\":\"7th Floor, ICC Tech Park, Tower A, Senapati Bapat\",\"city\":\"Pune\",\"telephone\":\"02066240500\",\"job_responsibilities\":\"Quality Assurance\",\"annual_ctc\":\"\",\"reporting_manager\":\"HR (Sheetal Sanghal)\",\"contact_number_manager\":\"02066240500\",\"email_manager\":\"sheetal.sanghal@encora.com\",\"reason_of_leaving\":\"Better opportunities\",\"hr_name\":\"HR  (Sheetal Sanghal)\",\"hr_contact_number\":\"02066240500\",\"hr_email\":\"sheetal.sanghal@encora.com\",\"hr_designation\":\"\"},{\"position_held\":\"QC-Inspector\",\"from_date\":\"Jul 2003\",\"to_date\":\"Jun 2004\",\"company\":\"Flex-Tran Industries\",\"department\":\"Quality\",\"nature_of_job\":\"Quality Control\",\"address\":\"94+100, Kesanand Village, Wagholi\",\"city\":\"Pune\",\"telephone\":\"Company closed\",\"job_responsibilities\":\"Quality Control\",\"annual_ctc\":\"\",\"reporting_manager\":\"Company closed\",\"contact_number_manager\":\"Company closed\",\"email_manager\":\"NA@NA.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"Company closed\",\"hr_contact_number\":\"Company closed\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Self-Employed\",\"from_date\":\"Dec 2020\",\"to_date\":\"Dec 2021\",\"company\":\"Self-Employed\",\"department\":\"NA\",\"nature_of_job\":\"AI based Trading & Investing\",\"address\":\"B2 702, Shivaranjan Towers,\",\"city\":\"Pune\",\"telephone\":\"9922192393\",\"job_responsibilities\":\"AI based Trading & Investing\",\"annual_ctc\":\"\",\"reporting_manager\":\"Kaustubh Deshpande\",\"contact_number_manager\":\"9922192393\",\"email_manager\":\"kaustubhde@gmail.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":false,\"C02\":false,\"C03\":false,\"C04\":false,\"C05\":false,\"C06\":false,\"C07\":false,\"C08\":false},\"business_interest\":{\"B01\":false,\"B02\":false,\"B03\":false,\"B04\":false},\"other_disqualification\":{\"O01\":false,\"O02\":false,\"O03\":false,\"O04\":false},\"previous_address\":[{\"address\":\"B2-702, Shivaranjan Towers, Someshwarwadi, Pashan, Pune\",\"postcode\":\"411008\",\"dates\":\"\",\"from_date\":\"Dec 2008\",\"to_date\":\"Dec 2021\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Married\",\"uan_number\":\"100200359948\",\"emergency_contact_name\":\"Sheetal Deshpande (Wife)\",\"emergency_contact_mobile\":\"8308803090\",\"bank_name_branch\":\"ICICI Bank, Kothrud\",\"bank_account_number\":\"033801000639\",\"bank_ifsc_code\":\"ICIC0000338\",\"gender\":\"Male\",\"blood_group\":\"AB+\",\"date_of_joining\":\"13-Dec-2021\",\"nature_of_job_hired\":\"Full Time\",\"present_address\":\"B2 702, Shivaranjan Towers, Someshwarwadi, Pashan, Pune\",\"present_address_postcode\":\"411008\",\"present_address_residing_duration\":\"13\",\"permanent_address\":\"B2 702, Shivaranjan Towers, Someshwarwadi, Pashan, Pune\",\"permanent_address_postcode\":\"411008\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true}', '{\"aadhar_card\":{\"path\":\"form_7\\/1639379140_0d77bacf416b0a19815d.pdf\",\"file_name\":\"Aadhar Card.pdf\"},\"cheque\":{\"path\":\"form_7\\/1639379155_03cd1ce2350e9277a853.jpg\",\"file_name\":\"Cheque Copy.jpg\"},\"settlement_letter\":{\"path\":\"form_7\\/1639379307_0d9bf31e02d8b97a3631.pdf\",\"file_name\":\"Cognizant_Relieving Letter_(21071982AINPD4675R).pdf\"},\"education_certificate\":{\"path\":\"form_7\\/1639379332_ef3a076452baaaef2c6f.pdf\",\"file_name\":\"Kaustubh Deshpande- Education Certificates.PDF\"},\"pan_card\":{\"path\":\"form_7\\/1639379414_cdbea3b73730d5c0f08b.pdf\",\"file_name\":\"PAN CARD.pdf\"},\"passport\":{\"path\":\"form_7\\/1639379577_7aa8f70316c1039fd000.pdf\",\"file_name\":\"Passport.pdf\"},\"resignation_letter\":{\"path\":\"form_7\\/1639379742_689f4e090608ad9d887a.pdf\",\"file_name\":\"Resignation Acceptance Letter (21071982AINPD4675R).pdf\"},\"salary_slip_1\":{\"path\":\"form_7\\/1639379755_e1b52f9326b5f7ab18f0.pdf\",\"file_name\":\"Payslip_205220_CIN_Nov_2020.pdf\"},\"salary_slip_2\":{\"path\":\"form_7\\/1639379764_1c098cd44bfdd68373ce.pdf\",\"file_name\":\"Payslip_205220_CIN_Oct_2020.pdf\"},\"salary_slip_3\":{\"path\":\"form_7\\/1639379773_87f44a6b8adaa2bf62e4.pdf\",\"file_name\":\"Payslip_205220_CIN_Sep_2020.pdf\"},\"ssc_certificate\":{\"path\":\"form_7\\/1639379790_7c2a3ca59a038fba2d0b.pdf\",\"file_name\":\"Kaustubh Deshpande- Education Certificates.PDF\"},\"relieving_letter\":{\"path\":\"form_7\\/1639396139_f54faeba686e23923f9d.zip\",\"file_name\":\"Employment Details.zip\"}}', '29507386', NULL, NULL, 10, 0, NULL, '2021-12-13 11:40:17', '2022-01-07 11:48:59', NULL),
(8, 'Indhiravathi', 'Sanapathi', 'Simhachalam', 'Ramanamma', 'Gondu Venkata Santosh Kumar', NULL, 'indhiravathi.s9@gmail.com', '8884334624', '200906332086', 'CXNPS6420C', '06-Jul-1990', 'Chagallu', NULL, NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"Senior Professional Engineer\",\"from_date\":\"Dec 2015\",\"to_date\":\"Dec 2021\",\"company\":\"DXC Technology\",\"department\":\"IT\",\"nature_of_job\":\"Full Time\",\"address\":\"Maruthi Concorde Business Park, Konappana Agrahara\",\"city\":\"Bangalore\",\"telephone\":\"\",\"job_responsibilities\":\"Business Analyst\",\"annual_ctc\":\"13,08003\",\"reporting_manager\":\"Allan Freeman\",\"contact_number_manager\":\"+44 07841844413\",\"email_manager\":\"afreeman20@dxc.com\",\"reason_of_leaving\":\"Career growth\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Senior Project Engineer\",\"from_date\":\"Aug 2010\",\"to_date\":\"Nov 2015\",\"company\":\"WIPRO\",\"department\":\"IT\",\"nature_of_job\":\"Full Time\",\"address\":\"Tower S2, Electronic City\",\"city\":\"Bangalore\",\"telephone\":\"\",\"job_responsibilities\":\"Senior Developer\",\"annual_ctc\":\"545000\",\"reporting_manager\":\"MohanRaj Subramani\",\"contact_number_manager\":\"8883376666\",\"email_manager\":\"smohanrajit@gmail.com\",\"reason_of_leaving\":\"Career growth\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\",\"O04\":\"0\"},\"previous_address\":[{\"address\":\"F-403, Ittina Mahaveer, Neeladri Nagar, Electronic City, Bangalore\",\"postcode\":\"560012\",\"dates\":\"\",\"from_date\":\"Jan 2014\",\"to_date\":\"Dec 2020\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Married\",\"uan_number\":\"100598410270\",\"emergency_contact_name\":\"Gondu Venkata Santosh Kumar and Husband\",\"emergency_contact_mobile\":\"9640553115\",\"bank_name_branch\":\"HDFC & Skyline Icon,Whitefield\",\"bank_account_number\":\"23771130004115\",\"bank_ifsc_code\":\"HDFC0002377\",\"gender\":\"Female\",\"blood_group\":\"O+\",\"total_experience\":\"136\",\"nature_of_job_hired\":\"Full Time\",\"date_of_joining\":\"03-Jan-2022\",\"present_address\":\"10-2\\/200,Phase 2, SitaRama Gardens, STBL Projects, Sheela Nagar\",\"present_address_city\":\"Visakhapatnam\",\"present_address_postcode\":\"530012\",\"present_address_residing_duration\":\"1Y\",\"permanent_address\":\"10-2\\/200,Phase 2, SitaRama Gardens, STBL Projects, Sheela Nagar\",\"permanent_address_city\":\"Visakhapatnam\",\"permanent_address_postcode\":\"530012\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true}', '{\"aadhar_card\":{\"path\":\"form_8\\/1641453754_7e5b82c4c1ad29b9e404.pdf\",\"file_name\":\"Indhiravathi_Aadhar.pdf\",\"documentNote\":\"\"},\"ssc_certificate\":{\"path\":\"form_8\\/1641454368_362c6227355006f2d07a.jpg\",\"file_name\":\"SSC.jpg\",\"documentNote\":\"\"},\"salary_slip_1\":{\"path\":\"form_8\\/1641454600_6128d0511b8f7c323b71.pdf\",\"file_name\":\"October2021.pdf\",\"documentNote\":\"\"},\"salary_slip_2\":{\"path\":\"form_8\\/1641454617_0ca500fda0d29e275026.pdf\",\"file_name\":\"November2021.pdf\",\"documentNote\":\"\"},\"salary_slip_3\":{\"path\":\"form_8\\/1641454912_8086d78b51ad6e2f96f9.pdf\",\"file_name\":\"Payslip_Dec2021.pdf\",\"documentNote\":\"\"},\"pan_card\":{\"path\":\"form_8\\/1641455377_caf156a2f6c4ab7c2d64.pdf\",\"file_name\":\"Indhira_PAN.pdf\",\"documentNote\":\"\"},\"education_certificate\":{\"path\":\"form_8\\/1641460160_2585bf0262cb47851331.jpeg\",\"file_name\":\"WhatsApp Image 2022-01-06 at 2.36.03 PM.jpeg\",\"documentNote\":\"\"},\"resignation_letter\":{\"path\":\"form_8\\/1641460404_09cb9cb2b7a89ee1b340.pdf\",\"file_name\":\"DXC Resignation Acceptance - Indhiravathi Sanapathi.pdf\",\"documentNote\":\"\"},\"cheque\":{\"path\":\"form_8\\/1641466706_95b2d5a3fb142445f281.jpeg\",\"file_name\":\"WhatsApp Image 2022-01-06 at 4.17.12 PM.jpeg\",\"documentNote\":\"\"}}', '33633334', '2022-01-06 17:11:43', NULL, 10, 2, '2022-01-06 17:21:08', '2022-01-06 10:38:12', '2022-01-06 17:21:08', NULL),
(9, 'Amirishetti', 'Pavan Kumar', 'Amirishetti Kishan', 'Amirishetti Anasurya', 'Thejasri', NULL, 'pavan.amirishetty12@gmail.com', '7893217325', '824570604290', 'BWKPA3794E', '15-Dec-1989', 'karimnagar,Telangana', NULL, NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"technical support Engineer\",\"from_date\":\"Aug 2018\",\"to_date\":\"Jan 2022\",\"company\":\"Ahana systems&solutions\",\"department\":\"IT\",\"nature_of_job\":\"Full Time\",\"address\":\"502\\/37, 2nd Floor, 1st Main Rd, 8th Block, Jayanag\",\"city\":\"bangalore\",\"telephone\":\"08026635854\",\"job_responsibilities\":\"Based on request need to assist clients\",\"annual_ctc\":\"2.8\",\"reporting_manager\":\"Sujatha prakash\",\"contact_number_manager\":\"9148214143\",\"email_manager\":\"sujatha.prakash@ahana.co.in\",\"reason_of_leaving\":\"carrier growth\",\"hr_name\":\"pushpalatha\",\"hr_contact_number\":\"9900097010\",\"hr_email\":\"pushpalatha.m@ahana.co.in\",\"hr_designation\":\"resource cordinator\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\",\"O04\":\"0\"},\"previous_address\":[{\"address\":\"H No :8-3-231\\/A\\/395\\/400,krishna nagar, yousufguda , near Unique public school\",\"postcode\":\"500045\",\"dates\":\"\",\"from_date\":\"Apr 2016\",\"to_date\":\"Jun 2020\"},{\"address\":\"H No : 8-3-231\\/A85,krishna nagar,yousufguda, near Anvitha hospital\",\"postcode\":\"500045\",\"dates\":\"\",\"from_date\":\"Jul 2020\",\"to_date\":\"Jan 2022\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Married\",\"uan_number\":\"101347893879\",\"emergency_contact_name\":\"Thejasri (Wife)\",\"emergency_contact_mobile\":\"9573030040\",\"bank_name_branch\":\"Axis bank&madhapur\",\"bank_account_number\":\"918010074532932\",\"bank_ifsc_code\":\"UTIB0000553\",\"gender\":\"Male\",\"blood_group\":\"O+\",\"total_experience\":\"36\",\"nature_of_job_hired\":\"Full Time\",\"date_of_joining\":\"10-Jan-2022\",\"present_address\":\"8-3-231\\/A85\",\"present_address_city\":\"Hyderabad\",\"present_address_postcode\":\"500045\",\"present_address_residing_duration\":\"1y\",\"permanent_address\":\"H No : 8-52 , Nagulapalli, near pochamma temple ,dist pedhapalli , pincode :505525\",\"permanent_address_postcode\":\"505525\",\"permanent_address_city\":\"Nagulapalli\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true}', '{\"resignation_letter\":{\"path\":\"form_9\\/1641827271_0e3ddc5eb19c539db34d.pdf\",\"file_name\":\"Relieving Letter - Amirishetti Pavan kumar.pdf\",\"documentNote\":\"\"},\"salary_slip_1\":{\"path\":\"form_9\\/1641827557_e33f5f8d50f19b3ee6b5.pdf\",\"file_name\":\"Amirishetti Pavan kumar sep (AS00894).pdf\",\"documentNote\":\"\"},\"salary_slip_2\":{\"path\":\"form_9\\/1641827582_1e69d185367bf191531e.pdf\",\"file_name\":\"Amirishetti Pavan kumar(AS00894) (2).pdf\",\"documentNote\":\"\"},\"salary_slip_3\":{\"path\":\"form_9\\/1641827610_01e68548b8d1d9b3dbe5.pdf\",\"file_name\":\"Amirishetti Pavan kumar(AS00894) (2).pdf\",\"documentNote\":\"\"},\"education_certificate\":{\"path\":\"form_9\\/1641827648_020212d80b1160a89a30.jpg\",\"file_name\":\"IMG_20211118_154535 (2).jpg\",\"documentNote\":\"\"},\"cheque\":{\"path\":\"form_9\\/1641827867_0f96f3ee4d150cf038c2.jpg\",\"file_name\":\"IMG_20211118_165041 (1).jpg\",\"documentNote\":\"\"},\"pan_card\":{\"path\":\"form_9\\/1641827964_99b31009f26e47e0a5ee.jpg\",\"file_name\":\"IMG_20211118_155922 (1).jpg\",\"documentNote\":\"\"},\"aadhar_card\":{\"path\":\"form_9\\/1641828323_2bcf31126d6dd244a276.jpg\",\"file_name\":\"IMG_20211118_160256 (1).jpg\",\"documentNote\":\"\"},\"ssc_certificate\":{\"path\":\"form_9\\/1641828874_0cf13793df7206126d67.jpg\",\"file_name\":\"WhatsApp Image 2022-01-10 at 9.02.56 PM.jpg\",\"documentNote\":\"\"}}', '33074124', '2022-01-11 14:00:40', NULL, 10, 2, '2022-01-11 14:17:06', '2022-01-10 11:35:34', '2022-01-11 14:17:06', NULL),
(10, 'Emmanuel', 'Pillipogu', 'Koteshwara Rao', 'Jayamma', 'Jyothipriya', NULL, 'emmanuel.pillipogu@gmail.com', '9620393900', '793704986611', 'ANNPP3964E', '16-Jun-1979', 'Ongole', NULL, NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"Lead Engineer\",\"from_date\":\"JUL-2007\",\"to_date\":\"JUN-2020\",\"company\":\"Syniverse Technologies\",\"department\":\"IT\",\"nature_of_job\":\"Full Time\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"Sachin Karnik\",\"contact_number_manager\":\"08067209500\",\"email_manager\":\"sachin.karnik@syniverse.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"Veena Raju\",\"hr_contact_number\":\"08067209855\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Software Engineer\",\"from_date\":\"Jan-2006\",\"to_date\":\"Jun-2007\",\"company\":\"IBM India Pvt Ltd\",\"department\":\"IT\",\"nature_of_job\":\"Full Time\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"Sridhar\",\"contact_number_manager\":\"000000000000000\",\"email_manager\":\"sridhar@ibm.co.in\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\",\"O04\":\"0\"},\"previous_address\":[{\"address\":\"FLAT NO 410, BRR ELEGANCE APARTMENTS, 1ST B CROSS, 2ND MAIN, PAILAYOUT, BANGALORE\",\"postcode\":\"560016\",\"dates\":\"\",\"to_date\":\"Jan 2022\",\"from_date\":\"JUN 2014\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Married\",\"uan_number\":\"\",\"emergency_contact_name\":\"Jyothipriya - Wife\",\"emergency_contact_mobile\":\"9620144676\",\"bank_name_branch\":\"ICICI Bank, MAHALINGAPURAM\",\"bank_account_number\":\"434101000555\",\"bank_ifsc_code\":\"ICIC0004341\",\"gender\":\"Male\",\"blood_group\":\"B+\",\"medical_condition\":\"No\",\"total_experience\":\"174\",\"nature_of_job_hired\":\"Full Time\",\"date_of_joining\":\"10-Jan-2022\",\"present_address\":\"Flat No 410, BRR Elegance Apartments, 1st B Cross, 2nd main, Pai Layout\",\"present_address_city\":\"Bangalore\",\"present_address_postcode\":\"560016\",\"present_address_residing_duration\":\"7y\",\"permanent_address\":\"3-16, Pedavenkanna Palem, Ponnaluru Mandal, Andhra Pradesh\",\"permanent_address_city\":\"Kandukuru\",\"permanent_address_postcode\":\"523109\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true}', '{\"aadhar_card\":{\"path\":\"form_10\\/1641805170_87a03c691a8ad1f6a144.jpeg\",\"file_name\":\"Aadhar - Front Page.jpeg\",\"documentNote\":\"\"},\"pan_card\":{\"path\":\"form_10\\/1641805181_95435fa4fc8038b544d2.jpeg\",\"file_name\":\"PAN.jpeg\",\"documentNote\":\"\"},\"relieving_letter\":{\"path\":\"form_10\\/1641805193_da0ab977de3ecbe2b2b3.pdf\",\"file_name\":\"Emmanuel Pillipogu_Releiving Letter(1).pdf\",\"documentNote\":\"\"},\"salary_slip_1\":{\"path\":\"form_10\\/1641805202_f77421ea7d495f2d2be4.pdf\",\"file_name\":\"6719 _May 2020.pdf\",\"documentNote\":\"\"},\"salary_slip_2\":{\"path\":\"form_10\\/1641805213_7acc9095cfaaba1ec924.pdf\",\"file_name\":\"6719 _Apr 2020.pdf\",\"documentNote\":\"\"},\"salary_slip_3\":{\"path\":\"form_10\\/1641805225_45c42db9f0975b81e990.pdf\",\"file_name\":\"6719 _Mar 2020.pdf\",\"documentNote\":\"\"},\"cheque\":{\"path\":\"form_10\\/1641806029_61c27d70a654e225286b.jpeg\",\"file_name\":\"WhatsApp Image 2022-01-10 at 2.40.26 PM.jpeg\",\"documentNote\":\"\"}}', '48931530', '2022-01-10 22:49:14', NULL, 10, 2, '2022-01-11 11:56:26', '2022-01-10 13:27:27', '2022-01-11 11:56:26', NULL),
(11, 'Debashish', 'Ray', NULL, NULL, NULL, NULL, 'debashish.ray@bitstringit.com', NULL, '718584925160', 'AESRP7688R', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18199807', NULL, NULL, 9, 0, '2022-01-10 14:13:15', '2022-01-10 14:13:15', '2022-01-10 14:13:15', NULL),
(12, 'Ashok', 'G', 'R Gopalakrishna Rao', 'Mythily TR', 'A Revathy', NULL, 'gashok35@gmail.com', '9790927465', '236956391610', 'AHUPA3015G', '11-Dec-1974', 'Thanjavur, Tamil Nadu', 'Indian', NULL, NULL, '{\"employment_summary\":[],\"employers\":[{\"position_held\":\"Sr. Software professional\",\"from_date\":\"Nov 2005\",\"to_date\":\"Jan 2022\",\"company\":\"dxc technology\",\"department\":\"DELIVERY \\u2013 T&T \\u2013 INT\",\"nature_of_job\":\"Full Time\",\"address\":\"Olympia tech park, Guindy\",\"city\":\"Chennai\",\"telephone\":\"\",\"job_responsibilities\":\"ServiceNow Integration Architect\",\"annual_ctc\":\"27\",\"reporting_manager\":\"Paul Hickey\",\"contact_number_manager\":\"#\",\"email_manager\":\"paul.hickey@dxc.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Programmer\\/ analyst\",\"from_date\":\"Sep 2003\",\"to_date\":\"Oct 2005\",\"company\":\"sega gameworks\",\"department\":\"IT\",\"nature_of_job\":\"Full Time\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"Rick Engadhl\",\"contact_number_manager\":\"#\",\"email_manager\":\"rick.engadhal@noemail.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Consultant\",\"from_date\":\"Jan 2003\",\"to_date\":\"Oct 2003\",\"company\":\"iBackup Prosoft net corp\",\"department\":\"Consulting services\",\"nature_of_job\":\"Full Time\",\"address\":\"26115, Mureau Road\",\"city\":\"Calabasas\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"Shweta Sachdev\",\"contact_number_manager\":\"8182514200\",\"email_manager\":\"shweta.sachdeva@pro-softnet.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Programmer Analyst\",\"from_date\":\"Jun 2000\",\"to_date\":\"Feb 2003\",\"company\":\"Sigma Project Services\",\"department\":\"Consulting Services\",\"nature_of_job\":\"Full Time\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"Sudesh B\",\"contact_number_manager\":\"5624029884\",\"email_manager\":\"sudes.b@sigma-project.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Web Developer\",\"from_date\":\"Jun 1999\",\"to_date\":\"Apr 2000\",\"company\":\"Silex Technologies\",\"department\":\"Web division\",\"nature_of_job\":\"Full Time\",\"address\":\"65 Ramaswamy road\",\"city\":\"Chennai\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"S Balaji\",\"contact_number_manager\":\"044-4983504\",\"email_manager\":\"balaji.s@silex-tech.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Programmer\",\"from_date\":\"Aug 1996\",\"to_date\":\"Jun 1999\",\"company\":\"Adroit Software Pvt Ltd\",\"department\":\"Software Development\",\"nature_of_job\":\"Full Time\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"K Venkateswaran\",\"contact_number_manager\":\"#\",\"email_manager\":\"venkateswaran.k@nomail.com\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}],\"previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"previous_to_previous_employer\":{\"position_held\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"company\":\"\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},\"gap_declaration\":[]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\",\"O04\":\"0\"},\"previous_address\":[{\"address\":\"12\\/39 SBI Colony adambakkam, chennai, India\",\"postcode\":\"600088\",\"dates\":\"\",\"from_date\":\"Nov 2005\",\"to_date\":\"Jan 2022\"}],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"marital_status\":\"Married\",\"uan_number\":\"100093433573\",\"emergency_contact_name\":\"Revathy A, Wife\",\"emergency_contact_mobile\":\"8056009185\",\"bank_name_branch\":\"ICICI Bank, KK Nagar\",\"bank_account_number\":\"007701515414\",\"bank_ifsc_code\":\"ICIC0000077\",\"gender\":\"Male\",\"blood_group\":\"B+\",\"nature_of_job_hired\":\"Full Time\",\"date_of_joining\":\"01-Feb-2022\",\"present_address\":\"12\\/39,SBI COLONY\",\"present_address_city\":\"CHENNAI\",\"present_address_postcode\":\"600088\",\"present_address_residing_duration\":\"16\",\"permanent_address\":\"12\\/39,SBI COLONY\",\"permanent_address_city\":\"CHENNAI\",\"permanent_address_postcode\":\"600088\",\"total_experience\":\"300\",\"is_accept_data_protection\":true,\"is_accept_authorization\":true}', '{\"aadhar_card\":{\"path\":\"form_12\\/1643861815_4af06732dd4d02fdf776.pdf\",\"file_name\":\"Adhaar card.pdf\",\"documentNote\":\"\"},\"pan_card\":{\"path\":\"form_12\\/1643861827_4ca1589140c1085ee0e7.pdf\",\"file_name\":\"pan.pdf\",\"documentNote\":\"\"},\"salary_slip_1\":{\"path\":\"form_12\\/1643872036_a1ef1db69120a2c9c399.pdf\",\"file_name\":\"Jan-22-payslip.pdf\",\"documentNote\":\"\"},\"salary_slip_2\":{\"path\":\"form_12\\/1643872324_fefbb04f195ad6d1b006.pdf\",\"file_name\":\"dec_21.pdf\",\"documentNote\":\"\"},\"salary_slip_3\":{\"path\":\"form_12\\/1643872337_7047999e929a94b7bcd3.pdf\",\"file_name\":\"nov_21.pdf\",\"documentNote\":\"\"},\"education_certificate\":{\"path\":\"form_12\\/1643872377_0f14af04292bcbf8da03.pdf\",\"file_name\":\"degree cert.pdf\",\"documentNote\":\"\"},\"cheque\":{\"path\":\"form_12\\/1643872794_0edfa0f8e73711c634f6.png\",\"file_name\":\"cancelled cheque.png\",\"documentNote\":\"\"},\"ssc_certificate\":{\"path\":\"form_12\\/1643883814_4eb2af1023caae3e2554.png\",\"file_name\":\"ssc.png\",\"documentNote\":\"\"}}', '19510266', '2022-02-03 16:06:16', NULL, 10, 2, '2022-02-03 16:06:36', '2022-02-02 14:45:04', '2022-02-03 16:06:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gap_declaration`
--

CREATE TABLE `gap_declaration` (
  `id` int(11) NOT NULL,
  `joining_form_id` int(11) NOT NULL,
  `particular` varchar(200) DEFAULT NULL,
  `from_date` varchar(20) DEFAULT NULL,
  `to_date` varchar(20) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gap_declaration`
--

INSERT INTO `gap_declaration` (`id`, `joining_form_id`, `particular`, `from_date`, `to_date`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Self employment', '07/1994', 'sep/1995', '', '2021-12-02 15:31:27', '2021-12-02 15:31:27', NULL),
(2, 6, 'Education to Education gap ,Back log pending', 'Mar 2011', 'May 2012', '', '2021-12-06 12:50:46', '2021-12-06 14:36:00', NULL),
(3, 6, 'Education to Employment gap, Serching for job', 'Jun 2015', 'Oct 2017', '', '2021-12-06 12:52:28', '2021-12-06 14:35:32', NULL),
(4, 6, 'Employment Gap', 'Sep 2021', 'Nov 2021', '', '2021-12-06 14:34:01', '2021-12-06 14:34:01', NULL),
(5, 10, 'Personal Issues', 'Aug-2002', 'Dec-2005', '', '2022-01-10 22:43:44', '2022-01-10 22:43:44', NULL),
(6, 10, 'Lost Job due to Pandemic', 'Jul-2020', 'Dec-2021', '', '2022-01-10 22:44:13', '2022-01-10 22:44:13', NULL),
(7, 9, 'I have done CCNA hardware networking course, do not have any supportings', 'Jul 2011', 'Jan 2013', '', '2022-01-11 12:23:57', '2022-01-11 14:12:53', NULL),
(8, 9, 'At my native place and doing farming', 'Jan 2013', 'Jul 2018', '', '2022-01-11 14:11:42', '2022-01-11 14:11:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

CREATE TABLE `job_positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_code` varchar(10) NOT NULL,
  `client_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `desc` mediumtext NOT NULL,
  `min_experience` int(11) NOT NULL DEFAULT '0',
  `max_experience` int(11) NOT NULL DEFAULT '0',
  `locations` text,
  `primary_skills` mediumtext,
  `match_primary_skills` int(11) NOT NULL DEFAULT '0',
  `secondary_skills` mediumtext,
  `match_secondary_skills` int(11) NOT NULL DEFAULT '0' COMMENT '0-Match all skills',
  `position_received_date` date DEFAULT NULL,
  `valid_to_date` date NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_skills`
--

CREATE TABLE `master_skills` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mediclaim`
--

CREATE TABLE `mediclaim` (
  `id` int(11) NOT NULL,
  `joining_form_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `age` varchar(5) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mediclaim`
--

INSERT INTO `mediclaim` (`id`, `joining_form_id`, `name`, `relationship`, `dob`, `age`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Ravindra Deshmukh', 'Self', '14-Apr-1972', '49', 'form_2/1637740535_06c9ed9f842b57061aaa.jpg', '2021-11-24 13:25:35', '2021-11-24 13:25:35', NULL),
(2, 2, 'Manisha Deshmukh', 'Wife', '12-Jul-1974', '47', 'form_2/1637740600_091fa9abbc8d5810b1ba.jpg', '2021-11-24 13:26:40', '2021-11-24 13:26:40', NULL),
(3, 2, 'Anagha Deshmukh', 'Daughter', '30-Jul-2000', '21', 'form_2/1637740639_33888ae5f270beacc478.jpeg', '2021-11-24 13:27:19', '2021-11-24 13:27:19', NULL),
(4, 2, 'Rudra Deshmukh', 'Son', '17-Feb-2006', '15', 'form_2/1637740662_1bd6a82f627f0ef6e59c.jpg', '2021-11-24 13:27:42', '2021-11-24 13:27:42', NULL),
(5, 6, 'Kiran Kumar Papana', 'Self', '24-Jun-1993', '28', 'form_6/1638780638_24d0ad9fe0b2d5380cc3.jpg', '2021-12-06 14:20:38', '2021-12-06 14:20:38', NULL),
(6, 7, 'Kaustubh Deshpande', 'Self', '21-Jul-1982', '39', 'form_7/1639392984_ec952a226f18c8461c7c.png', '2021-12-13 12:29:46', '2021-12-13 16:26:25', NULL),
(7, 7, 'Sheetal Kaustubh Deshpande', 'Spouse', '15-Nov-1981', '40', 'form_7/1639391016_92670155ef7c3cab3f7c.png', '2021-12-13 12:30:17', '2021-12-13 15:53:36', NULL),
(8, 7, 'Asmi Kaustubh Deshpande', 'Daughter', '26-Mar-2010', '11', 'form_7/1639391254_4574b473882e457afe7f.pdf', '2021-12-13 12:30:47', '2021-12-13 15:57:34', NULL),
(9, 8, 'Indhiravathi Sanapathi', 'Self', '06-Jul-1990', '31', 'form_8/1641453546_3f0802c6c49e1cf68437.jpeg', '2022-01-06 12:24:36', '2022-01-06 12:49:06', NULL),
(10, 8, 'Gondu Venkata Santosh Kumar', 'Spouse', '13-Mar-1991', '30', 'form_8/1641452355_6ad24f8364d19753f0f6.jpg', '2022-01-06 12:25:40', '2022-01-06 12:29:15', NULL),
(12, 10, 'Emmanuel Pillipogu', 'SELF', '16-Jun-1979', '42', 'form_10/1641805651_dd09810411939465c59c.jpeg', '2022-01-10 14:25:29', '2022-01-10 14:37:31', NULL),
(13, 10, 'Jyothipriya Kothimira', 'WIFE', '21-Jun-1984', '37', 'form_10/1641805633_34b1986ba21dc2a4cba6.jpeg', '2022-01-10 14:26:01', '2022-01-10 14:37:13', NULL),
(14, 10, 'Joseph Abhiroop Preetham', 'Son', '11-May-2009', '12', 'form_10/1641805619_a9e8cfb7f013d239fd5d.jpeg', '2022-01-10 14:26:30', '2022-01-10 14:36:59', NULL),
(15, 10, 'Ruth Abhija Preetham', 'Daughter', '26-Dec-2010', '11', 'form_10/1641805607_07dc72b8826dfbd11652.jpeg', '2022-01-10 14:26:49', '2022-01-10 14:36:47', NULL),
(16, 9, 'Amirishtti Pavan Kumar', 'Self', '15-Dec-1989', '32', 'form_9/1641888807_bda6a8da5d53434cbf3c.jpg', '2022-01-11 13:43:27', '2022-01-11 13:43:27', NULL),
(18, 9, 'Amirishetti Thejasri', 'Wife', '15-Jul-1998', '23', 'form_9/1641889316_6f2af92d443cb195e828.jpeg', '2022-01-11 13:51:56', '2022-01-11 13:51:56', NULL),
(19, 12, 'Revathy A', 'Wife', '26-Jun-1981', '40', 'form_12/1643879310_0a8377c70acbd3e9bf69.jpg', '2022-02-03 12:44:33', '2022-02-03 14:38:30', NULL),
(20, 12, 'Sneha A', 'Daughter', '26-Jul-2002', '19', 'form_12/1643879323_ec5287fffa9630efaca7.jpg', '2022-02-03 12:45:16', '2022-02-03 14:38:43', NULL),
(21, 12, 'Pranav', 'son', '21-Aug-2006', '15', 'form_12/1643879336_5b8446993808b12ae2d4.jpg', '2022-02-03 12:45:42', '2022-02-03 14:38:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `professional_qualification`
--

CREATE TABLE `professional_qualification` (
  `id` int(11) NOT NULL,
  `joining_form_id` int(11) NOT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professional_qualification`
--

INSERT INTO `professional_qualification` (`id`, `joining_form_id`, `qualification`, `category`, `date`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Project Management Professiona', 'Project Management I', 'Oct 2010', 'form_2/1638438724_279e52e9e3b7d40a58ac.png', '2021-12-02 15:21:23', '2021-12-13 17:17:42', NULL),
(2, 2, 'ITIL V4 Foundation', 'Axelo', 'Feb 2019', '', '2021-12-02 15:23:09', '2021-12-13 17:16:49', NULL),
(3, 7, 'ITIL® V3 Expert', '(#4250211.20246165)', 'Dec 2013', 'form_7/1639390162_2b566c3de4eff91706f9.pdf', '2021-12-13 11:52:32', '2021-12-13 15:39:22', NULL),
(4, 7, 'Project Management Professional', 'PMP (#1532761)', 'Aug 2012', 'form_7/1639390181_2a10dba67ee17b5cfd5d.pdf', '2021-12-13 11:53:44', '2021-12-15 18:52:50', NULL),
(5, 7, 'Certified Scrum Product Owner®', '(#1224053) scrum all', 'May 2019', 'form_7/1639390200_4e53bec601c208be7a81.pdf', '2021-12-13 11:54:21', '2021-12-13 15:40:01', NULL),
(6, 9, 'CSA', 'CSA', 'Jan 2022', 'form_9/1641825648_f65e8f710ebc3e49e8a7.pdf', '2022-01-10 20:10:48', '2022-01-10 20:10:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `candidate_name` varchar(200) DEFAULT NULL,
  `mobile_primary` varchar(20) DEFAULT NULL,
  `mobile_alternate` varchar(20) DEFAULT NULL,
  `email_primary` varchar(200) NOT NULL,
  `email_alternate` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `pan_number` varchar(12) DEFAULT NULL,
  `aadhar_number` varchar(20) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `resume_pdf` varchar(200) DEFAULT NULL,
  `resume_pdf_name` varchar(200) DEFAULT NULL,
  `resume_doc` varchar(200) DEFAULT NULL,
  `resume_doc_name` varchar(200) DEFAULT NULL,
  `preferred_work_locations` text,
  `categories` text,
  `primary_skills` mediumtext,
  `secondary_skills` mediumtext,
  `foundation_skills` mediumtext,
  `certifications` longtext,
  `work_experience` mediumtext,
  `total_experience` varchar(20) DEFAULT NULL,
  `relevant_experience` varchar(20) DEFAULT NULL,
  `current_company` varchar(100) DEFAULT NULL,
  `notice_period` varchar(10) DEFAULT NULL,
  `is_negotiable_np` tinyint(4) DEFAULT '0',
  `last_working_day` varchar(20) DEFAULT NULL,
  `negotiable_np` varchar(10) DEFAULT NULL,
  `ctc` varchar(10) DEFAULT NULL,
  `expected_ctc` varchar(10) DEFAULT NULL,
  `is_negotiable_ctc` tinyint(4) DEFAULT '0',
  `negotiable_ctc` varchar(10) DEFAULT NULL,
  `present_address` text,
  `present_address_postcode` varchar(10) DEFAULT NULL,
  `permanent_address` text,
  `permanent_address_postcode` varchar(10) DEFAULT NULL,
  `employment_history` mediumtext,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `verification_code` varchar(10) DEFAULT NULL,
  `documents` mediumtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `first_name`, `father_name`, `last_name`, `candidate_name`, `mobile_primary`, `mobile_alternate`, `email_primary`, `email_alternate`, `gender`, `marital_status`, `dob`, `pan_number`, `aadhar_number`, `photo`, `resume_pdf`, `resume_pdf_name`, `resume_doc`, `resume_doc_name`, `preferred_work_locations`, `categories`, `primary_skills`, `secondary_skills`, `foundation_skills`, `certifications`, `work_experience`, `total_experience`, `relevant_experience`, `current_company`, `notice_period`, `is_negotiable_np`, `last_working_day`, `negotiable_np`, `ctc`, `expected_ctc`, `is_negotiable_ctc`, `negotiable_ctc`, `present_address`, `present_address_postcode`, `permanent_address`, `permanent_address_postcode`, `employment_history`, `created_by`, `updated_by`, `status`, `verification_code`, `documents`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'someshwar', NULL, 'badade', NULL, '8806056756', '124123412342341', 'somesh@bitstringit.in', 'someshbadade@gmail.com', 'Male', 'Married', '11-Aug-1986', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PHP || HTML 5 || CSS || Javascript || Ruby || MySql || Oracle', 'Python || Java || Reactjs', '', NULL, NULL, '60', '60', 'Bitstring', '2', 1, NULL, NULL, '3.9', '6.0', 0, NULL, 'asfasdf', '1312', 'asdfadsf', '312312', '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', NULL, NULL, 1, '20474057', NULL, '2021-12-06 12:41:17', '2021-12-09 21:52:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_educational_qualification`
--

CREATE TABLE `profile_educational_qualification` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `from_date` varchar(20) DEFAULT NULL,
  `to_date` varchar(20) DEFAULT NULL,
  `course_type` varchar(50) DEFAULT NULL,
  `percentage` varchar(5) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_educational_qualification`
--

INSERT INTO `profile_educational_qualification` (`id`, `profile_id`, `degree`, `university`, `institution`, `from_date`, `to_date`, `course_type`, `percentage`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 15, 'BE', 'pune', 'scscoe', 'Aug 2010', 'May 2013', 'Full time', '60', NULL, '2021-12-08 12:56:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_interviews`
--

CREATE TABLE `profile_interviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `job_position_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `interview_taken_by` varchar(50) NOT NULL,
  `for_role` varchar(255) NOT NULL,
  `schedule_dt` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profile_professional_qualification`
--

CREATE TABLE `profile_professional_qualification` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profile_shortlist`
--

CREATE TABLE `profile_shortlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_position_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `applied_dt` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(8) UNSIGNED NOT NULL,
  `role_name` varchar(40) NOT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `role_type` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `display_name`, `role_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Admin', 'SUPER_USER', '2021-06-02 11:58:05', '2021-06-02 11:58:05', NULL),
(2, 'subadmin', 'Sub Admin', 'USER', '2021-06-02 11:58:05', '2021-06-02 11:58:05', NULL),
(3, 'hr', 'HR', 'USER', '2021-06-02 11:59:36', '2021-06-02 11:59:36', NULL),
(4, 'employee', 'Employee', 'USER', '2021-06-02 11:59:36', '2021-06-02 11:59:36', NULL),
(5, 'manager', 'Manager', 'USER', '2021-06-02 11:59:44', '2021-06-02 11:59:44', NULL),
(6, 'guest_user', 'Guest User', 'USER', '2021-06-02 11:59:44', '2021-06-02 11:59:44', NULL),
(7, 'accountant', 'Accountant', 'USER', '2021-06-02 11:59:44', '2021-06-02 11:59:44', NULL),
(8, 'support', 'Support', 'USER', '2021-06-02 11:59:44', '2021-06-02 11:59:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_capability`
--

CREATE TABLE `role_capability` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `capability_id` int(10) UNSIGNED NOT NULL,
  `is_allowed` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_capability`
--

INSERT INTO `role_capability` (`id`, `role_id`, `capability_id`, `is_allowed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 7, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(2, 3, 8, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(3, 3, 9, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(4, 3, 10, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(5, 3, 11, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(6, 3, 12, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(7, 3, 13, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(8, 3, 14, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(9, 3, 15, 0, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(10, 3, 16, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(11, 3, 17, 1, '2021-12-01 11:38:33', '2022-01-07 11:58:43', NULL),
(12, 7, 17, 1, '2021-12-01 11:38:33', '2021-12-08 10:44:09', NULL),
(13, 6, 12, 1, '2021-12-01 11:38:33', '2021-12-07 15:17:08', NULL),
(14, 6, 17, 1, '2021-12-01 11:38:33', '2021-12-07 15:17:08', NULL),
(15, 3, 4, 0, '2021-12-03 11:45:33', '2022-01-07 11:58:43', NULL),
(16, 3, 5, 0, '2021-12-03 11:46:22', '2022-01-07 11:58:43', NULL),
(17, 3, 6, 0, '2021-12-03 11:46:22', '2022-01-07 11:58:43', NULL),
(18, 3, 3, 0, '2021-12-03 11:46:22', '2022-01-07 11:58:43', NULL),
(19, 6, 14, 1, '2021-12-03 11:47:07', '2021-12-07 15:17:08', NULL),
(20, 5, 14, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(21, 5, 12, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(22, 5, 17, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(23, 5, 13, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(24, 5, 11, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(25, 5, 9, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(26, 5, 16, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(27, 5, 7, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(28, 5, 10, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(29, 5, 8, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(30, 5, 5, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(31, 5, 3, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(32, 5, 15, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(33, 5, 6, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(34, 5, 4, 1, '2021-12-03 12:49:09', '2021-12-03 12:49:09', NULL),
(35, 6, 11, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(36, 6, 27, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(37, 6, 24, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(38, 6, 29, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(39, 6, 25, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(40, 6, 26, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(41, 6, 28, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(42, 6, 23, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(43, 6, 7, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(44, 6, 8, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(45, 6, 10, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(46, 6, 16, 1, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(47, 6, 19, 0, '2021-12-07 15:17:08', '2021-12-07 15:17:08', NULL),
(48, 7, 12, 1, '2021-12-07 15:18:04', '2021-12-08 10:44:09', NULL),
(49, 7, 24, 1, '2021-12-07 15:18:04', '2021-12-08 10:44:09', NULL),
(50, 7, 28, 1, '2021-12-07 15:18:04', '2021-12-08 10:44:09', NULL),
(51, 7, 23, 0, '2021-12-08 10:44:09', '2021-12-08 10:44:09', NULL),
(52, 8, 17, 1, '2021-12-09 17:41:35', '2021-12-09 17:41:35', NULL),
(53, 8, 3, 1, '2021-12-09 17:41:35', '2021-12-09 17:41:35', NULL),
(54, 8, 4, 1, '2021-12-09 17:41:35', '2021-12-09 17:41:35', NULL),
(55, 8, 6, 1, '2021-12-09 17:41:35', '2021-12-09 17:41:35', NULL),
(56, 8, 15, 1, '2021-12-09 17:41:35', '2021-12-09 17:41:35', NULL),
(57, 2, 11, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(58, 2, 13, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(59, 2, 12, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(60, 2, 14, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(61, 2, 27, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(62, 2, 24, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(63, 2, 29, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(64, 2, 25, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(65, 2, 26, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(66, 2, 28, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(67, 2, 23, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(68, 2, 17, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(69, 2, 7, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(70, 2, 9, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(71, 2, 8, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(72, 2, 10, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(73, 2, 16, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(74, 2, 19, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(75, 2, 21, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(76, 2, 20, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(77, 2, 22, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(78, 2, 18, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(79, 2, 3, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(80, 2, 5, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(81, 2, 4, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(82, 2, 6, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(83, 2, 15, 1, '2021-12-13 18:12:40', '2021-12-13 18:12:40', NULL),
(84, 3, 30, 1, '2021-12-03 11:46:22', '2022-01-07 11:58:43', NULL),
(85, 3, 27, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL),
(86, 3, 24, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL),
(87, 3, 29, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL),
(88, 3, 25, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL),
(89, 3, 26, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL),
(90, 3, 28, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL),
(91, 3, 23, 1, '2022-01-07 11:58:43', '2022-01-07 11:58:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` int(10) NOT NULL DEFAULT '0',
  `user_role` int(10) NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `company_name` varchar(40) DEFAULT NULL,
  `address` text,
  `country` varchar(40) DEFAULT NULL,
  `state` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `profile_picture` varchar(40) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(40) CHARACTER SET latin1 NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `verification_code` varchar(10) DEFAULT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_role`, `owner_id`, `fname`, `lname`, `email`, `mobile`, `company_name`, `address`, `country`, `state`, `city`, `pincode`, `password`, `profile_picture`, `ip_address`, `status`, `verification_code`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 0, 3, 8, 'someshwar', 'badade', 'someshbadade@gmail.com', '8806056756', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IxSFlAOS3eXlqRTLy1rEqetXA6hStYO1NDKB3dVddom6.oU9GdgDe', '', '', 1, NULL, '2021-06-02 15:24:24', '2021-06-02 04:54:24', '2021-06-15 05:26:28', NULL),
(9, 0, 3, 9, 'Someshwar', 'Badade', 'somesh@bitstringit.in', '', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uVyM/KRv7ElPob.IzLVX9.VXblblk919BWjxshU16jw8kXz7jG.Hm', '', '', 1, '29966288', '2021-06-17 09:50:34', '2021-06-16 23:20:34', '2022-02-02 11:50:55', NULL),
(10, 0, 3, 9, 'Chinchulata', 'Nair', 'hr@bitstringit.com', '8999206632', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Wk/NutxxSNOWTavghvIl3eviAbMCHtF5I7fwR4QuEII2FZXrdupUa', '', '', 1, '17497274', '2021-06-17 09:50:34', '2021-06-16 23:20:34', '2022-02-02 14:38:56', NULL),
(11, 0, 3, 9, 'Ravindra', 'Deshmukh', 'ravi.deshmukh@bitstringit.com', '', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uVyM/KRv7ElPob.IzLVX9.VXblblk919BWjxshU16jw8kXz7jG.Hm', '', '', 1, NULL, '2021-06-17 09:50:34', '2021-06-16 23:20:34', '2021-06-25 08:03:20', NULL),
(12, 0, 3, 9, 'Kavita', 'Admin', 'admin@bitstringit.com', '9370139243', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$hZ93HX52IFk4g0pqDq5XoOUvQBfBZANBawXt8Kw0d72tyHuygU.cC', '', '', 1, NULL, '2021-06-17 09:50:34', '2021-06-16 23:20:34', '2022-02-03 19:05:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 1, '2021-12-01 14:39:36', NULL, NULL),
(3, 11, 1, '2021-12-01 14:39:36', NULL, NULL),
(5, 10, 3, '2022-02-02 14:38:56', '2022-02-02 14:38:56', NULL),
(6, 12, 7, '2022-02-03 19:05:32', '2022-02-03 19:05:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_log`
--
ALTER TABLE `action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `action_type` (`action_type`),
  ADD KEY `model` (`model`);

--
-- Indexes for table `capabilities`
--
ALTER TABLE `capabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_contacts`
--
ALTER TABLE `client_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `educational_qualification`
--
ALTER TABLE `educational_qualification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joining_form_id` (`joining_form_id`);

--
-- Indexes for table `employee_joining_form_details`
--
ALTER TABLE `employee_joining_form_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gap_declaration`
--
ALTER TABLE `gap_declaration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joining_form_id` (`joining_form_id`);

--
-- Indexes for table `job_positions`
--
ALTER TABLE `job_positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`job_code`);

--
-- Indexes for table `master_skills`
--
ALTER TABLE `master_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mediclaim`
--
ALTER TABLE `mediclaim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joining_form_id` (`joining_form_id`);

--
-- Indexes for table `professional_qualification`
--
ALTER TABLE `professional_qualification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joining_form_id` (`joining_form_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_educational_qualification`
--
ALTER TABLE `profile_educational_qualification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joining_form_id` (`profile_id`);

--
-- Indexes for table `profile_interviews`
--
ALTER TABLE `profile_interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indexes for table `profile_professional_qualification`
--
ALTER TABLE `profile_professional_qualification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joining_form_id` (`profile_id`);

--
-- Indexes for table `profile_shortlist`
--
ALTER TABLE `profile_shortlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_capability`
--
ALTER TABLE `role_capability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_log`
--
ALTER TABLE `action_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `capabilities`
--
ALTER TABLE `capabilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_contacts`
--
ALTER TABLE `client_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educational_qualification`
--
ALTER TABLE `educational_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee_joining_form_details`
--
ALTER TABLE `employee_joining_form_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gap_declaration`
--
ALTER TABLE `gap_declaration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_skills`
--
ALTER TABLE `master_skills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mediclaim`
--
ALTER TABLE `mediclaim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `professional_qualification`
--
ALTER TABLE `professional_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `profile_educational_qualification`
--
ALTER TABLE `profile_educational_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile_interviews`
--
ALTER TABLE `profile_interviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_professional_qualification`
--
ALTER TABLE `profile_professional_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_shortlist`
--
ALTER TABLE `profile_shortlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role_capability`
--
ALTER TABLE `role_capability`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
