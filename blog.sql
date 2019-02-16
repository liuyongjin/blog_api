# Host: localhost  (Version: 5.5.53)
# Date: 2019-02-16 11:07:21
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "article"
#

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `main_img` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `praise_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
  `browse_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

#
# Data for table "article"
#

INSERT INTO `article` VALUES (1,'123','','','',0,0,0,0,1548508681,NULL),(2,'123','','','',0,0,0,0,1548508683,NULL),(3,'123','123','234','',0,0,0,0,1548506916,NULL),(4,'1','2','123','',0,0,0,1548506530,1548506530,NULL),(5,'1','2','123','',0,0,0,1548506595,1548506595,NULL),(6,'1','2','123','',0,0,0,1548509119,1548509119,NULL),(11,'1','2','123','',0,0,0,1548555644,1548555644,NULL),(12,'1','2','123','',0,0,0,1548555692,1548555692,NULL),(13,'1','2','123','',0,0,0,1548555804,1548555804,NULL),(14,'1','2','123','',0,0,0,1548555934,1548555934,NULL),(15,'1','2','123','',0,0,0,1548556049,1548556049,NULL),(18,'1','2','123','',0,0,0,1548556918,1548556918,NULL),(19,'asdf','asdf','sfd','',0,0,0,1548557004,1548560456,NULL),(20,'1','2','123','',0,0,0,1548557263,1548557263,NULL);

#
# Structure for table "comment"
#

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL DEFAULT '0',
  `member_id` int(11) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# Data for table "comment"
#

INSERT INTO `comment` VALUES (1,123,0,'123',1548384877,1548385371,1548385371),(2,1,0,'2',1548384897,1548384897,NULL);

#
# Structure for table "config"
#

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_dev` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1是开发者，0不是开发者',
  `config_app` int(11) NOT NULL DEFAULT '0',
  `config_name` varchar(50) NOT NULL DEFAULT '',
  `config_key` int(11) unsigned NOT NULL DEFAULT '0',
  `config_value` varchar(100) NOT NULL DEFAULT '',
  `config_ext` text NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# Data for table "config"
#

/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,1,300,'tetssadf',0,'test231asdf','',1548302553,1548302782,NULL),(2,1,300,'123',0,'test231asdf','',1548303039,1548303274,NULL);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

#
# Structure for table "login_log"
#

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) NOT NULL DEFAULT '',
  `login_ip` char(20) NOT NULL DEFAULT '',
  `login_adress` varchar(255) NOT NULL DEFAULT '',
  `user_or_memeber` bit(1) NOT NULL DEFAULT b'0' COMMENT '后台用户还是前台用户,0前台，1后台',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='登录日志';

#
# Data for table "login_log"
#


#
# Structure for table "member"
#

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '验证码',
  `token` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '',
  `last_login_time` int(10) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='后台用户表';

#
# Data for table "member"
#

INSERT INTO `member` VALUES (1,'1234','adcd7048512e64b48da55b027577886ee5a36350','1','','','',0,1548387384,1548390571,1548390571),(2,'123','adcd7048512e64b48da55b027577886ee5a36350','1','ffa55d49938db3f78db91bb37b0b527b','','127.0.0.1',1548390278,1548389201,1548390278,NULL);

#
# Structure for table "tag"
#

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `des` varchar(150) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

#
# Data for table "tag"
#

INSERT INTO `tag` VALUES (1,'1fadsf','1asdf',1548251753,1549765480,1549765480),(2,'标签2','标签2',1548251759,1549765658,1549765658),(3,'1','1',1548251899,1549765756,1549765756),(4,'asdf','asdf',1548251956,1549765758,1549765758),(5,'asdf','asdf',1548252020,1549765201,NULL),(6,'asdf','asdf',1548252025,1549765766,1549765766),(7,'asdf','asdf',1548252027,1549765766,1549765766),(8,'asdf','',1548507667,1549765475,1549765475),(10,'','',1548555644,1549765475,1549765475),(11,'','',1548555692,1549765475,1549765475),(12,'','',1548555804,1549765229,NULL),(19,'','',1548559066,1549765229,NULL),(20,'123','',0,1549765267,NULL),(21,'士大夫士大夫','',0,1549764243,NULL),(22,'阿萨德发生的范德萨','',0,0,NULL),(23,'阿斯蒂芬答复阿斯蒂芬的三大','',0,0,NULL);

#
# Structure for table "tag_article"
#

DROP TABLE IF EXISTS `tag_article`;
CREATE TABLE `tag_article` (
  `tag_id` int(10) unsigned NOT NULL COMMENT '关联id',
  `article_id` int(10) unsigned NOT NULL COMMENT '关联id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`tag_id`,`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tag_article"
#

INSERT INTO `tag_article` VALUES (1,1,0,0,NULL),(1,14,0,0,NULL),(1,15,0,0,NULL),(1,18,0,0,NULL),(1,19,0,0,NULL),(1,20,0,0,NULL),(2,19,0,0,NULL),(2,20,0,0,NULL),(3,19,0,0,NULL),(3,20,0,0,NULL),(6,1,0,0,NULL),(10,11,0,0,NULL),(11,12,0,0,NULL),(11,19,0,0,NULL),(12,13,0,0,NULL),(12,19,0,0,NULL),(13,19,0,0,NULL),(16,19,0,0,NULL);

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='后台用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'123','','adcd7048512e64b48da55b027577886ee5a36350','3cfaad8c2a3bfc1231416a26827f9a00','','127.0.0.1',1549610420,1547107739,1549610420,0),(2,'123','','adcd7048512e64b48da55b027577886ee5a36350','3cfaad8c2a3bfc1231416a26827f9a00','','127.0.0.1',1549610420,1547107739,1549610420,0),(3,'1','','0937afa17f4dc08f3c0e5dc908158370ce64df86','','','',0,1548387328,1548387328,NULL),(4,'admin','','10470c3b4b1fed12c3baac014be15fac67c6e815','5e15ae303a6692490536e4b3ea943b44','','127.0.0.1',1549701423,1549606114,1549701423,NULL);
