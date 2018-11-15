<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: widget.php 5950 2015-07-30 02:12:21  xinghuali
 */

class Widget_Links extends Model
{

	public function index(&$params)
	{
		$params['tpl'] = 'default.html';
		$links = array();
		if($items = K::M('market/links')->fetch_all()){
			foreach($items as $k=>$v){
				if(empty($v['audit'])){
					continue;
				}
				if($params['city_id']){
					if(!is_array($v['city_ids'])){
						$v['city_ids'] = explode(',', $v['city_ids']);
					}
					if(!in_array($params['city_id'], (array)$v['city_ids'])){
						continue;
					}
				}
				$links[$k] = $v;
			}
		}
		return $links;
	}
}