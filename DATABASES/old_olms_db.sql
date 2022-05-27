-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2021 at 06:13 PM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u623987209_olmstest_db`
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

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) NOT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `course_description` varchar(100) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_description`, `status`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'DICT', 'Diploma in Information Communication Technology', 1, NULL, NULL, NULL),
(2, 'BSIT', 'Bachelor of Science in Information Technology', 1, NULL, NULL, NULL),
(3, 'BSECE', 'Bachelor of Science in Electronics Engineering', 1, NULL, NULL, NULL),
(4, 'BSME', 'Bachelor of Science in Mechanical Engineering', 1, NULL, NULL, NULL),
(5, 'BSA', 'Bachelor of Science in Accountancy', 1, NULL, NULL, NULL),
(6, 'BSBA', 'Bachelor of Science in Business Administration', 1, NULL, NULL, NULL),
(7, 'BSAM', 'Bachelor of Science in Applied Mathematics', 1, NULL, NULL, NULL),
(8, 'BSENTREP', 'Bachelor of Science in Entrepreneurship', 1, NULL, NULL, NULL),
(9, 'BSED', 'Bachelor in Secondary Education', 1, NULL, NULL, NULL),
(10, 'BSOA', 'Bachelor of Science in Office Administration', 1, NULL, NULL, NULL),
(11, 'DOMT', 'Diploma in Office Management Technology', 1, NULL, NULL, NULL);

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
(2, 'Female', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `materials_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `accnum` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `callno` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `edition` varchar(50) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `copies` int(11) DEFAULT 0,
  `copyright` varchar(50) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `type` int(10) DEFAULT NULL,
  `is_available` int(10) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`materials_id`, `category_id`, `accnum`, `isbn`, `title`, `callno`, `author`, `publisher`, `edition`, `date_received`, `copies`, `copyright`, `status`, `type`, `is_available`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 1, 'PUPT Circ-1', 'ISBN 978-07-131798-6', 'Principles of General Chemistry', 'QD 31.3 S55 2013', 'Silberberg', 'McGraw Hill Company Inc.', '1st Edition', '2021-09-22', 3, '2013', 1, 1, 0, NULL, '2021-09-30 20:57:26', NULL),
(2, 1, 'PUPT Circ-2', 'ISBN 978-0-07-337351-5', 'The Professional Approach: Microsoft Office 2007', 'a', 'Hinkle, Graves, Juarez, Stewart, Mayhall, Carter,', 'The McGraw-Hill Companies, Inc.', '3rd Edition', '2021-08-27', 2, '2007', 1, 1, 1, NULL, '2021-09-22 14:57:46', '2021-09-30 21:28:46'),
(3, 1, 'PUPT Circ-3', 'ISBN 978-0-07-352699-7', 'Financial and Managerial Accounting', 'a', 'Jan Williams, Sue Haka, Mark Bettner,Joseph Carcel', 'The McGraw-Hill Companies, Inc.', '2nd Edition', '2021-09-22', 5, '2018', 1, 1, 1, NULL, '2021-09-23 15:58:27', NULL),
(4, 1, 'PUPT Circ-4', 'ISBN-13: 978-1-285-07792-5', 'Programming with Microsoft : Visual Basic 2012', 'QA 76.76 B3z3374 2014', 'Diane Zak', 'CENGAGE Learning Asia', '6th Edition', '2021-09-22', 2, '3', 1, 1, 1, NULL, '2021-09-22 15:02:51', NULL),
(5, 1, 'PUPT Circ-5', 'ISBN-13: 978-0-13-512236-5', 'Foundation of Finance', 'HG 4026.F67 K46 2011', 'Keown , Martin, Petty', 'Pearson Education', NULL, NULL, 1, NULL, 1, 1, 1, NULL, '2021-09-23 15:25:00', NULL),
(6, 1, 'PUPT Circ-6', 'ISBN-13: 978-0-273-77985-5', 'Cost Accounting : A Managerial Emphasis', 'Hf 5586.C8 H59 2012', 'Charles T. Horngren, Srikant M. Datar, Madhav V. R', 'Pearson Education Limited Inc.', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(7, 1, 'PUPT Circ-7', 'ISBN 0-07-123016-5', 'Financial and Managerial Accounting', 'HF5635.M492', 'Williams, Haka, Bettner, Meigs', 'The McGraw-Hill Companies, Inc.', NULL, NULL, 1, NULL, 1, 1, 1, NULL, '2021-09-23 15:25:08', NULL),
(8, 1, 'PUPT Circ-8', 'ISBN 978-0-07-352284-5', 'Mastering  ArcGIS', 'G70.212.P74', 'Maribeth Price', 'The McGraw-Hill Companies, Inc.', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(9, 1, 'PUPT Circ-9', 'ISBN-13: 978-0-321-52678-6', 'Starting out with C++ Early Objects', 'QA 76.73 C153G123 2007', 'Tony Gaddis, Judy Walters, Godfrey Muganda', 'Pearson Education, Inc', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(10, 1, 'PUPT Circ-10', 'ISBN-13: 978-1-4018-4251-2', 'Visualization, Modeling, and Graphics for Engineer', 'TA 174 L721', 'Lieu/Sorby', 'CENGAGE Learning Asia', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(11, 1, 'PUPT Circ-11', 'ISBN-13: 978-1-4180-4102-1', 'Introduction to Digital Electronics', 'TK 7868.D5 R353', 'Ken Reid, Robert Dueck', 'Thomson Delmar Learning', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(12, 1, 'PUPT Circ-12', 'ISBN-13: 978-0-07-830724-9', 'Workbook for Technology of Machine Tools', 'REF 621902 K864T', 'Steve F. Krar, Arthur R. Gill, Peter Smid', 'McGraw Hill Company Inc.', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(13, 1, 'PUPT Circ-13', 'ISBN-13: 978-1-4239-0609-4', 'Computer Concepts: Introductory', 'QA 76 P269', 'June Jamrich Parsons, Dan Oja', 'Thomson Course Technology', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(14, 1, 'PUPT Circ-14', 'ISBN-13: 978-1-4283-1936-3', 'Refrigeration and Air Conditioning Technology', 'TP 492 R281', '', '', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(15, 1, 'PUPT Circ-15', 'ISBN-13: 978-1-4180-3758-1', 'Automotive Service', 'TL 152 G472', 'Tim Gilles', 'DELMAR CENGAGE Learning', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(16, 1, 'PUPT Circ-16', 'ISBN 0-13-6134247-2', 'JAVA How to Program', 'QA 76.73 J38D325', '', '', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(17, 1, 'PUPT Circ-17', 'ISBN 0-619-21724-3', 'JAVA Learning to Program with Robots', 'QA 76.73 J38B395', '', '', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(18, 1, 'PUPT Circ-18', 'ISBN-13: 978-1-4239-0196-9', 'Programming Logic and Design: Comprehensive', 'QA 76,73 F245', '', '', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(19, 1, 'PUPT Circ-19', 'ISBN-13: 978-0-619-26720-9', 'Microsoft Visual Basic 2005: BASICS', 'QA 76.73 B3M626', '', '', '', '0000-00-00', 0, '', 1, 1, 1, NULL, NULL, NULL),
(20, 1, 'PUPT Circ-1', 'ISBN 0-07-253855-4', 'Wastewater Engineering: Treatment and Reuse', '', '', '', '', '0000-00-00', 0, '', 1, 1, 0, NULL, NULL, NULL),
(21, 1, 'PUPT Circ-21', 'Sample', 'Sample', '1234', 'Sample', 'Sample', '2nd Edition', '2021-09-21', 13, '2021', 0, 2, 1, '2021-09-21 13:21:43', '2021-09-22 14:55:24', '2021-09-22 15:04:16'),
(22, 2, 'PUPT Eb-22', 'Sample', 'Sample', '123', 'Author', 'Publisher', '4th Edition', '2021-09-22', 5, '2', 0, 1, 1, '2021-09-22 15:03:56', NULL, '2021-09-22 15:04:11'),
(23, 1, 'PUPT Circ-23', 'ISBN 978-0-07-304860-4', 'Student Solutions Manual to Accompany Chemistry:  The Molecular Nature of Matter and Change', 'QD33.2 S55', 'Patricia Amateis, Martin S. Silberberg', 'The McGraw-Hill Companies, Inc.', '5th Edition', NULL, 5, '2006', 1, 1, 1, '2021-09-23 16:06:42', '2021-09-23 16:11:37', NULL),
(24, 1, 'PUPT Circ-24', 'ISBN 1-4188-3706-7', 'Problem-Solving Cases in Microsoft Access and Excel', 'HF 5548 M525B798', 'Joseph A. Brady, Ellen F. Monk', 'Thomson Course Technology', '4th Edition', '2021-09-23', 1, '2007', 1, 1, 1, '2021-09-23 16:13:49', NULL, NULL),
(25, 1, 'PUPT Circ-25', 'ISBN-13a978-1-4239-0117-4', 'Fundamentals of Information Systems', 'T 58.6 s782', 'Ralph Stair, George Reynolds', 'Thomson Course Technology', '4th Edition', NULL, 1, '2008', 1, 1, 1, '2021-09-23 16:15:50', NULL, NULL),
(26, 1, 'PUPT Circ-26', 'ISBN-13: 978-0-619-21760-0', 'CompTIA A+ Guide to Software: Managing, Maintaining, Troubleshooting', 'QA 76.3 A567', 'Jean Andrews', 'Thomson Course Technology', '4th Edition', NULL, 1, '2007', 1, 1, 1, '2021-09-23 16:17:29', NULL, NULL),
(27, 1, 'PUPT Circ-27', 'ISBN-13: 978-0-9778582-3-1', 'Thomson Course Technology', 'ISBN-13: 978-0-9778582-3-1', 'M. Tim Jones', 'Infinity Science Press', '1st Edition', NULL, 1, '2008', 1, 1, 1, '2021-09-23 16:19:15', NULL, NULL),
(28, 1, 'PUPT Circ-28', 'ISBN-13: 978-0-9778582-3-1', 'Infinity Science Press', 'Q 336 J78 2008', 'M. Tim Jones', 'Infinity Science Press', '1st Edition', NULL, 1, '2008', 1, 1, 1, '2021-09-23 16:24:07', NULL, NULL),
(29, 1, 'PUPT Circ-29', 'ISBN-13: 978-0-9778582-3-1', 'Fundamentals of Microcontrollers and Applications in Embedded Systems(with the PIC 18 Microcontroller Family)', 'TJ 223 G111', 'Ramesh S. Gaonkar', 'Thomson Delmar Learning', NULL, NULL, 1, '2007', 1, 1, 1, '2021-09-23 16:26:24', NULL, NULL),
(30, 1, 'PUPT Circ-30', 'ISBN-13: 978-1-4180-5001-6', 'Managing Interactive Media Projects', 'QA 76.76 T59F897', 'Tim Frick', 'Thomson Delmar Learning', NULL, NULL, 1, '2008', 1, 1, 1, '2021-09-23 16:27:34', NULL, NULL),
(31, 1, 'PUPT Circ-31', 'ISBN-13: 978-0-13-606072-7', 'An Introduction to PROGRAMMING Using VISUAL BASIC 2008', 'QA 76.73 B3S358', 'David I. Schneider', 'Pearson Prentice Hall', '7th Edition', NULL, 1, '2009', 1, 1, 1, '2021-09-23 16:32:32', NULL, NULL),
(32, 1, 'PUPT Circ-32', 'ISBN 978-0-07-353507-4', 'The Art of Watching Films', 'PN1995 B525', 'Joseph M. Boggs, Dennis W. Petrie', 'McGraw Hill Company Inc.', '7th Edition', NULL, 1, '2008', 1, 1, 1, '2021-09-23 16:37:00', NULL, NULL),
(33, 1, 'PUPT Circ-33', 'ISBN 0-13-229630-6', 'Fundamentals of Applied Electromagnetics', 'QC 760 U36', NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-09-23 16:38:08', '2021-09-23 16:38:58', NULL);

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
-- Table structure for table `materials_copies`
--

CREATE TABLE `materials_copies` (
  `id` int(11) NOT NULL,
  `materials_id` int(11) DEFAULT NULL,
  `borrows_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_copies`
--

INSERT INTO `materials_copies` (`id`, `materials_id`, `borrows_id`, `quantity`, `status`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 2, 1, 0),
(3, 3, 3, 1, 0),
(4, 4, 4, 1, 0),
(5, 4, 5, 1, 0),
(6, 2, 6, 1, 0),
(7, 3, 7, 1, 0);

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
(11, 'IT', 1, '2021-08-27 07:17:56', NULL, NULL),
(12, 'Engineering', 1, '2021-09-23 16:38:25', NULL, NULL);

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
(5, 3),
(22, 3),
(23, 4),
(24, 11),
(25, 11),
(26, 11),
(27, 11),
(28, 11),
(29, 11),
(30, 11),
(31, 11),
(32, 11),
(33, 5);

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
(1, 3, 10.00);

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
(1, 2, '2021-09-23 11:51:39', '2021-09-23 11:54:54', 0),
(2, 51, '2021-09-23 19:56:00', '2021-09-23 19:57:03', 0);

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
(1, 1, 'puptlibrary2021', 'admin@email.com', '$2y$10$L2J8xXEiccu0AzqPqRzSf.XtjZfYT9rVmuhqSQtIeaVSGGD4dlQHi', NULL, 1, NULL, NULL, NULL, NULL),
(2, 3, '2018-00525-TG-0', 'ecbangga@gmail.com', '$2y$10$ppvI7HpE41/cf2Ea0LJ6/udrxjz5UZOmEV4ZtfYMjkvFxckyaghL.', NULL, 1, NULL, NULL, NULL, NULL),
(3, 3, '2018-00086-TG-0', 'eugeneraynera110820@gmail.com', '$2y$10$TVOYMVjsyMJ1r9mhImSYDOjhUX1ySK4JgCqnNh1fqvDmhpZfS9Afe', NULL, 1, NULL, NULL, NULL, NULL),
(4, 3, '2019-00114-TG-0', 'etinjannielyn@gmail.com', '$2y$10$9T2Wd0CsF56ZRvqkmuB3g.XnTU3Dx03YPrZC.le3/7F0BAhsreMjS', NULL, 1, NULL, NULL, NULL, NULL),
(5, 3, '2019-00126-TG-0', 'gierza29@gmail.com', '$2y$10$52j0c/KfEwFlSiQMAHS/ZubGBjYg3ulyR230imQxW7iVFp5eRcwWe', NULL, 1, NULL, NULL, NULL, NULL),
(6, 3, '2018-00342-TG-0', 'kzcortes27@gmail.com', '$2y$10$m3y4z05dLyPSpheuP.2Y3OjVs3U01As3aXrHBTC4UUfvQ8PiFmU1y', NULL, 1, NULL, NULL, NULL, NULL),
(7, 3, 'JDionisio', 'galidojoymee@gmail.com', '$2y$10$uQ0M26gYzZKcXqsFrifKAePvJchzz2PQNkTZgAD3ygDu0ABUs/x.6', NULL, 1, NULL, NULL, NULL, NULL),
(8, 3, '2018-00366-TG-0', 'lezzaanne@gmail.com', '$2y$10$9oAPR60OxA9zcw3KngsC4upXOYoaIf31kCJEosM/KeBDzvX7a9/5O', NULL, 1, NULL, NULL, NULL, NULL),
(9, 3, '2018-00231-TG-0', 'paulinellagas@gmail.com', '$2y$10$aAjmAp7aND2upnGT8fEoYuqxLtNaogqtBD8JlR11LXaDEwPfvsr9W', NULL, 1, NULL, NULL, NULL, NULL),
(10, 3, '2019-00422-TG-0', 'virtusioaira7@gmail.com', '$2y$10$XYB11o5qwwv/DhaK0odSlO3j2nW9eS7nPx5I.n9Kvr2dDvY3aJ0im', NULL, 1, NULL, NULL, NULL, NULL),
(11, 3, '2019-00422-TG-0', 'virtusioaira7@gmail.com', '$2y$10$SEPHdjpd5ek62lNJ9h0hjeFwr5VgpxuYt4x6Sy3ZO8erD3JaAi9LO', NULL, 1, NULL, NULL, NULL, NULL),
(12, 3, '2018-00220-TG-0', 'quieljeremiahcariaso04@gmail.com', '$2y$10$xPO16wY/XxiGDWGncqOgB.X.w/w0D27ow2SeQrLu8DltwDDWj33TW', NULL, 1, NULL, NULL, NULL, NULL),
(13, 3, '2018-00231-TG-0', 'mhar.apura@gmail.com', '$2y$10$1yOghpECE1ecMx8.niAWOuTqbjqjMhWLthBIeYsN4S.w57nKnajLi', NULL, 1, NULL, NULL, NULL, NULL),
(14, 3, '2018-00341-TG-0', 'j.balatong1999@gmail.com', '$2y$10$hiGhckQHBYsTCOet7Uz3PuqhNWnUePvGjpR/W0dejMS3mhHYhEK1q', NULL, 1, NULL, NULL, NULL, NULL),
(15, 3, '2018-00484-TG-0', 'llynttburton08@gmail.com', '$2y$10$wrChaTMZdFVskAjnXP7sl.R2xVkDpkPoFsNL.6oquBfm1Wq.7b7l2', NULL, 1, NULL, NULL, NULL, NULL),
(16, 3, '2018-00343-TG-0', 'cabanelacharmie24@gmail.com', '$2y$10$putpUtkTsYC6hF/ZfJU53OBMisxT/loA6jBr6aOhDg6KLUYpAVhiC', NULL, 1, NULL, NULL, NULL, NULL),
(17, 3, '2018-00256-TG-0', 'joshuacapalaran27@gmail.com', '$2y$10$0DKhM/ei.z551rgWW6wv.OusK238yvKVe5VmkrSG9XN31KmJsMa7O', NULL, 1, NULL, NULL, NULL, NULL),
(18, 3, '2018-00361-TG-0', 'johnrusseldacanay@gmail.com', '$2y$10$AcZTPn/uNmtrUffySanKOuOeVFvzfdAqf471Zc05U.IQCfWJZ6/US', NULL, 1, NULL, NULL, NULL, NULL),
(19, 3, '2018-00368-TG-0', 'rhingmakz21@gmail.com', '$2y$10$M8qM02N9OWGUIotcWYLt5edIAelTo9UZm4poH8u85kwC/N5Nv.NMC', NULL, 1, NULL, NULL, NULL, NULL),
(20, 3, '2018-00353-TG-0', 'erjohn13@gmail.com', '$2y$10$KY0lhoriHY9SeHvKyp2SjOEgwGfJ8mqTxQBHUdoWEsJByEqF01N1m', NULL, 1, NULL, NULL, NULL, NULL),
(21, 3, '2018-00379-TG-0', 'froilanfernandez08@gmail.com', '$2y$10$Hfkv7sfGVrLZK.coK85Qe.YeKJ49HkYBADo5U2IVyS5CbX6PFmS/G', NULL, 1, NULL, NULL, NULL, NULL),
(22, 3, '2018-00322-TG-0', 'gabitoraymond358@gmail.com', '$2y$10$kZ0BPp2VtOQrcHI9qiajreIH2jTPdSBwWyAJ9vWMAX/NpARFJ0x3S', NULL, 1, NULL, NULL, NULL, NULL),
(23, 3, '2018-00293-TG-0', 'jerome.jalandoon@gmail.com', '$2y$10$VS//Z0n1dXbrmtc.QNUB7.SgohxROdqt/2rNrj8L9fV3KhftHwjHi', NULL, 1, NULL, NULL, NULL, NULL),
(24, 3, '2018-00315-TG-0', 'choilapitan47@gmail.com', '$2y$10$LtK7NSlBpUlNgYLz3bC/ZuB5VHkV0G2S/IrOsOi5F03ABYa7qIxfe', NULL, 1, NULL, NULL, NULL, NULL),
(25, 3, '2018-00487-TG-0', 'khimlaude@gmail.com', '$2y$10$tZN/N8msME1HOc8tMmHg1OqtqASKItsmHNOV1lGDy0C4BpAIgKnJK', NULL, 1, NULL, NULL, NULL, NULL),
(26, 3, '2018-00523-TG-0', 'lazarochan03@gmail.com', '$2y$10$CZPfgEKQ7xJmc.jEBvky6.vNZBGTdtdzbr6oH0K5wUVehOhju0VRK', NULL, 1, NULL, NULL, NULL, NULL),
(27, 3, '2018-00299-TG-0', 'davidlimba19@gmail.com', '$2y$10$XruhNXK8ovdKVqdIUdZwEeeCaIhRQr7K4OHMvRpSQbNbA/ZdVkJWq', NULL, 1, NULL, NULL, NULL, NULL),
(28, 3, '2018-00376-TG-0', 'linijin17@gmail.com', '$2y$10$9h9VuzPqWSB0lAVGZF2//.ZoKAmr1jLJpySacnPpBBMRTxunlLP/q', NULL, 1, NULL, NULL, NULL, NULL),
(29, 3, '2018-00349-TG-0', 'zklumabi@gmail.com', '$2y$10$7xIkxID5t60FA1gxLrhvNuVNM06Wt0MtEvcAhipxbz72WT9yzS4WG', NULL, 1, NULL, NULL, NULL, NULL),
(30, 3, '2018-00330-TG-0', 'nerissamaglente2@gmail.com', '$2y$10$kdb9EORfMQtpZAF/eX25hOivwcySyZ1uQUh3nKPNtYpTvvHFbsv1a', NULL, 1, NULL, NULL, NULL, NULL),
(31, 3, '2018-00328-TG-0', 'jamreimanalo@gmail.com', '$2y$10$gHvzd5MsVAJVTMwOdG0.JeFtD/Ygj3ymR1pplVNCdoFUwN.s4kraW', NULL, 1, NULL, NULL, NULL, NULL),
(32, 3, '2018-00372-TG-0', 'marcusmanuel.pupt@gmail.com', '$2y$10$ERt..72a//Hf/Atu4hCksORLaguLdRnXiYvwbEK2Nqj1Zs4.JUPoO', NULL, 1, NULL, NULL, NULL, NULL),
(33, 3, '2018-00305-TG-0', 'mnmerielmanuel@gmail.com', '$2y$10$gWjgLBBq7EvZoCVgJbtqAubFfepjRYr0wNhCdkcP96WqrpXTUpHeC', NULL, 1, NULL, NULL, NULL, NULL),
(34, 3, '2018-00513-TG-0', 'jcnavaja28@gmail.com', '$2y$10$s7OoZ7RTuE5ZKUzyXAfRuOXpLZ9gHphVIXA4dj3bViLUxIfn9bD7G', NULL, 1, NULL, NULL, NULL, NULL),
(35, 3, '2018-00345-TG-0', 'jillianpollescas@gmail.com', '$2y$10$KnGy0QvhV1WkG2.XnFpIIOR4tB0yIqz.OZrXGfEN7LJU6fvWe954a', NULL, 1, NULL, NULL, NULL, NULL),
(36, 3, '2018-00354-TG-0', 'grasyamallen@gmail.com', '$2y$10$2Gjg4mCd6wcpfae8dhi7meieatj.bFNejdODGzcf4Ufp0iTi0yQNu', NULL, 1, NULL, NULL, NULL, NULL),
(37, 3, '2018-00260-TG-0', 'rakimjasmine@gmail.com', '$2y$10$F0SrLmQu48bL3DhLFiIzH.v85ogeyts2rtIxkdIjFn2H10Ns5KeU2', NULL, 1, NULL, NULL, NULL, NULL),
(38, 3, '2018-00355-TG-0', 'shailynjoycesaan@gmail.com', '$2y$10$jaig4Q21kl/Tdm3W1X1H3OHXJ99o/MvkCMaw.cB/tkILLX3cweynW', NULL, 1, NULL, NULL, NULL, NULL),
(39, 3, '2018-00338-TG-0', 'jamiesamar18@gmail.com', '$2y$10$1PL08nr6qjmwn6fob/eTMuGAXFyYo29aLtOirJPlZ1rEP.I/MiUua', NULL, 1, NULL, NULL, NULL, NULL),
(40, 3, '2018-00263-TG-0', 'serojealdrin@gmail.com', '$2y$10$E3m8zXWxQ1j9GbYULJoQmu/3E59k5HhwBm45hU7NYZ59P/SRtRLeW', NULL, 1, NULL, NULL, NULL, NULL),
(41, 3, '2018-00313-TG-0', 'tmbrccl@gmail.com', '$2y$10$PDBfaFpoKDQ/ehebkn0Z6OI0QIeP7YTBDLPF.uTK1.pTdRyiwQvoy', NULL, 1, NULL, NULL, NULL, NULL),
(42, 3, '2018-00370-TG-0', 'csollanojr@gmail.com', '$2y$10$aAjglnAGgqhepGYH1e8zg.3to0DLtXsDcpNmK/742YaR9BYwxVN3e', NULL, 1, NULL, NULL, NULL, NULL),
(43, 3, '2018-00304-TG-0', 'bernatrads4@gmail.com', '$2y$10$jBcRZCKSNnTeRc9lBO.Kz.mFFA1nsE7vU/Ly5BoUY0qcANArbIVoS', NULL, 1, NULL, NULL, NULL, NULL),
(44, 3, '2018-00342-TG-0', 'johndoe@gmail.com', '$2y$10$t3JRrxfgQ6r.Q1bk1htcwehB2S83hnGflr7B5RYmS0QWApFaxsDr6', NULL, 0, NULL, NULL, NULL, NULL),
(45, 3, '2018-00342-TG-0', 'johndoe@gmail.com', '$2y$10$1eDN0BpnyKMqTID4Neii9e6utVJ4p7Et5HsXtsL2LzGFfYOZBaWhW', NULL, 0, NULL, NULL, NULL, NULL),
(46, 3, '2018-00123-TG-0', 'johndoe@gmail.com', '$2y$10$zX08kwmhHilmZCJAx4G8vuZlIE1KTUXcl0aHOmRJF/Uub2wEWRibC', NULL, 0, NULL, NULL, NULL, NULL),
(47, 3, '2018-00123-TG-0', 'johndoe@gmail.com', '$2y$10$jpxPPFhpsTP.xOZbNbUW4eC2uoCTGx.7MmjhOzhbDTmshSKYMy.3i', NULL, 0, NULL, NULL, NULL, NULL),
(48, 3, '2018-00123-TG-0', 'johndoe@gmail.com', '$2y$10$hGW14Csczj5OJFLinyzBK.Y1r8.OaajDMF7KLswnonBoSW7AHQUa2', NULL, 0, NULL, NULL, NULL, NULL),
(49, 3, '2018-00123-TG-0', 'johndoe@gmail.com', '$2y$10$.zrGyoD/a1UjLK8LL9UBPexlZ6yJVVdWMWLbigF77pmqGo7QyL59K', NULL, 0, NULL, NULL, NULL, NULL),
(50, 3, '2018-00123-TG-0', 'johndoe@gmail.com', '$2y$10$Ufr8mlBnew6r4J5zBUyS3OEcc6liqsEAKDmMmbxZnvL37DJD/.U/.', NULL, 0, NULL, NULL, NULL, NULL),
(51, 3, '2018-00121-TG-0', 'johndoe@gmail.com', '$2y$10$L35ZNEY2Aed5owrX2bk4sO.X0a0PsoHGt7Imy.VNz2YiP6HRwMDOm', NULL, 1, NULL, NULL, NULL, NULL),
(52, 3, '2020-00000-TG-0', 'richard.gabito@gmail.com', '$2y$10$kyx19TWwo3bqUGFU13AU2eAK267foWl5QFyEvI6JtiQhU3vGhJws.', NULL, 1, NULL, NULL, NULL, NULL);

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
(2, 'Bangga-Christian Elvin.jpg', NULL, NULL, 'Christian Elvin', 'Bangga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00525-TG-0', '', '', 0),
(3, NULL, NULL, NULL, 'Eugene', 'Raynera', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00086-TG-0', NULL, NULL, NULL),
(4, NULL, NULL, NULL, 'Jannielyn', 'Etin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00114-TG-0', NULL, NULL, NULL),
(5, NULL, NULL, NULL, 'Lougen', 'Gierza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00126-TG-0', NULL, NULL, NULL),
(6, NULL, NULL, NULL, 'Ken Zedric', 'Cortes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00342-TG-0', NULL, NULL, NULL),
(7, NULL, NULL, NULL, 'Joymee', 'Dionisio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JDionisio', NULL, NULL, NULL),
(8, NULL, NULL, NULL, 'Lessa Anne', 'Pascubillo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00366-TG-0', NULL, NULL, NULL),
(9, 'Llagas-Pauline Jane.png', NULL, 2, 'Pauline Jane', 'Llagas', 'Santos', '1999-07-02', NULL, NULL, NULL, NULL, NULL, '2018-00218-TG-0', '', '', 0),
(10, 'Virtusio-Aira Dynielle.jpg', NULL, NULL, 'Aira Dynielle', 'Virtusio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00422-TG-0', '', '', 0),
(11, NULL, NULL, NULL, 'Aira Dynielle', 'Virtusio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00422-TG-0', NULL, NULL, NULL),
(12, NULL, NULL, NULL, 'Quiel Jeremiah', 'Cariaso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00220-TG-0', NULL, NULL, NULL),
(13, NULL, 1, 1, 'Ed Mhar', 'Apura', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00231-TG-0', NULL, NULL, NULL),
(14, NULL, NULL, NULL, 'Jayson', 'Balatong', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00341-TG-0', NULL, NULL, NULL),
(15, NULL, NULL, NULL, 'Lailynette', 'Burton', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00484-TG-0', NULL, NULL, NULL),
(16, NULL, NULL, 2, 'Charmie', 'Cabanela', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00343-TG-0', NULL, NULL, NULL),
(17, NULL, NULL, NULL, 'Joshua', 'Capalaran', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00256-TG-0', NULL, NULL, NULL),
(18, NULL, NULL, NULL, 'John Russel', 'Dacanay', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00361-TG-0', NULL, NULL, NULL),
(19, NULL, NULL, NULL, 'Edmon', 'Dela Cruz', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00368-TG-0', NULL, NULL, NULL),
(20, NULL, NULL, NULL, 'Erjohn', 'Espuerta', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00353-TG-0', NULL, NULL, NULL),
(21, NULL, NULL, NULL, 'Froilan', 'Fernandez', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00379-TG-0', NULL, NULL, NULL),
(22, NULL, NULL, NULL, 'Raymond', 'Gabito', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00322-TG-0', NULL, NULL, NULL),
(23, NULL, NULL, NULL, 'Jerome', 'Jalandoon', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00293-TG-0', NULL, NULL, NULL),
(24, NULL, NULL, NULL, 'Crisologo', 'Lapitan', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00315-TG-0', NULL, NULL, NULL),
(25, NULL, NULL, NULL, 'Van', 'Laude', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00487-TG-0', NULL, NULL, NULL),
(26, NULL, NULL, NULL, 'Christian', 'Lazaro', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00523-TG-0', NULL, NULL, NULL),
(27, NULL, NULL, NULL, 'David', 'Limba', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00299-TG-0', NULL, NULL, NULL),
(28, NULL, NULL, 1, 'Lenard', 'Llacer', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00376-TG-0', NULL, NULL, NULL),
(29, NULL, NULL, NULL, 'Zairanih', 'Lumabi', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00349-TG-0', NULL, NULL, NULL),
(30, NULL, NULL, NULL, 'Nerissa', 'Maglente', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00330-TG-0', NULL, NULL, NULL),
(31, NULL, NULL, NULL, 'Jamrei', 'Manalo', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00328-TG-0', NULL, NULL, NULL),
(32, NULL, NULL, NULL, 'Marcus', 'Manuel', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00372-TG-0', NULL, NULL, NULL),
(33, NULL, NULL, NULL, 'Meriel', 'Manuel', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00305-TG-0', NULL, NULL, NULL),
(34, NULL, NULL, NULL, 'Jonh Carlo', 'Navaja', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00513-TG-0', NULL, NULL, NULL),
(35, NULL, NULL, NULL, 'Jillian', 'Pollescas', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00345-TG-0', NULL, NULL, NULL),
(36, NULL, NULL, NULL, 'Mary Grace', 'Ragpala', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00354-TG-0', NULL, NULL, NULL),
(37, NULL, NULL, NULL, 'Jasmine', 'Rakim', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00260-TG-0', NULL, NULL, NULL),
(38, NULL, NULL, NULL, 'Shailyn', 'Sa - an', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00355-TG-0', NULL, NULL, NULL),
(39, NULL, NULL, NULL, 'Jamie', 'Samar', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00338-TG-0', NULL, NULL, NULL),
(40, NULL, NULL, NULL, 'Aldrin', 'Seroje', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00263-TG-0', NULL, NULL, NULL),
(41, NULL, NULL, NULL, 'John Timothy', 'Sescar', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00313-TG-0', NULL, NULL, NULL),
(42, NULL, NULL, NULL, 'Carlito', 'Sollano', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00370-TG-0', NULL, NULL, NULL),
(43, NULL, NULL, NULL, 'Bernadette', 'Tradio', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, '2018-00304-TG-0', NULL, NULL, NULL),
(44, NULL, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00342-TG-0', NULL, NULL, NULL),
(45, NULL, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00342-TG-0', NULL, NULL, NULL),
(46, 'Doe-John.jpg', 1, 1, 'John', 'Doe', 'Johhny', '2021-03-19', '09562679248', 'Address', NULL, 'City', '1632', '2018-00123-TG-0', '', '', 0),
(47, NULL, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00123-TG-0', NULL, NULL, NULL),
(48, NULL, NULL, NULL, 'John', 'Doe', NULL, '2021-09-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00123-TG-0', NULL, NULL, NULL),
(50, NULL, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00123-TG-0', NULL, NULL, NULL),
(51, 'Doe-John.jpg', 1, 1, 'John', 'Doe', 'Jonny', '2021-09-23', '12345678910', 'Address', NULL, 'City', '1632', '2018-00121-TG-0', '', '', 0),
(52, NULL, NULL, NULL, 'Richard', 'Gabito', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-00000-TG-0', NULL, NULL, NULL);

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
(1, 'List of Users', 'User.index', 1, 1),
(2, 'Add User', 'User.store', 1, 0),
(3, 'Edit User', 'User.show', 1, 0),
(4, 'Delete User', 'UserDelete', 1, 0),
(5, 'List of Roles', 'Roles.index', 1, 1),
(6, 'Add Roles', 'Roles.store', 1, 0),
(7, 'Edit Roles', 'Roles.show', 1, 0),
(8, 'Delete Roles', 'RolesDelete', 1, 0),
(9, 'List of Courses', 'Course.index', 1, 1),
(10, 'Add Courses', 'Course.store', 1, 0),
(11, 'Edit Courses', 'Course.show', 1, 0),
(12, 'Delete Courses', 'CourseDelete', 1, 0),
(13, 'Genders', 'Gender.index', 1, 1),
(14, 'Add Gender', 'Gender.store', 1, 0),
(15, 'Edit Gender', 'Gender.show', 1, 0),
(16, 'Delete Gender', 'GenderDelete', 1, 0),
(17, 'Permissions', 'Permissions.index', 1, 1),
(18, 'Add Permission', 'Permissions.create', 1, 0),
(19, 'Edit Permission', 'Permissions.show', 1, 0),
(21, 'List of Materials', 'Material.index', 2, 1),
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
(47, 'Search Books', 'UserProfile.SearchBook', 5, 0),
(48, 'Reserve Books', 'Reserve.main', 5, 0),
(49, 'My Penalty', 'Penalty.My_Penalty', 5, 1),
(50, 'Materials Archives', 'Archives.Materials_List', 6, 1),
(51, 'Users Archives', 'Archives.Users_List', 6, 1),
(52, 'Room Use Archives', 'Archives.Borrowing_List', 6, 1),
(53, 'Borrowing Archives', 'Archives.Issuing_List', 6, 1),
(54, 'Daily Time Record', 'DTR.view', 1, 1);

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
(1, 'Users', 'fa-user', 1),
(2, 'Materials', 'fa-boxes', 1),
(3, 'Borrowing', 'fa-clipboard-check', 1),
(4, 'Penalty Management', 'fa-window-close', 1),
(5, 'Users Information', 'fa-user', 2),
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
(1, 1, 45, 'On'),
(1, 1, 50, 'On'),
(1, 1, 51, 'On'),
(1, 1, 52, 'On'),
(1, 1, 53, 'On'),
(1, 1, 54, 'On'),
(2, 3, 45, 'On'),
(2, 3, 46, 'On'),
(2, 3, 47, 'On'),
(2, 3, 48, 'On'),
(2, 3, 49, 'On'),
(3, 3, 45, 'On'),
(3, 3, 46, 'On'),
(3, 3, 47, 'On'),
(3, 3, 48, 'On'),
(3, 3, 49, 'On'),
(4, 3, 45, 'On'),
(4, 3, 46, 'On'),
(4, 3, 47, 'On'),
(4, 3, 48, 'On'),
(4, 3, 49, 'On'),
(5, 3, 45, 'On'),
(5, 3, 46, 'On'),
(5, 3, 47, 'On'),
(5, 3, 48, 'On'),
(5, 3, 49, 'On'),
(6, 3, 45, 'On'),
(6, 3, 46, 'On'),
(6, 3, 47, 'On'),
(6, 3, 48, 'On'),
(6, 3, 49, 'On'),
(7, 3, 45, 'On'),
(7, 3, 46, 'On'),
(7, 3, 47, 'On'),
(7, 3, 48, 'On'),
(7, 3, 49, 'On'),
(8, 3, 45, 'On'),
(8, 3, 46, 'On'),
(8, 3, 47, 'On'),
(8, 3, 48, 'On'),
(8, 3, 49, 'On'),
(9, 3, 45, 'On'),
(9, 3, 46, 'On'),
(9, 3, 47, 'On'),
(9, 3, 48, 'On'),
(9, 3, 49, 'On'),
(10, 3, 45, 'On'),
(10, 3, 46, 'On'),
(10, 3, 47, 'On'),
(10, 3, 48, 'On'),
(10, 3, 49, 'On'),
(11, 3, 45, 'On'),
(11, 3, 46, 'On'),
(11, 3, 47, 'On'),
(11, 3, 48, 'On'),
(11, 3, 49, 'On'),
(12, 3, 45, 'On'),
(12, 3, 46, 'On'),
(12, 3, 47, 'On'),
(12, 3, 48, 'On'),
(12, 3, 49, 'On'),
(44, 3, 45, 'On'),
(44, 3, 46, 'On'),
(44, 3, 47, 'On'),
(44, 3, 48, 'On'),
(44, 3, 49, 'On'),
(45, 3, 45, 'On'),
(45, 3, 46, 'On'),
(45, 3, 47, 'On'),
(45, 3, 48, 'On'),
(45, 3, 49, 'On'),
(46, 3, 45, 'On'),
(46, 3, 46, 'On'),
(46, 3, 47, 'On'),
(46, 3, 48, 'On'),
(46, 3, 49, 'On'),
(47, 3, 45, 'On'),
(47, 3, 46, 'On'),
(47, 3, 47, 'On'),
(47, 3, 48, 'On'),
(47, 3, 49, 'On'),
(49, 3, 45, 'On'),
(49, 3, 46, 'On'),
(49, 3, 47, 'On'),
(49, 3, 48, 'On'),
(49, 3, 49, 'On'),
(50, 3, 45, 'On'),
(50, 3, 46, 'On'),
(50, 3, 47, 'On'),
(50, 3, 48, 'On'),
(50, 3, 49, 'On'),
(51, 3, 45, 'On'),
(51, 3, 46, 'On'),
(51, 3, 47, 'On'),
(51, 3, 48, 'On'),
(51, 3, 49, 'On'),
(52, 3, 45, 'On'),
(52, 3, 46, 'On'),
(52, 3, 47, 'On'),
(52, 3, 48, 'On'),
(52, 3, 49, 'On');

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
-- Indexes for table `materials_copies`
--
ALTER TABLE `materials_copies`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_reservation`
--
ALTER TABLE `book_reservation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `materials_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `materials_category`
--
ALTER TABLE `materials_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materials_copies`
--
ALTER TABLE `materials_copies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials_subject`
--
ALTER TABLE `materials_subject`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timein`
--
ALTER TABLE `timein`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
