<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: flush.mdl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Member_Flush extends Mdl_Table
{   
  
    protected $_table = 'member_flush';
    protected $_pk = 'flush_id';
    protected $_cols = 'flush_id,uid,gold,from,itemId,clientip,dateline';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

	public function flushs($uid)
	{
		$day_start = mktime(0,0,0,date("m"),date("d"),date("Y"));
		$day_end= mktime(23,59,59,date("m"),date("d"),date("Y"));
		$filter['uid'] = $uid;
		$filter['dateline'] = ">:".$day_start;
		$filter['dateline'] = "<:".$day_end;
		
		$sql = "select COUNT(1) c from ".$this->table($this->_table)." where uid = ".$uid." and dateline <=".$day_end." and dateline >=".$day_start."";
		if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $counts = $row['c'];
            }        
        }
        return $counts;
	}
}