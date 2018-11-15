<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-12-01 13:02:23  xinghuali
 */

class Ctl_Chao_Index extends Ctl
{
	public function index($hangye=0,$guige=0,$jiegou=0,$fengge=0,$mianji=0,$page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = $mianji = 0;
        $heead_title='';
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case');
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $order = $attr_vids ? array_pop($attr_vids) : 0;
                $mianji = $attr_vids ? array_pop($attr_vids) : 0;
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
            $vids['mianji'] = $mianji;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('chao/index', array(implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                    if($heead_title==''){
                        $heead_title .= $vv['title'];
                    }else{
                        $heead_title .= '_'.$vv['title'];
                    }
                    
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('chao/index', array(implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }

        if($mianji_list = K::M('case/case')->mianji_list()){
            $mianji_all_link = $this->mklink('chao/index', array(implode('-', $attr_value_ids),0, $order, 1));
            foreach($mianji_list as $k=>$val){
                $val['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids),$val['val'], $order, 1));
                $mianji_list[$k] = $val;
            }
        }
        $order_list = array(0=>array('title'=>'今日推荐'), 1=>array('title'=>'最受欢迎 '), 2=>array('title'=>'人气排行'));
        $order_list[0]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 0, 1));
        $order_list[1]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 1, 1));
        $order_list[2]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 2, 1));
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 40;
        $pager['count'] = $count = 0;
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $filter['tzaudit'] = 1;
        $filter['istz'] = 1;
         $hangye = 0;
         $guige = 0;
         $jiegou = 0;
         $fengge = 0;
        if($attr_ids){
            $filter['attrs'] = $attr_ids;
            if($attr_ids[5]){
            $hangye = $attr_ids[5];
             }
            if($attr_ids[15]){
            $guige = $attr_ids[15];
            }
            if($attr_ids[17]){
            $jiegou = $attr_ids[17];
            }
            if($attr_ids[18]){
                $fengge = $attr_ids[18];
            }
        }

        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";            
        }
        if($mianji){
            $filter['mianji'] = $mianji;
        }

        if($order == 2){
            $orderby = array('likes'=>'DESC');
        }else if($order == 1){
            $orderby = array('views'=>'DESC');
        }else{
            $orderby = array('mianji'=>'DESC');
        }
        if ($items = K::M('case/case')->items($filter, $orderby, $page, $limit, $count)) {
            $this->pagedata['items'] = $items;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('chao/index', array(implode('-', $attr_value_ids), $order, '{page}'), $params));
        }
       // var_dump($attr_value_ids);die;
        //var_dump($items);die;
        $this->pagedata['mianji_list'] = $mianji_list;
        $this->pagedata['mianji_all_link'] = $mianji_all_link;
        $this->pagedata['mianji'] = $mianji;
        $this->pagedata['heead_title'] = $heead_title;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['pager'] = $pager;

        $this->pagedata['hangye'] = $hangye;
        $this->pagedata['guige'] = $guige;
        $this->pagedata['jiegou'] = $jiegou;
        $this->pagedata['fengge'] = $fengge;
        $this->pagedata['kw'] = urlencode($kw);

        $seo = array('attr'=>'', 'page'=>'');
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->seo->init('chao', $seo);
        $this->tmpl = 'mobile:chao/index.html';
    }

    public function listcon($hangye=0,$guige=0,$jiegou=0,$fengge=0,$mianji=0,$kw='',$page=0){
        if(!$page = $this->GP('page')){
            $page=1;
        }
        if(!$kw = $this->GP('kw')){
            $kw='';
        }

        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = 0;
        $heead_title='';
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case');
        $uri = $this->request['uri'];
        
        if($hangye){
            $attr_ids = array('5'=>$hangye);
        }
        if($guige){
            $attr_ids = array('15'=>$guige);
        }
        if($jiegou){
            $attr_ids = array('17'=>$jiegou);
        }
        if($fengge){
            $attr_ids = array('18'=>$fengge);
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
            $vids['mianji'] = $mianji;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('chao/index', array(implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                    if($heead_title==''){
                        $heead_title .= $vv['title'];
                    }else{
                        $heead_title .= '_'.$vv['title'];
                    }
                    
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('chao/index', array(implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }
        if($mianji_list = K::M('case/case')->mianji_list()){
            $mianji_all_link = $this->mklink('chao/index', array(implode('-', $attr_value_ids),0, $order, 1));
            foreach($mianji_list as $k=>$val){
                $val['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids),$val['val'], $order, 1));
                $mianji_list[$k] = $val;
            }
        }
        
        $order_list = array(0=>array('title'=>'今日推荐'), 1=>array('title'=>'最受欢迎 '), 2=>array('title'=>'人气排行'));
        $order_list[0]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 0, 1));
        $order_list[1]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 1, 1));
        $order_list[2]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 2, 1));
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 40;
        $pager['count'] = $count = 0;
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $filter['tzaudit'] = 1;
        $filter['istz'] = 1;
        if($attr_ids){
            $filter['attrs'] = $attr_ids;
        }
        if (!empty($kw)) {
            $kw= urldecode($kw);
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";            
        }
        if($mianji){
            $filter['mianji'] = $mianji;
        }
        if($order == 2){
            $orderby = array('likes'=>'DESC');
        }else if($order == 1){
            $orderby = array('views'=>'DESC');
        }else{
            $orderby = array('mianji'=>'DESC');
        }
        if ($items = K::M('case/case')->items($filter, $orderby, $page, $limit, $count)) {
            $this->pagedata['items'] = $items;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('chao/index', array(implode('-', $attr_value_ids), $order, '{page}'), $params));
        }
        //var_dump($items);die;

        $this->pagedata['mianji_list'] = $mianji_list;
        $this->pagedata['mianji_all_link'] = $mianji_all_link;
        $this->pagedata['mianji'] = $mianji;
        $this->pagedata['heead_title'] = $heead_title;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['pager'] = $pager;
        $seo = array('attr'=>'', 'page'=>'');
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->seo->init('chao', $seo);
        $this->tmpl = 'mobile:chao/listcon.html';
    }

    public function search($page = 0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = $mianji = 0;
        $heead_title='';
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case');
        $uri = $this->request['uri'];
        if(preg_match('/index(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $order = $attr_vids ? array_pop($attr_vids) : 0;
                $mianji = $attr_vids ? array_pop($attr_vids) : 0;
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
            $vids['mianji'] = $mianji;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('chao/index', array(implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                    if($heead_title==''){
                        $heead_title .= $vv['title'];
                    }else{
                        $heead_title .= '_'.$vv['title'];
                    }
                    
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('chao/index', array(implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }
        if($mianji_list = K::M('case/case')->mianji_list()){
            $mianji_all_link = $this->mklink('chao/index', array(implode('-', $attr_value_ids),0, $order, 1));
            foreach($mianji_list as $k=>$val){
                $val['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids),$val['val'], $order, 1));
                $mianji_list[$k] = $val;
            }
        }
        
        $order_list = array(0=>array('title'=>'今日推荐'), 1=>array('title'=>'最受欢迎 '), 2=>array('title'=>'人气排行'));
        $order_list[0]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 0, 1));
        $order_list[1]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 1, 1));
        $order_list[2]['link'] = $this->mklink('chao/index', array(implode('-', $attr_value_ids), $mianji, 2, 1));
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 40;
        $pager['count'] = $count = 0;
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $filter['tzaudit'] = 1;
        $filter['istz'] = 1;
        if($attr_ids){
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";            
        }
        if($mianji){
            $filter['mianji'] = $mianji;
        }
        if($order == 2){
            $orderby = array('likes'=>'DESC');
        }else if($order == 1){
            $orderby = array('views'=>'DESC');
        }else{
            $orderby = array('mianji'=>'DESC');
        }
        if ($items = K::M('case/case')->items($filter, $orderby, $page, $limit, $count)) {
            $this->pagedata['items'] = $items;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('chao/index', array(implode('-', $attr_value_ids), $order, '{page}'), $params));
        }
        //var_dump($items);die;

        $this->pagedata['mianji_list'] = $mianji_list;
        $this->pagedata['mianji_all_link'] = $mianji_all_link;
        $this->pagedata['mianji'] = $mianji;
        $this->pagedata['heead_title'] = $heead_title;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['pager'] = $pager;
        $seo = array('attr'=>'', 'page'=>'');
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->seo->init('chao', $seo);
        $this->tmpl = 'mobile:chao/search.html';
    }

	public function tj($page = 1)
	{
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 17;
        $pager['count'] = $count = 0;

        if ($items = K::M('case/case')->items(array('istz'=>1,'tzaudit'=>1,'closed'=>0), array('lasttime'=>'DESC'), $page, $limit, $count)) {
            $this->pagedata['items'] = $items;
			$num = floor($count/17);
			if($page>=$num){
				$page=0;
			}
            $this->pagedata['page'] = $page+1;
        }
        $this->tmpl = 'mobile:chao/tj.html';
	}
}