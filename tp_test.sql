/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : tp_test

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 18/09/2019 12:25:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (20190918023128, 'CreateTableUser', '2019-09-18 10:33:14', '2019-09-18 10:33:14', 0);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名，登陆使用',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `login_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登陆状态',
  `last_login_ip` varchar(100) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态，1已删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '127.0.0.1', '2019-09-18 12:21:27', 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
