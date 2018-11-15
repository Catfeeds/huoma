news---Index.ctl.php
<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2016-01-18 02:52:25Z xinghuali $
 */
class Ctl_News_Index extends Ctl 
{   
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/index-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }
     public function index($cat_id=0,$page=0)
     {

        $cate_list = K::M('article/cate')->fetch_all();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['closed'] = 0;
        $cates = array();


		foreach ($cate_list as $k => $v) {
			if ($v['parent_id'] == 8 && $v['from'] == 'article') {
				$cates[$k] = $v;
			}
		}
        $filter['from'] = $pager['from'] = 'article';
		if($cat_id){
			$filter['cat_id']=$cat_id;
			$cate_title=$cates[$cat_id]['title'];
		}
        $orderby = array('orderby' => 'ASC', 'article_id' => 'DESC');
        if ($items = K::M('article/view')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("content:items", array($cat_id, "{page}")), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['cates'] = $cates;
        $this->pagedata['cate_title'] = $cate_title;
        $this->tmpl = 'mobile:news/index.html';
     }

    public function listcon($cat_id=0,$page=0)
     {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $cate_list = K::M('article/cate')->fetch_all();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['closed'] = 0;
        $cates = array();


        foreach ($cate_list as $k => $v) {
            if ($v['parent_id'] == 8 && $v['from'] == 'article') {
                $cates[$k] = $v;
            }
        }
        $filter['from'] = $pager['from'] = 'article';
        if($cat_id){
            $filter['cat_id']=$cat_id;
            $cate_title=$cates[$cat_id]['title'];
        }
        $orderby = array('orderby' => 'ASC', 'article_id' => 'DESC');
        if ($items = K::M('article/view')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("content:items", array($cat_id, "{page}")), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['cates'] = $cates;
        $this->pagedata['cate_title'] = $cate_title;
        $this->tmpl = 'mobile:news/listcon.html';
     }
}    

