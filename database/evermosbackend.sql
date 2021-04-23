# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: evermosbackend
# Generation Time: 2021-04-23 14:17:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table carts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `totalprice` decimal(12,2) DEFAULT NULL,
  `ispay` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;

INSERT INTO `carts` (`id`, `itemID`, `customerID`, `qty`, `price`, `totalprice`, `ispay`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,1,2,50000.00,100000.00,1,'2021-04-23 13:12:05','2021-04-23 13:56:03',NULL),
	(2,1,2,2,50000.00,100000.00,1,'2021-04-23 13:56:49','2021-04-23 13:57:02',NULL),
	(3,1,3,10,50000.00,500000.00,0,'2021-04-23 13:56:58','2021-04-23 13:56:58',NULL);

/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Aciel','aciel@gmail.com','082221215500',NULL,NULL,NULL),
	(2,'Rachel','rachel@gmail.com','089921819600',NULL,NULL,NULL),
	(3,'Evans','evan@gmail.com','0834514200',NULL,NULL,NULL);

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table deliveries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `deliveries`;

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceID` varchar(32) DEFAULT NULL,
  `itemID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `totalprice` decimal(12,2) DEFAULT NULL,
  `delivery_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;

INSERT INTO `deliveries` (`id`, `invoiceID`, `itemID`, `customerID`, `qty`, `price`, `totalprice`, `delivery_at`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'880246952c4e76886dec0c9e7b5996fc',1,1,2,50000.00,100000.00,'2021-04-23 13:56:11','2021-04-23 13:56:11','2021-04-23 13:56:11',NULL);

/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table histories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `histories`;

CREATE TABLE `histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `history_date` datetime DEFAULT NULL,
  `itemID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `totalprice` decimal(12,2) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `histories` WRITE;
/*!40000 ALTER TABLE `histories` DISABLE KEYS */;

INSERT INTO `histories` (`id`, `history_date`, `itemID`, `customerID`, `qty`, `price`, `totalprice`, `description`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'2021-04-23 13:12:05',1,1,1,50000.00,50000.00,'Add To Cart','2021-04-23 13:12:05','2021-04-23 13:12:05',NULL),
	(2,'2021-04-23 13:54:07',1,1,1,50000.00,50000.00,'Change Quantity to Cart','2021-04-23 13:54:07','2021-04-23 13:54:07',NULL),
	(3,'2021-04-23 13:56:03',1,1,2,50000.00,100000.00,'Create Invoice 880246952c4e76886dec0c9e7b5996fc','2021-04-23 13:56:03','2021-04-23 13:56:03',NULL),
	(4,'2021-04-23 13:56:11',1,1,2,50000.00,100000.00,'Order have been sent','2021-04-23 13:56:11','2021-04-23 13:56:11',NULL),
	(5,'2021-04-23 13:56:49',1,2,2,50000.00,100000.00,'Add To Cart','2021-04-23 13:56:49','2021-04-23 13:56:49',NULL),
	(6,'2021-04-23 13:56:58',1,3,10,50000.00,500000.00,'Add To Cart','2021-04-23 13:56:58','2021-04-23 13:56:58',NULL),
	(7,'2021-04-23 13:57:02',1,2,2,50000.00,100000.00,'Create Invoice 2703a719d7898f6bc9e7526719ed7798','2021-04-23 13:57:02','2021-04-23 13:57:02',NULL);

/*!40000 ALTER TABLE `histories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceID` varchar(32) DEFAULT NULL,
  `itemID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `totalprice` decimal(12,2) DEFAULT NULL,
  `isdelivery` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;

INSERT INTO `invoices` (`id`, `invoiceID`, `itemID`, `customerID`, `qty`, `price`, `totalprice`, `isdelivery`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'880246952c4e76886dec0c9e7b5996fc',1,1,2,50000.00,100000.00,1,'2021-04-23 13:56:03','2021-04-23 13:56:11',NULL),
	(2,'2703a719d7898f6bc9e7526719ed7798',1,2,2,50000.00,100000.00,0,'2021-04-23 13:57:02','2021-04-23 13:57:02',NULL);

/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;

INSERT INTO `items` (`id`, `itemname`, `description`, `image`, `price`, `stock`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Laptop #1','Item #1 Description',NULL,50000.00,13,NULL,'2021-04-23 13:56:11',NULL),
	(2,'Item #2','Item #2 Description',NULL,65000.00,10,NULL,NULL,NULL),
	(3,'Item #3','Item #3 Description',NULL,55000.00,10,NULL,NULL,NULL),
	(4,'Item #4','Item #4 Description',NULL,60000.00,10,NULL,NULL,NULL),
	(5,'Item #5','Item #5 Description',NULL,100000.00,10,NULL,NULL,NULL),
	(6,'Item #6','Item #6 Description',NULL,120000.00,10,NULL,NULL,NULL),
	(7,'Item #7','Item #7 Description',NULL,70000.00,10,NULL,NULL,NULL),
	(8,'Item #8','Item #8 Description',NULL,45000.00,10,NULL,NULL,NULL),
	(9,'Item #9','Item #9 Description',NULL,60000.00,10,NULL,NULL,NULL),
	(10,'Item #10','Item #10 Description',NULL,115000.00,10,NULL,NULL,NULL),
	(11,'Item #11','Item #11 Description',NULL,35000.00,10,NULL,NULL,NULL),
	(12,'Item #12','Item #12 Description',NULL,20000.00,10,NULL,NULL,NULL),
	(13,'Item #13','Item #13 Description',NULL,17500.00,10,NULL,NULL,NULL),
	(14,'Item #14','Item #14 Description',NULL,25000.00,10,NULL,NULL,NULL),
	(15,'Item #15','Item #15 Description',NULL,40000.00,10,NULL,NULL,NULL);

/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
