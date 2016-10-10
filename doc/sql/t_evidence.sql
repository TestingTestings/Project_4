/*
Navicat MySQL Data Transfer

Source Server         : 11
Source Server Version : 50710
Source Host           : localhost:3306
Source Database       : traffic_police

Target Server Type    : MYSQL
Target Server Version : 50710
File Encoding         : 65001

Date: 2016-10-10 09:11:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_evidence`
-- ----------------------------
DROP TABLE IF EXISTS `t_evidence`;
CREATE TABLE `t_evidence` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `case_id` int(5) DEFAULT NULL,
  `url` text,
  `time` datetime DEFAULT NULL,
  `type` text,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of t_evidence
-- ----------------------------
INSERT INTO `t_evidence` VALUES ('1', '1', './Public/App/temp_1476016244329.jpg', '2016-10-09 08:28:02', 'jpg');
INSERT INTO `t_evidence` VALUES ('2', '2', './Public/App/12.mp3', '2016-10-10 12:27:53', 'mp3');
INSERT INTO `t_evidence` VALUES ('3', '2', './Public/App/1476030623024.mp4', '2016-10-10 12:27:55', 'mp4');
