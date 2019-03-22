<?php
return array(
	//'配置项'=>'配置值'
	"LOAD_EXT_FILE"=>"templet", 
	//模板替换
	'TMPL_PARSE_STRING'  =>array(
		 '__STATIC__' => __ROOT__.'/theme/home/', // PC的样式文件目录
		 '__MOBILE__' => __ROOT__.'/theme/mobile/', // wap的样式文件目录(2)
	),
	'URL_MODEL' => 0,
    'pagesize' => 8,
	'tech' => '技术支持：<a href="http://www.0791jr.com" target="_blank" style="color: #fff">嘉瑞科技</a>',
	'ERROR_PAGE' => '/404.html' ,
	 // 允许访问的模块列表
 'MODULE_ALLOW_LIST'    =>    array('Home','Admin','User'),
 'DEFAULT_MODULE'       =>    'Home',  // 默认模块
);