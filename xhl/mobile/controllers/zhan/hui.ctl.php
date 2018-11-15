<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: hui.ctl.php 2015-12-01 14:56:23  xinghuali
 */

class Ctl_Zhan_Hui extends Ctl
{
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/hui-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }

   public function index($zhan_id)
    {
        $zhan = $this->check_zhan($zhan_id);
        $photos = $filter = array();
        $filter['zhan_id'] = $zhan_id;
        $filter['type'] = 1;
        $photos = K::M('zhan/photo')->items($filter);
        $this->pagedata['photos'] = $photos;
        $this->seo->set_company($zhan);

        K::M('zhan/zhan')->update_count($zhan_id, 'views', 1); 
        
        $guan = K::M('guan/guan')->detail($zhan['guan_id']);
        $this->pagedata['guan'] = $guan;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zhan', true);
        $attr_list = K::M('zhan/attr')->attrs_by_zhan($zhan_id);

        $this->pagedata['pager'] = $pager;
        foreach($attr_list as $k=>$v){
            $v['title'] = $attr_values[$v['attr_id']]['title'];
            $v['val'] = $attr_values[$v['attr_id']]['values'][$v['attr_value_id']]['title'];
            $attr_list[$k]=$v;
        }
        $this->pagedata['attr_list'] = $attr_list;
        //费用
        $guanli = K::M('zhan/guanli')->detail($zhan_id);
        $this->pagedata['guanli'] = $guanli;
       
        $seo = array('zhan_name'=>$zhan['name'], 'zhan_title'=>$zhan['title'],'zhan_desc'=>'');
        $seo['zhan_desc'] = K::M('content/text')->substr(K::M('content/html')->text($zhan['content'], true), 0, 200);
        $this->seo->init('zhan_detail', array('zhan_title' => $zhan['title'],'zhan_desc' => $seo['zhan_desc']));

        $this->tmpl = 'mobile:zhan/hui.html';
    }
     protected function check_zhan($zhan_id)
    {
        if(!$zhan_id = (int)$zhan_id){
            $this->error(404);
        }else if(!$zhan = K::M('zhan/zhan')->detail($zhan_id)){
            $this->error(404);
        }else if(empty($zhan['audit'])){
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }
        $this->pagedata['zhan'] = $zhan;
        $seo = array('zhan_name'=>$zhan['name'], 'zhan_title'=>$zhan['title'],'zhan_desc'=>'');
        $seo['zhan_desc'] = K::M('content/text')->substr(K::M('content/html')->text($zhan['content'], true), 0, 200);
        $this->seo->init('zhan_detail', array('zhan_name' => $zhan['name']));
        return $zhan;
    }
}