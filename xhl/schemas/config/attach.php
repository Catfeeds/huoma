<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: attach.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'dir' => 
  array (
    'label' => '附件保存位置',
    'field' => 'dir',
    'type' => 'text',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'url' => 
  array (
    'label' => '附件URL地址',
    'field' => 'url',
    'type' => 'text',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'watermarktype' => 
  array (
    'label' => '水印类型',
    'field' => 'watermarktype',
    'type' => 'text',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
);