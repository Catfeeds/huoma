<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: yuyue.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Designer_Yuyue extends Mdl_Table
{   
  
    protected $_table = 'designer_yuyue';
    protected $_pk = 'yuyue_id';
    protected $_cols = 'yuyue_id,city_id,uid,designer_id,company_id,mobile,contact,content,status,remark,dateline,clientip';

    protected $_orderby = array('yuyue_id'=>'DESC');
    public function create($data, $checked=false)
    {
		$data['dateline'] = __TIME;
		$data['clientip'] = __IP;
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

    public function yuyue_count($val)
    {
        $count = 0;
        $sql = "SELECT designer_id, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('designer_id', $val)." GROUP BY designer_id";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                K::M('designer/designer')->update($row['designer_id'], array('yuyue_num'=>$row['c']), true);
                $count ++;
            }
        }
        return $count;
    }    

    protected function _format_row($row)
    {
        if($city_id = $row['city_id']){
            if($city = K::M('data/city')->city($city_id)){
                $row['city_name'] = $city['city_name'];
            }
        }
        $row['status_title'] = K::M('misc/data')->yuyue($row['status']);
        return $row;        
    }     
}