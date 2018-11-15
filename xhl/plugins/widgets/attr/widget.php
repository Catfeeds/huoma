<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 2415 2015-11-20 16:25:04  xinghuali
 */

class Widget_Attr extends Model 
{
	
	public function index(&$params)
	{
	}

    public function attr(&$params)
    {
		$params['tpl'] = $params['tpl'] ? $params['tpl'] : ($params['type']=='filter' ? 'attr-filter.html' : 'attr-form.html');
		$data['value'] = array();
		if($params['value']){
			if(!is_array($params['value'])){
				$data['value'] = explode(',', $params['value']);
			}
			$data['value'] = $params['value'];
		}
        if($params['colspan']){
            $data['colspan'] = $params['colspan'];
        }
		if($params['from_id']){
			$data['attrs'] = K::M('data/attr')->attrs_by_from($params['from']);
		}else if($params['from']){
			$data['attrs'] = K::M('data/attr')->attrs_by_from($params['from']);
		}
        return $data;           
    }

    public function form(&$params)
    {
		$params['tpl'] = $params['tpl'] ? $params['tpl'] : 'attr-form.html';
		$data['value'] = array();
		if($params['value']){
			if(!is_array($params['value'])){
				$data['value'] = explode(',', $params['value']);
			}
			$data['value'] = $params['value'];
		}
        if($params['colspan']){
            $data['colspan'] = $params['colspan'];
        }        
        $data['attrs'] = K::M('data/attr')->attrs_by_from($params['from']);
        return $data;          	
    }

    public function form_select(&$params)
    {
		$params['tpl'] = $params['tpl'] ? $params['tpl'] : 'attr-form_select.html';
		$data['value'] = array();
		if($params['value']){
			if(!is_array($params['value'])){
				$data['value'] = explode(',', $params['value']);
			}
			$data['value'] = $params['value'];
		}
        if($params['colspan']){
            $data['colspan'] = $params['colspan'];
        }        
        $data['attrs'] = K::M('data/attr')->attrs_by_from($params['from']);
        return $data;          	
    }


    public function from(&$params)
    {
		$params['tpl'] = $params['tpl'] ? $params['tpl'] : 'widget:default/option.html';
		if($params['value']){
			if(!is_array($params['value'])){
				$data['value'] = explode(',', $params['value']);
			}
			$data['value'] = $params['value'];
		}
        if($params['colspan']){
            $data['colspan'] = $params['colspan'];
        }        
		$data['options'] = K::M('data/attrfrom')->options();
		return $data;
    }
}