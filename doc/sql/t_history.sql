-- ----------------------------
-- Table structure for t_history
-- ----------------------------
DROP TABLE IF EXISTS `t_history`;
CREATE TABLE `t_history` (
  `id` int(5) auto_increment PRIMARY key,
  user bigint(11),
  car_id CHAR(6),
  time DATETIME DEFAULT now()
)AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



