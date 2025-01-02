# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: dedi6205.your-server.de (MySQL 5.5.5-10.11.6-MariaDB-hetzner1)
# Base de datos: stripn_db1
# Tiempo de Generación: 2025-01-02 12:15:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla blog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blogId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`blogId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;

INSERT INTO `blog` (`blogId`, `slug`, `title`, `meta_title`, `meta_description`, `body`, `created`, `updated`)
VALUES
	(1,'hosting-for-saas','Hosting for your SaaS','','','HOSTING FOR YOUR SAAS\r\nGet Hosting for your SaaS at Hetzner for $2/month (you can upgrade later). 10Gb disk space, unlimited traffic, FTP, SMTP, SSL.\r\nAll the infrastructure you need to start your SaaS for $2/month.\r\nHetzner doesn\'t have any affiliate program, no comission. It is the recommended hosting service for Stripe Pad projects\r\n','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'test','test','','','test','2025-01-01 14:31:35','2025-01-01 14:31:35');

/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla crons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `crons`;

CREATE TABLE `crons` (
  `cronsId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `output` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `last` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cronsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `invoicesId` varchar(9) NOT NULL DEFAULT '',
  `period` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stripe_payment_id` int(11) DEFAULT NULL,
  `usersId` int(11) NOT NULL,
  `cart` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cart`)),
  `subtotal` double NOT NULL,
  `iva` int(11) NOT NULL DEFAULT 0,
  `vat` double NOT NULL DEFAULT 0,
  `irpf` int(11) NOT NULL DEFAULT 0,
  `total` double NOT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'manual',
  `recurrent` int(11) NOT NULL DEFAULT 0,
  `pdf_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`invoicesId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `logsId` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(200) DEFAULT NULL,
  `usersId` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `label` longtext NOT NULL,
  `body` varchar(255) DEFAULT NULL,
  `object` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `objectid` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`logsId`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `productsId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(25) DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `interval` varchar(255) DEFAULT NULL,
  `stripe_product_id` varchar(255) DEFAULT NULL,
  `stripe_price_id` varchar(255) DEFAULT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`productsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `subscriptionsId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `productsId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `cancelled` int(11) NOT NULL DEFAULT 0,
  `contratostypesId` int(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_qty` int(11) DEFAULT 1,
  `consumed_qty` int(11) DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`subscriptionsId`),
  KEY `customersId` (`usersId`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `password` varchar(255) NOT NULL,
  `group` varchar(50) DEFAULT 'customers',
  `last_login` datetime DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `stripe_customer_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usersId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`usersId`, `email`, `name`, `password`, `group`, `last_login`, `tax_id`, `address`, `country`, `stripe_customer_id`, `created`, `updated`)
VALUES
	(1,'demo@stripepad.com','Mike Doe','2a97516c354b68848cdbd8f54a226a0a55b21ed138e207ad6c5cbb9c00aa5aea','customers','2025-01-01 11:30:02',NULL,NULL,NULL,NULL,'2024-12-21 15:26:05','2025-01-01 12:34:55'),
	(2,'superadmin@stripepad.com','John Doe','186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae','superadmin','2025-01-02 11:37:26',NULL,NULL,NULL,NULL,'2024-12-21 15:15:26','2025-01-02 11:37:26');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
