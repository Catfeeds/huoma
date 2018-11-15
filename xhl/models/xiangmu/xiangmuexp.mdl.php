<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: xiangmu.mdl.php 9581 2015-04-08 13:25:34Z maoge $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xiangmu_Xiangmuexp extends Mdl_Table
{   

    protected $_table = 'xiangmu_exp';
    protected $_pk = 'exp_id';
    protected $_orderby = array('exp_id'=>'DESC');

}