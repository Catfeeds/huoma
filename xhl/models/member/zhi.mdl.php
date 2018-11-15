<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: zhi.mdl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Member_Zhi extends Mdl_Table
{   
  
    protected $_table = 'member_zhi';
    protected $_pk = 'zhi_id';
    protected $_cols = 'zhi_id,uid,rmb,alipay,realname,mobile,status,adminid,admintime,adminip,clientip,dateline,shui,shouxu,intor,shifu';
    protected $_orderby = array('zhi_id'=>'DESC');
    
    public function create($data)
    {
        if(!$data = $this->_check_schema($data)){
            return false;
        }
        $data['clientip'] = $data['clientip'] ? $data['clientip'] : __IP;
        $data['dateline'] = $data['dateline'] ? $data['dateline'] : __CFG::TIME;
        return $this->db->insert($this->_table, $data, true);
    }
	    public function zhicount($uid)
    {
		if(!$uid = (int)$uid){
            return false;
        }
        $sql = "SELECT count(1) as num FROM ".$this->table($this->_table)." WHERE uid='{$uid}' AND status=0";
        return $this->db->GetOne($sql);
    }
	    public function zhilist($uid)
    {
		if(!$uid = (int)$uid){
            return false;
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE uid='{$uid}'";
        return $this->db->GetAll($sql);
    }

/*    public function zhi($uid, $staus)
    {
        $a = array();
        if(!$uid = (int)$uid){
            return false;
        }
        $a = array('uid'=>$uid, 'from'=>$from, 'number'=>$num, 'zhi'=>$zhi);
        if(defined('IN_ADMIN')){
            $admin = K::$system->admin->admin;
            $a['admin'] = "{$admin['admin_id']}:{$admin['admin_name']}";
        }
        $a['clientip'] = __IP;
        $a['dateline'] = __CFG::TIME;
        return $this->db->insert($this->_table, $a, true);
    }*/

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }    
}