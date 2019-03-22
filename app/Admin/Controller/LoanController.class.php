<?php
namespace Admin\Controller;
class LoanController extends AdminCoreController {
    public function _initialize()
    {
        parent::_initialize();
        $this->_mod = D('Loan');
        $this->set_mod('Loan');
        $this->_loanCate_mod = D('LoanCate');
    }

    public function _search() {
        $map = array();
        ($start_time_min = I('start_time_min','', 'trim')) && $map['start_time'][] = array('egt', strtotime($start_time_min));
        ($start_time_max = I('start_time_max','', 'trim')) && $map['start_time'][] = array('elt', strtotime($start_time_max)+(24*60*60-1));
        ($end_time_min = I('end_time_min','', 'trim')) && $map['end_time'][] = array('egt', strtotime($end_time_min));
        ($end_time_max = I('end_time_max','', 'trim')) && $map['end_time'][] = array('elt', strtotime($end_time_max)+(24*60*60-1));
        $loanCate_id = I('loanCate_id','', 'intval');
        $loanCate_id && $map['loanCate_id'] = $loanCate_id;
        $style = I('style','', 'trim');
        $style && $map['type'] = array('eq',$style);
        ($keyword = I('keyword','', 'trim')) && $map['name'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'start_time_min' => $start_time_min,
            'start_time_max' => $start_time_max,
            'end_time_min' => $end_time_min,
            'end_time_max' => $end_time_max,
            'loanCate_id' => $loanCate_id,
            'style'   => $style,
            'keyword' => $keyword,
        ));
        return $map;
    }

    public function _before_index() {
        $big_menu = array(
            'title' => '添加借贷',
            'iframe' => U('Loan/add'),
            'id' => 'add',
            'width' => '520',
            'height' => '410',
        );
        $this->assign('big_menu', $big_menu);

        $res = $this->_loanCate_mod->field('id,name')->select();
        $board_list = array();
        foreach ($res as $val) {
            $board_list[$val['id']] = $val['name'];
        }
        $this->assign('board_list', $board_list);
        $this->assign('ad_type_arr', $this->_ad_type);
    }

    public function _before_add() {
        $loans = $this->_loanCate_mod->where(array('status'=>1))->select();
        $this->assign('loans', $loans);
        $this->assign('ad_type_arr', $this->_ad_type);
    }

    protected function _before_insert($data) {
        //判断开始时间和结束时间是否合法
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        if ($data['start_time'] >= $data['end_time']) {
            $this->ajax_return(0, L('ad_endtime_less_startime'));
        }

        switch ($data['type']) {
            case 'text':
                $data['content'] = I('text','', 'trim');
                break;
            case 'image':
                $data['content'] = I('img','', 'trim');
                break;
            case 'code':
                $data['content'] = I('code','', 'trim');
                break;
            case 'flash':
                $data['content'] = I('flash','', 'trim');
                break;
            default :
                $this->ajax_return(0, L('ad_type_error'));
                break;
        }
        return $data;
    }

    public function _before_edit() {
        $id = I('id',0, 'intval');
        $board_id = $this->_mod->where(array('id'=>$id))->getField('board_id');
        $board_info = $this->_loanCate_mod->field('name,width,height')->where(array('id'=>$board_id))->find();
		$adboards = $this->_loanCate_mod->where(array('status'=>1))->select();
        $this->assign('adboards', $adboards);
        $this->assign('board_info', $board_info);
        $this->assign('ad_type_arr', $this->_ad_type);
    }

    protected function _before_update($data) {
        //判断开始时间和结束时间是否合法
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        if ($data['start_time'] >= $data['end_time']) {
            $this->ajax_return(0, L('ad_endtime_less_startime'));
        }
        switch ($data['type']) {
            case 'text':
                $data['content'] = I('text','', 'trim');
                break;
            case 'image':
                $data['content'] = I('img','', 'trim');
                break;
            case 'code':
                $data['content'] = I('code','', 'trim');
                break;
            case 'flash':
                $data['content'] = I('flash','', 'trim');
                break;
            default :
                $this->ajax_return(0, L('ad_type_error'));
                break;
        }
        return $data;
    }

}