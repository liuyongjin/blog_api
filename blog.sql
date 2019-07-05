/*
Navicat MySQL Data Transfer

Source Server         : 23.251.52.244
Source Server Version : 50562
Source Host           : 23.251.52.244:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 65001

Date: 2019-07-05 15:22:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('29', 'linux常用命令与配置', '1', 'linux相关', '/uploads/20190705/0ecc9ae6790037d2c9ac5c7ed54bbb6b.png', 'linux相关', '0', '0', '10', '1562307398', '1562307398', null);

-- ----------------------------
-- Table structure for config
-- ----------------------------
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

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '1', '300', 'system_visits', '0', '9', '', '1548303039', '1562310073', null);
INSERT INTO `config` VALUES ('2', '1', '300', 'system_article_count', '0', '1', '', '0', '1562310073', null);
INSERT INTO `config` VALUES ('3', '1', '300', 'system_tag_count', '0', '1', '', '0', '1562310073', null);
INSERT INTO `config` VALUES ('4', '1', '300', 'system_create_time', '0', '1559491200', '', '1548302553', '1548302782', null);

-- ----------------------------
-- Table structure for login_log
-- ----------------------------
DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) NOT NULL DEFAULT '',
  `login_ip` char(20) NOT NULL DEFAULT '',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='登录日志';

-- ----------------------------
-- Records of login_log
-- ----------------------------

-- ----------------------------
-- Table structure for tag
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('26', 'linux', 'linux相关', '#ffffff', '#2db7f5', '1562307351', '1562307351', null);
INSERT INTO `tag` VALUES ('27', '123', '123', '#ffffff', '#2db7f5', '1562307490', '1562308351', '1562308351');

-- ----------------------------
-- Table structure for tag_article
-- ----------------------------
DROP TABLE IF EXISTS `tag_article`;
CREATE TABLE `tag_article` (
  `tag_id` int(10) unsigned NOT NULL COMMENT '关联id',
  `article_id` int(10) unsigned NOT NULL COMMENT '关联id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`tag_id`,`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tag_article
-- ----------------------------
INSERT INTO `tag_article` VALUES ('26', '29', '0', '0', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
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

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'test', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'a4243a288cd6976202c38c6fdbfecb53', '/uploads/20190705/7ed18d21811ff9abddd49b6787d2cd51.jpg', '171.212.186.101', '1562308071', '1547107739', '1562308071', '0');
