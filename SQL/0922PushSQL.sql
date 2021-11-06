-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: library
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `copies` int(11) DEFAULT '0',
  `copyright` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `type` int(10) NOT NULL,
  `is_available` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`materials_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (1,1,'PUPT Circ-1','ISBN 978-07-131798-6','Principles of General Chemistry','QD 31.3 S55 2013','Silberberg','McGraw Hill Company Inc.','3','0000-00-00',0,'2013',1,1,1,NULL,NULL,NULL),(2,1,'PUPT Circ-2','ISBN 978-0-07-337351-5','The Professional Approach: Microsoft Office 2007','','Hinkle, Graves, Juarez, Stewart, Mayhall, Carter,','The McGraw-Hill Companies, Inc.','','2021-08-27',0,'2007',1,1,1,NULL,NULL,NULL),(3,1,'PUPT Circ-3','ISBN 978-0-07-352699-7','Financial and Managerial Accounting','','Jan Williams, Sue Haka, Mark Bettner,Joseph Carcel','The McGraw-Hill Companies, Inc.','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(4,1,'PUPT Circ-4','ISBN-13: 978-1-285-07792-5','Programming with Microsoft : Visual Basic 2012','QA 76.76 B3z3374 2014','Diane Zak','CENGAGE Learning Asia','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(5,1,'PUPT Circ-5','ISBN-13: 978-0-13-512236-5','Foundation of Finance','HG 4026.F67 K46 2011','Keown , Martin, Petty','Pearson Education','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(6,1,'PUPT Circ-6','ISBN-13: 978-0-273-77985-5','Cost Accounting : A Managerial Emphasis','Hf 5586.C8 H59 2012','Charles T. Horngren, Srikant M. Datar, Madhav V. R','Pearson Education Limited Inc.','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(7,1,'PUPT Circ-7','ISBN 0-07-123016-5','Financial and Managerial Accounting','HF5635.M492','Williams, Haka, Bettner, Meigs','The McGraw-Hill Companies, Inc.','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(8,1,'PUPT Circ-8','ISBN 978-0-07-352284-5','Mastering  ArcGIS','G70.212.P74','Maribeth Price','The McGraw-Hill Companies, Inc.','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(9,1,'PUPT Circ-9','ISBN-13: 978-0-321-52678-6','Starting out with C++ Early Objects','QA 76.73 C153G123 2007','Tony Gaddis, Judy Walters, Godfrey Muganda','Pearson Education, Inc','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(10,1,'PUPT Circ-10','ISBN-13: 978-1-4018-4251-2','Visualization, Modeling, and Graphics for Engineer','TA 174 L721','Lieu/Sorby','CENGAGE Learning Asia','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(11,1,'PUPT Circ-11','ISBN-13: 978-1-4180-4102-1','Introduction to Digital Electronics','TK 7868.D5 R353','Ken Reid, Robert Dueck','Thomson Delmar Learning','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(12,1,'PUPT Circ-12','ISBN-13: 978-0-07-830724-9','Workbook for Technology of Machine Tools','REF 621902 K864T','Steve F. Krar, Arthur R. Gill, Peter Smid','McGraw Hill Company Inc.','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(13,1,'PUPT Circ-13','ISBN-13: 978-1-4239-0609-4','Computer Concepts: Introductory','QA 76 P269','June Jamrich Parsons, Dan Oja','Thomson Course Technology','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(14,1,'PUPT Circ-14','ISBN-13: 978-1-4283-1936-3','Refrigeration and Air Conditioning Technology','TP 492 R281','','','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(15,1,'PUPT Circ-15','ISBN-13: 978-1-4180-3758-1','Automotive Service','TL 152 G472','Tim Gilles','DELMAR CENGAGE Learning','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(16,1,'PUPT Circ-16','ISBN 0-13-6134247-2','JAVA How to Program','QA 76.73 J38D325','','','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(17,1,'PUPT Circ-17','ISBN 0-619-21724-3','JAVA Learning to Program with Robots','QA 76.73 J38B395','','','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(18,1,'PUPT Circ-18','ISBN-13: 978-1-4239-0196-9','Programming Logic and Design: Comprehensive','QA 76,73 F245','','','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(19,1,'PUPT Circ-19','ISBN-13: 978-0-619-26720-9','Microsoft Visual Basic 2005: BASICS','QA 76.73 B3M626','','','','0000-00-00',0,'',1,1,1,NULL,NULL,NULL),(20,1,'PUPT Circ-1','ISBN 0-07-253855-4','Wastewater Engineering: Treatment and Reuse','','','','','0000-00-00',0,'',1,1,0,NULL,NULL,NULL),(21,1,'PUPT Circ-21','Sample','Sample','1234','Sample','Sample','10','2021-09-21',15,'2021',1,1,1,'2021-09-21 13:21:43','2021-09-21 13:23:51',NULL);
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials_copies`
--

