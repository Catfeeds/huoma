<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 2469 2015-11-24 02:19:00Z xinghuali $
 */

class Widget_Dianping extends Model
{

    public function index(&$params)
    {
		$data['limit'] = empty($params['limit']) ? 3:(int)$params['limit'];
        $filter = array('audit'=>1,'is_rec'=>1);
        $items = K::M('company/dianping')->items($filter,array('id'=>'desc'),1,$data['limit']);
        $companyIds = array();
        foreach($items as $k=>$v){
            if($v['company_id']) $companyIds[$v['company_id']] = $v['company_id'];
        }
        if(!empty($companyIds)) $data['company_list'] = K::M('company/company')->items_by_ids($companyIds);
        $data['dianping'] = $items;
        $params['tpl'] = 'index.html'; 
        return $data;
    }
    
}