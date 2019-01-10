-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.53 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 blog 的数据库结构
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `blog`;

-- 导出  表 blog.article 结构
CREATE TABLE IF NOT EXISTS `article` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `main_img` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `praise_count` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- 正在导出表  blog.article 的数据：~3 rows (大约)
DELETE FROM `article`;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`Id`, `title`, `description`, `main_img`, `content`, `comment_count`, `praise_count`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, '123', '', '', '', 0, 0, 0, 1547115622, 1547115622),
	(2, '123', '', '', '', 0, 0, 0, 0, NULL),
	(3, '123421343', '', '', '', 0, 0, 0, 1547115483, 1547115483);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- 导出  表 blog.comment 结构
CREATE TABLE IF NOT EXISTS `comment` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  blog.comment 的数据：~0 rows (大约)
DELETE FROM `comment`;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- 导出  表 blog.config 结构
CREATE TABLE IF NOT EXISTS `config` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `config_dev` int(11) unsigned NOT NULL DEFAULT '0',
  `config_name` varchar(50) NOT NULL DEFAULT '',
  `config_key` varchar(100) NOT NULL DEFAULT '',
  `config_value` varchar(100) NOT NULL DEFAULT '',
  `config_ext` text NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- 正在导出表  blog.config 的数据：0 rows
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- 导出  表 blog.images 结构
CREATE TABLE IF NOT EXISTS `images` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  blog.images 的数据：~0 rows (大约)
DELETE FROM `images`;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- 导出  表 blog.login_log 结构
CREATE TABLE IF NOT EXISTS `login_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) NOT NULL DEFAULT '',
  `login_ip` char(20) NOT NULL DEFAULT '',
  `login_adress` varchar(255) NOT NULL DEFAULT '',
  `user_or_memeber` bit(1) NOT NULL DEFAULT b'0' COMMENT '后台用户还是前台用户,0前台，1后台',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='登录日志';

-- 正在导出表  blog.login_log 的数据：~0 rows (大约)
DELETE FROM `login_log`;
/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;

-- 导出  表 blog.member 结构
CREATE TABLE IF NOT EXISTS `member` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '',
  `last_login_time` int(10) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='后台用户表';

-- 正在导出表  blog.member 的数据：0 rows
DELETE FROM `member`;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- 导出  表 blog.user 结构
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '',
  `last_login_time` int(10) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='后台用户表';

-- 正在导出表  blog.user 的数据：2 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`Id`, `username`, `nickname`, `password`, `token`, `avatar`, `last_login_ip`, `last_login_time`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, '123', '', 'adcd7048512e64b48da55b027577886ee5a36350', '2506d520e69e196dda209d0343d9de24', '', '127.0.0.1', 1547110779, 1547107739, 1547110779, 0),
	(2, '123', '', 'adcd7048512e64b48da55b027577886ee5a36350', '2506d520e69e196dda209d0343d9de24', '', '127.0.0.1', 1547110779, 1547107739, 1547110779, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
