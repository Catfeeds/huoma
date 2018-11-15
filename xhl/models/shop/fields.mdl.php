<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: fields.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Shop_Fields extends Mdl_Table
{   
  
    protected $_table = 'shop_fields';
    protected $_pk = 'shop_id';
    protected $_cols = 'shop_id,banner,fox,mail,qq,hours,addr,jiaotong,bulletin,info,psaz,dgxz,skin,seo_title,seo_keywords,seo_description';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($shop_id, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $shop_id)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $shop_id));
    }
}