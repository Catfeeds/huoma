<?php
/**
 * Copy	Right jisunet.com
 * $Id function.widget.php xinghuali<xinghuali@126.com>
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

function smarty_block_KT($params, $content,	$smarty, &$repeat)
{
	static $block = null;
	if($block === null){
		$block = K::M('block/block');
	}	
	if(!$repeat && $content){
		return $block->block($params, $content, $smarty);
	}
}