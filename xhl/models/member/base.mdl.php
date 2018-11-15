<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: base.mdl.php 2787 2015-01-06 06:51:52  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_member_Base extends Mdl_Table
{   
    
    protected $_table = 'member';
    protected $_pk = 'uid';
    protected $_cols = 'uid,uname,passwd,from,mail,gender,city_id,mobile,credits,realname,face,face_80,face_32,Y,M,D,verify,uc_uid,cart,regip,closed,lastlogin,lasactive,dateline';
    protected $_orderby = array('uid'=>'DESC');

    CONST VERIFY_MAIL = 1; //邮箱认证
    CONST VERIFY_MOBILE = 2; //手机认证
    CONST VERIFY_NAME = 4;  //实名认证

    protected $_from_list = array('member'=>'参展商', 'designer'=>'设计师', 'company'=>'装修工厂', 'shop'=>'商家');

    public function from_list()
    {
    	return $this->_from_list;
    }
}