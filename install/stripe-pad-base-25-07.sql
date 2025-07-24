# ************************************************************
# Antares - SQL Client
# Version 0.7.35
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: dedi6205.your-server.de (Debian 12 10.11.11)
# Database: stripn_db1
# Generation time: 2025-07-24T20:50:03+02:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blog
# ------------------------------------------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table counters
# ------------------------------------------------------------

CREATE TABLE `counters` (
  `countersId` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_type` varchar(50) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`countersId`),
  UNIQUE KEY `tenant_type` (`tenant_type`,`tenant_id`,`label`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table counters_data
# ------------------------------------------------------------

CREATE TABLE `counters_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countersId` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_period` (`countersId`,`week`,`month`)
) ENGINE=InnoDB AUTO_INCREMENT=884 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table crons
# ------------------------------------------------------------

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



# Dump of table customers
# ------------------------------------------------------------

CREATE TABLE `customers` (
  `customersId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT 'Account Name',
  `stripe_customer_id` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`customersId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table datatracker
# ------------------------------------------------------------

CREATE TABLE `datatracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customersId` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `countersId` int(11) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`),
  KEY `countersId` (`countersId`),
  KEY `week` (`week`),
  KEY `month` (`month`)
) ENGINE=InnoDB AUTO_INCREMENT=4945986 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



# Dump of table feedbacks
# ------------------------------------------------------------

CREATE TABLE `feedbacks` (
  `feedbacksId` int(10) NOT NULL AUTO_INCREMENT,
  `usersId` tinyint(4) unsigned zerofill DEFAULT NULL,
  `hash` varchar(100) NOT NULL,
  `points` tinyint(4) unsigned zerofill NOT NULL,
  `context` varchar(50) NOT NULL,
  `comment` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`feedbacksId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



# Dump of table groups
# ------------------------------------------------------------

CREATE TABLE `groups` (
  `groupsId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`groupsId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table invoices
# ------------------------------------------------------------

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



# Dump of table logs
# ------------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=41850 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table products
# ------------------------------------------------------------

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



# Dump of table social_logins
# ------------------------------------------------------------

CREATE TABLE `social_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(50) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_provider_user` (`provider`,`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table subscribers
# ------------------------------------------------------------

CREATE TABLE `subscribers` (
  `subscribersId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`subscribersId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table subscriptions
# ------------------------------------------------------------

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



# Dump of table users
# ------------------------------------------------------------

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
  `lang` varchar(2) NOT NULL DEFAULT 'es',
  `daily_newsletter` tinyint(4) NOT NULL DEFAULT 1,
  `weekly_newsletter` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usersId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2025-07-24T20:50:03+02:00
