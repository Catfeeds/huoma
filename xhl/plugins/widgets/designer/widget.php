<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 5457 2015-06-11 08:53:34Z xinghuali $
 */

class Widget_Designer extends Model
{

    public function index(&$params)
    {
		$params['limit'] = empty($params['limit']) ? 4:(int)$params['limit'];
        $filter = array('city_id'=>$params['city_id'],'audit'=>1,'closed'=>0);
        $items = K::M('designer/designer')->items($filter,array('orderby'=>'desc'),1,$params['limit']);
        $uids = array();
        foreach($items as $k=>$val){
           if($val['uid']) $uids[$val['uid']] = $val['uid'];
           $items[$k]['about'] = K::M('content/html')->text($val['about']);
           $items[$k]['case']  = K::M('case/case')->items(array('audit'=>1,'closed'=>0,'designer_id'=>$val['uid']),array('case_id'=>'desc'),1,3);
        }
        $data['items'] = $items;
        if(!empty($uids)) $data['user_list'] = K::M('member/view')->items_by_ids($uids);
        $params['tpl'] =  $params['tpl'] ?  $params['tpl'] :'index.html'; 
        return $data;
    }
    
}