DROP TABLE IF EXISTS `materials_copies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materials_copies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materials_id` int(11) DEFAULT NULL,
  `borrows_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials_copies`
--

LOCK TABLES `materials_copies` WRITE;
/*!40000 ALTER TABLE `materials_copies` DISABLE KEYS */;
INSERT INTO `materials_copies` VALUES (1,21,10,1,0);
/*!40000 ALTER TABLE `materials_copies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_links`
--

DROP TABLE IF EXISTS `user_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(45) DEFAULT NULL,
  `slug_name` varchar(45) DEFAULT NULL,
  `parent_link_id` int(11) DEFAULT NULL,
  `display_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_link_parent_idx` (`parent_link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_links`
--

LOCK TABLES `user_links` WRITE;
/*!40000 ALTER TABLE `user_links` DISABLE KEYS */;
INSERT INTO `user_links` VALUES (1,'User','User.index',1,1),(2,'Add User','User.store',1,0),(3,'Edit User','User.show',1,0),(4,'Delete User','UserDelete',1,0),(5,'Roles','Roles.index',1,1),(6,'Add Roles','Roles.store',1,0),(7,'Edit Roles','Roles.show',1,0),(8,'Delete Roles','RolesDelete',1,0),(9,'Courses','Course.index',1,1),(10,'Add Courses','Course.store',1,0),(11,'Edit Courses','Course.show',1,0),(12,'Delete Courses','CourseDelete',1,0),(13,'View Gender','Gender.index',1,1),(14,'Add Gender','Gender.store',1,0),(15,'Edit Gender','Gender.show',1,0),(16,'Delete Gender','GenderDelete',1,0),(17,'Permissions','Permissions.index',1,1),(18,'Add Permission','Permissions.create',1,0),(19,'Edit Permission','Permissions.show',1,0),(21,'Materials','Material.index',2,1),(22,'Add Materials','Material.store',2,0),(23,'Edit Materials','Material.show',2,0),(24,'Delete Materials','MaterialsDelete',2,0),(25,'Materials Category','MaterialsCategory.index',2,1),(26,'Add Materials Category','MaterialsCategory.store',2,0),(27,'Edit Materials Category','MaterialsCategory.show',2,0),(28,'Delete Materials Category','MaterialsCategoryDelete',2,0),(29,'Materials Subject','MaterialsSubject.index',2,1),(30,'Add Materials Subject','MaterialsSubject.store',2,0),(31,'Edit Materials Subject','MaterialsSubject.show',2,0),(32,'Delete Materials Subject','MaterialsSubjectDelete',2,0),(33,'Borrowed Books','Issuing.index',3,1),(34,'Add Issuing Of Books','Issuing.store',3,0),(35,'Edit Issuing Of Books','Issuing.show',3,0),(36,'Return Issued Books','IssuingDelete',3,0),(37,'Room Use Books','Borrowing.index',3,1),(38,'Add Borrowing Of Books','Borrowing.store',3,0),(39,'Edit Borrowing Of Books','Borrowing.show',3,0),(40,'Returned Borrowed Books','BorrowingDelete',3,0),(41,'Penalty Settings','ManagePenalty.index',4,1),(42,'Edit Penalty Settings','ManagePenalty.store',4,0),(43,'Penalty List','Penalty.index',4,1),(44,'Print Penalty','Penalty.PDF',4,0),(45,'My Profile','UserProfile.View',5,1),(46,'Update My Profile','UserProfile.UpdateView',5,1),(47,'Search Books','UserProfile.SearchBook',5,1),(48,'Reserve Books','Reserve.main',5,0),(49,'My Penalty','Penalty.My_Penalty',5,1),(50,'Materials Archives','Archives.Materials_List',6,1),(51,'Users Archives','Archives.Users_List',6,1),(52,'Room Use Archives','Archives.Borrowing_List',6,1),(53,'Borrowing Archives','Archives.Issuing_List',6,1),(54,'Daily Time Record','DTR.view',1,1);
/*!40000 ALTER TABLE `user_links` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-22  2:29:37
