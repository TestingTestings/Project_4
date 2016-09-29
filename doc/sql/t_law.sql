

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_law
-- ----------------------------
DROP TABLE IF EXISTS `t_law`;
CREATE TABLE `t_law` (
  `id` int(5) auto_increment,
  `url` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_law
-- ----------------------------
INSERT INTO `t_law` VALUES 
('1', '/project_4/index.php/Admin/Car', '交通法','为了维护道路交通秩序，预防和减少交通事故，保护人身安全，保护公民、法人和其他组织的财产安全及其他合法权益，提高通行效率，制定本法。'),
('2', '/project_4/index.php/Admin/Car', '刑法','中华人民共和国境内的车辆驾驶人、行人、乘车人以及与道路交通活动有关的单位和个人，都应当遵守本法。'),
('3', '/project_4/index.php/Admin/Car', '宪法','道路交通安全工作，应当遵循依法管理、方便群众的原则，保障道路交通有序、安全、畅通。'),
('4', '/project_4/index.php/Admin/Car', '基本法','各级人民政府应当保障道路交通安全管理工作与经济建设和社会发展相适应。'),
('5', '/project_4/index.php/Admin/Car', '治安管理处罚条例','国务院公安部门负责全国道路交通安全管理工作。县级以上地方各级人民政府公安机关交通管理部门负责本行政区域内的道路交通安全管理工作。');