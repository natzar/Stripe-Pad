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
	(2,'superadmin@stripepad.com','John Doe','186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae','superadmin','2025-01-02 11:37:26',NULL,NULL,NULL,NULL,'2024-12-21 15:15:26','2025-01-02 11:37:26'),
	(3,'konstantin.karnakov@web.de','','ac3797a3f92ba2bd3718c46e5dcecac13d96aca0a6a79a403d856afd617c23a7','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 12:50:50','2025-01-01 12:51:05'),
	(4,'donavon_1992@hotmail.com','','6e9d7700bb89f22a784a591fddfea05419c9c27e513d88d6133fcab070cd8474','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 13:03:57','2025-01-01 13:56:34'),
	(5,'beto.phpninja@gmail.com','','d6865ea00af046e58ddea423d303539d1791b29191f677b3f6f3d9abe6bdba59','customers','2025-01-01 14:36:48',0,0,0,'','2025-01-01 14:04:44','2025-01-01 14:36:50'),
	(6,'annabrumley@gmail.com','','3214a0030b7de86b437a5075aa20b883e88ce6e5b7443f7e3a35492a58033541','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 14:07:25','2025-01-01 14:07:40'),
	(7,'betolopezayesa@gmail.com','','2e599b9eaf58852a74a87146f2c516d9e2a005a3965b3126219b06355b9542f6','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 14:19:20','2025-01-01 14:36:22'),
	(8,'oaviyona@umich.edu','','af44296c4154afe5cd10fd834a78141955513dfceefb699979c8e09b8be52406','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 14:21:43','2025-01-01 14:22:01'),
	(9,'gretchensellshomes1@gmail.com','','70b73dfb94744d2e91fb02e88fdbfe05befe86d948189c8df8cd5d2e3f40aa7c','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 14:56:10','2025-01-01 14:56:14'),
	(10,'mjens02@gmail.com','','9595732909eeb224fc72f10febb4ae315c36a21d04d86e13b92cb2ddc1cbd7ed','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 15:08:50','2025-01-01 15:09:10'),
	(11,'arnoldtopperman@gmail.com','','75d235a6f550fc3ba12d8c3cc5335dc5679d7abccd1b0e31e7ceac9c3d08d5f1','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 15:12:19','2025-01-01 15:12:39'),
	(12,'dustjort@gmail.com','','7bd61df5f8634fa1565871ecb3360480c7198a679ae5e077e4cebd59be5ba153','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 15:28:18','2025-01-01 15:28:18'),
	(13,'dave1man007@gmail.com','','09cb7165a30dc4a1a2c5d6b82b57688a71de5d9d30a74028ffca6acfe0e27d92','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 15:42:54','2025-01-01 15:43:12'),
	(14,'dwayne.lambert@compositesone.com','','93284b42262dda49ab31bd942147aa8341bfe9cd193a6de4e71d076436fe0fd1','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 16:32:45','2025-01-01 16:33:04'),
	(15,'bogoside@gmail.com','','409a591aaf7761222adefa501a8dfb2567a17041b7d5eb221bada6fc92d2850b','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 16:38:07','2025-01-01 16:38:17'),
	(16,'tstflood@gmail.com','','05df6c5b449cb9a0cd9eea9eb1278658a1e67f84ee107fd2381f09c3a7ed60da','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 16:43:23','2025-01-01 16:43:30'),
	(17,'arash@griffin.fi','','7e284b8eb0e492d92001a57b8aab7db878f655bf4a11326fc76c350e849f819e','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 17:15:59','2025-01-01 17:16:25'),
	(18,'derroblack@icloud.com','','89aa4a556c36e9f7c59c41128657234754ca73592c655783878bd5ad00581e3b','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 18:14:40','2025-01-01 18:14:50'),
	(19,'alexandruroby@gmail.com','','2dc7e5fd2e164ca442437bc13d3dcea137e2b8f2f6a1f4cbe0af7690465e2a45','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 18:45:11','2025-01-01 18:45:23'),
	(20,'beto.phpninja+ps@gmail.com','','9d67d1775edda8d7304a6a525e38f33976e4a4be4619b4c8130c2202d19ab5f7','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 20:18:02','2025-01-01 20:18:02'),
	(21,'rlfdiadfpd@yahoo.com','','7c03746d26f15f6404e75b55da46421f05eda45e5ae6bc42be0db62c891be457','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-01 21:15:56','2025-01-01 21:16:07'),
	(22,'eadyk@hotmail.com','','0fa5364e2bcdfceedddc0d5fabfadd65d96f8d40441d34dad3a81a94abfe4007','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 00:30:59','2025-01-02 00:31:05'),
	(23,'nbushak@gmail.com','','7c2573fc6b7d16d83720c05fc74b36da152638d132a1e02d0f7fcbda33f8a356','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 00:31:28','2025-01-02 00:31:53'),
	(24,'takabon1124@outlook.com','','98c92f8b57b3fa32a153c0e65b4ad88a5daf8bd62ceab098861599b20385e27b','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 03:19:25','2025-01-02 03:19:47'),
	(25,'rjnichols89@gmail.com','','429d4a2ab538b819f82ac1cd46d89908e79a91f9435c7509ebd75e9c484d5b45','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 04:49:10','2025-01-02 04:49:13'),
	(26,'vietvet67@hotmail.com','','5ed8726dae1dde4f7ceaedb55423ce934ff143cb4c02982e71bbe906c1763a0e','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 05:31:41','2025-01-02 05:31:43'),
	(27,'bbelton@systemone.co.uk','','8ef4dc63d052e424acc382386d44080e3e5b2edba7c3c6259910538b99001887','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 05:37:18','2025-01-02 05:37:34'),
	(28,'luannecostello@gmail.com','','6cba4fc04f8c7cbdacfd83645f11eaa39e4f7537169f68459f8df381e00b7adb','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 06:11:35','2025-01-02 06:11:49'),
	(29,'cilnoczkowsk@yahoo.com','','ee91030d4696c42aeb70a5ad2bf0443188e55876ab26fe11e3eb860f0a4af77e','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 06:31:51','2025-01-02 06:32:15'),
	(30,'v8.parts.yug@gmail.com','','7d7400df49ff669e56356f17a69f5e8965f1776ce5fd64585610597d0fcfac12','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 06:48:37','2025-01-02 06:48:51'),
	(31,'aprilsurmiak40@gmail.com','','1a619990fcc90fa14020fe4bced8fba0c45109567196a3e1b71a8d6a9bfc0d09','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 07:16:26','2025-01-02 07:16:49'),
	(32,'harleras@gmail.com','','ca5102d0dfab38ce4e232a18d72ae2f9ef6d38aeef16dd9b4930ff9b31d5605b','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 08:45:16','2025-01-02 08:45:16'),
	(33,'vkfnafoxdohxha@yahoo.com','','8cfe9e320783bd80cbaaf7af9c0d109514572593886f071031422cbe263c89c5','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 10:09:03','2025-01-02 10:09:51'),
	(34,'mossjess83@gmail.com','','4221a113010904c8e27b4b5ad15f1071cdc39cb58d8bd7febe1f45fcdcf2c078','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 10:25:59','2025-01-02 10:26:03'),
	(35,'vlsmart@mts.net','','5e40847a4aeb602dbdb288914a687f6e30ed8fd5f063bf4e7d088656c72c67ea','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 10:58:06','2025-01-02 12:14:45'),
	(36,'davehembree@gmail.com','','96fd736ed95bbbefce245d995bc6b48f468b988a73b0fe4bb97a2a237a7eec96','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 11:33:00','2025-01-02 11:33:07'),
	(37,'prakashmagarelli@yahoo.com','','b59ebe598d96ae3a498a9faf13b59abcc70a2fb16b935a491466064ef9d7a556','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 11:42:54','2025-01-02 11:43:12'),
	(38,'andrew.zayec@gmail.com','','5f650c74f30317d4019f2700ac33c3a37febc1e9683ec3d7efc06bdcfa19ff74','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 11:47:49','2025-01-02 11:48:36'),
	(39,'amirolkleb@gmail.com','','72047f16c01306128a65ecbc3337ed9c2f69fad17ef6c6e61d10071b79b825ad','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 12:18:11','2025-01-02 12:18:35'),
	(40,'mrasikas@hotmail.com','','bc394f960acb58d2d15d65af841ced2e2dac87b7913e5423fd264ff2592e17ac','customers',NULL,NULL,NULL,NULL,NULL,'2025-01-02 12:23:20','2025-01-02 12:23:42');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
