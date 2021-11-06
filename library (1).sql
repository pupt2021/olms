-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2021 at 05:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_extension`
--

CREATE TABLE `book_extension` (
  `id` int(10) NOT NULL,
  `borrowings_id` int(10) DEFAULT NULL,
  `users_id` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_reservation`
--

CREATE TABLE `book_reservation` (
  `id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `materials_id` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `materials_id` int(10) NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_returned` date NOT NULL,
  `type` int(10) NOT NULL,
  `status` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `users_id`, `materials_id`, `date_borrowed`, `date_returned`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 15, 2, '2021-08-27', '2021-08-30', 1, 1, '2021-08-27 08:11:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) NOT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `course_description` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_description`, `status`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 1, NULL, NULL, '2021-06-03 18:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(10) NOT NULL,
  `gender_name` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`, `status`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'Male', 1, NULL, NULL, NULL),
(2, 'Female', 1, NULL, NULL, NULL),
(4, 'LGBT', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `materials_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `accnum` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `callno` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `edition` varchar(50) NOT NULL,
  `date_received` date NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `type` int(10) NOT NULL,
  `is_available` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`materials_id`, `category_id`, `accnum`, `isbn`, `title`, `callno`, `author`, `publisher`, `edition`, `date_received`, `copyright`, `status`, `type`, `is_available`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 1, 'PUPT Circ-1', 'ISBN 978-07-131798-6', 'Principles of General Chemistry', 'QD 31.3 S55 2013', 'Silberberg', 'McGraw Hill Company Inc.', '3', '0000-00-00', '2013', 1, 1, 1, NULL, NULL, NULL),
