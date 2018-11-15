<?php
/**
 * Copy Right Abc576.com
 * Each engineer has a duty to keep the code elegant
 * $Id: ask.mdl.php 5649 2014-06-25 11:13:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Codelog extends Mdl_Table
{
  
    protected $_table = 'codelog';
    protected $_pk = 'id';
    protected $_orderby = array('id'=>'desc');

    public function add($data){
        $this->db->insert($this->_table, $data, true);
        return true;
    }
}