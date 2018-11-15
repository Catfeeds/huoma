<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: module.ctl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Module_Module extends Ctl
{
	

	public function index()
	{
		$this->pagedata['_OO_'] = 'admin:module/index.html';
		$this->output();
	}

	//添加控制模块
	public function create()
	{

	}

	public function save()
	{
		
	}

	public function remove()
	{

	}
}