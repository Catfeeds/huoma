<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: item.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Block_Item extends Mdl_Table
{   
  
    protected $_table = 'block_item';
    protected $_pk = 'item_id';
    protected $_cols = 'item_id,block_id,itemId,title,link,thumb,city_id,data,expire_time,orderby,dateline';
    protected $_orderby = array('orderby'=>'ASC', 'item_id'=>'DESC');

    public function items_by_block($block_id, $city_id,$page=1, $limit=50, &$count=0)
    {
		$data['block_id']=$block_id;
		if($city_id){
			$data['city_id']=$city_id;
		}
        return $this->items($data, $this->_orderby, $page, $limit, $count);
    }

    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data)){
            return false;
        }
        $data['dateline'] = __CFG::TIME;
        return $this->db->insert($this->_table, $data, true, true);
    }

    public function update($pk, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }
    
    public function delete_bk($val, $force=false)
    {
        if($items = $this->items_by_ids($val)){
            $block_ids = array();
            foreach($items as $item){
                $block_ids[$item['block_id']] = $item['block_id'];
            }
            parent::delete($val, $force);
            foreach($block_ids as $id){
                $this->flush($id);
            }
        }
        return true;
    }

    public function delete_block_item($block_id, $itemIds)
    {
        if(!$block_id = (int)$block_id){
            return false;
        }else if(!$ids = K::M('verify/check')->ids($itemIds)){
            return false;
        }
        $sql = "DELETE FROM ".$this->table($this->_table)." WHERE block_id=$block_id AND itemId IN($ids)";
        return $this->db->Execute($sql);           
    }

    protected function _format_row($row)
    {
        if($row['data']){
            $row['data'] = unserialize(stripslashes($row['data']));
        }
        if($city = K::M('data/city')->city($row['city_id'])){
            $row['city_name'] = $city['city_name'];
        }
        return $row;
    }

    public function flush_bk($block_id=null)
    {
        if(!$block_id){
            return false;
        }
        return $this->cache->delete($this->_pre_cache_key."-{$block_id}");        
    }

    public function update_expire()
    {
        $time = __CFG::TIME-8600;
        $sql = "DELETE FROM ".$this->table($this->_table)." WHERE expire_time>0 AND expire_time<$time";
        return $this->db->Execute($sql);
    }

    protected function _check($data, $item_id=null)
    {
        if(!$item_id || isset($data['title'])){
            if(empty($data['title'])){
                $this->err->add('标题不能为空', 451);
                return false;
            }
        }
        if(!$item_id || isset($data['block_id'])){
            if(!$data['block_id'] = intval($data['block_id'])){
                $this->err->add(' 未指定要保存到的推荐位', 452);
                return false;
            }
        }
        if(isset($data['city_id'])){
            $data['city_id'] = (int)$data['city_id'];
        }
        if(isset($data['data'])){
            $data['data'] = addslashes(serialize($data['data']));
        }
        if(isset($data['expire_time'])){
            if(empty($data['expire_time'])){
                $data['expire_time'] = 0;                
            }else{
                $data['expire_time'] = strtotime($data['expire_time']);
            }
        }
        if(isset($data['orderby'])){
            $data['orderby'] = (int)$data['orderby'];
        }
        return parent::_check($data);       
    }      


    public function tuijian_all()
    {

        
         $sql = "SELECT * FROM ".$this->table($this->_table)." where block_id = 2 order by item_id desc,orderby desc ";
           if($rs = $this->db->Execute($sql)){
                while($row = $rs->fetch()){
                  $items[$row[$this->_pk]] = $row;
                }
            }  

            foreach ($items as $k => $v) {
<<<<<<< HEAD
                $sql1 = "SELECT * FROM  xhl_article where article_id = ".$v['itemId'];
                $str = $this->db->Execute($sql1);
                while($row = $str->fetch()){
                      $itemss = $row;
                      $content = $itemss['desc'];
                    // return $itemss;
                      $items[$k]['desc'] = $content;
                      $items[$k]['views'] = $itemss['views'];
                }

            }

            foreach ($items as $kk => $vv) {
            $sql2 = "SELECT count(*) FROM  xhl_article_collect where article_id = ".$vv['itemId'];
            $str = $this->db->Execute($sql2);
            while($row = $str->fetch()){
                  $collect = $row;
            }
             $items[$kk]['collect'] = $collect['count(*)'];
            
            }

             foreach ($items as $kkk => $vvv) {
            $sql2 = "SELECT count(*) FROM  xhl_article_comment where article_id = ".$vvv['itemId'];
            $str = $this->db->Execute($sql2);
            while($row = $str->fetch()){
                  $collect = $row;
            }
             $items[$kkk]['comment'] = $collect['count(*)'];
            
            }

=======
                 $sql1 = "SELECT * FROM  xhl_article where article_id = ".$v['itemId'];
                 $str = $this->db->Execute($sql1);
                   while($row = $str->fetch()){
                  $itemss = $row;
                  $content = $itemss['desc'];
                // return $itemss;
                  $items[$k]['desc'] = $content;
                  
                }
                 
            }
>>>>>>> d2a31ff35db971065813ae1c59dd238b6ff6aa58
        return  $items;
    }

    public function huandeng_all()
    {

        
         $sql = "SELECT * FROM ".$this->table($this->_table)." where block_id = 1 order by item_id desc,orderby desc ";
           if($rs = $this->db->Execute($sql)){
                while($row = $rs->fetch()){
                  $items[$row[$this->_pk]] = $row;
                }
            }  

            foreach ($items as $k => $v) {
                 $sql1 = "SELECT * FROM  xhl_article where article_id = ".$v['itemId'];
                 $str = $this->db->Execute($sql1);
                   while($row = $str->fetch()){
                  $itemss = $row;
                  $content = $itemss['desc'];
                // return $itemss;
                  $items[$k]['desc'] = $content;
                  
                }
                 
            }
             
        return  $items;
    }





}