-- MariaDB dump 10.19  Distrib 10.4.25-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mrm
-- ------------------------------------------------------
-- Server version	10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `child`
--

DROP TABLE IF EXISTS `child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mother_name` varchar(255) NOT NULL,
  `child_last_name` varchar(255) NOT NULL,
  `child_first_name` varchar(255) NOT NULL,
  `child_middle_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birth_date` date NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child`
--

LOCK TABLES `child` WRITE;
/*!40000 ALTER TABLE `child` DISABLE KEYS */;
INSERT INTO `child` VALUES (1,'dsa','asd','asd','asd','Female','0123-03-12',123.00,123.00),(2,'dsa','asd','asd','asd','Female','0123-03-12',123.00,123.00),(3,'asd','asd','asd','asd','Female','0123-03-12',123.00,123.00),(4,'dra','qwe','dasd','asdasd','Female','2002-09-08',12.00,12.00);
/*!40000 ALTER TABLE `child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immunizations`
--

DROP TABLE IF EXISTS `immunizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immunizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `immunization_type` varchar(255) NOT NULL,
  `date_of_immunization` date NOT NULL,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immunizations`
--

LOCK TABLES `immunizations` WRITE;
/*!40000 ALTER TABLE `immunizations` DISABLE KEYS */;
INSERT INTO `immunizations` VALUES (1,'dra',1,'Hepa A','2002-09-08','asdasd'),(2,'dra',1,'Hepa A','2002-09-08','asdasd'),(3,'dra',1,'Hepa A','2002-09-08','asdasd'),(4,'dra',1,'Hepa A','2002-09-08','asdasd'),(5,'drazix',123,'Hepa A','2002-09-08','ayaw'),(6,'drazix',123,'Hepa A','2002-09-08','ayaw'),(7,'drazixmaw',34,'Influenza','2002-09-08','asdasd'),(8,'asdas',12,'Hepa B','0003-03-12','asdasd'),(9,'PRINCESS',21,'Influenza','0012-03-12','123'),(10,'ASDAS',12,'Hepa A','0123-03-12','123'),(11,'123',123,'Measles','0123-03-12','123');
/*!40000 ALTER TABLE `immunizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `midwife`
--

