-- ----------------------------
-- Table structure for t_car
-- ----------------------------
DROP TABLE IF EXISTS `t_car`;
CREATE TABLE `t_car` (
  `id` char(6),
  `type` enum('小轿车','客车','货车','三轮车','拖拉机'),
  `vin` char(6),
  `local` char(8),
  `color` enum('白色','黑色','蓝色','绿色','红色'),
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_car
-- ----------------------------

INSERT INTO `t_car` VALUES ('闽A0001', '小轿车', '000001', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0002', '客车', '000002', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0003', '货车', '000003', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0004', '三轮车', '000004', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0005', '拖拉机', '000005', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0006', '小轿车', '000006', '闽F', '黑色');
INSERT INTO `t_car` VALUES ('闽A0007', '小轿车', '000007', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0008', '客车', '000008', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0009', '货车', '000009', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0010', '三轮车', '000010', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0011', '拖拉机', '000011', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0012', '小轿车', '000012', '闽F', '黑色');
INSERT INTO `t_car` VALUES ('闽A0013', '小轿车', '000013', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0014', '客车', '000014', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0015', '货车', '000015', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0016', '三轮车', '000016', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0017', '拖拉机', '000017', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0018', '小轿车', '000018', '闽F', '黑色');
INSERT INTO `t_car` VALUES ('闽A0019', '小轿车', '000019', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0020', '客车', '000020', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0021', '货车', '000021', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0022', '三轮车', '000022', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0023', '拖拉机', '000023', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0024', '小轿车', '000024', '闽F', '黑色');
INSERT INTO `t_car` VALUES ('闽A0025', '小轿车', '000025', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0026', '客车', '000026', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0027', '货车', '000027', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0028', '三轮车', '000028', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0029', '拖拉机', '000029', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0030', '小轿车', '000030', '闽F', '黑色');
INSERT INTO `t_car` VALUES ('闽A0031', '小轿车', '000031', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0032', '客车', '000032', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0033', '货车', '000033', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0034', '三轮车', '000034', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0035', '拖拉机', '000035', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0036', '小轿车', '000036', '闽F', '黑色');
INSERT INTO `t_car` VALUES ('闽A0037', '小轿车', '000037', '闽A', '黑色');
INSERT INTO `t_car` VALUES ('闽B0038', '客车', '000038', '闽B', '白色');
INSERT INTO `t_car` VALUES ('闽C0039', '货车', '000039', '闽C', '绿色');
INSERT INTO `t_car` VALUES ('闽D0040', '三轮车', '000040', '闽D', '蓝色');
INSERT INTO `t_car` VALUES ('闽E0041', '拖拉机', '000041', '闽E', '黑色');
INSERT INTO `t_car` VALUES ('闽F0042', '小轿车', '000042', '闽F', '黑色');

