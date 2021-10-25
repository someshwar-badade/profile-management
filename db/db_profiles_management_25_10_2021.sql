-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 25, 2021 at 07:06 AM
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
  `action_type` enum('created','updated','deleted') CHARACTER SET utf8 NOT NULL,
  `model` enum('login','user','category','product','kyc-approval','profile-plan','order','faq') CHARACTER SET utf8 NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL,
  `chaged_data` longtext CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `action_type` (`action_type`),
  KEY `model` (`model`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_log`
--

INSERT INTO `action_log` (`id`, `user_id`, `action_type`, `model`, `record_id`, `chaged_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'created', 'user', 6, '{\"id\":\"6\",\"user_type\":\"0\",\"user_role\":\"0\",\"owner_id\":\"6\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade2@gmail.com\",\"mobile\":null,\"company_name\":null,\"address\":null,\"country\":null,\"state\":null,\"city\":null,\"pincode\":null,\"password\":\"$2y$10$NV96McZaD5v44w\\/HD25Lf.J9vvivWhSyBuYpYV2.Vl3\",\"profile_picture\":\"\",\"ip_address\":\"\",\"status\":\"1\",\"last_login\":\"2021-06-02 12:24:05\",\"created_at\":\"2021-06-02 01:54:05\",\"updated_at\":\"2021-06-02 01:54:05\",\"deleted_at\":null}', '2021-06-02 01:54:05', '2021-06-02 01:54:05', NULL),
(2, 7, 'created', 'user', 7, '{\"id\":\"7\",\"user_type\":\"0\",\"user_role\":\"0\",\"owner_id\":\"7\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade3@gmail.com\",\"mobile\":null,\"company_name\":null,\"address\":null,\"country\":null,\"state\":null,\"city\":null,\"pincode\":null,\"password\":\"$2y$10$7pwBSmawAHlsQAGmozfF7eiL4jK.EGaT9MV5LOK4CC\\/\",\"profile_picture\":\"\",\"ip_address\":\"\",\"status\":\"1\",\"last_login\":\"2021-06-02 12:29:26\",\"created_at\":\"2021-06-02 01:59:26\",\"updated_at\":\"2021-06-02 01:59:26\",\"deleted_at\":null}', '2021-06-02 01:59:26', '2021-06-02 01:59:26', NULL),
(3, 8, 'created', 'user', 8, '{\"id\":\"8\",\"user_type\":\"0\",\"user_role\":\"0\",\"owner_id\":\"8\",\"fname\":\"someshwar\",\"lname\":\"badade\",\"email\":\"someshbadade@gmail.com\",\"mobile\":null,\"company_name\":null,\"address\":null,\"country\":null,\"state\":null,\"city\":null,\"pincode\":null,\"password\":\"$2y$10$IxSFlAOS3eXlqRTLy1rEqetXA6hStYO1NDKB3dVddom6.oU9GdgDe\",\"profile_picture\":\"\",\"ip_address\":\"\",\"status\":\"1\",\"last_login\":\"2021-06-02 15:24:24\",\"created_at\":\"2021-06-02 04:54:24\",\"updated_at\":\"2021-06-02 04:54:24\",\"deleted_at\":null}', '2021-06-02 04:54:24', '2021-06-02 04:54:24', NULL),
(4, 8, 'created', 'login', 8, '{\"login\":\"2021-06-02 04:55:43\"}', '2021-06-02 04:55:43', '2021-06-02 04:55:43', NULL),
(5, 8, 'created', 'login', 8, '{\"login\":\"2021-06-02 05:25:40\"}', '2021-06-02 05:25:40', '2021-06-02 05:25:40', NULL),
(6, 8, 'created', 'login', 8, '{\"login\":\"2021-06-02 06:11:20\"}', '2021-06-02 06:11:20', '2021-06-02 06:11:20', NULL),
(7, 8, 'created', 'login', 8, '{\"login\":\"2021-06-02 08:20:22\"}', '2021-06-02 08:20:22', '2021-06-02 08:20:22', NULL),
(8, 8, 'created', 'login', 8, '{\"login\":\"2021-06-03 23:55:58\"}', '2021-06-03 23:55:58', '2021-06-03 23:55:58', NULL),
(9, 8, 'created', 'login', 8, '{\"login\":\"2021-06-07 23:39:10\"}', '2021-06-07 23:39:10', '2021-06-07 23:39:10', NULL),
(10, 8, 'created', 'login', 8, '{\"login\":\"2021-06-10 04:29:41\"}', '2021-06-10 04:29:41', '2021-06-10 04:29:41', NULL),
(11, 8, 'created', 'user', 2, '{\"animal_id\":\"1\",\"date\":\"2021-06-03\",\"vaccine_name\":\"adasd\",\"remark\":\"na na\"}', '2021-06-10 05:35:56', '2021-06-10 05:35:56', NULL),
(12, 8, 'created', 'user', 2, '{\"date\":\"2021-06-04\"}', '2021-06-10 06:08:53', '2021-06-10 06:08:53', NULL),
(13, 8, 'created', 'user', 2, '{\"remark\":\"na na asfajksfa sdkjash fkjsad\"}', '2021-06-10 06:09:19', '2021-06-10 06:09:19', NULL),
(14, 8, 'created', 'user', 2, '{\"remark\":\"na na asfajk  sdfd sfa sdkjash fkjsad\"}', '2021-06-10 06:10:52', '2021-06-10 06:10:52', NULL),
(15, 8, 'deleted', '', 2, '{\"id\":\"2\",\"animal_id\":\"1\",\"date\":\"2021-06-04\",\"vaccine_name\":\"adasd\",\"remark\":\"na na asfajk  sdfd sfa sdkjash fkjsad\",\"created_at\":\"2021-06-10 05:35:56\",\"updated_at\":\"2021-06-10 06:10:52\",\"deleted_at\":null}', '2021-06-10 06:23:25', '2021-06-10 06:23:25', NULL),
(16, 8, 'deleted', '', 1, '{\"id\":\"1\",\"animal_id\":\"1\",\"date\":\"2021-06-10\",\"vaccine_name\":\"ttc\",\"remark\":\"na\",\"created_at\":\"2021-06-10 15:11:38\",\"updated_at\":\"2021-06-10 15:11:38\",\"deleted_at\":null}', '2021-06-10 06:24:33', '2021-06-10 06:24:33', NULL),
(17, 8, 'created', '', 3, '{\"animal_id\":\"1\",\"date\":\"2021-06-03\",\"vaccine_name\":\"adasd\",\"remark\":\"na na\"}', '2021-06-10 06:32:01', '2021-06-10 06:32:01', NULL),
(18, 8, 'created', '', 4, '{\"animal_id\":\"2\",\"date\":\"2021-06-03\",\"vaccine_name\":\"adasd\",\"remark\":\"na na\"}', '2021-06-10 06:32:39', '2021-06-10 06:32:39', NULL),
(19, 8, 'created', '', 5, '{\"animal_id\":\"3\",\"date\":\"2021-06-03\",\"vaccine_name\":\"adasd\",\"remark\":\"na na\"}', '2021-06-10 06:32:43', '2021-06-10 06:32:43', NULL),
(20, 8, 'created', '', 6, '{\"animal_id\":\"3\",\"date\":\"2021-01-03\",\"vaccine_name\":\"sdfa \",\"remark\":\"na na\"}', '2021-06-10 06:32:53', '2021-06-10 06:32:53', NULL),
(21, 8, 'created', '', 7, '{\"animal_id\":\"3\",\"date\":\"2021-02-03\",\"vaccine_name\":\"sdfa \",\"remark\":\"na na\"}', '2021-06-10 06:32:56', '2021-06-10 06:32:56', NULL),
(22, 8, 'created', '', 8, '{\"animal_id\":\"3\",\"date\":\"2021-03-03\",\"vaccine_name\":\"sdfa \",\"remark\":\"na na\"}', '2021-06-10 06:32:59', '2021-06-10 06:32:59', NULL),
(23, 8, 'created', '', 9, '{\"animal_id\":\"3\",\"date\":\"2021-04-03\",\"vaccine_name\":\"sdfa \",\"remark\":\"na na\"}', '2021-06-10 06:33:03', '2021-06-10 06:33:03', NULL),
(24, 8, 'created', '', 10, '{\"animal_id\":\"1\",\"date\":\"2021-04-04\",\"vaccine_name\":\"sdfa \",\"remark\":\"na na\"}', '2021-06-10 06:33:14', '2021-06-10 06:33:14', NULL),
(25, 8, 'created', '', 11, '{\"animal_id\":\"2\",\"date\":\"2021-04-04\",\"vaccine_name\":\"sdfa \",\"remark\":\"na na\"}', '2021-06-10 06:33:20', '2021-06-10 06:33:20', NULL),
(26, 8, 'created', '', 2, '{\"animal_id\":\"2\",\"date\":\"2021-04-04\",\"height\":\"30\",\"weight\":\"3\",\"remark\":\"ok\"}', '2021-06-10 07:15:54', '2021-06-10 07:15:54', NULL),
(27, 8, 'updated', '', 2, '{\"animal_id\":\"1\",\"date\":\"2021-06-04\",\"weight\":\"32\",\"height\":\"4\"}', '2021-06-10 07:18:13', '2021-06-10 07:18:13', NULL),
(28, 8, 'deleted', '', 1, '{\"id\":\"1\",\"animal_id\":\"1\",\"date\":\"2021-06-10\",\"weight\":\"11\",\"height\":\"30\",\"remark\":\"na\",\"created_at\":\"2021-06-10 15:03:54\",\"updated_at\":\"2021-06-10 15:03:54\",\"deleted_at\":null}', '2021-06-10 07:19:39', '2021-06-10 07:19:39', NULL),
(29, 8, 'created', '', 1, '{\"animal_id\":\"2\",\"insurance_company\":\"Star\",\"plan_name\":\"P4546\",\"policy_number\":\"4546\",\"agent_name\":\"abc\"}', '2021-06-10 07:26:01', '2021-06-10 07:26:01', NULL),
(30, 8, 'created', 'login', 8, '{\"login\":\"2021-06-14 01:13:37\"}', '2021-06-14 01:13:37', '2021-06-14 01:13:37', NULL),
(31, 8, 'created', 'login', 8, '{\"login\":\"2021-06-14 07:13:17\"}', '2021-06-14 07:13:17', '2021-06-14 07:13:17', NULL),
(32, 8, 'created', 'login', 8, '{\"login\":\"2021-06-15 04:17:13\"}', '2021-06-15 04:17:13', '2021-06-15 04:17:13', NULL),
(33, 8, 'created', 'login', 8, '{\"login\":\"2021-06-16 05:28:23\"}', '2021-06-16 05:28:23', '2021-06-16 05:28:23', NULL),
(34, 9, 'created', 'user', 9, '{\"id\":\"9\",\"user_type\":\"0\",\"user_role\":\"0\",\"owner_id\":\"9\",\"fname\":\"Someshwar\",\"lname\":\"Badade\",\"email\":\"somesh@bitstringit.in\",\"mobile\":\"\",\"company_name\":null,\"address\":null,\"country\":null,\"state\":null,\"city\":null,\"pincode\":null,\"password\":\"$2y$10$\\/Iq7VqBDOC\\/1e6nboSzBku8Xbubf6JUKR273c\\/BgJlYlX3881Rq16\",\"profile_picture\":\"\",\"ip_address\":\"\",\"status\":\"1\",\"last_login\":\"2021-06-17 09:50:34\",\"created_at\":\"2021-06-16 23:20:34\",\"updated_at\":\"2021-06-16 23:20:34\",\"deleted_at\":null}', '2021-06-16 23:20:34', '2021-06-16 23:20:34', NULL),
(35, 9, 'created', 'login', 9, '{\"login\":\"2021-06-17 23:25:28\"}', '2021-06-17 23:25:28', '2021-06-17 23:25:28', NULL),
(36, 9, 'created', '', 12, '{\"animal_id\":\"1\",\"date\":\"2021-05-31T18:30:00.000Z\",\"vaccine_name\":\"tcc\",\"remark\":\"sasdf\"}', '2021-06-18 01:05:11', '2021-06-18 01:05:11', NULL),
(37, 9, 'created', '', 13, '{\"animal_id\":\"1\",\"date\":\"2021-05-31T18:30:00.000Z\",\"vaccine_name\":\"tcc\",\"remark\":\"fasfdsdfs\"}', '2021-06-18 01:07:17', '2021-06-18 01:07:17', NULL),
(38, 9, 'created', '', 14, '{\"animal_id\":\"1\",\"date\":\"2021-06-08T18:30:00.000Z\",\"vaccine_name\":\"tcc3\",\"remark\":\"adfasdf\"}', '2021-06-18 01:08:24', '2021-06-18 01:08:24', NULL),
(39, 9, 'created', '', 3, '{\"animal_id\":\"1\",\"date\":\"2021-05-31T18:30:00.000Z\",\"weight\":10,\"height\":100,\"remark\":\"qwerwe\"}', '2021-06-18 03:15:29', '2021-06-18 03:15:29', NULL),
(40, 9, 'created', '', 4, '{\"animal_id\":\"1\",\"date\":\"2021-06-07T18:30:00.000Z\",\"weight\":10,\"height\":100,\"remark\":\"asdf\"}', '2021-06-18 03:16:32', '2021-06-18 03:16:32', NULL),
(41, 9, 'created', '', 15, '{\"animal_id\":\"1\",\"date\":\"2021-06-09T18:30:00.000Z\",\"vaccine_name\":\"tdad\",\"remark\":\"adfas\"}', '2021-06-18 03:21:49', '2021-06-18 03:21:49', NULL),
(42, 9, 'created', '', 16, '{\"animal_id\":\"1\",\"date\":\"2021-06-12T18:30:00.000Z\",\"vaccine_name\":\"test\",\"remark\":\"test update1\"}', '2021-06-18 03:22:39', '2021-06-18 03:22:39', NULL),
(43, 9, 'created', '', 17, '{\"animal_id\":\"1\",\"date\":\"2021-05-31T18:30:00.000Z\",\"vaccine_name\":\"asf\",\"remark\":\"test update 2\"}', '2021-06-18 03:27:25', '2021-06-18 03:27:25', NULL),
(44, 9, 'created', '', 18, '{\"animal_id\":\"1\",\"date\":\"2021-06-02T18:30:00.000Z\",\"vaccine_name\":\"affasd\",\"remark\":\"sadfsdf\"}', '2021-06-18 03:31:51', '2021-06-18 03:31:51', NULL),
(45, 9, 'created', '', 19, '{\"animal_id\":\"1\",\"date\":\"2021-05-31T18:30:00.000Z\",\"vaccine_name\":\"t\",\"remark\":\"t\"}', '2021-06-18 03:32:56', '2021-06-18 03:32:56', NULL),
(46, 9, 'created', '', 20, '{\"animal_id\":\"1\",\"date\":\"2021-06-01T18:30:00.000Z\",\"vaccine_name\":\"qwer\",\"remark\":\"qwerwqer\"}', '2021-06-18 03:42:25', '2021-06-18 03:42:25', NULL),
(47, 9, 'created', '', 21, '{\"animal_id\":\"1\",\"date\":\"2021-06-02T18:30:00.000Z\",\"vaccine_name\":\"tt\",\"remark\":\"tt\"}', '2021-06-18 03:43:23', '2021-06-18 03:43:23', NULL),
(48, 9, 'created', '', 22, '{\"animal_id\":\"1\",\"date\":\"2021-06-03T18:30:00.000Z\",\"vaccine_name\":\"qwer\",\"remark\":\"werqwe\"}', '2021-06-18 03:57:26', '2021-06-18 03:57:26', NULL),
(49, 9, 'created', '', 5, '{\"animal_id\":\"1\",\"date\":\"2021-06-09T18:30:00.000Z\",\"weight\":5,\"height\":5,\"remark\":\"5\"}', '2021-06-18 04:02:42', '2021-06-18 04:02:42', NULL),
(50, 8, 'created', 'login', 8, '{\"login\":\"2021-06-18 04:46:12\"}', '2021-06-18 04:46:12', '2021-06-18 04:46:12', NULL),
(51, 9, 'created', '', 2, '{\"animal_id\":\"1\",\"breeding_date\":\"2021-02-28T18:30:00.000Z\",\"birth_type\":\"single\",\"first_kid_tag_id\":\"124123423423\"}', '2021-06-18 05:03:15', '2021-06-18 05:03:15', NULL),
(52, 9, 'created', 'login', 9, '{\"login\":\"2021-06-22 23:27:47\"}', '2021-06-22 23:27:47', '2021-06-22 23:27:47', NULL),
(53, 9, 'created', 'login', 9, '{\"login\":\"2021-06-23 04:04:40\"}', '2021-06-23 04:04:40', '2021-06-23 04:04:40', NULL),
(54, 9, 'created', 'login', 9, '{\"login\":\"2021-06-23 05:03:32\"}', '2021-06-23 05:03:32', '2021-06-23 05:03:32', NULL),
(55, 9, 'created', 'login', 9, '{\"login\":\"2021-06-23 05:09:55\"}', '2021-06-23 05:09:55', '2021-06-23 05:09:55', NULL),
(56, 9, 'created', 'login', 9, '{\"login\":\"2021-06-23 05:35:14\"}', '2021-06-23 05:35:14', '2021-06-23 05:35:14', NULL),
(57, 9, 'created', 'login', 9, '{\"login\":\"2021-06-23 05:38:47\"}', '2021-06-23 05:38:47', '2021-06-23 05:38:47', NULL),
(58, 9, 'created', 'login', 9, '{\"login\":\"2021-06-23 05:53:54\"}', '2021-06-23 05:53:54', '2021-06-23 05:53:54', NULL),
(59, 9, 'created', '', 1, '{\"preferred_work_locations\":\"pune,mumbai\",\"top_skills\":\"PHP,HTML,CSS,JavaScript,Jquery\",\"middle_skills\":\"Angularjs,ReactJS\",\"foundation_skills\":\"ServiceNow\",\"gender\":\"0\",\"candidate_name\":\"someshwar\",\"mobile_primary\":\"8806056756\",\"email_primary\":\"someshbadade@gmail.com\"}', '2021-06-24 07:50:52', '2021-06-24 07:50:52', NULL),
(60, 9, 'created', '', 2, '{\"preferred_work_locations\":\"pune,mumbai\",\"top_skills\":\"PHP,HTML,CSS,JavaScript,Jquery\",\"middle_skills\":\"Angularjs,ReactJS\",\"foundation_skills\":\"ServiceNow\",\"gender\":\"0\",\"candidate_name\":\"someshwar\",\"mobile_primary\":\"8806056756\",\"email_primary\":\"someshbadade@gmail.com\"}', '2021-06-24 08:06:52', '2021-06-24 08:06:52', NULL),
(61, 9, 'created', '', 3, '{\"preferred_work_locations\":\"pune,mumbai\",\"top_skills\":\"PHP,HTML,CSS,JavaScript,Jquery\",\"middle_skills\":\"Angularjs,ReactJS\",\"foundation_skills\":\"ServiceNow\",\"gender\":\"0\",\"candidate_name\":\"someshwar\",\"mobile_primary\":\"8806056756\",\"email_primary\":\"someshbadade@gmail.com\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-24 08:08:35', '2021-06-24 08:08:35', NULL),
(62, 9, 'created', '', 4, '{\"preferred_work_locations\":\"pune,mumbai\",\"top_skills\":\"HTML,CSS,JavaScript,Jquery,PHP,DevOps,Cloud,MySql,Oracal\",\"middle_skills\":\"Angularjs,ReactJS\",\"foundation_skills\":\"ServiceNow\",\"gender\":\"0\",\"candidate_name\":\"Avinash Gunjkar\",\"mobile_primary\":\"8888395979\",\"email_primary\":\"avinash.gunjkar@bitstringit.in\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-24 08:13:35', '2021-06-24 08:13:35', NULL),
(63, 9, 'created', '', 5, '{\"candidate_name\":\"asfha\",\"mobile_primary\":\"897897978798777\",\"mobile_alternate\":\"7979878789\",\"email_primary\":\"adsfasdf@asdfsadf.dfd\",\"gender\":\"1\",\"preferred_work_locations\":\"asdf,asf\",\"top_skills\":\"asfsadf,asfsf\",\"middle_skills\":\"qrqwer`qwerw`\",\"foundation_skills\":\"wrwer\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-24 08:21:43', '2021-06-24 08:21:43', NULL),
(64, 9, 'created', 'login', 9, '{\"login\":\"2021-06-25 00:57:49\"}', '2021-06-25 00:57:49', '2021-06-25 00:57:49', NULL),
(65, 9, 'created', '', 7, '{\"certifications\":[{\"description\":\"description1\"},{\"description\":\"description2\"},{\"description\":\"description3\"}],\"candidate_name\":\"asasdfasd\",\"mobile_primary\":\"1412341\",\"mobile_alternate\":\"234123\",\"email_primary\":\"sasfasf@adsfasd.dd\",\"gender\":\"0\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 01:07:19', '2021-06-25 01:07:19', NULL),
(66, 9, 'created', '', 8, '{\"certifications\":[{\"description\":\"description1\"},{\"description\":\"description2\"},{\"description\":\"description3\"}],\"candidate_name\":\"asasdfasd\",\"mobile_primary\":\"1412341\",\"mobile_alternate\":\"234123\",\"email_primary\":\"sasfasf@adsfasd.dd\",\"gender\":\"0\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 01:08:11', '2021-06-25 01:08:11', NULL),
(67, 9, 'created', '', 9, '{\"certifications\":[{\"description\":\"description1\"}],\"candidate_name\":\"adfjagsdfhasd asgfjagsfj\",\"mobile_primary\":\"8797979\",\"mobile_alternate\":\"987879\",\"email_primary\":\"asdfasdf@asdfasd.dd\",\"email_alternate\":\"sdsfsaf@asfsdaf.dd\",\"gender\":\"1\",\"middle_skills\":\"asasdfs, wwe, wrwer\",\"preferred_work_locations\":\"qeqweq\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 01:09:28', '2021-06-25 01:09:28', NULL),
(68, 9, 'created', '', 10, '{\"certifications\":[{\"description\":\"description1\"}],\"gender\":\"1\",\"candidate_name\":\"asdfh afahsd jkf\",\"mobile_primary\":\"779878\",\"mobile_alternate\":\"79879879\",\"email_primary\":\"adfasdf@asdf.dd\",\"preferred_work_locations\":\"qewrqwe\",\"top_skills\":\"dafsdf\",\"middle_skills\":\"asdf\",\"foundation_skills\":\"sdfsd\",\"resume_pdf\":\"1624609399_e6b8c2f5a3772afb5d2a.docx\",\"resume_pdf_name\":\"How_To_Use_Git.docx\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 03:23:19', '2021-06-25 03:23:19', NULL),
(69, 9, 'created', '', 11, '{\"certifications\":[{\"description\":\"description1\"}],\"gender\":\"1\",\"candidate_name\":\"asdfh afahsd jkf\",\"mobile_primary\":\"779878\",\"mobile_alternate\":\"79879879\",\"email_primary\":\"adfasdf@asdf.dd\",\"preferred_work_locations\":\"qewrqwe\",\"top_skills\":\"dafsdf\",\"middle_skills\":\"asdf\",\"foundation_skills\":\"sdfsd\",\"resume_pdf\":\"1624609453_d2c43f8bd21e290ee0d6.docx\",\"resume_pdf_name\":\"How_To_Use_Git.docx\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 03:24:13', '2021-06-25 03:24:13', NULL),
(70, 9, 'created', '', 12, '{\"certifications\":[{\"description\":\"werwer\"}],\"candidate_name\":\"qeioqeur\",\"mobile_primary\":\"879797\",\"mobile_alternate\":\"97978\",\"email_primary\":\"asfasdf@asdfsad.dd\",\"email_alternate\":\"afasdfds@adsfad.dd\",\"gender\":\"0\",\"preferred_work_locations\":\"qewrqw\",\"top_skills\":\"werwe\",\"middle_skills\":\"werwe\",\"foundation_skills\":\"werwe\",\"resume_pdf\":\"1624612965_3225c0af7019e1b3b843.pdf\",\"resume_pdf_name\":\"document(18).pdf\",\"resume_doc\":\"1624612965_38d4d5e59302a9e93867.docx\",\"resume_doc_name\":\"How_To_Use_Git.docx\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 04:22:45', '2021-06-25 04:22:45', NULL),
(71, 9, 'created', '', 13, '{\"certifications\":[{\"description\":\"werwer\"}],\"candidate_name\":\"qeioqeur\",\"mobile_primary\":\"879797\",\"mobile_alternate\":\"97978\",\"email_primary\":\"asfasdf@asdfsad.dd\",\"email_alternate\":\"afasdfds@adsfad.dd\",\"gender\":\"0\",\"preferred_work_locations\":\"qewrqw\",\"top_skills\":\"werwe\",\"middle_skills\":\"werwe\",\"foundation_skills\":\"werwe\",\"resume_pdf\":\"1624612976_0c9e45447aaa979810c4.pdf\",\"resume_pdf_name\":\"document(18).pdf\",\"resume_doc\":\"1624612976_f91768ddbc0041cd46ad.docx\",\"resume_doc_name\":\"How_To_Use_Git.docx\",\"created_by\":\"9\",\"updated_by\":\"9\"}', '2021-06-25 04:22:56', '2021-06-25 04:22:56', NULL),
(72, 9, 'updated', '', 3, '{\"mobile_alternate\":\"78798787987987\",\"resume_pdf\":\"1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_pdf_name\":\"document(18).pdf\",\"resume_doc\":\"1624616572_75b5ecbcdc364b286b98.docx\",\"resume_doc_name\":\"How_To_Use_Git.docx\",\"certifications\":\"[]\",\"resume_word\":\"\"}', '2021-06-25 05:22:52', '2021-06-25 05:22:52', NULL),
(73, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"certifications\":\"[{\\\"description\\\":\\\"asdfasdfdf\\\"}]\",\"resume_word\":\"\"}', '2021-06-25 05:23:44', '2021-06-25 05:23:44', NULL),
(74, 9, 'updated', '', 3, '{\"email_alternate\":\"adfsdfsdfadssad13213123@adfsdaf12.dd\",\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"resume_word\":\"\"}', '2021-06-25 05:24:04', '2021-06-25 05:24:04', NULL),
(75, 9, 'updated', '', 7, '{\"preferred_work_locations\":\"rqwerq, qewrqwe\",\"top_skills\":\"qewreqw, erqwerwqe\",\"certifications\":\"[{\\\"description\\\":\\\"description1\\\"}]\",\"resume_word\":\"\"}', '2021-06-25 05:26:45', '2021-06-25 05:26:45', NULL),
(76, 9, 'updated', '', 5, '{\"email_alternate\":\"qwrewewqe@asdfadsf.dd\",\"certifications\":\"[]\",\"created_by\":\"Someshwar Badade\",\"resume_word\":\"\"}', '2021-06-25 06:10:35', '2021-06-25 06:10:35', NULL),
(77, 9, 'created', 'login', 9, '{\"login\":\"2021-06-25 06:42:31\"}', '2021-06-25 06:42:31', '2021-06-25 06:42:31', NULL),
(78, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"created_by\":\"Someshwar Badade\",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 05:24 AM\",\"resume_word\":\"\"}', '2021-06-25 07:26:27', '2021-06-25 07:26:27', NULL),
(79, 9, 'updated', '', 3, '{\"created_by\":\"Someshwar Badade\",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 05:24 AM\",\"resume_word\":\"\"}', '2021-06-25 07:26:32', '2021-06-25 07:26:32', NULL),
(80, 9, 'updated', '', 3, '{\"created_by\":\"Someshwar Badade\",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 05:24 AM\",\"resume_word\":\"\"}', '2021-06-25 07:26:39', '2021-06-25 07:26:39', NULL),
(81, 9, 'updated', '', 3, '{\"created_by\":\"Someshwar Badade\",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 05:24 AM\",\"resume_word\":\"\"}', '2021-06-25 07:26:43', '2021-06-25 07:26:43', NULL),
(82, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:26 AM\",\"resume_word\":\"\"}', '2021-06-25 07:27:23', '2021-06-25 07:27:23', NULL),
(83, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:26 AM\",\"resume_word\":\"\"}', '2021-06-25 07:27:24', '2021-06-25 07:27:24', NULL),
(84, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:26 AM\",\"resume_word\":\"\"}', '2021-06-25 07:27:33', '2021-06-25 07:27:33', NULL),
(85, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_19e2b41f21dc7cefb20b.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624616572_75b5ecbcdc364b286b98.docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:26 AM\",\"resume_word\":\"\"}', '2021-06-25 07:28:35', '2021-06-25 07:28:35', NULL),
(86, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:28 AM\",\"resume_word\":\"\"}', '2021-06-25 07:28:58', '2021-06-25 07:28:58', NULL),
(87, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:28 AM\",\"resume_word\":\"\"}', '2021-06-25 07:29:00', '2021-06-25 07:29:00', NULL),
(88, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:28 AM\",\"resume_word\":\"\"}', '2021-06-25 07:29:01', '2021-06-25 07:29:01', NULL),
(89, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:28 AM\",\"resume_word\":\"\"}', '2021-06-25 07:29:04', '2021-06-25 07:29:04', NULL),
(90, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:28 AM\",\"resume_word\":\"\"}', '2021-06-25 07:29:05', '2021-06-25 07:29:05', NULL),
(91, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:29 AM\",\"resume_word\":\"\"}', '2021-06-25 07:36:43', '2021-06-25 07:36:43', NULL),
(92, 9, 'updated', 'user', 9, '{\"message\":\"change password\"}', '2021-06-25 07:58:13', '2021-06-25 07:58:13', NULL),
(93, 9, 'updated', 'user', 9, '{\"message\":\"change password\"}', '2021-06-25 07:59:04', '2021-06-25 07:59:04', NULL),
(94, 9, 'updated', 'user', 9, '{\"message\":\"change password\"}', '2021-06-25 08:01:55', '2021-06-25 08:01:55', NULL),
(95, 9, 'updated', 'user', 9, '{\"message\":\"change password\"}', '2021-06-25 08:02:58', '2021-06-25 08:02:58', NULL),
(96, 9, 'updated', 'user', 9, '{\"message\":\"change password\"}', '2021-06-25 08:03:20', '2021-06-25 08:03:20', NULL),
(97, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 07:36 AM\",\"resume_word\":\"\"}', '2021-06-25 08:07:27', '2021-06-25 08:07:27', NULL),
(98, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:07 AM\",\"resume_word\":\"\"}', '2021-06-25 08:09:48', '2021-06-25 08:09:48', NULL),
(99, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:07 AM\",\"resume_word\":\"\"}', '2021-06-25 08:09:51', '2021-06-25 08:09:51', NULL),
(100, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:07 AM\",\"resume_word\":\"\"}', '2021-06-25 08:09:54', '2021-06-25 08:09:54', NULL),
(101, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:07 AM\",\"resume_word\":\"\"}', '2021-06-25 08:10:28', '2021-06-25 08:10:28', NULL),
(102, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:10 AM\",\"resume_word\":\"\"}', '2021-06-25 08:10:39', '2021-06-25 08:10:39', NULL),
(103, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"certifications\":\"[{\\\"description\\\":\\\"asdfasdfdf  5465\\\"}]\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:10 AM\",\"resume_word\":\"\"}', '2021-06-25 08:10:59', '2021-06-25 08:10:59', NULL),
(104, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"preferred_work_locations\":\"pune, mumbai, Nagpur\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:10 AM\",\"resume_word\":\"\"}', '2021-06-25 08:11:36', '2021-06-25 08:11:36', NULL),
(105, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 08:11 AM\",\"resume_word\":\"\"}', '2021-06-25 18:43:43', '2021-06-25 18:43:43', NULL),
(106, 9, 'created', 'login', 9, '{\"login\":\"2021-06-26 12:44:07\"}', '2021-06-26 12:44:07', '2021-06-26 12:44:07', NULL),
(107, 9, 'created', 'login', 9, '{\"login\":\"2021-06-28 09:54:02\"}', '2021-06-28 09:54:02', '2021-06-28 09:54:02', NULL),
(108, 9, 'updated', '', 9, '{\"resume_pdf\":\"1624854296_340a0dc668c6a9c3d224.pdf\",\"resume_pdf_name\":\"document(18).pdf\",\"created_by\":\"Someshwar Badade\",\"created_at\":\"25 Jun 2021 01:09 AM\",\"updated_at\":\"25 Jun 2021 01:09 AM\",\"resume_word\":\"\"}', '2021-06-28 09:54:56', '2021-06-28 09:54:56', NULL),
(109, 9, 'updated', '', 9, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624854296_340a0dc668c6a9c3d224.pdf\",\"resume_doc\":\"1624854719_09d0af453f37d0db398e.docx\",\"resume_doc_name\":\"How_To_Use_Git.docx\",\"created_by\":\" \",\"created_at\":\"25 Jun 2021 01:09 AM\",\"updated_at\":\"28 Jun 2021 09:54 AM\",\"resume_word\":\"\"}', '2021-06-28 10:01:59', '2021-06-28 10:01:59', NULL),
(110, 9, 'updated', '', 3, '{\"resume_pdf\":\"1624863258_082013f969c040e63d03.pdf\",\"resume_pdf_name\":\"document(16).pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"25 Jun 2021 06:43 PM\",\"resume_word\":\"\"}', '2021-06-28 12:24:18', '2021-06-28 12:24:18', NULL),
(111, 9, 'updated', '', 3, '{\"resume_pdf\":\"1624863584_136d73456907125884da.pdf\",\"resume_pdf_name\":\"document(13).pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 12:24 PM\",\"resume_word\":\"\"}', '2021-06-28 12:29:44', '2021-06-28 12:29:44', NULL),
(112, 9, 'updated', '', 3, '{\"resume_pdf\":\"1624863623_c1803480bc8d86c65695.pdf\",\"resume_pdf_name\":\"document(17).pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 12:29 PM\",\"resume_word\":\"\"}', '2021-06-28 12:30:23', '2021-06-28 12:30:23', NULL),
(113, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624863623_c1803480bc8d86c65695.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 12:30 PM\",\"resume_word\":\"\"}', '2021-06-28 12:34:44', '2021-06-28 12:34:44', NULL),
(114, 9, 'updated', '', 3, '{\"resume_pdf\":\"1624863999_3fad0e870b9c2a45062a.pdf\",\"resume_pdf_name\":\"document(18).pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 12:34 PM\",\"resume_word\":\"\"}', '2021-06-28 12:36:39', '2021-06-28 12:36:39', NULL),
(115, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624863999_3fad0e870b9c2a45062a.pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 12:36 PM\",\"resume_word\":\"\"}', '2021-06-28 16:03:17', '2021-06-28 16:03:17', NULL),
(116, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624863999_3fad0e870b9c2a45062a.pdf\",\"resume_doc\":\"1624876455_5a9f7b8a8ad4f3ea23a7.docx\",\"resume_doc_name\":\"EX-IM04 Covering Letter Marine Insurance .docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:03 PM\",\"resume_word\":\"\"}', '2021-06-28 16:04:15', '2021-06-28 16:04:15', NULL),
(117, 9, 'updated', '', 3, '{\"resume_pdf\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624863999_3fad0e870b9c2a45062a.pdf\",\"resume_doc\":\"1624876795_a21441cf1df032fa2462.doc\",\"resume_doc_name\":\"IM03 Covering Letter for Import docs submission to Bank.doc\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:04 PM\",\"resume_word\":\"\"}', '2021-06-28 16:09:55', '2021-06-28 16:09:55', NULL),
(118, 9, 'updated', '', 3, '{\"resume_pdf\":\"1624876857_e02a0b968dfff35b9ff8.pdf\",\"resume_pdf_name\":\"document(17).pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876795_a21441cf1df032fa2462.doc\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:09 PM\",\"resume_word\":\"\"}', '2021-06-28 16:10:57', '2021-06-28 16:10:57', NULL),
(119, 9, 'updated', '', 3, '{\"resume_pdf\":\"1624876885_c9e61eee87ec6e1fd34c.pdf\",\"resume_pdf_name\":\"document(18).pdf\",\"resume_doc\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876795_a21441cf1df032fa2462.doc\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:10 PM\",\"resume_word\":\"\"}', '2021-06-28 16:11:25', '2021-06-28 16:11:25', NULL),
(120, 9, 'updated', '', 3, '{\"resume_doc\":\"1624877314_32a1206b81e25404e23f.docx\",\"resume_doc_name\":\"How_To_Use_Git.docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:11 PM\",\"resume_pdf_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876885_c9e61eee87ec6e1fd34c.pdf\",\"resume_doc_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/http:\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876795_a21441cf1df032fa2462.doc\"}', '2021-06-28 16:18:34', '2021-06-28 16:18:34', NULL),
(121, 9, 'updated', '', 3, '{\"resume_doc\":\"1624877677_0a7d5b7fb9bf80724ccd.docx\",\"resume_doc_name\":\"1624612965_38d4d5e59302a9e93867.docx\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:18 PM\",\"resume_pdf_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876885_c9e61eee87ec6e1fd34c.pdf\",\"resume_doc_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624877314_32a1206b81e25404e23f.docx\"}', '2021-06-28 16:24:37', '2021-06-28 16:24:37', NULL),
(122, 9, 'updated', '', 3, '{\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:24 PM\",\"resume_pdf_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876885_c9e61eee87ec6e1fd34c.pdf\",\"resume_doc_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624877677_0a7d5b7fb9bf80724ccd.docx\"}', '2021-06-28 16:25:06', '2021-06-28 16:25:06', NULL),
(123, 9, 'updated', '', 3, '{\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 04:25 PM\",\"resume_pdf_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876885_c9e61eee87ec6e1fd34c.pdf\",\"resume_doc_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624877677_0a7d5b7fb9bf80724ccd.docx\"}', '2021-06-28 17:40:57', '2021-06-28 17:40:57', NULL),
(124, 9, 'created', 'login', 9, '{\"login\":\"2021-06-29 10:57:19\"}', '2021-06-29 10:57:19', '2021-06-29 10:57:19', NULL),
(125, 9, 'created', 'login', 9, '{\"login\":\"2021-06-30 10:37:50\"}', '2021-06-30 10:37:50', '2021-06-30 10:37:50', NULL),
(126, 9, 'created', 'login', 9, '{\"login\":\"2021-06-30 14:37:23\"}', '2021-06-30 14:37:23', '2021-06-30 14:37:23', NULL),
(127, 9, 'updated', '', 5, '{\"foundation_skills\":\"\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:21 AM\",\"updated_at\":\"25 Jun 2021 06:10 AM\",\"resume_pdf_url\":null,\"resume_doc_url\":null}', '2021-06-30 19:06:57', '2021-06-30 19:06:57', NULL),
(128, 9, 'created', 'login', 9, '{\"login\":\"2021-07-01 15:30:25\"}', '2021-07-01 15:30:25', '2021-07-01 15:30:25', NULL),
(129, 9, 'updated', '', 3, '{\"candidate_name\":\"Someshwar Badade\",\"created_by\":\" \",\"created_at\":\"24 Jun 2021 08:08 AM\",\"updated_at\":\"28 Jun 2021 05:40 PM\",\"resume_pdf_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624876885_c9e61eee87ec6e1fd34c.pdf\",\"resume_doc_url\":\"http:\\/\\/localhost\\/profiles-management\\/assets\\/profiles\\/1624877677_0a7d5b7fb9bf80724ccd.docx\"}', '2021-07-01 17:12:20', '2021-07-01 17:12:20', NULL),
(130, 9, 'created', 'login', 9, '{\"login\":\"2021-07-02 11:11:33\"}', '2021-07-02 11:11:33', '2021-07-02 11:11:33', NULL),
(131, 9, 'created', 'login', 9, '{\"login\":\"2021-07-02 11:26:16\"}', '2021-07-02 11:26:16', '2021-07-02 11:26:16', NULL),
(132, 9, 'created', 'login', 9, '{\"login\":\"2021-08-23 12:22:07\"}', '2021-08-23 12:22:07', '2021-08-23 12:22:07', NULL),
(133, 9, 'created', 'login', 9, '{\"login\":\"2021-10-22 17:13:25\"}', '2021-10-22 17:13:25', '2021-10-22 17:13:25', NULL),
(134, 9, 'created', '', 14, '{\"certifications\":[],\"work_experience\":[{\"company_name\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"responsibility\":\"\",\"experience\":{\"company_name\":\"c1\",\"from_date\":\"1222\",\"to_date\":\"223\",\"responsibility\":\"asdfad\"}},{\"company_name\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"responsibility\":\"\",\"experience\":{\"company_name\":\"c2\",\"from_date\":\"asdf\",\"to_date\":\"asdf\",\"responsibility\":\"asfasd\"}},{\"company_name\":\"\",\"from_date\":\"\",\"to_date\":\"\",\"responsibility\":\"\",\"experience\":{\"company_name\":\"c3\",\"from_date\":\"sdf\",\"to_date\":\"asdf\",\"responsibility\":\"asdffd\"}}],\"resume_pdf\":\"\",\"resume_doc\":\"\",\"resume_pdf_url\":null,\"resume_doc_url\":null,\"preferred_work_locations\":\"\",\"categories\":\"\",\"top_skills\":\"\",\"middle_skills\":\"\",\"foundation_skills\":\"\",\"created_by\":\"9\",\"updated_by\":\"9\",\"created_at\":\"01 Jan 1970 05:30 AM\",\"updated_at\":\"01 Jan 1970 05:30 AM\",\"candidate_name\":\"qwer\",\"mobile_primary\":\"131213\",\"email_primary\":\"qwer@wrer.ee\",\"gender\":\"0\"}', '2021-10-22 18:12:43', '2021-10-22 18:12:43', NULL),
(135, 9, 'updated', '', 14, '{\"work_experience\":\"[{\\\"company_name\\\":\\\"\\\",\\\"from_date\\\":\\\"\\\",\\\"to_date\\\":\\\"\\\",\\\"responsibility\\\":\\\"\\\",\\\"experience\\\":{\\\"company_name\\\":\\\"c1\\\",\\\"from_date\\\":\\\"234\\\",\\\"to_date\\\":\\\"23424\\\",\\\"responsibility\\\":\\\"34234234\\\"}}]\",\"created_by\":\"Someshwar Badade\",\"created_at\":\"22 Oct 2021 06:12 PM\",\"updated_at\":\"22 Oct 2021 06:12 PM\",\"resume_pdf_url\":null,\"resume_doc_url\":null}', '2021-10-22 18:14:19', '2021-10-22 18:14:19', NULL);
INSERT INTO `action_log` (`id`, `user_id`, `action_type`, `model`, `record_id`, `chaged_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(136, 9, 'updated', '', 14, '{\"work_experience\":\"[{\\\"company_name\\\":\\\"\\\",\\\"from_date\\\":\\\"\\\",\\\"to_date\\\":\\\"\\\",\\\"responsibility\\\":\\\"\\\",\\\"experience\\\":{\\\"company_name\\\":\\\"c1\\\",\\\"from_date\\\":\\\"234\\\",\\\"to_date\\\":\\\"23424\\\",\\\"responsibility\\\":\\\"34234234\\\"}},{\\\"company_name\\\":\\\"\\\",\\\"from_date\\\":\\\"\\\",\\\"to_date\\\":\\\"\\\",\\\"responsibility\\\":\\\"\\\",\\\"experience\\\":{\\\"company_name\\\":\\\"c2\\\",\\\"from_date\\\":\\\"qwreqw\\\",\\\"to_date\\\":\\\"werwe\\\",\\\"responsibility\\\":\\\"432423423\\\"}}]\",\"created_by\":\" \",\"created_at\":\"22 Oct 2021 06:12 PM\",\"updated_at\":\"22 Oct 2021 06:14 PM\",\"resume_pdf_url\":null,\"resume_doc_url\":null}', '2021-10-22 18:15:06', '2021-10-22 18:15:06', NULL),
(137, 9, 'updated', '', 14, '{\"work_experience\":\"[{\\\"company_name\\\":\\\"c1\\\",\\\"from_date\\\":\\\"qwer\\\",\\\"to_date\\\":\\\"qewr\\\",\\\"responsibility\\\":\\\"wer\\\",\\\"experience\\\":{\\\"company_name\\\":\\\"c1\\\",\\\"from_date\\\":\\\"234\\\",\\\"to_date\\\":\\\"23424\\\",\\\"responsibility\\\":\\\"34234234\\\"}},{\\\"company_name\\\":\\\"c2\\\",\\\"from_date\\\":\\\"qewr\\\",\\\"to_date\\\":\\\"qer\\\",\\\"responsibility\\\":\\\"werr\\\",\\\"experience\\\":{\\\"company_name\\\":\\\"c2\\\",\\\"from_date\\\":\\\"qwreqw\\\",\\\"to_date\\\":\\\"werwe\\\",\\\"responsibility\\\":\\\"432423423\\\"}}]\",\"created_by\":\" \",\"created_at\":\"22 Oct 2021 06:12 PM\",\"updated_at\":\"22 Oct 2021 06:15 PM\",\"resume_pdf_url\":null,\"resume_doc_url\":null}', '2021-10-22 18:25:35', '2021-10-22 18:25:35', NULL),
(138, 9, 'created', 'login', 9, '{\"login\":\"2021-10-25 11:41:25\"}', '2021-10-25 11:41:25', '2021-10-25 11:41:25', NULL);

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
-- Table structure for table `master_skills`
--

DROP TABLE IF EXISTS `master_skills`;
CREATE TABLE IF NOT EXISTS `master_skills` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_skills`
--

INSERT INTO `master_skills` (`id`, `text`) VALUES
(1, 'PHP'),
(2, 'Python'),
(3, 'AngularJs 2'),
(4, 'AngularJs 3'),
(5, 'AngularJs 4'),
(6, 'AngularJs 5'),
(7, 'AngularJs 6'),
(8, 'AngularJs 7'),
(9, 'AngularJs 8'),
(10, 'AngularJs 9'),
(11, 'AngularJs 10'),
(12, 'jQuery'),
(13, 'CSS'),
(14, 'CSS 3'),
(15, 'HTML'),
(16, 'HTML 5'),
(17, 'Javascript'),
(18, 'Java'),
(19, 'Spring Boot'),
(20, 'Bootstrap'),
(21, 'Codeigniter'),
(22, 'NodeJs'),
(23, 'ReactJs'),
(24, 'Vue.js'),
(25, '.Net'),
(26, 'C#'),
(27, 'C++'),
(28, 'VisualBasic'),
(29, 'Android'),
(30, 'ServiceNow'),
(31, 'DevOps'),
(32, 'Git'),
(33, 'Express.js'),
(34, 'three.js'),
(35, 'MySql'),
(36, 'Oracle'),
(37, 'Wordpress'),
(38, 'Magento'),
(39, 'Laravel'),
(40, 'Microsoft Server 2000'),
(41, 'MongoDB'),
(42, 'MariaDB'),
(43, 'Graphql'),
(44, 'Postgresql');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(200) NOT NULL,
  `mobile_primary` varchar(20) NOT NULL,
  `mobile_alternate` varchar(20) DEFAULT NULL,
  `email_primary` varchar(200) NOT NULL,
  `email_alternate` varchar(200) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `resume_pdf` varchar(200) DEFAULT NULL,
  `resume_pdf_name` varchar(200) DEFAULT NULL,
  `resume_doc` varchar(200) DEFAULT NULL,
  `resume_doc_name` varchar(200) DEFAULT NULL,
  `preferred_work_locations` text,
  `categories` text,
  `top_skills` mediumtext,
  `middle_skills` mediumtext,
  `foundation_skills` mediumtext,
  `certifications` longtext,
  `work_experience` mediumtext,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `candidate_name`, `mobile_primary`, `mobile_alternate`, `email_primary`, `email_alternate`, `gender`, `photo`, `resume_pdf`, `resume_pdf_name`, `resume_doc`, `resume_doc_name`, `preferred_work_locations`, `categories`, `top_skills`, `middle_skills`, `foundation_skills`, `certifications`, `work_experience`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Someshwar Badade', '8806056756', '78798787987987', 'someshbadade@gmail.com', 'adfsdfsdfadssad13213123@adfsdaf12.dd', 0, NULL, '1624876885_c9e61eee87ec6e1fd34c.pdf', 'document(18).pdf', '1624877677_0a7d5b7fb9bf80724ccd.docx', '1624612965_38d4d5e59302a9e93867.docx', 'pune, mumbai, Nagpur', '', 'PHP, HTML, CSS, JavaScript, Jquery', 'Angularjs, ReactJS', 'ServiceNow', '[{\"description\":\"asdfasdfdf  5465\"}]', NULL, 0, 9, 1, '2021-06-24 08:08:35', '2021-07-01 17:12:20', NULL),
(4, 'Avinash Gunjkar', '8888395979', NULL, 'avinash.gunjkar@bitstringit.in', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'pune, mumbai', NULL, 'HTML, CSS, JavaScript, Jquery, PHP, DevOps, Cloud, MySql, Oracal', 'Angularjs, ReactJS', 'ServiceNow', NULL, NULL, 9, 9, 1, '2021-06-24 08:13:35', '2021-06-24 08:13:35', NULL),
(5, 'asfha', '897897978798777', '7979878789', 'adsfasdf@asdfsadf.dfd', 'qwrewewqe@asdfadsf.dd', 1, NULL, '', NULL, '', NULL, 'asdf, asf', NULL, 'asfsadf, asfsf', 'qrqwer`qwerw`', '', '[]', NULL, 0, 9, 1, '2021-06-24 08:21:43', '2021-06-30 19:06:57', NULL),
(6, 'afadsf', '141234134', '1234123', 'qwerqwe@qeqwer.ee', 'qererqwe@eqew.33', 1, NULL, NULL, NULL, NULL, NULL, 'qwerwq, qwrqr', NULL, 'wewqer45.12, wqwerwq56', 'qerqwer', '', '[{\"description\":\"description1\"},{\"description\":\"description2\"},{\"description\":\"description3\"}]', NULL, 9, 9, 1, '2021-06-25 00:48:27', '2021-06-25 00:48:27', NULL),
(9, 'adfjagsdfhasd asgfjagsfj', '8797979', '987879', 'asdfasdf@asdfasd.dd', 'sdsfsaf@asfsdaf.dd', 1, NULL, 'http://localhost/profiles-management/assets/profiles/1624854296_340a0dc668c6a9c3d224.pdf', 'document(18).pdf', '1624854719_09d0af453f37d0db398e.docx', 'How_To_Use_Git.docx', 'qeqweq', NULL, '', 'asasdfs, wwe, wrwer', '', '[{\"description\":\"description1\"}]', NULL, 0, 9, 1, '2021-06-25 01:09:28', '2021-06-28 10:01:59', NULL),
(10, 'asdfh afahsd jkf', '779878', '79879879', 'adfasdf@asdf.dd', NULL, 1, NULL, '1624609399_e6b8c2f5a3772afb5d2a.docx', 'How_To_Use_Git.docx', NULL, NULL, 'qewrqwe', NULL, 'dafsdf', 'asdf', 'sdfsd', '[{\"description\":\"description1\"}]', NULL, 9, 9, 1, '2021-06-25 03:23:19', '2021-06-25 03:23:19', NULL),
(11, 'asdfh afahsd jkf', '779878', '79879879', 'adfasdf@asdf.dd', NULL, 1, NULL, '1624609453_d2c43f8bd21e290ee0d6.docx', 'How_To_Use_Git.docx', NULL, NULL, 'qewrqwe', NULL, 'dafsdf', 'asdf', 'sdfsd', '[{\"description\":\"description1\"}]', NULL, 9, 9, 1, '2021-06-25 03:24:13', '2021-06-25 03:24:13', NULL),
(12, 'qeioqeur', '879797', '97978', 'asfasdf@asdfsad.dd', 'afasdfds@adsfad.dd', 0, NULL, '1624612965_3225c0af7019e1b3b843.pdf', 'document(18).pdf', '1624612965_38d4d5e59302a9e93867.docx', 'How_To_Use_Git.docx', 'qewrqw', NULL, 'werwe', 'werwe', 'werwe', '[{\"description\":\"werwer\"}]', NULL, 9, 9, 1, '2021-06-25 04:22:45', '2021-06-25 04:22:45', NULL),
(13, 'qeioqeur', '879797', '97978', 'asfasdf@asdfsad.dd', 'afasdfds@adsfad.dd', 0, NULL, '1624612976_0c9e45447aaa979810c4.pdf', 'document(18).pdf', '1624612976_f91768ddbc0041cd46ad.docx', 'How_To_Use_Git.docx', 'qewrqw', NULL, 'werwe', 'werwe', 'werwe', '[{\"description\":\"werwer\"}]', NULL, 9, 9, 1, '2021-06-25 04:22:56', '2021-06-25 04:22:56', NULL),
(14, 'qwer', '131213', NULL, 'qwer@wrer.ee', NULL, 0, NULL, '', NULL, '', NULL, '', '', '', '', '', '[]', '[{\"company_name\":\"c1\",\"from_date\":\"qwer\",\"to_date\":\"qewr\",\"responsibility\":\"wer\",\"experience\":{\"company_name\":\"c1\",\"from_date\":\"234\",\"to_date\":\"23424\",\"responsibility\":\"34234234\"}},{\"company_name\":\"c2\",\"from_date\":\"qewr\",\"to_date\":\"qer\",\"responsibility\":\"werr\",\"experience\":{\"company_name\":\"c2\",\"from_date\":\"qwreqw\",\"to_date\":\"werwe\",\"responsibility\":\"432423423\"}}]', 0, 9, 1, '2021-10-22 18:12:43', '2021-10-22 18:25:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2021-06-02 11:58:05', '2021-06-02 11:58:05', NULL),
(2, 'subadmin', '2021-06-02 11:58:05', '2021-06-02 11:58:05', NULL),
(3, 'owner', '2021-06-02 11:59:36', '2021-06-02 11:59:36', NULL),
(4, 'supervisor', '2021-06-02 11:59:36', '2021-06-02 11:59:36', NULL),
(5, 'worker', '2021-06-02 11:59:44', '2021-06-02 11:59:44', NULL);

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
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_role`, `owner_id`, `fname`, `lname`, `email`, `mobile`, `company_name`, `address`, `country`, `state`, `city`, `pincode`, `password`, `profile_picture`, `ip_address`, `status`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 0, 3, 8, 'someshwar', 'badade', 'someshbadade@gmail.com', '8806056756', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IxSFlAOS3eXlqRTLy1rEqetXA6hStYO1NDKB3dVddom6.oU9GdgDe', '', '', 1, '2021-06-02 15:24:24', '2021-06-02 04:54:24', '2021-06-15 05:26:28', NULL),
(9, 0, 3, 9, 'Someshwar', 'Badade', 'somesh@bitstringit.in', '', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uVyM/KRv7ElPob.IzLVX9.VXblblk919BWjxshU16jw8kXz7jG.Hm', '', '', 1, '2021-06-17 09:50:34', '2021-06-16 23:20:34', '2021-06-25 08:03:20', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
