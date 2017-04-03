CREATE DATABASE  IF NOT EXISTS `UMSJobAppDb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `UMSJobAppDb`;
-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: UMSJobAppDb
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `change_log`
--

DROP TABLE IF EXISTS `change_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `change_log` (
  `chl_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) NOT NULL,
  `chl_action` varchar(45) DEFAULT NULL,
  `chl_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `chl_row_before` varchar(1000) DEFAULT NULL,
  `chl_row_after` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`chl_id`),
  KEY `fk_changelog_users_fk_idx` (`usr_id`),
  CONSTRAINT `fk_changelog_users_fk` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store the changes in the users information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifier of the parameter',
  `par_string_value` varchar(45) DEFAULT NULL COMMENT 'String value for the parameter',
  `par_numeric_value` int(11) DEFAULT NULL COMMENT 'Numeric value of the parameter',
  `par_state` int(11) DEFAULT NULL COMMENT 'Parameter State',
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='This table store the globla parameters of the aplication';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `pru_id` int(11) NOT NULL AUTO_INCREMENT,
  `pru_name` varchar(45) DEFAULT NULL,
  `usr_id_create` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pru_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Store the System profiles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `register_log`
--

DROP TABLE IF EXISTS `register_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `register_log` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) NOT NULL,
  `request_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `response_date` datetime DEFAULT NULL,
  `hash` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`reg_id`),
  KEY `fk_register_log_user_idx` (`usr_id`),
  CONSTRAINT `fk_register_log_user` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store the register request and response';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `track_login`
--

DROP TABLE IF EXISTS `track_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `track_login` (
  `trk_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) NOT NULL,
  `pru_id` int(11) DEFAULT NULL,
  `trk_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trk_id`),
  KEY `fk_tracklogin_user_idx` (`usr_id`),
  CONSTRAINT `fk_tracklogin_user_fk` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store information about the login in the system by users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_first_name` varchar(50) DEFAULT NULL,
  `usr_last_name` varchar(50) DEFAULT NULL,
  `usr_full_name` varchar(100) DEFAULT NULL,
  `usr_email` varchar(150) NOT NULL,
  `usr_phone_number` varchar(45) DEFAULT NULL,
  `usr_password` varchar(200) NOT NULL,
  `usr_state` tinyint(1) DEFAULT '0',
  `pru_id` int(11) NOT NULL,
  `usr_grant_list` tinyint(1) DEFAULT NULL,
  `usr_creation_date` date DEFAULT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_email_UNIQUE` (`usr_email`),
  KEY `fk_user_profile_fk_idx` (`pru_id`),
  CONSTRAINT `fk_user_profile_fk` FOREIGN KEY (`pru_id`) REFERENCES `profile` (`pru_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Store the users of the system.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'UMSJobAppDb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-31 21:45:00
