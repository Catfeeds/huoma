<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_NewList extends Ctl 
{  
    public function index()
    {
    	$uri = $this->request['uri'];
        if(preg_match('/newlist(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $cat_id = $attr_vids ? array_shift($attr_vids) : 0;
            }
        }
        $filter = array('audit'=>1, 'closed'=>0);
        $sort = $this->GP('sort');
        if($sort == 'views'){
            $orderby = array(
                'views'=>'DESC'
            );
        }elseif($sort == 'dateline'){
            $orderby = array('dateline'=>'DESC');
        }else{
            $orderby = array('xiangmu_id'=>'DESC');
        }
        $keywords = $this->GP('keywords');
        if ($keywords) {
            $filter['title'] = "LIKE:%{$keywords}%";
        }
        if ($cat_id) {
            $filter['cat_id'] = $cat_id;
        }
        $page = 1;
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if ($items = K::M('xiangmu/xiangmu')->items($filter, $orderby, $page, 8)) {
                foreach($items as $k => $v){
                    $items[$k]['desc'] = mb_substr($v['desc'], 0, 30, 'UTF-8') . '...';
                }
//                echo '<pre>';
//            var_dump($items);die;
                $this->pagedata['items'] = $items;
        }
        $act = $this->GP('act');
        if($act == 'ajax'){
            $this->system->config->load(array("site", "bulletin", "attach"));
            $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
            $res = array(
                'info' =>$items,
                'attachurl' => $attachurl
            );
            echo json_encode($res);die;
        }
//        echo "<pre>";
//        var_dump($items);die;
        //分类
        $cate = K::M('xiangmu/cate')->fenlei_all();
        //print_r($cate);die;
        $this->pagedata['cat_id'] = $cat_id;
        $this->pagedata['cate'] = $cate;
        $this->pagedata['selected_id'] = '2';
		$this->tmpl = 'mobile:newlist/index.html';
    }

}