DROP TABLE IF EXISTS `midwife`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `midwife` (
  `midwife_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_code` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`midwife_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `midwife`
--

LOCK TABLES `midwife` WRITE;
/*!40000 ALTER TABLE `midwife` DISABLE KEYS */;
INSERT INTO `midwife` VALUES (1,'','dra','z','zix','09674124545','drazixmain0122@gmail.com','das','0012-03-12',21,'Active','2024-08-03 02:08:37'),(2,'','Princess','Barredo','Samson','09674124545','princes@gmail.cpm','staritne','2001-04-07',23,'Active','2024-08-03 05:37:36'),(3,'','asd','asd','asd','09674124545','drazixmain0122@gmail.com','asd','0123-03-12',21,'Active','2024-08-03 05:45:58'),(4,'','ehememm','asd','asd','09674124545','123@qasd','qwe','0012-03-12',12,'Active','2024-08-03 06:01:41');
/*!40000 ALTER TABLE `midwife` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `midwife_nurse_doctor` varchar(255) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `size_of_tummy` int(11) DEFAULT NULL,
  `bp` varchar(50) DEFAULT NULL,
  `pr` varchar(50) DEFAULT NULL,
  `rr` varchar(50) DEFAULT NULL,
  `fh` varchar(50) DEFAULT NULL,
  `fht` varchar(50) DEFAULT NULL,
  `aog` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prenatal_schedule` date DEFAULT NULL,
  `expected_delivery` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'dra','z','zix','09674124545','2002-09-08','dra',111,'dra',213,12,'123','123','123','123','123','123','2024-08-02 15:39:37','2024-08-03 07:45:49','2004-09-08','2024-08-29','Delivered',NULL,'asdd'),(2,'dra','a','asd','09674124545','0123-03-12','asdas',21,'dra',123,12,'12','123','123','123','123','123','2024-08-02 15:41:41','2024-08-03 07:42:56','2024-08-07','3123-12-12','Delivered',NULL,'asdasd'),(3,'dra','asd','asd','09674124545','2002-09-08','asd',12,'dra',123,12,'123','123','123','123','123','123','2024-08-02 16:56:04','2024-08-03 14:44:28','2024-08-14','0012-09-08','Pregnant',NULL,'123'),(4,'xddas','asd','zix','09674124545','2002-09-08','rasd',21,'dra',123,12,'123','1232','123','123','123','1231','2024-08-02 17:00:57','2024-08-03 06:52:01',NULL,'0312-02-01','Pregnant',NULL,NULL),(5,'as','','qwe','','0000-00-00','',0,'',0,0,'','','','','','','2024-08-02 17:03:47','2024-08-03 14:44:39','2024-08-21',NULL,NULL,NULL,'123'),(6,'ehememm','z','zix','09674124545','2002-09-08','sda',21,'asd',123,12,'123','123','123','123','123','123','2024-08-03 03:13:05','2024-08-03 03:13:05',NULL,NULL,NULL,NULL,NULL),(7,'dra','z','asd','09674124545','2002-09-08','asd',12,'0',123,12,'2002-09-08','12','12','12','12','12','2024-08-03 03:36:25','2024-08-03 03:36:25',NULL,'0000-00-00',NULL,NULL,NULL),(8,'orsg','a','asd','09674124545','2002-09-08','asd',12,'asdas',123,123,'12','123','123','123','123','123','2024-08-03 03:39:34','2024-08-03 03:39:34',NULL,'2002-09-08',NULL,NULL,NULL),(9,'dra','z','zix','09674124545','2002-09-08','asd',123,'dsad',12,123,'123','123','123','123','123','123','2024-08-03 03:57:32','2024-08-03 03:57:32',NULL,'0000-00-00','Pregnant',NULL,NULL),(10,'stsats','a','123','09674124545','2092-09-08','asd',21,'asd',12,12,'123','123','123','123','123','123','2024-08-03 04:01:13','2024-08-03 04:01:13',NULL,'2002-11-23','Pregnant',NULL,NULL),(11,'dra','a','as','09674124545','2002-09-08','asd',12,'asd',12,12,'123','123','123','123','213','123','2024-08-03 04:11:09','2024-08-03 04:11:09',NULL,'0000-00-00','Pregnant',NULL,NULL),(12,'jonard','none','Jayag','09674124545','2002-09-08','osmena',21,'doctor strange',45,321,'12','123','123','123','123','123','2024-08-03 04:13:37','2024-08-03 04:13:37',NULL,'0000-00-00','Delivered',NULL,NULL),(13,'Faker','main','zix','09674124545','2002-09-08','osmena',21,'ako',21,100,'1','2','3','4','5','6','2024-08-03 04:19:42','2024-08-03 04:19:42',NULL,'0000-00-00','Delivered',NULL,NULL),(14,'dra','z','zix','09674124545','2002-09-08','osmena',21,'Princess',50,12,'1','2','3','4','5','6','2024-08-03 04:24:17','2024-08-03 04:24:17',NULL,'0000-00-00','Pregnant',NULL,NULL),(15,'Princess','Barredo','Samson','0967','2001-04-07','sta rita',23,'Jonard',60,10,'1','2','3','4','5','6','2024-08-03 04:33:07','2024-08-03 04:33:07',NULL,'0000-00-00','Pregnant',NULL,NULL),(16,'Dra ','zix','main','09674124545','2002-09-08','osemana',21,'princess',50,11,'1','2','3','4','5','6','2024-08-03 04:41:36','2024-08-03 04:41:36',NULL,'0000-00-00','Pregnant',NULL,NULL),(17,'dra','z','zix','','0000-00-00','',0,'',0,0,'','','','','','','2024-08-03 04:42:31','2024-08-03 04:42:31',NULL,'2024-08-22','Delivered',NULL,NULL);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('staff','administrator') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,'das','123','1234','staff','2024-08-03 16:35:27'),(9,'Admin','09674124545','$2y$10$gQz1.ByAPegavH2ZEAPFEeAx59t8VQTKRplw8BXbjtDe3wNX5dDsC','administrator','2024-08-03 16:52:12');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-04  1:15:28
