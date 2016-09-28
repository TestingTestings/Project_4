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
-- Table structure for t_news
-- ----------------------------
DROP TABLE IF EXISTS `t_news`;
CREATE TABLE `t_news` (
  `id` int(5) auto_increment primary key,
  `title` varchar(30) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `time` date DEFAULT NULL,
  `valid` date DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_news
-- ----------------------------


INSERT INTO `t_news` VALUES ('01', '台风登入福建1', '将带来大雨，大风袭击', '2016-09-21', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('02', '台风登入福建2', '将带来大雨，大风袭击', '2016-09-21', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('03', '台风登入福建3', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('04', '台风登入福建4', '将带来大雨，大风袭击', '2016-09-23', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('05', '台风登入福建5', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('06', '台风登入福建6', '将带来大雨，大风袭击', '2016-09-22', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('07', '台风登入福建7', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('08', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('09', '台风登入福建', '将带来大雨，大风袭击', '2016-09-26', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('10', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('11', '台风登入福建', '将带来大雨，大风袭击', '2016-09-26', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('12', '台风登入福建', '将带来大雨，大风袭击', '2016-09-27', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('13', '台风登入福建', '将带来大雨，大风袭击', '2016-09-26', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('14', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('15', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
INSERT INTO `t_news` VALUES ('', '台风登入福建', '将带来大雨，大风袭击', '2016-09-24', '2016-09-28', '');
