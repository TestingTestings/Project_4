<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'=>'mysql',// 数据库类型
    'DB_HOST'=>'127.0.0.1',// 服务器地址
    'DB_NAME'=>'traffic_police',// 数据库名
    'DB_USER'=>'root',// 用户名
    'DB_PWD'=>'12345678',// 密码
    'DB_PORT'=>3306,// 端口
    'DB_PREFIX'=>'t_',// 数据库表前缀
    'DB_CHARSET'=>'utf8',// 数据库字符集
    //define('js', '/polic/Public/Common/js/jquery/jquery-3.1.1.min.js')
    'TMPL_ACTION_SUCCESS'=>'Public:dispatch_jump',
    'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',

);