<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: booking.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'max_look' => 
  array (
    'label' => ' 最大投标数',
    'field' => 'max_look',
    'type' => 'number',
    'default' => '',
    'comment' => '一个预约最多可多少商家查看',
    'html' => false,
    'empty' => false,
  ),
  'look_gold' => 
  array (
    'label' => '默认展币',
    'field' => 'look_gold',
    'type' => 'number',
    'default' => '',
    'comment' => '查看预约所花的展币',
    'html' => false,
    'empty' => false,
  ),
);