<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: sms.php 2504 2015-11-25 07:00:36Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'comid' => 
  array (
    'label' => '企业ID',
    'field' => 'comid',
    'type' => 'text',
    'default' => '70',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'smsnumber' => 
  array (
    'label' => '所用平台',
    'field' => 'smsnumber',
    'type' => 'text',
    'default' => '10690',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'uname' => 
  array (
    'label' => '帐号',
    'field' => 'uname',
    'type' => 'text',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'passwd' => 
  array (
    'label' => '密码',
    'field' => 'passwd',
    'type' => 'text',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
    'mobile' => 
  array (
    'label' => '管理员接受短信的账号',
    'field' => 'mobile',
    'type' => 'text',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
);