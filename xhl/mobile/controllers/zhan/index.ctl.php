<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2015-12-01 14:56:23  xinghuali
 */

class Ctl_Zhan_Index extends Ctl
{
    
    public function index($province_id=0,$page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $province_id = $zhantime = 0;

        $seo = array('province_name'=>'', 'attr'=>'', 'page'=>'','zhantime'=>'');
        //$province_id = $group_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zhan', true);
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $province_id = $attr_vids ? array_shift($attr_vids) : 0;
                $zhantime = $attr_vids ? array_pop($attr_vids) : 0;
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
            $vids['zhantime'] = $zhantime;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $vids)));
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }

        $province_list = K::M('data/province')->fetch_all();
      //  $province_list = $this->request['province_list'];
        $province_all_link = $this->mklink('zhan/index', array(0, implode('-', $attr_value_ids), $zhantime, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('zhan/index', array($k, implode('-', $attr_value_ids), $zhantime, 1));
            $province_list[$k] = $v;
        }

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['zhantime'] = $zhantime;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if($province_id){
            $filter['province_id'] = $province_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if($attr_ids){
            $filter['attrs'] = $attr_ids;
            $fenlei = $attr_ids[12];
            $mianji = $attr_ids[13];
        }else{
            $jingyan = 0;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }

          if ($zhantime) {
            if($zhantime==7){
                $seo['zhantime'] = '一周内';
                $t = __TIME;
                $t2 = $t+($zhantime*24*3600);
            }else{
                $t = $zhantime;
                $t2 =$t+(31*24*3600);
                $seo['zhantime'] = date('Y年m月份',$zhantime);
                
            }
                $filter['fromtime'] = "<:{$t2}";
                $filter['totime'] = ">:{$t}";
            }

        $orderby = array('fromtime'=>'DESC');

        if ($items = K::M('zhan/zhan')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $zhantime, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
       
        $filter_tj['closed'] = 0;
        $filter_tj['audit'] = 1;
        $filter_tj['fromtime'] = ">:".__TIME;
        $this->pagedata['zhantj'] = K::M('zhan/zhan')->items($filter_tj, array('fromtime'=>'ASC'), 1, 5, $count);
        //$this->pagedata['province_list'] = $province_list;
        $this->pagedata['zhanguan'] = K::M('guan/guan')->items(array('guan_id' => $guan_id),array('orderby' => 'asc'),1,2);

        $zdate = K::M('data/date')->zhan_date(12);
        $zdate_all_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 0, 1));
        $zdate_benzhou_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 7, 1));
        $zdate_sanyue_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 3, 1));
        foreach($zdate['now'] as $k=>$v){
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $v['zhi'], 1));
            $zdate['now'][$k] = $v;
        }
        foreach($zdate['last'] as $k=>$v){
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $v['zhi'], 1));
            $zdate['last'][$k] = $v;
        }

        $this->pagedata['zdate'] = $zdate;
        $this->pagedata['zdate_all_link'] = $zdate_all_link;
        $this->pagedata['zdate_benzhou_link'] = $zdate_benzhou_link;
        //$orderby = NULL;

        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;

        $this->pagedata['zhantime'] = $zhantime;
        $this->pagedata['fenlei'] = $fenlei;
        $this->pagedata['mianji'] = $mianji;
        $this->pagedata['province_id'] = $province_id;
        $this->pagedata['kw'] = urlencode($kw);

        if($province_id){
            $seo['province_name'] = $province_list[$province_id]['province_name'];
        }
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->pagedata['seo'] = $seo;
        $this->seo->init('zhan_items', $seo);
        $this->tmpl = 'mobile:zhan/index.html';
    }

    public function listcon($province_id=0,$fenlei=0,$mianji=0,$zhantime=0,$kw='',$page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        if(!$kw = $this->GP('kw')){
            $kw='';
        }

        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
      //  $zhantime = 0;

        $seo = array('province_name'=>'', 'attr'=>'', 'page'=>'','zhantime'=>'');
        //$province_id = $group_id = $order = 0;

        $attr_values = K::M('data/attr')->attrs_by_from('zx:zhan', true);
        $uri = $this->request['uri'];
        
        if($fenlei){
            $attr_ids = array('12'=>$fenlei);
        }
        if($mianji){
            $attr_ids = array('13'=>$mianji);
        }
        $attr_vids = $attr_ids;  

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
            $vids['zhantime'] = $zhantime;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }

        $province_list = K::M('data/province')->fetch_all();
       // $province_list = $this->request['province_list'];
        $province_all_link = $this->mklink('zhan/index', array(0, implode('-', $attr_value_ids), $zhantime, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('zhan/index', array($k, implode('-', $attr_value_ids), $zhantime, 1));
            $province_list[$k] = $v;
        }

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['zhantime'] = $zhantime;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if($province_id){
            $filter['province_id'] = $province_id;
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

          if ($zhantime) {
            if($zhantime==7){
                $seo['zhantime'] = '一周内';
                $t = __TIME;
                $t2 = $t+($zhantime*24*3600);
            }else{
                $t = $zhantime;
                $t2 =$t+(31*24*3600);
                $seo['zhantime'] = date('Y年m月份',$zhantime);
                
            }
            $filter['fromtime'] = "<:{$t2}";
            $filter['totime'] = ">:{$t}";
        }

        $orderby = array('fromtime'=>'DESC');

        if ($items = K::M('zhan/zhan')->zhan_items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $zhantime, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        $filter_tj['closed'] = 0;
        $filter_tj['audit'] = 1;
        $filter_tj['fromtime'] = ">:".__TIME;
        $this->pagedata['zhantj'] = K::M('zhan/zhan')->items($filter_tj, array('fromtime'=>'ASC'), 1, 5, $count);
        //$this->pagedata['province_list'] = $province_list;
        $this->pagedata['zhanguan'] = K::M('guan/guan')->items(array('guan_id' => $guan_id),array('orderby' => 'asc'),1,2);


        $zdate = K::M('data/date')->zhan_date(12);
        $zdate_all_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 0, 1));
        $zdate_benzhou_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 7, 1));
        $zdate_sanyue_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 3, 1));
      
        foreach($zdate['now'] as $k=>$v){
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $v['zhi'], 1));
            $zdate['now'][$k] = $v;
        }
        foreach($zdate['last'] as $k=>$v){
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $v['zhi'], 1));
            $zdate['last'][$k] = $v;
        }

        $this->pagedata['zdate'] = $zdate;
        $this->pagedata['zdate_all_link'] = $zdate_all_link;
        $this->pagedata['zdate_benzhou_link'] = $zdate_benzhou_link;

        //$orderby = NULL;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;

        if($province_id){
            $seo['province_name'] = $province_list[$province_id]['province_name'];
        }

        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->pagedata['seo'] = $seo;
        $this->seo->init('zhan_items', $seo);
        $this->tmpl = 'mobile:zhan/listcon.html';
    }
    public function search($province_id=0,$fenlei=0,$mianji=0,$zhantime=0,$page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $province_id = $zhantime = 0;

        $seo = array('province_name'=>'', 'attr'=>'', 'page'=>'','zhantime'=>'');
        //$province_id = $group_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zhan', true);
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $province_id = $attr_vids ? array_shift($attr_vids) : 0;
                $zhantime = $attr_vids ? array_pop($attr_vids) : 0;
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
            $vids['zhantime'] = $zhantime;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }

        $province_list = K::M('data/province')->fetch_all();
       // $province_list = $this->request['province_list'];
        $province_all_link = $this->mklink('zhan/index', array(0, implode('-', $attr_value_ids), $zhantime, 1));
        foreach ($province_list as $k=>$v) {
            $v['link'] = $this->mklink('zhan/index', array($k, implode('-', $attr_value_ids), $zhantime, 1));
            $province_list[$k] = $v;
        }

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['province_id'] = $province_id;
        $pager['zhantime'] = $zhantime;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
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
          if ($zhantime) {
            if($zhantime==7){
                $seo['zhantime'] = '一周内';
                $t = __TIME;
                $t2 = $t+($zhantime*24*3600);
            }else{
                $t = $zhantime;
                $t2 =$t+(31*24*3600);
                $seo['zhantime'] = date('Y年m月份',$zhantime);
                
            }
            $filter['fromtime'] = "<:{$t2}";
            $filter['totime'] = ">:{$t}";
        }

        $orderby = array('fromtime'=>'DESC');

        if ($items = K::M('zhan/zhan')->zhan_items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $zhantime, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        $filter_tj['closed'] = 0;
        $filter_tj['audit'] = 1;
        $filter_tj['fromtime'] = ">:".__TIME;
        $this->pagedata['zhantj'] = K::M('zhan/zhan')->items($filter_tj, array('fromtime'=>'ASC'), 1, 5, $count);
        //$this->pagedata['province_list'] = $province_list;
        $this->pagedata['zhanguan'] = K::M('guan/guan')->items(array('guan_id' => $guan_id),array('orderby' => 'asc'),1,2);

        $zdate = K::M('data/date')->zhan_date(12);
        $zdate_all_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 0, 1));
        $zdate_benzhou_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 7, 1));
        $zdate_sanyue_link = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), 3, 1));
        foreach($zdate['now'] as $k=>$v){
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $v['zhi'], 1));
            $zdate['now'][$k] = $v;
        }
        foreach($zdate['last'] as $k=>$v){
            $v['link'] = $this->mklink('zhan/index', array($province_id, implode('-', $attr_value_ids), $v['zhi'], 1));
            $zdate['last'][$k] = $v;
        }

        $this->pagedata['zdate'] = $zdate;
        $this->pagedata['zdate_all_link'] = $zdate_all_link;
        $this->pagedata['zdate_benzhou_link'] = $zdate_benzhou_link;

        //$orderby = NULL;

        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['province_list'] = $province_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['province_all_link'] = $province_all_link;
        $this->pagedata['pager'] = $pager;

        if($province_id){
            $seo['province_name'] = $province_list[$province_id]['province_name'];
        }
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->pagedata['seo'] = $seo;
        $this->seo->init('zhan_items', $seo);
        $this->tmpl = 'mobile:zhan/search.html';
    }



    public function cases($zhan_id, $page=1)
    {
        $zhan = $this->check_zhan($zhan_id);
        $filter = $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $filter['zhan_id'] = $zhan_id;
        $filter['closed'] = '0';
        $filter['audit'] = 1;
        if($items = K::M('case/case')->items($filter, NULL, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan:cases',array($zhan_id, '{page}')));
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
        K::M('zhan/zhan')->update_count($zhan_id, 'views', 1); 
        $this->pagedata['pager'] = $pager;
        
        $this->tmpl = 'mobile:zhan/cases.html';
    
    }

    public function info($zhan_id)
    {
       $zhan = $this->check_zhan($zhan_id);
        K::M('zhan/zhan')->update_count($zhan_id, 'views', 1);
       $this->tmpl = 'mobile:zhan/info.html';
    }

    public function photo($zhan_id,$type, $page)
    {
        $zhan = $this->check_zhan($zhan_id);
        $pager = $filter = array();
        $filter['zhan_id'] = $zhan_id;
        $filter['type'] = $type;
        $pager['page'] = $page  = max((int)$page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if($items = K::M('zhan/photo')->items($filter, NULL, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan:photo',array($zhan_id, $type, '{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['type'] = $type;
        $this->pagedata['pager'] = $pager;
        K::M('zhan/zhan')->update_count($zhan_id, 'views', 1);
        $this->tmpl = 'mobile:zhan/photo.html';
        
    }

    public function site($zhan_id, $page=1)
    {
        $zhan = $this->check_zhan($zhan_id);
        $pager = $filter = array();
        $filter['zhan_id'] = $zhan_id;
        $filter['audit'] = 1;
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
        if($items = K::M('zhan/site')->items($filter, NULL, $page, $limit, $count)){                
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan:site',array($zhan_id, '{page}')));
            $uids = array();
            foreach ($items as $val) {
                $uids[$val['uid']] = $val['uid'];
            }
            
            if($member_list = K::M('member/member')->items_by_ids($uids)){
                $designer_ids  = array();
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
        K::M('zhan/zhan')->update_count($zhan_id, 'views', 1);
        $this->pagedata['status'] =K::M('zhan/site')->get_status();
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:zhan/site.html';
    }

    public function caseDetail($zhan_id, $case_id, $page=1)
    {
        $zhan = $this->check_zhan($zhan_id);
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
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($zhan_id, $case_id, '{page}')));
                $this->pagedata['items'] = $items;
            }
            K::M('zhan/zhan')->update_count($zhan_id, 'views', 1);
            $this->tmpl = 'mobile:zhan/caseDetail.html';
        }
    }

    public function map()
    {
        $area_list = K::M('data/area')->areas_by_city($this->request['city_id']);
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zhan');
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['attr_values'] = $attr_values;
        K::M('helper/seo')->init('zhan_maps', array());
        $this->tmpl = 'mobile:zhan/maps.html';
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
                if($SO['area_id']){
                    $filter['area_id'] = $SO['area_id'];
                }
                if($SO['attr1']){
                    $filter['attrs'][0] = $SO['attr1'];
                }
                if($SO['attr2']){
                    $filter['attrs'][1] = $SO['attr2'];
                }
                $filter['closed'] = 0;
                $items = K::M('zhan/zhan')->items($filter, null, 1, 100, $count);
                $data = array();
                foreach ($items as $val) {
                    $data[$val['zhan_id']] = array(
                        'zhan_id' => $val['zhan_id'],
                        'link' => $this->mklink('zhan:detail', array($val['zhan_id']), array(), true),
                        'name' => $val['name'],
                        'thumb' => $val['thumb'],
                        'qq_qun' => $val['qq_qun'],
                        'phone' => $val['phone'],
                        'price' => $val['price'],
                        'jf_date' => $val['jf_date'],
                        'lng' => $val['lng'],
                        'lat' => $val['lat'],
                        'addr' => $val['addr'],
                        'kp_date' => $val['kp_date'],
                        'kfs' => $val['kfs'],
                    );
                }
                
                $this->err->set_data('total', $count);
                $this->err->set_data('result', $data);
            }
        }
        $this->err->json();
        die;
    }

    public function tuan($area_id=0, $order=0 ,$page=null)
    {
        if($page === null && $area_id){
            $page = (int)$area_id;
            $area_id = 0;
            $order = 0;
        }
        $filter = $pager = $orderby = array();   
        $area_list = $this->request['area_list'];
        $area_all_link = $this->mklink('zhan:tuan', array(0, $order, 1));
        foreach ($area_list as $k=>$v) {
            $v['link'] = $this->mklink('zhan:tuan', array($k, $order, 1));
            $area_list[$k] = $v;
        }
        $order_list = array(0=>array('title'=>'默认'), 1=>array('title'=>'报名'), 2=>array('title'=>'签约'));
        $order_list[0]['link'] = $this->mklink('zhan:tuan', array($area_id, 0, 1));
        $order_list[1]['link'] = $this->mklink('zhan:tuan', array($area_id, 1, 1));
        $order_list[2]['link'] = $this->mklink('zhan:tuan', array($area_id, 2, 1));
        $pager['area_id'] = $area_id;
        $pager['order'] = $order;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 12;
        $filter['audit'] = 1;
        if ($area_id = (int)$area_id) {
            $filter['area_id'] = $area_id;
        } else {
            $filter['city_id'] = $this->request['city_id'];
        }
        if($order == 1){
            $orderby = array('sign_num'=>'DESC');
        }else if($order == 2){
            $orderby = array('qy_num'=>'DESC');
        }else{
            $orderby = null; 
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $filter['title'] = "LIKE:%{$kw}%";            
        }
        if ($items = K::M('zhan/tuan')->items($filter, $orderby, $page, $limit, $count)) {
            $zhan_ids = array();
            foreach ($items as $k => $v) {
                if ($v['zhan_id']) {
                    $zhan_ids[$v['zhan_id']] = $v['zhan_id'];
                }
            }
            if (!empty($zhan_ids)) {
                $this->pagedata['zhan_list'] = K::M('zhan/zhan')->items_by_ids($zhan_ids);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zhan:tuan', array($area_id, $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['pager'] = $pager;
        $seo = array('area_name'=>'', 'page'=>'');
        if($area_id){
            $seo['area_name'] = $area_list[$area_id]['area_name'];
        }
        if($page > 1){
            $seo['page'] = $page;
        }
        $this->seo->init('zhan_tuan', $seo);
        $this->tmpl = 'mobile:zhan/tuan.html';
    }

    public function tuanDetail($tuan_id)
    {
        if(!($tuan_id = (int)$tuan_id) && !($tuan_id = (int)$this->GP('tuan_id'))){
            $this->err->add('没有您要查看的团装', 211);
        }else if(!$detail = K::M('zhan/tuan')->detail($tuan_id)){
            $this->err->add('没有您要查看的团装', 212);
        }else{
            $package = K::M('zhan/package')->items(array('tuan_id'=>$tuan_id));
            $huxingIds = array();
            foreach($package as $v){
                if($v['huxing_id']){
                    $huxingIds[$v['huxing_id']] = $v['huxing_id']; 
                }
            }
            if(!empty($huxingIds)){
                $this->pagedata['huxing'] = K::M('zhan/photo')->items_by_ids($huxingIds);
            }
            $this->pagedata['tuan'] = $detail;
            $this->pagedata['package'] = $package;
            $this->pagedata['zhan'] = $zhan = K::M('zhan/zhan')->detail($detail['zhan_id']);
            if($company_id = $detail['company_id']){
                $company = K::M('company/company')->detail($detail['company_id']);
                $this->pagedata['company'] = $company;
            }
            $seo = array('title'=>$detail['title'], 'zhan_name'=>$zhan['name'], 'company_name'=>$company['name'], 'tuan_desc'=>'');
            $seo['tuan_desc'] = K::M('content/text')->substr(K::M('content/html')->text($detail['content'], true), 0, 200);
            $this->seo->init('zhan_tuan_detail', $seo);
            $this->tmpl = 'mobile:zhan/tuanDetail.html';
        }
    }

    public function tuanSign($tuan_id,$package_id)
    {
        if(!($tuan_id = (int)$tuan_id) && !($tuan_id = (int)$this->GP('tuan_id'))){
            $this->err->add('没有您要查看的团装', 211);
        }else if(!$detail = K::M('zhan/tuan')->detail($tuan_id)){
            $this->err->add('没有您要查看的团装', 212);
        }else if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else {
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
                    $data['tuan_id'] = $tuan_id;
                    if($package_id){
                        $data['package_id'] = $package_id;
                    }else{
                        $data['package_id'] = 0;
                    }
                    if ($sign_id = K::M('zhan/sign')->create($data)) {
                        K::M('zhan/tuan')->update_count($tuan_id,'sign_num', 1);
                        $zhan = K::M('zhan/zhan')->detail($detail['zhan_id']);
                        $smsdata = $maildata = array('contact'=>$data['contact'] ? $data['contact'] : '参展商','mobile'=>$data['mobile'],'zhan_tuan'=>$zhan['name'],'tuan_name'=>$detail['title']);
                        K::M('sms/sms')->send($data['mobile'], 'zhan_tuan', $smsdata);
                        $this->err->add('恭喜您报名成功');
                    }
                }
            }
        }else{
            $access = $this->system->config->get('access');
            $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
            $this->pagedata['tuan'] = $detail;
            $this->pagedata['package_id'] = $package_id;
            $this->tmpl = 'mobile:zhan/tuanSign.html';
        }      
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


//我要搭建展台的方法
     public function tijiao()
     {
        if(!$this->checksubmit('canzhan')){
            $this->err->add('非法的数据提交', 211);
        }else if(!$canzhan = $this->GP('canzhan')){
            $this->err->add('非法的数据提交', 212);
        }else if($canzhan[cname] == ''){
            $this->err->add('非法的数据提交', 212);
        }else if(!$canzhan = $this->GP('canzhan')){
            $this->err->add('非法的数据提交', 212);
        }else{
            $access = $this->system->config->get('access');
                if($uid = K::M('canzhan/canzhan')->create($canzhan)){
                    $this->err->add('恭喜您，添加成功');
                }
        }
    }


}