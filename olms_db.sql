-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2022 at 07:00 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `try_olms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_extension`
--

CREATE TABLE `book_extension` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrowings_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_reservation`
--

CREATE TABLE `book_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `material_copy_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `material_copy_id` bigint(20) UNSIGNED NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_returned` date NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DICT', 'Diploma in Information Communication Technology', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(2, 'BSIT', 'Bachelor of Science in Information Technology', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(3, 'BSECE', 'Bachelor of Science in Electronics Engineering', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(4, 'BSME', 'Bachelor of Science in Mechanical Engineering', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(5, 'BSA', 'Bachelor of Science in Accountancy', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(6, 'BSBA', 'Bachelor of Science in Business Administration', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(7, 'BSAM', 'Bachelor of Science in Applied Mathematics', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(8, 'BSENTREP', 'Bachelor of Science in Entrepreneurship', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(9, 'BSED', 'Bachelor in Secondary Education', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(10, 'BSOA', 'Bachelor of Science in Office Administration', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(11, 'DOMT', 'Diploma in Office Management Technology', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gender_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Male', 1, '2022-03-05 17:56:01', '2022-03-05 17:56:01', NULL),
(2, 'Female', 1, '2022-03-05 17:56:01', '2022-03-05 17:56:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `materials_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `isbn` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edition` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`materials_id`, `category_id`, `isbn`, `title`, `callno`, `author`, `publisher`, `edition`, `copyright`, `status`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ISBN 978-07-131798-6', 'Principles of General Chemistry', 'QD 31.3 S55 2013', 'Silberberg', 'McGraw Hill Company Inc.', '1st Edition', '2013', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(2, 1, 'ISBN 978-0-07-337351-5', 'The Professional Approach: Microsoft Office 2007', 'a', 'Hinkle, Graves, Juarez, Stewart, Mayhall, Carter,', 'The McGraw-Hill Companies, Inc.', '3rd Edition', '2007', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(3, 1, 'ISBN 978-0-07-352699-7', 'Financial and Managerial Accounting', 'a', 'Jan Williams, Sue Haka, Mark Bettner,Joseph Carcel', 'The McGraw-Hill Companies, Inc.', '2nd Edition', '2018', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(4, 1, 'ISBN-13: 978-1-285-07792-5', 'Programming with Microsoft : Visual Basic 2012', 'QA 76.76 B3z3374 2014', 'Diane Zak', 'CENGAGE Learning Asia', '6th Edition', NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(5, 1, 'ISBN-13: 978-0-13-512236-5', 'Foundation of Finance', 'HG 4026.F67 K46 2011', 'Keown , Martin, Petty', 'Pearson Education', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(6, 1, 'ISBN-13: 978-0-273-77985-5', 'Cost Accounting : A Managerial Emphasis', 'Hf 5586.C8 H59 2012', 'Charles T. Horngren, Srikant M. Datar, Madhav V. R', 'Pearson Education Limited Inc.', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(7, 1, 'ISBN 0-07-123016-5', 'Financial and Managerial Accounting', 'HF5635.M492', 'Williams, Haka, Bettner, Meigs', 'The McGraw-Hill Companies, Inc.', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(8, 1, 'ISBN 978-0-07-352284-5', 'Mastering ArcGIS', 'G70.212.P74', 'Maribeth Price', 'The McGraw-Hill Companies, Inc.', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(9, 1, 'ISBN-13: 978-0-321-52678-6', 'Starting out with C++ Early Objects', 'QA 76.73 C153G123 2007', 'Tony Gaddis, Judy Walters, Godfrey Muganda', 'Pearson Education, Inc', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(10, 1, 'ISBN-13: 978-1-4018-4251-2', 'Visualization, Modeling, and Graphics for Engineer', 'TA 174 L721', 'Lieu/Sorby', 'CENGAGE Learning Asia', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(11, 1, 'ISBN-13: 978-1-4180-4102-1', 'Introduction to Digital Electronics', 'TK 7868.D5 R353', 'Ken Reid, Robert Dueck', 'Thomson Delmar Learning', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(12, 1, 'ISBN-13: 978-0-07-830724-9', 'Workbook for Technology of Machine Tools', 'REF 621902 K864T', 'Steve F. Krar, Arthur R. Gill, Peter Smid', 'McGraw Hill Company Inc.', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(13, 1, 'ISBN-13: 978-1-4239-0609-4', 'Computer Concepts: Introductory', 'QA 76 P269', 'June Jamrich Parsons, Dan Oja', 'Thomson Course Technology', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(14, 1, 'ISBN-13: 978-1-4283-1936-3', 'Refrigeration and Air Conditioning Technology', 'TP 492 R281', NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(15, 1, 'ISBN-13: 978-1-4180-3758-1', 'Automotive Service', 'TL 152 G472', 'Tim Gilles', 'DELMAR CENGAGE Learning', NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(16, 1, 'ISBN 0-13-6134247-2', 'JAVA How to Program', 'QA 76.73 J38D325', NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(17, 1, 'ISBN 0-619-21724-3', 'JAVA Learning to Program with Robots', 'QA 76.73 J38B395', NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(18, 1, 'ISBN-13: 978-1-4239-0196-9', 'Programming Logic and Design: Comprehensive', 'QA 76,73 F245', NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(19, 1, 'ISBN-13: 978-0-619-26720-9', 'Microsoft Visual Basic 2005: BASICS', 'QA 76.73 B3M626', NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(20, 1, 'ISBN 0-07-253855-4', 'Wastewater Engineering: Treatment and Reuse', NULL, NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(21, 1, 'ISBN 978-0-07-304860-4', 'Student Solutions Manual to Accompany Chemistry:  The Molecular Nature of Matter and Change', 'QD33.2 S55', 'Patricia Amateis, Martin S. Silberberg', 'The McGraw-Hill Companies, Inc.', '5th Edition', '2006', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(22, 1, 'ISBN 1-4188-3706-7', 'Problem-Solving Cases in Microsoft Access and Excel', 'HF 5548 M525B798', 'Joseph A. Brady, Ellen F. Monk', 'Thomson Course Technology', '4th Edition', '2007', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(23, 1, 'ISBN-13a978-1-4239-0117-4', 'Fundamentals of Information Systems', 'T 58.6 s782', 'Ralph Stair, George Reynolds', 'Thomson Course Technology', '4th Edition', '2008', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(24, 1, 'ISBN-13: 978-0-619-21760-0', 'CompTIA A+ Guide to Software: Managing, Maintaining, Troubleshooting', 'QA 76.3 A567', 'Jean Andrews', 'Thomson Course Technology', '4th Edition', '2007', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(25, 1, 'ISBN-13: 978-0-9778582-3-1', 'Thomson Course Technology', 'ISBN-13: 978-0-9778582-3-1', 'M. Tim Jones', 'Infinity Science Press', '1st Edition', '2008', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(26, 1, 'ISBN-13: 978-0-9778582-3-1', 'Infinity Science Press', 'Q 336 J78 2008', 'M. Tim Jones', 'Infinity Science Press', '1st Edition', '2008', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(27, 1, 'ISBN-13: 978-0-9778582-3-1', 'Fundamentals of Microcontrollers and Applications in Embedded Systems(with the PIC 18 Microcontroller Family)', 'TJ 223 G111', 'Ramesh S. Gaonkar', 'Thomson Delmar Learning', NULL, '2007', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(28, 1, 'ISBN-13: 978-1-4180-5001-6', 'Managing Interactive Media Projects', 'QA 76.76 T59F897', 'Tim Frick', 'Thomson Delmar Learning', NULL, '2008', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(29, 1, 'ISBN-13: 978-0-13-606072-7', 'An Introduction to PROGRAMMING Using VISUAL BASIC 2008', 'QA 76.73 B3S358', 'David I. Schneider', 'Pearson Prentice Hall', '7th Edition', '2009', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(30, 1, 'ISBN 978-0-07-353507-4', 'The Art of Watching Films', 'PN1995 B525', 'Joseph M. Boggs, Dennis W. Petrie', 'McGraw Hill Company Inc.', '7th Edition', '2008', 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(31, 1, 'ISBN 0-13-229630-6', 'Fundamentals of Applied Electromagnetics', 'QC 760 U36', NULL, NULL, NULL, NULL, 1, 1, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials_category`
--

CREATE TABLE `materials_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_structure` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials_category`
--

INSERT INTO `materials_category` (`id`, `cat_structure`, `cat_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PUPT Circ', 'Circulation', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(2, 'PUPT Eb', 'Ebook', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(3, 'PUPT Feas', 'Feasibility', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(4, 'PUPT Fili', 'Filipiñana', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(5, 'PUPT TH/D', 'Theses and Dissertations', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(6, 'PUPT Ref', 'Reference', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(7, 'PUPT Don', 'Donation', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(8, 'PUPT Fic', 'Fiction', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials_copies`
--

CREATE TABLE `materials_copies` (
  `material_copy_id` bigint(20) UNSIGNED NOT NULL,
  `materials_id` bigint(20) UNSIGNED NOT NULL,
  `borrows_id` bigint(20) UNSIGNED DEFAULT NULL,
  `accession_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recieved` date NOT NULL,
  `is_available` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials_subject`
--

CREATE TABLE `materials_subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_color` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#1976D2',
  `text_color` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFFFFF',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials_subject`
--

INSERT INTO `materials_subject` (`id`, `subject_name`, `background_color`, `text_color`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Philosophy', '#adff2f', '#000000', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(2, 'Science', '#00FF00', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(3, 'Mathematics', '#FF0000', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(4, 'Chemistry', '#90EE90', '#000000', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(5, 'Business', '#008080', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(6, 'Physical, Educational, and Health', '#b9711e', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(7, 'History', '#FFFF00', '#000000', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(8, 'Social Studies', '#FFA500', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(9, 'Algebra', '#ffcccb', '#000000', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(10, 'Programming', '#00FFFF', '#000000', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(11, 'IT', '#0000FF', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL),
(12, 'Engineering', '#A020F0', '#ffffff', 1, '2022-03-05 17:56:00', '2022-03-05 17:56:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials_subject_link`
--

CREATE TABLE `materials_subject_link` (
  `mat_id` bigint(20) UNSIGNED NOT NULL,
  `sub_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(21, 4),
(22, 11),
(23, 11),
(24, 11),
(25, 11),
(26, 11),
(27, 11),
(28, 11),
(29, 11),
(30, 11),
(31, 5);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_02_01_000000_create_courses_table', 1),
(2, '2022_02_01_000000_create_gender_table', 1),
(3, '2022_02_01_000000_create_user_links_parent_table', 1),
(4, '2022_02_01_000000_create_user_role_table', 1),
(5, '2022_02_01_000001_create_user_links_table', 1),
(6, '2022_02_01_000002_create_users_table', 1),
(7, '2022_02_01_000003_create_user_details_table', 1),
(8, '2022_02_01_000003_create_user_permission_table', 1),
(9, '2022_02_01_000004_create_materials_category_table', 1),
(10, '2022_02_01_000004_create_materials_subject_table', 1),
(11, '2022_02_01_000005_create_materials_table', 1),
(12, '2022_02_01_000006_create_materials_copies_table', 1),
(13, '2022_02_01_000006_create_materials_subject_link_table', 1),
(14, '2022_02_01_000007_create_borrowings_table', 1),
(15, '2022_02_01_000008_add_borrows_column_to_material_copies', 1),
(16, '2022_02_01_000008_create_book_extension_table', 1),
(17, '2022_02_01_000008_create_book_reservation_table', 1),
(18, '2022_02_01_000009_create_penalty_settings_table', 1),
(19, '2022_02_01_000010_create_penalty_table', 1),
(20, '2022_02_01_000011_create_timein_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `borrowings_id` bigint(20) UNSIGNED NOT NULL,
  `penalty_days` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penalty_settings`
--

CREATE TABLE `penalty_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penalty_days` int(11) NOT NULL,
  `penalty_fee` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `timein` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `limit`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'puptlibrary2021', 'admin@email.com', '$2y$10$u8hfdUBUXiYNoQnDxr8Zv.B/kR1bzs8aEJe6IjucEIMfVvNgTzwhG', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(2, 3, '2018-00525-TG-0', 'ecbangga@gmail.com', '$2y$10$Jyd0Ywb4r7nbGcU.I9aqBeVgzyiL5.9ohoB7HAfBSBnmORxad4nty', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(3, 3, '2018-00086-TG-0', 'eugeneraynera110820@gmail.com', '$2y$10$MoCcvWpK4BCw7wTV0j6EA.K4XU7GJSsWWz6mRYHHlNmtxuf9VVU8O', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(4, 3, '2019-00114-TG-0', 'etinjannielyn@gmail.com', '$2y$10$nT46mJdwSiiry9B7SfYni.FlRgfn86SmmIAE54ZDIzZuGjXd8lRuK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(5, 3, '2019-00126-TG-0', 'gierza29@gmail.com', '$2y$10$8le9Ydr.o4vYC0R9fpkkn.yAKwYlcm/t4XZPFLL3HpVVAhufFtjpK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(6, 3, '2018-00399-TG-0', 'kzcortes27@gmail.com', '$2y$10$Lmc6.Ya6YcdPVrURAb/flujhEvuSWDUXM1QdPO1kmS1uBH4oXbLbK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(7, 3, 'JDionisio', 'galidojoymee@gmail.com', '$2y$10$MxcO0bzBT/Ba.p/xA.4oqewiO.PbgE5uXYWAXQxGnwrGtPPfu8epm', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(8, 3, '2018-00366-TG-0', '2018-00366-TG-0', '$2y$10$GhNFR3FNhkzBoIMMAnQnjO/3NCKgFJJS9CKbl2iGPK4iTxlXGUcny', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(9, 3, '2018-00231-TG-0', 'paulinellagas@gmail.com', '$2y$10$TTn3L3mf8I6TjNT4ZBnl/OdygoMHRea6N16FpxZLcqftFQqtRQWdK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(10, 3, '2019-00422-TG-0', 'virtusioaira7@gmail.com', '$2y$10$Exn66WV8mDqLqVkHyTct1OQqSjJwRJDRuVSgDh/m2uhfP7gegVYzW', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(11, 3, '2018-00220-TG-0', 'quieljeremiahcariaso04@gmail.com', '$2y$10$lZxvBfidPmuNQoGi9cr2deeVIluMuL6N4YxL5Xa9GMcG.68DIb1Ha', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(12, 3, '2018-00232-TG-0', 'mhar.apura@gmail.com', '$2y$10$s/C1x5cBBDLam8bCDbVpj.9ubTu5pWAK2U19IhEgx1Ewwh.3BFLUy', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(13, 3, '2018-00341-TG-0', 'j.balatong1999@gmail.com', '$2y$10$CNrojgEXeT/oEzhSzTRmseXl4pwlCD2TjD9BTsnx7MppgWyS6Es2W', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(14, 3, '2018-00484-TG-0', 'llynttburton08@gmail.com', '$2y$10$wUPxgZDcCrNxDfCscycgJOyQs.S5zle7T3DK2cTxak2DN19MOwxby', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(15, 3, '2018-00343-TG-0', 'cabanelacharmie24@gmail.com', '$2y$10$JquJUaE8Nm9FMeZU8ni19elLgSU8Ge.m14c2yAqFIcrzGBmlBUkhe', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(16, 3, '2018-00256-TG-0', 'joshuacapalaran27@gmail.com', '$2y$10$N759nQ/ImdyioDYytZs/G.BT8timRTcKV.0RiD0ZCxJWj0KVsf4Oq', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(17, 3, '2018-00361-TG-0', 'johnrusseldacanay@gmail.com', '$2y$10$RVlSdRg2EC/g6ALCvQMU.O0puw4xTb1mPKtOo2yVZwJc9GGo/os0q', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(18, 3, '2018-00368-TG-0', 'rhingmakz21@gmail.com', '$2y$10$1u/M992xIaITANjv8XhOOeztjKEsXhBdSBRn1bRhEqN/J7DcBt0/C', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(19, 3, '2018-00353-TG-0', 'erjohn13@gmail.com', '$2y$10$0j03kbJG188hkdeg258CtuEaBSiv3jGOryWoYUs0MHaqWdK7ePBBK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(20, 3, '2018-00379-TG-0', 'froilanfernandez08@gmail.com', '$2y$10$.i50BJ8pcapXQ8rUg.IptuA4Z6Lxc0fFMN8ANa5XWoM4G59tCRr42', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(21, 3, '2018-00322-TG-0', 'gabitoraymond358@gmail.com', '$2y$10$s44Oaa5zu5HksnOd3ICmIud0f8pIMZXgcRmnhdZ6nFnMhwyb3GjMa', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(22, 3, '2018-00293-TG-0', 'jerome.jalandoon@gmail.com', '$2y$10$NP2gJhVa0r.x821s6grugugigPSKxYlzt6lsaRtT3gO6BIKWRHlZK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(23, 3, '2018-00315-TG-0', 'choilapitan47@gmail.com', '$2y$10$75r5C/TVrH1ImtX9aNUQJucRE0p28bQ893AlOE5gKgk01dw8R3oAm', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(24, 3, '2018-00487-TG-0', 'khimlaude@gmail.com', '$2y$10$UjLO/DyN2d.ncY1zeRes2.eL/OuNzBBDEmYpzEWmpqojQ8yEaJjsC', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(25, 3, '2018-00523-TG-0', 'lazarochan03@gmail.com', '$2y$10$wDQAWZ.hczIfZACbkzIqpOqnqfS2kdPGH2t.iIspuUTuxTtvWDKQi', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(26, 3, '2018-00299-TG-0', 'davidlimba19@gmail.com', '$2y$10$D4THCWfK6gSK0kmgXE/oQ.ONRI0Vya6dKA9IlamYk9RFhKBi6rZL6', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(27, 3, '2018-00376-TG-0', 'linijin17@gmail.com', '$2y$10$AyLaWc/Fgut7KhSGmhRCUO.vHWd/jsFmVJqwFI0ga3CuMjfGfrm7q', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(28, 3, '2018-00349-TG-0', 'zklumabi@gmail.com', '$2y$10$8V7cfuPx2Zy7/uKYL9.Af.b5BflRFfJa1mbxkDHuFPBzD9I4FhLvK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(29, 3, '2018-00330-TG-0', 'nerissamaglente2@gmail.com', '$2y$10$SBWyb0IUjfQHj5kOAp1uc.5vjBCnVWEgMKsqK1g18iVeYnx8HKaHy', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(30, 3, '2018-00328-TG-0', 'jamreimanalo@gmail.com', '$2y$10$UJ.GC4lQuk1vaIxF7Ds3duYsWdGfqqGcK67PtyPBxm10EvZ1ZJjki', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(31, 3, '2018-00372-TG-0', 'marcusmanuel.pupt@gmail.com', '$2y$10$izVxdqS.kBZOPWs7lVDgDezP5ah8PvNyMKdnAKnbHFbSAFFvhIE/C', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(32, 3, '2018-00305-TG-0', 'mnmerielmanuel@gmail.com', '$2y$10$aFVljF7fimKI/yJ1Zjz.0elj6EB6hqLJXx1RQvjSaQtXfk4oky.M2', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(33, 3, '2018-00513-TG-0', 'jcnavaja28@gmail.com', '$2y$10$TpJJ4br3RObBPj/hHFonRuKAY6OM0aT3JW.Do6KCSm6p9o.yVC/.q', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(34, 3, '2018-00345-TG-0', 'jillianpollescas@gmail.com', '$2y$10$PxQCs4m366eBIFKWlNY5w.D3u.e8yfkWlxGhOhYSfb6Wwq6BRcVtq', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(35, 3, '2018-00354-TG-0', 'grasyamallen@gmail.com', '$2y$10$2/OpQN8D9mWlnzZnt1zXl.z4hxZCKrgxsqtC8jDmcOtGx6APRpo2O', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(36, 3, '2018-00260-TG-0', 'rakimjasmine@gmail.com', '$2y$10$xMxdok7bHRjz6rt64lfyGevTyi7GlZN1aPU2aTcSo/jpA8WxMVWFu', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(37, 3, '2018-00355-TG-0', 'shailynjoycesaan@gmail.com', '$2y$10$FLHxnlK/IYzHsQAyuXV7K.XrKom4lPx8vujXGIfwvynEPsNqH2W2u', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(38, 3, '2018-00338-TG-0', 'jamiesamar18@gmail.com', '$2y$10$TiWD8tRhvQhCuTxyE/FZFOOK5SmoKzAT9QWTw5hxQMFrY2fodsm4i', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(39, 3, '2018-00263-TG-0', 'serojealdrin@gmail.com', '$2y$10$j2k9VPUyzkeaLEFlXNnYquzDoAIpobM1f83CEsckEtkKF91YxzK4.', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(40, 3, '2018-00313-TG-0', 'tmbrccl@gmail.com', '$2y$10$eXNLbAuY3F8tLq64B9.wR.4DGZ4xy5MqfMVppco0bercSXN/71vA2', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(41, 3, '2018-00370-TG-0', 'csollanojr@gmail.com', '$2y$10$KHH.7dDLeT0ms0v2IeSBI.pYVWCYcj8XxzcxefVjuIWGVi9Sqv0Sq', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(42, 3, '2018-00304-TG-0', 'bernatrads4@gmail.com', '$2y$10$MIELDlqjh925nh9ytvZeMeeb.IJEsTKbxsaIokQQkbPfhc.QsVzSi', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(43, 3, '2018-00342-TG-0', 'johndoe@gmail.com', '$2y$10$bcRzNe6a9CbD6oFoIebxQeTlJj8mwwr.PF008XME3doZZN0EcBdKa', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(44, 3, '2017-00342-TG-0', 'johndoe@gmail.com', '$2y$10$3irz57rMEbwJnN4lWBk39.LUf24T6pOsM/I0DrAaqPd8owVg9CgRC', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(45, 3, '2017-00111-TG-0', 'johndoe@gmail.com', '$2y$10$ZkvXXsCSMvJMsAdGOMQcbOISTkBrvi4z2W5Baxwhwu6ZcXJIfYaP6', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(46, 3, '2018-00123-TG-0', 'johndoe@gmail.com', '$2y$10$h0PJvlA4ra5MZflIC6vKx.5RxHMaOP5/kCDY7d8uBMsuR.iH5qNi2', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(47, 3, '2017-00112-TG-0', 'johndoe@gmail.com', '$2y$10$OpLz6Mirh6CBkXolPS0FmuVcEr8WzR8WgOg8dT3sGEbyNUxdXlB4a', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(48, 3, '2017-00113-TG-0', 'johndoe@gmail.com', '$2y$10$ICKAv/Btg22vSj2QI7eqKurihM.sEeagpw2B5DflEbGBdE49pBBv2', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(49, 3, '2017-00114-TG-0', 'johndoe@gmail.com', '$2y$10$N.Tmqow22UxisnSI72y1k.MDMCVEuCKo4ZTs4xlfkudrcJPtM5Mmy', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(50, 3, '2017-00115-TG-0', 'johndoe@gmail.com', '$2y$10$tvOBT4xdzNE5Ab3V5R/e0.idOm2WWKiPDfp2GZ6wrB.ebZ8BFbUGK', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(51, 3, '2017-00116-TG-0', 'johndoe@gmail.com', '$2y$10$FakUuk5CNYFWYfinFTiR8.z/8NPpyRXqJuoZSBLfy7.bvI4kWYOxq', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL),
(52, 3, '2020-00000-TG-0', 'richard.gabito@gmail.com', '$2y$10$b/eWCTtl2s87zExk0YZR2OQEUESFP.1FiHLIE9rBfUGtcBXKpgeqW', NULL, 1, NULL, '2022-03-05 17:56:02', '2022-03-05 17:56:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stud_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `course_id`, `gender_id`, `image_url`, `firstname`, `lastname`, `middlename`, `birthday`, `contact_no`, `address`, `barangay`, `city`, `zip_code`, `stud_number`, `faculty_code`, `employee_number`, `employee_status`) VALUES
(2, 1, NULL, 'Bangga-Christian Elvin.jpg', 'Christian Elvin', 'Bangga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00525-TG-0', NULL, NULL, NULL),
(3, 1, NULL, NULL, 'Eugene', 'Raynera', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00086-TG-0', NULL, NULL, NULL),
(4, 1, NULL, NULL, 'Jannielyn', 'Etin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00114-TG-0', NULL, NULL, NULL),
(5, 1, NULL, NULL, 'Lougen', 'Gierza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00126-TG-0', NULL, NULL, NULL),
(6, 1, NULL, NULL, 'Ken Zedric', 'Cortes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00342-TG-0', NULL, NULL, NULL),
(7, 1, NULL, NULL, 'Joymee', 'Dionisio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JDionisio', NULL, NULL, NULL),
(8, 1, NULL, NULL, 'Lessa Anne', 'Pascubillo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00366-TG-0', NULL, NULL, NULL),
(9, 1, NULL, 'Llagas-Pauline Jane.png', 'Pauline Jane', 'Llagas', 'Santos', NULL, NULL, NULL, NULL, NULL, NULL, '2018-00218-TG-0', NULL, NULL, NULL),
(10, 1, NULL, 'Virtusio-Aira Dynielle.jpg', 'Aira Dynielle', 'Virtusio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00422-TG-0', NULL, NULL, NULL),
(11, 1, NULL, NULL, 'Aira Dynielle', 'Virtusio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-00422-TG-0', NULL, NULL, NULL),
(12, 1, NULL, NULL, 'Quiel Jeremiah', 'Cariaso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00220-TG-0', NULL, NULL, NULL),
(13, 1, NULL, NULL, 'Ed Mhar', 'Apura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00231-TG-0', NULL, NULL, NULL),
(14, 1, NULL, NULL, 'Jayson', 'Balatong', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00341-TG-0', NULL, NULL, NULL),
(15, 1, NULL, NULL, 'Lailynette', 'Burton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00484-TG-0', NULL, NULL, NULL),
(16, 1, NULL, NULL, 'Charmie', 'Cabanela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00343-TG-0', NULL, NULL, NULL),
(17, 1, NULL, NULL, 'Joshua', 'Capalaran', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00256-TG-0', NULL, NULL, NULL),
(18, 1, NULL, NULL, 'John Russel', 'Dacanay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00361-TG-0', NULL, NULL, NULL),
(19, 1, NULL, NULL, 'Edmon', 'Dela Cruz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00368-TG-0', NULL, NULL, NULL),
(20, 1, NULL, NULL, 'Erjohn', 'Espuerta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00353-TG-0', NULL, NULL, NULL),
(21, 1, NULL, NULL, 'Froilan', 'Fernandez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00379-TG-0', NULL, NULL, NULL),
(22, 1, NULL, NULL, 'Raymond', 'Gabito', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00322-TG-0', NULL, NULL, NULL),
(23, 1, NULL, NULL, 'Jerome', 'Jalandoon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00293-TG-0', NULL, NULL, NULL),
(24, 1, NULL, NULL, 'Crisologo', 'Lapitan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00315-TG-0', NULL, NULL, NULL),
(25, 1, NULL, NULL, 'Van', 'Laude', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00487-TG-0', NULL, NULL, NULL),
(26, 1, NULL, NULL, 'Christian', 'Lazaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00523-TG-0', NULL, NULL, NULL),
(27, 1, NULL, NULL, 'David', 'Limba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00299-TG-0', NULL, NULL, NULL),
(28, 1, NULL, NULL, 'Lenard', 'Llacer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00376-TG-0', NULL, NULL, NULL),
(29, 1, NULL, NULL, 'Zairanih', 'Lumabi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00349-TG-0', NULL, NULL, NULL),
(30, 1, NULL, NULL, 'Maglente', 'Nerissa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00330-TG-0', NULL, NULL, NULL),
(31, 1, NULL, NULL, 'Jamrei', 'Manalo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00328-TG-0', NULL, NULL, NULL),
(32, 1, NULL, NULL, 'Marcus', 'Manuel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00372-TG-0', NULL, NULL, NULL),
(33, 1, NULL, NULL, 'Meriel', 'Manuel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00305-TG-0', NULL, NULL, NULL),
(34, 1, NULL, NULL, 'Jonh Carlo', 'Navaja', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00513-TG-0', NULL, NULL, NULL),
(35, 1, NULL, NULL, 'Jillian', 'Pollescas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00345-TG-0', NULL, NULL, NULL),
(36, 1, NULL, NULL, 'Mary Grace', 'Ragpala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00354-TG-0', NULL, NULL, NULL),
(37, 1, NULL, NULL, 'Jasmine', 'Rakim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00260-TG-0', NULL, NULL, NULL),
(38, 1, NULL, NULL, 'Shailyn', 'Sa - an', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00355-TG-0', NULL, NULL, NULL),
(39, 1, NULL, NULL, 'Jamie', 'Samar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00338-TG-0', NULL, NULL, NULL),
(40, 1, NULL, NULL, 'Aldrin', 'Seroje', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00263-TG-0', NULL, NULL, NULL),
(41, 1, NULL, NULL, 'John Timothy', 'Sescar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00313-TG-0', NULL, NULL, NULL),
(42, 1, NULL, NULL, 'Carlito', 'Sollano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00370-TG-0', NULL, NULL, NULL),
(43, 1, NULL, NULL, 'Bernadette', 'Tradio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-00304-TG-0', NULL, NULL, NULL),
(44, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00342-TG-0', NULL, NULL, NULL),
(45, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00111-TG-0', NULL, NULL, NULL),
(46, NULL, 1, NULL, 'John', 'Doe', 'Johhny', NULL, '09562679248', NULL, NULL, 'City', '1632', '2018-00123-TG-0', NULL, NULL, NULL),
(47, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00112-TG-0', NULL, NULL, NULL),
(48, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00113-TG-0', NULL, NULL, NULL),
(49, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00114-TG-0', NULL, NULL, NULL),
(50, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00115-TG-0', NULL, NULL, NULL),
(51, 1, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-00116-TG-0', NULL, NULL, NULL),
(52, 1, NULL, NULL, 'Richard', 'Gabito', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-00000-TG-0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE `user_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_link_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_links`
--

INSERT INTO `user_links` (`id`, `parent_link_id`, `link_name`, `slug_name`, `display_status`) VALUES
(1, 1, 'List of Users', 'User.index', 1),
(2, 1, 'Add User', 'User.store', 0),
(3, 1, 'Edit User', 'User.show', 0),
(4, 1, 'Delete User', 'UserDelete', 0),
(5, 1, 'List of Roles', 'Roles.index', 1),
(6, 1, 'Add Roles', 'Roles.store', 0),
(7, 1, 'Edit Roles', 'Roles.show', 0),
(8, 1, 'Delete Roles', 'RolesDelete', 0),
(9, 1, 'List of Courses', 'Course.index', 1),
(10, 1, 'Add Courses', 'Course.store', 0),
(11, 1, 'Edit Courses', 'Course.show', 0),
(12, 1, 'Delete Courses', 'CourseDelete', 0),
(13, 1, 'Genders', 'Gender.index', 1),
(14, 1, 'Add Gender', 'Gender.store', 0),
(15, 1, 'Edit Gender', 'Gender.show', 0),
(16, 1, 'Delete Gender', 'GenderDelete', 0),
(17, 1, 'Permissions', 'Permissions.index', 1),
(18, 1, 'Add Permission', 'Permissions.create', 0),
(19, 1, 'Edit Permission', 'Permissions.show', 0),
(21, 2, 'List of Materials', 'Material.index', 1),
(22, 2, 'Add Materials', 'Material.store', 0),
(23, 2, 'Edit Materials', 'Material.show', 0),
(24, 2, 'Delete Materials', 'MaterialsDelete', 0),
(25, 2, 'Materials Category', 'MaterialsCategory.index', 1),
(26, 2, 'Add Materials Category', 'MaterialsCategory.store', 0),
(27, 2, 'Edit Materials Category', 'MaterialsCategory.show', 0),
(28, 2, 'Delete Materials Category', 'MaterialsCategoryDelete', 0),
(29, 2, 'Materials Subject', 'MaterialsSubject.index', 1),
(30, 2, 'Add Materials Subject', 'MaterialsSubject.store', 0),
(31, 2, 'Edit Materials Subject', 'MaterialsSubject.show', 0),
(32, 2, 'Delete Materials Subject', 'MaterialsSubjectDelete', 0),
(33, 3, 'Borrowed Books', 'Issuing.index', 1),
(34, 3, 'Add Issuing Of Books', 'Issuing.store', 0),
(35, 3, 'Edit Issuing Of Books', 'Issuing.show', 0),
(36, 3, 'Return Issued Books', 'IssuingDelete', 0),
(37, 3, 'Room Use Books', 'Borrowing.index', 1),
(38, 3, 'Add Borrowing Of Books', 'Borrowing.store', 0),
(39, 3, 'Edit Borrowing Of Books', 'Borrowing.show', 0),
(40, 3, 'Returned Borrowed Books', 'BorrowingDelete', 0),
(41, 4, 'Penalty Settings', 'ManagePenalty.index', 1),
(42, 4, 'Edit Penalty Settings', 'ManagePenalty.store', 0),
(43, 4, 'Penalty List', 'Penalty.index', 1),
(44, 4, 'Print Penalty', 'Penalty.PDF', 0),
(45, 5, 'My Profile', 'UserProfile.View', 1),
(46, 5, 'Update My Profile', 'UserProfile.UpdateView', 1),
(47, 5, 'Search Books', 'UserProfile.SearchBook', 0),
(48, 5, 'Reserve Books', 'Reserve.main', 0),
(49, 5, 'My Penalty', 'Penalty.My_Penalty', 1),
(50, 6, 'Materials Archives', 'Archives.Materials_List', 1),
(51, 6, 'Users Archives', 'Archives.Users_List', 1),
(52, 6, 'Room Use Archives', 'Archives.Borrowing_List', 1),
(53, 6, 'Borrowing Archives', 'Archives.Issuing_List', 1),
(54, 1, 'Daily Time Record', 'DTR.view', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_links_parent`
--

CREATE TABLE `user_links_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_link_parent_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 46, 'On'),
(1, 1, 47, 'On'),
(1, 1, 48, 'On'),
(1, 1, 49, 'On'),
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
(13, 3, 45, 'On'),
(13, 3, 46, 'On'),
(13, 3, 47, 'On'),
(13, 3, 48, 'On'),
(13, 3, 49, 'On'),
(14, 3, 45, 'On'),
(14, 3, 46, 'On'),
(14, 3, 47, 'On'),
(14, 3, 48, 'On'),
(14, 3, 49, 'On'),
(15, 3, 45, 'On'),
(15, 3, 46, 'On'),
(15, 3, 47, 'On'),
(15, 3, 48, 'On'),
(15, 3, 49, 'On'),
(16, 3, 45, 'On'),
(16, 3, 46, 'On'),
(16, 3, 47, 'On'),
(16, 3, 48, 'On'),
(16, 3, 49, 'On'),
(17, 3, 45, 'On'),
(17, 3, 46, 'On'),
(17, 3, 47, 'On'),
(17, 3, 48, 'On'),
(17, 3, 49, 'On'),
(18, 3, 45, 'On'),
(18, 3, 46, 'On'),
(18, 3, 47, 'On'),
(18, 3, 48, 'On'),
(18, 3, 49, 'On'),
(19, 3, 45, 'On'),
(19, 3, 46, 'On'),
(19, 3, 47, 'On'),
(19, 3, 48, 'On'),
(19, 3, 49, 'On'),
(20, 3, 45, 'On'),
(20, 3, 46, 'On'),
(20, 3, 47, 'On'),
(20, 3, 48, 'On'),
(20, 3, 49, 'On'),
(21, 3, 45, 'On'),
(21, 3, 46, 'On'),
(21, 3, 47, 'On'),
(21, 3, 48, 'On'),
(21, 3, 49, 'On'),
(22, 3, 45, 'On'),
(22, 3, 46, 'On'),
(22, 3, 47, 'On'),
(22, 3, 48, 'On'),
(22, 3, 49, 'On'),
(23, 3, 45, 'On'),
(23, 3, 46, 'On'),
(23, 3, 47, 'On'),
(23, 3, 48, 'On'),
(23, 3, 49, 'On'),
(24, 3, 45, 'On'),
(24, 3, 46, 'On'),
(24, 3, 47, 'On'),
(24, 3, 48, 'On'),
(24, 3, 49, 'On'),
(25, 3, 45, 'On'),
(25, 3, 46, 'On'),
(25, 3, 47, 'On'),
(25, 3, 48, 'On'),
(25, 3, 49, 'On'),
(26, 3, 45, 'On'),
(26, 3, 46, 'On'),
(26, 3, 47, 'On'),
(26, 3, 48, 'On'),
(26, 3, 49, 'On'),
(27, 3, 45, 'On'),
(27, 3, 46, 'On'),
(27, 3, 47, 'On'),
(27, 3, 48, 'On'),
(27, 3, 49, 'On'),
(28, 3, 45, 'On'),
(28, 3, 46, 'On'),
(28, 3, 47, 'On'),
(28, 3, 48, 'On'),
(28, 3, 49, 'On'),
(29, 3, 45, 'On'),
(29, 3, 46, 'On'),
(29, 3, 47, 'On'),
(29, 3, 48, 'On'),
(29, 3, 49, 'On'),
(30, 3, 45, 'On'),
(30, 3, 46, 'On'),
(30, 3, 47, 'On'),
(30, 3, 48, 'On'),
(30, 3, 49, 'On'),
(31, 3, 45, 'On'),
(31, 3, 46, 'On'),
(31, 3, 47, 'On'),
(31, 3, 48, 'On'),
(31, 3, 49, 'On'),
(32, 3, 45, 'On'),
(32, 3, 46, 'On'),
(32, 3, 47, 'On'),
(32, 3, 48, 'On'),
(32, 3, 49, 'On'),
(33, 3, 45, 'On'),
(33, 3, 46, 'On'),
(33, 3, 47, 'On'),
(33, 3, 48, 'On'),
(33, 3, 49, 'On'),
(34, 3, 45, 'On'),
(34, 3, 46, 'On'),
(34, 3, 47, 'On'),
(34, 3, 48, 'On'),
(34, 3, 49, 'On'),
(35, 3, 45, 'On'),
(35, 3, 46, 'On'),
(35, 3, 47, 'On'),
(35, 3, 48, 'On'),
(35, 3, 49, 'On'),
(36, 3, 45, 'On'),
(36, 3, 46, 'On'),
(36, 3, 47, 'On'),
(36, 3, 48, 'On'),
(36, 3, 49, 'On'),
(37, 3, 45, 'On'),
(37, 3, 46, 'On'),
(37, 3, 47, 'On'),
(37, 3, 48, 'On'),
(37, 3, 49, 'On'),
(38, 3, 45, 'On'),
(38, 3, 46, 'On'),
(38, 3, 47, 'On'),
(38, 3, 48, 'On'),
(38, 3, 49, 'On'),
(39, 3, 45, 'On'),
(39, 3, 46, 'On'),
(39, 3, 47, 'On'),
(39, 3, 48, 'On'),
(39, 3, 49, 'On'),
(40, 3, 45, 'On'),
(40, 3, 46, 'On'),
(40, 3, 47, 'On'),
(40, 3, 48, 'On'),
(40, 3, 49, 'On'),
(41, 3, 45, 'On'),
(41, 3, 46, 'On'),
(41, 3, 47, 'On'),
(41, 3, 48, 'On'),
(41, 3, 49, 'On'),
(42, 3, 45, 'On'),
(42, 3, 46, 'On'),
(42, 3, 47, 'On'),
(42, 3, 48, 'On'),
(42, 3, 49, 'On'),
(43, 3, 45, 'On'),
(43, 3, 46, 'On'),
(43, 3, 47, 'On'),
(43, 3, 48, 'On'),
(43, 3, 49, 'On'),
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
(46, 3, 49, 'On');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_landing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`, `role_description`, `role_landing`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL, 1, '2022-03-05 17:56:01', '2022-03-05 17:56:01'),
(2, 'Teacher', NULL, NULL, 1, '2022-03-05 17:56:01', '2022-03-05 17:56:01'),
(3, 'Student', NULL, NULL, 1, '2022-03-05 17:56:01', '2022-03-05 17:56:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_extension`
--
ALTER TABLE `book_extension`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_extension_borrowings_id_foreign` (`borrowings_id`),
  ADD KEY `book_extension_users_id_foreign` (`users_id`);

--
-- Indexes for table `book_reservation`
--
ALTER TABLE `book_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_reservation_material_copy_id_foreign` (`material_copy_id`),
  ADD KEY `book_reservation_users_id_foreign` (`users_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowings_users_id_foreign` (`users_id`),
  ADD KEY `borrowings_material_copy_id_foreign` (`material_copy_id`);

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
  ADD PRIMARY KEY (`materials_id`),
  ADD KEY `materials_category_id_foreign` (`category_id`);

--
-- Indexes for table `materials_category`
--
ALTER TABLE `materials_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials_copies`
--
ALTER TABLE `materials_copies`
  ADD PRIMARY KEY (`material_copy_id`),
  ADD UNIQUE KEY `materials_copies_accession_number_unique` (`accession_number`),
  ADD KEY `materials_copies_materials_id_foreign` (`materials_id`),
  ADD KEY `materials_copies_borrows_id_foreign` (`borrows_id`);

--
-- Indexes for table `materials_subject`
--
ALTER TABLE `materials_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials_subject_link`
--
ALTER TABLE `materials_subject_link`
  ADD KEY `materials_subject_link_mat_id_foreign` (`mat_id`),
  ADD KEY `materials_subject_link_sub_id_foreign` (`sub_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penalty_users_id_foreign` (`users_id`),
  ADD KEY `penalty_borrowings_id_foreign` (`borrowings_id`);

--
-- Indexes for table `penalty_settings`
--
ALTER TABLE `penalty_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timein`
--
ALTER TABLE `timein`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timein_users_id_foreign` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD KEY `user_details_user_id_foreign` (`user_id`),
  ADD KEY `user_details_course_id_foreign` (`course_id`),
  ADD KEY `user_details_gender_id_foreign` (`gender_id`);

--
-- Indexes for table `user_links`
--
ALTER TABLE `user_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_links_parent_link_id_foreign` (`parent_link_id`);

--
-- Indexes for table `user_links_parent`
--
ALTER TABLE `user_links_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD KEY `user_permission_user_id_foreign` (`user_id`),
  ADD KEY `user_permission_role_id_foreign` (`role_id`),
  ADD KEY `user_permission_link_id_foreign` (`link_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_reservation`
--
ALTER TABLE `book_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `materials_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `materials_category`
--
ALTER TABLE `materials_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materials_copies`
--
ALTER TABLE `materials_copies`
  MODIFY `material_copy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials_subject`
--
ALTER TABLE `materials_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penalty_settings`
--
ALTER TABLE `penalty_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timein`
--
ALTER TABLE `timein`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_links_parent`
--
ALTER TABLE `user_links_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_extension`
--
ALTER TABLE `book_extension`
  ADD CONSTRAINT `book_extension_borrowings_id_foreign` FOREIGN KEY (`borrowings_id`) REFERENCES `borrowings` (`id`),
  ADD CONSTRAINT `book_extension_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `book_reservation`
--
ALTER TABLE `book_reservation`
  ADD CONSTRAINT `book_reservation_material_copy_id_foreign` FOREIGN KEY (`material_copy_id`) REFERENCES `materials_copies` (`material_copy_id`),
  ADD CONSTRAINT `book_reservation_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_material_copy_id_foreign` FOREIGN KEY (`material_copy_id`) REFERENCES `materials_copies` (`material_copy_id`),
  ADD CONSTRAINT `borrowings_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `materials_category` (`id`);

--
-- Constraints for table `materials_copies`
--
ALTER TABLE `materials_copies`
  ADD CONSTRAINT `materials_copies_borrows_id_foreign` FOREIGN KEY (`borrows_id`) REFERENCES `borrowings` (`id`),
  ADD CONSTRAINT `materials_copies_materials_id_foreign` FOREIGN KEY (`materials_id`) REFERENCES `materials` (`materials_id`);

--
-- Constraints for table `materials_subject_link`
--
ALTER TABLE `materials_subject_link`
  ADD CONSTRAINT `materials_subject_link_mat_id_foreign` FOREIGN KEY (`mat_id`) REFERENCES `materials` (`materials_id`),
  ADD CONSTRAINT `materials_subject_link_sub_id_foreign` FOREIGN KEY (`sub_id`) REFERENCES `materials_subject` (`id`);

--
-- Constraints for table `penalty`
--
ALTER TABLE `penalty`
  ADD CONSTRAINT `penalty_borrowings_id_foreign` FOREIGN KEY (`borrowings_id`) REFERENCES `borrowings` (`id`),
  ADD CONSTRAINT `penalty_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `timein`
--
ALTER TABLE `timein`
  ADD CONSTRAINT `timein_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `user_details_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_links`
--
ALTER TABLE `user_links`
  ADD CONSTRAINT `user_links_parent_link_id_foreign` FOREIGN KEY (`parent_link_id`) REFERENCES `user_links_parent` (`id`);

--
-- Constraints for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `user_links` (`id`),
  ADD CONSTRAINT `user_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`),
  ADD CONSTRAINT `user_permission_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
