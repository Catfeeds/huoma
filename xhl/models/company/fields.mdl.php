<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: fields.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Company_Fields extends Mdl_Table
{   
  
    protected $_table = 'company_fields';
    protected $_pk = 'company_id';
    protected $_cols = 'company_id,info,skin,seo_title,seo_keywords,seo_description';

    
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
        if($result = $this->detail($pk)){
             return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
        }
        $data[$this->_pk] = $pk;
        return $this->create($data);
    }
    
   
}