(2, 1, 'PUPT Circ-2', 'ISBN 978-0-07-337351-5', 'The Professional Approach: Microsoft Office 2007', '', 'Hinkle, Graves, Juarez, Stewart, Mayhall, Carter,', 'The McGraw-Hill Companies, Inc.', '', '2021-08-27', '2007', 1, 1, 1, NULL, NULL, NULL),
(3, 1, 'PUPT Circ-3', 'ISBN 978-0-07-352699-7', 'Financial and Managerial Accounting', '', 'Jan Williams, Sue Haka, Mark Bettner,Joseph Carcel', 'The McGraw-Hill Companies, Inc.', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(4, 1, 'PUPT Circ-4', 'ISBN-13: 978-1-285-07792-5', 'Programming with Microsoft : Visual Basic 2012', 'QA 76.76 B3z3374 2014', 'Diane Zak', 'CENGAGE Learning Asia', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(5, 1, 'PUPT Circ-5', 'ISBN-13: 978-0-13-512236-5', 'Foundation of Finance', 'HG 4026.F67 K46 2011', 'Keown , Martin, Petty', 'Pearson Education', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(6, 1, 'PUPT Circ-6', 'ISBN-13: 978-0-273-77985-5', 'Cost Accounting : A Managerial Emphasis', 'Hf 5586.C8 H59 2012', 'Charles T. Horngren, Srikant M. Datar, Madhav V. R', 'Pearson Education Limited Inc.', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(7, 1, 'PUPT Circ-7', 'ISBN 0-07-123016-5', 'Financial and Managerial Accounting', 'HF5635.M492', 'Williams, Haka, Bettner, Meigs', 'The McGraw-Hill Companies, Inc.', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(8, 1, 'PUPT Circ-8', 'ISBN 978-0-07-352284-5', 'Mastering  ArcGIS', 'G70.212.P74', 'Maribeth Price', 'The McGraw-Hill Companies, Inc.', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(9, 1, 'PUPT Circ-9', 'ISBN-13: 978-0-321-52678-6', 'Starting out with C++ Early Objects', 'QA 76.73 C153G123 2007', 'Tony Gaddis, Judy Walters, Godfrey Muganda', 'Pearson Education, Inc', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(10, 1, 'PUPT Circ-10', 'ISBN-13: 978-1-4018-4251-2', 'Visualization, Modeling, and Graphics for Engineer', 'TA 174 L721', 'Lieu/Sorby', 'CENGAGE Learning Asia', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(11, 1, 'PUPT Circ-11', 'ISBN-13: 978-1-4180-4102-1', 'Introduction to Digital Electronics', 'TK 7868.D5 R353', 'Ken Reid, Robert Dueck', 'Thomson Delmar Learning', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(12, 1, 'PUPT Circ-12', 'ISBN-13: 978-0-07-830724-9', 'Workbook for Technology of Machine Tools', 'REF 621902 K864T', 'Steve F. Krar, Arthur R. Gill, Peter Smid', 'McGraw Hill Company Inc.', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(13, 1, 'PUPT Circ-13', 'ISBN-13: 978-1-4239-0609-4', 'Computer Concepts: Introductory', 'QA 76 P269', 'June Jamrich Parsons, Dan Oja', 'Thomson Course Technology', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(14, 1, 'PUPT Circ-14', 'ISBN-13: 978-1-4283-1936-3', 'Refrigeration and Air Conditioning Technology', 'TP 492 R281', '', '', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(15, 1, 'PUPT Circ-15', 'ISBN-13: 978-1-4180-3758-1', 'Automotive Service', 'TL 152 G472', 'Tim Gilles', 'DELMAR CENGAGE Learning', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(16, 1, 'PUPT Circ-16', 'ISBN 0-13-6134247-2', 'JAVA How to Program', 'QA 76.73 J38D325', '', '', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(17, 1, 'PUPT Circ-17', 'ISBN 0-619-21724-3', 'JAVA Learning to Program with Robots', 'QA 76.73 J38B395', '', '', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(18, 1, 'PUPT Circ-18', 'ISBN-13: 978-1-4239-0196-9', 'Programming Logic and Design: Comprehensive', 'QA 76,73 F245', '', '', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(19, 1, 'PUPT Circ-19', 'ISBN-13: 978-0-619-26720-9', 'Microsoft Visual Basic 2005: BASICS', 'QA 76.73 B3M626', '', '', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL),
(20, 1, 'PUPT Circ-1', 'ISBN 0-07-253855-4', 'Wastewater Engineering: Treatment and Reuse', '', '', '', '', '0000-00-00', '', 1, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials_category`
--

CREATE TABLE `materials_category` (
  `id` int(10) NOT NULL,
  `cat_structure` varchar(50) NOT NULL,
  `cat_description` varchar(50) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_category`
--

INSERT INTO `materials_category` (`id`, `cat_structure`, `cat_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PUPT Circ', 'Circulation', 1, '2021-06-03 19:05:53', NULL, NULL),
(2, 'PUPT Eb', 'Ebook', 1, '2021-06-16 15:55:32', NULL, NULL),
(3, 'PUPT Feas', 'Feasibility', 1, '2021-06-16 23:11:43', NULL, NULL),
(4, 'PUPT Fili', 'Filipiñana', 1, '2021-06-16 23:25:06', NULL, NULL),
(5, 'PUPT TH/D', 'Theses and Dissertations', 1, '2021-06-16 23:55:11', NULL, NULL),
(6, 'PUPT Ref', 'Reference', 1, '2021-08-27 06:41:54', NULL, NULL),
(7, 'PUPT Don', 'Donation', 1, '2021-08-27 06:42:09', NULL, NULL),
(8, 'PUPT Fic', 'Fiction', 1, '2021-08-27 06:42:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials_subject`
--

CREATE TABLE `materials_subject` (
  `id` int(10) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_subject`
--

INSERT INTO `materials_subject` (`id`, `subject_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Philosophy', 1, '2021-06-03 18:44:05', NULL, NULL),
(2, 'Science', 1, '2021-06-03 18:44:05', NULL, NULL),
(3, 'Mathematics', 1, '2021-06-16 23:23:08', NULL, NULL),
(4, 'Chemistry', 1, '2021-08-27 06:42:51', NULL, NULL),
(5, 'Business', 1, '2021-08-27 06:42:56', NULL, NULL),
(6, 'Physical, Educational and Health', 1, '2021-08-27 06:43:21', NULL, NULL),
(7, 'History', 1, '2021-08-27 06:43:55', NULL, NULL),
(8, 'Social Studies', 1, '2021-08-27 06:44:16', NULL, NULL),
(9, 'Algebra', 1, '2021-08-27 06:44:42', NULL, NULL),
(10, 'Programming', 1, '2021-08-27 06:44:47', NULL, NULL),
(11, 'IT', 1, '2021-08-27 07:17:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials_subject_link`
--

CREATE TABLE `materials_subject_link` (
  `mat_id` int(10) DEFAULT NULL,
  `sub_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_subject_link`
--

INSERT INTO `materials_subject_link` (`mat_id`, `sub_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(5, 1),
(5, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `borrowings_id` int(10) NOT NULL,
  `penalty_days` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penalty_settings`
--

CREATE TABLE `penalty_settings` (
  `id` int(10) NOT NULL,
  `penalty_days` int(3) DEFAULT NULL,
  `penalty_fee` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalty_settings`
--

INSERT INTO `penalty_settings` (`id`, `penalty_days`, `penalty_fee`) VALUES
(1, 3, 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `timein`
--

CREATE TABLE `timein` (
  `id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `timein` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timein`
--

INSERT INTO `timein` (`id`, `users_id`, `timein`, `timeout`, `status`) VALUES
(3, 6, '2021-08-27 18:17:19', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `limit`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', 'admin@email.com', '$2y$10$L2J8xXEiccu0AzqPqRzSf.XtjZfYT9rVmuhqSQtIeaVSGGD4dlQHi', NULL, 1, NULL, NULL, NULL, NULL),
(3, 2, '2021-00001', 'teacher@gmail.com', '$2y$10$L2J8xXEiccu0AzqPqRzSf.XtjZfYT9rVmuhqSQtIeaVSGGD4dlQHi', NULL, 1, NULL, NULL, NULL, NULL),
(4, 2, '2021-00002', '123@gmail.com', '$2y$10$UFovjz0bTNWu2N7Bhz/NEut9ERSqDF8X03aajydy/67Bqtyxqhg2i', NULL, 1, NULL, NULL, NULL, NULL),
(5, 3, '2021-ST-00001', 'zxczxc@gmail.com', '$2y$10$uPopIMgBRzVS51RNSYC4Z./JA9scayR0Ig9Vqsw4hCTxJbHWWhMoK', NULL, 1, NULL, NULL, NULL, NULL),
(6, 2, 'root', 'root@gmail.com', '$2y$10$lRIITArScXAD.RGMJz14xeR/DlnPtw5xsIyZ0u089KowecQA5dlD2', NULL, 0, NULL, NULL, NULL, NULL),
(7, 3, 'student', 'admin@gmail.com', '$2y$10$N9SWB3Ax4s/WuCSYf0b3OekQEzFYnU8.xDaKg8piNYTuFOBHRww.e', NULL, 1, NULL, NULL, NULL, NULL),
(8, 3, '2018-00231-TG-0', 'mhar.apura@gmail.com', '$2y$10$azjKR8Y2LjaIVt/1CbAPKOxpIha7iEcp7907HSdAr1IcacVnRaOvW', NULL, 1, NULL, NULL, NULL, NULL),
(9, 3, '2018-00341-TG-0', 'j.balatong1999@gmail.com', '$2y$10$pvP836YXFSQf.HFe0PrODuKryjGQN63ZAHZQNujFMOGbHNkkK.JJa', NULL, 1, NULL, NULL, NULL, NULL),
(10, 3, '2018-00525-TG-0', 'ecbangga@gmail.com', '$2y$10$rfUHLKntmK6beWaENyA5GegumMuW1uLGRO.hw2TuqCCqWzm3o0kyi', NULL, 1, NULL, NULL, NULL, NULL),
(11, 3, '2018-00484-TG-0', 'llynttburton08@gmail.com', '$2y$10$mVewoOSN/Gjws.ZaBLfJd.8HTvDJpgXSsvZy5RXh9xaAuTkAL1/Li', NULL, 1, NULL, NULL, NULL, NULL),
(12, 3, '2018-00343-TG-0', 'cabanelacharmie24@gmail.com', '$2y$10$QiyMbfQ0GnJN6cWkQgI/EublKUPefnRHNGx.bDqpU3RuiT9lB0FNS', NULL, 1, NULL, NULL, NULL, NULL),
(13, 3, '2018-00256-TG-0', 'joshuacapalaran27@gmail.com', '$2y$10$Qli7cASTj8lSa/l5xwEa/ujOpeiw2R0zRqcBPUQCwTSgDKBdOIh9m', NULL, 1, NULL, NULL, NULL, NULL),
(14, 3, '2018-00220-TG-0', 'quieljeremiahcariaso04@gmail.com', '$2y$10$O2xVhHPm7zGA5s.QjXcCre3lVsUETkZOvrhCDQUnUOnkzeH7Jf1/6', NULL, 1, NULL, NULL, NULL, NULL),
(15, 3, '2018-00342-TG-0', 'kzcortes27@gmail.com', '$2y$10$qgxENTuPd2DwfxIE3x/2SeEDVxEWWbZJDZp4RO7/LEJQB2xaVbBVO', NULL, 1, NULL, NULL, NULL, NULL),
(16, 3, '2018-00361-TG-0', 'johnrusseldacanay@gmail.com', '$2y$10$OUJ8HSOpEZyiiwJWBYpltOjO6jdw8OVK5rayv7YOOYgIhmcgq7Z8i', NULL, 1, NULL, NULL, NULL, NULL),
(17, 3, '2018-00368-TG-0', 'rhingmakz21@gmail.com', '$2y$10$adEmEg2ItaIZUVxTPp0emerFAonL79SlqdQ4cu9GyeRfj8oGfDQPa', NULL, 1, NULL, NULL, NULL, NULL),
(18, 3, '2018-00353-TG-0', 'erjohn13@gmail.com', '$2y$10$D6V/R/vnz89tfUVvvsznSOOZZfln12Pf6SFoJ0vMvNJ3/bkfUngRK', NULL, 1, NULL, NULL, NULL, NULL),
(19, 3, '2018-00379-TG-0', 'froilanfernandez08@gmail.com', '$2y$10$qFtphy.7YAhWm8jTSzLdeeQe06cEz8FhT7ZLfR9sSX2YbbhgSG.A6', NULL, 1, NULL, NULL, NULL, NULL),
(20, 3, '2018-00322-TG-0', 'gabitoraymond358@gmail.com', '$2y$10$RkZTfI9fXA0KkKu5Rc206ecUTiaPZU6r6MX7iWs4cZP48f..CASoG', NULL, 1, NULL, NULL, NULL, NULL),
(21, 3, '2018-00293-TG-0', 'jerome.jalandoon@gmail.com', '$2y$10$OjdKdVUQaFnCSzDoEK0jx.YwueLaxC6LnHFzlLq8lY7WOW3hvEd0.', NULL, 1, NULL, NULL, NULL, NULL),
(22, 3, '2018-00315-TG-0', 'choilapitan47@gmail.com', '$2y$10$CPGHb4FuHcnMzXxXADSlPe1Z8MCd9r/3KOJOvygsBB1fHc5G/fRIO', NULL, 1, NULL, NULL, NULL, NULL),
(23, 3, '2018-00487-TG-0', 'khimlaude@gmail.com', '$2y$10$dWc4i1TRbkIP6yoAJ/Cjke.1sWNDFqxubnStexcPNdNTvSIgi4mv6', NULL, 1, NULL, NULL, NULL, NULL),
(24, 3, '2018-00523-TG-0', 'lazarochan03@gmail.com', '$2y$10$w8UzyoA6LcTW7kKnDVIVb.hl80sQ60POMKRoI6FC16xO9MK6ofSCK', NULL, 1, NULL, NULL, NULL, NULL),
(25, 3, '2018-00299-TG-0', 'davidlimba19@gmail.com', '$2y$10$DnBGInAoiruD6D8o3bX0ZO/CS1z/ZrWlaL7.EcVDHvGj/tBrLjASG', NULL, 1, NULL, NULL, NULL, NULL),
(26, 3, '2018-00376-TG-0', 'linijin17@gmail.com', '$2y$10$d6gJWGMyMsjxuZK3mRrpxulGbMl3WeuX9GnUqCHzloOwXYU2XBRsW', NULL, 1, NULL, NULL, NULL, NULL),
(27, 3, '2018-00319-TG-0', 'paulinellagas@gmail.com', '$2y$10$lgOJFkUbDDD88gUifHJGzui3oNCY2dfzvetn9ebD7K/YZYIrRNWYO', NULL, 1, NULL, NULL, NULL, NULL),
(28, 3, '2018-00349-TG-0', 'zklumabi@gmail.com', '$2y$10$BtNvmmh/vbQGzieGjqM/Ou0lqQoCMeko9NQBHFbCmQYHrhvFQwth6', NULL, 1, NULL, NULL, NULL, NULL),
(29, 3, '2018-00330-TG-0', 'nerissamaglente2@gmail.com', '$2y$10$CNGFqFgbohPXqWo.YWJV8uZz78qyuyaprqV2t5sc4f8jDfHUwSKwe', NULL, 1, NULL, NULL, NULL, NULL),
(30, 3, '2018-00328-TG-0', 'jamreimanalo@gmail.com', '$2y$10$I79LyI4SzFH7eBp7iM/DxeUp.kOIT99ErJV4bCBlH/33P1dxrLrvW', NULL, 1, NULL, NULL, NULL, NULL),
(31, 3, '2018-00328-TG-0', 'jamreimanalo@gmail.com', '$2y$10$0vu6/4KJOAGCGJIqGPabY.fkzukvejH3mC5Ig2e/OyqMTK5IkeabW', NULL, 0, NULL, NULL, NULL, NULL),
(32, 3, '2018-00372-TG-0', 'marcusmanuel.pupt@gmail.com', '$2y$10$bFndlp.DnSqcmwAxgzTAlu/bpjaWXbuRHaIiGAt./T1tHeyQbjQeG', NULL, 1, NULL, NULL, NULL, NULL),
(33, 3, '2018-00305-TG-0', 'mnmerielmanuel@gmail.com', '$2y$10$gINr.0rk9LSArSgutrf/9edTr3mKspz1C8hIw1N4t1gCBEy7srP.W', NULL, 1, NULL, NULL, NULL, NULL),
(34, 3, '2018-00513-TG-0', 'jcnavaja28@gmail.com', '$2y$10$PsMjDNdguktj.sV/TCF/HuOxNmPi2x3SFmtaJb0sFsqfAqRiN9eXG', NULL, 1, NULL, NULL, NULL, NULL),
(35, 3, '2018-00366-TG-0', 'lezzaanne@gmail.com', '$2y$10$545LGzcTy0IhFBnvzaitYe1.eCrK3g0I7F9G8k/A1fRcjL7v6Tes2', NULL, 1, NULL, NULL, NULL, NULL),
(36, 3, '2018-00345-TG-0', 'jillianpollescas@gmail.com', '$2y$10$Iaobl0pCSqOrmJ/4n/gwZu4BwkypMVjd6MfYI1CDEo.ktamxu.CwK', NULL, 1, NULL, NULL, NULL, NULL),
(37, 3, '2018-00354-TG-0', 'grasyamallen@gmail.com', '$2y$10$yxv66u5//JWrSM7Djk5Eael5QzVP.1mkiLwjw6lVh3kM2z9R/7bYu', NULL, 1, NULL, NULL, NULL, NULL),
(38, 3, '2018-00260-TG-0', 'rakimjasmine@gmail.com', '$2y$10$cGHqGsbhc/O288R9XaWUde9dg8/OsAHzHvc9WA9P09n9UgJSoo0Bu', NULL, 1, NULL, NULL, NULL, NULL),
(39, 3, '2018-00355-TG-0', 'shailynjoycesaan@gmail.com', '$2y$10$QV3ZC6h6smBaaB52AAIoHekp4bEcBl1ZKTf2/5YdMSlYkkhIbQ/hG', NULL, 1, NULL, NULL, NULL, NULL),
(40, 3, '2018-00338-TG-0', 'jamiesamar18@gmail.com', '$2y$10$DTNcCkc4WvwXKEql/2GOFe1vQ/efsQCVkasL7nkWrhfRRGWDvifTG', NULL, 1, NULL, NULL, NULL, NULL),
(41, 3, '2018-00263-TG-0', 'serojealdrin@gmail.com', '$2y$10$1GkbbVH3CQ7Ezd0kfCqIeuT8YiWhou1b8PYUHTA6ld2HHVuhaA6RO', NULL, 1, NULL, NULL, NULL, NULL),
(42, 3, '2018-00313-TG-0', 'tmbrccl@gmail.com', '$2y$10$vAoaoJLr/FJ7JP0rbPNNDeazK71kPyr2tRyCV93B1TPWE44xBYgE6', NULL, 1, NULL, NULL, NULL, NULL),
(43, 3, '2018-00370-TG-0', 'csollanojr@gmail.com', '$2y$10$wZStCFaNb0dy6w8nXvnuBOPcsOaEi5mAFObjo18GqIp0caBC4DKR.', NULL, 1, NULL, NULL, NULL, NULL),
(44, 3, '2018-00304-TG-0', 'bernatrads4@gmail.com', '$2y$10$dE7mqbsApL7r0uno0vZgi.3f7fr2WkGt7rTLEZr0zZt0U9JT6F4o2', NULL, 1, NULL, NULL, NULL, NULL),
(45, 3, '2018-00245-TG-0', 'virginiatraquena@gmail.com', '$2y$10$2JdOQQ3P3aiSGkWeGB.mBOtmFxXsPJz.40240n3KZ9gkju1qRPDjm', NULL, 1, NULL, NULL, NULL, NULL),
(46, 3, '2018-00274-TG-0', 'cjualat@gmail.com', '$2y$10$MRzzWwI7OwbetCHUu5kPQOJ52OgMW26XNlixgualfiU5SX1.y92Va', NULL, 1, NULL, NULL, NULL, NULL),
(47, 3, '2018-00253-TG-0', 'alyvillanueva14@gmail.com', '$2y$10$2UAQfMLJ7O/sS3bgj3y8Zu4OoMgmI2aXXTV0uT/QJcajuClot0g4G', NULL, 1, NULL, NULL, NULL, NULL),
(48, 3, '2018-00239-TG-0', 'harveyjohn1926@gmail.com', '$2y$10$XlLwxLl1y5F6NhU/6lr5U.ZFcmBIvGTIG/BWCN/utE5cQnoXqo/Hi', NULL, 1, NULL, NULL, NULL, NULL),
(49, 3, '2018-12345-TG-0', 'first_student@gmail.com', '$2y$10$1wR0Hq.x9Xj6ArIab5Tf9ulPehPEPWKWrBcCZ4aVW/./29Adm8gCC', NULL, 1, NULL, NULL, NULL, NULL),
(50, 3, '2020-00525-TG-0', 'ecbangga@gmail.com', '$2y$10$dHm4UvFScErzuc5/dtkUkOnf4K3z8BUkw0ezV3u1FiQpk.J372K2S', NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(10) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `course_id` int(10) DEFAULT NULL,
  `gender_id` int(10) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `stud_number` varchar(255) DEFAULT NULL,
  `faculty_code` varchar(255) DEFAULT NULL,
  `employee_number` varchar(255) DEFAULT NULL,
  `employee_status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `image_url`, `course_id`, `gender_id`, `firstname`, `lastname`, `middlename`, `birthday`, `contact_no`, `address`, `barangay`, `city`, `zip_code`, `stud_number`, `faculty_code`, `employee_number`, `employee_status`) VALUES
(1, NULL, NULL, 1, 'admin', 'admin', NULL, '1991-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-ADMIN', NULL),
(3, NULL, NULL, 1, 'Angie', 'Antique', NULL, '2021-05-15', NULL, NULL, NULL, 'Taguig', NULL, '', '', '2021-00001', 2),
(4, NULL, NULL, 1, 'Romy', 'Papaitan', NULL, '2021-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-00002', 1),
(5, NULL, NULL, 1, 'Julia', 'Pendon', NULL, '2021-05-16', NULL, NULL, NULL, NULL, NULL, '2021-ST-00001', '', '', 0),
(6, NULL, NULL, 1, 'root', 'root', NULL, '1991-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Test_Student-Test_Student.jpg', NULL, 1, 'Test_Student', 'Test_Student', NULL, '2021-08-07', NULL, NULL, NULL, NULL, NULL, '0000-TESTSTUDENT', '', '', 0),
(8, NULL, 3, 1, 'Ed Mhar', 'Apura', NULL, '2021-08-27', '9291854660', NULL, NULL, NULL, NULL, '2018-00231-TG-0', NULL, NULL, NULL),
(9, NULL, 3, 1, 'Jayson', 'Balatong', NULL, '1999-12-13', '9457042641', NULL, NULL, NULL, NULL, '2018-00341-TG-0', NULL, NULL, NULL),
(10, NULL, 3, 1, 'Christian Elvin', 'Bangga', NULL, '1998-12-03', '977-472-4891', NULL, NULL, NULL, NULL, '2018-00525-TG-0', NULL, NULL, NULL),
(11, NULL, 3, 1, 'Lailynette', 'Burton', NULL, '1999-10-08', '9154997683', NULL, NULL, NULL, NULL, '2018-00484-TG-0', NULL, NULL, NULL),
(12, NULL, 3, 2, 'Charmie', 'Cabanela', NULL, '2000-04-24', '9550838590', NULL, NULL, NULL, NULL, '2018-00343-TG-0', NULL, NULL, NULL),
(13, NULL, 3, 1, 'Joshua', 'Capalaran', NULL, '1999-11-27', NULL, NULL, NULL, NULL, NULL, '2018-00256-TG-0', NULL, NULL, NULL),
(14, NULL, 3, 1, 'Quiel Jeremiah', 'Cariaso', NULL, '2000-03-04', '9165679982', NULL, NULL, NULL, NULL, '2018-00220-TG-0', NULL, NULL, NULL),
(15, NULL, 3, 1, 'Ken Zedric', 'Cortes', NULL, '1999-10-07', '9562679248', NULL, NULL, NULL, NULL, '2018-00342-TG-0', NULL, NULL, NULL),
(16, NULL, 3, 1, 'John Russel', 'Dacanay', NULL, '2000-08-19', '9617030037', NULL, NULL, NULL, NULL, '2018-00361-TG-0', NULL, NULL, NULL),
(17, NULL, 3, 1, 'Edmon', 'Dela Cruz', NULL, '1999-09-17', NULL, NULL, NULL, NULL, NULL, '2018-00368-TG-0', NULL, NULL, NULL),
(18, NULL, 3, 1, 'Erjohn', 'Espuerta', NULL, '1999-03-30', NULL, NULL, NULL, NULL, NULL, '2018-00353-TG-0', NULL, NULL, NULL),
(19, NULL, 3, 1, 'Froilan', 'Fernandez', NULL, '1999-03-26', '9466583458', NULL, NULL, NULL, NULL, '2018-00379-TG-0', NULL, NULL, NULL),
(20, NULL, 3, 1, 'Raymond', 'Gabito', NULL, '2021-08-27', '9079897143', NULL, NULL, NULL, NULL, '2018-00322-TG-0', NULL, NULL, NULL),
(21, NULL, 3, 1, 'Jerome', 'Jalandoon', NULL, '2021-08-27', '9673104255', NULL, NULL, NULL, NULL, '2018-00293-TG-0', NULL, NULL, NULL),
(22, NULL, 3, 1, 'Crisologo', 'Lapitan', NULL, '2021-08-27', '9218088905', NULL, NULL, NULL, NULL, '2018-00315-TG-0', NULL, NULL, NULL),
(23, NULL, 3, 1, 'Van Joakhim', 'Laude', NULL, '2021-08-27', '9553295266', NULL, NULL, NULL, NULL, '2018-00487-TG-0', NULL, NULL, NULL),
(24, NULL, 3, 1, 'Christian', 'Lazaro', NULL, '2021-08-27', '9195252973', NULL, NULL, NULL, NULL, '2018-00523-TG-0', NULL, NULL, NULL),
(25, NULL, 3, 1, 'David', 'Limba', NULL, '2021-08-27', '9498060410', NULL, NULL, NULL, NULL, '2018-00299-TG-0', NULL, NULL, NULL),
(26, NULL, 3, 1, 'Lenard', 'Llacer', NULL, '2021-08-27', '9057368291', NULL, NULL, NULL, NULL, '2018-00376-TG-0', NULL, NULL, NULL),
(27, NULL, 3, 1, 'Pauline', 'Llagas', NULL, '2021-08-27', '9560866865', NULL, NULL, NULL, NULL, '2018-00319-TG-0', NULL, NULL, NULL),
(28, NULL, 3, 2, 'Zairanih', 'Lumabi', NULL, '2021-08-27', '9174656426', NULL, NULL, NULL, NULL, '2018-00349-TG-0', NULL, NULL, NULL),
(29, NULL, 3, 1, 'Nerissa', 'Maglente', NULL, '2021-08-27', '9972238770', NULL, NULL, NULL, NULL, '2018-00330-TG-0', NULL, NULL, NULL),
(30, NULL, 3, 1, 'Jamrei', 'Manalo', NULL, '2021-08-27', '9474784309', NULL, NULL, NULL, NULL, '2018-00328-TG-0', NULL, NULL, NULL),
(31, NULL, 3, 1, 'Jamrei', 'Manalo', NULL, '2021-08-27', '9474784309', NULL, NULL, NULL, NULL, '2018-00328-TG-0', NULL, NULL, NULL),
(32, NULL, 3, 1, 'Marcus Kim', 'Manuel', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00372-TG-0', NULL, NULL, NULL),
(33, NULL, 3, 1, 'Meriel', 'Manuel', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00305-TG-0', NULL, NULL, NULL),
(34, NULL, 3, 1, 'John Carlo', 'Navaja', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00513-TG-0', NULL, NULL, NULL),
(35, NULL, 3, 2, 'Lessa Anne', 'Pascubillo', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00366-TG-0', NULL, NULL, NULL),
(36, NULL, 3, 2, 'Jillian', 'Pollescas', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00345-TG-0', NULL, NULL, NULL),
(37, NULL, 3, 2, 'Mary Grace', 'Ragpala', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00354-TG-0', NULL, NULL, NULL),
(38, NULL, 3, 2, 'Jasmine', 'Rakim', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00260-TG-0', NULL, NULL, NULL),
(39, NULL, 3, 1, 'Shailyn', 'Saan', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00355-TG-0', NULL, NULL, NULL),
(40, NULL, 3, 2, 'Jamie', 'Samar', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00338-TG-0', NULL, NULL, NULL),
(41, NULL, 3, 1, 'Aldrin', 'Seroje', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00263-TG-0', NULL, NULL, NULL),
(42, NULL, 3, 1, 'John Timothy', 'Sescar', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00313-TG-0', NULL, NULL, NULL),
(43, NULL, 3, 1, 'Carlito', 'Sollano', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00370-TG-0', NULL, NULL, NULL),
(44, NULL, 3, 2, 'Bernadette', 'Tradio', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00304-TG-0', NULL, NULL, NULL),
(45, NULL, 3, 2, 'Irish', 'Traquena', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00245-TG-0', NULL, NULL, NULL),
(46, NULL, 3, 1, 'Carl Jon', 'Ualat', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00274-TG-0', NULL, NULL, NULL),
(47, NULL, 3, 1, 'Alyssa Joana', 'Villanueva', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00253-TG-0', NULL, NULL, NULL),
(48, NULL, 3, 1, 'John Harvey', 'Villegas', NULL, '2021-08-27', NULL, NULL, NULL, NULL, NULL, '2018-00239-TG-0', NULL, NULL, NULL),
(49, NULL, NULL, NULL, 'First_Student', 'Last_Student', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12345-TG-0', NULL, NULL, NULL),
(50, NULL, NULL, NULL, 'Christian', 'Bangga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-00525-TG-0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE `user_links` (
  `id` int(11) NOT NULL,
  `link_name` varchar(45) DEFAULT NULL,
  `slug_name` varchar(45) DEFAULT NULL,
  `parent_link_id` int(11) DEFAULT NULL,
  `display_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_links`
--

INSERT INTO `user_links` (`id`, `link_name`, `slug_name`, `parent_link_id`, `display_status`) VALUES
(1, 'User', 'User.index', 1, 1),
(2, 'Add User', 'User.store', 1, 0),
(3, 'Edit User', 'User.show', 1, 0),
(4, 'Delete User', 'UserDelete', 1, 0),
(5, 'Roles', 'Roles.index', 1, 1),
(6, 'Add Roles', 'Roles.store', 1, 0),
(7, 'Edit Roles', 'Roles.show', 1, 0),
(8, 'Delete Roles', 'RolesDelete', 1, 0),
(9, 'Courses', 'Course.index', 1, 1),
(10, 'Add Courses', 'Course.store', 1, 0),
(11, 'Edit Courses', 'Course.show', 1, 0),
(12, 'Delete Courses', 'CourseDelete', 1, 0),
(13, 'View Gender', 'Gender.index', 1, 1),
(14, 'Add Gender', 'Gender.store', 1, 0),
(15, 'Edit Gender', 'Gender.show', 1, 0),
(16, 'Delete Gender', 'GenderDelete', 1, 0),
(17, 'Permissions', 'Permissions.index', 1, 1),
(18, 'Add Permission', 'Permissions.create', 1, 0),
(19, 'Edit Permission', 'Permissions.show', 1, 0),
(21, 'Materials', 'Material.index', 2, 1),
(22, 'Add Materials', 'Material.store', 2, 0),
(23, 'Edit Materials', 'Material.show', 2, 0),
(24, 'Delete Materials', 'MaterialsDelete', 2, 0),
(25, 'Materials Category', 'MaterialsCategory.index', 2, 1),
(26, 'Add Materials Category', 'MaterialsCategory.store', 2, 0),
(27, 'Edit Materials Category', 'MaterialsCategory.show', 2, 0),
(28, 'Delete Materials Category', 'MaterialsCategoryDelete', 2, 0),
(29, 'Materials Subject', 'MaterialsSubject.index', 2, 1),
(30, 'Add Materials Subject', 'MaterialsSubject.store', 2, 0),
(31, 'Edit Materials Subject', 'MaterialsSubject.show', 2, 0),
(32, 'Delete Materials Subject', 'MaterialsSubjectDelete', 2, 0),
(33, 'Borrowed Books', 'Issuing.index', 3, 1),
(34, 'Add Issuing Of Books', 'Issuing.store', 3, 0),
(35, 'Edit Issuing Of Books', 'Issuing.show', 3, 0),
(36, 'Return Issued Books', 'IssuingDelete', 3, 0),
(37, 'Room Use Books', 'Borrowing.index', 3, 1),
(38, 'Add Borrowing Of Books', 'Borrowing.store', 3, 0),
(39, 'Edit Borrowing Of Books', 'Borrowing.show', 3, 0),
(40, 'Returned Borrowed Books', 'BorrowingDelete', 3, 0),
(41, 'Penalty Settings', 'ManagePenalty.index', 4, 1),
(42, 'Edit Penalty Settings', 'ManagePenalty.store', 4, 0),
(43, 'Penalty List', 'Penalty.index', 4, 1),
(44, 'Print Penalty', 'Penalty.PDF', 4, 0),
(45, 'My Profile', 'UserProfile.View', 5, 1),
(46, 'Update My Profile', 'UserProfile.UpdateView', 5, 1),
(47, 'Search Books', 'UserProfile.SearchBook', 5, 1),
(48, 'Reserve Books', 'Reserve.main', 5, 0),
(49, 'My Penalty', 'Penalty.My_Penalty', 5, 1),
(50, 'Materials Archives', 'Archives.Materials_List', 6, 1),
(51, 'Users Archives', 'Archives.Users_List', 6, 1),
(52, 'Room Use Archives', 'Archives.Borrowing_List', 6, 1),
(53, 'Borrowing Archives', 'Archives.Issuing_List', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_links_parent`
--

CREATE TABLE `user_links_parent` (
  `id` int(11) NOT NULL,
  `user_link_parent_name` varchar(45) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `user_role` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_links_parent`
--

INSERT INTO `user_links_parent` (`id`, `user_link_parent_name`, `icon`, `user_role`) VALUES
(1, 'User Management', 'fa-user', 1),
(2, 'Materials Management', 'fa-boxes', 1),
(3, 'Issuing/Borrowing Management', 'fa-clipboard-check', 1),
(4, 'Penalty Management', 'fa-window-close', 1),
(5, 'Users Profile', 'fa-user', 2),
(6, 'Archives', 'fa-archive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT 'On'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`user_id`, `role_id`, `link_id`, `status`) VALUES
(1, 1, 1, 'On'),
(1, 1, 2, 'On'),
(1, 1, 3, 'On'),
(1, 1, 4, 'On'),
(1, 1, 5, 'On'),
(1, 1, 6, 'On'),
(1, 1, 7, 'On'),
(1, 1, 8, 'On'),
(1, 1, 9, 'On'),
(1, 1, 10, 'On'),
(1, 1, 11, 'On'),
(1, 1, 12, 'On'),
(1, 1, 13, 'On'),
(1, 1, 14, 'On'),
(1, 1, 15, 'On'),
(1, 1, 16, 'On'),
(1, 1, 17, 'On'),
(1, 1, 18, 'On'),
(1, 1, 19, 'On'),
(1, 1, 21, 'On'),
(1, 1, 22, 'On'),
(1, 1, 23, 'On'),
(1, 1, 24, 'On'),
(1, 1, 25, 'On'),
(1, 1, 26, 'On'),
(1, 1, 27, 'On'),
(1, 1, 28, 'On'),
(1, 1, 29, 'On'),
(1, 1, 30, 'On'),
(1, 1, 31, 'On'),
(1, 1, 32, 'On'),
(1, 1, 33, 'On'),
(1, 1, 34, 'On'),
(1, 1, 35, 'On'),
(1, 1, 36, 'On'),
(1, 1, 37, 'On'),
(1, 1, 38, 'On'),
(1, 1, 39, 'On'),
(1, 1, 40, 'On'),
(1, 1, 41, 'On'),
(1, 1, 42, 'On'),
(1, 1, 43, 'On'),
(1, 1, 44, 'On'),
(1, 1, 50, 'On'),
(1, 1, 51, 'On'),
(1, 1, 52, 'On'),
(1, 1, 53, 'On'),
(7, 3, 45, 'On'),
(7, 3, 46, 'On'),
(7, 3, 47, 'On'),
(7, 3, 48, 'On'),
(7, 3, 49, 'On'),
(49, 3, 45, 'On'),
(49, 3, 46, 'On'),
(49, 3, 47, 'On'),
(49, 3, 48, 'On'),
(49, 3, 49, 'On'),
(50, 3, 45, 'On'),
(50, 3, 46, 'On'),
(50, 3, 47, 'On'),
(50, 3, 48, 'On'),
(50, 3, 49, 'On');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `role_description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `role_landing` varchar(255) DEFAULT NULL,
  `role_status` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`, `role_description`, `role_landing`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '', NULL, 1, NULL, NULL),
(2, 'Teacher', NULL, NULL, 1, NULL, NULL),
(3, 'Student', NULL, NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_extension`
--
ALTER TABLE `book_extension`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_reservation`
--
ALTER TABLE `book_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`materials_id`);

--
-- Indexes for table `materials_category`
--
ALTER TABLE `materials_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials_subject`
--
ALTER TABLE `materials_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty_settings`
--
ALTER TABLE `penalty_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timein`
--
ALTER TABLE `timein`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_fk_id` (`role_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gender_id_fk` (`gender_id`);

--
-- Indexes for table `user_links`
--
ALTER TABLE `user_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_link_parent_idx` (`parent_link_id`);

--
-- Indexes for table `user_links_parent`
--
ALTER TABLE `user_links_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`user_id`,`role_id`,`link_id`),
  ADD KEY `role_id_fk_idx` (`role_id`),
  ADD KEY `user_link_id_fk_idx` (`link_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_extension`
--
ALTER TABLE `book_extension`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_reservation`
--
ALTER TABLE `book_reservation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `materials_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `materials_category`
--
ALTER TABLE `materials_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materials_subject`
--
ALTER TABLE `materials_subject`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timein`
--
ALTER TABLE `timein`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_links_parent`
--
ALTER TABLE `user_links_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_role_fk_id` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `gender_id_fk` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`);

--
-- Constraints for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`),
  ADD CONSTRAINT `user_permission_ibfk_3` FOREIGN KEY (`link_id`) REFERENCES `user_links` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
