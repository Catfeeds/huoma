<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: alipay.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'pid' => 
  array (
    'label' => 'PID',
    'field' => 'pid',
    'type' => 'text',
    'default' => '',
    'comment' => '支付宝签约的商户号',
    'html' => false,
    'empty' => false,
  ),
  'key' => 
  array (
    'label' => 'KEY',
    'field' => 'key',
    'type' => 'text',
    'default' => '',
    'comment' => '支付宝签约的商户KEY',
    'html' => false,
    'empty' => false,
  ),
  'type' => 
  array (
    'label' => '接口类型',
    'field' => 'type',
    'type' => 'select',
    'default' => '',
    'comment' => '支付接口类型',
    'html' => false,
    'empty' => false,
  ),
  'sell' => 
  array (
    'label' => '卖家账号',
    'field' => 'sell',
    'type' => 'text',
    'default' => '',
    'comment' => '卖家账号',
    'html' => false,
    'empty' => false,
  ),
);