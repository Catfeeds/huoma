<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: shop_money.php 3053 2015-01-15 02:00:13  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'id' => 
  array (
    'field' => 'id',
    'label' => 'ID',
    'pk' => true,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'int',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'shop_id' => 
  array (
    'field' => 'shop_id',
    'label' => '企业',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'shop',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'money' => 
  array (
    'field' => 'money',
    'label' => '金额',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'text',
    'comment' => 'RMB',
    'default' => '0.00',
    'SO' => false,
  ),
  'log' => 
  array (
    'field' => 'log',
    'label' => '日志',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'textarea',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'audit' => 
  array (
    'field' => 'audit',
    'label' => '审核',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'audit',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'clientip' => 
  array (
    'field' => 'clientip',
    'label' => 'clientip',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'clientip',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'dateline' => 
  array (
    'field' => 'dateline',
    'label' => 'dateline',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'dateline',
    'comment' => '',
    'default' => '',
    'SO' => 'betweendate',
  ),
);