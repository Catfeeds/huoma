<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2015-12-01 14:56:23  xinghuali
 */

class Ctl_Mingpian_Index extends Ctl
{
    public function index()
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
		$filter['isshow'] = 1;
		$filter['closed'] = 0;
		
        if ($items = K::M('mingpian/mingpian')->items($filter, $page, $limit, $count)) {
            $pager['count'] = $count;
           // $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mingpian/index'));
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mingpian/index', array( $order, '{page}')));
            $this->pagedata['items'] = $items;
        }

        $this->pagedata['pager'] = $pager;
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->tmpl = 'mobile:mingpian/index.html';
    }

    public function listcon($page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
		$filter['isshow'] = 1;
		$filter['closed'] = 0;

        if ($items = K::M('mingpian/mingpian')->items($filter, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mingpian/index', array( $order, '{page}')));
            $this->pagedata['items'] = $items;
        }

        $this->pagedata['pager'] = $pager;
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->tmpl = 'mobile:mingpian/listcon.html';
    }
}