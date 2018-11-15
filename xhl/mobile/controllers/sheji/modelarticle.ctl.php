<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: designer.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */

class Ctl_Sheji_Modelarticle extends Ctl
{
    public function index($page=1)
    {
        $this->items($page);
    }
	public function items($page=1)
	{
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $area_id = $group_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:designer', true);
        $uri = $this->request['uri'];
        if(preg_match('/items-([\d\-]+)?\-(\d+).html/i', $uri, $m)){
            $page = (int)$m[3];
            if($m[1]){
                $attr_vids = explode('-', trim($m[1], '-'));
                $area_id = $attr_vids ? array_shift($attr_vids) : 0;
                $group_id = $attr_vids ? array_shift($attr_vids) : 0;
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
            $v['link'] = $this->mklink('designer:items', array($area_id, $group_id, implode('-', $vids)));
            $v['checked'] = true;
            foreach($v['values'] as $kk=>$vv){
                $vv['checked'] = false;
                if(in_array($kk, $attr_ids)){
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }                
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('designer:items', array($area_id, $group_id, implode('-', $vids)));
                $v['values'][$kk] = $vv;

            }
            $attr_values[$k] = $v;
        }
        if($group_list = K::M('member/group')->items_by_from('designer')){
            $group_all_link = $this->mklink('designer:items', array($area_id, 0, implode('-', $attr_value_ids), $order, 1));
            foreach($group_list as $k=>$v){
                $v['link'] = $this->mklink('designer:items', array($area_id, $k, implode('-', $attr_value_ids), $order, 1));
                $group_list[$k] = $v;
            }
        }
        $area_list = $this->request['area_list'];
        $area_all_link = $this->mklink('designer:items', array(0, $group_id, implode('-', $attr_value_ids), $order, 1));
        foreach ($area_list as $k=>$v) {
            $v['link'] = $this->mklink('designer:items', array($k, $group_id, implode('-', $attr_value_ids), $order, 1));
            $area_list[$k] = $v;
        }
        $order_list = array(0=>array('title'=>'默认'), 1=>array('title'=>'签单'), 2=>array('title'=>'口碑'));
        $order_list[0]['link'] = $this->mklink('designer:items', array($area_id, $group_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('designer:items', array($area_id, $group_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('designer:items', array($area_id, $group_id, implode('-', $attr_value_ids), 2, 1));

        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['area_id'] = $area_id;
        $pager['group_id'] = $group_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['city_id'] = $this->request['city_id'];
        if($area_id){
            $filter['area_id'] = $area_id;
        }
        if($group_id){
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
            $filter['name'] = "LIKE:%{$kw}%";            
        }
        if($order == 1){
            $orderby = array('tenders_num'=>'DESC');
        }else if($order == 2){
            $orderby = array('score'=>'DESC');
        }else{
            $orderby = NULL;
        }
        if ($items = K::M('designer/designer')->items_by_attr($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('designer:items', array($area_id, $group_id, implode('-', $attr_value_ids), $order, '{page}'), $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $this->pagedata['pager'] = $pager;
        $seo = array('area_name'=>'', 'attr'=>'', 'page'=>'');
        if($area_id){
            $seo['area_name'] = $area_list[$area_id]['area_name'];
        }
        if($attr_value_titles){
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if($page > 1){
            $seo['page'] = $page;
        }    
        $this->seo->init('designer', $seo);
        $this->tmpl = 'sheji/modelarticle.html';
	}
}