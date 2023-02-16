-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mls
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

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
-- Table structure for table `mls_banned`
--

DROP TABLE IF EXISTS `mls_banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_banned` (
  `userid` int(11) NOT NULL,
  `until` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_banned`
--

LOCK TABLES `mls_banned` WRITE;
/*!40000 ALTER TABLE `mls_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `mls_banned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_ftp`
--

DROP TABLE IF EXISTS `mls_ftp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_ftp` (
  `ftpuser` varchar(255) DEFAULT NULL,
  `ftppass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_ftp`
--

LOCK TABLES `mls_ftp` WRITE;
/*!40000 ALTER TABLE `mls_ftp` DISABLE KEYS */;
INSERT INTO `mls_ftp` VALUES ('demo','demo');
/*!40000 ALTER TABLE `mls_ftp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_groups`
--

DROP TABLE IF EXISTS `mls_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `canban` int(11) NOT NULL,
  `canhideavt` int(11) NOT NULL,
  `canedit` int(11) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_groups`
--

LOCK TABLES `mls_groups` WRITE;
/*!40000 ALTER TABLE `mls_groups` DISABLE KEYS */;
INSERT INTO `mls_groups` VALUES (1,'Guest',0,1,'',0,0,0),(2,'Member',1,1,'#08c',0,0,0),(3,'Moderator',2,1,'green',1,1,0),(4,'Administrator',3,1,'#F0A02D',1,1,1);
/*!40000 ALTER TABLE `mls_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_privacy`
--

DROP TABLE IF EXISTS `mls_privacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_privacy` (
  `userid` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_privacy`
--

LOCK TABLES `mls_privacy` WRITE;
/*!40000 ALTER TABLE `mls_privacy` DISABLE KEYS */;
INSERT INTO `mls_privacy` VALUES (1,0),(14,0),(15,0),(16,0),(17,0),(18,0),(19,0),(20,0),(21,0);
/*!40000 ALTER TABLE `mls_privacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_settings`
--

DROP TABLE IF EXISTS `mls_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_settings` (
  `site_name` varchar(255) NOT NULL DEFAULT 'Demo Site',
  `url` varchar(300) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `max_ban_period` int(11) NOT NULL DEFAULT '10',
  `register` int(11) NOT NULL DEFAULT '1',
  `email_validation` int(11) NOT NULL DEFAULT '0',
  `captcha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_settings`
--

LOCK TABLES `mls_settings` WRITE;
/*!40000 ALTER TABLE `mls_settings` DISABLE KEYS */;
INSERT INTO `mls_settings` VALUES ('Gemini Inc v2','http://172.16.6.186','nor.reply@gmail.com',10,1,1,1);
/*!40000 ALTER TABLE `mls_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_users`
--

DROP TABLE IF EXISTS `mls_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `validated` varchar(100) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT '2',
  `lastactive` int(11) NOT NULL,
  `showavt` int(11) NOT NULL DEFAULT '1',
  `banned` int(11) NOT NULL,
  `regtime` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_users`
--

LOCK TABLES `mls_users` WRITE;
/*!40000 ALTER TABLE `mls_users` DISABLE KEYS */;
INSERT INTO `mls_users` VALUES (1,'Gemini','9emin1','edbd1887e772e13c251f688a5f10c1ffbb67960d','sec.9emin1@gmail.com',NULL,'1',4,1646307553,1,0,1515573050),(14,'torugoav','TorugoAV','94e25b1b16944798535dd2655e038864a4a8fc42','torugoav@gmail.com','000511','1',2,1646240242,1,0,1646239522),(15,'xjao','xjao','0d2bbeae8580d9ef55cec7033f5e39c19c3de58a','xjao@gmail.com','000512','1',2,1646241141,1,0,1646241141),(17,'rickastley','Rick Astley','57a6badb18684406b4924615b550f4dad93ba3b7','rickastley@gmail.com','000512','0',2,1646241682,1,0,1646241682),(18,'ippsec','PleaseSubscribe','38f367203342e083a46db219c86c53d73d9e524d','ippsec@gmail.com','000512','0',2,1646241749,1,0,1646241749),(20,'jader','jader','e1ff36d24924869ba3bdb3121185ca56fb8fe306','jader@gmail.com','000512','0',2,1646242862,1,0,1646242862),(21,'hacker','Hackerman','4dcc4173d80a2817206e196a38f0dbf7850188ff','hacker@gmail.com','000512','1',2,1646307097,1,0,1646306291);
/*!40000 ALTER TABLE `mls_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-13  7:35:07
