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
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` char(8) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `idcard` char(18) DEFAULT NULL,
  `regtime` date DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', '张三', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-23', '13100002701');
INSERT INTO `t_user` VALUES ('2', '李四', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-24', '13509352040');
INSERT INTO `t_user` VALUES ('3', 'lisa', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-25', '18616388043');
INSERT INTO `t_user` VALUES ('4', 'lili', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-26', '13959182032');
INSERT INTO `t_user` VALUES ('5', 'tom', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-27', '13860664676');
INSERT INTO `t_user` VALUES ('6', 'mary', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-28', '15394539310');
INSERT INTO `t_user` VALUES ('7', 'jackiet', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-29', '15280126526');
INSERT INTO `t_user` VALUES ('8', '小五', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-23', '13860625141');
INSERT INTO `t_user` VALUES ('9', '郑三', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-10-02', '15195914810');
INSERT INTO `t_user` VALUES ('10', '关小', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-10-03', '13675008063');
INSERT INTO `t_user` VALUES ('11', '李大', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-10-04', '13728569852');
