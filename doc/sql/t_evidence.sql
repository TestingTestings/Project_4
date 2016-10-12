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
  `state` enum('change','normal','new') default 'normal',
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_evidence
-- ----------------------------
INSERT INTO `t_evidence` VALUES (null, '1', './Public/App/temp_1476016244329.jpg', '2016-10-09 08:28:02', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '2', './Public/App/12.mp3', '2016-10-10 12:27:53', 'mp3','normal');
INSERT INTO `t_evidence` VALUES (null, '2', './Public/App/temp_1476066623207.jpg', '2016-10-10 12:27:55', 'jpg','change');
INSERT INTO `t_evidence` VALUES (null, '3', './Public/App/temp_1476066623332.jpg', '2016-10-10 12:27:55', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '4', './Public/App/4.mp3', '2016-10-10 12:27:55', 'mp3','normal');
INSERT INTO `t_evidence` VALUES (null, '5', './Public/App/1476030623024.mp4', '2016-10-10 12:27:55', 'mp4','normal');
INSERT INTO `t_evidence` VALUES (null, '6', './Public/App/1476085712934.mp4', '2016-10-10 12:27:55', 'mp4','normal');
INSERT INTO `t_evidence` VALUES (null, '7', './Public/App/temp_1476085683345.jpg', '2016-10-10 12:27:55', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '8', './Public/App/temp_1476085683408.jpg', '2016-10-10 12:27:55', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '9', './Public/App/temp_1476085683475.jpg', '2016-10-10 12:27:55', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '10', './Public/App/temp_1476085683533.jpg', '2016-10-10 12:27:55', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '11', './Public/App/temp_1476085683592.jpg', '2016-10-10 12:27:55', 'jpg','normal');
INSERT INTO `t_evidence` VALUES (null, '2', './Public/App/temp_1476085683592.jpg', '2016-10-10 12:27:55', 'jpg','new');
