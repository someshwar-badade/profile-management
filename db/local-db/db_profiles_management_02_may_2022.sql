-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2022 at 01:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_profiles_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_log`
--

DROP TABLE IF EXISTS `action_log`;
CREATE TABLE IF NOT EXISTS `action_log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `action_by` varchar(200) DEFAULT NULL,
  `action_type` enum('created','updated','deleted') CHARACTER SET utf8 NOT NULL,
  `model` varchar(100) CHARACTER SET utf8 NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL,
  `chaged_data` longtext CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `action_type` (`action_type`),
  KEY `model` (`model`)
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_log`
--

INSERT INTO `action_log` (`id`, `user_id`, `action_by`, `action_type`, `model`, `record_id`, `chaged_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"personal_details\":{\"mother_name\":null}}', '2022-02-11 18:28:35', '2022-02-11 18:28:35', NULL),
(2, 9, 'Somesh Badade', 'created', 'joining_form', 6, '{\"academics\":{\"id\":\"\",\"joining_form_id\":\"6\",\"degree\":\"er\",\"university\":\"qwer\",\"institution\":\"qwer\",\"from_date\":\"Jan 2022\",\"to_date\":\"Feb 2022\",\"course_type\":\"afasdf\",\"percentage\":\"23\",\"document_path\":\"form_6\\/1644584332_7a76170f61e9c5bdd292.jpg\"}}', '2022-02-11 18:28:52', '2022-02-11 18:28:52', NULL),
(3, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"academics\":{\"document_path\":\"form_6\\/1644584341_af411770134b2f2b9947.png\"}}', '2022-02-11 18:29:01', '2022-02-11 18:29:01', NULL),
(4, 9, 'Somesh Badade', 'deleted', 'joining_form', 6, '{\"academics\":{\"id\":\"4\",\"joining_form_id\":\"6\",\"degree\":\"er\",\"university\":\"qwer\",\"institution\":\"qwer\",\"from_date\":\"Jan 2022\",\"to_date\":\"Feb 2022\",\"course_type\":\"afasdf\",\"percentage\":\"23\",\"document_path\":\"form_6\\/1644584332_7a76170f61e9c5bdd292.jpg\",\"created_at\":\"2022-02-11 18:28:52\",\"updated_at\":\"2022-02-11 18:28:52\",\"deleted_at\":null}}', '2022-02-11 18:29:40', '2022-02-11 18:29:40', NULL),
(6, 0, '', 'created', 'login', 9, '{\"login\":\"2022-02-16 11:45:42\"}', '2022-02-16 11:45:42', '2022-02-16 11:45:42', NULL),
(7, 0, '', 'created', 'login', 9, '{\"login\":\"2022-02-16 11:45:55\"}', '2022-02-16 11:45:55', '2022-02-16 11:45:55', NULL),
(8, 0, '', 'created', 'login', 9, '{\"login\":\"2022-02-16 11:47:11\"}', '2022-02-16 11:47:11', '2022-02-16 11:47:11', NULL),
(9, 0, '', 'created', 'login', 9, '{\"login\":\"2022-02-16 11:48:56\"}', '2022-02-16 11:48:56', '2022-02-16 11:48:56', NULL),
(10, 0, '', 'created', 'login', 9, '{\"login\":\"2022-02-16 11:55:15\"}', '2022-02-16 11:55:15', '2022-02-16 11:55:15', NULL),
(11, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-02-16 12:00:59\"}', '2022-02-16 12:00:59', '2022-02-16 12:00:59', NULL),
(12, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-02-16 14:19:57\"}', '2022-02-16 14:19:57', '2022-02-16 14:19:57', NULL),
(13, 9, 'Somesh Badade', 'created', 'profile', 15, '{\"interview\":{\"job_position_id\":\"1\",\"company_name\":\"HSBC\",\"for_role\":\"Full stack developer\",\"interview_taken_by\":\"qwer\",\"schedule_dt\":\"2022-02-17 16:00:00\",\"status\":\"7\",\"profile_id\":\"15\"}}', '2022-02-16 16:00:13', '2022-02-16 16:00:13', NULL),
(14, 9, 'Somesh Badade', 'updated', 'profile', 15, '{\"interview\":{\"status\":\"3\"}}', '2022-02-16 16:19:02', '2022-02-16 16:19:02', NULL),
(15, 9, 'Somesh Badade', 'updated', 'job_position', 1, '{\"client_name\":\"Infosys\",\"min_exp_y\":2,\"min_exp_m\":6,\"max_exp_y\":5,\"max_exp_m\":0}', '2022-02-16 16:42:30', '2022-02-16 16:42:30', NULL),
(16, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"personal_details\":{\"employee_other_details\":{\"gender\":\"Male\",\"martial_status\":\"Married\",\"total_experience\":\"60\",\"present_address\":\"Gajanan maharaj nagar, NR B.U. bhandari, dighi, pune\",\"present_address_postcode\":\"411015\",\"permanent_address\":\"Ameyanagar, bhingar, Ahmednagar\",\"permanent_address_postcode\":\"414203\",\"is_accept_authorization\":true,\"is_accept_data_protection\":true,\"marital_status\":\"Married\",\"blood_group\":\"AB+\",\"emergency_contact_name\":\"rekha (wife)\",\"emergency_contact_mobile\":\"8007978464\",\"bank_name_branch\":\"adf\",\"bank_account_number\":\"2234\",\"bank_ifsc_code\":\"ICIC0000001\",\"present_address_residing_duration\":\"5\",\"present_address_city\":\"Punee\",\"permanent_address_city\":\"Punee\",\"date_of_joining\":\"01-Jun-2020\"}}}', '2022-02-16 17:23:42', '2022-02-16 17:23:42', NULL),
(17, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"personal_details\":{\"employee_other_details\":{\"gender\":\"Male\",\"martial_status\":\"Married\",\"total_experience\":\"60\",\"present_address\":\"Gajanan maharaj nagar, NR B.U. bhandari, dighi, pune\",\"present_address_postcode\":\"411015\",\"permanent_address\":\"Ameyanagar, bhingar, Ahmednagar\",\"permanent_address_postcode\":\"414203\",\"is_accept_authorization\":true,\"is_accept_data_protection\":true,\"marital_status\":\"Married\",\"blood_group\":\"AB+\",\"emergency_contact_name\":\"rekha (wife)\",\"emergency_contact_mobile\":\"8007978464\",\"bank_name_branch\":\"adf\",\"bank_account_number\":\"2234\",\"bank_ifsc_code\":\"ICIC0000001\",\"present_address_residing_duration\":\"5\",\"present_address_city\":\"Pun\",\"permanent_address_city\":\"Pun\",\"date_of_joining\":\"01-Jun-2020\"}}}', '2022-02-16 17:25:40', '2022-02-16 17:25:40', NULL),
(18, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"personal_details\":{\"employee_other_details\":{\"present_address_city\":\"Pune\",\"permanent_address_city\":\"Pune\"}}}', '2022-02-16 17:29:19', '2022-02-16 17:29:19', NULL),
(19, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":[]}', '2022-02-16 17:36:38', '2022-02-16 17:36:38', NULL),
(20, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":[]}', '2022-02-16 17:37:39', '2022-02-16 17:37:39', NULL),
(21, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":{\"business_interest\":{\"B03\":\"1\",\"B04\":\"1\"}}}}', '2022-02-16 17:46:50', '2022-02-16 17:46:50', NULL),
(22, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":{\"criminal_and_civil_record\":{\"C01\":\"1\"},\"business_interest\":{\"B01\":\"1\",\"B02\":\"1\"}}}}', '2022-02-16 17:48:15', '2022-02-16 17:48:15', NULL),
(23, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":{\"other_disqualification\":{\"O01\":\"1\",\"O02\":\"1\",\"O03\":\"1\",\"O04\":\"1\"}}}}', '2022-02-16 17:50:10', '2022-02-16 17:50:10', NULL),
(24, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":[]}}', '2022-02-16 17:50:46', '2022-02-16 17:50:46', NULL),
(25, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":{\"criminal_and_civil_record\":[],\"business_interest\":[],\"other_disqualification\":{\"O01\":\"1\",\"O02\":\"1\",\"O03\":\"1\",\"O04\":\"1\"}}}}', '2022-02-16 17:54:53', '2022-02-16 17:54:53', NULL),
(26, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":{\"criminal_and_civil_record\":[],\"business_interest\":[],\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\"}}}}', '2022-02-16 17:55:04', '2022-02-16 17:55:04', NULL),
(27, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"background_info\":{\"other_disqualification\":{\"O01\":\"1\",\"O02\":\"1\"}}}}', '2022-02-16 18:05:45', '2022-02-16 18:05:45', NULL),
(28, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"criminal_and_civil_record\":{\"C01\":\"0\"},\"business_interest\":{\"B04\":\"0\"},\"other_disqualification\":{\"O04\":\"0\"}}}', '2022-02-16 18:06:53', '2022-02-16 18:06:53', NULL),
(29, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"background_info\":{\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\"}}}', '2022-02-16 18:07:27', '2022-02-16 18:07:27', NULL),
(30, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-02-21 10:13:31\"}', '2022-02-21 10:13:31', '2022-02-21 10:13:31', NULL),
(31, 9, 'Somesh Badade', 'created', 'job_position', 5, '{\"client_name\":\"yiuyui hhk\",\"job_code\":\"JB0005\",\"title\":\"testing\",\"min_exp_y\":\"0\",\"max_exp_y\":\"2\",\"locations\":\"Pune || Mumbai || Chennai\",\"desc\":\"testing testing testing\",\"primary_skills\":\"AngularJs\",\"match_primary_skills\":\"0\",\"secondary_skills\":\"HTML\",\"match_secondary_skills\":\"1\",\"position_received_date\":\"2022-02-21\",\"valid_to_date\":\"2022-02-28\",\"min_experience\":0,\"max_experience\":24,\"created_by\":\"9\",\"updated_by\":\"9\"}', '2022-02-21 15:27:29', '2022-02-21 15:27:29', NULL),
(32, 9, 'Somesh Badade', 'updated', 'job_position', 5, '{\"primary_skills\":\"AngularJs || PHP\",\"min_exp_y\":0,\"min_exp_m\":0,\"max_exp_y\":2,\"max_exp_m\":0}', '2022-02-21 15:30:25', '2022-02-21 15:30:25', NULL),
(33, 9, 'Somesh Badade', 'updated', 'job_position', 5, '{\"match_primary_skills\":\"1\",\"min_exp_y\":0,\"min_exp_m\":0,\"max_exp_y\":2,\"max_exp_m\":0}', '2022-02-21 15:30:42', '2022-02-21 15:30:42', NULL),
(34, 9, 'Somesh Badade', 'updated', 'job_position', 5, '{\"match_primary_skills\":\"0\",\"min_exp_y\":0,\"min_exp_m\":0,\"max_exp_y\":2,\"max_exp_m\":0}', '2022-02-21 18:39:13', '2022-02-21 18:39:13', NULL),
(35, 9, 'Somesh Badade', 'updated', 'job_position', 5, '{\"primary_skills\":\"PHP || AngularJs 8\",\"min_exp_y\":0,\"min_exp_m\":0,\"max_exp_y\":2,\"max_exp_m\":0}', '2022-02-21 18:49:00', '2022-02-21 18:49:00', NULL),
(36, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-02-22 10:19:40\"}', '2022-02-22 10:19:40', '2022-02-22 10:19:40', NULL),
(37, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-02-28 13:33:05\"}', '2022-02-28 13:33:05', '2022-02-28 13:33:05', NULL),
(38, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"documents\":{\"passport\":{\"path\":\"form_6\\/1646035723_46e8fe9fcb889641f2e4.jpg\",\"file_name\":\"badge.jpg\",\"documentNote\":\"\"}}}', '2022-02-28 13:38:43', '2022-02-28 13:38:43', NULL),
(39, 9, 'Somesh Badade', 'deleted', 'joining_form', 6, '{\"documents\":\"passport\"}', '2022-02-28 13:43:37', '2022-02-28 13:43:37', NULL),
(40, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"documents\":{\"passport\":{\"path\":\"form_6\\/1646036026_fa447e4b1af34e00d772.jpg\",\"file_name\":\"badge.jpg\",\"documentNote\":\"\"}}}', '2022-02-28 13:43:46', '2022-02-28 13:43:46', NULL),
(41, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"documents\":{\"aadhar_card\":{\"path\":\"form_6\\/1646038712_537d0094c7caaa6eaec5.png\",\"documentNote\":\"\"}}}', '2022-02-28 14:28:32', '2022-02-28 14:28:32', NULL),
(42, 9, 'Somesh Badade', 'updated', 'joining_form', 6, '{\"documents\":{\"aadhar_card\":{\"path\":\"form_6\\/1646038732_b43311ba26c46ade96df.png\",\"file_name\":\"html5.png\"}}}', '2022-02-28 14:28:52', '2022-02-28 14:28:52', NULL),
(43, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-02 11:19:11\"}', '2022-03-02 11:19:11', '2022-03-02 11:19:11', NULL),
(44, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-02 15:11:18\"}', '2022-03-02 15:11:18', '2022-03-02 15:11:18', NULL),
(45, 0, 'someshwar badade', 'deleted', 'joining_form', 6, '{\"documents\":\"aadhar_card\"}', '2022-03-02 15:38:56', '2022-03-02 15:38:56', NULL),
(46, 0, 'someshwar badade', 'deleted', 'joining_form', 6, '{\"documents\":\"settlement_letter\"}', '2022-03-02 15:39:30', '2022-03-02 15:39:30', NULL),
(47, 0, 'someshwar badade', 'deleted', 'joining_form', 6, '{\"documents\":\"passport\"}', '2022-03-02 15:39:33', '2022-03-02 15:39:33', NULL),
(48, 0, 'someshwar badade', 'updated', 'joining_form', 6, '{\"documents\":{\"aadhar_card\":{\"path\":\"form_6\\/1646216140_948f9b6e5e5652854570.jpg\",\"file_name\":\"badge.jpg\",\"documentNote\":\"\"}}}', '2022-03-02 15:45:40', '2022-03-02 15:45:40', NULL),
(49, 0, 'someshwar badade', 'deleted', 'joining_form', 6, '{\"documents\":\"pan_card\"}', '2022-03-02 15:50:41', '2022-03-02 15:50:41', NULL),
(50, 0, 'someshwar badade', 'updated', 'joining_form', 6, '{\"documents\":{\"pan_card\":{\"path\":\"form_6\\/1646216844_267216d30c1f65db1859.png\",\"file_name\":\"480px-Unofficial_JavaScript_logo_2.svg.png\",\"documentNote\":\"\"}}}', '2022-03-02 15:57:24', '2022-03-02 15:57:24', NULL),
(51, 0, 'someshwar badade', 'updated', 'profile', 15, '{\"academics\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"4\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"3\\\"}]\",\"secondary_skills\":\"[{\\\"text\\\":\\\"Oracle\\\",\\\"rating\\\":\\\"4\\\"},{\\\"text\\\":\\\"Mongodb\\\",\\\"rating\\\":\\\"3\\\"}]\",\"foundation_skills\":\"[]\",\"total_experience_y\":1,\"total_experience_m\":1,\"relevant_experience_y\":1,\"relevant_experience_m\":1,\"primary_skills_soundex\":\"P100 H354\",\"secondary_skills_soundex\":\"O624 M523\",\"foundation_skills_soundex\":\"\"}}', '2022-03-03 18:03:30', '2022-03-03 18:03:30', NULL),
(52, 0, 'someshwar badade', 'updated', 'profile', 15, '{\"academics\":{\"secondary_skills\":\"[{\\\"text\\\":\\\"Oracle\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"Mongodb\\\",\\\"rating\\\":\\\"9\\\"}]\",\"total_experience_y\":1,\"total_experience_m\":1,\"relevant_experience_y\":1,\"relevant_experience_m\":1}}', '2022-03-03 18:08:39', '2022-03-03 18:08:39', NULL),
(53, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-04 16:20:09\"}', '2022-03-04 16:20:09', '2022-03-04 16:20:09', NULL),
(54, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-07 12:04:09\"}', '2022-03-07 12:04:09', '2022-03-07 12:04:09', NULL),
(55, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-07 13:02:03\"}', '2022-03-07 13:02:03', '2022-03-07 13:02:03', NULL),
(56, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-07 13:59:49\"}', '2022-03-07 13:59:49', '2022-03-07 13:59:49', NULL),
(57, 9, 'Somesh Badade', 'updated', 'profile', 15, '{\"academics\":{\"foundation_skills\":\"[]\",\"total_experience_y\":1,\"total_experience_m\":1,\"relevant_experience_y\":1,\"relevant_experience_m\":1}}', '2022-03-07 14:35:14', '2022-03-07 14:35:14', NULL),
(58, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-07 15:05:18\"}', '2022-03-07 15:05:18', '2022-03-07 15:05:18', NULL),
(59, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-07 15:09:08\"}', '2022-03-07 15:09:08', '2022-03-07 15:09:08', NULL),
(60, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 15:51:17', '2022-03-07 15:51:17', NULL),
(61, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 15:51:47', '2022-03-07 15:51:47', NULL),
(62, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null},{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 15:52:46', '2022-03-07 15:52:46', NULL),
(63, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[]}', '2022-03-07 15:53:45', '2022-03-07 15:53:45', NULL),
(64, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 16:10:29', '2022-03-07 16:10:29', NULL),
(65, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 16:11:44', '2022-03-07 16:11:44', NULL),
(66, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 16:11:56', '2022-03-07 16:11:56', NULL),
(67, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-03-07 16:12:54', '2022-03-07 16:12:54', NULL),
(68, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null,\"user_role_id\":\"35\"}]}', '2022-03-07 16:20:43', '2022-03-07 16:20:43', NULL),
(69, 8, 'someshwar badade', 'created', 'profile', 23, '{\"message\":\"created profile\"}', '2022-03-07 16:52:42', '2022-03-07 16:52:42', NULL),
(70, 8, 'someshwar badade', 'created', 'profile', 24, '{\"message\":\"created profile\"}', '2022-03-07 16:53:46', '2022-03-07 16:53:46', NULL),
(71, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":[]}', '2022-03-07 16:54:03', '2022-03-07 16:54:03', NULL),
(72, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"primary_skills\":\"[]\",\"secondary_skills\":\"[]\",\"foundation_skills\":\"[]\",\"total_experience\":\"6\",\"total_experience_y\":\"5\",\"total_experience_m\":\"6\",\"relevant_experience_y\":0,\"relevant_experience_m\":0}}', '2022-03-07 16:57:46', '2022-03-07 16:57:46', NULL),
(73, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"relevant_experience\":\"2\",\"total_experience_y\":\"5\",\"total_experience_m\":\"6\",\"relevant_experience_y\":\"4\",\"relevant_experience_m\":\"2\"}}', '2022-03-07 17:00:17', '2022-03-07 17:00:17', NULL),
(74, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"total_experience_y\":\"5\",\"total_experience_m\":\"6\",\"relevant_experience_y\":\"4\",\"relevant_experience_m\":\"2\"}}', '2022-03-07 17:02:02', '2022-03-07 17:02:02', NULL),
(75, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"total_experience\":66,\"relevant_experience\":50,\"total_experience_y\":\"5\",\"total_experience_m\":\"6\",\"relevant_experience_y\":\"4\",\"relevant_experience_m\":\"2\"}}', '2022-03-07 17:05:53', '2022-03-07 17:05:53', NULL),
(76, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"total_experience_y\":5,\"total_experience_m\":6,\"relevant_experience_y\":4,\"relevant_experience_m\":2}}', '2022-03-07 17:08:54', '2022-03-07 17:08:54', NULL),
(77, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"total_experience\":67,\"total_experience_y\":5,\"total_experience_m\":\"7\",\"relevant_experience_y\":4,\"relevant_experience_m\":2}}', '2022-03-07 17:11:05', '2022-03-07 17:11:05', NULL),
(78, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":[]}', '2022-03-07 17:11:56', '2022-03-07 17:11:56', NULL),
(79, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\"},{\\\"text\\\":\\\"AngularJs\\\"}]\",\"primary_skills_soundex\":\"P100 A524\"}}', '2022-03-07 18:02:11', '2022-03-07 18:02:11', NULL),
(80, 8, 'someshwar badade', 'created', 'profile', 24, '{\"academics\":{\"id\":\"\",\"profile_id\":\"24\",\"degree\":\"qrqwer\",\"university\":\"qwer\",\"institution\":\"weqr\",\"from_date\":\"Feb 2022\",\"to_date\":\"Mar 2022\",\"course_type\":\"wqwer\",\"percentage\":\"243\",\"document_path\":\"\"}}', '2022-03-07 18:18:37', '2022-03-07 18:18:37', NULL),
(81, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"degree\":\"qrqwer2423\"}}', '2022-03-07 18:18:45', '2022-03-07 18:18:45', NULL),
(82, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"document_path\":\"profile_24\\/1646657336_20be97b95774b3d7cba1.jpg\"}}', '2022-03-07 18:18:56', '2022-03-07 18:18:56', NULL),
(83, 8, 'someshwar badade', 'created', 'profile', 24, '{\"professional_qualification\":{\"id\":\"\",\"profile_id\":\"24\",\"qualification\":\"34aasdfa\",\"category\":\"asf\",\"date\":\"Mar 2022\",\"document_path\":\"profile_24\\/1646657348_f702a2acada82950a370.png\"}}', '2022-03-07 18:19:08', '2022-03-07 18:19:08', NULL),
(84, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":\"{\\\"employers\\\":[{\\\"position_held\\\":\\\"\\\",\\\"from_date\\\":\\\"Dec 2021\\\",\\\"to_date\\\":\\\"Mar 2022\\\",\\\"company\\\":\\\"afasf\\\",\\\"department\\\":\\\"\\\",\\\"nature_of_job\\\":\\\"\\\",\\\"address\\\":\\\"\\\",\\\"city\\\":\\\"\\\",\\\"telephone\\\":\\\"\\\",\\\"job_responsibilities\\\":\\\"afasf\\\",\\\"annual_ctc\\\":\\\"\\\",\\\"reporting_manager\\\":\\\"\\\",\\\"contact_number_manager\\\":\\\"\\\",\\\"email_manager\\\":\\\"\\\",\\\"reason_of_leaving\\\":\\\"\\\",\\\"hr_name\\\":\\\"\\\",\\\"hr_contact_number\\\":\\\"\\\",\\\"hr_email\\\":\\\"\\\",\\\"hr_designation\\\":\\\"\\\"}]}\"}', '2022-03-07 18:19:39', '2022-03-07 18:19:39', NULL),
(85, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"documents\":{\"pan_card\":{\"path\":\"profile_24\\/1646657781_4abb62f071cfba676860.png\",\"file_name\":\"html5.png\",\"documentNote\":\"\"}}}', '2022-03-07 18:26:21', '2022-03-07 18:26:21', NULL),
(86, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"AngularJs\\\"}]\"}}', '2022-03-07 18:26:42', '2022-03-07 18:26:42', NULL),
(87, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"personal_details\":{\"employee_other_details\":[]}}', '2022-03-08 11:35:40', '2022-03-08 11:35:40', NULL),
(88, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"personal_details\":{\"employee_other_details\":[]}}', '2022-03-08 11:41:10', '2022-03-08 11:41:10', NULL),
(89, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"personal_details\":{\"mother_name\":\"\"}}', '2022-03-08 12:03:53', '2022-03-08 12:03:53', NULL),
(90, 8, 'someshwar badade', 'created', 'joining_form', 7, '{\"academics\":{\"id\":\"\",\"joining_form_id\":\"7\",\"degree\":\"qerq\",\"university\":\"qwer\",\"institution\":\"qerqwer\",\"from_date\":\"Nov 2021\",\"to_date\":\"Mar 2022\",\"course_type\":\"erqwer\",\"percentage\":\"24\",\"document_path\":\"\"}}', '2022-03-08 12:04:38', '2022-03-08 12:04:38', NULL),
(91, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"documents\":\"cheque\"}', '2022-03-08 12:06:15', '2022-03-08 12:06:15', NULL),
(92, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"documents\":\"aadhar_card\"}', '2022-03-08 12:06:19', '2022-03-08 12:06:19', NULL),
(93, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"documents\":\"pan_card\"}', '2022-03-08 12:06:21', '2022-03-08 12:06:21', NULL),
(94, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"documents\":{\"aadhar_card\":{\"path\":\"form_7\\/1646721443_b3ced76f83896d42ee12.png\",\"file_name\":\"html5.png\",\"documentNote\":\"\"}}}', '2022-03-08 12:07:23', '2022-03-08 12:07:23', NULL),
(95, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"documents\":{\"cheque\":{\"path\":\"form_7\\/1646721451_c30589ac32dca1d7dff3.jpg\",\"file_name\":\"badge.jpg\",\"documentNote\":\"\"}}}', '2022-03-08 12:07:31', '2022-03-08 12:07:31', NULL),
(96, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"academics\":{\"document_path\":\"form_7\\/1646721471_4f2386af50ae0716c5a5.png\"}}', '2022-03-08 12:07:51', '2022-03-08 12:07:51', NULL),
(97, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"documents\":{\"pan_card\":{\"path\":\"form_7\\/1646721495_cd6f933d7fca0b216ce5.png\",\"file_name\":\"unite-converter-purpal.png\",\"documentNote\":\"\"}}}', '2022-03-08 12:08:15', '2022-03-08 12:08:15', NULL),
(98, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-08 13:38:47\"}', '2022-03-08 13:38:47', '2022-03-08 13:38:47', NULL),
(99, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-08 15:13:13\"}', '2022-03-08 15:13:13', '2022-03-08 15:13:13', NULL),
(100, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"personal_details\":{\"mother_name\":\"Suman\",\"employee_other_details\":{\"bank_name_branch\":\"adfqrqwerw\",\"bank_account_number\":\"2234242344234\",\"medical_condition\":\"no\"}}}', '2022-03-08 15:13:48', '2022-03-08 15:13:48', NULL),
(101, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"academics\":{\"degree\":\"qerq23\",\"university\":\"qwer23\",\"institution\":\"qerqwer23\",\"course_type\":\"erqwer23\",\"percentage\":\"242\"}}', '2022-03-08 15:14:24', '2022-03-08 15:14:24', NULL),
(102, 8, 'someshwar badade', 'created', 'joining_form', 7, '{\"professional_qualification\":{\"id\":\"\",\"joining_form_id\":\"7\",\"qualification\":\"qewr\",\"category\":\"qerw\",\"date\":\"Jan 2022\",\"document_path\":\"form_7\\/1646732924_5b1357783ba4cac4ec57.png\"}}', '2022-03-08 15:18:44', '2022-03-08 15:18:44', NULL),
(103, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"professional_qualification\":{\"qualification\":\"qewr12\",\"category\":\"qerw12\"}}', '2022-03-08 15:18:57', '2022-03-08 15:18:57', NULL),
(104, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"professional_qualification\":{\"id\":\"1\",\"joining_form_id\":\"7\",\"qualification\":\"qewr12\",\"category\":\"qerw12\",\"date\":\"Jan 2022\",\"document_path\":\"form_7\\/1646732924_5b1357783ba4cac4ec57.png\",\"created_at\":\"2022-03-08 15:18:44\",\"updated_at\":\"2022-03-08 15:18:57\",\"deleted_at\":null}}', '2022-03-08 15:19:03', '2022-03-08 15:19:03', NULL),
(105, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"academics\":{\"id\":\"5\",\"joining_form_id\":\"7\",\"degree\":\"qerq23\",\"university\":\"qwer23\",\"institution\":\"qerqwer23\",\"from_date\":\"Nov 2021\",\"to_date\":\"Mar 2022\",\"course_type\":\"erqwer23\",\"percentage\":\"242\",\"document_path\":\"form_7\\/1646721471_4f2386af50ae0716c5a5.png\",\"created_at\":\"2022-03-08 12:04:38\",\"updated_at\":\"2022-03-08 15:14:24\",\"deleted_at\":null}}', '2022-03-08 15:19:11', '2022-03-08 15:19:11', NULL),
(106, 8, 'someshwar badade', 'created', 'joining_form', 7, '{\"employment\":{\"joining_form_id\":\"7\",\"company\":\"qrqewr\",\"nature_of_job\":\"Part Time\",\"reporting_manager\":\"wre\",\"contact_number_manager\":\"w2423\",\"email_manager\":\"24234af@afd.dd\"}}', '2022-03-08 15:19:43', '2022-03-08 15:19:43', NULL),
(107, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"employment\":{\"department\":\"qwer\",\"position_held\":\"wer\",\"job_responsibilities\":\"werw\",\"annual_ctc\":\"23\",\"address\":\"qrqewr\",\"city\":\"pun3\",\"hr_name\":\"afasf\",\"hr_contact_number\":\"asf24234\",\"hr_email\":\"asfas@adfsa.dd\",\"hr_designation\":\"asdfs\"}}', '2022-03-08 15:20:12', '2022-03-08 15:20:12', NULL),
(108, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"employment\":{\"id\":\"20\",\"joining_form_id\":\"7\",\"company\":\"qrqewr\",\"department\":\"qwer\",\"position_held\":\"wer\",\"from_date\":null,\"to_date\":null,\"nature_of_job\":\"Part Time\",\"job_responsibilities\":\"werw\",\"annual_ctc\":\"23\",\"address\":\"qrqewr\",\"city\":\"pun3\",\"telephone\":null,\"reporting_manager\":\"wre\",\"contact_number_manager\":\"w2423\",\"email_manager\":\"24234af@afd.dd\",\"reason_of_leaving\":null,\"hr_name\":\"afasf\",\"hr_contact_number\":\"asf24234\",\"hr_email\":\"asfas@adfsa.dd\",\"hr_designation\":\"asdfs\",\"created_at\":\"2022-03-08 15:19:43\",\"updated_at\":\"2022-03-08 15:20:12\",\"deleted_at\":null}}', '2022-03-08 15:20:59', '2022-03-08 15:20:59', NULL),
(109, 8, 'someshwar badade', 'created', 'joining_form', 7, '{\"gap_declaration\":{\"id\":\"\",\"joining_form_id\":\"7\",\"particular\":\"erq\",\"from_date\":\"Sep 2021\",\"to_date\":\"Mar 2022\",\"document_path\":\"form_7\\/1646733081_02ca596587d550064b98.png\"}}', '2022-03-08 15:21:21', '2022-03-08 15:21:21', NULL),
(110, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"academics\":{\"particular\":\"erq2343\",\"to_date\":\"Feb 2022\"}}', '2022-03-08 15:21:33', '2022-03-08 15:21:33', NULL),
(111, 8, 'someshwar badade', 'deleted', 'joining_form', 7, '{\"gap_declaration\":{\"id\":\"2\",\"joining_form_id\":\"7\",\"particular\":\"erq2343\",\"from_date\":\"Sep 2021\",\"to_date\":\"Feb 2022\",\"document_path\":\"form_7\\/1646733081_02ca596587d550064b98.png\",\"created_at\":\"2022-03-08 15:21:21\",\"updated_at\":\"2022-03-08 15:21:33\",\"deleted_at\":null}}', '2022-03-08 15:21:43', '2022-03-08 15:21:43', NULL),
(112, 8, 'someshwar badade', 'created', 'joining_form', 7, '{\"mediclaim\":{\"id\":\"\",\"joining_form_id\":\"7\",\"name\":\"wrtwert\",\"relationship\":\"twert\",\"dob\":\"04-Jan-2022\",\"age\":0,\"document_path\":\"form_7\\/1646733142_26aa5fc7c96694132d31.png\"}}', '2022-03-08 15:22:22', '2022-03-08 15:22:22', NULL),
(113, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"background_info\":[]}', '2022-03-08 15:22:36', '2022-03-08 15:22:36', NULL),
(114, 8, 'someshwar badade', 'updated', 'joining_form', 7, '{\"accept_declaration\":\"Yes\"}', '2022-03-08 15:23:09', '2022-03-08 15:23:09', NULL),
(115, 9, 'Somesh Badade', 'created', 'joining_form', 1, '{\"first_name\":\"Mayur\",\"last_name\":\"Samrit\",\"email_primary\":\"mayur.sasmrit@bitstringit.in\",\"aadhar_number\":\"000000000000\",\"pan_number\":\"AAAAA1111A\",\"updated_by\":\"9\",\"verification_code\":\"31114641\",\"user_id\":20}', '2022-03-08 16:59:44', '2022-03-08 16:59:44', NULL),
(116, 9, 'Somesh Badade', 'created', 'joining_form', 1, '{\"first_name\":\"mayur\",\"last_name\":\"samrit\",\"email_primary\":\"mayur.samrit@bitstringit.in\",\"aadhar_number\":\"111111111111\",\"pan_number\":\"AAAAA1111A\",\"updated_by\":\"9\",\"verification_code\":\"19133725\",\"user_id\":21}', '2022-03-08 17:05:15', '2022-03-08 17:05:15', NULL),
(117, 21, 'mayur samrit', 'created', 'login', 21, '{\"login\":\"2022-03-08 17:06:52\"}', '2022-03-08 17:06:52', '2022-03-08 17:06:52', NULL),
(118, 20, 'Mayur Samrit', 'created', 'login', 20, '{\"login\":\"2022-03-08 17:07:48\"}', '2022-03-08 17:07:48', '2022-03-08 17:07:48', NULL),
(119, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-09 10:36:08\"}', '2022-03-09 10:36:08', '2022-03-09 10:36:08', NULL),
(120, 9, 'Somesh Badade', 'updated', 'joining_form', 7, '{\"message\":\"Joining form approved.\"}', '2022-03-09 10:42:06', '2022-03-09 10:42:06', NULL),
(121, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-09 12:45:57\"}', '2022-03-09 12:45:57', '2022-03-09 12:45:57', NULL),
(122, 0, '', 'created', 'user', 22, '{\"id\":\"22\",\"user_type\":\"0\",\"user_role\":null,\"owner_id\":null,\"fname\":\"Avinash\",\"lname\":\"Gunjkar\",\"email\":\"avinash@bitstringit.in\",\"mobile\":\"\",\"company_name\":null,\"address\":null,\"country\":null,\"state\":null,\"city\":null,\"pincode\":null,\"password\":\"$2y$10$CN12St8oiBTHXep3TzXOgei8IIrkZNga.0ywdldlWTtCy2\\/gSVzH6\",\"profile_picture\":null,\"ip_address\":null,\"status\":\"1\",\"verification_code\":null,\"last_login\":\"2022-03-09 13:00:23\",\"created_at\":\"2022-03-09 13:00:23\",\"updated_at\":\"2022-03-09 13:00:23\",\"deleted_at\":null}', '2022-03-09 13:00:23', '2022-03-09 13:00:23', NULL),
(123, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-09 13:36:58\"}', '2022-03-09 13:36:58', '2022-03-09 13:36:58', NULL),
(124, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-09 13:49:48\"}', '2022-03-09 13:49:48', '2022-03-09 13:49:48', NULL),
(125, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"8\\\"},{\\\"text\\\":\\\"AngularJs\\\",\\\"rating\\\":\\\"7\\\"}]\"}}', '2022-03-09 13:50:16', '2022-03-09 13:50:16', NULL),
(126, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-09 14:37:10\"}', '2022-03-09 14:37:10', '2022-03-09 14:37:10', NULL),
(127, 23, 'abc abc', 'created', 'login', 23, '{\"login\":\"2022-03-09 14:59:39\"}', '2022-03-09 14:59:39', '2022-03-09 14:59:39', NULL),
(128, 23, 'abc abc', 'updated', 'profile', 16, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"JAVA\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"Chef\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"7\\\"},{\\\"text\\\":\\\"AngularJs 6\\\",\\\"rating\\\":\\\"8\\\"}]\",\"secondary_skills\":\"[{\\\"text\\\":\\\"Oracle\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"Mysql\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"Mogodb\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"7\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"9\\\"}]\",\"primary_skills_soundex\":\"J100 H354 C100 P100 A524\",\"secondary_skills_soundex\":\"O624 M240 M231 P100 H354\",\"foundation_skills_soundex\":\"\"}}', '2022-03-09 15:00:11', '2022-03-09 15:00:11', NULL),
(129, 23, 'abc abc', 'updated', 'profile', 16, '{\"personal_details\":{\"foundation_skills\":\"[]\"}}', '2022-03-09 15:00:17', '2022-03-09 15:00:17', NULL),
(130, 24, 'pqr pqr', 'created', 'login', 24, '{\"login\":\"2022-03-09 15:02:39\"}', '2022-03-09 15:02:39', '2022-03-09 15:02:39', NULL),
(131, 24, 'pqr pqr', 'updated', 'profile', 17, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"4\\\"},{\\\"text\\\":\\\"Java\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"Python\\\",\\\"rating\\\":\\\"3\\\"},{\\\"text\\\":\\\"Docker\\\",\\\"rating\\\":\\\"4\\\"}]\",\"secondary_skills\":\"[{\\\"text\\\":\\\"Javascript\\\",\\\"rating\\\":\\\"2\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"3\\\"},{\\\"text\\\":\\\"Mysql\\\",\\\"rating\\\":\\\"1\\\"},{\\\"text\\\":\\\"HTML 5\\\",\\\"rating\\\":\\\"3\\\"}]\",\"foundation_skills\":\"[]\",\"primary_skills_soundex\":\"P100 J100 P350 D260\",\"secondary_skills_soundex\":\"J126 H354 M240 H354\",\"foundation_skills_soundex\":\"\"}}', '2022-03-09 15:03:11', '2022-03-09 15:03:11', NULL),
(132, 25, 'Ajay Kumar', 'created', 'login', 25, '{\"login\":\"2022-03-09 15:03:35\"}', '2022-03-09 15:03:35', '2022-03-09 15:03:35', NULL),
(133, 25, 'Ajay Kumar', 'updated', 'profile', 18, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"10\\\"},{\\\"text\\\":\\\"Java\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"Python\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"Javascript\\\",\\\"rating\\\":\\\"7\\\"},{\\\"text\\\":\\\"jQuery\\\",\\\"rating\\\":\\\"7\\\"},{\\\"text\\\":\\\"Css\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"MySql\\\",\\\"rating\\\":\\\"4\\\"}]\",\"secondary_skills\":\"[{\\\"text\\\":\\\"Javascript\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"3\\\"},{\\\"text\\\":\\\"Oracle\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"HTML 5\\\",\\\"rating\\\":\\\"7\\\"}]\",\"foundation_skills\":\"[]\",\"primary_skills_soundex\":\"P100 J100 P350 J126 J600 C000 M240\",\"secondary_skills_soundex\":\"J126 H354 O624 H354\",\"foundation_skills_soundex\":\"\"}}', '2022-03-09 15:04:48', '2022-03-09 15:04:48', NULL),
(134, 26, 'Rakesh Kumar', 'created', 'login', 26, '{\"login\":\"2022-03-09 15:05:22\"}', '2022-03-09 15:05:23', '2022-03-09 15:05:23', NULL),
(135, 26, 'Rakesh Kumar', 'updated', 'profile', 19, '{\"personal_details\":{\"mobile_primary\":\"1234567667\",\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"Java\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"Python\\\",\\\"rating\\\":\\\"7\\\"},{\\\"text\\\":\\\"Pupet\\\",\\\"rating\\\":\\\"8\\\"},{\\\"text\\\":\\\"AngularJs 8\\\",\\\"rating\\\":\\\"9\\\"}]\",\"secondary_skills\":\"[{\\\"text\\\":\\\"Javascript\\\",\\\"rating\\\":\\\"6\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"5\\\"},{\\\"text\\\":\\\"Mysql\\\",\\\"rating\\\":\\\"4\\\"},{\\\"text\\\":\\\"HTML 5\\\",\\\"rating\\\":\\\"3\\\"}]\",\"foundation_skills\":\"[]\",\"primary_skills_soundex\":\"P100 J100 P350 P130 A524\",\"secondary_skills_soundex\":\"J126 H354 M240 H354\",\"foundation_skills_soundex\":\"\"}}', '2022-03-09 15:06:12', '2022-03-09 15:06:12', NULL),
(136, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-10 17:45:50\"}', '2022-03-10 17:45:50', '2022-03-10 17:45:50', NULL),
(137, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-11 10:44:02\"}', '2022-03-11 10:44:02', '2022-03-11 10:44:02', NULL),
(138, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-11 12:06:01\"}', '2022-03-11 12:06:01', '2022-03-11 12:06:01', NULL),
(139, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"first_name\":\"someshwar\"}}', '2022-03-11 13:44:36', '2022-03-11 13:44:36', NULL),
(140, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"present_address\":\"Pune, Maharashtra\",\"present_address_postcode\":\"411015\"}}', '2022-03-11 13:51:58', '2022-03-11 13:51:58', NULL),
(141, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"degree\":\"BE Computer\",\"university\":\"Pune University\",\"institution\":\"S.C.S.C.O.E. Rahuri Factory, Ahmednagar\",\"from_date\":\"Aug 2010\",\"to_date\":\"May 2013\",\"course_type\":\"Full time\",\"percentage\":\"60\"}}', '2022-03-11 14:27:13', '2022-03-11 14:27:13', NULL),
(142, 8, 'someshwar badade', 'created', 'profile', 24, '{\"academics\":{\"id\":\"\",\"profile_id\":\"24\",\"degree\":\"Diploma In Computer\",\"university\":\"MSBTE\",\"institution\":\"Goverment Polytechnic Beed\",\"from_date\":\"Aug 2008\",\"to_date\":\"May 2010\",\"course_type\":\"Full time\",\"percentage\":\"70\",\"document_path\":\"\"}}', '2022-03-11 14:28:19', '2022-03-11 14:28:19', NULL),
(143, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"professional_qualification\":{\"qualification\":\"Certification 1\",\"date\":\"Mar 2020\"}}', '2022-03-11 14:33:29', '2022-03-11 14:33:29', NULL),
(144, 8, 'someshwar badade', 'created', 'profile', 24, '{\"professional_qualification\":{\"id\":\"\",\"profile_id\":\"24\",\"qualification\":\"Certification 2\",\"category\":\"test\",\"date\":\"Aug 2020\",\"document_path\":\"\"}}', '2022-03-11 14:33:48', '2022-03-11 14:33:48', NULL),
(145, 8, 'someshwar badade', 'created', 'profile', 24, '{\"professional_qualification\":{\"id\":\"\",\"profile_id\":\"24\",\"qualification\":\"Certification 3\",\"category\":\"test\",\"date\":\"Jan 2022\",\"document_path\":\"\"}}', '2022-03-11 14:34:11', '2022-03-11 14:34:11', NULL),
(146, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-11 14:47:47\"}', '2022-03-11 14:47:47', '2022-03-11 14:47:47', NULL),
(147, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-11 14:50:09\"}', '2022-03-11 14:50:09', '2022-03-11 14:50:09', NULL),
(148, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":\"{\\\"employers\\\":[{\\\"position_held\\\":\\\"Sr software Developer\\\",\\\"from_date\\\":\\\"Jul 2020\\\",\\\"to_date\\\":\\\"Mar 2022\\\",\\\"company\\\":\\\"Bitstring it services pvt. ltd.\\\",\\\"department\\\":\\\"\\\",\\\"nature_of_job\\\":\\\"\\\",\\\"address\\\":\\\"D-223, Palediam exotica, Dhanori\\\",\\\"city\\\":\\\"Pune\\\",\\\"telephone\\\":\\\"\\\",\\\"job_responsibilities\\\":\\\"Database design, Codeing, Project Deployment\\\",\\\"annual_ctc\\\":\\\"\\\",\\\"reporting_manager\\\":\\\"\\\",\\\"contact_number_manager\\\":\\\"\\\",\\\"email_manager\\\":\\\"\\\",\\\"reason_of_leaving\\\":\\\"\\\",\\\"hr_name\\\":\\\"\\\",\\\"hr_contact_number\\\":\\\"\\\",\\\"hr_email\\\":\\\"\\\",\\\"hr_designation\\\":\\\"\\\"},{\\\"position_held\\\":\\\"Jr Software Developer\\\",\\\"from_date\\\":\\\"Jan 2016\\\",\\\"to_date\\\":\\\"Jun 2020\\\",\\\"company\\\":\\\"Essensys Software pvt. ltd.\\\",\\\"department\\\":\\\"\\\",\\\"nature_of_job\\\":\\\"\\\",\\\"address\\\":\\\"SH-119, Shopers orbit, Vistrantwadi\\\",\\\"city\\\":\\\"Pune\\\",\\\"telephone\\\":\\\"\\\",\\\"job_responsibilities\\\":\\\"Database design, Codeing,\\\",\\\"annual_ctc\\\":\\\"\\\",\\\"reporting_manager\\\":\\\"\\\",\\\"contact_number_manager\\\":\\\"\\\",\\\"email_manager\\\":\\\"\\\",\\\"reason_of_leaving\\\":\\\"\\\",\\\"hr_name\\\":\\\"\\\",\\\"hr_contact_number\\\":\\\"\\\",\\\"hr_email\\\":\\\"\\\",\\\"hr_designation\\\":\\\"\\\"}]}\"}', '2022-03-11 14:57:55', '2022-03-11 14:57:55', NULL),
(149, 8, 'someshwar badade', 'created', 'profile', 24, '{\"academics\":{\"id\":\"\",\"profile_id\":\"24\",\"degree\":\"HSC\",\"university\":\"Pune\",\"institution\":\"z. p. Boys School\",\"from_date\":\"Jun 2001\",\"to_date\":\"Jun 2002\",\"course_type\":\"full time\",\"percentage\":\"62\",\"document_path\":\"\"}}', '2022-03-11 17:18:13', '2022-03-11 17:18:13', NULL),
(150, 8, 'someshwar badade', 'created', 'profile', 24, '{\"academics\":{\"id\":\"\",\"profile_id\":\"24\",\"degree\":\"SSC\",\"university\":\"Pune\",\"institution\":\"z.p. Boys school\",\"from_date\":\"Jun 2002\",\"to_date\":\"Jun 2004\",\"course_type\":\"Full time\",\"percentage\":\"65\",\"document_path\":\"\"}}', '2022-03-11 17:22:50', '2022-03-11 17:22:50', NULL),
(151, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":{\"institution\":\"p.j.n. collage\"}}', '2022-03-11 17:23:07', '2022-03-11 17:23:07', NULL),
(152, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"academics\":\"{\\\"employers\\\":[{\\\"position_held\\\":\\\"Sr software Developer\\\",\\\"from_date\\\":\\\"Jul 2020\\\",\\\"to_date\\\":\\\"Mar 2022\\\",\\\"company\\\":\\\"Bitstring it services pvt. ltd.\\\",\\\"department\\\":\\\"\\\",\\\"nature_of_job\\\":\\\"\\\",\\\"address\\\":\\\"D-223, Palediam exotica, Dhanori\\\",\\\"city\\\":\\\"Pune\\\",\\\"telephone\\\":\\\"\\\",\\\"job_responsibilities\\\":\\\"Database design, Codeing, Project Deployment\\\",\\\"annual_ctc\\\":\\\"\\\",\\\"reporting_manager\\\":\\\"\\\",\\\"contact_number_manager\\\":\\\"\\\",\\\"email_manager\\\":\\\"\\\",\\\"reason_of_leaving\\\":\\\"\\\",\\\"hr_name\\\":\\\"\\\",\\\"hr_contact_number\\\":\\\"\\\",\\\"hr_email\\\":\\\"\\\",\\\"hr_designation\\\":\\\"\\\"},{\\\"position_held\\\":\\\"Jr Software Developer\\\",\\\"from_date\\\":\\\"Jan 2016\\\",\\\"to_date\\\":\\\"Jun 2020\\\",\\\"company\\\":\\\"Essensys Software pvt. ltd.\\\",\\\"department\\\":\\\"\\\",\\\"nature_of_job\\\":\\\"\\\",\\\"address\\\":\\\"SH-119, Shopers orbit, Vistrantwadi\\\",\\\"city\\\":\\\"Pune\\\",\\\"telephone\\\":\\\"\\\",\\\"job_responsibilities\\\":\\\"Database design, Codeing,\\\",\\\"annual_ctc\\\":\\\"\\\",\\\"reporting_manager\\\":\\\"\\\",\\\"contact_number_manager\\\":\\\"\\\",\\\"email_manager\\\":\\\"\\\",\\\"reason_of_leaving\\\":\\\"\\\",\\\"hr_name\\\":\\\"\\\",\\\"hr_contact_number\\\":\\\"\\\",\\\"hr_email\\\":\\\"\\\",\\\"hr_designation\\\":\\\"\\\"},{\\\"position_held\\\":\\\"Data entry operator\\\",\\\"from_date\\\":\\\"FEB 2015\\\",\\\"to_date\\\":\\\"DEC 2015\\\",\\\"company\\\":\\\"TCS\\\",\\\"department\\\":\\\"\\\",\\\"nature_of_job\\\":\\\"\\\",\\\"address\\\":\\\"Bhosari\\\",\\\"city\\\":\\\"Pune\\\",\\\"telephone\\\":\\\"\\\",\\\"job_responsibilities\\\":\\\"data entry\\\",\\\"annual_ctc\\\":\\\"\\\",\\\"reporting_manager\\\":\\\"\\\",\\\"contact_number_manager\\\":\\\"\\\",\\\"email_manager\\\":\\\"\\\",\\\"reason_of_leaving\\\":\\\"\\\",\\\"hr_name\\\":\\\"\\\",\\\"hr_contact_number\\\":\\\"\\\",\\\"hr_email\\\":\\\"\\\",\\\"hr_designation\\\":\\\"\\\"}]}\"}', '2022-03-11 17:26:00', '2022-03-11 17:26:00', NULL),
(153, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-14 10:29:30\"}', '2022-03-14 10:29:30', '2022-03-14 10:29:30', NULL),
(154, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-14 12:03:15\"}', '2022-03-14 12:03:15', '2022-03-14 12:03:15', NULL),
(155, 0, '', 'created', 'user', 27, '{\"id\":\"27\",\"user_type\":\"0\",\"user_role\":null,\"owner_id\":null,\"fname\":\"abc\",\"lname\":\"xyz\",\"email\":\"abc@nomaill.com\",\"mobile\":\"\",\"company_name\":null,\"address\":null,\"country\":null,\"state\":null,\"city\":null,\"pincode\":null,\"password\":\"$2y$10$q1r9\\/SyIxhUFpkytSc1udu9RIrx8QZWMADjjGPp7pFQc\\/Rrc86te6\",\"profile_picture\":null,\"ip_address\":null,\"status\":\"1\",\"verification_code\":null,\"last_login\":\"2022-03-14 12:16:36\",\"created_at\":\"2022-03-14 12:16:36\",\"updated_at\":\"2022-03-14 12:16:36\",\"deleted_at\":null}', '2022-03-14 12:16:36', '2022-03-14 12:16:36', NULL),
(156, 27, 'abc xyz', 'created', 'profile', 25, '{\"message\":\"created profile\"}', '2022-03-14 12:17:43', '2022-03-14 12:17:43', NULL),
(157, 27, 'abc xyz', 'created', 'profile', 25, '{\"academics\":{\"id\":\"\",\"degree\":\"werqewr\",\"university\":\"werqwer\",\"institution\":\"qwer\",\"from_date\":\"Sep 2021\",\"to_date\":\"Mar 2022\",\"course_type\":\"qrqwer\",\"percentage\":\"23\",\"document_path\":\"\"}}', '2022-03-14 12:32:06', '2022-03-14 12:32:06', NULL),
(158, 27, 'abc xyz', 'created', 'profile', 25, '{\"academics\":{\"id\":\"\",\"degree\":\"qerqr\",\"university\":\"wrwr\",\"institution\":\"werwr\",\"from_date\":\"Apr 2021\",\"to_date\":\"Mar 2022\",\"course_type\":\"wrwer\",\"percentage\":\"234\",\"document_path\":\"\",\"profile_id\":\"25\"}}', '2022-03-14 12:35:39', '2022-03-14 12:35:39', NULL),
(159, 27, 'abc xyz', 'created', 'profile', 25, '{\"academics\":{\"id\":\"\",\"degree\":\"qwerqe\",\"university\":\"wrwe\",\"institution\":\"qwerqw\",\"from_date\":\"Nov 2021\",\"to_date\":\"Mar 2022\",\"course_type\":\"wrwer\",\"percentage\":\"34\",\"document_path\":\"\",\"profile_id\":\"25\"}}', '2022-03-14 12:36:01', '2022-03-14 12:36:01', NULL),
(160, 27, 'abc xyz', 'updated', 'profile', 25, '{\"academics\":{\"degree\":\"qerqr 3434\"}}', '2022-03-14 12:36:12', '2022-03-14 12:36:12', NULL),
(161, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-14 14:29:44\"}', '2022-03-14 14:29:44', '2022-03-14 14:29:44', NULL),
(162, 9, 'Somesh Badade', 'updated', 'profile', 15, '{\"status\":\"2\"}', '2022-03-14 15:03:12', '2022-03-14 15:03:12', NULL),
(163, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-14 18:00:04\"}', '2022-03-14 18:00:04', '2022-03-14 18:00:04', NULL),
(164, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-14 18:23:54\"}', '2022-03-14 18:23:54', '2022-03-14 18:23:54', NULL),
(165, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-16 12:30:59\"}', '2022-03-16 12:30:59', '2022-03-16 12:30:59', NULL),
(166, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-23 14:05:38\"}', '2022-03-23 14:05:38', '2022-03-23 14:05:38', NULL),
(167, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-24 17:01:21\"}', '2022-03-24 17:01:21', '2022-03-24 17:01:21', NULL),
(168, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-25 18:50:21\"}', '2022-03-25 18:50:21', '2022-03-25 18:50:21', NULL),
(169, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-03-28 10:33:24\"}', '2022-03-28 10:33:24', '2022-03-28 10:33:24', NULL),
(170, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-28 14:32:26\"}', '2022-03-28 14:32:26', '2022-03-28 14:32:26', NULL),
(171, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-03-29 11:20:59\"}', '2022-03-29 11:20:59', '2022-03-29 11:20:59', NULL),
(172, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-07 10:40:12\"}', '2022-04-07 10:40:12', '2022-04-07 10:40:12', NULL),
(173, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-07 13:28:31\"}', '2022-04-07 13:28:31', '2022-04-07 13:28:31', NULL),
(174, 9, 'Somesh Badade', 'created', 'policyDocuments', 3, '{\"document_name\":\"ttt\",\"type\":\"File\",\"status\":\"Active\"}', '2022-04-07 17:11:06', '2022-04-07 17:11:06', NULL),
(175, 9, 'Somesh Badade', 'updated', 'policyDocuments', 3, '[]', '2022-04-07 17:13:09', '2022-04-07 17:13:09', NULL),
(176, 9, 'Somesh Badade', 'updated', 'policyDocuments', 3, '{\"file\":\"assets\\/policy-documents\\/1649332153_dd732837bfadce9d68a7.jpg\"}', '2022-04-07 17:19:13', '2022-04-07 17:19:13', NULL),
(177, 9, 'Somesh Badade', 'updated', 'policyDocuments', 3, '{\"file\":\"assets\\/policy-documents\\/1649332374_a5e190054ad545a57ab4.jpg\"}', '2022-04-07 17:22:54', '2022-04-07 17:22:54', NULL),
(178, 9, 'Somesh Badade', 'created', 'policyDocuments', 4, '{\"document_name\":\"qrqewrqre\",\"type\":\"File\",\"status\":\"Active\",\"file\":\"assets\\/policy-documents\\/1649332483_66fb5481bf1dc01dfc65.png\"}', '2022-04-07 17:24:43', '2022-04-07 17:24:43', NULL),
(179, 9, 'Somesh Badade', 'updated', 'policyDocuments', 4, '{\"file\":\"assets\\/policy-documents\\/1649335113_1a44040c0cce3c56a640.jpg\",\"file_name_original\":\"letterhead2.jpg\"}', '2022-04-07 18:08:33', '2022-04-07 18:08:33', NULL),
(180, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-08 10:02:22\"}', '2022-04-08 10:02:22', '2022-04-08 10:02:22', NULL);
INSERT INTO `action_log` (`id`, `user_id`, `action_by`, `action_type`, `model`, `record_id`, `chaged_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(181, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-08 10:46:24\"}', '2022-04-08 10:46:24', '2022-04-08 10:46:24', NULL),
(182, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-08 12:38:08\"}', '2022-04-08 12:38:08', '2022-04-08 12:38:08', NULL),
(183, 9, 'Somesh Badade', 'updated', 'policyDocuments', 4, '{\"document_name\":\"Holiday policy\",\"file\":\"assets\\/policy-documents\\/1649402397_1c6da9f36f04c2565f27.pdf\",\"file_name_original\":\"holidays-policy.pdf\"}', '2022-04-08 12:49:57', '2022-04-08 12:49:57', NULL),
(184, 9, 'Somesh Badade', 'updated', 'policyDocuments', 1, '{\"document_name\":\"Company Policy\",\"file\":\"assets\\/policy-documents\\/1649402430_23f22182d42df3cd5103.pdf\",\"file_name_original\":\"company-policy.pdf\"}', '2022-04-08 12:50:30', '2022-04-08 12:50:30', NULL),
(185, 9, 'Somesh Badade', 'updated', 'policyDocuments', 3, '{\"document_name\":\"Leave Policy\",\"file\":\"assets\\/policy-documents\\/1649402454_d802971cac525624486c.pdf\",\"file_name_original\":\"leave-policy.pdf\"}', '2022-04-08 12:50:54', '2022-04-08 12:50:54', NULL),
(186, 9, 'Somesh Badade', 'created', 'policyDocuments', 5, '{\"type\":\"File\",\"document_name\":\"026026\",\"status\":\"Active\"}', '2022-04-08 13:03:07', '2022-04-08 13:03:07', NULL),
(187, 9, 'Somesh Badade', 'updated', 'policyDocuments', 5, '{\"file\":\"assets\\/policy-documents\\/1649403234_7cf2a3b5d3ced51117ca.pdf\",\"file_name_original\":\"1649402454_d802971cac525624486c.pdf\"}', '2022-04-08 13:03:54', '2022-04-08 13:03:54', NULL),
(188, 9, 'Somesh Badade', 'updated', 'policyDocuments', 2, '{\"text\":\"<h1>title adsakd k asdfh h adfjh<br><\\/h1>\"}', '2022-04-08 15:56:29', '2022-04-08 15:56:29', NULL),
(189, 9, 'Somesh Badade', 'created', 'policyDocuments', 6, '{\"type\":\"Text\",\"document_name\":\"HTml content\",\"text\":\"<div>\\n<h2>What is Lorem Ipsum?<\\/h2>\\n<p><strong>Lorem Ipsum<\\/strong> is simply dummy text of the printing and\\n typesetting industry. Lorem Ipsum has been the industry\'s standard \\ndummy text ever since the 1500s, when an unknown printer took a galley \\nof type and scrambled it to make a type specimen book. It has survived \\nnot only five centuries, but also the leap into electronic typesetting, \\nremaining essentially unchanged. It was popularised in the 1960s with \\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\\n recently with desktop publishing software like Aldus PageMaker \\nincluding versions of Lorem Ipsum.<\\/p>\\n<\\/div><div>\\n<h2>Why do we use it?<\\/h2>\\n<p>It is a long established fact that a reader will be distracted by the\\n readable content of a page when looking at its layout. The point of \\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \\nletters, as opposed to using \'Content here, content here\', making it \\nlook like readable English. Many desktop publishing packages and web \\npage editors now use Lorem Ipsum as their default model text, and a \\nsearch for \'lorem ipsum\' will uncover many web sites still in their \\ninfancy. Various versions have evolved over the years, sometimes by \\naccident, sometimes on purpose (injected humour and the like).<\\/p>\\n<\\/div>\",\"status\":\"Active\"}', '2022-04-08 17:07:35', '2022-04-08 17:07:35', NULL),
(190, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-11 10:38:38\"}', '2022-04-11 10:38:38', '2022-04-11 10:38:38', NULL),
(191, 9, 'Somesh Badade', 'created', 'policyDocuments', 7, '{\"document_name\":\"test\",\"type\":\"Text\",\"text\":\"asdfsdf\",\"status\":\"Active\"}', '2022-04-11 10:51:02', '2022-04-11 10:51:02', NULL),
(192, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-11 11:53:01\"}', '2022-04-11 11:53:01', '2022-04-11 11:53:01', NULL),
(193, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-12 10:34:13\"}', '2022-04-12 10:34:13', '2022-04-12 10:34:13', NULL),
(194, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-15 10:07:34\"}', '2022-04-15 10:07:34', '2022-04-15 10:07:34', NULL),
(195, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"about_me\":\"THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is about me. THis is ab\"}}', '2022-04-15 10:21:45', '2022-04-15 10:21:45', NULL),
(196, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"about_me\":\"Associated with multiple companies to perform the role of Senior Software Engineer. Includes requirement analysis, architect flow of the project, daily scrum, task allocation in the team, database design as per modules\\/sections\\/add-on, coding, support to team members in the development, deployment, and innovation as per user experience in project flow as needed. Provide good quality products\\/web applications.\"}}', '2022-04-15 12:46:58', '2022-04-15 12:46:58', NULL),
(197, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"primary_skills\":\"[{\\\"text\\\":\\\"PHP\\\",\\\"rating\\\":\\\"8\\\"},{\\\"text\\\":\\\"AngularJs\\\",\\\"rating\\\":\\\"7\\\"},{\\\"text\\\":\\\"Java\\\",\\\"rating\\\":\\\"4\\\"},{\\\"text\\\":\\\"Javascript\\\",\\\"rating\\\":\\\"8\\\"},{\\\"text\\\":\\\"HTML\\\",\\\"rating\\\":\\\"8\\\"},{\\\"text\\\":\\\"MySql\\\",\\\"rating\\\":\\\"8\\\"},{\\\"text\\\":\\\"Android\\\",\\\"rating\\\":\\\"3\\\"},{\\\"text\\\":\\\"Codeigniter\\\",\\\"rating\\\":\\\"9\\\"},{\\\"text\\\":\\\"Laravel\\\",\\\"rating\\\":\\\"7\\\"}]\",\"primary_skills_soundex\":\"P100 A524 J100 J126 H354 M240 A536 C325 L614\"}}', '2022-04-15 12:47:59', '2022-04-15 12:47:59', NULL),
(198, 8, 'someshwar badade', 'created', 'profile', 24, '{\"projects\":{\"id\":\"\",\"title\":\"xyz\",\"description\":\"afsdsdf\",\"profile_id\":\"24\"}}', '2022-04-15 15:51:29', '2022-04-15 15:51:29', NULL),
(199, 8, 'someshwar badade', 'created', 'profile', 24, '{\"projects\":{\"id\":\"\",\"profile_id\":\"24\",\"title\":\"qwerqwr\",\"description\":\"werwer\"}}', '2022-04-15 15:53:22', '2022-04-15 15:53:22', NULL),
(200, 8, 'someshwar badade', 'created', 'profile', 24, '{\"projects\":{\"id\":\"\",\"profile_id\":\"24\",\"title\":\"qrqwer\",\"description\":\"werwer\"}}', '2022-04-15 15:53:57', '2022-04-15 15:53:57', NULL),
(201, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"description\":\"qrqwerew\"}}', '2022-04-15 15:58:11', '2022-04-15 15:58:11', NULL),
(202, 8, 'someshwar badade', 'created', 'profile', 24, '{\"projects\":{\"id\":\"\",\"profile_id\":\"24\",\"title\":\"qwerqwer\",\"description\":\"wrwerwer\"}}', '2022-04-15 15:58:21', '2022-04-15 15:58:21', NULL),
(203, 8, 'someshwar badade', 'created', 'profile', 24, '{\"projects\":{\"id\":\"\",\"profile_id\":\"24\",\"title\":\"qrqwer\",\"description\":\"wrwer\"}}', '2022-04-15 15:59:47', '2022-04-15 15:59:47', NULL),
(204, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"description\":\"adfadsf\"}}', '2022-04-15 16:19:37', '2022-04-15 16:19:37', NULL),
(205, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"description\":\"hka fjkahdfkjhsdkjf\"}}', '2022-04-15 16:20:40', '2022-04-15 16:20:40', NULL),
(206, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"description\":\"<div><b>The technology used: <\\/b>PHP, Codeigniter, Html, MySql<\\/div><div><b>About Project:<\\/b><\\/div><div>The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. <\\/div>\"}}', '2022-04-15 16:26:07', '2022-04-15 16:26:07', NULL),
(207, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"title\":\"Project 1\",\"description\":\"<div><b>The technology used: <\\/b>PHP, Codeigniter, Html, MySql<\\/div><div><b>Duration:<\\/b> 2 Years<br><\\/div><div><b>About Project:<\\/b><\\/div><div>The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. <\\/div>\"}}', '2022-04-15 16:35:05', '2022-04-15 16:35:05', NULL),
(208, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"title\":\"Project 2\",\"description\":\"<div><b>The technology used: <\\/b>PHP, Codeigniter, Html, MySql<\\/div><div><b>Duration:<\\/b> 2 Years<br><\\/div><div><b>About Project:<\\/b><\\/div><div>The\\n project is developed for so and so. The project is developed for so and\\n so. The project is developed for so and so. The project is developed \\nfor so and so. The project is developed for so and so. The project is \\ndeveloped for so and so. The project is developed for so and so. The \\nproject is developed for so and so. The project is developed for so and \\nso. <\\/div>\"}}', '2022-04-15 16:35:21', '2022-04-15 16:35:21', NULL),
(209, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"title\":\"Project 3\",\"description\":\"<div><b>The technology used: <\\/b>PHP, Codeigniter, Html, MySql<\\/div><div><b>Duration:<\\/b> 2 Years<br><\\/div><div><b>About Project:<\\/b><\\/div><div>The\\n project is developed for so and so. The project is developed for so and\\n so. The project is developed for so and so. The project is developed \\nfor so and so. The project is developed for so and so. The project is \\ndeveloped for so and so. The project is developed for so and so. The \\nproject is developed for so and so. The project is developed for so and \\nso. <\\/div>\"}}', '2022-04-15 16:35:32', '2022-04-15 16:35:32', NULL),
(210, 8, 'someshwar badade', 'created', 'profile', 24, '{\"projects\":{\"id\":\"\",\"profile_id\":\"24\",\"title\":\"test\",\"description\":\"test\"}}', '2022-04-15 16:35:50', '2022-04-15 16:35:50', NULL),
(211, 8, 'someshwar badade', 'deleted', 'profile', 24, '{\"projects\":{\"id\":\"6\",\"profile_id\":\"24\",\"title\":\"test\",\"description\":\"test\",\"created_at\":\"2022-04-15 16:35:50\",\"updated_at\":\"2022-04-15 16:35:50\",\"deleted_at\":null}}', '2022-04-15 16:37:35', '2022-04-15 16:37:35', NULL),
(212, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"title\":\"<h1>Project 1<\\/h1>\"}}', '2022-04-19 11:10:45', '2022-04-19 11:10:45', NULL),
(213, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-19 15:16:27\"}', '2022-04-19 15:16:27', '2022-04-19 15:16:27', NULL),
(214, 9, 'Somesh Badade', 'updated', 'emailTemplates', 1, '{\"body\":\"<div>Hello [user_first_name], <br><\\/div><div><br><\\/div><div><b>Welcome to Bistring. <\\/b><br><\\/div><div><br><\\/div><div><u>Thank you for your registration <\\/u><br><\\/div><div><br><\\/div><div>Thanks <br><\\/div><div>Bistring Team<\\/div>\"}', '2022-04-20 11:19:35', '2022-04-20 11:19:35', NULL),
(215, 9, 'Somesh Badade', 'updated', 'emailTemplates', 1, '[]', '2022-04-20 12:32:40', '2022-04-20 12:32:40', NULL),
(216, 9, 'Somesh Badade', 'updated', 'emailTemplates', 1, '{\"status\":\"Disable\"}', '2022-04-20 15:54:59', '2022-04-20 15:54:59', NULL),
(217, 9, 'Somesh Badade', 'updated', 'emailTemplates', 1, '{\"body\":\"<div>Hello [user_first_name], <br><\\/div><div><br><\\/div><div><b>Welcome to Bistring. <\\/b><br><\\/div><div><br><\\/div><div><u>Thank you for your registration <\\/u><br><\\/div><div><br><\\/div><div>Thanks <br><\\/div><div>Bitstring Team<\\/div>\"}', '2022-04-20 16:59:28', '2022-04-20 16:59:28', NULL),
(218, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-21 10:17:37\"}', '2022-04-21 10:17:37', '2022-04-21 10:17:37', NULL),
(219, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-21 10:17:37\"}', '2022-04-21 10:17:37', '2022-04-21 10:17:37', NULL),
(220, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-21 10:25:22\"}', '2022-04-21 10:25:22', '2022-04-21 10:25:22', NULL),
(221, 9, 'Somesh Badade', 'updated', 'client', 1, '[]', '2022-04-21 15:12:49', '2022-04-21 15:12:49', NULL),
(222, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(223, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(224, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":null}', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(225, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(226, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(227, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(228, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":null}', '2022-04-21 16:13:23', '2022-04-21 16:13:23', NULL),
(229, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(230, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(231, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":null}', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(232, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(233, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(234, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(235, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":null}', '2022-04-21 16:16:05', '2022-04-21 16:16:05', NULL),
(236, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(237, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(238, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":null}', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(239, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(240, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(241, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(242, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-21 16:20:57', '2022-04-21 16:20:57', NULL),
(243, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(244, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(245, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650538345_1c5bcb9e6955bf70c8d0.png\"}', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(246, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(247, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(248, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(249, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-21 16:22:25', '2022-04-21 16:22:25', NULL),
(250, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-22 15:41:03\"}', '2022-04-22 15:41:03', '2022-04-22 15:41:03', NULL),
(251, 9, 'Somesh Badade', 'updated', 'emailTemplates', 2, '{\"body\":\"test\",\"status\":\"Enable\"}', '2022-04-22 15:53:25', '2022-04-22 15:53:25', NULL),
(252, 9, 'Somesh Badade', 'updated', 'emailTemplates', 1, '{\"status\":\"Enable\"}', '2022-04-22 15:53:33', '2022-04-22 15:53:33', NULL),
(253, 9, 'Somesh Badade', 'updated', 'emailTemplates', 6, '{\"body\":\"<br>\"}', '2022-04-22 16:12:25', '2022-04-22 16:12:25', NULL),
(254, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-25 10:02:52\"}', '2022-04-25 10:02:52', '2022-04-25 10:02:52', NULL),
(255, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(256, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(257, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650538345_1c5bcb9e6955bf70c8d0.png\"}', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(258, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(259, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(260, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(261, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 10:25:10', '2022-04-25 10:25:10', NULL),
(262, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(263, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(264, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650538345_1c5bcb9e6955bf70c8d0.png\"}', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(265, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(266, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(267, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(268, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-25 10:32:11', '2022-04-25 10:32:11', NULL),
(269, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(270, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(271, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650538345_1c5bcb9e6955bf70c8d0.png\"}', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(272, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(273, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(274, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(275, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 10:42:18', '2022-04-25 10:42:18', NULL),
(276, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(277, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(278, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650538345_1c5bcb9e6955bf70c8d0.png\"}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(279, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(280, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(281, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"23d308d027d85565fe04f34f1bb18257ee43d1c3dc63da84164eefe9d93643ad003d27539ffc0f20e7fbc16af41dc00fd4180c8ac06ab46ccbfb04ce3a60ea1cd23a76d1af9d94f492a7c8d043d6ffcc1846d05052dc3a6cb144\"}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(282, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 10:46:01', '2022-04-25 10:46:01', NULL),
(283, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"Bitstring\"}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(284, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(285, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864031_2aaeb1ffe167f06f3528.png\"}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(286, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(287, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(288, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"e2460aef82d9e85134ba301000e1b42ae75adbc9bca3009ece288dab72e0f0cb0108166ce6a4597a0d4bb5f609059798930c43c2828c09e80ea1bec42f6d00cc97ac5818bfa669f6931cd6482a6c6a0b47fcf3ead344480b1e57\"}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(289, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 10:50:31', '2022-04-25 10:50:31', NULL),
(290, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"BitstringIT\"}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(291, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(292, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864031_2aaeb1ffe167f06f3528.png\"}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(293, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(294, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(295, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"5643fa824b85d28040733bdc65fdcd77f9174805a64a0f24ab6df000baea9f5a7ecc7c61058b6b6d0c4dfbce71f3a37c344cbe4725fe9087b585cf4f7f84a9098b8b17221d55dcf60cfaa4db4f083052bf931c94aa6f65cb383c\"}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(296, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 11:00:53', '2022-04-25 11:00:53', NULL),
(297, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"BitstringIT\"}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(298, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(299, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864675_732bf323821f40b0b51a.jpeg\"}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(300, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(301, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(302, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"f11d08a81dcd5c8a020fc210393eac09309c7734fb8c1d560e89f5d67f966ce353fe9ca1228a4a45d28f027e160474129dab37730c17319f63e92e0c302901e82cac0954e613181e466f7f7e2230b67bbe472000ed6e87a236ac\"}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(303, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 11:01:15', '2022-04-25 11:01:15', NULL),
(304, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"BitstringIT\"}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(305, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2021 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\r\\n    All rights reserved.\"}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(306, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864690_21a7b9c6cdb3e370756d.png\"}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(307, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(308, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(309, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"576b9c40e10d446e3be21ea35096bd58551c0cdd6fc683192a35fc9c714c4aa6112b96469f5f468d4bae497dbb4a3d0bcca4e11a36d820d3f5ecbb97528b9b534972b79521cd65d8c00e48af119fa4e45872f998d12630ec663a\"}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(310, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 11:01:30', '2022-04-25 11:01:30', NULL),
(311, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"BitstringIT\"}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(312, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2022 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\n    All rights reserved.\"}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(313, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864690_21a7b9c6cdb3e370756d.png\"}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(314, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"hosy\"}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(315, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":null}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(316, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"c4c97ba13acad28751ef2f3a5271601a9b000d6cf45adbe56074487a5668ec687a2e1e8a529f61c8fa410abfcdef1d4a03441a1c8e756f85f86fe253f436e6167c7bd149024ecfa3cfd61bfe7d7cf6924141c4ec7f59ee40a6a7\"}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(317, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"568\"}', '2022-04-25 11:02:45', '2022-04-25 11:02:45', NULL),
(318, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"BitstringIT\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(319, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2022 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\n    All rights reserved.\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(320, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864690_21a7b9c6cdb3e370756d.png\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(321, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"mail.bitstringit.in\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(322, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":\"somesh@bitstringit.in\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(323, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"c1524f72dd746f3d9e380d523ee804f5ef9b0fce46d47c85838107ef8273ee4c68d62c626faa857b26f1f9b141bcc633cd8669f4ef29caf7cb2bf53524773b10c5fbc10545c55265c01790ccad967f7218289e530e08055a5b136080fb\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(324, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"587\"}', '2022-04-25 11:22:29', '2022-04-25 11:22:29', NULL),
(325, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-25 14:15:57\"}', '2022-04-25 14:15:57', '2022-04-25 14:15:57', NULL),
(326, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-26 12:20:41\"}', '2022-04-26 12:20:41', '2022-04-26 12:20:41', NULL),
(327, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-26 17:19:40\"}', '2022-04-26 17:19:40', '2022-04-26 17:19:40', NULL),
(328, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-27 10:24:45\"}', '2022-04-27 10:24:45', '2022-04-27 10:24:45', NULL),
(329, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-27 10:47:29\"}', '2022-04-27 10:47:29', '2022-04-27 10:47:29', NULL),
(330, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-04-27 16:36:23\"}', '2022-04-27 16:36:23', '2022-04-27 16:36:23', NULL),
(331, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"personal_details\":{\"marital_status\":\"Married\"}}', '2022-04-27 17:05:30', '2022-04-27 17:05:30', NULL),
(332, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-04-27 18:25:35\"}', '2022-04-27 18:25:35', '2022-04-27 18:25:35', NULL),
(333, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-05-02 11:16:57\"}', '2022-05-02 11:16:57', '2022-05-02 11:16:57', NULL),
(334, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"3\",\"role_name\":\"hr\",\"display_name\":\"HR\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:36\",\"updated_at\":\"2021-06-02 11:59:36\",\"deleted_at\":null}]}', '2022-05-02 11:17:17', '2022-05-02 11:17:17', NULL),
(335, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-05-02 11:17:39\"}', '2022-05-02 11:17:39', '2022-05-02 11:17:39', NULL),
(336, 9, 'Somesh Badade', 'updated', 'user', 8, '{\"id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":\"8806056756\",\"status\":\"1\",\"selected_role\":[{\"id\":\"6\",\"role_name\":\"guest_user\",\"display_name\":\"Guest User\",\"role_type\":\"USER\",\"created_at\":\"2021-06-02 11:59:44\",\"updated_at\":\"2021-06-02 11:59:44\",\"deleted_at\":null}]}', '2022-05-02 11:34:34', '2022-05-02 11:34:34', NULL),
(337, 9, 'Somesh Badade', 'created', 'login', 9, '{\"login\":\"2022-05-02 12:17:40\"}', '2022-05-02 12:17:40', '2022-05-02 12:17:40', NULL),
(338, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_title\":\"BitstringIT\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(339, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_footer\":\"<strong>Copyright \\u00a9 2022 <a href=\\\"http:\\/\\/localhost\\/profiles-management\\\">Bitstring<\\/a>.<\\/strong>\\n    All rights reserved.\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(340, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"site_logo\":\"assets\\/images\\/1650864690_21a7b9c6cdb3e370756d.png\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(341, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_host\":\"mail.bitstringit.in\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(342, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_user\":\"somesh@bitstringit.in\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(343, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_pass\":\"1234567890\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(344, 9, 'Somesh Badade', 'updated', 'siteSettings', 0, '{\"smtp_port\":\"587\"}', '2022-05-02 13:02:44', '2022-05-02 13:02:44', NULL),
(345, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-05-02 13:03:41\"}', '2022-05-02 13:03:41', '2022-05-02 13:03:41', NULL),
(346, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-05-02 13:28:23\"}', '2022-05-02 13:28:23', '2022-05-02 13:28:23', NULL),
(347, 8, 'someshwar badade', 'created', 'login', 8, '{\"login\":\"2022-05-02 14:32:23\"}', '2022-05-02 14:32:23', '2022-05-02 14:32:23', NULL),
(348, 8, 'someshwar badade', 'updated', 'profile', 24, '{\"projects\":{\"title\":\"Project 1\"}}', '2022-05-02 15:20:18', '2022-05-02 15:20:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

DROP TABLE IF EXISTS `capabilities`;
CREATE TABLE IF NOT EXISTS `capabilities` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `capability` varchar(50) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`id`, `capability`, `module`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'user/add', 'user', 'Allow users to add new users', '2021-12-01 11:24:48', NULL, NULL),
(4, 'user/edit', 'user', 'Allow users to edit details of existing users', '2021-12-01 11:24:48', NULL, NULL),
(5, 'user/delete', 'user', 'Allow users to delete the users', '2021-12-01 11:24:48', NULL, NULL),
(6, 'user/report', 'user', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(7, 'profiles/add', 'profiles', 'Allow users to add new profiles', '2021-12-01 11:24:48', NULL, NULL),
(8, 'profiles/edit', 'profiles', 'Allow users to edit details of existing profiles', '2021-12-01 11:24:48', NULL, NULL),
(9, 'profiles/delete', 'profiles', 'Allow users to delete profiles', '2021-12-01 11:24:48', NULL, NULL),
(10, 'profiles/report', 'profiles', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(11, 'joining_form/add', 'joining_form', 'Allow users to add a new joining form', '2021-12-01 11:24:48', NULL, NULL),
(12, 'joining_form/edit', 'joining_form', 'Allow users to edit details of existing joining form', '2021-12-01 11:24:48', NULL, NULL),
(13, 'joining_form/delete', 'joining_form', 'Allow users to delete the joining form', '2021-12-01 11:24:48', NULL, NULL),
(14, 'joining_form/report', 'joining_form', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(15, 'user/view', 'user', 'Allow users to view user details', '2021-12-01 11:24:48', NULL, NULL),
(16, 'profiles/view', 'profiles', 'Allow users to view profile details', '2021-12-01 11:24:48', NULL, NULL),
(17, 'joining_form/view', 'joining_form', 'Allow users to view joining form details', '2021-12-01 11:24:48', NULL, NULL),
(18, 'roles/view', 'roles', 'Allow users to view role details', '2021-12-01 11:24:48', NULL, NULL),
(19, 'roles/add', 'roles', 'Allow users to add a new role', '2021-12-01 11:24:48', NULL, NULL),
(20, 'roles/edit', 'roles', 'Allow users to edit details of existing role', '2021-12-01 11:24:48', NULL, NULL),
(21, 'roles/delete', 'roles', 'Allow users to delete role', '2021-12-01 11:24:48', NULL, NULL),
(22, 'roles/report', 'roles', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(23, 'joining_form/update_personal_details', 'joining_form', 'Allow users to update personal details in joining form', '2021-12-01 11:24:48', NULL, NULL),
(24, 'joining_form/update_bank_details', 'joining_form', 'Allow users to update bank details in joining form', '2021-12-01 11:24:48', NULL, NULL),
(25, 'joining_form/update_education_details', 'joining_form', 'Allow users to update education / academics details in joining form', '2021-12-01 11:24:48', NULL, NULL),
(26, 'joining_form/update_employment', 'joining_form', 'Allow users to update employment details in joining form', '2021-12-01 11:24:48', NULL, NULL),
(27, 'joining_form/update_background_info', 'joining_form', 'Allow users to update background information in joining form', '2021-12-01 11:24:48', NULL, NULL),
(28, 'joining_form/update_mediclaim_details', 'joining_form', 'Allow users to update mediclaim details in joining form', '2021-12-01 11:24:48', NULL, NULL),
(29, 'joining_form/update_documents', 'joining_form', 'Allow users to upload/remove documents in joining form', '2021-12-01 11:24:48', NULL, NULL),
(30, 'joining_form/approve', 'joining_form', 'Allow users to approve the joining form', '2021-12-01 11:24:48', NULL, NULL),
(31, 'joining_form/update_approved', 'joining_form', 'Allow users to edit details of an existing approved joining form', '2021-12-01 11:24:48', NULL, NULL),
(33, 'interview/view', 'interview', 'Allow users to view interview details', '2021-12-01 11:24:48', NULL, NULL),
(34, 'interview/add', 'interview', 'Allow users to add a new interview', '2021-12-01 11:24:48', NULL, NULL),
(35, 'interview/edit', 'interview', 'Allow users to edit details of existing interview', '2021-12-01 11:24:48', NULL, NULL),
(36, 'interview/delete', 'interview', 'Allow users to delete interview', '2021-12-01 11:24:48', NULL, NULL),
(37, 'interview/report', 'interview', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(38, 'clients/view', 'clients', 'Allow users to view client details', '2021-12-01 11:24:48', NULL, NULL),
(39, 'clients/add', 'clients', 'Allow users to add a new client', '2021-12-01 11:24:48', NULL, NULL),
(40, 'clients/edit', 'clients', 'Allow users to edit details of existing client', '2021-12-01 11:24:48', NULL, NULL),
(41, 'clients/delete', 'clients', 'Allow users to delete client', '2021-12-01 11:24:48', NULL, NULL),
(42, 'clients/report', 'clients', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(43, 'clients_contact/view', 'clients_contact', 'Allow users to view client contact', '2021-12-01 11:24:48', NULL, NULL),
(44, 'clients_contact/add', 'clients_contact', 'Allow users to add a new client contact', '2021-12-01 11:24:48', NULL, NULL),
(45, 'clients_contact/edit', 'clients_contact', 'Allow users to edit details of existing client contact', '2021-12-01 11:24:48', NULL, NULL),
(46, 'clients_contact/delete', 'clients_contact', 'Allow users to delete client contact', '2021-12-01 11:24:48', NULL, NULL),
(47, 'clients_contact/report', 'clients_contact', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(48, 'job_positions/view', 'job_position', 'Allow users to view job position', '2021-12-01 11:24:48', NULL, NULL),
(49, 'job_positions/add', 'job_position', 'Allow users to add a new job position', '2021-12-01 11:24:48', NULL, NULL),
(50, 'job_positions/edit', 'job_position', 'Allow users to edit details of existing job position', '2021-12-01 11:24:48', NULL, NULL),
(51, 'job_positions/delete', 'job_position', 'Allow users to delete job position', '2021-12-01 11:24:48', NULL, NULL),
(52, 'job_positions/report', 'job_position', 'Allow users to download reports', '2021-12-01 11:24:48', NULL, NULL),
(53, 'job_positions/shortlist_candidate', 'job_position', 'Allow users to shortlist candidate', '2021-12-01 11:24:48', NULL, NULL),
(54, 'email_templates/view', 'email_templates', 'Allow users to view email templates', '2021-12-01 11:24:48', NULL, NULL),
(55, 'email_templates/update', 'email_templates', 'Allow users to update email templates', '2021-12-01 11:24:48', NULL, NULL),
(56, 'policy_documents/view', 'policy_documents', 'Allow users to view policy documents', '2021-12-01 11:24:48', NULL, NULL),
(57, 'policy_documents/update', 'policy_documents', 'Allow users to update policy documents', '2021-12-01 11:24:48', NULL, NULL),
(58, 'policy_documents/delete', 'policy_documents', 'Allow users to delete policy documents', '2021-12-01 11:24:48', NULL, NULL),
(59, 'policy_documents/add', 'policy_documents', 'Allow users to add policy documents', '2021-12-01 11:24:48', NULL, NULL),
(60, 'site_settings/view', 'site_settings', 'Allow users to view site settings', '2021-12-01 11:24:48', NULL, NULL),
(61, 'site_settings/update', 'site_settings', 'Allow users to update site settings', '2021-12-01 11:24:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

DROP TABLE IF EXISTS `certifications`;
CREATE TABLE IF NOT EXISTS `certifications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `certification` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `logo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Infosys', NULL, 1, '2022-01-14 10:47:35', '2022-04-21 15:12:49', NULL),
(2, '24qwrweqr', 'assets/clients/1644322748_c6e5fb5714396dd65366.png', 0, '2022-01-14 10:47:35', '2022-02-08 17:49:08', NULL),
(3, 'TCS', 'assets/clients/1644322812_a3ff6f44200b5ff37a87.png', 1, '2022-01-14 10:48:05', '2022-02-08 17:50:12', NULL),
(4, 'Successive', NULL, 1, '2022-01-14 10:48:05', NULL, NULL),
(5, 'ABC', NULL, 0, '2022-01-14 10:48:05', NULL, NULL),
(6, 'XYZ', NULL, 0, '2022-01-14 10:48:05', NULL, NULL),
(7, 'new client', NULL, 0, '2022-02-08 17:04:38', '2022-02-08 17:05:11', NULL),
(8, 'qwerqr', NULL, 1, '2022-02-08 17:08:01', '2022-02-08 17:08:01', NULL),
(9, 'werqwr', NULL, 1, '2022-02-08 17:08:49', '2022-02-08 17:08:49', NULL),
(10, 'werqwr23', 'assets/clients//1644320407_b812003de4fde9c097c2.jpg', 1, '2022-02-08 17:10:07', '2022-02-08 17:10:07', NULL),
(11, 'qerqr', 'assets/clients/1644322687_31b7c43b68f95199043e.png', 1, '2022-02-08 17:48:07', '2022-02-08 17:48:07', NULL),
(12, 'qwer', 'assets/clients/1644323644_7969508118f52732667c.png', 1, '2022-02-08 18:04:04', '2022-02-08 18:04:04', NULL),
(13, 'qwerweqr', 'assets/clients/1644323744_1b7da9eff630513338af.png', 1, '2022-02-08 18:05:31', '2022-02-08 18:05:44', NULL),
(14, 'qrqew', NULL, 0, '2022-02-08 18:22:57', '2022-02-08 18:22:57', NULL),
(15, 'yiuyui hhk', 'assets/clients/1644324939_f6629ad069d39a8ec080.png', 1, '2022-02-08 18:25:39', '2022-02-09 12:45:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_contacts`
--

DROP TABLE IF EXISTS `client_contacts`;
CREATE TABLE IF NOT EXISTS `client_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_contacts`
--

INSERT INTO `client_contacts` (`id`, `client_id`, `person_name`, `mobile`, `email`, `department`, `additional_info`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 3, 'afasf', '323423', 'asfdfdsa@asdf.dd', NULL, 'asdfadsfsa', NULL, NULL, '2022-02-09 12:07:56', '2022-02-09 15:48:50', NULL),
(7, 15, 'wert', '35345', 'ddsfgd@dgsdg.ff', NULL, 'ertert', NULL, NULL, '2022-02-09 12:43:42', '2022-02-09 12:43:42', NULL),
(10, 1, 'someshwar', '8806056756', 'somesh@gmail.com', NULL, 'asdfd', NULL, NULL, '2022-02-09 15:18:35', '2022-02-09 15:18:35', NULL),
(11, 1, 'qerw', '24234', 'aafsdaf@adsf.dd', NULL, 'sdfsd', NULL, NULL, '2022-02-09 15:19:40', '2022-02-09 18:55:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `educational_qualification`
--

DROP TABLE IF EXISTS `educational_qualification`;
CREATE TABLE IF NOT EXISTS `educational_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`joining_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educational_qualification`
--

INSERT INTO `educational_qualification` (`id`, `joining_form_id`, `degree`, `university`, `institution`, `from_date`, `to_date`, `course_type`, `percentage`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'BE', 'pune', 'scscoe', 'Aug 2010', 'May 2013', 'Full time', '60', NULL, '2021-12-08 12:58:20', '2021-12-08 12:58:20', NULL),
(2, 6, 'BE', 'pune', 'scscoe', 'Aug 2010', 'May 2013', 'Full time', '60', 'form_6/1639480514_fc8d94d58a9487c1f87b.jpg', '2021-12-08 13:03:02', '2021-12-14 16:45:14', NULL),
(3, 6, 'qerqwr 234', 'qewr', 'werwe 2423', 'Jan 2021', 'Feb 2022', 'wrwer', '234', 'form_6/1644584341_af411770134b2f2b9947.png', '2022-02-11 17:14:28', '2022-02-11 18:29:01', NULL),
(4, 6, 'er', 'qwer', 'qwer', 'Jan 2022', 'Feb 2022', 'afasdf', '23', 'form_6/1644584332_7a76170f61e9c5bdd292.jpg', '2022-02-11 18:28:52', '2022-02-11 18:29:40', '2022-02-11 18:29:40'),
(5, 7, 'qerq23', 'qwer23', 'qerqwer23', 'Nov 2021', 'Mar 2022', 'erqwer23', '242', 'form_7/1646721471_4f2386af50ae0716c5a5.png', '2022-03-08 12:04:38', '2022-03-08 15:19:11', '2022-03-08 15:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(200) DEFAULT NULL,
  `display_name` varchar(200) DEFAULT NULL,
  `email_to` varchar(200) DEFAULT NULL,
  `email_cc` varchar(200) DEFAULT NULL,
  `email_bcc` varchar(200) DEFAULT NULL,
  `subject` varchar(225) DEFAULT NULL,
  `body` mediumtext,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Disable',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `short_name`, `display_name`, `email_to`, `email_cc`, `email_bcc`, `subject`, `body`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_registered', 'User Registered', '[user_email]', NULL, NULL, 'Thank you for registration.', '<div>Hello [user_first_name], <br></div><div><br></div><div><b>Welcome to Bistring. </b><br></div><div><br></div><div><u>Thank you for your registration </u><br></div><div><br></div><div>Thanks <br></div><div>Bitstring Team</div>', 'Enable', '2022-04-19 16:36:46', '2022-04-22 15:53:33', NULL),
(2, 'forgot_password', 'Forgot Password', '[user_email]', NULL, NULL, 'Forgot Password', 'test', 'Enable', '2022-04-19 16:36:46', '2022-04-22 15:53:25', NULL),
(3, 'verification_code', 'Verification code', '[user_email]', NULL, NULL, 'Verification code', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(4, 'send_joining_form_link', 'Send Joining form link', '[user_email]', NULL, NULL, 'Send Joining form link', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(5, 'candidate_submit_joining_form', 'Candidate submit joining form', '[user_email]', NULL, NULL, 'Candidate submit joining form', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(6, 'approve_joining_form', 'Approve joining form', '[user_email]', NULL, NULL, 'Approve joining form', '<br>', 'Enable', '2022-04-19 16:36:46', '2022-04-22 16:12:25', NULL),
(7, 'shortlist_candidate', 'Shortlist candidate', '[user_email]', NULL, NULL, 'Shortlist candidate', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(8, 'schedule_interview', 'Schedule interview', '[user_email]', NULL, NULL, 'Schedule interview', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(9, 'candidate_selected', 'Candidate selected', '[user_email]', NULL, NULL, 'Candidate selected', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(10, 'candidate_in_process', 'Candidate in-process', '[user_email]', NULL, NULL, 'Candidate in-process', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(11, 'candidate_rejected', 'Candidate Rejected', '[user_email]', NULL, NULL, 'Candidate Rejected', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL),
(12, 'policy_document_read_by_candidate', 'Policy document read by candidate', '[user_email]', NULL, NULL, 'Policy document read by candidate', '', 'Enable', '2022-04-19 16:36:46', '2022-04-20 16:59:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_joining_form_details`
--

DROP TABLE IF EXISTS `employee_joining_form_details`;
CREATE TABLE IF NOT EXISTS `employee_joining_form_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
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
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-New,1-Pending for approval, 2-Approved',
  `approval_dt` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_joining_form_details`
--

INSERT INTO `employee_joining_form_details` (`id`, `user_id`, `first_name`, `last_name`, `father_name`, `mother_name`, `spouse_name`, `kids_name`, `email_primary`, `mobile_primary`, `aadhar_number`, `pan_number`, `dob`, `place_of_birth`, `nationality`, `education_qualification`, `professional_qualification`, `employment_history`, `background_info`, `employee_other_details`, `documents`, `verification_code`, `is_accept_declaration`, `created_by`, `updated_by`, `status`, `approval_dt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 0, 'someshwar', 'badade', 'Macchindranath', NULL, 'rekha', NULL, 'somesh@bitstringit.in', '8806056756', '111111111111', 'AAAAA1111A', '11-Aug-1986', NULL, NULL, NULL, NULL, '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\",\"O04\":\"0\"},\"previous_address\":[],\"mediclaim\":[],\"relative_with_bitstring\":[]}', '{\"gender\":\"Male\",\"martial_status\":\"Married\",\"total_experience\":\"60\",\"present_address\":\"Gajanan maharaj nagar, NR B.U. bhandari, dighi, pune\",\"present_address_postcode\":\"411015\",\"permanent_address\":\"Ameyanagar, bhingar, Ahmednagar\",\"permanent_address_postcode\":\"414203\",\"is_accept_authorization\":true,\"is_accept_data_protection\":true,\"marital_status\":\"Married\",\"blood_group\":\"AB+\",\"emergency_contact_name\":\"rekha (wife)\",\"emergency_contact_mobile\":\"8007978464\",\"bank_name_branch\":\"adf\",\"bank_account_number\":\"2234\",\"bank_ifsc_code\":\"ICIC0000001\",\"present_address_residing_duration\":\"5\",\"present_address_city\":\"Pune\",\"permanent_address_city\":\"Pune\",\"date_of_joining\":\"01-Jun-2020\"}', '{\"cheque\":{\"path\":\"form_6\\/1639481795_0f1ff54d73f61b17d34a.png\",\"file_name\":\"index.png\",\"documentNote\":\"\"},\"aadhar_card\":{\"path\":\"form_6\\/1646216140_948f9b6e5e5652854570.jpg\",\"file_name\":\"badge.jpg\",\"documentNote\":\"\"},\"pan_card\":{\"path\":\"form_6\\/1646216844_267216d30c1f65db1859.png\",\"file_name\":\"480px-Unofficial_JavaScript_logo_2.svg.png\",\"documentNote\":\"\"}}', '11112222', NULL, NULL, 9, 0, '2021-12-20 12:37:07', '2021-12-08 13:03:02', '2022-03-02 15:57:24', NULL),
(7, 8, 'someshwar', 'badade', 'Macchindranath', 'Suman', 'rekha', NULL, 'someshbadade@gmail.com', '8806056756', '111111111111', 'AAAAA1111A', '11-Aug-1986', NULL, NULL, NULL, NULL, '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', '{\"criminal_and_civil_record\":{\"C01\":\"0\",\"C02\":\"0\",\"C03\":\"0\",\"C04\":\"0\",\"C05\":\"0\",\"C06\":\"0\",\"C07\":\"0\",\"C08\":\"0\"},\"business_interest\":{\"B01\":\"0\",\"B02\":\"0\",\"B03\":\"0\",\"B04\":\"0\"},\"other_disqualification\":{\"O01\":\"0\",\"O02\":\"0\",\"O03\":\"0\",\"O04\":\"0\"},\"previous_address\":[{\"address\":\"ewqwreqwr\",\"postcode\":\"42343\",\"dates\":\"\",\"from_date\":\"Dec 2020\",\"to_date\":\"Mar 2022\"}],\"mediclaim\":[],\"relative_with_bitstring\":[{\"name\":\"wertwer\",\"relationship\":\"twtr\",\"position\":\"wrtewrt\"}]}', '{\"gender\":\"Male\",\"martial_status\":\"Married\",\"total_experience\":\"60\",\"present_address\":\"Gajanan maharaj nagar, NR B.U. bhandari, dighi, pune\",\"present_address_postcode\":\"411015\",\"permanent_address\":\"Ameyanagar, bhingar, Ahmednagar\",\"permanent_address_postcode\":\"414203\",\"is_accept_authorization\":true,\"is_accept_data_protection\":true,\"marital_status\":\"Married\",\"blood_group\":\"AB+\",\"emergency_contact_name\":\"rekha (wife)\",\"emergency_contact_mobile\":\"8007978464\",\"bank_name_branch\":\"adfqrqwerw\",\"bank_account_number\":\"2234242344234\",\"bank_ifsc_code\":\"ICIC0000001\",\"present_address_residing_duration\":\"5\",\"present_address_city\":\"Pune\",\"permanent_address_city\":\"Pune\",\"date_of_joining\":\"01-Jun-2020\",\"medical_condition\":\"no\"}', '{\"aadhar_card\":{\"path\":\"form_7\\/1646721443_b3ced76f83896d42ee12.png\",\"file_name\":\"html5.png\",\"documentNote\":\"\"},\"cheque\":{\"path\":\"form_7\\/1646721451_c30589ac32dca1d7dff3.jpg\",\"file_name\":\"badge.jpg\",\"documentNote\":\"\"},\"pan_card\":{\"path\":\"form_7\\/1646721495_cd6f933d7fca0b216ce5.png\",\"file_name\":\"unite-converter-purpal.png\",\"documentNote\":\"\"}}', '11112222', '2022-03-08 15:23:09', NULL, 9, 2, '2022-03-09 10:42:06', '2021-12-08 13:03:02', '2022-03-09 10:42:06', NULL),
(8, 20, 'Mayur', 'Samrit', NULL, NULL, NULL, NULL, 'mayur.sasmrit@bitstringit.in', NULL, '000000000000', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31114641', NULL, NULL, 9, 0, NULL, '2022-03-08 16:59:44', '2022-03-08 16:59:44', NULL),
(9, 21, 'mayur', 'samrit', NULL, NULL, NULL, NULL, 'mayur.samrit@bitstringit.in', NULL, '111111111111', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19133725', NULL, NULL, 9, 0, NULL, '2022-03-08 17:05:15', '2022-03-08 17:05:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_history`
--

DROP TABLE IF EXISTS `employment_history`;
CREATE TABLE IF NOT EXISTS `employment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joining_form_id` int(11) NOT NULL,
  `company` varchar(225) DEFAULT NULL,
  `department` varchar(225) DEFAULT NULL,
  `position_held` varchar(225) DEFAULT NULL,
  `from_date` varchar(225) DEFAULT NULL,
  `to_date` varchar(225) DEFAULT NULL,
  `nature_of_job` varchar(225) DEFAULT NULL,
  `job_responsibilities` varchar(225) DEFAULT NULL,
  `annual_ctc` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `telephone` varchar(225) DEFAULT NULL,
  `reporting_manager` varchar(225) DEFAULT NULL,
  `contact_number_manager` varchar(225) DEFAULT NULL,
  `email_manager` varchar(225) DEFAULT NULL,
  `reason_of_leaving` varchar(225) DEFAULT NULL,
  `hr_name` varchar(225) DEFAULT NULL,
  `hr_contact_number` varchar(225) DEFAULT NULL,
  `hr_email` varchar(225) DEFAULT NULL,
  `hr_designation` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`joining_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_history`
--

INSERT INTO `employment_history` (`id`, `joining_form_id`, `company`, `department`, `position_held`, `from_date`, `to_date`, `nature_of_job`, `job_responsibilities`, `annual_ctc`, `address`, `city`, `telephone`, `reporting_manager`, `contact_number_manager`, `email_manager`, `reason_of_leaving`, `hr_name`, `hr_contact_number`, `hr_email`, `hr_designation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Moonstone infotech Pvt Ltd', 'Development', 'System Associate', 'Nov 2017', 'May 2021', 'IT', 'ServiceNow admin and development', '5.6', 'Level 2, Plot No.18,Oval Building,hyderabad ,T.S', 'Hyderabad ,telangana', '', 'Dhanalaxmi', '040-40273660', 'palaparthi.dhanalaxmi@mstoneinfotech.com', 'Career Growth', 'kanakala sanjeev', '040-40273660', 'kanakala.sanjeev@mstoneinfotech.com', 'HR manager', '2022-02-10 18:20:43', '2022-02-10 18:20:43', NULL),
(2, 6, 'Fujitsu consulting india Pvt Ltd', 'Development', 'Associate Technical Service Engineer', 'May 2021', 'Aug 2021', 'IT', 'ServiceNow admin and development', '8.5', 'Hyderabad ,telangana', 'Hyderabad ,telangana', '', 'Sandeep', '9345371615', 'G09GM-Employment.Verification@fujitsu.com', 'Personal health issue', '', '', '', '', '2022-02-10 18:21:48', '2022-02-10 18:21:48', NULL),
(3, 7, 'Cognizant Technology Solutions', 'Various', 'Manager - Projects', 'Sep 2009', 'Dec 2020', 'Consulting, Project Management', 'Consulting, Project Management', '21,35,000', 'Hinjewadi', 'Pune', '02066535400', 'Nikhilesh Pant', '9881136727', 'Nikhilesh.Pant@Cognizant.com', 'Wanted to work on a personal project', '', '', '', '', '2022-02-10 18:23:19', '2022-02-10 18:23:19', NULL),
(4, 7, 'L&T Infotech', 'Insurance', 'Sr. Software Engineer', 'Apr 2006', 'Sep 2009', 'Quality Lead', 'Quality Lead', '', '4 Godrej Eternia-A, Old Mumbai Rd, Shivajinagar, P', 'Pune', '02066416262', 'Mukund Mandke', '9326787092', 'mukundmandke@gmail.com', 'Better opportunities', '', '', '', '', '2022-02-10 18:24:04', '2022-02-10 18:24:04', NULL),
(5, 7, 'NSE.IT', 'Quality', 'Associate System Analyst', 'Sep 2005', 'Feb 2006', 'Software Quality Analyst', 'Software Quality Analyst', '', 'Trade Globe, Andheri-Kurla Road, Andheri (East)', 'Mumbai', '02228277600', 'Meghana Deshpande', '9820755895', 'm.deshpande@hotmail.com', 'Better opportunities', '', '', '', '', '2022-02-10 18:24:40', '2022-02-10 18:24:40', NULL),
(6, 7, 'Brainvisa Technlogies (Indecomm -> Encora)', 'QA', 'Sr. QA Associate', 'Jun 2004', 'Sep 2015', 'Quality Assurance', 'Quality Assurance', '', '7th Floor, ICC Tech Park, Tower A, Senapati Bapat', 'Pune', '02066240500', 'HR (Sheetal Sanghal)', '02066240500', 'sheetal.sanghal@encora.com', 'Better opportunities', 'HR (Sheetal Sanghal)', '02066240500', 'sheetal.sanghal@encora.com', '', '2022-02-10 18:25:11', '2022-02-10 18:25:11', NULL),
(7, 7, 'Flex-Tran Industries', 'Quality', 'QC-Inspector', 'Jul 2003', 'Jun 2004', 'Quality Control', 'Quality Control', '', '94+100, Kesanand Village, Wagholi', 'Pune', 'Company closed', 'Company closed', 'Company closed', 'NA@NA.com', '', 'Company closed', 'Company closed', '', '', '2022-02-10 18:25:37', '2022-02-10 18:25:37', NULL),
(8, 7, 'Self-Employed', 'NA', 'Self-Employed', 'Dec 2020', 'Dec 2021', 'AI based Trading & Investing', 'AI based Trading & Investing', '', 'B2 702, Shivaranjan Towers,', 'Pune', '9922192393', 'Kaustubh Deshpande', '9922192393', 'kaustubhde@gmail.com', '', '', '', '', '', '2022-02-10 18:25:59', '2022-02-10 18:25:59', NULL),
(9, 8, 'DXC Technology', 'IT', 'Senior Professional Engineer', 'Dec 2015', 'Dec 2021', 'Full Time', 'Business Analyst', '13,08003', 'Maruthi Concorde Business Park, Konappana Agrahara', 'Bangalore', '', 'Allan Freeman', '+44 07841844413', 'afreeman20@dxc.com', 'Career growth', '', '', '', '', '2022-02-10 18:27:17', '2022-02-10 18:27:17', NULL),
(10, 8, 'WIPRO', 'IT', 'Senior Project Engineer', 'Aug 2010', 'Nov 2015', 'Full Time', 'Senior Developer', '545000', 'Tower S2, Electronic City', 'Bangalore', '', 'MohanRaj Subramani', '8883376666', 'smohanrajit@gmail.com', 'Career growth', '', '', '', '', '2022-02-10 18:27:38', '2022-02-10 18:27:38', NULL),
(11, 9, 'Ahana systems&solutions', 'IT', 'technical support Engineer', 'Aug 2018', 'Jan 2022', 'Full Time', 'Based on request need to assist clients', '2.8', '502/37, 2nd Floor, 1st Main Rd, 8th Block, Jayanag', 'bangalore', '08026635854', 'Sujatha prakash', '9148214143', 'sujatha.prakash@ahana.co.in', 'carrier growth', 'pushpalatha', '9900097010', 'pushpalatha.m@ahana.co.in', 'resource cordinator', '2022-02-10 18:28:46', '2022-02-10 18:28:46', NULL),
(12, 10, 'Syniverse Technologies', 'IT', 'Lead Engineer', 'JUL-2007', 'JUN-2020', 'Full Time', '', '', '', '', '', 'Sachin Karnik', '08067209500', 'sachin.karnik@syniverse.com', '', 'Veena Raju', '08067209855', '', '', '2022-02-10 18:29:35', '2022-02-10 18:29:35', NULL),
(13, 10, 'IBM India Pvt Ltd', 'IT', 'Software Engineer', 'Jan-2006', 'Jun-2007', 'Full Time', '', '', '', '', '', 'Sridhar', '000000000000000', 'sridhar@ibm.co.in', '', '', '', '', '', '2022-02-10 18:29:57', '2022-02-10 18:29:57', NULL),
(14, 12, 'dxc technology', 'DELIVERY – T&T – INT', 'Sr. Software professional', 'Nov 2005', 'Jan 2022', 'Full Time', 'ServiceNow Integration Architect', '27', 'Olympia tech park, Guindy', 'Chennai', '', 'Paul Hickey', '#', 'paul.hickey@dxc.com', '', '', '', '', '', '2022-02-10 18:31:17', '2022-02-10 18:31:17', NULL),
(15, 12, 'sega gameworks', 'IT', 'Programmer/ analyst', 'Sep 2003', 'Oct 2005', 'Full Time', '', '', '', '', '', 'Rick Engadhl', '#', 'rick.engadhal@noemail.com', '', '', '', '', '', '2022-02-10 18:31:35', '2022-02-10 18:31:35', NULL),
(16, 12, 'iBackup Prosoft net corp', 'Consulting services', 'Consultant', 'Jan 2003', 'Oct 2003', 'Full Time', '', '', '26115, Mureau Road', 'Calabasas', '', 'Shweta Sachdev', '8182514200', 'shweta.sachdeva@pro-softnet.com', '', '', '', '', '', '2022-02-10 18:31:56', '2022-02-10 18:31:56', NULL),
(17, 12, 'Sigma Project Services', 'Consulting Services', 'Programmer Analyst', 'Jun 2000', 'Feb 2003', 'Full Time', '', '', '', '', '', 'Sudesh B', '5624029884', 'sudes.b@sigma-project.com', '', '', '', '', '', '2022-02-10 18:32:13', '2022-02-10 18:32:13', NULL),
(18, 12, 'Silex Technologies', 'Web division', 'Web Developer', 'Jun 1999', 'Apr 2000', 'Full Time', '', '', '65 Ramaswamy road', 'Chennai', '', 'S Balaji', '044-4983504', 'balaji.s@silex-tech.com', '', '', '', '', '', '2022-02-10 18:32:31', '2022-02-10 18:32:31', NULL),
(19, 12, 'Adroit Software Pvt Ltd', 'Software Development', 'Programmer', 'Aug 1996', 'Jun 1999', 'Full Time', '', '', '', '', '', 'K Venkateswaran', '#', 'venkateswaran.k@nomail.com', '', '', '', '', '', '2022-02-10 18:32:48', '2022-02-10 18:32:48', NULL),
(20, 7, 'qrqewr', 'qwer', 'wer', NULL, NULL, 'Part Time', 'werw', '23', 'qrqewr', 'pun3', NULL, 'wre', 'w2423', '24234af@afd.dd', NULL, 'afasf', 'asf24234', 'asfas@adfsa.dd', 'asdfs', '2022-03-08 15:19:43', '2022-03-08 15:20:59', '2022-03-08 15:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `gap_declaration`
--

DROP TABLE IF EXISTS `gap_declaration`;
CREATE TABLE IF NOT EXISTS `gap_declaration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joining_form_id` int(11) NOT NULL,
  `particular` varchar(200) DEFAULT NULL,
  `from_date` varchar(20) DEFAULT NULL,
  `to_date` varchar(20) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`joining_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gap_declaration`
--

INSERT INTO `gap_declaration` (`id`, `joining_form_id`, `particular`, `from_date`, `to_date`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'qeqwe', 'Jan 2022', 'Feb 2022', '', '2022-02-10 14:51:39', '2022-02-10 15:39:41', '2022-02-10 15:39:41'),
(2, 7, 'erq2343', 'Sep 2021', 'Feb 2022', 'form_7/1646733081_02ca596587d550064b98.png', '2022-03-08 15:21:21', '2022-03-08 15:21:43', '2022-03-08 15:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

DROP TABLE IF EXISTS `job_positions`;
CREATE TABLE IF NOT EXISTS `job_positions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`job_code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_positions`
--

INSERT INTO `job_positions` (`id`, `job_code`, `client_name`, `title`, `desc`, `min_experience`, `max_experience`, `locations`, `primary_skills`, `match_primary_skills`, `secondary_skills`, `match_secondary_skills`, `position_received_date`, `valid_to_date`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JB001', 'Infosys', 'Full stack developer', 'Full stack developer for full time employee with experience 0-5 years.', 30, 60, 'Pune', 'HTML || PHP || jQuery || Css || MySql || Javascript || AngularJs', 2, 'Oracle || HTML', 0, '2022-01-13', '2022-02-28', 9, 9, '2022-01-13 17:05:19', '2022-02-16 16:42:30', NULL),
(2, 'JB002', 'TCS', 'Full stack developer', 'Full stack developer for full time employee with experience 0-2 years.', 0, 24, NULL, 'HTML || Java || jQuery || Css || MySql || Javascript || Angularjs 4', 3, 'Oracle || HTML', 0, '2022-01-01', '2022-02-28', 9, 9, '2022-01-13 17:05:19', '2022-01-27 14:29:51', NULL),
(3, 'JB002', 'Successive', 'DevOps', 'DevOps engineer for full time employee with experience 0-2 years.', 12, 36, 'Mumbai', 'MySql || Pupet || Docker || Chef || Jenkin || Git || SVN || Java || Angularjs', 2, 'PHP || HTML 5 || Javascript || HTML', 1, '2022-01-01', '2022-02-28', 9, 9, '2022-01-13 17:05:19', '2022-01-27 14:28:10', NULL),
(4, 'Jb01212', 'Infosys', 'asdfa', 'asdfaf\nasdf\nasdf', 12, 36, NULL, 'PHP || HTML 5 || Javascript || Angular', 1, 'MySql || Oracle || HTML', 1, '2022-01-14', '2022-01-31', 9, 9, '2022-01-14 11:55:57', '2022-02-03 10:49:59', NULL),
(5, 'JB0005', 'yiuyui hhk', 'testing', 'testing testing testing', 0, 24, 'Pune || Mumbai || Chennai', 'PHP || AngularJs 8', 0, 'HTML', 1, '2022-02-21', '2022-02-28', 9, 9, '2022-02-21 15:27:29', '2022-02-21 18:49:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_skills`
--

DROP TABLE IF EXISTS `master_skills`;
CREATE TABLE IF NOT EXISTS `master_skills` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_skills`
--

INSERT INTO `master_skills` (`id`, `text`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PHP', NULL, NULL, NULL),
(2, 'Python', NULL, NULL, NULL),
(3, 'AngularJs 2', NULL, NULL, NULL),
(4, 'AngularJs 3', NULL, NULL, NULL),
(5, 'AngularJs 4', NULL, NULL, NULL),
(6, 'AngularJs 5', NULL, NULL, NULL),
(7, 'AngularJs 6', NULL, NULL, NULL),
(8, 'AngularJs 7', NULL, NULL, NULL),
(9, 'AngularJs 8', NULL, NULL, NULL),
(10, 'AngularJs 9', NULL, NULL, NULL),
(11, 'AngularJs 10', NULL, NULL, NULL),
(12, 'jQuery', NULL, NULL, NULL),
(13, 'CSS', NULL, NULL, NULL),
(14, 'CSS 3', NULL, NULL, NULL),
(15, 'HTML', NULL, NULL, NULL),
(16, 'HTML 5', NULL, NULL, NULL),
(17, 'Javascript', NULL, NULL, NULL),
(18, 'Java', NULL, NULL, NULL),
(19, 'Spring Boot', NULL, NULL, NULL),
(20, 'Bootstrap', NULL, NULL, NULL),
(21, 'Codeigniter', NULL, NULL, NULL),
(22, 'NodeJs', NULL, NULL, NULL),
(23, 'ReactJs', NULL, NULL, NULL),
(24, 'Vue.js', NULL, NULL, NULL),
(25, '.Net', NULL, NULL, NULL),
(26, 'C#', NULL, NULL, NULL),
(27, 'C++', NULL, NULL, NULL),
(28, 'VisualBasic', NULL, NULL, NULL),
(29, 'Android', NULL, NULL, NULL),
(30, 'ServiceNow', NULL, NULL, NULL),
(31, 'DevOps', NULL, NULL, NULL),
(32, 'Git', NULL, NULL, NULL),
(33, 'Express.js', NULL, NULL, NULL),
(34, 'three.js', NULL, NULL, NULL),
(35, 'MySql', NULL, NULL, NULL),
(36, 'Oracle', NULL, NULL, NULL),
(37, 'Wordpress', NULL, NULL, NULL),
(38, 'Magento', NULL, NULL, NULL),
(39, 'Laravel', NULL, NULL, NULL),
(40, 'Microsoft Server 2000', NULL, NULL, NULL),
(41, 'MongoDB', NULL, NULL, NULL),
(42, 'MariaDB', NULL, NULL, NULL),
(43, 'Graphql', NULL, NULL, NULL),
(44, 'Postgresql', NULL, NULL, NULL),
(45, 'AWS', NULL, NULL, NULL),
(46, 'Scrum master', '2022-01-24 17:37:42', '2022-01-24 17:37:42', NULL),
(47, 'AngularJs', '2022-02-21 15:27:01', '2022-02-21 15:27:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mediclaim`
--

DROP TABLE IF EXISTS `mediclaim`;
CREATE TABLE IF NOT EXISTS `mediclaim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joining_form_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `age` varchar(5) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`joining_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mediclaim`
--

INSERT INTO `mediclaim` (`id`, `joining_form_id`, `name`, `relationship`, `dob`, `age`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Someshwar', 'Self', '11-Aug-1986', '35', '', '2022-01-13 14:10:45', '2022-02-10 16:25:09', NULL),
(2, 7, 'wrtwert', 'twert', '04-Jan-2022', '0', 'form_7/1646733142_26aa5fc7c96694132d31.png', '2022-03-08 15:22:22', '2022-03-08 15:22:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `policy_documents`
--

DROP TABLE IF EXISTS `policy_documents`;
CREATE TABLE IF NOT EXISTS `policy_documents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `document_name` varchar(200) NOT NULL,
  `type` enum('File','Text') NOT NULL DEFAULT 'File',
  `file` varchar(200) DEFAULT NULL,
  `file_name_original` varchar(200) DEFAULT NULL,
  `text` mediumtext,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policy_documents`
--

INSERT INTO `policy_documents` (`id`, `document_name`, `type`, `file`, `file_name_original`, `text`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Company Policy', 'File', 'assets/policy-documents/1649402430_23f22182d42df3cd5103.pdf', 'company-policy.pdf', NULL, 'Active', '2022-04-07 14:04:37', '2022-04-08 12:50:30', NULL),
(2, 'teast2', 'Text', NULL, NULL, '<h1>title adsakd k asdfh h adfjh<br></h1>', 'Inactive', '2022-04-07 14:04:37', '2022-04-08 15:56:29', NULL),
(3, 'Leave Policy', 'File', 'assets/policy-documents/1649402454_d802971cac525624486c.pdf', 'leave-policy.pdf', NULL, 'Active', '2022-04-07 17:11:06', '2022-04-08 12:50:54', NULL),
(4, 'Holiday policy', 'File', 'assets/policy-documents/1649402397_1c6da9f36f04c2565f27.pdf', 'holidays-policy.pdf', NULL, 'Active', '2022-04-07 17:24:43', '2022-04-08 12:49:57', NULL),
(5, '026026', 'File', 'assets/policy-documents/1649403234_7cf2a3b5d3ced51117ca.pdf', '1649402454_d802971cac525624486c.pdf', NULL, 'Active', '2022-04-08 13:03:07', '2022-04-11 10:41:38', '2022-04-11 10:41:38'),
(6, 'HTml content', 'Text', NULL, NULL, '<div>\n<h2>What is Lorem Ipsum?</h2>\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\n typesetting industry. Lorem Ipsum has been the industry\'s standard \ndummy text ever since the 1500s, when an unknown printer took a galley \nof type and scrambled it to make a type specimen book. It has survived \nnot only five centuries, but also the leap into electronic typesetting, \nremaining essentially unchanged. It was popularised in the 1960s with \nthe release of Letraset sheets containing Lorem Ipsum passages, and more\n recently with desktop publishing software like Aldus PageMaker \nincluding versions of Lorem Ipsum.</p>\n</div><div>\n<h2>Why do we use it?</h2>\n<p>It is a long established fact that a reader will be distracted by the\n readable content of a page when looking at its layout. The point of \nusing Lorem Ipsum is that it has a more-or-less normal distribution of \nletters, as opposed to using \'Content here, content here\', making it \nlook like readable English. Many desktop publishing packages and web \npage editors now use Lorem Ipsum as their default model text, and a \nsearch for \'lorem ipsum\' will uncover many web sites still in their \ninfancy. Various versions have evolved over the years, sometimes by \naccident, sometimes on purpose (injected humour and the like).</p>\n</div>', 'Active', '2022-04-08 17:07:35', '2022-04-08 17:07:35', NULL),
(7, 'test', 'Text', NULL, NULL, 'asdfsdf', 'Active', '2022-04-11 10:51:02', '2022-04-11 10:54:06', '2022-04-11 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `professional_qualification`
--

DROP TABLE IF EXISTS `professional_qualification`;
CREATE TABLE IF NOT EXISTS `professional_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joining_form_id` int(11) NOT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`joining_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professional_qualification`
--

INSERT INTO `professional_qualification` (`id`, `joining_form_id`, `qualification`, `category`, `date`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 'qewr12', 'qerw12', 'Jan 2022', 'form_7/1646732924_5b1357783ba4cac4ec57.png', '2022-03-08 15:18:44', '2022-03-08 15:19:03', '2022-03-08 15:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `first_name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `candidate_name` varchar(200) DEFAULT NULL,
  `mobile_primary` varchar(20) DEFAULT NULL,
  `mobile_alternate` varchar(20) DEFAULT NULL,
  `email_primary` varchar(200) NOT NULL,
  `email_alternate` varchar(200) DEFAULT NULL,
  `about_me` mediumtext,
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
  `primary_skills_soundex` mediumtext,
  `secondary_skills` mediumtext,
  `secondary_skills_soundex` mediumtext,
  `foundation_skills` mediumtext,
  `foundation_skills_soundex` mediumtext,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `father_name`, `last_name`, `candidate_name`, `mobile_primary`, `mobile_alternate`, `email_primary`, `email_alternate`, `about_me`, `gender`, `marital_status`, `dob`, `pan_number`, `aadhar_number`, `photo`, `resume_pdf`, `resume_pdf_name`, `resume_doc`, `resume_doc_name`, `preferred_work_locations`, `categories`, `primary_skills`, `primary_skills_soundex`, `secondary_skills`, `secondary_skills_soundex`, `foundation_skills`, `foundation_skills_soundex`, `certifications`, `work_experience`, `total_experience`, `relevant_experience`, `current_company`, `notice_period`, `is_negotiable_np`, `last_working_day`, `negotiable_np`, `ctc`, `expected_ctc`, `is_negotiable_ctc`, `negotiable_ctc`, `present_address`, `present_address_postcode`, `permanent_address`, `permanent_address_postcode`, `employment_history`, `created_by`, `updated_by`, `status`, `verification_code`, `documents`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 9, 'someshwar', 'm', 'badade', NULL, '8806056756', '124123412342341', 'somesh@bitstringit.in', 'someshbadade@gmail.com', NULL, 'Male', 'Married', '11-Aug-1986', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, 'Pune || Mumbai', NULL, '[{\"text\":\"PHP\",\"rating\":\"4\"},{\"text\":\"HTML\",\"rating\":\"3\"}]', 'P100 H354', '[{\"text\":\"Oracle\",\"rating\":\"6\"},{\"text\":\"Mongodb\",\"rating\":\"9\"}]', 'O624 M523', '[]', '', NULL, NULL, '13', '13', 'Bitstring', '2', 1, '31-Jan-2022', NULL, '3.9', '6.0', 0, NULL, 'asfasdf', '1312', 'asdfadsf', '312312', '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', 8, 9, 2, '77333422', '{\"cv\":{\"path\":\"profile_15\\/1643618320_2d27f74117c352674fb2.docx\",\"file_name\":\"someshwar_badade_cv_23052021.docx\",\"documentNote\":null},\"aadhar_card\":{\"path\":\"profile_15\\/1643627727_b855a50af3e59b02ef45.pdf\",\"file_name\":\"barcode.pdf\",\"documentNote\":null}}', '2021-12-07 12:41:17', '2022-03-14 15:03:12', NULL),
(16, 23, 'abc', NULL, 'abc', NULL, '1234567890', '124123412342341', 'abc@bitstringit.in', 'ab@nomail.com', NULL, 'Male', 'Married', '11-Aug-1982', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '[{\"text\":\"JAVA\",\"rating\":\"6\"},{\"text\":\"HTML\",\"rating\":\"6\"},{\"text\":\"Chef\",\"rating\":\"5\"},{\"text\":\"PHP\",\"rating\":\"7\"},{\"text\":\"AngularJs 6\",\"rating\":\"8\"}]', 'J100 H354 C100 P100 A524', '[{\"text\":\"Oracle\",\"rating\":\"5\"},{\"text\":\"Mysql\",\"rating\":\"5\"},{\"text\":\"Mogodb\",\"rating\":\"5\"},{\"text\":\"PHP\",\"rating\":\"7\"},{\"text\":\"HTML\",\"rating\":\"9\"}]', 'O624 M240 M231 P100 H354', '[]', '', NULL, NULL, '13', '13', 'Bitstring', '2', 0, NULL, NULL, '3.9', '6.0', 0, NULL, 'asfasdf', '1312', 'asdfadsf', '312312', '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', NULL, NULL, 2, '20474057', NULL, '2021-12-06 12:41:17', '2022-03-09 15:00:17', NULL),
(17, 24, 'pqr', NULL, 'pqr', NULL, '1234567899', '124123412', 'pqr@bitstringit.in', 'pqr@nomail.com', NULL, 'Male', 'Married', '11-Aug-1982', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '[{\"text\":\"PHP\",\"rating\":\"4\"},{\"text\":\"Java\",\"rating\":\"5\"},{\"text\":\"Python\",\"rating\":\"3\"},{\"text\":\"Docker\",\"rating\":\"4\"}]', 'P100 J100 P350 D260', '[{\"text\":\"Javascript\",\"rating\":\"2\"},{\"text\":\"HTML\",\"rating\":\"3\"},{\"text\":\"Mysql\",\"rating\":\"1\"},{\"text\":\"HTML 5\",\"rating\":\"3\"}]', 'J126 H354 M240 H354', '[]', '', NULL, NULL, '25', '25', 'Bitstring', '2', NULL, NULL, NULL, '3.9', '6.0', 0, NULL, 'asfasdf', '1312', 'asdfadsf', '312312', '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', NULL, NULL, 3, '20474057', NULL, '2021-12-08 12:41:17', '2022-03-09 15:03:11', NULL),
(18, 25, 'Ajay', NULL, 'Kumar', NULL, '1234567899', '124123412', 'ajay@nomail.com', 'ajaykumar@nomail.com', NULL, 'Male', 'Married', '18-Aug-1985', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '[{\"text\":\"PHP\",\"rating\":\"10\"},{\"text\":\"Java\",\"rating\":\"6\"},{\"text\":\"Python\",\"rating\":\"6\"},{\"text\":\"Javascript\",\"rating\":\"7\"},{\"text\":\"jQuery\",\"rating\":\"7\"},{\"text\":\"Css\",\"rating\":\"6\"},{\"text\":\"MySql\",\"rating\":\"4\"}]', 'P100 J100 P350 J126 J600 C000 M240', '[{\"text\":\"Javascript\",\"rating\":\"5\"},{\"text\":\"HTML\",\"rating\":\"3\"},{\"text\":\"Oracle\",\"rating\":\"5\"},{\"text\":\"HTML 5\",\"rating\":\"7\"}]', 'J126 H354 O624 H354', '[]', '', NULL, NULL, '30', '30', 'Bitstring', '2', NULL, NULL, NULL, '3.9', '6.0', 0, NULL, 'asfasdf', '1312', 'asdfadsf', '312312', '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', NULL, NULL, 1, '20474057', NULL, '2021-12-09 12:41:17', '2022-03-09 15:04:48', NULL),
(19, 26, 'Rakesh', NULL, 'Kumar', NULL, '1234567667', '124123433', 'rakesh@nomail.com', 'rajeshkumar@nomail.com', NULL, 'Male', 'Married', '18-Jan-1985', 'AAAAA1111A', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '[{\"text\":\"PHP\",\"rating\":\"5\"},{\"text\":\"Java\",\"rating\":\"6\"},{\"text\":\"Python\",\"rating\":\"7\"},{\"text\":\"Pupet\",\"rating\":\"8\"},{\"text\":\"AngularJs 8\",\"rating\":\"9\"}]', 'P100 J100 P350 P130 A524', '[{\"text\":\"Javascript\",\"rating\":\"6\"},{\"text\":\"HTML\",\"rating\":\"5\"},{\"text\":\"Mysql\",\"rating\":\"4\"},{\"text\":\"HTML 5\",\"rating\":\"3\"}]', 'J126 H354 M240 H354', '[]', '', NULL, NULL, '50', '50', 'Bitstring', '2', 0, NULL, NULL, '3.9', '6.0', 0, NULL, 'asfasdf', '1312', 'asdfadsf', '312312', '{\"employers\":[{\"position_held\":\"\",\"from_date\":\"Dec 2021\",\"to_date\":\"Dec 2021\",\"company\":\"afasdf\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"\",\"city\":\"\",\"telephone\":\"\",\"job_responsibilities\":\"asdfsadf\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', NULL, NULL, 1, '20474057', NULL, '2021-12-10 12:41:17', '2022-03-09 15:06:12', NULL),
(24, 8, 'someshwar', NULL, 'badade', NULL, '8806056756', '8806056756', 'someshbadade@gmail.com', 'someshbadade@gmail.com', 'Associated with multiple companies to perform the role of Senior Software Engineer. Includes requirement analysis, architect flow of the project, daily scrum, task allocation in the team, database design as per modules/sections/add-on, coding, support to team members in the development, deployment, and innovation as per user experience in project flow as needed. Provide good quality products/web applications.', 'Male', 'Married', '11-Aug-1986', 'PANN1111N', NULL, '/assets/profiles/profile_8/8626fb50a47f26.png', NULL, NULL, NULL, NULL, '', NULL, '[{\"text\":\"PHP\",\"rating\":\"8\"},{\"text\":\"AngularJs\",\"rating\":\"7\"},{\"text\":\"Java\",\"rating\":\"4\"},{\"text\":\"Javascript\",\"rating\":\"8\"},{\"text\":\"HTML\",\"rating\":\"8\"},{\"text\":\"MySql\",\"rating\":\"8\"},{\"text\":\"Android\",\"rating\":\"3\"},{\"text\":\"Codeigniter\",\"rating\":\"9\"},{\"text\":\"Laravel\",\"rating\":\"7\"}]', 'P100 A524 J100 J126 H354 M240 A536 C325 L614', '[]', '', '[]', '', NULL, NULL, '67', '50', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 'Pune, Maharashtra', '411015', NULL, NULL, '{\"employers\":[{\"position_held\":\"Sr software Developer\",\"from_date\":\"Jul 2020\",\"to_date\":\"Mar 2022\",\"company\":\"Bitstring it services pvt. ltd.\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"D-223, Palediam exotica, Dhanori\",\"city\":\"Pune\",\"telephone\":\"\",\"job_responsibilities\":\"Database design, Codeing, Project Deployment\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Jr Software Developer\",\"from_date\":\"Jan 2016\",\"to_date\":\"Jun 2020\",\"company\":\"Essensys Software pvt. ltd.\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"SH-119, Shopers orbit, Vistrantwadi\",\"city\":\"Pune\",\"telephone\":\"\",\"job_responsibilities\":\"Database design, Codeing,\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"},{\"position_held\":\"Data entry operator\",\"from_date\":\"FEB 2015\",\"to_date\":\"DEC 2015\",\"company\":\"TCS\",\"department\":\"\",\"nature_of_job\":\"\",\"address\":\"Bhosari\",\"city\":\"Pune\",\"telephone\":\"\",\"job_responsibilities\":\"data entry\",\"annual_ctc\":\"\",\"reporting_manager\":\"\",\"contact_number_manager\":\"\",\"email_manager\":\"\",\"reason_of_leaving\":\"\",\"hr_name\":\"\",\"hr_contact_number\":\"\",\"hr_email\":\"\",\"hr_designation\":\"\"}]}', NULL, NULL, 1, NULL, '{\"pan_card\":{\"path\":\"profile_24\\/1646657781_4abb62f071cfba676860.png\",\"file_name\":\"html5.png\",\"documentNote\":\"\"}}', '2022-03-07 16:53:46', '2022-05-02 16:10:10', NULL),
(25, 27, 'abc', NULL, 'xyz', NULL, '1234567890', NULL, 'abc@nomail.com', NULL, NULL, 'Male', NULL, '14-Mar-2022', 'PPPPP1111P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2022-03-14 12:17:43', '2022-03-14 12:26:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_educational_qualification`
--

DROP TABLE IF EXISTS `profile_educational_qualification`;
CREATE TABLE IF NOT EXISTS `profile_educational_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_educational_qualification`
--

INSERT INTO `profile_educational_qualification` (`id`, `profile_id`, `degree`, `university`, `institution`, `from_date`, `to_date`, `course_type`, `percentage`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 15, 'BE', 'pune', 'scscoe', 'Aug 2010', 'May 2013', 'Full time', '60', 'profile_15/1643610622_5f88e195103671baaa64.jpg', '2021-12-08 12:56:35', '2022-01-31 12:00:22', NULL),
(4, 24, 'BE Computer', 'Pune University', 'S.C.S.C.O.E. Rahuri Factory, Ahmednagar', 'Aug 2010', 'May 2013', 'Full time', '60', 'profile_24/1646657336_20be97b95774b3d7cba1.jpg', '2022-03-07 18:18:37', '2022-03-11 14:27:13', NULL),
(5, 24, 'Diploma In Computer', 'MSBTE', 'Goverment Polytechnic Beed', 'Aug 2008', 'May 2010', 'Full time', '70', '', '2022-03-11 14:28:19', '2022-03-11 14:28:19', NULL),
(6, 24, 'HSC', 'Pune', 'p.j.n. collage', 'Jun 2001', 'Jun 2002', 'full time', '62', '', '2022-03-11 17:18:13', '2022-03-11 17:23:07', NULL),
(7, 24, 'SSC', 'Pune', 'z.p. Boys school', 'Jun 2002', 'Jun 2004', 'Full time', '65', '', '2022-03-11 17:22:50', '2022-03-11 17:22:50', NULL),
(8, 0, 'werqewr', 'werqwer', 'qwer', 'Sep 2021', 'Mar 2022', 'qrqwer', '23', '', '2022-03-14 12:32:06', '2022-03-14 12:32:06', NULL),
(9, 25, 'qerqr 3434', 'wrwr', 'werwr', 'Apr 2021', 'Mar 2022', 'wrwer', '234', '', '2022-03-14 12:35:39', '2022-03-14 12:36:12', NULL),
(10, 25, 'qwerqe', 'wrwe', 'qwerqw', 'Nov 2021', 'Mar 2022', 'wrwer', '34', '', '2022-03-14 12:36:01', '2022-03-14 12:36:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_interviews`
--

DROP TABLE IF EXISTS `profile_interviews`;
CREATE TABLE IF NOT EXISTS `profile_interviews` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `job_position_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `interview_taken_by` varchar(50) NOT NULL,
  `for_role` varchar(255) NOT NULL,
  `schedule_dt` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_interviews`
--

INSERT INTO `profile_interviews` (`id`, `profile_id`, `job_position_id`, `company_name`, `interview_taken_by`, `for_role`, `schedule_dt`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 15, 1, 'HSBC', 'Rakesh Bos', 'Full stack developer', '2022-02-11 11:05:00', '3', '2022-02-07 11:05:55', '2022-02-16 16:19:02', NULL),
(9, 15, 1, 'HSBC', 'qwer', 'Full stack developer', '2022-02-17 16:00:00', '7', '2022-02-16 16:00:13', '2022-02-16 16:00:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_professional_qualification`
--

DROP TABLE IF EXISTS `profile_professional_qualification`;
CREATE TABLE IF NOT EXISTS `profile_professional_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `document_path` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `joining_form_id` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_professional_qualification`
--

INSERT INTO `profile_professional_qualification` (`id`, `profile_id`, `qualification`, `category`, `date`, `document_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 15, 'qwer', 'qwer', 'Jan 2022', 'profile_15/1643610660_442a2547016e19905c4c.png', '2022-01-31 12:01:00', '2022-01-31 12:01:00', NULL),
(2, 24, 'Certification 1', 'asf', 'Mar 2020', 'profile_24/1646657348_f702a2acada82950a370.png', '2022-03-07 18:19:08', '2022-03-11 14:33:29', NULL),
(3, 24, 'Certification 2', 'test', 'Aug 2020', '', '2022-03-11 14:33:48', '2022-03-11 14:33:48', NULL),
(4, 24, 'Certification 3', 'test', 'Jan 2022', '', '2022-03-11 14:34:11', '2022-03-11 14:34:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_projects`
--

DROP TABLE IF EXISTS `profile_projects`;
CREATE TABLE IF NOT EXISTS `profile_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_projects`
--

INSERT INTO `profile_projects` (`id`, `profile_id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'xyz', '0', '2022-04-15 15:51:29', '2022-04-15 15:51:29', NULL),
(2, 0, 'qwerqwr', '0', '2022-04-15 15:53:22', '2022-04-15 15:53:22', NULL),
(3, 24, 'Project 1', '<div><b>The technology used: </b>PHP, Codeigniter, Html, MySql</div><div><b>Duration:</b> 2 Years<br></div><div><b>About Project:</b></div><div>The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. The project is developed for so and so. </div>', '2022-04-15 15:53:57', '2022-05-02 15:20:18', NULL),
(4, 24, 'Project 2', '<div><b>The technology used: </b>PHP, Codeigniter, Html, MySql</div><div><b>Duration:</b> 2 Years<br></div><div><b>About Project:</b></div><div>The\n project is developed for so and so. The project is developed for so and\n so. The project is developed for so and so. The project is developed \nfor so and so. The project is developed for so and so. The project is \ndeveloped for so and so. The project is developed for so and so. The \nproject is developed for so and so. The project is developed for so and \nso. </div>', '2022-04-15 15:58:21', '2022-04-15 16:35:20', NULL),
(5, 24, 'Project 3', '<div><b>The technology used: </b>PHP, Codeigniter, Html, MySql</div><div><b>Duration:</b> 2 Years<br></div><div><b>About Project:</b></div><div>The\n project is developed for so and so. The project is developed for so and\n so. The project is developed for so and so. The project is developed \nfor so and so. The project is developed for so and so. The project is \ndeveloped for so and so. The project is developed for so and so. The \nproject is developed for so and so. The project is developed for so and \nso. </div>', '2022-04-15 15:59:47', '2022-04-15 16:35:32', NULL),
(6, 24, 'test', 'test', '2022-04-15 16:35:50', '2022-04-15 16:37:35', '2022-04-15 16:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `profile_shortlist`
--

DROP TABLE IF EXISTS `profile_shortlist`;
CREATE TABLE IF NOT EXISTS `profile_shortlist` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_position_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `applied_dt` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_shortlist`
--

INSERT INTO `profile_shortlist` (`id`, `job_position_id`, `profile_id`, `applied_dt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 1, 15, '2022-01-28 11:09:25', '2022-01-28 11:00:54', '2022-01-28 11:09:25', NULL),
(20, 1, 18, NULL, '2022-01-28 11:00:54', '2022-01-28 11:00:54', NULL),
(21, 2, 18, NULL, '2022-01-28 11:01:14', '2022-01-28 11:01:14', NULL),
(22, 4, 15, NULL, '2022-01-28 11:03:03', '2022-01-28 11:03:03', NULL),
(23, 3, 16, NULL, '2022-01-28 11:03:16', '2022-01-28 11:03:16', NULL),
(24, 3, 17, NULL, '2022-01-28 11:03:16', '2022-01-28 11:03:16', NULL),
(25, 4, 17, NULL, '2022-02-03 10:50:29', '2022-02-03 10:50:29', NULL),
(26, 4, 18, NULL, '2022-02-03 10:50:29', '2022-02-03 10:50:29', NULL),
(27, 4, 19, NULL, '2022-02-03 10:50:29', '2022-02-03 10:50:29', NULL),
(28, 3, 18, NULL, '2022-02-03 10:50:37', '2022-02-03 10:50:37', NULL),
(29, 3, 19, NULL, '2022-02-03 10:50:37', '2022-02-03 10:50:37', NULL),
(30, 1, 16, NULL, '2022-03-09 17:00:05', '2022-03-09 17:00:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resume_templates`
--

DROP TABLE IF EXISTS `resume_templates`;
CREATE TABLE IF NOT EXISTS `resume_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `template_config` mediumtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `type` enum('custom','predefined') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resume_templates`
--

INSERT INTO `resume_templates` (`id`, `user_id`, `name`, `template_config`, `created_at`, `updated_at`, `deleted_at`, `type`) VALUES
(5, 0, 'Template 1', '{\"template_file\":\"template1\",\"colorPrimary\":\"#8080ff\",\"colorSecondary\":\"\",\"skillsStyle\":\"bar\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"18px\",\"ts2\":\"14px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":true},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Comic+Sans+MS\"}', '2022-04-25 16:07:02', '2022-04-25 16:07:02', NULL, 'predefined'),
(6, 0, 'Template 2', '{\"template_file\":\"template2\",\"colorPrimary\":\"#800040\",\"colorSecondary\":\"\",\"skillsStyle\":\"bar\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"18px\",\"ts2\":\"14px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":true},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Arial\"}', '2022-04-25 16:08:34', '2022-04-25 16:08:34', NULL, 'predefined'),
(7, 0, 'Template 3', '{\"template_file\":\"template3\",\"colorPrimary\":\"#ff8000\",\"colorSecondary\":\"\",\"skillsStyle\":\"bar\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"18px\",\"ts2\":\"14px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":true},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Arial\"}', '2022-04-25 16:09:13', '2022-04-25 16:09:13', NULL, 'predefined'),
(8, 0, 'Template 4', '{\"template_file\":\"template4\",\"colorPrimary\":\"#000080\",\"colorSecondary\":\"\",\"skillsStyle\":\"bar\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"18px\",\"ts2\":\"14px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":true},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Arial\"}', '2022-04-25 16:09:45', '2022-04-25 16:09:45', NULL, 'predefined'),
(9, 8, 'my template 1', '{\"template_file\":\"template1\",\"colorPrimary\":\"#0080c0\",\"colorSecondary\":\"\",\"skillsStyle\":\"star\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"20px\",\"ts2\":\"14px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":false},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Impact\"}', '2022-04-25 17:16:44', '2022-04-26 11:15:23', NULL, 'custom'),
(10, 8, 'my template 3 star', '{\"template_file\":\"template3\",\"colorPrimary\":\"#808000\",\"colorSecondary\":\"\",\"skillsStyle\":\"star\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"18px\",\"ts2\":\"14px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":true},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Arial\"}', '2022-04-25 18:21:12', '2022-04-25 18:21:12', NULL, 'custom'),
(11, 8, 'my template 3 star orange', '{\"template_file\":\"template3\",\"colorPrimary\":\"#ff8000\",\"colorSecondary\":\"\",\"skillsStyle\":\"bar\",\"font\":\"Roboto-Regular.ttf\",\"ts1\":\"22px\",\"ts2\":\"16px\",\"ts3\":\"10px\",\"sections\":[{\"code\":\"WE\",\"name\":\"Work Experience\",\"isVisible\":true},{\"code\":\"ED\",\"name\":\"Education Details\",\"isVisible\":true},{\"code\":\"CC\",\"name\":\"Courses and Certifications\",\"isVisible\":true},{\"code\":\"PRJ\",\"name\":\"Projects\",\"isVisible\":false}],\"fontFamily\":\"Arial\"}', '2022-05-02 15:17:03', '2022-05-02 15:17:03', NULL, 'custom');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(40) NOT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `role_type` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `role_capability`;
CREATE TABLE IF NOT EXISTS `role_capability` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL,
  `capability_id` int(10) UNSIGNED NOT NULL,
  `is_allowed` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_capability`
--

INSERT INTO `role_capability` (`id`, `role_id`, `capability_id`, `is_allowed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 7, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(2, 3, 8, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(3, 3, 9, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(4, 3, 10, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(5, 3, 11, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(6, 3, 12, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(7, 3, 13, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(8, 3, 14, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(9, 3, 15, 0, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(10, 3, 16, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(11, 3, 17, 1, '2021-12-01 11:38:33', '2022-02-17 14:31:32', NULL),
(12, 7, 17, 1, '2021-12-01 11:38:33', '2021-12-08 10:44:09', NULL),
(13, 6, 12, 1, '2021-12-01 11:38:33', '2022-04-21 15:13:08', NULL),
(14, 6, 17, 0, '2021-12-01 11:38:33', '2022-04-21 15:13:08', NULL),
(15, 3, 4, 0, '2021-12-03 11:45:33', '2022-02-17 14:31:32', NULL),
(16, 3, 5, 0, '2021-12-03 11:46:22', '2022-02-17 14:31:32', NULL),
(17, 3, 6, 0, '2021-12-03 11:46:22', '2022-02-17 14:31:32', NULL),
(18, 3, 3, 0, '2021-12-03 11:46:22', '2022-02-17 14:31:32', NULL),
(19, 6, 14, 0, '2021-12-03 11:47:07', '2022-04-21 15:13:08', NULL),
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
(35, 6, 11, 0, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(36, 6, 27, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(37, 6, 24, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(38, 6, 29, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(39, 6, 25, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(40, 6, 26, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(41, 6, 28, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(42, 6, 23, 1, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(43, 6, 7, 0, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(44, 6, 8, 0, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(45, 6, 10, 0, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(46, 6, 16, 0, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(47, 6, 19, 0, '2021-12-07 15:17:08', '2022-04-21 15:13:08', NULL),
(48, 7, 12, 1, '2021-12-07 15:18:04', '2021-12-08 10:44:09', NULL),
(49, 7, 24, 1, '2021-12-07 15:18:04', '2021-12-08 10:44:09', NULL),
(50, 7, 28, 1, '2021-12-07 15:18:04', '2021-12-08 10:44:09', NULL),
(51, 7, 23, 0, '2021-12-08 10:44:09', '2021-12-08 10:44:09', NULL),
(52, 8, 17, 0, '2021-12-09 17:41:35', '2022-02-17 14:55:01', NULL),
(53, 8, 3, 1, '2021-12-09 17:41:35', '2022-02-17 14:55:01', NULL),
(54, 8, 4, 1, '2021-12-09 17:41:35', '2022-02-17 14:55:01', NULL),
(55, 8, 6, 0, '2021-12-09 17:41:35', '2022-02-17 14:55:01', NULL),
(56, 8, 15, 0, '2021-12-09 17:41:35', '2022-02-17 14:55:01', NULL),
(57, 3, 39, 0, '2022-02-17 14:30:10', '2022-02-17 14:31:32', NULL),
(58, 3, 40, 0, '2022-02-17 14:30:10', '2022-02-17 14:31:32', NULL),
(59, 3, 38, 1, '2022-02-17 14:31:32', '2022-02-17 14:31:32', NULL),
(60, 8, 38, 0, '2022-02-17 14:41:27', '2022-02-17 14:55:01', NULL),
(61, 8, 16, 0, '2022-02-17 14:41:27', '2022-02-17 14:55:01', NULL),
(62, 6, 39, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(63, 6, 41, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(64, 6, 40, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(65, 6, 42, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(66, 6, 38, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(67, 6, 44, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(68, 6, 46, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(69, 6, 45, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(70, 6, 47, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(71, 6, 43, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(72, 6, 34, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(73, 6, 36, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(74, 6, 35, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(75, 6, 37, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(76, 6, 33, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(77, 6, 49, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(78, 6, 51, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(79, 6, 50, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(80, 6, 52, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(81, 6, 53, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(82, 6, 48, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(83, 6, 30, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(84, 6, 13, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(85, 6, 31, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(86, 6, 9, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(87, 6, 21, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(88, 6, 20, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(89, 6, 22, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(90, 6, 18, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(91, 6, 3, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(92, 6, 5, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(93, 6, 4, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(94, 6, 6, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL),
(95, 6, 15, 0, '2022-03-07 18:14:19', '2022-04-21 15:13:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(100) NOT NULL,
  `value` text,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `setting_name`, `value`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'site_title', 'BitstringIT', '2022-04-21 14:42:12', '2022-04-21 14:42:12', NULL),
(2, 'site_footer', '<strong>Copyright © 2022 <a href=\"http://localhost/profiles-management\">Bitstring</a>.</strong>\n    All rights reserved.', '2022-04-21 14:42:12', '2022-04-21 14:42:12', NULL),
(3, 'site_logo', 'assets/images/1650864690_21a7b9c6cdb3e370756d.png', '2022-04-21 15:21:34', '2022-04-21 15:21:34', NULL),
(4, 'smtp_host', 'mail.bitstringit.in', '2022-04-21 15:21:34', '2022-04-21 15:21:34', NULL),
(5, 'smtp_user', 'somesh@bitstringit.in', '2022-04-21 15:21:34', '2022-04-21 15:21:34', NULL),
(6, 'smtp_pass', '1234567890', '2022-04-21 15:21:34', '2022-04-21 15:21:34', NULL),
(7, 'smtp_port', '587', '2022-04-21 15:21:34', '2022-04-21 15:21:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type` int(10) DEFAULT '0',
  `user_role` int(10) DEFAULT NULL,
  `owner_id` int(10) UNSIGNED DEFAULT NULL,
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
  `password` varchar(200) DEFAULT NULL,
  `profile_picture` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `ip_address` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `verification_code` varchar(10) DEFAULT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_role`, `owner_id`, `fname`, `lname`, `email`, `mobile`, `company_name`, `address`, `country`, `state`, `city`, `pincode`, `password`, `profile_picture`, `ip_address`, `status`, `verification_code`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 0, 3, 8, 'someshwar', 'badade', 'someshbadade@gmail.com', '8806056756', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uVyM/KRv7ElPob.IzLVX9.VXblblk919BWjxshU16jw8kXz7jG.Hm', '', '', 1, NULL, '2021-06-02 15:24:24', '2021-06-02 04:54:24', '2022-05-02 14:32:23', NULL),
(9, 0, 3, 9, 'Somesh', 'Badade', 'somesh@bitstringit.in', '', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uVyM/KRv7ElPob.IzLVX9.VXblblk919BWjxshU16jw8kXz7jG.Hm', '', '', 1, NULL, '2021-06-17 09:50:34', '2021-06-16 23:20:34', '2022-05-02 12:17:40', NULL),
(10, 0, 0, 0, 'Avinash', 'Gunjkar', 'avinash.gunjkar@bitstringit.in', '8806056756', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$.CZWivV5tRMRwAsZJ5w34eeNsCfajzyIYhjlgBGRVxC6K6Wo6I0zC', '', '', 1, NULL, '2021-12-09 18:26:30', '2021-12-09 18:26:30', '2021-12-20 12:27:21', NULL),
(11, 0, 0, 0, 'qerw', 'qwer', 'wrewer@asdfasd.dd', '1213213132', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 1, NULL, '2021-12-09 18:29:29', '2021-12-09 18:29:29', '2021-12-09 18:29:29', NULL),
(12, 0, 0, 0, 'adsf', 'asdf', 'dafasdf@adsf.dd', '4654564645', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$zPWeoa3Db6kgctzKBU81tutyKUuocbkyVDs6c.kDba4lRfuFOgwK6', '', '', 1, NULL, '2021-12-13 10:32:08', '2021-12-13 10:32:08', '2021-12-13 10:32:08', NULL),
(13, 0, 0, 0, 'adsf', 'asdf', 'dafasdf2@adsf.dd', '4654564645', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WXPFX01UYNKg.CWUFaRNROcaze8cPT3ASt1HScBuI9NWYukLrsyPC', '', '', 1, NULL, '2021-12-13 10:33:37', '2021-12-13 10:33:37', '2021-12-13 10:33:37', NULL),
(14, 0, 0, 0, 'qewrq', 'qwerweqr', 'wqerwerwe@asdf.dd', '1231231231', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$2LHfvELJ2nrHVME7jb5Vm.5SbsJZ9TGAH5MwBh5jLwQhKcWifAz1K', '', '', 1, NULL, '2021-12-13 10:34:34', '2021-12-13 10:34:34', '2021-12-13 13:05:36', NULL),
(20, 0, NULL, NULL, 'Mayur', 'Samrit', 'mayur.sasmrit@bitstringit.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '31114641', '2022-03-08 16:59:44', '2022-03-08 16:59:44', '2022-03-08 16:59:44', NULL),
(21, 0, NULL, NULL, 'mayur', 'samrit', 'mayur.samrit@bitstringit.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '19133725', '2022-03-08 17:05:15', '2022-03-08 17:05:15', '2022-03-08 17:05:15', NULL),
(22, 0, NULL, NULL, 'Avinash', 'Gunjkar', 'avinash@bitstringit.in', '', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$CN12St8oiBTHXep3TzXOgei8IIrkZNga.0ywdldlWTtCy2/gSVzH6', NULL, NULL, 1, NULL, '2022-03-09 13:00:23', '2022-03-09 13:00:23', '2022-03-09 13:00:23', NULL),
(23, 0, NULL, NULL, 'abc', 'abc', 'abc@bitstringit.in', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-03-09 14:57:30', '2022-03-09 14:57:30', '2022-03-09 14:59:39', NULL),
(24, 0, NULL, NULL, 'pqr', 'pqr', 'pqr@bitstringit.in', '1234567899', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-03-09 14:57:30', '2022-03-09 14:57:30', '2022-03-09 15:02:39', NULL),
(25, 0, NULL, NULL, 'Ajay', 'Kumar', 'ajay@nomail.com', '1234567899', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-03-09 14:57:30', '2022-03-09 14:57:30', '2022-03-09 15:03:35', NULL),
(26, 0, NULL, NULL, 'Rakesh', 'Kumar', 'rakesh@nomail.com', '123456734', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-03-09 14:57:30', '2022-03-09 14:57:30', '2022-03-09 15:05:22', NULL),
(27, 0, NULL, NULL, 'abc', 'xyz', 'abc@nomaill.com', '', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$q1r9/SyIxhUFpkytSc1udu9RIrx8QZWMADjjGPp7pFQc/Rrc86te6', NULL, NULL, 1, NULL, '2022-03-14 12:16:36', '2022-03-14 12:16:36', '2022-03-14 12:16:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_policy_documents`
--

DROP TABLE IF EXISTS `user_policy_documents`;
CREATE TABLE IF NOT EXISTS `user_policy_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `view_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_policy_documents`
--

INSERT INTO `user_policy_documents` (`id`, `user_id`, `document_id`, `view_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 9, 4, '2022-04-08 12:40:52', '2022-04-08 11:39:57', '2022-04-08 12:40:52', NULL),
(3, 9, 3, '2022-04-12 10:20:10', '2022-04-08 11:40:18', '2022-04-12 10:20:10', NULL),
(4, 8, 4, '2022-04-08 12:41:01', '2022-04-08 12:41:01', '2022-04-08 12:41:01', NULL),
(5, 8, 3, '2022-04-08 13:01:53', '2022-04-08 13:01:53', '2022-04-08 13:01:53', NULL),
(6, 8, 5, '2022-04-08 17:38:49', '2022-04-08 13:04:06', '2022-04-08 17:38:49', NULL),
(7, 9, 5, '2022-04-08 17:42:29', '2022-04-08 16:47:28', '2022-04-08 17:42:29', NULL),
(8, 9, 2, '2022-04-08 17:04:50', '2022-04-08 17:02:52', '2022-04-08 17:04:50', NULL),
(9, 9, 6, '2022-04-12 10:19:53', '2022-04-08 17:07:41', '2022-04-12 10:19:53', NULL),
(10, 8, 6, '2022-04-08 17:31:43', '2022-04-08 17:29:16', '2022-04-08 17:31:43', NULL),
(11, 8, 1, '2022-04-08 17:40:32', '2022-04-08 17:38:12', '2022-04-08 17:40:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 1, '2021-12-01 14:39:36', NULL, NULL),
(3, 13, 8, '2021-12-13 10:33:37', '2021-12-13 10:33:37', NULL),
(11, 1, 8, '2021-12-13 12:01:54', '2021-12-13 12:01:54', NULL),
(25, 14, 7, '2021-12-13 13:05:36', '2021-12-13 13:05:36', NULL),
(27, 10, 7, '2021-12-20 12:27:21', '2021-12-20 12:27:21', NULL),
(33, 8, 6, '2022-03-07 16:11:44', '2022-05-02 11:34:34', '2022-05-02 11:34:34'),
(34, 8, 6, '2022-03-07 16:11:56', '2022-05-02 11:34:34', '2022-05-02 11:34:34'),
(35, 8, 6, '2022-03-07 16:12:54', '2022-05-02 11:34:34', '2022-05-02 11:34:34'),
(36, 8, 6, '2022-03-07 16:20:43', '2022-05-02 11:34:34', '2022-05-02 11:34:34'),
(37, 21, 6, '2022-03-08 17:05:15', '2022-03-08 17:05:15', NULL),
(38, 22, 6, '2022-03-09 13:00:23', '2022-03-09 13:00:23', NULL),
(39, 27, 6, '2022-03-14 12:16:36', '2022-03-14 12:16:36', NULL),
(40, 8, 3, '2022-05-02 11:17:17', '2022-05-02 11:34:34', '2022-05-02 11:34:34'),
(41, 8, 6, '2022-05-02 11:34:34', '2022-05-02 11:34:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_positions`
--
ALTER TABLE `job_positions` ADD FULLTEXT KEY `primary_skills` (`primary_skills`);
ALTER TABLE `job_positions` ADD FULLTEXT KEY `secondary_skills` (`secondary_skills`);

--
-- Indexes for table `master_skills`
--
ALTER TABLE `master_skills` ADD FULLTEXT KEY `text` (`text`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles` ADD FULLTEXT KEY `primary_skills` (`primary_skills`);
ALTER TABLE `profiles` ADD FULLTEXT KEY `secondary_skills` (`secondary_skills`);
ALTER TABLE `profiles` ADD FULLTEXT KEY `foundation_skills` (`foundation_skills`);
ALTER TABLE `profiles` ADD FULLTEXT KEY `primary_skills_soundex` (`primary_skills_soundex`);
ALTER TABLE `profiles` ADD FULLTEXT KEY `secondary_skills_soundex` (`secondary_skills_soundex`);
ALTER TABLE `profiles` ADD FULLTEXT KEY `foundation_skills_soundex` (`foundation_skills_soundex`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
