<?php
/**
 * Copy	Right jisunet.com
 * $Id function.widget.php xinghuali<xinghuali@126.com>
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
function smarty_function_data($params, &$smarty)
{
	$params['block_id'] = $params['block_id'] ? $params['block_id'] : $params['block_id'];
    return K::M('block/block')->block($params, null, $smarty);
}