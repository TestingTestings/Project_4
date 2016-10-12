drop database if exists traffic_police;
create database traffic_police character set 'utf8' collate 'utf8_general_ci';
use traffic_police;

-- 用户表
CREATE TABLE `t_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` char(8) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `idcard` char(18) DEFAULT NULL,
  `regtime` date DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL,
  `drive_card` bigint(12),
  `score` int(3) default 12,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

-- 车辆表
CREATE TABLE `t_car` (
  `id` char(6),
  `type` enum('小轿车','客车','货车','三轮车','拖拉机'),
  `vin` char(6),
  `local` char(8),
  `color` enum('白色','黑色','蓝色','绿色','红色'),
  PRIMARY KEY (`id`)
) ;

--  交警表
CREATE TABLE `t_police` (
  `id` int(6) NOT NULL,
  `name` varchar(7) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `sex` enum('男','女') DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `area` text,
  `job` enum('协管','警员') DEFAULT NULL,
  `imei` bigint(15) DEFAULT NULL,
  `sim` bigint(11) DEFAULT NULL,
  `state` enum('quit','normal') DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--  管理员
CREATE TABLE `t_admin` (
  `id` int(4) NOT NULL,
  `name` char(8) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `power` enum('super','normal') DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--  新闻表
CREATE TABLE `t_news` (
  `id` int(5) auto_increment primary key,
  `title` varchar(30) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `time` date DEFAULT NULL,
  `valid` date DEFAULT NULL,
  `url` text DEFAULT NULL
) ;

--  逃犯表
CREATE TABLE `t_criminal` (
  `id` int(5) AUTO_INCREMENT,
  `name` char(8) unique,
  `action` text DEFAULT NULL,
  `head` text DEFAULT NULL,
  `state` enum('escape','catch'),
  `car_id` varchar(7),
  `driver_car` bigint(12),
  PRIMARY KEY (`id`)
) ;

--  菜单表
CREATE TABLE `t_menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fid` int(5) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `power` enum('super','normal') DEFAULT NULL,
  `url` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- 法规
create table t_law(
	id int(5) auto_increment primary key,
	section VARCHAR (15),
	part VARCHAR (15),
	strip VARCHAR (15),
	content text,
	score int(3),
	cost int(3)
);

-- 案件表
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
);

-- 证据
CREATE TABLE `t_evidence` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `case_id` int(5) DEFAULT NULL,
  `url` text,
  `time` datetime DEFAULT NULL,
  `type` text,
  `state` enum('change','normal','new') default 'normal',
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`)
);

-- 案件副表
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
) ;

-- 搜索记录
CREATE TABLE `t_history` (
  `id` int(5) auto_increment PRIMARY key,
  user bigint(11),
  car_id CHAR(6),
  time DATETIME DEFAULT now()
);