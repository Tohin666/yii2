-- MySQL dump 10.13  Distrib 5.7.20, for Win32 (AMD64)
--
-- Host: localhost    Database: yii2_db
-- ------------------------------------------------------
-- Server version	5.7.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user` (`user_id`),
  CONSTRAINT `fk_chat_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,NULL,'asdf'),(2,NULL,'[object Object]'),(3,NULL,'sdfgsdfgsdfg'),(4,1,'hhhhhhhhhh'),(5,NULL,'lllllllllllll'),(6,NULL,'ssssssssssss'),(7,3,'ddddddddddd'),(8,3,'xxxxxxxxx'),(9,3,'cccccccccccc'),(10,3,'bbbbbbbbb'),(11,3,'nnnnnnnnnnn'),(12,3,'mmmmmmmm'),(13,3,'rrrrrrrrrrrrrtt'),(14,3,'yyyyuuuuuuuuu');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_tasks` (`task_id`),
  KEY `fk_comments_user` (`user_id`),
  CONSTRAINT `fk_comments_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8 NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1549124065),('m130524_201442_init',1549124084),('m190205_052429_create_tasks_table',1549348770),('m190205_054956_create_task_statuses_table',1549348771),('m190205_064518_create_comments_table',1549349699),('m190205_065623_create_task_attachments_table',1549349926),('m190209_103740_create_chat_table',1549709059),('m190209_155811_create_task_chat_table',1549728522);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_attachments`
--

DROP TABLE IF EXISTS `task_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachments_tasks` (`task_id`),
  CONSTRAINT `fk_attachments_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_attachments`
--

LOCK TABLES `task_attachments` WRITE;
/*!40000 ALTER TABLE `task_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_chat`
--

DROP TABLE IF EXISTS `task_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `fk_task_chat_tasks` (`task_id`),
  KEY `fk_task_chat_user` (`user_id`),
  CONSTRAINT `fk_task_chat_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  CONSTRAINT `fk_task_chat_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_chat`
--

LOCK TABLES `task_chat` WRITE;
/*!40000 ALTER TABLE `task_chat` DISABLE KEYS */;
INSERT INTO `task_chat` VALUES (1,1,3,'1234'),(2,1,NULL,'4321');
/*!40000 ALTER TABLE `task_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_statuses`
--

DROP TABLE IF EXISTS `task_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_statuses`
--

LOCK TABLES `task_statuses` WRITE;
/*!40000 ALTER TABLE `task_statuses` DISABLE KEYS */;
INSERT INTO `task_statuses` VALUES (1,'Новая'),(2,'В работе'),(3,'Выполнена'),(4,'Тестирование'),(5,'Доработка'),(6,'Закрыта');
/*!40000 ALTER TABLE `task_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `responsible_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tasks_users_responsible` (`responsible_id`),
  KEY `fk_task_statuses` (`status`),
  CONSTRAINT `fk_task_statuses` FOREIGN KEY (`status`) REFERENCES `task_statuses` (`id`),
  CONSTRAINT `fk_tasks_users_responsible` FOREIGN KEY (`responsible_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'Новая задача','2019-02-07 00:00:00','Description',1,1,'2019-02-06 11:17:35','2019-02-06 11:17:35'),(2,'Еще одна задача','2019-02-07 00:00:00','sdfasdf asdfasdf',2,1,'2019-02-06 11:19:13','2019-02-06 11:19:13'),(3,'New','2019-02-08 00:00:00','Описание',3,1,'2019-02-06 11:19:47','2019-02-06 11:19:47'),(4,'Test Task 3835','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:23:57','2019-02-07 15:23:57'),(5,'Test Task 740','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:27:01','2019-02-07 15:27:01'),(6,'New222','2019-01-24 00:00:00','Description',1,1,'2019-02-07 15:28:13','2019-02-07 15:28:13'),(7,'Test Task 3057','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:30:00','2019-02-07 15:30:00'),(8,'Test Task 390','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:31:24','2019-02-07 15:31:24'),(9,'Test Task 8376','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:37:26','2019-02-07 15:37:26'),(10,'Test Task 1237','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:39:33','2019-02-07 15:39:33'),(11,'Test Task 6432','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:50:59','2019-02-07 15:50:59'),(12,'Test Task 6422','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:52:19','2019-02-07 15:52:19');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','h5BeTrFChp_VvFI_IUrGmBvYwIrhc38d','$2y$13$vZy39YyOwBW7Rw9POBT1me8lGSIy5DZ5jp.CkgJaYkC3wW1v0/HyK',NULL,'admin@admin.ru',10,1549541983,1549541983),(2,'user','nUTUREWU8Cn0Ds3DmxNr2YsrOkHZqyk3','$2y$13$3rgLr0pM7PYD7ryfah0g5OHJ8SKEEH5/h77Bhe9n7bvk8teGxdpyi',NULL,'user@mail.ru',10,1549542045,1549542045),(3,'Vasya','2t_VYPWTjz4ELLZ2WlIpV81ZT98iWScs','$2y$13$kQ4qgFzDWncMej/YubJw3exQRVO4NGBaydypPN5gaKOqIbPmzWCF2',NULL,'vasya@mail.ru',10,1549542068,1549542068);
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

-- Dump completed on 2019-02-09 20:34:21
