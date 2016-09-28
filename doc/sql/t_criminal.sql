/*
Navicat MySQL Data Transfer

Source Server         : ss
Source Server Version : 50173
Source Host           : bdm246562162.my3w.com:3306
Source Database       : bdm246562162_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-09-24 14:04:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_criminal
-- ----------------------------
DROP TABLE IF EXISTS `t_criminal`;
CREATE TABLE `t_criminal` (
  `id` int(5) AUTO_INCREMENT,
  `name` char(8) unique,
  `action` text DEFAULT NULL,
  `head` text DEFAULT NULL,
  `state` enum('escape','catch'),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_criminal
-- ----------------------------
INSERT INTO `t_criminal` VALUES ('1','张三', '杀了人', '', 'escape');
INSERT INTO `t_criminal` VALUES ('2','李四', '抢劫犯', '', 'escape');
INSERT INTO `t_criminal` VALUES ('3','王五', '抢劫犯', '', 'escape');
INSERT INTO `t_criminal` VALUES ('','张六', '撞死人', '', 'catch');
INSERT INTO `t_criminal` VALUES ('','李器', '肇事逃逸', '', 'catch');
INSERT INTO `t_criminal` VALUES ('','王吧', '偷车', '', 'escape');
