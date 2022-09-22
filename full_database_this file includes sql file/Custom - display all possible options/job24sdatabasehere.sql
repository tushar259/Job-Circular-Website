-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 06:01 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job24sdatabasehere`
--

-- --------------------------------------------------------

--
-- Table structure for table `appliedforjobuserlist`
--

CREATE TABLE `appliedforjobuserlist` (
  `id` bigint(100) NOT NULL,
  `circular_id` bigint(100) NOT NULL,
  `company_id` bigint(100) NOT NULL,
  `applied_user_id` bigint(100) NOT NULL,
  `company_checked_notification` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appliedforjobuserlist`
--

INSERT INTO `appliedforjobuserlist` (`id`, `circular_id`, `company_id`, `applied_user_id`, `company_checked_notification`, `created_at`, `updated_at`) VALUES
(2, 12, 2, 8, 'yes', '2021-03-07 09:53:26', '2021-03-07 09:53:26'),
(3, 16, 3, 8, 'yes', '2021-03-07 11:49:03', '2021-03-07 11:49:03'),
(4, 4, 3, 8, 'yes', '2021-03-11 15:52:54', '2021-03-11 15:52:54'),
(5, 11, 3, 8, 'yes', '2021-03-11 15:53:30', '2021-03-11 15:53:30'),
(6, 14, 2, 8, 'no', '2021-06-20 16:42:33', '2021-06-20 16:42:33'),
(7, 12, 2, 8, 'yes', '2021-03-11 15:53:30', '2021-03-11 15:53:30'),
(8, 11, 3, 1, 'yes', '2021-03-11 15:53:30', '2021-03-11 15:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `changepassword`
--

CREATE TABLE `changepassword` (
  `id` bigint(100) NOT NULL,
  `mac_address` varchar(240) NOT NULL,
  `treid_number_of_time` int(10) NOT NULL,
  `tried_to_change_password_date_and_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `row_will_be_deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `changepassword`
--

INSERT INTO `changepassword` (`id`, `mac_address`, `treid_number_of_time`, `tried_to_change_password_date_and_time`, `row_will_be_deleted_at`, `created_at`, `updated_at`) VALUES
(16, 'E4-02-9B-69-8C-50', 0, '2021-06-29 10:18:18', '2021-06-30 10:18:18', '2021-06-29 16:17:37', '2021-06-29 16:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `circular`
--

CREATE TABLE `circular` (
  `id` bigint(100) NOT NULL,
  `job_name` varchar(230) NOT NULL,
  `company_id` bigint(100) NOT NULL,
  `company_name` varchar(230) NOT NULL,
  `employment_status` varchar(100) DEFAULT NULL,
  `job_type_id` bigint(100) NOT NULL,
  `education_req` longtext DEFAULT NULL,
  `experience_req` longtext DEFAULT NULL,
  `job_responsibility` longtext DEFAULT NULL,
  `more_req` longtext DEFAULT NULL,
  `job_location` varchar(230) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `other_benefits` longtext DEFAULT NULL,
  `read_before_apply` longtext DEFAULT NULL,
  `vacancy` int(4) DEFAULT NULL,
  `deadline` date NOT NULL,
  `will_be_deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `circular`
--

INSERT INTO `circular` (`id`, `job_name`, `company_id`, `company_name`, `employment_status`, `job_type_id`, `education_req`, `experience_req`, `job_responsibility`, `more_req`, `job_location`, `salary`, `other_benefits`, `read_before_apply`, `vacancy`, `deadline`, `will_be_deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'jgj', 1, 'ygyjgy', 'hjhh', 35, 'jhghjb', 'gyugbygby', 'gyugyugygy', 'ygygyy', 'yyvyv', '567576.00', 'vghv', 'uyfguyfuy', 4, '2222-02-22', '2022-11-16 08:47:10', '2021-02-18 09:00:49', '2021-02-18 09:00:49'),
(5, 'xyz', 2, 'yugyug', 'ftff', 34, 'ghgvhgv', 'gvhgvghv', 'gvghvghv', 'gvghvg', 'gvhgvg', '5664564567465453.00', 'jgfgh', 'gfghfg', 5, '4444-04-04', '2022-07-06 08:47:10', '2021-02-18 09:05:51', '2021-02-18 09:05:51'),
(6, 'def', 2, 'ygygyug', 'jhghjh', 31, 'vghvhgv', 'hgvghvhjv', 'gvgvgv', 'hjvhjjh', 'jhvjhvhv', '566456456746545300.00', 'gygyuguy', 'yguygyu', 7, '5555-05-05', '2022-10-12 08:47:10', '2021-02-18 09:11:30', '2021-02-18 09:11:30'),
(7, 'ghijkm', 1, 'hgfhg', 'hghjg', 2, 'jhjhvhjv', 'jhvhvhv', 'jhvjhvhjv', 'jhvhjvhjvh', 'hjvjhvhv', '65655645645.00', 'hvghvhgv', 'hgfvhgfgfht', 5, '6666-06-06', '2022-01-12 08:47:10', '2021-02-18 09:12:50', '2021-02-18 09:12:50'),
(8, 'ghijk', 1, 'hgfhg', 'hghjg', 2, 'jhjhvhjv', 'jhvhvhv', 'jhvjhvhjv', 'jhvhjvhjvh', 'hjvjhvhv', '65655645645.00', 'hvghvhgv', 'hgfvhgfgfht', 5, '6666-06-06', '2022-03-02 08:47:10', '2021-02-18 09:12:51', '2021-02-18 09:12:51'),
(9, 'ghijkn', 1, 'hgfhg', 'hghjg', 2, 'jhjhvhjv', 'jhvhvhv', 'jhvjhvhjv', 'jhvhjvhjvh', 'hjvjhvhv', '65655645645.00', 'hvghvhgv', 'hgfvhgfgfht', 5, '6666-06-06', '2022-06-08 08:47:10', '2021-02-18 09:12:51', '2021-02-18 09:12:51'),
(11, 'ghijkl', 3, 'hgfhg', 'hghjg', 2, 'jhjhvhjv', 'jhvhvhv', 'jhvjhvhjv', 'jhvhjvhjvh', 'hjvjhvhv', '65655645645.00', 'hvghvhgv', 'hgfvhgfgfht', 5, '6666-06-06', '2022-05-18 08:47:10', '2021-02-18 09:12:52', '2021-02-18 09:12:52'),
(12, 'LMNOP', 2, 'uyguyg', 'jhhv', 17, 'jbhjbh', 'jvjvjvjh', 'jvjvjvjv', 'jhvjvjhvjhvjh', 'vjhvhjvhjv', '54654566.00', 'jhbjhbjhb', 'jhgjgjhg', 65, '7777-07-07', '2022-03-03 08:47:10', '2021-02-18 09:24:40', '2021-02-18 09:24:40'),
(13, 'QRST', 2, 'uyguyyu', 'hggjvjh', 35, 'hvhjbh', 'jhvjhjh', 'jhvjhvjh', 'jhvjhvhjvjh', 'jvhjvjhv', '65756767.00', 'vhvhv', 'vjhgg', 7, '6545-07-07', '2022-06-02 08:47:10', '2021-02-18 09:26:38', '2021-02-18 09:26:38'),
(14, 'laravel developer1', 2, 'hhjbhjb', NULL, 14, 'jhghjgbhj', 'hjgjhbh', 'jhgjhgjy', NULL, 'hjghjgjhg', '76576567567.00', NULL, NULL, NULL, '9999-09-09', '2022-06-16 08:47:10', '2021-02-18 10:35:30', '2021-02-18 10:35:30'),
(16, 'hgfgh', 3, 'ygyugy', 'hghjhj', 31, 'hjbhjbh', 'hbhjjh', 'hbjhbhjb', 'hbhjbh', 'hjbhjbhj', '6545656.00', 'kjnjkjkn', 'jjkbkjbjkb', 5, '2222-02-22', '2022-06-09 08:47:10', '2021-03-07 11:19:01', '2021-03-07 11:19:01'),
(17, 'ygvyvuy', 3, 'ygyugyugy', 'gvghvgh', 30, 'yguyyg', 'yugyuyug', 'ugygyu', 'uyguygy', 'uygyugy', '6565655.00', 'vhvvgvgh', 'hjbhjbhjb', 6, '2010-02-01', '2022-09-14 08:47:10', '2021-03-08 08:40:22', '2021-03-08 08:40:22'),
(18, 'abcdefgh', 3, 'this and that', NULL, 12, NULL, NULL, NULL, NULL, 'anywhere', '20000 taka', NULL, NULL, NULL, '2021-03-19', '2022-03-18 08:47:10', '2021-03-16 09:46:50', '2021-03-16 09:46:50'),
(21, 'vjhjbbkj hv gff', 3, 'jhbhj v v ghvg', NULL, 15, NULL, NULL, NULL, NULL, 'jhbhjbjhbhjbh', '656756', NULL, NULL, NULL, '2021-07-30', '2021-09-07 18:00:00', '2021-07-08 09:29:20', '2021-07-08 09:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `companyaccount`
--

CREATE TABLE `companyaccount` (
  `id` bigint(100) NOT NULL,
  `email` varchar(240) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `retype_password` varchar(200) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_address` varchar(240) NOT NULL,
  `user_type` varchar(30) NOT NULL DEFAULT 'companyUser',
  `first_teacher_name` varchar(240) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companyaccount`
--

INSERT INTO `companyaccount` (`id`, `email`, `phone`, `password`, `retype_password`, `company_name`, `company_address`, `user_type`, `first_teacher_name`, `created_at`, `updated_at`) VALUES
(1, 'xyz@yahoo.com', '12345', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'xyz', 'yef', 'companyUser', '', '2021-02-21 09:00:19', '2021-02-21 09:00:19'),
(2, 'xyz@yahaa.com', '123+45678802-1', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'abc', 'abc', 'companyUser', 'abcd', '2021-02-21 16:18:27', '2021-02-21 16:18:27'),
(3, 'test5@gmail.com', '123+45678802-1243', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'tyftyty', 'vyvu', 'companyUser', '', '2021-02-21 17:02:04', '2021-02-21 17:02:04'),
(4, 'base@yahoo.co', '543435435435434', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'jhghv', 'jgfytfytftftydrytftyfyrdy', 'companyUser', 'bichu', '2021-04-05 17:10:36', '2021-04-05 17:10:36'),
(5, 'basement@yahoo.com', '65465445564654', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'jhggjhg', 'jhghgfhfhgvhgfhfhgfg', 'companyUser', '', '2021-04-05 17:12:46', '2021-04-05 17:12:46'),
(6, 'befg@yahoo.yahoo', '54345345334535352', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'gjhguygyug', 'yufytgbyfytfftfytfytfytfd', 'companyUser', '', '2021-04-05 17:30:31', '2021-04-05 17:30:31'),
(7, 'test3@gmail.com', '11223344', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'abc', 'dhaka, bangladesh', 'companyUser', '', '2021-04-29 10:03:31', '2021-04-29 10:03:31'),
(8, 'hgfhghfgdfgdxdukhui@yahoo.com', '77672854574342', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'hgfhghfgdfgdxdukhui uguyygyygy', 'hjgjhghfhtftyftcdrtcrdrtdtrdtrctxrtr', 'companyUser', '', '2021-04-29 17:04:53', '2021-04-29 17:04:53'),
(9, 'tititi@yahoo.com', '6546546463', '65a83e135a0401ed5b9bb65609fa1b29', '65a83e135a0401ed5b9bb65609fa1b29', 'titititititi', 'tititititititititi', 'companyUser', 'tititi', '2021-04-30 09:26:41', '2021-04-30 09:26:41'),
(10, 'jhgjhgjhg@yahuu.com', '87673662564', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'jghgjhgjh', 'gugiygiguyguygyuyu fyufuyguy yuy', 'companyUser', 'tushar', '2021-07-08 09:17:01', '2021-07-08 09:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

CREATE TABLE `jobtype` (
  `id` bigint(100) NOT NULL,
  `jobtype_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobtype`
--

INSERT INTO `jobtype` (`id`, `jobtype_name`, `created_at`, `updated_at`) VALUES
(1, 'Accounting/Finance', '2021-02-14 08:52:38', '2021-02-14 08:52:38'),
(2, 'Bank/Non-Bank Institution', '2021-02-14 08:52:38', '2021-02-14 08:52:38'),
(3, 'Commercial/Supply Chain', '2021-02-14 08:54:07', '2021-02-14 08:54:07'),
(4, 'Education/Training', '2021-02-14 08:54:07', '2021-02-14 08:54:07'),
(5, 'Engineer/Architects', '2021-02-14 08:55:19', '2021-02-14 08:55:19'),
(6, 'Garments/Textile', '2021-02-14 08:55:19', '2021-02-14 08:55:19'),
(7, 'HR/Organization Development', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(8, 'Genarel Manager/Admin/Administration', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(9, 'Design/Creative', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(10, 'Production/Operation', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(11, 'Hospitality/Travel/Tourism', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(12, 'Beauty Care/Health & Fitness', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(13, 'Electrician/Construction/Repair', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(14, 'IT & Telecommunication', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(15, 'Marketing/Sales', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(16, 'Customer Support/Call Center', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(17, 'Media/Ad./Event Management', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(18, 'Medical/Pharma', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(19, 'Agro (Plant/Animal/Fisheries/Forestry)', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(20, 'NGO/Development', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(21, 'Research/Consultancy', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(22, 'Secretary/Receptionist', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(23, 'Data Entry/Operator/BPO', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(24, 'Driving/Motor Technician', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(25, 'Security/Support Service', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(26, 'Law/Legal', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(27, 'Others', '2021-02-14 09:04:15', '2021-02-14 09:04:15'),
(28, 'Data Entry/Computer Operator', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(29, 'Mechanic/Technician', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(30, 'Nurse', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(31, 'Delivery Man', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(32, 'CAD Operator', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(33, 'Electrician/Electronics', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(34, 'Driver', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(35, 'Chef', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(36, 'Postman', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(37, 'Graphics Designer', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(38, 'Lab/Lab Assistant', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(39, 'Security Guard', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(40, 'Waiter/Waitress', '2021-02-14 09:15:51', '2021-02-14 09:15:51'),
(41, 'Showroom/Salesman', '2021-02-14 09:15:51', '2021-02-14 09:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `id` bigint(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `job_type_id` bigint(100) NOT NULL,
  `email` varchar(240) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `place_of_birth` varchar(240) NOT NULL,
  `password` varchar(200) NOT NULL,
  `retype_password` varchar(200) NOT NULL,
  `user_type` varchar(30) NOT NULL DEFAULT 'user',
  `premium_or_not` varchar(10) NOT NULL DEFAULT 'no',
  `accept_user_agreement` varchar(10) NOT NULL DEFAULT 'yes',
  `accept_pay_agreement` varchar(10) NOT NULL DEFAULT 'no',
  `visited_profile` bigint(100) NOT NULL DEFAULT 0,
  `checked_notification` varchar(10) NOT NULL DEFAULT 'yes',
  `first_teacher_name` varchar(240) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`id`, `name`, `gender`, `job_type_id`, `email`, `phone`, `place_of_birth`, `password`, `retype_password`, `user_type`, `premium_or_not`, `accept_user_agreement`, `accept_pay_agreement`, `visited_profile`, `checked_notification`, `first_teacher_name`, `created_at`, `updated_at`) VALUES
(1, 'asad', 'male', 12, 'asad@gmail.com', '123456789', 'dhaka, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 1, 'no', '', '2021-02-20 17:32:19', '2021-02-20 17:32:19'),
(2, 'xyz', 'male', 9, 'xyz@gmail.com', '65454567', 'dhaka, bangladesh', 'b8a8bdb44be7e831449e2178eb79aedf', 'b8a8bdb44be7e831449e2178eb79aedf', 'user', 'no', 'yes', 'no', 0, 'yes', 'n980l', '2021-02-21 08:23:17', '2021-02-21 08:23:17'),
(3, 'ftp', 'female', 10, 'ftp@gmail.com', '5643445232', 'dhaka, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-02-21 08:26:39', '2021-02-21 08:26:39'),
(4, 'rty', 'others', 24, 'rty@gmail.com', '123456788', 'dhaka, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'no', 0, 'yes', 'efgh', '2021-02-21 08:48:51', '2021-02-21 08:48:51'),
(5, 'yuv', 'female', 32, 'yuv@gmail.com', '12345678876543', 'dhaka, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-02-21 08:50:38', '2021-02-21 08:50:38'),
(6, 'axy', 'male', 23, 'axy@gmail.com', '12345678987654345676', 'dhaka, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-02-21 08:55:46', '2021-02-21 08:55:46'),
(7, 'def', 'others', 16, 'def@gmail.com', '52932', 'dhaka, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-02-21 08:59:36', '2021-02-21 08:59:36'),
(8, 'xyz3', 'female', 35, 'test@gmail.com', '+123+45678802-1', 'borishal, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'yes', 13, 'yes', 'tdf', '2021-02-21 16:06:27', '2021-02-21 16:06:27'),
(9, 'xyz', 'male', 23, NULL, '+1-2-3-4-5678-98', 'dhaka, bangladesh', '114cac03542299c32775a0106c70d046', '114cac03542299c32775a0106c70d046', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-02-21 16:10:31', '2021-02-21 16:10:31'),
(10, 'abc', 'male', 31, 'abc@gmail.com', NULL, 'chittagong, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-05 16:28:51', '2021-04-05 16:28:51'),
(11, 'abc', 'male', 2, 'abc@gmail.co', NULL, 'dhaaka, chittagong', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-05 16:32:34', '2021-04-05 16:32:34'),
(12, 'abcefddd', 'female', 28, 'abcd@gmail.com', NULL, 'dhaka, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-05 16:33:34', '2021-04-05 16:33:34'),
(13, 'base', 'male', 19, 'base@yahoo.com', NULL, 'tangail, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 1, 'no', '', '2021-04-05 17:03:09', '2021-04-05 17:03:09'),
(14, 'abc', 'male', 19, 'vdef@gmail.com', NULL, 'jftytfrdrtrtfrfruygu', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-05 17:23:51', '2021-04-05 17:23:51'),
(15, 'befg', 'male', 34, 'befg@yahoo.gmail', NULL, 'fgfftyftftyfytfgtyfty', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 2, 'no', '', '2021-04-05 17:29:34', '2021-04-05 17:29:34'),
(16, 'ggyuyfyufuyf', 'female', 31, 'jhgjhfyfuyfuyfuyfyu@yahoo.com', '7867567566756', 'iugugyuygyufuyyufyufyufyufyufuyfyu', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-29 09:53:19', '2021-04-29 09:53:19'),
(17, '<p style=\'color:red;\'>hjgjhgjgygyh</p>', 'male', 4, 'test2@gmail.com', '1234567890', 'dhaka, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 1, 'no', '', '2021-04-29 09:56:02', '2021-04-29 09:56:02'),
(18, 'jggyugygyugyugyu', 'female', 9, 'email@yahoo.com', '12345678900', 'dhaka, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-29 10:01:08', '2021-04-29 10:01:08'),
(19, 'ghfrt', 'male', 16, 'ghfrt@yahoo.com', '123321123', 'dhaka, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-29 16:51:05', '2021-04-29 16:51:05'),
(20, 'jhghghghg', 'female', 13, 'jhghghghgjhghghghg@yahoo.com', '3545424513751635221', 'gjgyffytftyfytdytdytdtydytdytdtydytd', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', 'tyty', '2021-04-29 16:55:09', '2021-04-29 16:55:09'),
(21, 'jgjhghjgh', 'female', 4, 'jgjhjgjhghjghghjgh@yahoo.com', '65161235125614563', 'dhaka, bangladesh', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', '', '2021-04-29 16:57:20', '2021-04-29 16:57:20'),
(22, 'tutututututu', 'male', 4, 'tutututututu@yahoo.com', '675654564564', 'tututututututututu', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 2, 'no', 'tututu', '2021-04-30 09:25:17', '2021-04-30 09:25:17'),
(23, 'hgjhghg', 'male', 15, 'huihiunjbiiu@yahuu.com', NULL, 'ytbhbguyguybuyulnjkn', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'd60383cf5a0bad6c8cc2b24e05e3ea0e', 'user', 'no', 'yes', 'no', 0, 'yes', 'tushar', '2021-07-08 09:05:52', '2021-07-08 09:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `usercvvideos`
--

CREATE TABLE `usercvvideos` (
  `id` bigint(100) NOT NULL,
  `userid` bigint(100) NOT NULL,
  `name` varchar(240) DEFAULT NULL,
  `cv_video` varchar(3000) NOT NULL,
  `upload_file_type` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userpayhistory`
--

CREATE TABLE `userpayhistory` (
  `id` bigint(100) NOT NULL,
  `userid` bigint(100) DEFAULT NULL,
  `amount_paid` double(20,2) DEFAULT NULL,
  `transactionid_or_phone` varchar(200) NOT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `paid_by_app` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userpayhistory`
--

INSERT INTO `userpayhistory` (`id`, `userid`, `amount_paid`, `transactionid_or_phone`, `reference_id`, `paid_by_app`, `status`, `created_at`, `updated_at`) VALUES
(9, 1, 54654.00, '65465465464dfg5', '8--byDefault', 'nagad', 'pending', '2021-04-03 16:40:27', '2021-04-03 16:40:24'),
(10, 3, 90.12, '654654654645ko', '8--byDefault', 'nagad', 'pending', '2021-04-03 16:40:26', '2021-04-03 16:40:24'),
(11, 2, 54654.00, '654efs654654645', '8--byDefault', 'rocket', 'pending', '2021-04-03 16:40:25', '2021-04-03 16:40:24'),
(12, 8, 54654.00, 'kjhkj654654654645', '8--byDefault', 'bkash', 'pending', '2021-04-03 16:40:24', '2021-04-03 16:40:24'),
(13, 8, 656756545.00, '65646545654756465465', '8--byDefault', 'nagad', 'pending', '2021-05-04 09:11:24', '2021-05-04 09:11:24'),
(14, 8, 67523652653.00, '765656565656tfrtyrtdrtd', '8--byDefault', 'rocket', 'pending', '2021-05-04 09:15:41', '2021-05-04 09:15:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliedforjobuserlist`
--
ALTER TABLE `appliedforjobuserlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `changepassword`
--
ALTER TABLE `changepassword`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mac_address` (`mac_address`);

--
-- Indexes for table `circular`
--
ALTER TABLE `circular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyaccount`
--
ALTER TABLE `companyaccount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `jobtype`
--
ALTER TABLE `jobtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `usercvvideos`
--
ALTER TABLE `usercvvideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpayhistory`
--
ALTER TABLE `userpayhistory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appliedforjobuserlist`
--
ALTER TABLE `appliedforjobuserlist`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `changepassword`
--
ALTER TABLE `changepassword`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `circular`
--
ALTER TABLE `circular`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `companyaccount`
--
ALTER TABLE `companyaccount`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobtype`
--
ALTER TABLE `jobtype`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `usercvvideos`
--
ALTER TABLE `usercvvideos`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `userpayhistory`
--
ALTER TABLE `userpayhistory`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
