<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: modifier.filter.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

/**
 * 敏感词替换
 */
function smarty_modifier_taglink($content, $limit=5)
{
    static $link = null;
    if($link === null){
        $link = K::M('article/link');
    }
    return $link->filter($content, $limit);
}