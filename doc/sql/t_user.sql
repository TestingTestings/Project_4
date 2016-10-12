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
  `drive_card` bigint(12),
  `score` int(3) default 12,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', '张三', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-23', '13100002701',840055586791,12);
INSERT INTO `t_user` VALUES ('2', '李四', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-24', '13509352040',587956841254,12);
INSERT INTO `t_user` VALUES ('3', 'lisa', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-25', '18616388043',321875568755,12);
INSERT INTO `t_user` VALUES ('4', 'lili', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-26', '13959182032',321465792357,12);
INSERT INTO `t_user` VALUES ('5', 'tom', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-27', '13860664676',687984525879,12);
INSERT INTO `t_user` VALUES ('6', 'mary', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-28', '15394539310',321687987855,12);
INSERT INTO `t_user` VALUES ('7', 'jackiet', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-29', '15280126526',987426254212,12);
INSERT INTO `t_user` VALUES ('8', '小五', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-09-23', '13860625141',358987456321,12);
INSERT INTO `t_user` VALUES ('9', '郑三', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-10-02', '15195914810',458798976320,12);
INSERT INTO `t_user` VALUES ('10', '关小', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-10-03', '13675008063',580285891258,12);
INSERT INTO `t_user` VALUES ('11', '李大', '25d55ad283aa400af464c76d713c07ad', '350322XXXXXXXXXXXX', '2016-10-04', '13728569852',388459952778,12);
