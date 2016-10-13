-- ----------------------------
-- Table structure for t_criminal
-- ----------------------------
DROP TABLE IF EXISTS `t_criminal`;
CREATE TABLE `t_criminal` (
  `id` int(5) AUTO_INCREMENT,
  `name` char(8) unique,
  `action` text DEFAULT NULL,
  `head` text DEFAULT NULL,
  `state` enum('在逃','抓获'),
  `car_id` varchar(7),
  `driver_car` bigint(12),
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_criminal
-- ----------------------------
INSERT INTO `t_criminal` VALUES ('1','张三', '杀了人', '/project_4/Public/common/head_img/crim1.jpg', '在逃','闽A55801','112543525687');
INSERT INTO `t_criminal` VALUES ('2','李四', '抢劫犯', '/project_4/Public/common/head_img/crim2.jpg', '在逃','闽A55301','132544325547');
INSERT INTO `t_criminal` VALUES ('3','王五', '抢劫犯', '/project_4/Public/common/head_img/crim3.jpg', '在逃','闽A51861','132544325547');
INSERT INTO `t_criminal` VALUES ('','张六', '撞死人', '/project_4/Public/common/head_img/crim4.jpg', '抓获','闽A25841','132558954147');
INSERT INTO `t_criminal` VALUES ('','李器', '肇事逃逸', '/project_4/Public/common/head_img/crim5.jpg', '抓获','闽Aq5632','115978515517');
INSERT INTO `t_criminal` VALUES ('','王吧', '偷车', '/project_4/Public/common/head_img/crim6.jpg', '在逃','闽  Ah5801','126987462584');
