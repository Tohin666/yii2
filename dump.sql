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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin','1',1550033489),('moderator','2',1550033489),('user','10',1550036438),('user','11',1550036834),('user','3',1550034214),('user','7',1550034742),('user','8',1550035530),('user','9',1550035737);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,NULL,NULL,NULL,1550033488,1550033488),('moderator',1,NULL,NULL,NULL,1550033489,1550033489),('TaskCreate',2,NULL,NULL,NULL,1550033489,1550033489),('TaskDelete',2,NULL,NULL,NULL,1550033489,1550033489),('TaskEdit',2,NULL,NULL,NULL,1550033489,1550033489),('user',1,NULL,NULL,NULL,1550034214,1550034214);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','TaskCreate'),('moderator','TaskCreate'),('user','TaskCreate'),('admin','TaskDelete'),('admin','TaskEdit'),('moderator','TaskEdit');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,1,'камент','','2019-02-13 11:18:57','2019-02-13 11:18:57'),(2,1,1,'второй камент','','2019-02-13 11:20:40','2019-02-13 11:20:40'),(3,1,1,'третий камент','','2019-02-13 11:21:53','2019-02-13 11:21:53'),(4,1,1,'444444444','','2019-02-13 11:25:02','2019-02-13 11:25:02'),(5,1,1,'555555555',NULL,'2019-02-13 11:27:33','2019-02-13 11:27:33'),(6,2,1,'ывафываыва',NULL,'2019-02-13 11:28:31','2019-02-13 11:28:31'),(7,2,1,'2222222222',NULL,'2019-02-13 11:31:41','2019-02-13 11:31:41'),(8,2,1,'333333333333333',NULL,'2019-02-13 11:35:00','2019-02-13 11:35:00'),(9,2,1,'44444',NULL,'2019-02-13 11:41:31','2019-02-13 11:41:31'),(10,2,1,'555',NULL,'2019-02-13 11:42:57','2019-02-13 11:42:57'),(11,2,1,'666',NULL,'2019-02-13 11:50:59','2019-02-13 11:50:59'),(12,3,1,'111111111111',NULL,'2019-02-13 11:51:54','2019-02-13 11:51:54'),(13,3,1,'222222222',NULL,'2019-02-13 11:52:39','2019-02-13 11:52:39'),(14,3,1,'3333333',NULL,'2019-02-13 11:52:46','2019-02-13 11:52:46'),(15,3,2,'4444444',NULL,'2019-02-15 10:59:29','2019-02-15 10:59:29'),(16,3,2,'5555',NULL,'2019-02-15 11:06:10','2019-02-15 11:06:10'),(17,3,2,'666',NULL,'2019-02-15 11:06:17','2019-02-15 11:06:17'),(18,3,2,'77',NULL,'2019-02-15 11:06:44','2019-02-15 11:06:44');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'message1','dfasdfasdfsd',1),(2,'message2','wqerqwerqwerwqer',1),(4,'message4','оааоал',2);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
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
INSERT INTO `migration` VALUES ('m000000_000000_base',1549124065),('m130524_201442_init',1549124084),('m140506_102106_rbac_init',1550000608),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1550000608),('m180523_151638_rbac_updates_indexes_without_prefix',1550000608),('m190205_052429_create_tasks_table',1549348770),('m190205_054956_create_task_statuses_table',1549348771),('m190205_064518_create_comments_table',1549349699),('m190205_065623_create_task_attachments_table',1549349926),('m190209_103740_create_chat_table',1549709059),('m190209_155811_create_task_chat_table',1549728522),('m190216_073912_create_telegram_offset_table',1550302912),('m190216_112829_create_telegram_subscribe_table',1550316625),('m190216_120659_create_task_projects_table',1550319394),('m190219_071451_create_message_table',1550560863),('m190222_073828_add_access_token_column_to_user_table',1550821287),('m190301_051120_add_administrator_id_column_to_tasks_table',1551417636),('m190303_065834_create_task_project_users_table',1551596818);
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_attachments`
--

LOCK TABLES `task_attachments` WRITE;
/*!40000 ALTER TABLE `task_attachments` DISABLE KEYS */;
INSERT INTO `task_attachments` VALUES (13,1,'fRMAXrZOewvf.png'),(14,2,'1odepelvhjsp.jpg'),(20,2,'tMpgRVb1Qbr5.jpg'),(21,2,'94QrT0EcoULf.png'),(22,3,'13dpwsplVl_G.jpg'),(23,3,'xTdNytOSK8Ar.jpg'),(24,3,'-KDSKWYvGTNu.jpg'),(25,3,'uhvhaYKX2ZA4.png'),(26,3,'o4pCGR9nIrcQ.jpg');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_chat`
--

