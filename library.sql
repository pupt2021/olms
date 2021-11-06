/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.33 : Database - library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`library` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `library`;

/*Table structure for table `book_extension` */

DROP TABLE IF EXISTS `book_extension`;

CREATE TABLE `book_extension` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `borrowings_id` int(10) DEFAULT NULL,
  `users_id` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `book_extension` */

insert  into `book_extension`(`id`,`borrowings_id`,`users_id`,`status`) values 
(1,7,7,1),
(2,8,7,2);

/*Table structure for table `book_reservation` */

DROP TABLE IF EXISTS `book_reservation`;

CREATE TABLE `book_reservation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `materials_id` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `book_reservation` */

insert  into `book_reservation`(`id`,`users_id`,`materials_id`,`status`) values 
(1,7,1,0),
(2,7,2,0);

/*Table structure for table `borrowings` */

DROP TABLE IF EXISTS `borrowings`;

CREATE TABLE `borrowings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `materials_id` int(10) NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_returned` date NOT NULL,
  `type` int(10) NOT NULL,
  `status` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `borrowings` */

insert  into `borrowings`(`id`,`users_id`,`materials_id`,`date_borrowed`,`date_returned`,`type`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,1,'2021-08-06','2021-08-09',2,0,'2021-08-06 08:46:00',NULL,'2021-08-06 08:49:06'),
(2,3,1,'2021-08-06','2021-08-09',2,0,'2021-08-06 08:49:20',NULL,'2021-08-06 08:49:56'),
(3,3,1,'2021-08-06','2021-08-09',1,0,'2021-08-06 08:52:29',NULL,'2021-08-06 08:52:37'),
(4,3,1,'2021-08-06','2021-08-09',1,0,'2021-08-06 10:47:12',NULL,'2021-08-25 01:39:51'),
(5,3,2,'2021-08-06','2021-08-09',2,1,'2021-08-06 11:40:43',NULL,NULL),
(6,7,4,'2021-08-18','2021-08-20',2,1,'2021-08-21 16:53:17',NULL,NULL),
(7,7,5,'2021-08-24','2021-08-30',1,1,'2021-08-24 16:23:06',NULL,NULL),
(8,7,3,'2021-08-24','2021-08-27',1,1,'2021-08-24 23:58:30',NULL,NULL);

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(50) DEFAULT NULL,
  `course_description` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `courses` */

insert  into `courses`(`id`,`course_name`,`course_description`,`status`,`created_at`,`modified_at`,`deleted_at`) values 
(1,'BSIT','Bachelor of Science in Information Technology',0,NULL,NULL,'2021-06-04 02:42:26'),
(2,'BSCS',NULL,1,NULL,NULL,NULL);

/*Table structure for table `gender` */

DROP TABLE IF EXISTS `gender`;

CREATE TABLE `gender` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `gender` */

insert  into `gender`(`id`,`gender_name`,`status`,`created_at`,`modified_at`,`deleted_at`) values 
(1,'Male',1,NULL,NULL,NULL),
(2,'Female',1,NULL,NULL,NULL),
(3,'Hetero',0,NULL,NULL,NULL);

/*Table structure for table `materials` */

DROP TABLE IF EXISTS `materials`;

CREATE TABLE `materials` (
  `materials_id` int(10) NOT NULL AUTO_INCREMENT,
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
  `status` int(10) NOT NULL DEFAULT '1',
  `type` int(10) NOT NULL,
  `is_available` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`materials_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `materials` */

insert  into `materials`(`materials_id`,`category_id`,`accnum`,`isbn`,`title`,`callno`,`author`,`publisher`,`edition`,`date_received`,`copyright`,`status`,`type`,`is_available`,`created_at`,`update_at`,`deleted_at`) values 
(1,2,'PUP-BOOK-1','SAMPLE EDIT','SAMPLE EDIT','1','SAMPLE','SAMPLE','1','2021-06-17','2020',1,1,1,'2021-06-17 00:42:23','2021-06-17 07:56:41','2021-06-17 07:04:16'),
(2,3,'SCIENCE-BOOK-2','SAMPLE SCIENCE','SAMPLE SCIENCE','10','SAMPLE SCIENCE','SAMPLE SCIENCE','5','2021-06-17','2020',1,2,0,'2021-06-17 07:12:12','2021-06-17 07:56:53',NULL),
(3,4,'PUPT FIL-3','FIL1234','FILIPINA','FIL1234','SAMPLE','SAMPLE','10','2021-06-17','2020',1,1,0,'2021-06-17 07:31:38',NULL,NULL),
(4,5,'PUPT ENG-4','ENG12','ENGLISH','ENG12','ENG12','ENG12','12','2021-06-17','2021',1,2,0,'2021-06-17 07:55:49',NULL,NULL),
(5,2,'PUP-BOOK-5','1000','1000','1000','1000','1000','1000','2021-07-29','2021',0,1,0,'2021-07-29 09:59:14',NULL,'2021-08-27 04:40:18');

