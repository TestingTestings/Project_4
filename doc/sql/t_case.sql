-- ----------------------------
-- Table structure for t_case
-- ----------------------------
DROP TABLE IF EXISTS `t_case`;
CREATE TABLE `t_case` (
  `id` int(5) auto_increment,
  `place` text,
  `log` float(5),
  `lat` float(5),
  `police_id` int(6),
  `happentime` datetime,
  `car_id` char(6),
  `content` text,
  `cost` int(3),
  `law_id` int(5),
  `punishment` text,
  `infoway` enum('现场执法','非现场执法'),
  `state` enum('未处理','已处理','申诉','修正','销毁'),
  `handletime` datetime,
  foreign key(police_id) references t_police(id),
  foreign key(car_id) references t_car(id),
  foreign key(law_id) references t_law(id),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_case
-- ----------------------------

INSERT INTO `t_case` VALUES 
(null, '上海新村', 100,25,1,'2015-01-03 10:12:11','闽A0001','违章停车',50,'','罚款','现场执法','未处理',''),
(null, '普陀山', 100,25,1,'2015-01-03 10:12:11','闽B0002','压实线',50,'','罚款','现场执法','已处理',''),
(null, '东街口', 100,25,1,'2015-01-03 10:12:11','闽A0001','违章变道',50,'','罚款','现场执法','申诉',''),
(null, '五四路口', 100,25,1,'2015-01-03 10:12:11','闽A0001','违章停车',50,'','罚款','现场执法','未处理',''),
(null, '省立医院', 100,25,1,'2015-01-03 10:12:11','闽A0007','违章停车',50,'','罚款','现场执法','申诉',''),
(null, '仓山万达', 100,25,1,'2015-01-03 10:12:11','闽C0009','酒后驾车',50,'','罚款','现场执法','修正',''),
(null, '福建农林大学', 100,25,1,'2015-01-03 10:12:11','闽A0001','超速',50,'','罚款','现场执法','修正','');