LOCK TABLES `task_chat` WRITE;
/*!40000 ALTER TABLE `task_chat` DISABLE KEYS */;
INSERT INTO `task_chat` VALUES (1,1,3,'1234'),(2,1,NULL,'4321'),(3,1,NULL,'5554443333'),(4,1,NULL,'666'),(5,1,NULL,'777'),(6,1,2,'9999'),(7,1,2,'000'),(8,1,NULL,'aaaaaaaaa'),(9,1,1,'lllllllllllll'),(10,1,NULL,'uuuuuuuuuuuu'),(11,2,NULL,'wwwwwwwwww'),(12,1,NULL,'eeeeeeeeeee'),(13,2,NULL,'sssssss');
/*!40000 ALTER TABLE `task_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_project_users`
--

DROP TABLE IF EXISTS `task_project_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_project_users` (
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `fk_task_project` (`project_id`),
  KEY `fk_task_project_user` (`user_id`),
  CONSTRAINT `fk_task_project` FOREIGN KEY (`project_id`) REFERENCES `task_projects` (`id`),
  CONSTRAINT `fk_task_project_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_project_users`
--

LOCK TABLES `task_project_users` WRITE;
/*!40000 ALTER TABLE `task_project_users` DISABLE KEYS */;
INSERT INTO `task_project_users` VALUES (1,1),(1,2),(1,3);
/*!40000 ALTER TABLE `task_project_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_projects`
--

DROP TABLE IF EXISTS `task_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_projects`
--

LOCK TABLES `task_projects` WRITE;
/*!40000 ALTER TABLE `task_projects` DISABLE KEYS */;
INSERT INTO `task_projects` VALUES (1,'New Project'),(2,'New Project 2'),(3,'New Project 3'),(5,'New Project 4'),(6,'New Project 5'),(7,'New Project 6'),(8,'New Project 7'),(9,'New Project 9'),(10,'New Project 10'),(11,'New Project 11'),(12,'New Project 12'),(13,'New Project 17'),(14,'New Project 18'),(16,'New Project 19'),(17,'New Project 20'),(18,'New Project 21'),(19,'TelegramProject'),(20,'Super New Project');
/*!40000 ALTER TABLE `task_projects` ENABLE KEYS */;
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
  `project_id` int(11) DEFAULT NULL,
  `administrator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tasks_users_responsible` (`responsible_id`),
  KEY `fk_task_statuses` (`status`),
  KEY `fk_tasks_projects` (`project_id`),
  KEY `fk_tasks_user_administrator` (`administrator_id`),
  CONSTRAINT `fk_task_statuses` FOREIGN KEY (`status`) REFERENCES `task_statuses` (`id`),
  CONSTRAINT `fk_tasks_projects` FOREIGN KEY (`project_id`) REFERENCES `task_projects` (`id`),
  CONSTRAINT `fk_tasks_user_administrator` FOREIGN KEY (`administrator_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_tasks_users_responsible` FOREIGN KEY (`responsible_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'Новая задача','2019-03-04 00:00:00','Description666',1,2,'2019-02-06 11:17:35','2019-03-03 09:14:10',1,1),(2,'Еще одна задача','2019-02-10 12:00:00','sdfasdf asdfasdf3',3,1,'2019-02-06 11:19:13','2019-02-15 10:19:51',2,NULL),(3,'New','2019-02-08 00:00:00','Описание3',2,2,'2019-02-06 11:19:47','2019-02-15 11:06:23',3,NULL),(4,'Test Task 3835','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:23:57','2019-02-07 15:23:57',5,NULL),(5,'Test Task 740','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:27:01','2019-02-07 15:27:01',6,NULL),(6,'New222','2019-01-24 00:00:00','Description',1,1,'2019-02-07 15:28:13','2019-02-07 15:28:13',7,NULL),(7,'Test Task 3057','2019-02-07 00:00:00','Test description',1,3,'2019-02-07 15:30:00','2019-03-01 08:47:46',1,1),(9,'Test Task 8376','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:37:26','2019-02-07 15:37:26',2,NULL),(10,'Test Task 1237','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:39:33','2019-02-07 15:39:33',3,NULL),(11,'Test Task 6432','2019-02-07 00:00:00','Test description',1,1,'2019-02-07 15:50:59','2019-02-07 15:50:59',5,NULL),(12,'Test Task 6422','2019-02-07 00:00:00','Test description',1,3,'2019-02-07 15:52:19','2019-03-03 09:17:51',6,1),(13,'Суперновая задача','2019-02-14 14:30:00','фывафываыв ывафываыв',7,4,'2019-02-12 22:19:26','2019-02-12 22:28:20',7,NULL),(14,'New10','2019-02-18 09:05:00','fgasdg',1,1,'2019-02-17 09:08:41','2019-02-17 09:08:41',10,NULL),(16,'New12','2019-02-19 13:25:00','qqqqqqqqq',1,1,'2019-02-17 09:23:51','2019-02-17 09:23:51',12,NULL),(17,'TelegramTask','2019-02-18 15:43:46','No description',1,1,'2019-02-18 15:43:46','2019-02-18 15:43:46',19,NULL),(18,'REST задача','2019-02-10 12:00:00','rrrrrrrrrrr',3,2,'2019-02-20 10:19:48','2019-02-20 10:21:05',2,NULL),(19,'Super New Task','2019-03-03 08:40:00','this is Super New Task',7,1,'2019-03-01 08:41:50','2019-03-01 08:41:50',20,1);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telegram_offset`
--

DROP TABLE IF EXISTS `telegram_offset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telegram_offset` (
  `id` int(11) DEFAULT NULL,
  `timestamp_offset` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telegram_offset`
--

LOCK TABLES `telegram_offset` WRITE;
/*!40000 ALTER TABLE `telegram_offset` DISABLE KEYS */;
INSERT INTO `telegram_offset` VALUES (728952743,'2019-02-16 10:17:32'),(728952744,'2019-02-16 11:07:00'),(728952745,'2019-02-16 11:16:46'),(728952746,'2019-02-16 11:20:14'),(728952747,'2019-02-16 11:20:39'),(728952748,'2019-02-16 11:45:51'),(728952749,'2019-02-18 12:07:23'),(728952750,'2019-02-18 12:07:23'),(728952751,'2019-02-18 12:09:39'),(728952752,'2019-02-18 12:11:26'),(728952753,'2019-02-18 12:12:07'),(728952754,'2019-02-18 12:19:23'),(728952755,'2019-02-18 12:21:00'),(728952756,'2019-02-18 12:42:44'),(728952757,'2019-02-18 12:43:46');
/*!40000 ALTER TABLE `telegram_offset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telegram_subscribe`
--

DROP TABLE IF EXISTS `telegram_subscribe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telegram_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telegram_subscribe`
--

LOCK TABLES `telegram_subscribe` WRITE;
/*!40000 ALTER TABLE `telegram_subscribe` DISABLE KEYS */;
INSERT INTO `telegram_subscribe` VALUES (1,299738950,'projects_create');
/*!40000 ALTER TABLE `telegram_subscribe` ENABLE KEYS */;
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
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `access_token` (`access_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','h5BeTrFChp_VvFI_IUrGmBvYwIrhc38d','$2y$13$vZy39YyOwBW7Rw9POBT1me8lGSIy5DZ5jp.CkgJaYkC3wW1v0/HyK',NULL,'admin@admin.ru',10,1549541983,1549541983,'111'),(2,'user','nUTUREWU8Cn0Ds3DmxNr2YsrOkHZqyk3','$2y$13$3rgLr0pM7PYD7ryfah0g5OHJ8SKEEH5/h77Bhe9n7bvk8teGxdpyi',NULL,'user@mail.ru',10,1549542045,1549542045,NULL),(3,'Vasya','2t_VYPWTjz4ELLZ2WlIpV81ZT98iWScs','$2y$13$kQ4qgFzDWncMej/YubJw3exQRVO4NGBaydypPN5gaKOqIbPmzWCF2',NULL,'vasya@mail.ru',10,1549542068,1549542068,NULL),(7,'Marusya','9jwUM1wn_Hsna_QWqczDQ6UezTRzTMrt','$2y$13$bxww3I7FvcMLE/uLjCj/0.RY6sBHq.Ums6ox3IpAIss/.NXT2OUMG',NULL,'marusya@mail.ru',10,1550034742,1550034742,NULL),(8,'Filya','YpDUkfZX5yMWPFMPTYg9HhmI71qPZO8k','$2y$13$kkHz8O8mD2JZucxIF7f2J.rfIt2VNRNq9CHDtSXLcnq5iU0E9J2Z6',NULL,'filya@prostofilya.ru',10,1550035530,1550035530,NULL),(9,'Petya','nVdpX7ptfLWJ1xdsXVVMBxcTiU-gscCk','$2y$13$Rp1VtS88gdnw4v2.jLGUe.0zvqrNxfvnJ8GUZP46gKfa3hbfB4Hua',NULL,'petya@mail.ru',10,1550035737,1550035737,NULL),(10,'Vanya','w56v2FY_4uueCfEDTtFwOfg3SNzk7FTg','$2y$13$f/tz1WTcxayuP53B5QVIouv81UwfGviw45TfsRAyalIUQnp.UuTTm',NULL,'vanya@mail.ru',10,1550036438,1550036438,NULL),(11,'Tohin','-PC255o0WiOkcDVLiNt0WqBMtsfLK7Cv','$2y$13$EVliRxpcdD7AIT2mggeSnO1.aDdldLUsnwRXhipgr.tFMmi9nJL.q',NULL,'tohin666@gmail.com',10,1550036834,1550036834,NULL);
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

-- Dump completed on 2019-03-04  7:50:10
