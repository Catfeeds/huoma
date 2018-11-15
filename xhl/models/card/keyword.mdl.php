<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: member.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Card_Keyword extends Mdl_Table
{

    protected $_table = 'ims_account_wxapp_keyword';
    protected $_pk = 'id';


    public function create($data, $checked=false)
    {

        $fanid = $this->db->insert($this->_table, $data, true);

        return $fanid;
    }
    public function update($fanid, $data, $checked=false)
    {
        if(!$case = $this->detail($fanid)){
            return false;
        }
        if($ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $fanid))){

        }
        return $ret;
    }

    public function items($filter = array(), $orderby = NULL, $p = 1, $l = 50, & $count = 0)
    {
        $where = $this -> where($filter);
        $orderby = $this -> order($orderby);
        $limit = $this -> limit($p, $l);
        $items = array();

        if ($count = $this -> count($where)){
            $sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE $where $orderby $limit";
//			 echo $sql;
//			exit;
            if ($rs = $this -> db -> Execute($sql)){
                while ($row = $rs -> fetch()){
                    $row = $this -> _format_row($row);

                    $items[] = $row;

                }
            }
        }

        return $items;
    }

}