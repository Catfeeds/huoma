<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: attr.mdl.php 2015-09-27 02:07:36  xinghuali
 */

class Mdl_Case_Attr extends Mdl_Table
{   
  
    protected $_table = 'case_attr';
    protected $_pk = 'case_id,attr_id,attr_value_id';
    protected $_cols = 'case_id,attr_id,attr_value_id';
   
    public function update($case_id, $data, $checked=false)
    {
        if(!$checked && !$case_id = intval($case_id)){
            return false;
        }
        $sql = array();
        foreach((array)$data as $k=>$v){
            if(is_numeric($k)){
                foreach((array)$v as $kk=>$vv){
                    if(is_numeric($vv)){
                        $sql[] = "('{$case_id}', '{$k}', '{$vv}')";
                    }
                }
            }
        }
        //print_r($sql);
        $this->db->Execute("DELETE FROM ".$this->table($this->_table)." WHERE case_id='$case_id'");
        if($sql){
            $sql = "INSERT INTO ".$this->table($this->_table)." VALUES".implode(',', $sql);
            $this->db->Execute($sql);
        }
    }

    public function attrs_by_case($case_id)
    {
        if(!$case_id = intval($case_id)){
            return false;
        }
        $attrs = array();
		$attr_values = K::M('data/attr')->attrs_by_from('zx:case');
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE case_id='$case_id'";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $attrs[$row['attr_id']]['title'] = $attr_values[$row['attr_id']]['title'];
                $attrs[$row['attr_id']]['val'] = $attr_values[$row['attr_id']]['values'][$row['attr_value_id']]['title'];
            }
        }
        return $attrs;
    } 
}