<?php
return array(
	//'配置项'=>'配置值'
	
	// //jrkj
    // 'DB_TYPE'   => 'mysql', // 数据库类型
    // 'DB_HOST'   => '106.14.118.83', // 服务器地址
    // 'DB_NAME'   => 'sztx', // 数据库名
    // 'DB_USER'   => 'sztx_user', // 用户名
    // 'DB_PWD'    => '2e6f13b3a2df133f', // 密码
    // 'DB_PORT'   => 3306, // 端口
    // 'DB_PREFIX' => 'jrkj_', // 数据库表前缀
    // 'DB_CHARSET'=> 'utf8', // 字符集
    // 'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

   'DB_TYPE'   => 'mysql', // 数据库类型
   'DB_HOST'   => 'localhost', // 服务器地址
   'DB_NAME'   => 'rlzy', // 数据库名
   'DB_USER'   => 'root', // 用户名
   'DB_PWD'    => 'root', // 密码
   'DB_PORT'   => 3306, // 端口
   'DB_PREFIX' => 'jrkj_', // 数据库表前缀
   'DB_CHARSET'=> 'utf8', // 字符集
   'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

	//模板替换
	'TMPL_PARSE_STRING'  =>array(
		 '__PUBLIC_DEFAULT__' => '/theme/home/', // 前台的样式文件目录
		 '__PUBLIC_ADMIN__' => '/theme/admin/', // 后台的样式文件目录
		 //'__JS__'     => '/Public/JS/', // 增加新的JS类库路径替换规则
		 '__UPLOAD__' => '/data/attachment', // 增加新的上传路径替换规则
	),
	
	'URL_CASE_INSENSITIVE' =>true,		//大小写不敏感
	'st_encryption_key' => 'lrioucskteorne',	//加密密钥
	'LANG_SWITCH_ON' => true,		// 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST' => 'en-us,zh-cn,zh-tw', //必须写可允许的语言列表
	'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
    'DATA_PATH' => './data/',
	'adboard_allow_type' => array(
		'image' => '图片',
		'text' => '文字',
		'code' => '代码',
		'flash' => 'Flash',
	),
	
	
	/*项目配置*/
    'apply_city_list' => array(
        1 => '北京',
        2 => '上海',
        3 => '广州',
    ),
    'apply_age_list' => array(
        1 => '3-6岁',
        2 => '7-9岁',
        3 => '10-12岁',
    ),

);
