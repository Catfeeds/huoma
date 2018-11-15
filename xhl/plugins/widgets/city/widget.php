<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 2415 2015-11-20 16:25:04  xinghuali
 */

class Widget_Data extends Model
{

    public function index(&$params)
    {
        
    }

    public function city(&$params)
    {
		if(!$params['tpl']){
			if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
				$params['type'] = 'option';
			}
			$params['tpl'] = 'widget:default/'.$params['type'].'.html';
		}
		$data = $params;
		if($params['type'] == 'checkbox' || $params['type'] == 'label'){
			$data['value'] = array();
			if($params['value']){
				if(!is_array($params['value'])){
					$data['value'] = explode(',', $params['value']);
				}else{
					$data['value'] = $params['value'];
				}
			}
		}else{
			$data['value'] = $params['value'] ? $params['value'] : 0;
		}
		$data['style'] = 'width:80px;';
		$data['name'] = $params['name'] ? $params['name'] : 'city_id';
		$data['separator'] = $params['separator'] ? $params['separator'] : '';
    	$data['options'] = K::M('data/city')->options();
    	return $data;		
    }

    public function area(&$params)
    {
		if(!$params['tpl']){
			if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
				$params['type'] = 'option';
			}
			$params['tpl'] = 'widget:default/'.$params['type'].'.html';
		}
		$data['value'] = $params['value'] ? $params['value'] : 0;
		$city_id = $params['city_id'] ? $params['city_id'] : null;
    	$data['options'] = K::M('data/area')->options($city_id);
    	return $data;	
    }
}