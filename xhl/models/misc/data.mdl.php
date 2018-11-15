<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: data.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Misc_Data
{    
    
    public function yuyue($status=null)
    {
        static $status_list = array('0'=>'未通过','1'=>'审核中','2'=>'已接单','3'=>'设计中','4'=>'报价中','5'=>'签单','9'=>'未成交');
        static $status_list2 = array('0'=>'<b class="red">未处理</b>','1'=>'<b class="orange">意向</b>', '2'=>'<b class="blue">已签</b>','-1'=>'<b>无效</b>');
        if($status === null){
            return $status_list;
        }else{
            return $status_list2[$status];
        }
    }
}