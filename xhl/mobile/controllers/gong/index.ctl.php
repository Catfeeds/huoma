<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 10025 2015-12-01 11:56:23  xinghuali
 */

class Ctl_Gong_Index extends Ctl
{
	public function index($page = 1)
	{
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $city_id = $group_id = $order = 0;
        $seo = array('city_name'=>'', 'group_name'=>'', 'page'=>'');
        $attr_values = K::M('data/attr')->attrs_by_from('zx:company', true);
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $city_id = $attr_vids ? array_shift($attr_vids) : 0;
                $group_id = $attr_vids ? array_shift($attr_vids) : 0;
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        if($group_list = K::M('member/group')->items_by_from('company')){
            $group_all_link = $this->mklink('gong/index', array($city_id, 0, 0, $order, 1));
            foreach($group_list as $k=>$v){
                $v['link'] = $this->mklink('gong/index', array($city_id, $k, 0, $order, 1));
                $group_list[$k] = $v;
            }
        }
		$city_list = K::M('data/city')->zhuyao_city();
        foreach ($city_list as $k=>$v) {
            $v['link'] = $this->mklink('gong/index', array($v['city_id'], $group_id, implode('-', $attr_value_ids), $order, 1));
			$city_list[$k] = $v;
        }

        $order_list = array(2=>array('title'=>'口碑'), 1=>array('title'=>'签单'), 0=>array('title'=>'默认'));
        $order_list[0]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 2, 1));

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['city_id'] = $city_id;
        $pager['group_id'] = $group_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
 //       $filter['city_id'] = $this->request['city_id'];
        if($city_id){
            $seo['city_name'] = $city_list[$city_id]['city_name'];
            $filter['city_id'] = $city_id;
        }
        if($group_id){
            $seo['group_name'] = $group_list[$group_id]['group_name'];
            $filter['group_id'] = $group_id;
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
            $orderby = array('tenders_num'=>'DESC','group_id'=>'ASC','dateline'=>'ASC');
        }else if($order == 2){
            $orderby = array('score'=>'DESC','group_id'=>'ASC','dateline'=>'ASC');
        }else{
            $orderby = array('group_id'=>'ASC','orderby'=>'DESC','dateline'=>'ASC');
        }
        if ($items = K::M('company/company')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        
        if($qianyue =  K::M('canzhan/canzhan')->items(array('company_id'=>'>:0'), array('sign_time'=>'DESC'), 1, 5, $count)){
            foreach($qianyue as $k=>$co){
                $cids[$co['company_id']] = $co['company_id'];
            }
            $company_list=K::M('company/company')->items_by_ids($cids);
            foreach($qianyue as $k=>$co){
                $co['company'] = $company_list[$co['company_id']];
                $qianyue[$k]=$co;
            }
            
        }
        
        $this->pagedata['qianyue'] = $qianyue;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['city_list'] = $city_list;
        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['city_id'] = $city_id;
        $this->pagedata['group_id'] = $group_id;
        $this->pagedata['kw'] = urlencode($kw);
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
       $this->pagedata['seo'] = $seo;
//        $this->seo->init('gs_items', $seo);
        $this->tmpl = 'mobile:gong/index.html';
	}

    public function search($page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $city_id = $group_id = $order = 0;
        $seo = array('city_name'=>'', 'group_name'=>'', 'page'=>'');
        $attr_values = K::M('data/attr')->attrs_by_from('zx:company', true);
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $city_id = $attr_vids ? array_shift($attr_vids) : 0;
                $group_id = $attr_vids ? array_shift($attr_vids) : 0;
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        if($group_list = K::M('member/group')->items_by_from('company')){
            $group_all_link = $this->mklink('gong/index', array($city_id, 0, 0, $order, 1));
            foreach($group_list as $k=>$v){
                $v['link'] = $this->mklink('gong/index', array($city_id, $k, 0, $order, 1));
                $group_list[$k] = $v;
            }
        }
		$city_list = K::M('data/city')->zhuyao_city();
        foreach ($city_list as $k=>$v) {
            $v['link'] = $this->mklink('gong/index', array($v['city_id'], $group_id, implode('-', $attr_value_ids), $order, 1));
			$city_list[$k] = $v;
        }
        $area_all_link = $this->mklink('gong/index', array(0, $group_id, implode('-', $attr_value_ids), $order, 1));

        $order_list = array(2=>array('title'=>'口碑'), 1=>array('title'=>'签单'), 0=>array('title'=>'默认'));
        $order_list[0]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 2, 1));

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['city_id'] = $city_id;
        $pager['group_id'] = $group_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 30;
        $pager['count'] = $count = 0;
 //       $filter['city_id'] = $this->request['city_id'];
        if($city_id){
            $seo['city_name'] = $city_list[$city_id]['city_name'];
            $filter['city_id'] = $city_id;
        }
        if($group_id){
            $seo['group_name'] = $group_list[$group_id]['group_name'];
            $filter['group_id'] = $group_id;
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
            $orderby = array('tenders_num'=>'DESC','group_id'=>'ASC','dateline'=>'ASC');
        }else if($order == 2){
            $orderby = array('score'=>'DESC','group_id'=>'ASC','dateline'=>'ASC');
        }else{
            $orderby = array('group_id'=>'ASC','orderby'=>'DESC','dateline'=>'ASC');
        }
        if ($items = K::M('company/company')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        
        if($qianyue =  K::M('canzhan/canzhan')->items(array('company_id'=>'>:0'), array('sign_time'=>'DESC'), 1, 5, $count)){
            foreach($qianyue as $k=>$co){
                $cids[$co['company_id']] = $co['company_id'];
            }
            $company_list=K::M('company/company')->items_by_ids($cids);
            foreach($qianyue as $k=>$co){
                $co['company'] = $company_list[$co['company_id']];
                $qianyue[$k]=$co;
            }
            
        }
        
        $this->pagedata['qianyue'] = $qianyue;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['city_list'] = $city_list;
        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $this->pagedata['pager'] = $pager;
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
       $this->pagedata['seo'] = $seo;
//        $this->seo->init('gs_items', $seo);
        $this->tmpl = 'mobile:gong/search.html';
    }

    public function listcon($city_id=0,$group_id=0,$kw='',$page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }

        if(!$kw = $this->GP('kw')){
            $kw='';
        }

        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = 0;
        $seo = array('city_name'=>'', 'group_name'=>'', 'page'=>'');
        $attr_values = K::M('data/attr')->attrs_by_from('zx:company', true);
        $uri = $this->request['uri'];
        
        if($group_list = K::M('member/group')->items_by_from('company')){
            $group_all_link = $this->mklink('gong/index', array($city_id, 0, 0, $order, 1));
            foreach($group_list as $k=>$v){
                $v['link'] = $this->mklink('gong/index', array($city_id, $k, 0, $order, 1));
                $group_list[$k] = $v;
            }
        }
        $zhuyao_city = K::M('data/city')->zhuyao_city();
        $city_list = array();
        foreach ($zhuyao_city as $k=>$v) {
            $city_list[$k]['link'] = $this->mklink('gong/index', array($k, $group_id, implode('-', $attr_value_ids), $order, 1));
            $city_list[$k]['city_name'] = $v;
            $city_list[$k]['city_id'] = $k;
        }
        $area_all_link = $this->mklink('gong/index', array(0, $group_id, implode('-', $attr_value_ids), $order, 1));

        $order_list = array(2=>array('title'=>'口碑'), 1=>array('title'=>'签单'), 0=>array('title'=>'默认'));
        $order_list[0]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), 2, 1));

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['city_id'] = $city_id;
        $pager['group_id'] = $group_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 30;
        $pager['count'] = $count = 0;
 //       $filter['city_id'] = $this->request['city_id'];
        if($city_id){
            $seo['city_name'] = $city_list[$city_id]['city_name'];
            $filter['city_id'] = $city_id;
        }
        if($group_id){
            $seo['group_name'] = $group_list[$group_id]['group_name'];
            $filter['group_id'] = $group_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if($attr_ids){
            $filter['attrs'] = $attr_ids;
        }
        if (!empty($kw)) {
            $kw= urldecode($kw);
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";            
        }
        if($order == 1){
            $orderby = array('tenders_num'=>'DESC','group_id'=>'ASC','dateline'=>'ASC');
        }else if($order == 2){
            $orderby = array('score'=>'DESC','group_id'=>'ASC','dateline'=>'ASC');
        }else{
            $orderby = array('group_id'=>'ASC','orderby'=>'DESC','dateline'=>'ASC');
        }
        if ($items = K::M('company/company')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('gong/index', array($city_id, $group_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        
        if($qianyue =  K::M('canzhan/canzhan')->items(array('company_id'=>'>:0'), array('sign_time'=>'DESC'), 1, 5, $count)){
            foreach($qianyue as $k=>$co){
                $cids[$co['company_id']] = $co['company_id'];
            }
            $company_list=K::M('company/company')->items_by_ids($cids);
            foreach($qianyue as $k=>$co){
                $co['company'] = $company_list[$co['company_id']];
                $qianyue[$k]=$co;
            }
            
        }
        
        $this->pagedata['qianyue'] = $qianyue;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['city_list'] = $city_list;
        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $this->pagedata['pager'] = $pager;
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
       $this->pagedata['seo'] = $seo;
//        $this->seo->init('gs_items', $seo);
        $this->tmpl = 'mobile:gong/listcon.html';
    }




	public function map()
	{
		$province_list = K::M('data/area')->areas_by_city($this->request['city_id']);
		$attr_values = K::M('data/attr')->attrs_by_from('zx:company');
		$this->pagedata['province_list'] = $province_list;
		$this->pagedata['attr_values'] = $attr_values;
		K::M('helper/seo')->init('gs_maps', array());
        $this->tmpl = 'gs/maps.html';
	}

	public function result()
    {
        $SO = $this->GP('SO');
        if (!empty($SO['lng_start']) && !empty($SO['lng_end']) && !empty($SO['lat_start']) && !empty($SO['lat_end'])) {
            if (is_numeric($SO['lng_start']) && is_numeric($SO['lng_end']) && is_numeric($SO['lat_start']) && is_numeric($SO['lat_end'])) {
                $filter['lng'] = $SO['lng_start'] . '~' . $SO['lng_end'];
                $filter['lat'] = $SO['lat_start'] . '~' . $SO['lat_end'];
				if($SO['name']){
					$filter['name'] = "LIKE:%".$SO['name']."%";
				}
				if($SO['province_id']){
					$filter['province_id'] = $SO['province_id'];
				}
				if($SO['attr1']){
					$filter['attrs'][0] = $SO['attr1'];
				}
				if($SO['attr2']){
					$filter['attrs'][1] = $SO['attr2'];
				}
                $filter['closed'] = 0;
                $items = K::M('company/company')->items($filter, null, 1, 100, $count);
                $data = array();
                foreach ($items as $val) {
                    $data[$val['company_id']] = array(
                        'company_id' => $val['company_id'],
                        'link' => $val['company_url'],
                        'name' => $val['name'],
                        'thumb' => $val['thumb'],
                        'contact' => $val['contact'],
						'phone' => $val['show_phone'],
                        'lng' => $val['lng'],
                        'lat' => $val['lat'],
                        'addr' => $val['addr'],
                    );
                }				
                $this->err->set_data('total', $count);
                $this->err->set_data('result', $data);
            }
        }
        $this->err->json();
        die;
    }

     public function yuyue($company_id)
     {
        //var_dump($company_id);die;
        if(!($company_id = (int) $company_id) && !($company_id = (int)$this->GP('company_id'))) {
            $this->error(404);;
        } else if (!$detail = K::M('company/company')->detail($company_id)) {
            $this->err->add('装修工厂不存在或已经删除', 212);
        }else if(empty($detail['audit'])){
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }else{
          
                if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }else{
                    $verifycode_success = true;
                    $access = $this->system->config->get('access');

                    if($access['verifycode']['yuyue']){
                        if(!$verifycode = $this->GP('verifycode')){
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        }else if(!K::M('magic/verify')->check($verifycode)){
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        }
                    }
                    if($verifycode_success){
                        $data['uid'] = (int)$this->uid;
                        $data['company_id'] = $company_id;
                        $data['content'] = "预约装修";
                        $data['city_id'] = $this->request['city_id'];
                        //var_dump($data);die;
                        if($yuyue_id = K::M('company/yuyue')->create($data)){
                            //var_dump($yuyue_id);die;
                            K::M('company/yuyue')->yuyue_count($company_id);
                            $this->err->add('预约装修工厂成功！');
                        }
                    }
                } 
                   
        }
    }
}