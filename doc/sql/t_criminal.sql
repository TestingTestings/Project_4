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
  `state` enum('在逃','抓获'),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_criminal
-- ----------------------------
INSERT INTO `t_criminal` VALUES ('1','张三', '杀了人', '/Project_4/Public/Common/head_img/crim1.jpg', '在逃');
INSERT INTO `t_criminal` VALUES ('2','李四', '抢劫犯', '/Project_4/Public/Common/head_img/crim2.jpg', '在逃');
INSERT INTO `t_criminal` VALUES ('3','王五', '抢劫犯', '/Project_4/Public/Common/head_img/crim3.jpg', '在逃');
INSERT INTO `t_criminal` VALUES ('4','张六', '撞死人', '/Project_4/Public/Common/head_img/crim4.jpg', '抓获');
INSERT INTO `t_criminal` VALUES ('5','李器', '肇事逃逸', '/Project_4/Public/Common/head_img/crim5.jpg', '抓获');
INSERT INTO `t_criminal` VALUES ('6','王吧', '偷车', '/Project_4/Public/Common/head_img/crim6.jpg', '在逃');
