# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.19-0ubuntu0.16.04.1)
# Database: neimenggu
# Generation Time: 2017-11-09 03:05:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_menu`;

CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`)
VALUES
	(1,0,1,'系统概况','fa-bar-chart','/',NULL,'2017-11-09 02:34:06'),
	(2,0,18,'系统管理','fa-tasks',NULL,NULL,'2017-11-09 03:00:50'),
	(3,2,19,'管理员组','fa-users','auth/users',NULL,'2017-11-09 03:00:50'),
	(4,2,20,'角色','fa-user','auth/roles',NULL,'2017-11-09 03:00:50'),
	(5,2,21,'权限','fa-ban','auth/permissions',NULL,'2017-11-09 03:00:50'),
	(6,2,22,'菜单','fa-bars','auth/menu',NULL,'2017-11-09 03:00:50'),
	(7,2,23,'操作日志','fa-history','auth/logs',NULL,'2017-11-09 03:00:50'),
	(8,0,2,'会员管理','fa-users',NULL,'2017-11-09 02:37:38','2017-11-09 02:42:31'),
	(9,8,3,'个人用户','fa-user',NULL,'2017-11-09 02:45:39','2017-11-09 02:50:13'),
	(10,8,4,'企业用户','fa-user-secret',NULL,'2017-11-09 02:46:07','2017-11-09 02:50:13'),
	(11,0,5,'贷款申请','fa-list',NULL,'2017-11-09 02:48:58','2017-11-09 02:55:12'),
	(12,11,6,'农户贷款','fa-vine',NULL,'2017-11-09 02:52:23','2017-11-09 02:53:35'),
	(13,11,7,'房产抵押贷款','fa-vine',NULL,'2017-11-09 02:53:23','2017-11-09 02:53:35'),
	(14,11,8,'兴业贷','fa-vine',NULL,'2017-11-09 02:54:46','2017-11-09 02:56:21'),
	(15,11,9,'兴商贷','fa-vine',NULL,'2017-11-09 02:55:49','2017-11-09 02:56:21'),
	(16,11,10,'助业贷','fa-vine',NULL,'2017-11-09 02:56:15','2017-11-09 02:56:21'),
	(17,11,11,'公务员消费贷款','fa-vine',NULL,'2017-11-09 02:56:43','2017-11-09 03:00:35'),
	(18,11,12,'助农担保贷款','fa-vine',NULL,'2017-11-09 02:57:09','2017-11-09 03:00:35'),
	(19,0,13,'申贷记录','fa-list-alt',NULL,'2017-11-09 02:58:07','2017-11-09 03:02:39'),
	(21,19,15,'待审核','fa-dot-circle-o',NULL,'2017-11-09 02:59:12','2017-11-09 03:02:39'),
	(22,19,16,'待放款','fa-dot-circle-o',NULL,'2017-11-09 02:59:42','2017-11-09 03:02:39'),
	(23,19,17,'已放款','fa-dot-circle-o',NULL,'2017-11-09 02:59:57','2017-11-09 03:00:50'),
	(24,19,14,'全部记录','fa-dot-circle-o',NULL,'2017-11-09 03:02:05','2017-11-09 03:02:39');

/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_operation_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_operation_log`;

