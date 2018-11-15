<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: taobaoapp.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'taoke_pid' => 
  array (
    'label' => '淘宝客PID',
    'field' => 'taoke_pid',
    'type' => 'text',
    'default' => '',
    'comment' => '淘宝客PID返利到的帐户',
    'html' => false,
    'empty' => false,
  ),
);