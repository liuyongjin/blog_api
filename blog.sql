# Host: localhost  (Version: 5.5.53)
# Date: 2019-07-03 10:59:26
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "article"
#

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `des` varchar(100) NOT NULL DEFAULT '',
  `main_img` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `praise_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
  `browse_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

#
# Data for table "article"
#

INSERT INTO `article` VALUES (1,'123',1,'123','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,4,5,1548506530,1561528318,NULL),(2,'123',1,'123','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,4,1548506530,1561373648,NULL),(3,'123',0,'123','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,2,1548506530,1561375117,NULL),(4,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,8,1548506530,1561528318,NULL),(5,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,78,1548506595,1561528321,NULL),(6,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,6,1548509119,1561533320,NULL),(11,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,3,1548555644,1548555644,NULL),(12,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,4,1548555692,1561533226,NULL),(13,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,2,1548555804,1561373654,NULL),(14,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,4,1548555934,1561373654,NULL),(15,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,4,1548556049,1561373654,NULL),(18,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,3,1548556918,1561373582,NULL),(19,'asdf',1,'asdf','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,6,1548557004,1561375096,NULL),(20,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,14,23,1548557263,1548557263,NULL),(21,'1',1,'2','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png','',0,0,3,1561541571,1561541571,NULL),(22,' 新增文章',1,' 新增文章','/uploads/20190627/8676531ed43a9ce1e49889f612f9ca6b.png',' 新增文章',0,0,2,1561624601,1561689846,NULL),(23,'新标题',0,'新标题','/uploads/20190627/0955290a537d456844ce5aac48d5bdf1.png','新标题',0,0,0,1561625225,1561625225,NULL),(24,'心安神豆腐块拉萨地方',1,'心安神豆腐块拉萨地方','/uploads/20190627/bbdff646113973118b1e4461f4765386.png','心安神豆腐块拉萨地方心安神豆腐块拉萨地方心安神豆腐块拉萨地方心安神豆腐块拉萨地方心安神豆腐块拉萨地方',0,0,3,1561634112,1561634112,NULL),(25,'123',0,'231','/uploads/20190627/7c4d879cf9d539cbfb4c366c64007c2a.png','asdasdasd',0,0,1,1561634593,1561688618,NULL),(26,'的萨法师地方',0,'的萨法师地方的萨法师地方的萨法师地方的的萨法师地方的萨法师地方的萨法师地方的的萨法师地方的萨法师地方的萨法师地方的的萨法师地方的萨法师地方的萨法师地方的','/uploads/20190627/65ca41a924895ed7969e8e3adea7e6b4.png','的萨法师地方的萨法师地方的萨法师地方的的萨法师地方的萨法师地方的萨法师地方的的萨法师地方的萨法师地方的萨法师地方的的萨法师地方的萨法师地方的萨法师地方的',0,0,2,1561637280,1561815330,NULL),(27,'1251341',1,'sadfasdfasdf','/uploads/20190627/c32b46a7ba667c6b394450ccf31b8e6d.png','123',0,0,1,1561640372,1561691165,NULL),(28,'测试测试',1,'测试测试','/uploads/20190628/1ab092ccc7e7298055f26c050fb95de8.png','测试测试测试测试测试测试',0,0,1,1561914000,1561717322,NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

#
# Data for table "config"
#

/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,1,300,'system_visits',0,'165','',1548303039,1562085518,NULL),(2,1,300,'system_article_count',0,'22','',0,1562085518,NULL),(3,1,300,'system_tag_count',0,'16','',0,1562085518,NULL),(4,1,300,'system_create_time',0,'1559491200','',1548302553,1548302782,NULL);
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
  `color` varchar(10) NOT NULL DEFAULT '#ffffff',
  `bg_color` varchar(10) NOT NULL DEFAULT '#2db7f5',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

#
# Data for table "tag"
#

INSERT INTO `tag` VALUES (1,'1fadsf','1asdf','#ffffff','#666',1548251753,1561385170,NULL),(2,'标签2','标签2','#ffffff','#666',1548251759,1561385734,NULL),(3,'1','1','#ffffff','#666',1548251899,1561447801,NULL),(4,'asdf','asdf','#ffffff','#666',1548251956,1561447810,NULL),(5,'asdf','asdf','#ffffff','#666',1548252020,1561385755,NULL),(6,'asdf','asdf','#ffffff','#2db7f5',1548252025,1561447810,NULL),(7,'asdf','asdf','#ffffff','#2db7f5',1548252027,1561449214,NULL),(8,'asdf','','#ffffff','#2db7f5',1548507667,1561449214,NULL),(10,'asdf12341234','asdfasdfasdf','#ffffff','#2db7f5',1548555644,1561451808,NULL),(11,'','','#ffffff','#2db7f5',1548555692,1561691115,1561691115),(12,'','','#ffffff','#2db7f5',1548555804,1561528459,NULL),(19,'','','#ffffff','#2db7f5',1548559066,1561469598,NULL),(20,'123','','#ffffff','#2db7f5',0,1549765267,NULL),(21,'士大夫士大夫','','#ffffff','#2db7f5',0,1549764243,NULL),(22,'aaaaabbbbb111','123asdfasd123','#ffffff','#2db7f5',1561446825,1561470034,NULL),(23,'asdfasdf123','asdfasdfa12111','#ffffff','#2db7f5',1561447829,1561470038,NULL),(24,'asdfasdfas','asdf','#ffffff','#2db7f5',1561468990,1561691134,1561691134),(25,'阿斯蒂芬','啊时代发生','#ffffff','#2db7f5',1561469472,1561691144,NULL);

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

INSERT INTO `tag_article` VALUES (1,1,0,0,NULL),(1,2,0,0,NULL),(1,14,0,0,NULL),(1,15,0,0,NULL),(1,18,0,0,NULL),(1,19,0,0,NULL),(1,20,0,0,NULL),(1,21,0,0,NULL),(2,19,0,0,NULL),(2,20,0,0,NULL),(2,21,0,0,NULL),(2,28,0,0,NULL),(3,19,0,0,NULL),(3,20,0,0,NULL),(6,1,0,0,NULL),(10,11,0,0,NULL),(10,24,0,0,NULL),(11,12,0,0,NULL),(11,19,0,0,NULL),(12,13,0,0,NULL),(12,19,0,0,NULL),(13,19,0,0,NULL),(16,19,0,0,NULL),(23,26,0,0,NULL),(24,23,0,0,NULL),(25,22,0,0,NULL),(25,25,0,0,NULL),(25,27,0,0,NULL);

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

INSERT INTO `user` VALUES (1,'123','','adcd7048512e64b48da55b027577886ee5a36350','0b43e03a0701eb1d4b6e22f0cbcc0daf','http://blog.com/static/imgs/avatar.jpg','127.0.0.1',1561609365,1547107739,1561609365,0),(2,'123','','adcd7048512e64b48da55b027577886ee5a36350','0b43e03a0701eb1d4b6e22f0cbcc0daf','http://blog.com/static/imgs/avatar.jpg','127.0.0.1',1561609365,1547107739,1561609365,0),(3,'1','','0937afa17f4dc08f3c0e5dc908158370ce64df86','','http://blog.com/static/imgs/avatar.jpg','',0,1548387328,1548387328,NULL),(4,'admin','','10470c3b4b1fed12c3baac014be15fac67c6e815','3794d961e214b6b6000106ba8030cd65','http://blog.com/static/imgs/avatar.jpg','127.0.0.1',1562079908,1549606114,1562079908,NULL);
