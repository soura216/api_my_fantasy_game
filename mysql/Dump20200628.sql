-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: comics
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_category_id` int NOT NULL,
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `is_trending` int NOT NULL,
  `point` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,3,'b750c24cd945033a819da66424330ce8.jpg',1,1,10,'2020-05-23 02:51:52'),(2,3,'97f2db133a72ae7dcf35e09de9a5e82e.png',1,1,10,'2020-05-23 02:52:50'),(3,1,'7ba1a4be99894a928acb05b7c1a3f1a9.png',1,0,1,'2020-05-24 08:42:25'),(4,1,'d841b9e22da8c63f9386b3aed51899b7.jpeg',1,0,1,'2020-05-24 08:43:36');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_category`
--

DROP TABLE IF EXISTS `image_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `image_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_category`
--

LOCK TABLES `image_category` WRITE;
/*!40000 ALTER TABLE `image_category` DISABLE KEYS */;
INSERT INTO `image_category` VALUES (2,'Super Human','c465db22579fbb85f21e24ef442b921f.jpeg','2020-05-22 02:39:56'),(3,'Super Heros','b7114528fe507ee43b6adf33cc77256b.png','2020-05-22 02:40:53');
/*!40000 ALTER TABLE `image_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `withdraw_money` int DEFAULT NULL,
  `referrer_earning_point` int DEFAULT NULL,
  `one_point_is_equal_to_how_much_rupees` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,1,1,'10.1');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `text`
--

DROP TABLE IF EXISTS `text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `text` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text_category_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `is_trending` int DEFAULT NULL,
  `point` int DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text`
--

