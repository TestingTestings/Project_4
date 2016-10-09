drop table if exists t_evidence;
create table if not exists t_evidence(
	id int(5) auto_increment primary key,
	case_id int(5),-- 案件信息
	url text,-- 证据地址
	time datetime,-- 生成时间
	type text,
	state enum('change','normal'),
	foreign key(case_id) references t_case(id)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;