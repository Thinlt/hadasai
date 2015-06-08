CREATE DATABASE  IF NOT EXISTS `findnex` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `findnex`;
-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: findnex
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.10.1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `group` varchar(255) NOT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `update_date` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (2,'tungpds','Pham Do Son Tung','0ea05287b1600c667edf2e5dacfc46bf','tungpds@gmail.com',NULL,NULL,'Admin',1,1,1433668900,1433668913,1),(3,'root','Root','0ea05287b1600c667edf2e5dacfc46bf','root@gmail.com',NULL,NULL,'Root',1,NULL,1433668991,NULL,1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

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
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('Admin','2',1433668914),('Root','3',1433668991);
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
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
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
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1433512189,1433512189),('/admin/*',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/assignment/*',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/assignment/assign',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/assignment/index',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/assignment/search',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/assignment/view',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/default/*',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/default/index',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/menu/*',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/menu/create',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/menu/delete',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/menu/index',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/menu/update',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/menu/view',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/permission/*',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/permission/assign',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/permission/create',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/permission/delete',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/permission/index',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/permission/search',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/permission/update',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/permission/view',2,NULL,NULL,NULL,1433512187,1433512187),('/admin/role/*',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/assign',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/create',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/delete',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/index',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/search',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/update',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/role/view',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/route/*',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/route/assign',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/route/create',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/route/index',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/route/search',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/rule/*',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/rule/create',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/rule/delete',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/rule/index',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/rule/update',2,NULL,NULL,NULL,1433512188,1433512188),('/admin/rule/view',2,NULL,NULL,NULL,1433512188,1433512188),('/category/*',2,NULL,NULL,NULL,1433671561,1433671561),('/category/create',2,NULL,NULL,NULL,1433671560,1433671560),('/category/delete',2,NULL,NULL,NULL,1433671560,1433671560),('/category/detail',2,NULL,NULL,NULL,1433671560,1433671560),('/category/index',2,NULL,NULL,NULL,1433671560,1433671560),('/debug/*',2,NULL,NULL,NULL,1433512189,1433512189),('/debug/default/*',2,NULL,NULL,NULL,1433512189,1433512189),('/debug/default/download-mail',2,NULL,NULL,NULL,1433512189,1433512189),('/debug/default/index',2,NULL,NULL,NULL,1433512189,1433512189),('/debug/default/toolbar',2,NULL,NULL,NULL,1433512189,1433512189),('/debug/default/view',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/*',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/default/*',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/default/action',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/default/diff',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/default/index',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/default/preview',2,NULL,NULL,NULL,1433512189,1433512189),('/gii/default/view',2,NULL,NULL,NULL,1433512189,1433512189),('/site/*',2,NULL,NULL,NULL,1433512189,1433512189),('/site/error',2,NULL,NULL,NULL,1433512189,1433512189),('/site/index',2,NULL,NULL,NULL,1433512189,1433512189),('/site/login',2,NULL,NULL,NULL,1433512189,1433512189),('/site/logout',2,NULL,NULL,NULL,1433512189,1433512189),('/user/*',2,NULL,NULL,NULL,1433512189,1433512189),('/user/create',2,NULL,NULL,NULL,1433512189,1433512189),('/user/delete',2,NULL,NULL,NULL,1433512189,1433512189),('/user/index',2,NULL,NULL,NULL,1433512189,1433512189),('/user/login',2,NULL,NULL,NULL,1433512189,1433512189),('/user/logout',2,NULL,NULL,NULL,1433512189,1433512189),('/user/update',2,NULL,NULL,NULL,1433512189,1433512189),('Admin',1,'Admin',NULL,NULL,1433512751,1433512751),('Debug',2,'Debug',NULL,NULL,1433512679,1433512679),('Gii',2,'Gii',NULL,NULL,1433512656,1433512656),('Manage Admin',2,'Manage Admin, permission',NULL,NULL,1433512488,1433512488),('Manage Content',2,'Manage Content',NULL,NULL,1433671544,1433671594),('Member',2,'Login, logout',NULL,NULL,1433512420,1433512420),('Root',1,'Full permisssion',NULL,NULL,1433512728,1433512728);
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
INSERT INTO `auth_item_child` VALUES ('Manage Admin','/admin/*'),('Manage Admin','/admin/assignment/*'),('Manage Admin','/admin/assignment/assign'),('Manage Admin','/admin/assignment/index'),('Manage Admin','/admin/assignment/search'),('Manage Admin','/admin/assignment/view'),('Manage Admin','/admin/default/*'),('Manage Admin','/admin/default/index'),('Manage Admin','/admin/menu/*'),('Manage Admin','/admin/menu/create'),('Manage Admin','/admin/menu/delete'),('Manage Admin','/admin/menu/index'),('Manage Admin','/admin/menu/update'),('Manage Admin','/admin/menu/view'),('Manage Admin','/admin/permission/*'),('Manage Admin','/admin/permission/assign'),('Manage Admin','/admin/permission/create'),('Manage Admin','/admin/permission/delete'),('Manage Admin','/admin/permission/index'),('Manage Admin','/admin/permission/search'),('Manage Admin','/admin/permission/update'),('Manage Admin','/admin/permission/view'),('Manage Admin','/admin/role/*'),('Manage Admin','/admin/role/assign'),('Manage Admin','/admin/role/create'),('Manage Admin','/admin/role/delete'),('Manage Admin','/admin/role/index'),('Manage Admin','/admin/role/search'),('Manage Admin','/admin/role/update'),('Manage Admin','/admin/role/view'),('Manage Admin','/admin/route/*'),('Manage Admin','/admin/route/assign'),('Manage Admin','/admin/route/create'),('Manage Admin','/admin/route/index'),('Manage Admin','/admin/route/search'),('Manage Admin','/admin/rule/*'),('Manage Admin','/admin/rule/create'),('Manage Admin','/admin/rule/delete'),('Manage Admin','/admin/rule/index'),('Manage Admin','/admin/rule/update'),('Manage Admin','/admin/rule/view'),('Manage Content','/category/*'),('Manage Content','/category/create'),('Manage Content','/category/delete'),('Manage Content','/category/detail'),('Manage Content','/category/index'),('Debug','/debug/*'),('Debug','/debug/default/*'),('Debug','/debug/default/download-mail'),('Debug','/debug/default/index'),('Debug','/debug/default/toolbar'),('Debug','/debug/default/view'),('Gii','/gii/*'),('Gii','/gii/default/*'),('Gii','/gii/default/action'),('Gii','/gii/default/diff'),('Gii','/gii/default/index'),('Gii','/gii/default/preview'),('Gii','/gii/default/view'),('Member','/site/*'),('Member','/site/error'),('Member','/site/index'),('Member','/site/login'),('Member','/site/logout'),('Manage Admin','/user/*'),('Member','/user/*'),('Manage Admin','/user/create'),('Manage Admin','/user/delete'),('Manage Admin','/user/index'),('Manage Admin','/user/login'),('Member','/user/login'),('Manage Admin','/user/logout'),('Member','/user/logout'),('Manage Admin','/user/update'),('Root','Debug'),('Root','Gii'),('Admin','Manage Admin'),('Root','Manage Admin'),('Admin','Manage Content'),('Root','Manage Content'),('Admin','Member'),('Root','Member');
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
  `data` text COLLATE utf8_unicode_ci,
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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `user_create` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  `user_update` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `intro` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1433477403),('m140506_102106_rbac_init',1433477859);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-08 19:19:52