LOCK TABLES `text` WRITE;
/*!40000 ALTER TABLE `text` DISABLE KEYS */;
INSERT INTO `text` VALUES (1,1,'<font face=\"Times New Roman\">content Something</font><h1><font face=\"Times New Roman\">Hello</font></h1>',1,1,1,'English','2020-05-25 07:18:25'),(2,2,'content',1,0,1,'English','2020-05-24 12:10:18');
/*!40000 ALTER TABLE `text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `text_category`
--

DROP TABLE IF EXISTS `text_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `text_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text_category`
--

LOCK TABLES `text_category` WRITE;
/*!40000 ALTER TABLE `text_category` DISABLE KEYS */;
INSERT INTO `text_category` VALUES (1,'Test 1','34a71e44dacf74d7e81b44d09f6f7f24.jpeg','2020-05-24 10:57:14');
/*!40000 ALTER TABLE `text_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `login_type` varchar(250) NOT NULL,
  `user_type` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `device_token` text NOT NULL,
  `address` text,
  `installation_token` text,
  `referrer_token` text,
  `points` int DEFAULT NULL,
  `mobile` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@gmail.com','21232f297a57a5a743894a0e4a801fc3','normal',0,'Admin','b22d5a1d42209cc5e12def812ad3ecc0',NULL,NULL,'1234',9,'1234567890','2020-06-02 10:49:27'),(21,'soura216@gmail.com','32d45c6a25b3a9ed34235f7067a4419d','normal',1,'Soura','0884519e5621c1e1ac98a80a70565c79','normal','1234','73VCxrYT',1,'1234567891','2020-06-02 10:49:27'),(29,'sam@gmail.com','21661093e56e24cd60b10092005c4ac7','normal',1,'sam','5ccd69ed1e7f5ea7cd6be1ac97588411','','1234','hYtVKva0',1,'6234567897','2020-06-02 10:49:27');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_point_history`
--

DROP TABLE IF EXISTS `user_point_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `user_point_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `point` int NOT NULL DEFAULT '0',
  `item_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_point_history`
--

LOCK TABLES `user_point_history` WRITE;
/*!40000 ALTER TABLE `user_point_history` DISABLE KEYS */;
INSERT INTO `user_point_history` VALUES (6,21,'installation',1,0,'2020-05-30 14:24:38'),(5,1,'referrer',1,0,'2020-05-30 14:24:38'),(14,29,'installation',1,0,'2020-06-02 10:49:27'),(13,1,'referrer',1,0,'2020-06-02 10:49:27');
/*!40000 ALTER TABLE `user_point_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `video_category_id` int NOT NULL,
  `url` varchar(250) NOT NULL,
  `thumbnail_img` varchar(250) NOT NULL,
  `user_id` int NOT NULL,
  `is_trending` int NOT NULL DEFAULT '0',
  `point` int DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,NULL,3,'f79b42f7ff617f4ab483b52ab6533d58.mp4','2adb8cc005d67ff65e3f37b5e34be7b6.png',1,1,0,'03:43:01','2020-05-19 03:43:13'),(2,NULL,4,'c18d8e8ebdb2ad3a54fe45c8ba6d5753.mp4','5d2da5188293218ca8d98b8f6407c963.jpeg',1,1,0,'03:43:01','2020-05-19 03:43:13'),(3,NULL,9,'3c4fa779187b30cd3e818bf9b1175842.mp4','fb22583d1ccee8a1ca88e5d50c38342e.jpg',1,1,10,'03:43:01','2020-05-23 07:34:33'),(4,NULL,3,'fc4b52052112a34d7a7e2882b02f8fe5.mp4','c5b391310eedd1a4e741921e348e6a2e.jpeg',1,0,10,'03:43:00','2020-05-23 07:36:02'),(6,NULL,6,'6cbc245b765d9a92b2d15d0ca81dbff3.mp4','',1,1,1,'00:00:01','2020-05-23 05:12:42'),(8,NULL,4,'d45a7f34e7ed265c32509dccf15aa148.mp4','b095e47b775fbe6979f3d2c021af8f2d.jpeg',1,1,1,'00:00:01','2020-05-24 08:26:39'),(9,'Spider Video',6,'20603caa191a0558f51c6cf5eae5f180.mp4','dbd10f1b2ccb4a73e2a49a57f9a24581.jpg',1,1,1,'02:05:01','2020-05-24 09:11:37'),(11,'Test',6,'720c1935456cb2c38ae9423054ad5bc9.mp4','',1,1,1,'22:50:10','2020-06-04 10:19:01');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_category`
--

DROP TABLE IF EXISTS `video_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `video_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_category`
--

LOCK TABLES `video_category` WRITE;
/*!40000 ALTER TABLE `video_category` DISABLE KEYS */;
INSERT INTO `video_category` VALUES (3,'Marvel VS DC','e170d219a4d52a811d8dfaeae9917a0e.jpeg','2020-05-18 09:13:12'),(5,'Cat Woman','5335c43fd5bea67097e396a3f0d5a419.png','2020-05-18 09:56:51'),(6,'Avenger','45e4403bc6dace0ac398354ab4054e1b.jpeg','2020-05-18 09:57:06'),(7,'Justice League: The Flashpoint Paradox','2215d9c8d4024b787436d6a545992ec6.jfif','2020-05-18 09:57:52'),(8,'Justice League','961df17a6edf24c9f0a0e85e3259ae22.jfif','2020-05-18 09:58:22'),(9,'Spidy Vs Batman','dbf8dfa2894e447a086bfd015c75dd13.jfif','2020-05-18 09:58:39'),(10,'Captain Marvel','8a89d147fa58c50bf640ca856f6005c3.jfif','2020-05-18 09:59:02'),(11,'End Game','ce036e0d48236300c86e30c948bd4757.jfif','2020-05-18 09:59:26'),(12,'Marvel Super Women','29830a6c7093a9254eea6e6c5d88b192.jfif','2020-05-18 09:59:47'),(13,'Marvel Star Vs Batman','773ca85c8f84f16d91a0ac31bf5d9dfa.jpg','2020-05-18 10:00:24'),(14,'The avengers avengers: infinity war','6e0fc907a194b7360ad8e0619e9dbc44.jpg','2020-05-18 10:01:32'),(16,'Super Hero','5a95051ed05bd5bf33e1fd5b5d0a799d.jpg','2020-05-18 02:35:43');
/*!40000 ALTER TABLE `video_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_request`
--

DROP TABLE IF EXISTS `withdraw_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `withdraw_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paytm_number` varchar(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `point_requested` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount_requested` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('in progress','accept','reject') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'in progress',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_request`
--

LOCK TABLES `withdraw_request` WRITE;
/*!40000 ALTER TABLE `withdraw_request` DISABLE KEYS */;
INSERT INTO `withdraw_request` VALUES (1,21,'soura216@gmail.com','Soura','wedw123','10','1','reject','2020-06-01 11:48:59'),(2,21,'soura216@gmail.com','Soura','wedw123','20','2','accept','2020-06-01 11:48:59');
/*!40000 ALTER TABLE `withdraw_request` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-28 20:57:21
