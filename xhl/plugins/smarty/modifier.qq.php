<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: modifier.qq.php 5379 2015-05-30 10:17:21  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

function smarty_modifier_qq($qqs, $limit=10, $title='')
{
	if(empty($qqs)){
		return false;
	}
	/*
	static $site = null;
	if(empty($title)){
		if($site === null){
			$site = K::$system->config->get('site');
		}
		$title = $site['title'];
	}
	*/
	if(!is_array($qqs)){
		$qqs = explode(',', $qqs);
	}
	$content = '';
	$index = 0;
	$host = $_SERVER['HTTP_HOST'];
	$res = __CFG::RES_URL;
	foreach((array)$qqs as $qq){
		$index ++;
		if($index > $limit){
			break;
		}
		$title = $title ? $title : '点击咨询';
		$content .= '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes" title="'.$title.'"><img border="0" src="'.$res.'/images/icon/qq.png" style="vertical-align:middle"/></a>';
	}
	return $content;
}