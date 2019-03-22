<?php

/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

//含密钥md5加密
function st_md5($str = ''){
	return md5(C('st_encryption_key').$str);
}

//生成批量上传的名称
function make_file_name($key=''){
    return uniqid().rand(0,100);
}

/*
 * 获取缩略图
 */

function get_thumb($img, $suffix = '_thumb') {
    if (false === strpos($img, 'http://')) {
        $ext = array_pop(explode('.', $img));
        $thumb = str_replace('.' . $ext, $suffix . '.' . $ext, $img);
    } else {
        if (false !== strpos($img, 'taobaocdn.com') || false !== strpos($img, 'taobao.com')) {
            //淘宝图片 _s _m _b
            switch ($suffix) {
                case '_s':
                    $thumb = $img . '_100x100.jpg';
                    break;
                case '_m':
                    $thumb = $img . '_210x1000.jpg';
                    break;
                case '_b':
                    $thumb = $img . '_480x480.jpg';
                    break;
            }
        }
    }
    return $thumb;
}
function check_pwd($password){
    $RegExp='/^[a-zA-Z0-9_]{6,16}$/'; //由大小写字母跟数字组成并且长度在3-16字符直接
    return preg_match($RegExp,$password)?$password:false;
}

function check_nickname($Argv){
    $RegExp='/^[a-zA-Z]{3,16}$/'; //由大小写字母跟数字组成并且长度在3-16字符直接
    return preg_match($RegExp,$Argv)?$Argv:false;
}

function check_mobile($Argv){
    $RegExp='/^(?:13|15|17|18)[0-9]{9}$/';
    return preg_match($RegExp,$Argv)?$Argv:false;
}

function check_email($Argv){   
	$RegExp='/^[a-z0-9][a-z\.0-9-_] @[a-z0-9_-] (?:\.[a-z]{0,3}\.[a-z]{0,2}|\.[a-z]{0,3}|\.[a-z]{0,2})$/i';   
	return preg_match($RegExp,$Argv)?$Argv:false;
}
function code2html($code){
	return htmlspecialchars_decode($code);
}

/*
* 关键词中的空格替换为','
*/
function empty_replace($str) {
	$str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);
	$alltext = "";
	$start = 1;
	for($i=0;$i<strlen($str);$i++)
	{
		if($start==0 && $str[$i]==">")
		{
			$start = 1;
		}
		else if($start==1)
		{
			if($str[$i]=="<")
			{
				$start = 0;
				$alltext .= " ";
			}
			else if(ord($str[$i])>31)
			{
				$alltext .= $str[$i];
			}
		}
	}
	$alltext = str_replace("　","",$alltext);
	$alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
	$alltext = preg_replace("/[ ]+/s"," ",$alltext);
	return $alltext;
}