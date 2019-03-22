<?php

namespace Home\Controller;

class IndexController extends HomeController
{
    public function _initialize()
    {
        parent::_initialize();
        //帮助中心广告
        $map['start_time'] = array('elt', time());
        $map['end_time'] = array('egt', time());
        $map['board_id'] = '20';
        $ad_help = M('ad')->where($map)->order('ordid')->field('content')->find();
        //帮助中心栏目
        //二级栏目
        $help = M('article_cate')->where(array('id' => '711'))->find();
        //三级栏目
        $help1 = M('article_cate')->where(array('pid' => '711'))->order('ordid')->select();
        //dump($help);dump($help1);
        $this->assign(array(
            'ad_help' => $ad_help,
            'help' => $help,
            'help1' => $help1,
        ));

    }

    /**
     *
     */
    public function index()
    {
        //访问次数
        M('counter')->where('id=1')->setInc('number',1);
        $number=M('counter')->where('id=1')->find();//dump($number);
        //轮播图
        $ad=M('ad')->where(['board_id' => '1', 'status' => '1'])->field('content')->select();
        $count_banner=M('ad')->where(['board_id' => '1', 'status' => '1'])->count();//dump($count_banner);轮播图数量
        //网上报名广告位
        $wsbm =M('adboard')->where(['id' => '4', 'status' => '1'])->find();//名称
        $map1['start_time'] = array('elt', time());
        $map1['end_time'] = array('egt', time());
        $map1['board_id'] = '4';
        $map1['is_home'] = '1';
        $wsbm_ad=M('ad')->where($map1)->select();//详情
        //名师团队广告位
        $mstd=M('adboard')->where(['id' => '5', 'status' => '1'])->find();
        $map2['start_time'] = array('elt', time());
        $map2['end_time'] = array('egt', time());
        $map2['board_id'] = '5';
        $map2['is_home'] = '1';
        $mstd_ad=M('ad')->where($map2)->select();//dump($mstd_ad);//详情
        //特色课程广告位
        $tskc=M('adboard')->where(['id' => '6', 'status' => '1'])->find();
        $map3['start_time'] = array('elt', time());
        $map3['end_time'] = array('egt', time());
        $map3['board_id'] = '6';
        $map3['is_home'] = '1';
        $tskc_ad=M('ad')->where($map3)->select();
        //新闻中心
        $xwzx=M('article_cate')->where(['id' => '19', 'status' => '1'])->find();
        $xwzx_wz=M('article')->where(['cate_id' => '19', 'status' => '1'])->select();
        $this->assign(array(
            'number'=>$number,
            'banner' => $ad,
            'count_banner'=>$count_banner,
            'wsbm'=>$wsbm,
            'wsbm_ad'=>$wsbm_ad,
            'mstd'=>$mstd,
            'mstd_ad'=>$mstd_ad,
            'tske'=>$tskc,
            'tskc_ad'=>$tskc_ad,
            'xwzx'=>$xwzx,
            'xwzx_wz'=>$xwzx_wz,
        ));//dump($ad);
        if(IS_AJAX){
            $data=array(
                'name'=>I('name'),
                'course'=>I('course'),
                'tel'=>I('mobile'),
                'content'=>I('content'),
                'add_time'=>time(),
                'add_ip'=>get_client_ip(),
                'status'=>1,
            );
            $res=M('message')->add($data);
            if(false!==$res){
                $data = '留言成功';
                $this->ajaxReturn($data);
            }else{
                $data = '留言失败';
                $this->ajaxReturn($data);
            }
        }

        $this->display();

//        $setting = M('setting')->select();
//        // dump($setting);
//        //首页顶部和底部消息
//        foreach ($setting as $key => $val) {
//            if ($val['name'] == 'site_slogan') {
//                $site_slogan = $val['data'];
//            }
//            if ($val['name'] == 'tel') {
//                $tel = $val['data'];
//            }
//            if ($val['name'] == 'qr') {
//                $qr = $val['data'];
//            }
//            if ($val['name'] == 'site_name') {
//                $site_name = $val['data'];
//            }
//            if ($val['name'] == 'site_icp') {
//                $site_icp = $val['data'];
//            }
//            if ($val['name'] == 'address') {
//                $address = $val['data'];
//            }
//        }
//        //首页主标题
//        $article_cate = M('Article_cate')->where(array('status' => 1, 'is_home' => '1', 'pid' => '0'))->order('ordid')->field('id,name,url')->select();
//        //dump($article_cate);
//        //首页轮播图
//        $map['start_time'] = array('elt', time());
//        $map['end_time'] = array('egt', time());
//        $map['board_id'] = '9';
//        $ad = M('ad')->where($map)->order('ordid')->field('content')->select();
//        // dump($ad);
//        //借贷业务标题
//        $jdyw = M('Article_cate')->where(array('id' => '676', 'is_home' => '1'))->find();
//        //借贷业务子标题
//        $jdyw_s = M('Article_cate')->where(array('pid' => '676', 'is_home' => '1'))->field('img,name')->select();
//
//        //企业风采
//        $fc = M('Article_cate')->where(array('id' => '721', 'is_home' => '1'))->find();
//
//        //机构合作
//        $jghz = M('Article_cate')->where(array('id' => '677', 'is_home' => '1'))->field('name,alias')->find();
//        // 最新公告 最新新闻
//        $s_info1 = M('Article_cate')->where(array('pid' => '687', 'is_home' => '1'))->field('id,name,alias')->order('ordid')->limit('2')->select();
//        // 信息展示：企业公告，常见问题，，业务介绍
//        $s_info = M('Article_cate')->where(array('pid' => '678', 'is_home' => '1'))->field('id,name,alias')->order('ordid')->select();
//        //首页中部轮播图
//        $map2['start_time'] = array('elt', time());
//        $map2['end_time'] = array('egt', time());
//        $map2['board_id'] = '21';
//
//
//        $ad2 = M('ad')->where($map2)->order('ordid')->field('content')->select();
//
//
////        $list = M('partner')->where(array('status' => '1'))
////            ->order('ordid')
////            ->limit('8')
////            ->select();
//        // dump($new_info);
//        $this->assign(array(
//            'list' => $list,
//        ));
//
//        //       //最新公告
//        $zxgg = M('article')->where(array('cate_id' => '690', 'status' => '1'))->field('id,title,img,intro,add_time')->limit('4')->order('ordid')->select();
//        //最新新闻
//        $zxxw = M('article')->where(array('cate_id' => '688', 'status' => '1'))->field('id,title,img,intro,add_time')->limit('5')->order('ordid')->select();
//        //常见问题
//        $cjwt = M('article')->where(array('cate_id' => '713', 'status' => '1'))->field('id,title,img,intro,add_time')->limit('4')->order('ordid')->select();
//        //常见业务
//        $cjyw = M('article')->where(array('cate_id' => '686', 'status' => '1'))->field('id,title,img,intro,add_time')->order('ordid')->select();
//        //  dump($qr);
//        // dump($s_info);
//        // dump($s_info);
//        $this->assign(array(
//            'site_slogan' => $site_slogan,
//            'tel' => $tel,
//            'qr' => $qr,
//            'site_name' => $site_name,
//            'site_icp' => $site_icp,
//            'address' => $address,
//            'ar_cate' => $article_cate,  //首页标题
//            'ad' => $ad,
//            'jdyw' => $jdyw,
//            'jdyw_s' => $jdyw_s,
//            'jghz' => $jghz,
//            's_info1' => $s_info1,
//            's_info' => $s_info,
//            'zxgg' => $zxgg,
//            'zxxw' => $zxxw,
//            'cjwt' => $cjwt,
//            'cjyw' => $cjyw,
//            'ad2' => $ad2,
//            'fc' => $fc
//        ));
//        $this->display();
   }
}