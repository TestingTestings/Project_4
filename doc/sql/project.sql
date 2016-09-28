drop database if exists traffic_police;
create database traffic_police character set 'utf8' collate 'utf8_general_ci';
use traffic_police;

-- 用户表
create table t_user(
	id int(6) auto_increment primary key,
	name char(8) unique,
	password char(32),
	idcard char(18),--  身份证
	regtime date,--  注册时间
	phone bigint(11)
);

-- 车辆表
create table t_car(
	id char(6) primary key,
	type enum('小轿车','客车','货车','三轮车','拖拉机'),--  车辆类型
	vin char(6),-- 车架号
	local char(8)--  车辆地区
);

--  车辆查询表
create table t_searchCar(
	user_id int(6),
	car_id char(6),
	time date,
	primary key(user_id,car_id),
  	foreign key(user_id) references t_user(id),
	foreign key(car_id) references t_car(id)
);

--  交警表
create table t_police(
	id int(6) primary key,
	name varchar(7),
	password char(32),
	sex enum('男','女'),
	age int(3),
	area text,--  片区
	job enum('协管','警员'),
	imei bigint(15),--  硬件信息
	sim bigint(11),
	state enum('quit','normal')--  警员状态
);

--  管理员
create table t_admin(
	id int(4) primary key,
	name char(8),
	password char(32),
	power enum('super','normal'),--  权限
	time datetime --  登录时间
);

--  新闻表
create table t_news(
	id int(5) auto_increment primary key,
	title varchar(30),
	content text,--  内容
	time date,
	valid date,--  有效期
	url text--  地址
);

--  逃犯表
create table t_criminal(
	id int(5) auto_increment primary key,
	name char(8) unique,
	action text,--  犯罪详情
	head text,--  头像
	state enum('escape','catch')-- 状态
);

--  菜单表
create table t_menu(
	id int(5) auto_increment primary key,
	fid int(5),
	content text,
	power enum('super','normal')-- 对应权限显示菜单
);

-- 法规
create table t_law(
	id int(5) auto_increment primary key,
	url TEXT ,
	title text,
	content text
);

-- 案件表
create table t_case(
	id int(5) auto_increment primary key,
	place text,-- 地理信息
	log FLOAT(5),-- 经度
	lat FLOAT(5),-- 纬度
	police_id int(6),-- 警员信息
	happentime datetime,--  违章时间
	car_id char(6),-- 车辆信息
	content text,-- 违章内容
	cost int(3),-- 违章罚款
	law_id int(5),-- 法规id
	punishment text,-- 处罚方式拘留等
	infoway enum('现场执法','非现场执法'),
	state enum('未处理','已处理','申诉'),
  	handletime DATETIME,--  处理时间
  	foreign key(police_id) references t_police(id),
  	foreign key(car_id) references t_car(id),
  	foreign key(law_id) references t_law(id)
);

-- 证据
create table t_evidence(
	id int(5) auto_increment primary key,
	case_id int(5),-- 案件信息
	url text,-- 证据地址
	time datetime,-- 生成时间
	type enum('photo','video','voice'),
	foreign key(case_id) references t_case(id)
);

-- 超过10位的int改为bigint 9/24 林