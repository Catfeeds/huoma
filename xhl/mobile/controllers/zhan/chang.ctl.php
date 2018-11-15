<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-12-01 14:56:23  xinghuali
 */

class Ctl_Zhan_Chang extends Ctl
{
    
    public function index()
    {
        $this->chang();
    }

    public function chang()
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $province_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zhan', true);
        $uri = $this->request['uri'];
        if(preg_match('/chang(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $province_id = $attr_vids ? array_shift($attr_vids) : 0;
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }

        foreach($attr_values as $k=>$v){
            if($v['filter']){
                $attr_value_ids[$k] = 0;
                foreach($attr_vids as $vv){
                    if($v['values'][$vv]){
                        $attr_value_ids[$k] = $vv;
                        $attr_ids[$k] = $vv;
                        $attrs[$k] = $v['values'][$vv];
                        $attr_value_titles[$k] = $v['values'][$vv]['title'];
                    }
                }
            }
        }
        $attr_vids = $attr_ids;    
        foreach($attr_values as $k=>$v){
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('zhan/chang', array($province_id, implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('zhan/chang', array($province_id, implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }
		$province_list  =  K::M('data/province')->fetch_all();
        $province_all_link = $this->mklink('zhan/chang', array(0, implode('-', $attr_value_ids), $order, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('zhan/chang', array($k, implode('-', $attr_value_ids), $order, 1));
            $province_list[$k] = $v;
        }
        $order_list = array(0=>array('title'=>'默认'), 1=>array('title'=>'价格'), 2=>array('title'=>'方案'));
        $order_list[0]['link'] = $this->mklink('zhan/chang', array($province_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('zhan/chang', array($province_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('zhan/chang', array($province_id, implode('-', $attr_value_ids), 2, 1));

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['city_id'] = $this->request['city_id'];
        if($province_id){
            $filter['province_id'] = $province_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if($attr_ids){
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if($order == 1){
            $orderby = array('price'=>'DESC');
        }else if($order == 2){
            $orderby = array('case_num'=>'DESC');
        }else{
            $orderby = NULL;
        }
        if ($items = K::M('zhan/zhan')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan/chang', array($province_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;
        $seo = array('area_name'=>'', 'attr'=>'', 'page'=>'');
        if($province_id){
            $seo['area_name'] = $area_list[$province_id]['area_name'];
        }
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->seo->init('guan_items', $seo);
        $this->tmpl = 'zhan/chang.html';
    }

    public function detail($guan_id)
    {
        $zhan = $this->check_zhan($zhan_id);
        K::M('zhan/zhan')->update_count($zhan_id, 'views', 1);  
        $this->tmpl = 'zhan/chang.html';
    }
	
    public function news($news_id)
    {
        if(!$news_id = (int)$news_id){
            $this->error(404);
        }else if(!$detail = K::M('guan/news')->detail($news_id)){
            $this->error(404);
        }else{
			K::M('guan/news')->update_count($news_id, 'views', 1);
	        $guan = $this->check_guan($detail['guan_id']);
            $this->pagedata['detail'] = $detail;
            $seo = array('title'=>$detail['title'], 'guan_name'=>$guan['name'], 'news_desc'=>'');
            $seo['news_desc'] = K::M('content/text')->substr(K::M('content/html')->text($detail['content'], true), 0, 200);
            $this->seo->init('guan_news', $seo);
            $this->tmpl = 'guan/news.html';
        }
    }

    public function cases($guan_id, $page=1)
    {
        $guan = $this->check_guan($guan_id);
        $filter = $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $filter['guan_id'] = $guan_id;
        $filter['closed'] = '0';
        $filter['audit'] = 1;
        if($items = K::M('case/case')->items($filter, NULL, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('guan:cases',array($guan_id, '{page}')));
			$uids = $company_ids = array();                
            foreach ($items as $val) {
                $uids[$val['uid']] = $val['uid'];
                if (!empty($val['company_id'])) {
                    $company_ids[$val['company_id']] = $val['company_id'];
                }
            }
            if (!empty($company_ids)){
                $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($company_ids);
            }
			if($member_list = K::M('member/member')->items_by_ids($uids)){
                $designer_ids = array();
                foreach($member_list as $v){
                    if($v['from'] == 'designer'){
                        $designer_ids[$v['uid']] = $v['uid'];
                    }
                } 
                if($designer_ids){
                    $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_ids);
                }         
            }

			$this->pagedata['items'] = $items;
        }
		K::M('guan/guan')->update_count($guan_id, 'views', 1); 
        $this->pagedata['pager'] = $pager;
        
        $this->tmpl = 'guan/cases.html';
    
    }

    public function info($guan_id)
    {
       $guan = $this->check_guan($guan_id);
	    K::M('guan/guan')->update_count($guan_id, 'views', 1);
       $this->tmpl = 'guan/info.html';
    }

    public function caseDetail($guan_id, $case_id, $page=1)
    {
		$guan = $this->check_guan($guan_id);
        if(!$case_id = (int)$case_id){
            $this->error(404);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->error(404);
        }else{
            $this->pagedata['case'] = $case;
            if($case['uid']){
                if($member = K::M('member/member')->member($case['uid'])){
                    if($member['from'] == 'designer'){
                        $designer = K::M('designer/designer')->detail($case['uid']);
						$designer['group'] = K::M('member/group')->check_priv($designer['group_id'],'allow_yuyue');
						$this->pagedata['designer'] = $designer;
                    }
                    $this->pagedata['member'] = $member;
                }
            }
            $pager['page'] = $page = max((int)$page, 1);
            $pager['limit'] = $limit = 12;
            if($items = K::M('case/photo')->items(array('case_id'=>$case_id,'closed = 0'), null, $page, $limit, $count)){
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($guan_id, $case_id, '{page}')));
                $this->pagedata['items'] = $items;
            }
			K::M('guan/guan')->update_count($guan_id, 'views', 1);
            $this->tmpl = 'guan/caseDetail.html';
        }
    }


    protected function check_guan($guan_id)
    {
        if(!$guan_id = (int)$guan_id){
            $this->error(404);
        }else if(!$guan = K::M('guan/guan')->detail($guan_id)){
            $this->error(404);
        }else if(empty($guan['audit'])){
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }
        $this->pagedata['guan'] = $guan;
        return $guan;
    }
}