/*Table structure for table `materials_category` */

DROP TABLE IF EXISTS `materials_category`;

CREATE TABLE `materials_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_structure` varchar(50) NOT NULL,
  `cat_description` varchar(50) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `materials_category` */

insert  into `materials_category`(`id`,`cat_structure`,`cat_description`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'PUP-BOOK-1','BOOK WITH NUMBER 1',0,'2021-06-04 03:05:53','2021-06-04 03:08:00','2021-06-16 23:55:22'),
(2,'PUP-BOOK',NULL,1,'2021-06-16 23:55:32',NULL,NULL),
(3,'SCIENCE-BOOK',NULL,1,'2021-06-17 07:11:43',NULL,NULL),
(4,'PUPT FIL',NULL,1,'2021-06-17 07:25:06',NULL,NULL),
(5,'PUPT ENG',NULL,1,'2021-06-17 07:55:11',NULL,NULL);

/*Table structure for table `materials_subject` */

DROP TABLE IF EXISTS `materials_subject`;

CREATE TABLE `materials_subject` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `materials_subject` */

insert  into `materials_subject`(`id`,`subject_name`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Philosophy',1,'2021-06-04 02:44:05','2021-06-04 02:44:36','2021-06-04 02:44:46'),
(2,'Science',1,'2021-06-04 02:44:05',NULL,NULL),
(3,'Math',1,'2021-06-17 07:23:08','2021-06-17 07:23:23',NULL);

/*Table structure for table `materials_subject_link` */

DROP TABLE IF EXISTS `materials_subject_link`;

CREATE TABLE `materials_subject_link` (
  `mat_id` int(10) DEFAULT NULL,
  `sub_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `materials_subject_link` */

insert  into `materials_subject_link`(`mat_id`,`sub_id`) values 
(1,1),
(1,2),
(2,2),
(3,1),
(3,2),
(3,3),
(4,1),
(5,1),
(5,2),
(5,3);

/*Table structure for table `penalty` */

DROP TABLE IF EXISTS `penalty`;

CREATE TABLE `penalty` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `borrowings_id` int(10) NOT NULL,
  `penalty_days` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `penalty` */

insert  into `penalty`(`id`,`users_id`,`borrowings_id`,`penalty_days`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,4,16,0,NULL,NULL,'2021-08-25 01:39:51'),
(2,3,5,18,1,NULL,NULL,NULL),
(3,7,6,7,1,NULL,NULL,NULL);

/*Table structure for table `penalty_settings` */

DROP TABLE IF EXISTS `penalty_settings`;

CREATE TABLE `penalty_settings` (
  `id` int(10) NOT NULL,
  `penalty_days` int(3) DEFAULT NULL,
  `penalty_fee` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penalty_settings` */

insert  into `penalty_settings`(`id`,`penalty_days`,`penalty_fee`) values 
(1,3,400.00);

/*Table structure for table `timein` */

DROP TABLE IF EXISTS `timein`;

CREATE TABLE `timein` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `timein` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `timein` */

insert  into `timein`(`id`,`users_id`,`timein`,`timeout`,`status`) values 
(1,1,'2021-08-07 10:55:06','2021-08-07 10:55:18',0),
(2,7,'2021-08-25 00:57:50','2021-08-25 01:05:49',0);

/*Table structure for table `user_details` */

DROP TABLE IF EXISTS `user_details`;

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
  `employee_status` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `gender_id_fk` (`gender_id`),
  CONSTRAINT `gender_id_fk` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_details` */

insert  into `user_details`(`user_id`,`image_url`,`course_id`,`gender_id`,`firstname`,`lastname`,`middlename`,`birthday`,`contact_no`,`address`,`barangay`,`city`,`zip_code`,`stud_number`,`faculty_code`,`employee_number`,`employee_status`) values 
(1,NULL,NULL,1,'admin','admin',NULL,'1991-01-01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-ADMIN',NULL),
(3,NULL,NULL,1,'Angie','Antique',NULL,'2021-05-15',NULL,NULL,NULL,'Taguig',NULL,'','','2021-00001',2),
(4,NULL,NULL,1,'Romy','Papaitan',NULL,'2021-05-15',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-00002',1),
(5,NULL,NULL,1,'Julia','Pendon',NULL,'2021-05-16',NULL,NULL,NULL,NULL,NULL,'2021-ST-00001','','',0),
(6,NULL,NULL,1,'root','root',NULL,'1991-05-28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(7,'Test_Student-Test_Student.jpg',NULL,1,'Test_Student','Test_Student',NULL,'2021-08-07',NULL,NULL,NULL,NULL,NULL,'0000-TESTSTUDENT','','',0);

/*Table structure for table `user_links` */

DROP TABLE IF EXISTS `user_links`;

CREATE TABLE `user_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(45) DEFAULT NULL,
  `slug_name` varchar(45) DEFAULT NULL,
  `parent_link_id` int(11) DEFAULT NULL,
  `display_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_link_parent_idx` (`parent_link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `user_links` */

insert  into `user_links`(`id`,`link_name`,`slug_name`,`parent_link_id`,`display_status`) values 
(1,'View User','User.index',1,1),
(2,'Add User','User.store',1,0),
(3,'Edit User','User.show',1,0),
(4,'Delete User','UserDelete',1,0),
(5,'View Roles','Roles.index',1,1),
(6,'Add Roles','Roles.store',1,0),
(7,'Edit Roles','Roles.show',1,0),
(8,'Delete Roles','RolesDelete',1,0),
(9,'View Courses','Course.index',1,1),
(10,'Add Courses','Course.store',1,0),
(11,'Edit Courses','Course.show',1,0),
(12,'Delete Courses','CourseDelete',1,0),
(13,'View Gender','Gender.index',1,1),
(14,'Add Gender','Gender.store',1,0),
(15,'Edit Gender','Gender.show',1,0),
(16,'Delete Gender','GenderDelete',1,0),
(17,'View Permission','Permissions.index',1,1),
(18,'Add Permission','Permissions.create',1,0),
(19,'Edit Permission','Permissions.show',1,0),
(21,'View Materials','Material.index',2,1),
(22,'Add Materials','Material.store',2,0),
(23,'Edit Materials','Material.show',2,0),
(24,'Delete Materials','MaterialsDelete',2,0),
(25,'View Materials Category','MaterialsCategory.index',2,1),
(26,'Add Materials Category','MaterialsCategory.store',2,0),
(27,'Edit Materials Category','MaterialsCategory.show',2,0),
(28,'Delete Materials Category','MaterialsCategoryDelete',2,0),
(29,'View Materials Subject','MaterialsSubject.index',2,1),
(30,'Add Materials Subject','MaterialsSubject.store',2,0),
(31,'Edit Materials Subject','MaterialsSubject.show',2,0),
(32,'Delete Materials Subject','MaterialsSubjectDelete',2,0),
(33,'View Issuing Of Books','Issuing.index',3,1),
(34,'Add Issuing Of Books','Issuing.store',3,0),
(35,'Edit Issuing Of Books','Issuing.show',3,0),
(36,'Return Issued Books','IssuingDelete',3,0),
(37,'View Borrowing Of Books','Borrowing.index',3,1),
(38,'Add Borrowing Of Books','Borrowing.store',3,0),
(39,'Edit Borrowing Of Books','Borrowing.show',3,0),
(40,'Returned Borrowed Books','BorrowingDelete',3,0),
(41,'Manage Penalty Settings','ManagePenalty.index',4,1),
(42,'Edit Penalty Settings','ManagePenalty.store',4,0),
(43,'View Penalty List','Penalty.index',4,1),
(44,'Print Penalty','Penalty.PDF',4,0),
(45,'My Profile','UserProfile.View',5,1),
(46,'Update My Profile','UserProfile.UpdateView',5,1),
(47,'Search Books','UserProfile.SearchBook',5,1),
(48,'Reserve Books','Reserve.main',5,1),
(49,'My Penalty','Penalty.My_Penalty',5,1),
(50,'View Materials Archives','Archives.Materials_List',6,1),
(51,'View Users Archives','Archives.Users_List',6,1),
(52,'View Room Use Archives','Archives.Borrowing_List',6,1),
(53,'View Borrowing Archives','Archives.Issuing_List',6,1);

/*Table structure for table `user_links_parent` */

DROP TABLE IF EXISTS `user_links_parent`;

CREATE TABLE `user_links_parent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_link_parent_name` varchar(45) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `user_role` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user_links_parent` */

insert  into `user_links_parent`(`id`,`user_link_parent_name`,`icon`,`user_role`) values 
(1,'User Management','fa-user',1),
(2,'Materials Management','fa-boxes',1),
(3,'Issuing/Borrowing Management','fa-clipboard-check',1),
(4,'Penalty Management','fa-window-close',1),
(5,'Users Profile','fa-user',2),
(6,'Archives','fa-archive',1);

/*Table structure for table `user_permission` */

DROP TABLE IF EXISTS `user_permission`;

CREATE TABLE `user_permission` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT 'On',
  PRIMARY KEY (`user_id`,`role_id`,`link_id`),
  KEY `role_id_fk_idx` (`role_id`),
  KEY `user_link_id_fk_idx` (`link_id`),
  CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`),
  CONSTRAINT `user_permission_ibfk_3` FOREIGN KEY (`link_id`) REFERENCES `user_links` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_permission` */

insert  into `user_permission`(`user_id`,`role_id`,`link_id`,`status`) values 
(1,1,1,'On'),
(1,1,2,'On'),
(1,1,3,'On'),
(1,1,4,'On'),
(1,1,5,'On'),
(1,1,6,'On'),
(1,1,7,'On'),
(1,1,8,'On'),
(1,1,9,'On'),
(1,1,10,'On'),
(1,1,11,'On'),
(1,1,12,'On'),
(1,1,13,'On'),
(1,1,14,'On'),
(1,1,15,'On'),
(1,1,16,'On'),
(1,1,17,'On'),
(1,1,18,'On'),
(1,1,19,'On'),
(1,1,21,'On'),
(1,1,22,'On'),
(1,1,23,'On'),
(1,1,24,'On'),
(1,1,25,'On'),
(1,1,26,'On'),
(1,1,27,'On'),
(1,1,28,'On'),
(1,1,29,'On'),
(1,1,30,'On'),
(1,1,31,'On'),
(1,1,32,'On'),
(1,1,33,'On'),
(1,1,34,'On'),
(1,1,35,'On'),
(1,1,36,'On'),
(1,1,37,'On'),
(1,1,38,'On'),
(1,1,39,'On'),
(1,1,40,'On'),
(1,1,41,'On'),
(1,1,42,'On'),
(1,1,43,'On'),
(1,1,44,'On'),
(1,1,50,'On'),
(1,1,51,'On'),
(1,1,52,'On'),
(1,1,53,'On'),
(3,2,17,'On'),
(3,2,18,'On'),
(3,2,19,'On'),
(4,2,1,'On'),
(4,2,5,'On'),
(4,2,9,'On'),
(4,2,13,'On'),
(4,2,17,'On'),
(7,3,45,'On'),
(7,3,46,'On'),
(7,3,47,'On'),
(7,3,48,'On'),
(7,3,49,'On');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `role_description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `role_landing` varchar(255) DEFAULT NULL,
  `role_status` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `user_role` */

insert  into `user_role`(`role_id`,`role_name`,`role_description`,`role_landing`,`role_status`,`created_at`,`updated_at`) values 
(1,'Administrator','',NULL,1,NULL,NULL),
(2,'Teacher',NULL,NULL,1,NULL,NULL),
(3,'Student',NULL,NULL,1,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_role_fk_id` (`role_id`),
  CONSTRAINT `user_role_fk_id` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`role_id`,`username`,`email`,`password`,`limit`,`status`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'admin','admin@email.com','$2y$10$L2J8xXEiccu0AzqPqRzSf.XtjZfYT9rVmuhqSQtIeaVSGGD4dlQHi',NULL,1,NULL,NULL,NULL,NULL),
(3,2,'2021-00001','teacher@gmail.com','$2y$10$L2J8xXEiccu0AzqPqRzSf.XtjZfYT9rVmuhqSQtIeaVSGGD4dlQHi',NULL,1,NULL,NULL,NULL,NULL),
(4,2,'2021-00002','123@gmail.com','$2y$10$UFovjz0bTNWu2N7Bhz/NEut9ERSqDF8X03aajydy/67Bqtyxqhg2i',NULL,1,NULL,NULL,NULL,NULL),
(5,3,'2021-ST-00001','zxczxc@gmail.com','$2y$10$uPopIMgBRzVS51RNSYC4Z./JA9scayR0Ig9Vqsw4hCTxJbHWWhMoK',NULL,1,NULL,NULL,NULL,NULL),
(6,2,'root','root@gmail.com','$2y$10$lRIITArScXAD.RGMJz14xeR/DlnPtw5xsIyZ0u089KowecQA5dlD2',NULL,0,NULL,NULL,NULL,NULL),
(7,3,'student','admin@gmail.com','$2y$10$N9SWB3Ax4s/WuCSYf0b3OekQEzFYnU8.xDaKg8piNYTuFOBHRww.e',NULL,1,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
