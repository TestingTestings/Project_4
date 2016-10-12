-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(4) NOT NULL,
  `name` char(8) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `power` enum('super','normal') DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES 
('1', '10055', '25d55ad283aa400af464c76d713c07ad','super',now()),
('2', '12537', '25d55ad283aa400af464c76d713c07ad','normal',now()),
('3', '45874', '25d55ad283aa400af464c76d713c07ad','normal',now()),
('4', '23487', '25d55ad283aa400af464c76d713c07ad','normal',now()),
('5', '72489', '25d55ad283aa400af464c76d713c07ad','super',now());