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

class Mdl_Component_Sheji extends Mdl_Table
{   

    protected $_table = 'component_sheji';
    protected $_pk = 'id';
    protected $_cols = 'id,xiangmu_id,uid,dateline';
    
    public function create($data)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function detail($xiangmu_id, $closed=false)
    {
        if(!$xiangmu_id = intval($xiangmu_id)){
            return false;
        }
        $where = "a.xiangmu_id='$xiangmu_id'";
        $sql = "SELECT a.*,c.*,b.*
                    FROM ".$this->table($this->_table)." a 
                    LEFT JOIN ".$this->table('designer')." c ON a.uid=c.uid
                    LEFT JOIN ".$this->table('component')." b ON a.xiangmu_id=b.xiangmu_id
                    $where LIMIT 1";

       // $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('component_content')." c ON a.xiangmu_id=c.xiangmu_id WHERE $where LIMIT 1";
        if($detail = $this->db->GetRow($sql)){
            $cate = K::M('component/cate')->cate($detail['cat_id']);
            $detail['cat_title'] = $cate['title'];
        }
        //分页处理
       // $detail['content_list'] = explode($this->_page_sep, $detail['content']);
       // $detail['content_count'] = count($detail['content_list']);
        return $detail;
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
                    LEFT JOIN ".$this->table('component')." d ON a.xiangmu_id=d.xiangmu_id
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

}