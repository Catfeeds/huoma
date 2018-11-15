<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: guan.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */

class Ctl_Guan_Index extends Ctl
{
    public function index($province_id=0)
    {
        $pager = $filter = array();
        $province_id = $order = 0;
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $province_id = $attr_vids ? array_shift($attr_vids) : 0;
            }
        }

        $province_list = K::M('data/province')->fetch_all();
		//$province_list  =  $this->request['province_list'];
        $province_all_link = $this->mklink('guan/index', array(0, implode('-', $attr_value_ids), $order, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('guan/index', array($k, implode('-', $attr_value_ids), $order, 1));
            $province_list[$k] = $v;
        }

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if($province_id){
            $filter['province_id'] = $province_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if ($items = K::M('guan/guan')->items($filter, array('guan_id'=>'DESC'), $page, $limit, $count)) {
			$guan_ids = '';
			$i = 0;
			foreach($items as $key=>$val){
				if($i==0){
					$guan_ids = $val['guan_id'];
				}else{
					$guan_ids .= ','.$val['guan_id'];
				}
                $i++;
			}
			$zhanhui = K::M('zhan/zhan')->items_guan($guan_ids);
            foreach($items as $key=>$val){
                $val['zhanhui'] = $zhanhui[$key];
                $items[$key] = $val;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('guan/index', array($province_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
           // $this->pagedata['zhanhui'] = $zhanhui;

        }
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['province_id'] = $province_id; 
        $this->pagedata['kw'] = urlencode($kw);
        $seo = array('area_name'=>'', 'attr'=>'', 'page'=>'');
        if($province_id){
            $seo['province_name'] = $province_list[$province_id]['province_name'];
        }
        if($page > 1){
            $seo['page'] = $page;
        }

		$guan_tuijian = K::M('guan/guan')->items(array('closed'=>0,'audit'=>1), array('views'=>'DESC'), 1, 5, $count);
        //var_dump($this->pagedata['zhanhui']);die;
		$this->pagedata['guan_tuijian'] = $guan_tuijian;
		$this->pagedata['seo'] = $seo;
        $this->seo->init('guan_items', $seo);
        $this->tmpl = 'mobile:guan/index.html';
    }


    public function listcon($province_id=0,$kw='',$page=0)
    {
		if(!$page = $this->GP('page')){
			$page=1;
		}
        
        if(!$kw = $this->GP('kw')){
            $kw='';
        }

        $pager = $filter = array();
        $order = 0;
        $uri = $this->request['uri'];

        $province_list  =  $this->request['province_list'];
        $province_all_link = $this->mklink('guan/index', array(0, implode('-', $attr_value_ids), $order, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('guan/index', array($k, implode('-', $attr_value_ids), $order, 1));
            $province_list[$k] = $v;
        }

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if($province_id){
            $filter['province_id'] = $province_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
         if (!empty($kw)) {
            $kw= urldecode($kw);
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if ($items = K::M('guan/guan')->items($filter, array('guan_id'=>'DESC'), $page, $limit, $count)) {
            $guan_ids = '';
            $i = 0;
            foreach($items as $key=>$val){
                if($i==0){
                    $guan_ids = $val['guan_id'];
                }else{
                    $guan_ids .= ','.$val['guan_id'];
                }
                $i++;
            }
            $zhanhui = K::M('zhan/zhan')->items_guan($guan_ids);
            foreach($items as $key=>$val){
                $val['zhanhui'] = $zhanhui[$key];
                $items[$key] = $val;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('guan/index', array($province_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
           // $this->pagedata['zhanhui'] = $zhanhui;

        }
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;
        $seo = array('area_name'=>'', 'attr'=>'', 'page'=>'');
        if($province_id){
            $seo['province_name'] = $province_list[$province_id]['province_name'];
        }
        if($page > 1){
            $seo['page'] = $page;
        }

        $guan_tuijian = K::M('guan/guan')->items(array('closed'=>0,'audit'=>1), array('views'=>'DESC'), 1, 5, $count);
        //var_dump($this->pagedata['zhanhui']);die;
        $this->pagedata['guan_tuijian'] = $guan_tuijian;
        $this->pagedata['seo'] = $seo;
        $this->seo->init('guan_items', $seo);
        $this->tmpl = 'mobile:guan/listcon.html';
    }

    public function  search($page=0){
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $pager = $filter = array();
        $province_id = $order = 0;
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $province_id = $attr_vids ? array_shift($attr_vids) : 0;
            }
        }
      //  $province_list  =  $this->request['province_list'];
        $province_list  =  K::M('data/province')->fetch_all();
        $province_all_link = $this->mklink('guan/index', array(0, implode('-', $attr_value_ids), $order, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('guan/index', array($k, implode('-', $attr_value_ids), $order, 1));
            $province_list[$k] = $v;
        }

        //var_dump($province_list);die;
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if($province_id){
            $filter['province_id'] = $province_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
         if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
     
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;
        $seo = array('area_name'=>'', 'attr'=>'', 'page'=>'');
        if($province_id){
            $seo['province_name'] = $province_list[$province_id]['province_name'];
        }
        if($page > 1){
            $seo['page'] = $page;
        }

        $guan_tuijian = K::M('guan/guan')->items(array('closed'=>0,'audit'=>1), array('views'=>'DESC'), 1, 5, $count);
        //var_dump($this->pagedata['zhanhui']);die;
        $this->pagedata['guan_tuijian'] = $guan_tuijian;
        $this->pagedata['seo'] = $seo;
        $this->seo->init('guan_items', $seo);
        $this->tmpl = 'mobile:guan/search.html';
    } 


    public function chang($guan_id)
    {
        $guan = $this->check_guan($guan_id);
		$photos = $filter = array();
        $filter['guan_id'] = $guan_id;
        $filter['type'] = 1;
		$photos = K::M('guan/photo')->items($filter);
		$this->pagedata['photos'] = $photos;
        $this->seo->set_company($guan);
		//参展计划
		$gnews = K::M('guan/news')->items($filter);
		$this->pagedata['gnews'] = $gnews;
		//已办过多少展
		$gzhan = K::M('zhan/zhan')->gitems('guan_id = '.$guan_id);
		$this->pagedata['gzhan'] = $gzhan;
		
        K::M('guan/guan')->update_count($guan_id, 'views', 1);  
       
        $seo = array('guan_name'=>$guan['name'], 'guan_title'=>$guan['title'],'guan_desc'=>'');
        $seo['guan_desc'] = K::M('content/text')->substr(K::M('content/html')->text($guan['content'], true), 0, 200);
        $this->seo->init('guan_detail', array('guan_title' => $guan['title'],'guan_desc' => $seo['guan_desc']));
        
        $this->tmpl = 'mobile:guan/guan.html';
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
            $this->tmpl = 'mobile:guan/news.html';
        }
    }

    public function cases($guan_id, $page=1)
    {
        $guan = $this->check_guan($guan_id);
        $filter = $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 50;
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
        
        $this->tmpl = 'mobile:guan/cases.html';
    
    }

    public function info($guan_id)
    {
       $guan = $this->check_guan($guan_id);
	    K::M('guan/guan')->update_count($guan_id, 'views', 1);
       $this->tmpl = 'mobile:guan/info.html';
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
            $pager['limit'] = $limit = 50;
            if($items = K::M('case/photo')->items(array('case_id'=>$case_id,'closed = 0'), null, $page, $limit, $count)){
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($guan_id, $case_id, '{page}')));
                $this->pagedata['items'] = $items;
            }
			K::M('guan/guan')->update_count($guan_id, 'views', 1);
            $this->tmpl = 'mobile:guan/caseDetail.html';
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