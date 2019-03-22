<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {
    protected function _initialize(){

		$host = $_SERVER['HTTP_HOST'];
		if(preg_match('/^[a-zA-Z0-9-]+[.]{1}[a-zA-Z]+$/',$host)){
			$url =  'http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header('Location:'.$url);
		}
		//初始化网站配置
        $setting = array();
        if(F('setting')){
            $setting = F('setting');
        }else{
            $setting = D('Setting')->setting_cache();
            F('setting',$setting);
        }
        C($setting);
        //首页顶部及底部信息
        $setting = M('setting')->select();
            // dump($setting);
            //首页顶部和底部消息
        foreach ($setting as $key => $val) {
        if ($val['name'] == 'site_slogan') {
        $site_slogan = $val['data'];//企业宗旨
        }
        if ($val['name'] == 'tel') {
            $tel = $val['data'];//电话
        }
            if ($val['name'] == 'site_title') {
                $title = $val['data'];//版权所有
            }
        if ($val['name'] == 'mobile') {
            $mobile = $val['data'];//手机
        }
        if ($val['name'] == 'logo') {
            $logo = $val['data'];//logo
        }
        if ($val['name'] == 'qq') {
            $qq = $val['data'];//QQ
        }
        if ($val['name'] == 'qr') {
            $qr = $val['data'];//二维码
        }
        if ($val['name'] == 'site_name') {
            $site_name = $val['data'];//网站名
        }
        if ($val['name'] == 'site_icp') {
            $site_icp = $val['data'];//备案号
        }
        if ($val['name'] == 'address') {
            $address = $val['data'];//地址
        }
        }
        //首页主标题
        $article_cate = M('Article_cate')->where(array('status' => 1, 'is_home' => '1','pid'=>'0'))->order('ordid')->field('id,name,url')->select();
        $article_erji = M('Article_cate')->where(array('status' => 1, 'is_home' => '1'))->order('ordid')->field('id,name,url,pid')->select();

        //dump($article_erji);
        $this->assign(array(
            'site_slogan' => $site_slogan,
            'tel' => $tel,
            'title' => $title,
            'mobile' => $mobile,
            'logo'=>$logo,
            'qr' => $qr,
            'qq'=>$qq,
            'site_name' => $site_name,
            'site_icp' => $site_icp,
            'address' => $address,
            'ar_cate' => $article_cate,  //首页标题
            'article_erji'=>$article_erji
        ));
        }

}