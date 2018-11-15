<?php

/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: yuyue.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */


Import::C('member/ucenter');

class Ctl_Member_Yuyue extends Ctl_Ucenter {
    
    public function index($page=1) {
         $this->check_company();
        $filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 20;
        $filter['company_id'] = $this->company['company_id'];
        if($items = K::M('company/yuyue')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array());
        }

        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/yuyue/index.html';
    }
    
    public function designer($page=1){
        $this->check_company();
        $filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 20;
        $filter['company_id'] = $this->company['company_id'];
        if($items = K::M('designer/yuyue')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
                if($v['designer_id']){
                    $designer_ids[$v['designer_id']] = $v['designer_id'];
                }   
            }         
            if(!empty($designer_ids)){
                $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_ids);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array());
        }

        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/yuyue/designer.html';
    }
     public function designer2($page=1){
        $this->check_designer();
        $filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 20;
        $filter['designer_id'] = $this->uid;
        if($items = K::M('designer/yuyue')->items($filter, null, $page, $limit, $count)){          
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/yuyue/designer2.html';
    }
    
    
}