<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: index.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */
class Ctl_List extends Ctl
{ 
    public function index()
    {
        $this->pagedata['page_time'] = __TIME.rand(100000,9999999);
        $this->tmpl = 'mobile:list/index.html';
    }

    public function lists($cat_id=0,$page=1){
        $page = max((int)$page, 1);
        $limit = 1;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1, 'closed'=>0);
        $orderby = array('orderby'=>'DESC','xiangmu_id'=>'DESC');

        if ($kw = $this->GP('kw')) {
            $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if($cat_id){
            $filter['cat_id'] = $cat_id;
        }
        $result = array();
        if ($items = K::M('xiangmu/xiangmu')->items($filter, $orderby, $page, $limit, $count)) {
            $result['error'] = 0;
            $result['message'] = '';
            $result['content'] = json_encode($items);
        }else{
            $result['error'] = 1;
            $result['message'] = '';
            $result['content'] = '没有更多内容了';
        }
        die(json_encode($result));
    }
	

}