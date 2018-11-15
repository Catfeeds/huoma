<?php
/**
 * Copy Right Abc576.com
 * Each engineer has a duty to keep the code elegant
 * $Id: ask.mdl.php 5649 2014-06-25 11:13:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Demand_Demand extends Mdl_Table
{

    protected $_table = 'demand';
    protected $_pk = 'id';
    protected $_orderby = array('id'=>'desc');

    public function add($data){
        $this->db->insert($this->_table, $data, true);
        return true;
    }
    public function update($demandid, $data, $checked=false)
    {
        if(!$demandid = intval($demandid)){
            return false;
        }
        $ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $demandid));
        return $ret;
    }
}