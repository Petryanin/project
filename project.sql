-- MySQL dump 10.13  Distrib 8.0.23, for osx10.15 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `addr_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`addr_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (3,22,'Baker st. 221B, England, UK'),(4,22,'Уральская 3, Калининград, Россия'),(7,22,'Иванихиной 16, Калининград, Россия'),(9,14,'252 Rogahn Pike East Trevion, SD 28614'),(13,23,'67232 Cruz Mount Apt. 900 South Rossstad'),(14,8,'г. Калининград ул. Кирова 28');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalog`
--

DROP TABLE IF EXISTS `catalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catalog` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'Без названия',
  `author` varchar(255) DEFAULT NULL,
  `pubyear` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalog`
--

LOCK TABLES `catalog` WRITE;
/*!40000 ALTER TABLE `catalog` DISABLE KEYS */;
INSERT INTO `catalog` VALUES (6,'Тихий Дон','Михаил Шолохов',2016,490),(7,'Гарри Поттер и Узник Азкабана','Дж.К. Роулинг',2010,550),(8,'Война и мир','Л.Н. Толстой',2015,340),(9,'Преступление и наказание','Фёдор Достоевский',2016,480),(10,'Гордость и предубеждение','Джейн Остен',2014,390),(11,'Отцы и дети','И.С. Тургенев',2015,280),(12,'Хоббит или туда и обратно','Дж.Р.Р. Толкин',2011,300),(13,'451 градус по Фаренгейту','Рэй Брэдбери',1953,280),(14,'Автостопом по Галактике','Дуглас Адамс',1979,660);
/*!40000 ALTER TABLE `catalog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msgs`
--

DROP TABLE IF EXISTS `msgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `msgs` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `msg` text,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `msgs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msgs`
--

LOCK TABLES `msgs` WRITE;
/*!40000 ALTER TABLE `msgs` DISABLE KEYS */;
INSERT INTO `msgs` VALUES (7,8,'Привет, мир!','2021-03-10 20:37:56'),(11,15,'Блин Шершняга внатуре юноу нахрен!','2021-03-12 12:33:39'),(12,22,'Elementary, my dear Watson!','2021-03-13 17:03:14'),(13,14,'Hey there!','2021-03-13 20:38:33'),(14,23,'The effort to be free seems pointless from above','2021-03-16 13:35:34');
/*!40000 ALTER TABLE `msgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `order_id` varchar(50) NOT NULL DEFAULT '',
  `datetime` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `catalog` (`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'alex','alex@alex.ru','8931729846127','$2y$10$aDDZq1aTakQjdzlIcrmw9.AniS3RANeHE1/o2AR5r0xVPly/om6RO',NULL),(2,'mike','mike@mike.com','123986187246','$2y$10$iztyjvsmcugaq7P0UN4xsOXLl6RZXjxc/vkAAhc8C9Gn1ZXSKoSbm',NULL),(3,'Nick','nick@nick.ru','8127398123098','$2y$10$Ksna0xmELe0DBWgE7lb5seTFIwI7StMBwl/j5fb1Qzq89/v4kCPk.',NULL),(4,'George','GeOrge@gER.som','235243642','$2y$10$JV6cdV1D5lk7FONViRe9YuQTXKAjAR3Is919cdvWpb7QJTvvsfHbC',NULL),(5,'Bob','bob@bob.bob','1231425','$2y$10$Axt63IiMP8rx/Qs8KYh98ehqZYRzcedMnc1OBKlRdyb3Z1.SdVWve',NULL),(7,'ron','ron@ron.ron','12434124123','$2y$10$FQVnj4PTT03SoKi7YJEbeuYy8JklCyu97FrfMQhLQbvkaG/ZlHmnG',NULL),(8,'Tom','tom@tom.tom','12345','$2y$10$oSUsVnkfBCn4eL5qi/t2Ie5deiJCuppjy7HiMiJ2K.xb4Rx8FrnBi',NULL),(11,'Carl','carl@carl.carl','24141415','$2y$10$xShPrb2W0nIrG1AtXXuVC.hr9fRzwtdseKjoAXtuywoYS57Na5ODm',NULL),(12,'jack','jack@jack.org','142142141512','$2y$10$ID2Mvd3PYXYM.7LvTO2KveCvkoslPdFncpXkybbKTFDGdgN7oI7Ea',NULL),(13,'Roman','rom@rom.rom','314693847','$2y$10$q/VGTouQFNOY4cy.YEq6T.09BW/mLDAPuEQJDsH0t4BNB3AGVFogq',NULL),(14,'james','james@james.james','4235234','$2y$10$/BGTiU7V/OG29hMWGvS16.UhpYpwbZJU7hfdObzXB3kmTSUIvNHVe',NULL),(15,'Dora','dora@dura.dr','18347623597','$2y$10$1P31.s0IlF5FB7Npg7UeVOILGYyMF4QxIeJysEPpc02drBsZg.9zW',NULL),(17,'John Doe','john@doe.net','12345678','$2y$10$pYRu9oozzkHaI4vOaJtiZeo/cVc3YNLIto1sG2yhfdWvUDF2kqzC.',NULL),(22,'sherlock_holmes','sher@lock.holmes','1234567890','$2y$10$p/5DR63tKJAc2uAgbcLVg.//QH8F/LQ2TPwAjS1oQR9.63Sipfjs6',1),(23,'John Frusciante','frusciante@rhcp.world','11111111111111','$2y$10$xiJegU8B2QvqBY.ib23M2OwgZ/yP7zg4iH61IDxyxXSHN.i.D1HSq',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-23 21:53:43