CREATE TABLE `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_operation_log` WRITE;
/*!40000 ALTER TABLE `admin_operation_log` DISABLE KEYS */;

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`)
VALUES
	(1,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:20:54','2017-11-09 01:20:54'),
	(2,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:21:24','2017-11-09 01:21:24'),
	(3,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:23:23','2017-11-09 01:23:23'),
	(4,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:23:32','2017-11-09 01:23:32'),
	(5,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:23:34','2017-11-09 01:23:34'),
	(6,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:24:45','2017-11-09 01:24:45'),
	(7,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:24:50','2017-11-09 01:24:50'),
	(8,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:25:08','2017-11-09 01:25:08'),
	(9,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:28:26','2017-11-09 01:28:26'),
	(10,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:28:30','2017-11-09 01:28:30'),
	(11,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/login\"}','2017-11-09 01:29:30','2017-11-09 01:29:30'),
	(12,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:29:32','2017-11-09 01:29:32'),
	(13,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:30:03','2017-11-09 01:30:03'),
	(14,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:30:04','2017-11-09 01:30:04'),
	(15,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:30:13','2017-11-09 01:30:13'),
	(16,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/login\"}','2017-11-09 01:30:20','2017-11-09 01:30:20'),
	(17,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:30:21','2017-11-09 01:30:21'),
	(18,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:31:10','2017-11-09 01:31:10'),
	(19,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:31:12','2017-11-09 01:31:12'),
	(20,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:31:20','2017-11-09 01:31:20'),
	(21,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:31:21','2017-11-09 01:31:21'),
	(22,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:31:56','2017-11-09 01:31:56'),
	(23,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/login\"}','2017-11-09 01:32:28','2017-11-09 01:32:28'),
	(24,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:32:29','2017-11-09 01:32:29'),
	(25,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:33:05','2017-11-09 01:33:05'),
	(26,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:33:06','2017-11-09 01:33:06'),
	(27,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:33:18','2017-11-09 01:33:18'),
	(28,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/login\"}','2017-11-09 01:33:40','2017-11-09 01:33:40'),
	(29,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:33:40','2017-11-09 01:33:40'),
	(30,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:33:47','2017-11-09 01:33:47'),
	(31,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:33:47','2017-11-09 01:33:47'),
	(32,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:33:52','2017-11-09 01:33:52'),
	(33,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:34:13','2017-11-09 01:34:13'),
	(34,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:34:20','2017-11-09 01:34:20'),
	(35,1,'nmg-admin/auth/logout','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:34:34','2017-11-09 01:34:34'),
	(36,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:34:37','2017-11-09 01:34:37'),
	(37,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:35:12','2017-11-09 01:35:12'),
	(38,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 01:35:15','2017-11-09 01:35:15'),
	(39,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:35:22','2017-11-09 01:35:22'),
	(40,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:40:12','2017-11-09 01:40:12'),
	(41,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:40:16','2017-11-09 01:40:16'),
	(42,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\"}','2017-11-09 01:40:23','2017-11-09 01:40:23'),
	(43,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:40:23','2017-11-09 01:40:23'),
	(44,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:40:30','2017-11-09 01:40:30'),
	(45,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:40:35','2017-11-09 01:40:35'),
	(46,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:46:31','2017-11-09 01:46:31'),
	(47,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:46:32','2017-11-09 01:46:32'),
	(48,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:46:35','2017-11-09 01:46:35'),
	(49,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:46:38','2017-11-09 01:46:38'),
	(50,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:48:03','2017-11-09 01:48:03'),
	(51,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:50:39','2017-11-09 01:50:39'),
	(52,1,'nmg-admin/auth/setting','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 01:50:44','2017-11-09 01:50:44'),
	(53,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:50:50','2017-11-09 01:50:50'),
	(54,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:50:52','2017-11-09 01:50:52'),
	(55,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:51:05','2017-11-09 01:51:05'),
	(56,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:51:05','2017-11-09 01:51:05'),
	(57,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 01:53:55','2017-11-09 01:53:55'),
	(58,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:53:55','2017-11-09 01:53:55'),
	(59,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:54:32','2017-11-09 01:54:32'),
	(60,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/login\"}','2017-11-09 01:54:43','2017-11-09 01:54:43'),
	(61,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:54:43','2017-11-09 01:54:43'),
	(62,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:55:08','2017-11-09 01:55:08'),
	(63,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/login\"}','2017-11-09 01:59:04','2017-11-09 01:59:04'),
	(64,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 01:59:05','2017-11-09 01:59:05'),
	(65,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 02:00:11','2017-11-09 02:00:11'),
	(66,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 02:00:11','2017-11-09 02:00:11'),
	(67,1,'nmg-admin/auth/setting','PUT','192.168.10.1','{\"name\":\"Administrator\",\"password\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"password_confirmation\":\"$2y$10$VYDK7uxaV8hN4I\\/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\"}','2017-11-09 02:01:48','2017-11-09 02:01:48'),
	(68,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 02:01:49','2017-11-09 02:01:49'),
	(69,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:01:55','2017-11-09 02:01:55'),
	(70,1,'nmg-admin/auth/logout','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:02:02','2017-11-09 02:02:02'),
	(71,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:02:05','2017-11-09 02:02:05'),
	(72,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:06:42','2017-11-09 02:06:42'),
	(73,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:09:36','2017-11-09 02:09:36'),
	(74,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:21:09','2017-11-09 02:21:09'),
	(75,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:22:14','2017-11-09 02:22:14'),
	(76,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:23:57','2017-11-09 02:23:57'),
	(77,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:26:37','2017-11-09 02:26:37'),
	(78,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:26:52','2017-11-09 02:26:52'),
	(79,1,'nmg-admin/auth/menu/3/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:27:01','2017-11-09 02:27:01'),
	(80,1,'nmg-admin/auth/menu/3','PUT','192.168.10.1','{\"parent_id\":\"2\",\"title\":\"\\u7528\\u6237\",\"icon\":\"fa-users\",\"uri\":\"auth\\/users\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:27:15','2017-11-09 02:27:15'),
	(81,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:27:16','2017-11-09 02:27:16'),
	(82,1,'nmg-admin/auth/users','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:27:20','2017-11-09 02:27:20'),
	(83,1,'nmg-admin/auth/users/1/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:27:35','2017-11-09 02:27:35'),
	(84,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:27:42','2017-11-09 02:27:42'),
	(85,1,'nmg-admin/auth/menu/3/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:27:47','2017-11-09 02:27:47'),
	(86,1,'nmg-admin/auth/menu/3','PUT','192.168.10.1','{\"parent_id\":\"2\",\"title\":\"\\u7ba1\\u7406\\u5458\\u7ec4\",\"icon\":\"fa-users\",\"uri\":\"auth\\/users\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:27:58','2017-11-09 02:27:58'),
	(87,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:27:58','2017-11-09 02:27:58'),
	(88,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:28:00','2017-11-09 02:28:00'),
	(89,1,'nmg-admin/auth/menu/4/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:28:08','2017-11-09 02:28:08'),
	(90,1,'nmg-admin/auth/menu/4','PUT','192.168.10.1','{\"parent_id\":\"2\",\"title\":\"\\u89d2\\u8272\",\"icon\":\"fa-user\",\"uri\":\"auth\\/roles\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:28:13','2017-11-09 02:28:13'),
	(91,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:28:13','2017-11-09 02:28:13'),
	(92,1,'nmg-admin/auth/menu/5/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:28:19','2017-11-09 02:28:19'),
	(93,1,'nmg-admin/auth/menu/5','PUT','192.168.10.1','{\"parent_id\":\"2\",\"title\":\"\\u6743\\u9650\",\"icon\":\"fa-ban\",\"uri\":\"auth\\/permissions\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:28:24','2017-11-09 02:28:24'),
	(94,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:28:24','2017-11-09 02:28:24'),
	(95,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:28:45','2017-11-09 02:28:45'),
	(96,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:29:00','2017-11-09 02:29:00'),
	(97,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:29:26','2017-11-09 02:29:26'),
	(98,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:29:50','2017-11-09 02:29:50'),
	(99,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:30:49','2017-11-09 02:30:49'),
	(100,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:31:11','2017-11-09 02:31:11'),
	(101,1,'nmg-admin/auth/menu/6/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:31:24','2017-11-09 02:31:24'),
	(102,1,'nmg-admin/auth/menu/6','PUT','192.168.10.1','{\"parent_id\":\"2\",\"title\":\"\\u83dc\\u5355\",\"icon\":\"fa-bars\",\"uri\":\"auth\\/menu\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:31:31','2017-11-09 02:31:31'),
	(103,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:31:31','2017-11-09 02:31:31'),
	(104,1,'nmg-admin/auth/menu/7/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:31:37','2017-11-09 02:31:37'),
	(105,1,'nmg-admin/auth/menu/7','PUT','192.168.10.1','{\"parent_id\":\"2\",\"title\":\"\\u64cd\\u4f5c\\u65e5\\u5fd7\",\"icon\":\"fa-history\",\"uri\":\"auth\\/logs\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:31:43','2017-11-09 02:31:43'),
	(106,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:31:43','2017-11-09 02:31:43'),
	(107,1,'nmg-admin/auth/menu/2/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:31:46','2017-11-09 02:31:46'),
	(108,1,'nmg-admin/auth/menu/2','PUT','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u7cfb\\u7edf\\u7ba1\\u7406\",\"icon\":\"fa-tasks\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:31:57','2017-11-09 02:31:57'),
	(109,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:31:57','2017-11-09 02:31:57'),
	(110,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:32:02','2017-11-09 02:32:02'),
	(111,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:32:09','2017-11-09 02:32:09'),
	(112,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:32:14','2017-11-09 02:32:14'),
	(113,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:32:22','2017-11-09 02:32:22'),
	(114,1,'nmg-admin/auth/menu/1/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:32:25','2017-11-09 02:32:25'),
	(115,1,'nmg-admin/auth/menu/1','PUT','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u60a8\\u597d\",\"icon\":\"fa-bar-chart\",\"uri\":\"\\/\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:32:50','2017-11-09 02:32:50'),
	(116,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:32:50','2017-11-09 02:32:50'),
	(117,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:32:54','2017-11-09 02:32:54'),
	(118,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:33:01','2017-11-09 02:33:01'),
	(119,1,'nmg-admin/auth/menu/1/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:33:03','2017-11-09 02:33:03'),
	(120,1,'nmg-admin/auth/menu/1','PUT','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u670d\\u52a1\\u5668\\u72b6\\u6001\",\"icon\":\"fa-bar-chart\",\"uri\":\"\\/\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:33:31','2017-11-09 02:33:31'),
	(121,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:33:31','2017-11-09 02:33:31'),
	(122,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:33:36','2017-11-09 02:33:36'),
	(123,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:33:43','2017-11-09 02:33:43'),
	(124,1,'nmg-admin/auth/menu/1/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:33:53','2017-11-09 02:33:53'),
	(125,1,'nmg-admin/auth/menu/1','PUT','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u7cfb\\u7edf\\u6982\\u51b5\",\"icon\":\"fa-bar-chart\",\"uri\":\"\\/\",\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:34:06','2017-11-09 02:34:06'),
	(126,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:34:06','2017-11-09 02:34:06'),
	(127,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:34:11','2017-11-09 02:34:11'),
	(128,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:34:15','2017-11-09 02:34:15'),
	(129,1,'nmg-admin/auth/users','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:34:26','2017-11-09 02:34:26'),
	(130,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:34:31','2017-11-09 02:34:31'),
	(131,1,'nmg-admin/auth/users','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:35:09','2017-11-09 02:35:09'),
	(132,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:35:10','2017-11-09 02:35:10'),
	(133,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:35:11','2017-11-09 02:35:11'),
	(134,1,'nmg-admin/auth/logs','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:35:12','2017-11-09 02:35:12'),
	(135,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:35:20','2017-11-09 02:35:20'),
	(136,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:36:28','2017-11-09 02:36:28'),
	(137,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u4f1a\\u5458\\u7ba1\\u7406\",\"icon\":\"fa-users\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:37:38','2017-11-09 02:37:38'),
	(138,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:37:39','2017-11-09 02:37:39'),
	(139,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:37:44','2017-11-09 02:37:44'),
	(140,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:37:46','2017-11-09 02:37:46'),
	(141,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:37:53','2017-11-09 02:37:53'),
	(142,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:37:54','2017-11-09 02:37:54'),
	(143,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:37:58','2017-11-09 02:37:58'),
	(144,1,'nmg-admin/auth/users','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:00','2017-11-09 02:38:00'),
	(145,1,'nmg-admin/auth/users/create','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:03','2017-11-09 02:38:03'),
	(146,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:06','2017-11-09 02:38:06'),
	(147,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:07','2017-11-09 02:38:07'),
	(148,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:13','2017-11-09 02:38:13'),
	(149,1,'nmg-admin/auth/permissions/create','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:31','2017-11-09 02:38:31'),
	(150,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:36','2017-11-09 02:38:36'),
	(151,1,'nmg-admin/auth/permissions/2/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:51','2017-11-09 02:38:51'),
	(152,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:54','2017-11-09 02:38:54'),
	(153,1,'nmg-admin/auth/permissions/2/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:38:59','2017-11-09 02:38:59'),
	(154,1,'nmg-admin/auth/permissions/2','PUT','192.168.10.1','{\"slug\":\"dashboard\",\"name\":\"\\u4eea\\u8868\\u76d8\",\"http_method\":[\"GET\",null],\"http_path\":\"\\/\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/permissions\"}','2017-11-09 02:39:12','2017-11-09 02:39:12'),
	(155,1,'nmg-admin/auth/permissions','GET','192.168.10.1','[]','2017-11-09 02:39:12','2017-11-09 02:39:12'),
	(156,1,'nmg-admin/auth/permissions/3/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:19','2017-11-09 02:39:19'),
	(157,1,'nmg-admin/auth/permissions/3','PUT','192.168.10.1','{\"slug\":\"auth.login\",\"name\":\"\\u767b\\u5f55\\u6743\\u9650\",\"http_method\":[null],\"http_path\":\"\\/auth\\/login\\r\\n\\/auth\\/logout\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/permissions\"}','2017-11-09 02:39:27','2017-11-09 02:39:27'),
	(158,1,'nmg-admin/auth/permissions','GET','192.168.10.1','[]','2017-11-09 02:39:27','2017-11-09 02:39:27'),
	(159,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:42','2017-11-09 02:39:42'),
	(160,1,'nmg-admin/auth/users','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:43','2017-11-09 02:39:43'),
	(161,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:45','2017-11-09 02:39:45'),
	(162,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:46','2017-11-09 02:39:46'),
	(163,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:49','2017-11-09 02:39:49'),
	(164,1,'nmg-admin/auth/setting','GET','192.168.10.1','[]','2017-11-09 02:39:53','2017-11-09 02:39:53'),
	(165,1,'nmg-admin/auth/roles','GET','192.168.10.1','[]','2017-11-09 02:39:57','2017-11-09 02:39:57'),
	(166,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:39:58','2017-11-09 02:39:58'),
	(167,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:02','2017-11-09 02:40:02'),
	(168,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:04','2017-11-09 02:40:04'),
	(169,1,'nmg-admin/auth/permissions/4/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:08','2017-11-09 02:40:08'),
	(170,1,'nmg-admin/auth/permissions/4','PUT','192.168.10.1','{\"slug\":\"auth.setting\",\"name\":\"\\u7528\\u6237\\u4fe1\\u606f\\u4fee\\u6539\\u6743\\u9650\",\"http_method\":[\"GET\",\"PUT\",null],\"http_path\":\"\\/auth\\/setting\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/permissions\"}','2017-11-09 02:40:18','2017-11-09 02:40:18'),
	(171,1,'nmg-admin/auth/permissions','GET','192.168.10.1','[]','2017-11-09 02:40:18','2017-11-09 02:40:18'),
	(172,1,'nmg-admin/auth/permissions/5/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:27','2017-11-09 02:40:27'),
	(173,1,'nmg-admin/auth/permissions','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:30','2017-11-09 02:40:30'),
	(174,1,'nmg-admin/auth/permissions/4/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:33','2017-11-09 02:40:33'),
	(175,1,'nmg-admin/auth/permissions/4','PUT','192.168.10.1','{\"slug\":\"auth.setting\",\"name\":\"\\u7ba1\\u7406\\u5458\\u8d44\\u6599\\u4fee\\u6539\\u6743\\u9650\",\"http_method\":[\"GET\",\"PUT\",null],\"http_path\":\"\\/auth\\/setting\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/permissions\"}','2017-11-09 02:40:46','2017-11-09 02:40:46'),
	(176,1,'nmg-admin/auth/permissions','GET','192.168.10.1','[]','2017-11-09 02:40:47','2017-11-09 02:40:47'),
	(177,1,'nmg-admin/auth/permissions/5/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:40:56','2017-11-09 02:40:56'),
	(178,1,'nmg-admin/auth/permissions/5','PUT','192.168.10.1','{\"slug\":\"auth.management\",\"name\":\"\\u7ba1\\u7406\\u5458\\u7ec4\\u7ba1\\u7406\\u6743\\u9650\",\"http_method\":[null],\"http_path\":\"\\/auth\\/roles\\r\\n\\/auth\\/permissions\\r\\n\\/auth\\/menu\\r\\n\\/auth\\/logs\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/permissions\"}','2017-11-09 02:41:27','2017-11-09 02:41:27'),
	(179,1,'nmg-admin/auth/permissions','GET','192.168.10.1','[]','2017-11-09 02:41:28','2017-11-09 02:41:28'),
	(180,1,'nmg-admin/auth/permissions/1/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:41:37','2017-11-09 02:41:37'),
	(181,1,'nmg-admin/auth/permissions/1','PUT','192.168.10.1','{\"slug\":\"*\",\"name\":\"\\u6700\\u9ad8\\u6743\\u9650\\uff08\\u6240\\u6709\\u6743\\u9650\\uff09\",\"http_method\":[null],\"http_path\":\"*\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/permissions\"}','2017-11-09 02:41:48','2017-11-09 02:41:48'),
	(182,1,'nmg-admin/auth/permissions','GET','192.168.10.1','[]','2017-11-09 02:41:48','2017-11-09 02:41:48'),
	(183,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:00','2017-11-09 02:42:00'),
	(184,1,'nmg-admin/auth/menu/5/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:14','2017-11-09 02:42:14'),
	(185,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:19','2017-11-09 02:42:19'),
	(186,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 02:42:31','2017-11-09 02:42:31'),
	(187,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 02:42:31','2017-11-09 02:42:31'),
	(188,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:31','2017-11-09 02:42:31'),
	(189,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:32','2017-11-09 02:42:32'),
	(190,1,'nmg-admin/auth/menu/2/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:37','2017-11-09 02:42:37'),
	(191,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:43','2017-11-09 02:42:43'),
	(192,1,'nmg-admin/auth/menu/8/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:46','2017-11-09 02:42:46'),
	(193,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:42:58','2017-11-09 02:42:58'),
	(194,1,'nmg-admin/auth/menu/2/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:43:02','2017-11-09 02:43:02'),
	(195,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:43:12','2017-11-09 02:43:12'),
	(196,1,'nmg-admin/auth/menu/8/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:43:27','2017-11-09 02:43:27'),
	(197,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:44:21','2017-11-09 02:44:21'),
	(198,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:44:22','2017-11-09 02:44:22'),
	(199,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:44:28','2017-11-09 02:44:28'),
	(200,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"8\",\"title\":\"\\u4e2a\\u4eba\\u7528\\u6237\",\"icon\":\"fa-user\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:45:39','2017-11-09 02:45:39'),
	(201,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:45:40','2017-11-09 02:45:40'),
	(202,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"8\",\"title\":\"\\u4f01\\u4e1a\\u7528\\u6237\",\"icon\":\"fa-user-secret\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:46:07','2017-11-09 02:46:07'),
	(203,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:46:07','2017-11-09 02:46:07'),
	(204,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 02:46:22','2017-11-09 02:46:22'),
	(205,1,'nmg-admin/auth/roles','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:46:41','2017-11-09 02:46:41'),
	(206,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:48:06','2017-11-09 02:48:06'),
	(207,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u8d37\\u6b3e\\u4ea7\\u54c1\",\"icon\":\"fa-cubes\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:48:58','2017-11-09 02:48:58'),
	(208,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:48:59','2017-11-09 02:48:59'),
	(209,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8,\\\"children\\\":[{\\\"id\\\":9},{\\\"id\\\":10}]},{\\\"id\\\":11},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 02:50:13','2017-11-09 02:50:13'),
	(210,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:50:13','2017-11-09 02:50:13'),
	(211,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u519c\\u6237\\u8d37\\u6b3e\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:52:23','2017-11-09 02:52:23'),
	(212,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:52:23','2017-11-09 02:52:23'),
	(213,1,'nmg-admin/auth/menu/12/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:52:43','2017-11-09 02:52:43'),
	(214,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:52:47','2017-11-09 02:52:47'),
	(215,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u623f\\u4ea7\\u62b5\\u62bc\\u8d37\\u6b3e\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:53:23','2017-11-09 02:53:23'),
	(216,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:53:23','2017-11-09 02:53:23'),
	(217,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8,\\\"children\\\":[{\\\"id\\\":9},{\\\"id\\\":10}]},{\\\"id\\\":11,\\\"children\\\":[{\\\"id\\\":12},{\\\"id\\\":13}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 02:53:35','2017-11-09 02:53:35'),
	(218,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:53:35','2017-11-09 02:53:35'),
	(219,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u5174\\u4e1a\\u8d37\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:54:46','2017-11-09 02:54:46'),
	(220,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:54:46','2017-11-09 02:54:46'),
	(221,1,'nmg-admin/auth/menu/11/edit','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:54:51','2017-11-09 02:54:51'),
	(222,1,'nmg-admin/auth/menu/11','PUT','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u8d37\\u6b3e\\u7533\\u8bf7\",\"icon\":\"fa-list\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/neimenggu.app\\/nmg-admin\\/auth\\/menu\"}','2017-11-09 02:55:12','2017-11-09 02:55:12'),
	(223,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:55:12','2017-11-09 02:55:12'),
	(224,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u5174\\u5546\\u8d37\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:55:49','2017-11-09 02:55:49'),
	(225,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:55:49','2017-11-09 02:55:49'),
	(226,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u52a9\\u4e1a\\u8d37\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:56:15','2017-11-09 02:56:15'),
	(227,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:56:15','2017-11-09 02:56:15'),
	(228,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8,\\\"children\\\":[{\\\"id\\\":9},{\\\"id\\\":10}]},{\\\"id\\\":11,\\\"children\\\":[{\\\"id\\\":12},{\\\"id\\\":13},{\\\"id\\\":14},{\\\"id\\\":15},{\\\"id\\\":16}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 02:56:20','2017-11-09 02:56:20'),
	(229,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 02:56:21','2017-11-09 02:56:21'),
	(230,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u516c\\u52a1\\u5458\\u6d88\\u8d39\\u8d37\\u6b3e\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:56:43','2017-11-09 02:56:43'),
	(231,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:56:43','2017-11-09 02:56:43'),
	(232,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u52a9\\u519c\\u62c5\\u4fdd\\u8d37\\u6b3e\",\"icon\":\"fa-vine\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:57:09','2017-11-09 02:57:09'),
	(233,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:57:09','2017-11-09 02:57:09'),
	(234,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u7533\\u8d37\\u8bb0\\u5f55\",\"icon\":\"fa-list-alt\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:58:07','2017-11-09 02:58:07'),
	(235,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:58:07','2017-11-09 02:58:07'),
	(236,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u5168\\u90e8\\u5217\\u8868\",\"icon\":\"fa-list-ul\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:58:41','2017-11-09 02:58:41'),
	(237,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:58:42','2017-11-09 02:58:42'),
	(238,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u5f85\\u5ba1\\u6838\",\"icon\":\"fa-dot-circle-o\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:59:12','2017-11-09 02:59:12'),
	(239,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:59:13','2017-11-09 02:59:13'),
	(240,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"11\",\"title\":\"\\u5f85\\u653e\\u6b3e\",\"icon\":\"fa-dot-circle-o\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:59:42','2017-11-09 02:59:42'),
	(241,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:59:42','2017-11-09 02:59:42'),
	(242,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"0\",\"title\":\"\\u5df2\\u653e\\u6b3e\",\"icon\":\"fa-dot-circle-o\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 02:59:57','2017-11-09 02:59:57'),
	(243,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 02:59:57','2017-11-09 02:59:57'),
	(244,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8,\\\"children\\\":[{\\\"id\\\":9},{\\\"id\\\":10}]},{\\\"id\\\":11,\\\"children\\\":[{\\\"id\\\":12},{\\\"id\\\":13},{\\\"id\\\":14},{\\\"id\\\":15},{\\\"id\\\":16},{\\\"id\\\":17},{\\\"id\\\":18},{\\\"id\\\":20},{\\\"id\\\":22}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]},{\\\"id\\\":19,\\\"children\\\":[{\\\"id\\\":21},{\\\"id\\\":23}]}]\"}','2017-11-09 03:00:34','2017-11-09 03:00:34'),
	(245,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 03:00:35','2017-11-09 03:00:35'),
	(246,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8,\\\"children\\\":[{\\\"id\\\":9},{\\\"id\\\":10}]},{\\\"id\\\":11,\\\"children\\\":[{\\\"id\\\":12},{\\\"id\\\":13},{\\\"id\\\":14},{\\\"id\\\":15},{\\\"id\\\":16},{\\\"id\\\":17},{\\\"id\\\":18},{\\\"id\\\":20},{\\\"id\\\":22}]},{\\\"id\\\":19,\\\"children\\\":[{\\\"id\\\":21},{\\\"id\\\":23}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 03:00:50','2017-11-09 03:00:50'),
	(247,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 03:00:50','2017-11-09 03:00:50'),
	(248,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 03:01:00','2017-11-09 03:01:00'),
	(249,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 03:01:31','2017-11-09 03:01:31'),
	(250,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"parent_id\":\"19\",\"title\":\"\\u5168\\u90e8\\u8bb0\\u5f55\",\"icon\":\"fa-dot-circle-o\",\"uri\":null,\"roles\":[\"1\",null],\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 03:02:05','2017-11-09 03:02:05'),
	(251,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 03:02:06','2017-11-09 03:02:06'),
	(252,1,'nmg-admin/auth/menu/20','DELETE','192.168.10.1','{\"_method\":\"delete\",\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\"}','2017-11-09 03:02:20','2017-11-09 03:02:20'),
	(253,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 03:02:21','2017-11-09 03:02:21'),
	(254,1,'nmg-admin/auth/menu','POST','192.168.10.1','{\"_token\":\"X9coZh170oCeo0H9JKpBXBtnG4sbJrGPLBsJeZCa\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8,\\\"children\\\":[{\\\"id\\\":9},{\\\"id\\\":10}]},{\\\"id\\\":11,\\\"children\\\":[{\\\"id\\\":12},{\\\"id\\\":13},{\\\"id\\\":14},{\\\"id\\\":15},{\\\"id\\\":16},{\\\"id\\\":17},{\\\"id\\\":18}]},{\\\"id\\\":19,\\\"children\\\":[{\\\"id\\\":24},{\\\"id\\\":21},{\\\"id\\\":22},{\\\"id\\\":23}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2017-11-09 03:02:39','2017-11-09 03:02:39'),
	(255,1,'nmg-admin/auth/menu','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 03:02:40','2017-11-09 03:02:40'),
	(256,1,'nmg-admin/auth/menu','GET','192.168.10.1','[]','2017-11-09 03:02:44','2017-11-09 03:02:44'),
	(257,1,'nmg-admin','GET','192.168.10.1','[]','2017-11-09 03:02:48','2017-11-09 03:02:48'),
	(258,1,'nmg-admin','GET','192.168.10.1','{\"_pjax\":\"#pjax-container\"}','2017-11-09 03:04:14','2017-11-09 03:04:14');

/*!40000 ALTER TABLE `admin_operation_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_permissions`;

CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`)
VALUES
	(1,'最高权限（所有权限）','*','','*',NULL,'2017-11-09 02:41:48'),
	(2,'仪表盘','dashboard','GET','/',NULL,'2017-11-09 02:39:12'),
	(3,'登录权限','auth.login','','/auth/login\r\n/auth/logout',NULL,'2017-11-09 02:39:27'),
	(4,'管理员资料修改权限','auth.setting','GET,PUT','/auth/setting',NULL,'2017-11-09 02:40:46'),
	(5,'管理员组管理权限','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,'2017-11-09 02:41:27');

/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_role_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_role_menu`;

CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`)
VALUES
	(1,2,NULL,NULL),
	(1,8,NULL,NULL),
	(1,9,NULL,NULL),
	(1,10,NULL,NULL),
	(1,11,NULL,NULL),
	(1,12,NULL,NULL),
	(1,13,NULL,NULL),
	(1,15,NULL,NULL),
	(1,16,NULL,NULL),
	(1,17,NULL,NULL),
	(1,18,NULL,NULL),
	(1,19,NULL,NULL),
	(1,20,NULL,NULL),
	(1,21,NULL,NULL),
	(1,22,NULL,NULL),
	(1,23,NULL,NULL),
	(1,24,NULL,NULL);

/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_role_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_role_permissions`;

CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`)
VALUES
	(1,1,NULL,NULL);

/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_role_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_role_users`;

CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,1,NULL,NULL);

/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_roles`;

CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`)
VALUES
	(1,'Administrator','administrator','2017-11-09 01:04:15','2017-11-09 01:04:15');

/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_user_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_user_permissions`;

CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table admin_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'admin','$2y$10$VYDK7uxaV8hN4I/BJKMOou46OQdypLYXqhM0JQ2CWs7lYTPyiTJb2','Administrator','images/3bbef3ead97fa6d9bb873b07d0dc5084.png','VnHrWEuPQ7OiZGxwM4Q4uFkbEcl7FioOtpn8C8Eu7EfuAgxXTdMDl798FJq9','2017-11-09 01:04:15','2017-11-09 02:01:48');

/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2016_01_04_173148_create_admin_tables',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
