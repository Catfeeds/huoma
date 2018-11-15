<?php

/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: fans.mdl.php 2016-09-27 02:07:36  xinghuali
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Mdl_Member_Fans extends Mdl_Table
{

    protected $_table = 'member_fans';
    protected $_pk = 'fans_id';
    protected $_cols = 'fans_id,myid,uid,dateline';

    public function create($data, $checked = false)
    {
        if (!$checked && !$data = $this->_check_schema($data)) {
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked = false)
    {
        $this->_checkpk();
        if (!$checked && !$data = $this->_check_schema($data, $pk)) {
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }
    
    public function check_by_myid($myid,$uid){
        $myid = (int)$myid;
        $uid  = (int)$uid;
        return $this->count(" myid='{$myid}' and uid='{$uid}' ");
    }
    
    
}
