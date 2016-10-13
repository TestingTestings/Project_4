﻿
DROP TABLE IF EXISTS `t_case`;
CREATE TABLE `t_case` (
  `id` int(5) auto_increment,
  `place` text,
  `log` float(5),
  `lat` float(5),
  `police_id` int(6),
  `happentime` datetime,
  `car_id` char(6),
  `drive_card` bigint(12),
  `content` text,
  `cost` int(3),
  `score` int(3),
  `law_id` int(5),
  `punishment` text,
  `infoway` enum('现场执法','非现场执法'),
  `state` enum('未处理','已处理','申诉','修正','销毁','审核'),
  `handletime` datetime,
  foreign key(police_id) references t_police(id),
  foreign key(car_id) references t_car(id),
  foreign key(law_id) references t_law(id),
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 CHARSET=utf8;

-- ----------------------------
-- Records of t_case
-- ----------------------------

INSERT INTO `t_case` VALUES 
(null, '上海新村', 100,25,1,'2015-01-03 10:12:11','闽A0001',321687987855,'临时停车',10,3,153,'罚款扣分','现场执法','未处理',''),
(null, '金牛山公园', 100,25,1,'2015-01-03 10:12:11','闽A0001',840055586791,'临时停车',100,3,153,'罚款扣分','现场执法','修正',''),
(null, '洪山桥', 100,25,1,'2015-01-03 10:12:11','闽C0015',587956841254,'严重超速',0,12,146,'扣分','现场执法','未处理',''),
(null, '巴拉拉小魔仙的家', 100,25,1,'2015-01-03 10:12:11','闽D0010',321875568755,'违章会车',0,2,152,'扣分','现场执法','未处理',''),
(null, '铜盘新村', 100,25,1,'2015-01-03 10:12:11','闽C0021',321875568755,'占用应急车道',200,6,159,'罚款扣分','现场执法','申诉',''),
(null, '甘蔗小区', 100,25,1,'2015-01-03 10:12:11','闽A0001',321465792357,'酒后驾驶',200,12,158,'拘留罚款扣分','现场执法','审核',''),
(null, '省府路口', 100,25,1,'2015-01-03 10:12:11','闽E0017',840055586791,'行驶途中拨打手机',0,2,149,'扣分','现场执法','申诉',''),
(null, '普陀山', 100,25,1,'2015-01-03 10:12:11','闽B0002',687984525879,'强行塞车',200,0,156,'罚款','现场执法','已处理',''),
(null, '东街口', 100,25,1,'2015-01-03 10:12:11','闽A0001',580285891258,'违法使用灯光',50,1,160,'罚款扣分','现场执法','申诉',''),
(null, '五四路口', 100,25,1,'2015-01-03 10:12:11','闽A0001',587956841254,'高速公路低于限速',50,3,157,'罚款扣分','现场执法','审核',''),
(null, '省立医院', 100,25,1,'2015-01-03 10:12:11','闽A0007',987426254212,'未带驾照',50,1,155,'罚款扣分','现场执法','申诉',''),
(null, '仓山万达', 100,25,1,'2015-01-03 10:12:11','闽C0009',321687987855,'超载',200,6,151,'罚款扣分','现场执法','修正',''),
(null, '福建农林大学', 100,25,1,'2015-01-03 10:12:11','闽A0001',388459952778,'有意遮挡号牌，变造号牌',0,12,150,'扣分','现场执法','修正','');

