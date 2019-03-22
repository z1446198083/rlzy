<?php
namespace Admin\Controller;
class ArticlePageController extends AdminCoreController {
    public function _initialize() {
        parent::_initialize();
        $this->set_mod('ArticlePage');
    }

    protected function _before_insert($data)
    {
        if(empty($data['intro'])){
            $str = strip_tags(htmlspecialchars_decode($data['info']));
            $str = empty_replace($str);
            $data['intro'] = substr($str,0,240);
        }

        (empty($data['seo_desc'])) && $data['seo_desc'] = $data['intro'];
        (empty($data['seo_keys'])) && $data['seo_desc'] = $data['tags'];
        (empty($data['seo_title'])) && $data['seo_desc'] = $data['title'];

        return $data;
    }

    protected function _before_update($data) {

        if(empty($data['intro'])){
            $str = strip_tags(htmlspecialchars_decode($data['info']));
            $str = empty_replace($str);
            $data['intro'] = substr($str,0,240);
        }

        (empty($data['seo_desc'])) && $data['seo_desc'] = $data['intro'];
        (empty($data['seo_keys'])) && $data['seo_desc'] = $data['tags'];
        (empty($data['seo_title'])) && $data['seo_desc'] = $data['title'];

        return $data;
    }
}