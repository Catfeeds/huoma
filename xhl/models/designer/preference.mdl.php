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

class Mdl_Designer_preference extends Mdl_Table
{   

    protected $_table = 'designer_preference';
    protected $_pk = 'id';
    protected $_cols = 'id,uid,industry,skill,edu,job,edit_time';
    
    public function create($data)
    {
        if(!$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function detail($uid)
    {
        if(!$uid = (int)$uid){
            return false;
        }
        $where = " WHERE uid='$uid'";
        $sql = "SELECT * FROM ".$this->table($this->_table).$where;
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

    public function items($filter = array(), $orderby = NULL, $p = 1, $l = 50, & $count = 0)
    {
         $where = $this -> where($filter);
         $orderby = $this -> order($orderby);
         $limit = $this -> limit($p, $l);
         $items = array();
        
         if ($count = $this -> count($where)){
             $sql = "SELECT a.*,c.*,b.*,d.*,e.*,f.*
                    FROM ".$this->table($this->_table)." a 
                    LEFT JOIN ".$this->table('designer')." c ON a.uid=c.uid
                    LEFT JOIN ".$this->table('member')." b ON a.uid=b.uid
                    LEFT JOIN ".$this->table('xiangmu')." d ON a.xiangmu_id=d.xiangmu_id
                    LEFT JOIN ".$this->table('member_group')." e ON e.group_id=b.group_id
                    LEFT JOIN ".$this->table('data_city')." f ON f.city_id=c.city_id
                    WHERE a.$where ORDER BY a.id DESC";
          // echo $sql;die;
             if ($rs = $this -> db -> Execute($sql)){
                 while ($row = $rs -> fetch()){
                     $row = $this -> _format_row($row);
                    
                     if ($this -> _pk){
                         $items[$row[$this -> _pk]] = $row;
                         }
                    else{
                         $items[] = $row;
                         }
                     }
                 }
             }
        
         return $items;
    }

    public function shejidetail()
    {
        $sql = "SELECT uid FROM ".$this->table($this->_table);
        //echo $sql;die;
        return $this->db->GetAll($sql);
    }

    public function fans_num($uid){
        $sql = "SELECT COUNT(*) FROM ".$this->table($this->_table)." WHERE xiangmu_id=$uid";
        return $this->db->GetOne($sql);
    }

    public function follow_num($uid){
        $sql = "SELECT COUNT(*) FROM ".$this->table($this->_table)." WHERE uid=$uid";
        return $this->db->GetOne($sql);
    }

    public function update($id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data,  $id)){
            return false;
        }
        $ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $id));
        return $ret;
    }

}