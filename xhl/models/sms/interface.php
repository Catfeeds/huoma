<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: interface.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

interface Sms_Interface
{
	//. public $gatewary = '';
	public function send($mobile, $content);
}