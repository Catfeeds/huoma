<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: pic.mdl.php 2727 2015-01-03 10:15:18Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Company_Pic extends Mdl_Table
{   
  
    protected $_table = 'company_pic';
    protected $_pk = 'pic_id';
    protected $_cols = 'pic_id,company_id,type,title,pic';
    
    protected $_type_means = array(1=>'工厂设备',2=>'信誉担保');    
    
    protected $_type = array('qualification'=>1,'honor'=>2);
    
    protected $_orderby = array('pic_id'=>'DESC');
    
    public function get_type_means(){
        
        return $this->_type_means;
    }
    public function get_type(){
        
        return $this->_type;
    }
    
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
}