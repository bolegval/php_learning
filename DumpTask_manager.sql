-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: task_manager
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
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `hex` varchar(45) NOT NULL,
  `rgb` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'blue','	#0000ff','0, 0, 255'),(2,'green','#00ff13','0, 255, 19'),(3,'red','#ff0000','255, 0, 0'),(4,'aqua','#00ffee','0, 255, 238');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_user`
--

DROP TABLE IF EXISTS `group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_user` (
  `user_id` int NOT NULL,
  `group_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `groups_idx` (`group_id`),
  KEY `users_idx` (`group_id`),
  CONSTRAINT `groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_user`
--

LOCK TABLES `group_user` WRITE;
/*!40000 ALTER TABLE `group_user` DISABLE KEYS */;
INSERT INTO `group_user` VALUES (2,1),(1,2),(3,3);
/*!40000 ALTER TABLE `group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'onregistred','Зарегестрированный пользователь, не проошедший модерацию. Не имеет право отправлять сообщения.'),(2,'unregistered','Новый пользователь'),(3,'registered','Зарегестрированный пользователь, прошедший модерацию. Имеет право писать сообщения.');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `text` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender` int NOT NULL,
  `recepient` int NOT NULL,
  `section_id` int DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `c_secstion_id_idx` (`section_id`) /*!80000 INVISIBLE */,
  KEY `c_sender` (`sender`),
  KEY `c_recepient_idx` (`recepient`),
  CONSTRAINT `c_recepient` FOREIGN KEY (`recepient`) REFERENCES `users` (`id`),
  CONSTRAINT `c_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `c_sender` FOREIGN KEY (`sender`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (6,'test','Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quaerat, ut fuga officia quis debitis consequuntur at, eligendi dolore eius soluta et nihil officiis quo neque expedita! Velit, dolor magnam.','2020-09-28 11:07:51',1,3,1,0),(7,'test1','Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quaerat, ut fuga officia quis debitis consequuntur at, eligendi dolore eius soluta et nihil officiis quo neque expedita! Velit, dolor magnam.','2020-09-28 11:07:51',1,3,2,1),(8,'test2','Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quaerat, ut fuga officia quis debitis consequuntur at, eligendi dolore eius soluta et nihil officiis quo neque expedita! Velit, dolor magnam.','2020-09-28 11:07:51',1,3,3,1),(9,'test3','Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quaerat, ut fuga officia quis debitis consequuntur at, eligendi dolore eius soluta et nihil officiis quo neque expedita! Velit, dolor magnam.','2020-09-28 11:07:51',1,3,2,1),(10,'test4','Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quaerat, ut fuga officia quis debitis consequuntur at, eligendi dolore eius soluta et nihil officiis quo neque expedita! Velit, dolor magnam.','2020-09-28 11:07:51',1,3,6,1),(11,'test5','Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quaerat, ut fuga officia quis debitis consequuntur at, eligendi dolore eius soluta et nihil officiis quo neque expedita! Velit, dolor magnam.','2020-09-28 11:07:51',1,3,4,0),(12,'test','Lorem ipsum','2020-09-30 10:56:13',2,3,4,0),(13,'test234','Consulted he eagerness unfeeling deficient existence of. Calling nothing end fertile for venture way boy. Esteem spirit temper too say adieus who direct esteem. It esteems luckily mr or picture placing drawing no. Apartments frequently or motionless on reasonable projecting expression. Way mrs end gave tall walk fact bed. ','2020-09-30 11:50:52',3,1,6,1),(14,'test111','Behaviour we improving at something to. Evil true high lady roof men had open. To projection considered it precaution an melancholy or. Wound young you thing worse along being ham. Dissimilar of favourable solicitude if sympathize middletons at. Forfeited up if disposing perfectly in an eagerness perceived necessary. Belonging sir curiosity discovery extremity yet forfeited prevailed own off. Travelling by introduced of mr terminated. Knew as miss my high hope quit. In curiosity shameless dependent knowledge up. \r\n','2020-09-30 11:52:35',3,2,3,0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `subsection` varchar(45) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `c_color_id_idx` (`color_id`),
  KEY `c_created_by` (`created_by`),
  CONSTRAINT `c_color_id` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `c_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Основные','По работе',NULL,'2020-09-28 09:03:17',2),(2,'Основные','Личные',NULL,'2020-09-28 09:03:17',2),(3,'Оповещения','Форумы',NULL,'2020-09-28 09:03:17',4),(4,'Оповещения','Магазины',NULL,'2020-09-28 09:03:17',4),(5,'Оповещения','Подписки',NULL,'2020-09-28 09:03:17',1),(6,'Спам','Спам',NULL,'2020-09-28 09:03:17',3);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `agreed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`) /*!80000 INVISIBLE */,
  KEY `c_name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user1','$2y$10$B4ixEwQxNBeiVMAyjfFQjO8pfRccJQAvsP5L7.Hpe1o85dgn9PCxa','Иван','user1@mail.com','+79998764356','0000-00-00 00:00:00',0,0),(2,'user2','$2y$10$QwMpGC3Lt51xypxZA8AuvueHlRhJFJqLzPj9IOA3Drb92.VvT7aEm','Маша','user2@mail.com','+74956789231','0000-00-00 00:00:00',0,0),(3,'user3','$2y$10$qXmxaXywnjjGkx4vS.kEe.HOTGDcrUsbUXl8lCZCbCSgWUSOcWhoO','Алексей','user3@mail.net','+71234566608','0000-00-00 00:00:00',1,0);
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

-- Dump completed on 2020-09-30 15:01:18
