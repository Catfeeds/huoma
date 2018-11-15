<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: brand.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Shop_Brand extends Mdl_Table
{   
  
    protected $_table = 'shop_brand';
    protected $_pk = 'brand_id';
    protected $_cols = 'brand_id,title,logo,url,desc,orderby,audit,closed,dateline';
    protected $_orderby = array('orderby'=>'ASC', 'brand_id'=>'DESC');

    protected $_pre_cache_key = 'shop_brand_list';
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        if($brand_id = $this->db->insert($this->_table, $data, true)){
            $this->flush();
        }
        return $brand_id;
    }

    public function update($brand_id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data,  $brand_id)){
            return false;
        }
        if($rs = $this->db->update($this->_table, $data, $this->field($this->_pk, $brand_id))){
            $this->flush();
        }
        return $rs;
    }

    public function brand($brand_id)
    {
        if($$brand_id = (int)$brand_id){
            if($items = $this->fetch_all()){
                return $items[$brand_id];
            }
        }
        return false;
    }

    public function options()
    {
        $options = array();
        if($items = $this->fetch_all()){
            foreach($items as $k=>$v){
                $options[$k] = $v['title'];
            }
        }
        return $options;        
    }

}