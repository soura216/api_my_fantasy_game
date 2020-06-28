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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `login_type` varchar(250) NOT NULL,
  `user_type` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `device_token` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@gmail.com','21232f297a57a5a743894a0e4a801fc3','mobile',0,'Admin','b22d5a1d42209cc5e12def812ad3ecc0'),(7,'soura216@gmail.com','21232f297a57a5a743894a0e4a801fc3','mobile',1,'Soura','40213d22107f2114178d42a074eeccb5'),(8,'farman52@gmail.com','21232f297a57a5a743894a0e4a801fc3','mobile',1,'Farman','1b5a29681efd595c1d8e6a3408c52e75');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `video_category_id` int NOT NULL,
  `url` varchar(250) NOT NULL,
  `thumbnail_img` varchar(250) NOT NULL,
  `user_id` int NOT NULL,
  `is_trending` int NOT NULL DEFAULT '0',
  `point` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,3,'c18d8e8ebdb2ad3a54fe45c8ba6d5753.mp4','5d2da5188293218ca8d98b8f6407c963.jpeg',1,1,0,'2020-05-19 03:43:13'),(2,4,'c18d8e8ebdb2ad3a54fe45c8ba6d5753.mp4','5d2da5188293218ca8d98b8f6407c963.jpeg',1,1,0,'2020-05-19 03:43:13');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_category`
--

DROP TABLE IF EXISTS `video_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
INSERT INTO `video_category` VALUES (3,'Marvel VS DC','d49bfff6654a5689e6972f59e7d85134.jpeg','2020-05-18 09:13:12'),(4,'Joker','fc3d1755f3aad43158342e5c67b2145b.png','2020-05-18 09:56:31'),(5,'Cat Woman','5335c43fd5bea67097e396a3f0d5a419.png','2020-05-18 09:56:51'),(6,'Avenger','2e62cc5f399b8c6262ec17151b01b0f7.jpeg','2020-05-18 09:57:06'),(7,'Justice League: The Flashpoint Paradox','2215d9c8d4024b787436d6a545992ec6.jfif','2020-05-18 09:57:52'),(8,'Justice League','961df17a6edf24c9f0a0e85e3259ae22.jfif','2020-05-18 09:58:22'),(9,'Spidy Vs Batman','dbf8dfa2894e447a086bfd015c75dd13.jfif','2020-05-18 09:58:39'),(10,'Captain Marvel','8a89d147fa58c50bf640ca856f6005c3.jfif','2020-05-18 09:59:02'),(11,'End Game','ce036e0d48236300c86e30c948bd4757.jfif','2020-05-18 09:59:26'),(12,'Marvel Super Women','29830a6c7093a9254eea6e6c5d88b192.jfif','2020-05-18 09:59:47'),(13,'Marvel Star Vs Batman','773ca85c8f84f16d91a0ac31bf5d9dfa.jpg','2020-05-18 10:00:24'),(14,'The avengers avengers: infinity war','6e0fc907a194b7360ad8e0619e9dbc44.jpg','2020-05-18 10:01:32'),(16,'Super Hero','5a95051ed05bd5bf33e1fd5b5d0a799d.jpg','2020-05-18 02:35:43');
/*!40000 ALTER TABLE `video_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-22 16:24:55
