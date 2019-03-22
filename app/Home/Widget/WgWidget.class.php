<?php


namespace Home\Widget;

use Think\Controller;

class WgWidget extends Controller {

    public function _cate(){
        $cate = M('ArticleCate');
        //所有一级分类
        $nav = $cate->where(array('is_home'=>1,'status'=>1))
            ->order('ordid asc,id ')
            ->select();
        //一级分类 + 二级分类
        foreach($nav as $k => $v){
            $nav[$k]['ii'] = $cate->where(array('pid'=>$v['id'],'status'=>1))
                ->order('ordid,id')
                ->select();
        }
        return $nav;
    }

    public function nav(){
        $id = I('id',0,'intval');
        $this->assign('nav',$this->_cate());
        $this->assign('id',$id);
        $this->display('Widget:nav');
    }

    public function footer(){
        $link = M('Flink')->where(array('status'=>1))->order('add_time desc')->select();
        $this->assign('link',$link);

        $this->assign('tail',$this->_cate());
        $this->display('Widget:footer');

    }

}