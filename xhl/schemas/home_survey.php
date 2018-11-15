<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: home_survey.php 2335 2015-11-18 17:15:56  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'survey_id' => 
  array (
    'field' => 'survey_id',
    'label' => 'ID',
    'pk' => true,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'city_id' => 
  array (
    'field' => 'city_id',
    'label' => '城市',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'city',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'area_id' => 
  array (
    'field' => 'area_id',
    'label' => '地区',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'area',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'uid' => 
  array (
    'field' => 'uid',
    'label' => '用户',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'member',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'home_name' => 
  array (
    'field' => 'home_name',
    'label' => '小区名称',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),
  'name' => 
  array (
    'field' => 'name',
    'label' => '称呼',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),
  'tel' => 
  array (
    'field' => 'tel',
    'label' => '联系方式',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'phone',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),
  'create_ip' => 
  array (
    'field' => 'create_ip',
    'label' => '创建时间',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
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
    'label' => '创建IP',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'dateline',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
);