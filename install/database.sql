# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: dedi6205.your-server.de (MySQL 5.5.5-10.11.6-MariaDB-hetzner1)
# Base de datos: stripn_db1
# Tiempo de Generación: 2025-01-01 11:43:08 +0000
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;

INSERT INTO `blog` (`id`, `slug`, `title`, `meta_title`, `meta_description`, `body`, `created`, `updated`)
VALUES
	(1,'hosting-for-saas','Hosting for your SaaS',NULL,NULL,'HOSTING FOR YOUR SAAS\nGet Hosting for your SaaS at Hetzner for $2/month (you can upgrade later). 10Gb disk space, unlimited traffic, FTP, SMTP, SSL.\nAll the infrastructure you need to start your SaaS for $2/month.\nHetzner doesn\'t have any affiliate program, no comission. It is the recommended hosting service for Stripe Pad projects\n','0000-00-00 00:00:00','0000-00-00 00:00:00');

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



# Volcado de tabla log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
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

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;

INSERT INTO `log` (`logsId`, `hash`, `usersId`, `month`, `week`, `tag`, `label`, `body`, `object`, `objectid`, `total`, `created`, `updated`)
VALUES
	(1,'visit-0-httplocalhoststripepad',0,NULL,202452,'visit','http://localhost/stripe-pad/','',NULL,NULL,2,'2024-12-29 01:36:42','2024-12-29 01:42:24'),
	(5,'visit-0-httplocalhoststripepadtableusers',0,NULL,202452,'visit','http://localhost/stripe-pad/table/users','',NULL,NULL,2,'2024-12-29 01:41:06','2024-12-29 01:41:12'),
	(6,'visit-0-httplocalhoststripepadsuperadmin',0,NULL,202452,'visit','http://localhost/stripe-pad/superadmin','',NULL,NULL,1,'2024-12-29 01:53:48','2024-12-29 01:53:48'),
	(7,'visit-0-httplocalhoststripepadtableinvoices',0,NULL,202452,'visit','http://localhost/stripe-pad/table/invoices','',NULL,NULL,1,'2024-12-29 02:02:37','2024-12-29 02:02:37'),
	(8,'visit-httplocalhoststripepadsuperadmin',0,NULL,202452,'visit','http://localhost/stripe-pad/superadmin','',NULL,NULL,65,'2024-12-29 02:10:03','2024-12-29 12:25:18'),
	(9,'visit-httplocalhoststripepadprofile',0,NULL,202452,'visit','http://localhost/stripe-pad/profile','',NULL,NULL,3,'2024-12-29 02:12:54','2024-12-29 11:13:31'),
	(10,'visit-httplocalhoststripepadtableinvoices',0,202412,202452,'visit','http://localhost/stripe-pad/table/invoices','',NULL,NULL,2,'2024-12-29 02:18:24','2024-12-29 11:13:22'),
	(11,'visit-httplocalhoststripepadtablecrons',0,202412,202452,'visit','http://localhost/stripe-pad/table/crons','',NULL,NULL,6,'2024-12-29 02:18:27','2024-12-29 12:15:29'),
	(12,'visit-httplocalhoststripepadtos',0,202412,202452,'visit','http://localhost/stripe-pad/tos','',NULL,NULL,1,'2024-12-29 02:18:53','2024-12-29 02:18:53'),
	(13,'visit-httplocalhoststripepadprivacy',0,202412,202452,'visit','http://localhost/stripe-pad/privacy','',NULL,NULL,1,'2024-12-29 02:19:58','2024-12-29 02:19:58'),
	(14,'visit-httplocalhoststripepad',0,202412,202452,'visit','http://localhost/stripe-pad/','',NULL,NULL,12,'2024-12-29 09:10:29','2024-12-29 11:46:15'),
	(15,'visit-httplocalhoststripepadtableusers',0,202412,202452,'visit','http://localhost/stripe-pad/table/users','',NULL,NULL,3,'2024-12-29 09:10:34','2024-12-29 11:46:18'),
	(16,'visit-httplocalhoststripepadlogin',0,202412,202452,'visit','http://localhost/stripe-pad/login',NULL,NULL,NULL,1,'2024-12-29 11:09:57','2024-12-29 11:09:57'),
	(17,'visit-httplocalhoststripepadtablesubscriptions',0,202412,202452,'visit','http://localhost/stripe-pad/table/subscriptions',NULL,NULL,NULL,1,'2024-12-29 11:13:21','2024-12-29 11:13:21'),
	(18,'visit-httplocalhoststripepadreports',0,202412,202452,'visit','http://localhost/stripe-pad/reports',NULL,NULL,NULL,1,'2024-12-29 11:13:24','2024-12-29 11:13:24'),
	(19,'visit-httplocalhoststripepadtableproducts',0,202412,202452,'visit','http://localhost/stripe-pad/table/products',NULL,NULL,NULL,1,'2024-12-29 11:46:24','2024-12-29 11:46:24'),
	(20,'pageview-httpsuperadmin',0,202412,202452,'pageview','http:superadmin',NULL,NULL,NULL,2,'2024-12-29 12:30:01','2024-12-29 12:30:18'),
	(21,'pageview-http',0,202412,202452,'pageview','http:',NULL,NULL,NULL,1,'2024-12-29 12:30:14','2024-12-29 12:30:14'),
	(22,'pageview-superadmin',0,202412,202452,'pageview','superadmin',NULL,NULL,NULL,44,'2024-12-29 12:31:00','2024-12-29 13:48:56'),
	(23,'pageview-tableusers',0,202412,202452,'pageview','table/users',NULL,NULL,NULL,6,'2024-12-29 12:31:03','2024-12-31 07:17:23'),
	(24,'pageview-tablecrons',0,202412,202452,'pageview','/table/crons',NULL,NULL,NULL,8,'2024-12-29 12:33:42','2024-12-29 12:37:57'),
	(25,'pageview-',0,202412,202452,'pageview','/',NULL,NULL,NULL,274,'2024-12-29 12:35:10','2025-01-01 12:40:46'),
	(26,'pageview-tablesubscriptions',0,202412,202452,'pageview','/table/subscriptions',NULL,NULL,NULL,3,'2024-12-29 12:35:29','2024-12-29 13:19:15'),
	(27,'pageview-reports',0,202412,202452,'pageview','/reports',NULL,NULL,NULL,1,'2024-12-29 12:35:32','2024-12-29 12:35:32'),
	(28,'pageview-profile',0,202412,202452,'pageview','/profile',NULL,NULL,NULL,3,'2024-12-29 12:35:41','2025-01-01 11:30:27'),
	(29,'pageview-formcrons',0,202412,202452,'pageview','//form/crons',NULL,NULL,NULL,5,'2024-12-29 12:36:15','2024-12-29 12:37:48'),
	(30,'pageview-tableproducts',0,202412,202452,'pageview','/table/products',NULL,NULL,NULL,1,'2024-12-29 12:37:59','2024-12-29 12:37:59'),
	(31,'pageview-tableinvoices',0,202412,202452,'pageview','/table/invoices',NULL,NULL,NULL,3,'2024-12-29 12:38:22','2024-12-29 13:18:49'),
	(32,'pageview-forminvoices',0,202412,202452,'pageview','//form/invoices',NULL,NULL,NULL,5,'2024-12-29 12:38:24','2024-12-29 13:18:50'),
	(33,'pageview-formusers',0,202412,202452,'pageview','/form/users','',NULL,NULL,2,'2024-12-29 13:09:32','2024-12-29 13:19:03'),
	(34,'pageview-support',0,202412,202452,'pageview','/support','',NULL,NULL,30,'2024-12-29 13:35:41','2025-01-01 11:37:01'),
	(35,'pageview-documentation',0,202412,202452,'pageview','/documentation','',NULL,NULL,3,'2024-12-29 13:37:15','2024-12-29 14:12:19'),
	(36,'pageview-login',0,202412,202452,'pageview','/login','',NULL,NULL,30,'2024-12-29 13:40:15','2025-01-01 12:40:37'),
	(37,'counter-stripepaddownloads',0,202412,202452,'counter','stripepad-downloads','',NULL,NULL,2,'2024-12-29 13:48:39','2024-12-30 09:40:44'),
	(38,'pageview-tos',0,202412,202452,'pageview','/tos','',NULL,NULL,7,'2024-12-30 10:21:02','2024-12-30 10:22:17'),
	(39,'pageview-privacy',0,202412,202452,'pageview','/privacy','',NULL,NULL,2,'2024-12-30 10:22:32','2024-12-30 10:22:40'),
	(40,'pageview-signup',0,202412,202452,'pageview','/signup','',NULL,NULL,4,'2024-12-31 07:40:50','2025-01-01 12:19:02'),
	(41,'pageview-forgotpassword',0,202412,202452,'pageview','/forgotPassword','',NULL,NULL,3,'2024-12-31 08:11:44','2025-01-01 11:23:09'),
	(42,'pageview-forgotpasswordsuccess1',0,202412,202452,'pageview','/forgotPassword?success=1','',NULL,NULL,3,'2024-12-31 08:11:48','2024-12-31 12:27:07'),
	(43,'pageview-blog',0,202412,202452,'pageview','/blog','',NULL,NULL,13,'2024-12-31 12:36:55','2025-01-01 12:40:48'),
	(44,'404-httplocalhoststripepadsupport',0,202412,202452,'404','http://localhost/stripe-pad/support','',NULL,NULL,8,'2024-12-31 12:38:21','2025-01-01 11:37:01'),
	(45,'pageview-bloghostingforsaas',0,202412,202452,'pageview','/blog/hosting-for-saas','',NULL,NULL,3,'2024-12-31 12:39:45','2025-01-01 12:40:52'),
	(46,'pageview-httpsstripepadcom',0,202501,202452,'pageview','https://stripepad.com/','',NULL,NULL,2,'2025-01-01 12:40:33','2025-01-01 12:41:03');

/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;


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
	(2,'superadmin@stripepad.com','John Doe','186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae','superadmin','2025-01-01 12:39:07',NULL,NULL,NULL,NULL,'2024-12-21 15:15:26','2025-01-01 12:39:07');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
