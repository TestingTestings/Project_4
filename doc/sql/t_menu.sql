﻿/*
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
-- Table structure for t_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE `t_menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fid` int(5) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `power` enum('super','normal') DEFAULT NULL,
  `url` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_menu
-- ----------------------------
INSERT INTO `t_menu` VALUES 
('1', '0', '车辆查询', 'normal', '/project_4/index.php/Admin/Car'),
('2', '0', '新闻', 'normal', '/project_4/index.php/Admin/Car/News'),
('3', '0', '法规', 'normal', '/project_4/index.php/Admin/Index/law'),
('4', '0', '协查通报', 'normal', ''),
('5', '0', '用户管理', 'normal', '/project_4/index.php/Admin/Index/user'),
('6', '0', '警员管理', 'super', '/project_4/index.php/Admin/Index/police'),
('7', '0', '违章管理', 'normal', '/project_4/index.php/Admin/Index/peccancy'),
('8', '2', '新闻编辑', 'normal', ''),
('9', '2', '新闻预览', 'normal', ''),
('10', '3', '法规查询', 'normal', ''),
('11', '3', '法规修正', 'normal', ''),
('12', '4', '通报更新', 'normal', '/project_4/index.php/Admin/car/criminal'),
('13', '4', '通报查询', 'normal', ''),
('14', '7', '违章查看', 'normal', '/project_4/index.php/Admin/Index/police_case'),
('15', '7', '申诉处理', 'normal', '/project_4/index.php/Admin/Index/police_appeal'),
('16', '7', '修正处理', 'normal', '');