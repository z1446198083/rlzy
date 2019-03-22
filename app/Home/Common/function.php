<?php
/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login(){
    $user = cookie('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return session('auth_sign') == data_auth_sign($user) ? $user['id'] : 0;
    }
}

//验证是否为商户
function is_business(){
	 $user = cookie('user_auth');
	 if($user['member_type'] == 2){
		 return 2;
	 }else{
		 return 0;
	 }
}

function attach($attach, $type) {
    if (false === strpos($attach, 'http://')) {
        //本地附件
        $img_url = __ROOT__ . '/' . C('pin_attach_path') . $type . '/' . $attach;
        $img_path = realpath(__ROOT__).'/' . C('pin_attach_path') . $type . '/' . $attach;
		
        if($img_url){
            return $img_url;
        }else{
            $img_url =  __ROOT__ . '/' .C('pin_attach_path').'image/nopicture.gif';
            return  $img_url;
        }
        //远程附件
        //todo...
    } else {
        //URL链接
        return $attach;
    }
}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)  
    {  
  if(function_exists("mb_substr")){  
              if($suffix)  
              return mb_substr($str, $start, $length, $charset);  
              else
                   return mb_substr($str, $start, $length, $charset);  
         }  
         elseif(function_exists('iconv_substr')) {  
             if($suffix)  
                  return iconv_substr($str,$start,$length,$charset);  
             else
                  return iconv_substr($str,$start,$length,$charset);  
         }  
         $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                  [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";  
         $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";  
         $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";  
         $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";  
         preg_match_all($re[$charset], $str, $match);  
         $slice = join("",array_slice($match[0], $start, $length));  
         if($suffix) return $slice."…";  
         return $slice;
    }



function check_wap() {
	if (isset($_SERVER['HTTP_VIA']))
		return true;
	if (isset($_SERVER['HTTP_X_NOKIA_CONNECTION_MODE']))
		return true;
	if (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID']))
		return true;
	if (strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML") > 0) {
		// Check whether the browser/gateway says it accepts WML.
		$br = "WML";
	} else {
		$browser = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : '';
		if (empty($browser))
			return true;
		$mobile_os_list = array('Google Wireless Transcoder', 'Windows CE', 'WindowsCE', 'Symbian', 'Android', 'armv6l', 'armv5', 'Mobile', 'CentOS', 'mowser', 'AvantGo', 'Opera Mobi', 'J2ME/MIDP', 'Smartphone', 'Go.Web', 'Palm', 'iPAQ');
		$mobile_token_list = array('Profile/MIDP', 'Configuration/CLDC-', '160×160', '176×220', '240×240', '240×320', '320×240', 'UP.Browser', 'UP.Link', 'SymbianOS', 'PalmOS', 'PocketPC', 'SonyEricsson', 'Nokia', 'BlackBerry', 'Vodafone', 'BenQ', 'Novarra-Vision', 'Iris', 'NetFront', 'HTC_', 'Xda_', 'SAMSUNG-SGH', 'Wapaka', 'DoCoMo', 'iPhone', 'iPod');
		$found_mobile = checkSubstrs($mobile_os_list, $browser) || checkSubstrs($mobile_token_list, $browser);
		if ($found_mobile)
			$br = "WML";
		else
			$br = "WWW";
	}
	if ($br == "WML") {
		return true;
	} else {
		return false;
	}
}

function checkSubstrs($list, $str) {
	$flag = false;
	for ($i = 0; $i < count($list); $i++) {
		if (strpos($str, $list[$i]) > 0) {
			$flag = true;
			break;
		}
	}
	return $flag;
}


function getBoard($cate,$id){
    $spid=$cate->where(array('id'=>$id))->getField('spid');

    $arr=explode('|',$spid.$id);

    $map=$cate->where(array('id'=>array('in',$arr)))->field('id,name,url')->select();

    $seo = $cate->where(array('id'=>$id))->getField('seo_title,seo_keys,seo_desc');

    $maps=array($map,$seo);

    return $maps;

}

function getPage($mod,$id,$pagesize){
    $count=$mod->where(array('cate_id'=>$id, 'status'=>1))->count();

    if(C('DEFAULT_THEME')=='mobile'){
        $Page=new \Home\Extend\MobilePage($count,$pagesize);
    }else{
        $Page=new \Home\Extend\Page($count,$pagesize);
    }
    $Page->setConfig('prev','上一页');
    $Page->setConfig('next','下一页');
    $Page->setConfig('last','末页');
    $Page->setConfig('first','首页');
    $Page->setConfig('theme','%HEADER% &nbsp; %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% &nbsp; <span class="rowss">共 <span>%TOTAL_PAGE%</span> 页</span>');
    $show=$Page->show();
    $list=$mod->where(array('cate_id'=>$id, 'status'=>1))->order('ordid,add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    $arr=array($list,$show);
    return $arr;

}
