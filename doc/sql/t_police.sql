/*
Navicat MySQL Data Transfer

Source Server         : ss
Source Server Version : 50173
Source Host           : bdm246562162.my3w.com:3306
Source Database       : bdm246562162_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-09-24 14:20:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_police
-- ----------------------------
DROP TABLE IF EXISTS `t_police`;
CREATE TABLE `t_police` (
  `id` int(6) NOT NULL,
  `name` varchar(7) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `sex` enum('男','女') DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `area` text,
  `job` enum('协管','警员') DEFAULT NULL,
  `imei` bigint(15) DEFAULT NULL,
  `sim` bigint(11) DEFAULT NULL,
  `state` enum('quit','normal') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of t_police
-- ----------------------------
INSERT INTO `t_police` VALUES ('1', '小郭', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省仓山区', '警员', '862095022736364', null, 'normal');
INSERT INTO `t_police` VALUES ('2', '小丽', '25d55ad283aa400af464c76d713c07ad', '女', '22', '福建省鼓楼区', '协管', '862095022736364', null, 'quit');
INSERT INTO `t_police` VALUES ('3', '小红', '25d55ad283aa400af464c76d713c07ad', '女', '22', '福建省闽侯县', '警员', '862095022736364', null, 'normal');
INSERT INTO `t_police` VALUES ('4', '小倩', '25d55ad283aa400af464c76d713c07ad', '女', '22', '福建省台江区', '警员', '862095022736364', null, 'normal');
INSERT INTO `t_police` VALUES ('5', '小明', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省仓山区', '警员', '862095022736364', null, 'normal');
INSERT INTO `t_police` VALUES ('6', '小林', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省晋安区', '警员', '860485032067466', null, 'normal');
INSERT INTO `t_police` VALUES ('7', '小郑', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省鼓楼区', '协管', '860485032067466', null, 'normal');
INSERT INTO `t_police` VALUES ('8', '小胡', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省仓山区', '警员', '357989056596201', null, 'quit');
INSERT INTO `t_police` VALUES ('9', '天天', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省仓山区', '警员', '357989056596201', null, 'normal');
INSERT INTO `t_police` VALUES ('10', '小天', '25d55ad283aa400af464c76d713c07ad', '男', '22', '福建省仓山区', '警员', '357989056596201', null, 'normal');
INSERT INTO `t_police` VALUES ('11', '小郑', '25d55ad283aa400af464c76d713c07ad', '女', '22', '福建省仓山区', '协管', '867031021921025', null, 'normal');
