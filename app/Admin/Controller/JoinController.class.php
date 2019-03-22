<?php
namespace Admin\Controller;
class JoinController extends AdminCoreController {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('Join');
        $this->set_mod('Join');
    }

    public function _before_index() {

        $this->assign('apply_city_list',C('apply_city_list'));
        $this->assign('apply_age_list',C('apply_age_list'));

    }

    public function ajax_check_name() {
        $name = I('username','', 'trim');
        $id = I('id','', 'intval');
        if ($this->_mod->name_exists($name, $id)) {
            echo 0;
        } else {
            echo 1;
        }
    }

}