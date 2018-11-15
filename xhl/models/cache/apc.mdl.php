<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: apc.mdl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

Import::I('cache');
class Mdl_Cache_Apc implements Cache_Interface
{
	
	public function set($key, $val, $ttl=0)
	{
	
	}

	public function get($key)
	{
	
	}

	public function remove($key)
	{
	
	}

	public function flush()
	{
	
	}
}