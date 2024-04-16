/*
SQLyog Enterprise - MySQL GUI v7.15 
MySQL - 5.5.24-log : Database - fechs3
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`fechs3` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fechs3`;

/*Table structure for table `project_permissions` */

DROP TABLE IF EXISTS `project_permissions`;

CREATE TABLE `project_permissions` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) DEFAULT NULL,
  `project_id` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `project_permissions` */

insert  into `project_permissions`(`id`,`user_id`,`project_id`) values (1,1,1),(10,1,2),(11,1,3),(13,11,3),(14,11,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
