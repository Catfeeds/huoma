<?php
/**
 * Copy	Right jisunet.com
 * $Id function.widget.php xinghuali<xinghuali@126.com>
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

function smarty_block_calldata($params, $content, $smarty, &$repeat)
{   
	static $obj = null;
	if($obj === null){
		$obj = K::M('block/block');
	}	
	if(!$repeat && $content){
		return $obj->calldata($params, $content, $smarty);
	}	
}