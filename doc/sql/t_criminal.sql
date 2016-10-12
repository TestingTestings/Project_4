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
  `car_id` varchar(7),
  `driver_car` bigint(12),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of t_criminal
-- ----------------------------
INSERT INTO `t_criminal` VALUES ('1','张三', '杀了人', '../../../../../Public/Admin/images/c1s.png', 'escape','闽A55801','112543525687');
INSERT INTO `t_criminal` VALUES ('2','李四', '抢劫犯', '../../../../../Public/Admin/images/c2s.png', 'escape','闽A55301','132544325547');
INSERT INTO `t_criminal` VALUES ('3','王五', '抢劫犯', '../../../../../Public/Admin/images/c3s.png', 'escape','闽A51861','132544325547');
INSERT INTO `t_criminal` VALUES ('','张六', '撞死人', '../../../../../Public/Admin/images/c4s.png', 'catch','闽A25841','132558954147');
INSERT INTO `t_criminal` VALUES ('','李器', '肇事逃逸', '../../../../../Public/Admin/images/c5s.png', 'catch','闽Aq5632','115978515517');
INSERT INTO `t_criminal` VALUES ('','王吧', '偷车', '../../../../../Public/Admin/images/c6s.png', 'escape','闽Ah5801','126987462584');
