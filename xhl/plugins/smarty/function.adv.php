<?php
/**
 * Copy Right jisunet.com
 * $Id function.widget.php xinghuali<xinghuali@126.com>
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
function smarty_function_adv($params, &$smarty)
{	
    $params['adv_id'] = $params['adv_id'] ? $params['adv_id'] : $params['id'];
    return K::M('adv/adv')->block($params, null, $smarty);
}

