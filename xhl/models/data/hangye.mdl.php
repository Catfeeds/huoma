<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: province.mdl.php 2016-09-27 02:07:36  xinghuali
 */

class Mdl_Data_Hangye extends Mdl_Table
{   
  
    protected $_table = 'data_hangye';
    protected $_pk = 'hangye_id';
    protected $_cols = 'hangye_id,hangye,keywords,num';
    protected $_orderby = array('num'=>'DESC');
    protected $_pre_cache_key = 'data-hangye-list';
    
    public function create($data)
    {
        if(!$data = $this->_check_schema($data)){
            return false;
        }
        if($city_id = $this->db->insert($this->_table, $data, true)){
            $this->flush();
        }
        return $city_id;
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        if($this->db->update($this->_table, $data, $this->field($this->_pk, $pk))){
            $this->flush();
        }
        return true;
    }

    public function hangye()
    {
        $items = $this->fetch_all();
		foreach($items as $val){
			$rtems[] = $val['hangye'];
		}
        return $rtems;
    }

}