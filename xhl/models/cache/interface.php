<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: interface.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

interface Cache_Interface
{
	public function set($key, $val, $ttl=0);

	public function get($key);

	public function delete($key);

	public function flush();

	//public function update();
}