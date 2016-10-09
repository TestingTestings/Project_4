-- ----------------------------
-- Table structure for t_case
-- ----------------------------
DROP TABLE IF EXISTS `t_casehandle`;
CREATE TABLE `t_casehandle` (
  `id` int(5) auto_increment,
  `case_id` int(5),
  `content` text,
  `state` enum('申诉','修正'),
  `happentime` datetime,
  `handletime` datetime,
  `state2` enum('未处理','已处理') default '未处理',
  foreign key(case_id) references t_case(id),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_casehandle
-- ----------------------------

INSERT INTO `t_casehandle` VALUES
(null, 3, '车辆记录错误','申诉','2015-12-12 10:10:10','','未处理'),
(null, 5,'路面标识不明确','申诉','2015-12-12 10:10:10','','未处理'),
(null, 6, '罚款金额变更50->30','修正','2015-12-12 10:10:10','','未处理'),
(null, 7, '违章停车改为冲撞交警','修正','2015-12-12 10:10:10','','未处理');


