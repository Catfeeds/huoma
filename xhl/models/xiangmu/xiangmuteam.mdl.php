<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: xiangmu.mdl.php 9581 2015-04-08 13:25:34Z maoge $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xiangmu_Xiangmuteam extends Mdl_Table
{   

    protected $_table = 'xiangmu_team';
    protected $_pk = 'team_id';
    protected $_orderby = array('team_id'=>'DESC');

    public function create($data)
    {
        $data['team_dateline'] = __CFG::TIME;
        $xiangmu_id = $this->db->insert($this->_table, $data, true);
        return $xiangmu_id;
    }

    public function team_list($filter = array(), $orderby = NULL, $p = 1, $l = 50, & $count = 0)
    {
        $where = $this -> where($filter);
        $orderby = $this -> order($orderby);
        $limit = $this -> limit($p, $l);
        $items = array();
        $count = $this -> count($where);
        $sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE ".$where." ". $orderby." ".$limit;
        if ($rs = $this -> db -> Execute($sql)){
            while ($row = $rs -> fetch()){
                $row = $this -> _format_row($row);
                if ($this -> _pk){
                    $items[$row[$this -> _pk]] = $row;
                }else{
                    $items[] = $row;
                }
            }
        }
        return $items;
    }

}