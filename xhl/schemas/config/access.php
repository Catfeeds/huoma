<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * #fileid#
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'closed' => 
  array (
    'label' => '网站状态',
    'field' => 'closed',
    'type' => 'boolean',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => true,
  ),
  'closed_reason' => 
  array (
    'label' => '关闭原因',
    'field' => 'closedreason',
    'type' => 'textarea',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => true,
  )
);