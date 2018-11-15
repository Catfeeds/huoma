<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: photo.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Case_Anliyuan extends Mdl_Table
{   
  
    protected $_table = 'case_anliyuan';
    protected $_pk = 'id';
    protected $_cols = 'id,title,hangye,kaikou,mianji,fengge,url,img,closed';
    protected $_orderby = array('id'=>'ASC');
 

    public function delete($pids, $force=false)
    {
        $ret = false;
        if(empty($pids)){
            return false;
        }else if(!$items = $this->items_by_ids($pids)){
            return false;
        }
        $albums = $shops = $photo_ids = array();
        foreach($items as $item){
   			@unlink('czfiles/'.$item['photo'].'_small.jpg');
   			@unlink('czfiles/'.$item['photo'].'_expo.jpg');
 			@unlink('czfiles/'.$item['photo']);
           $albums[$item['case_id']]['num'] += 1;
            $albums[$item['case_id']]['size'] += $item['size'];
            $photo_ids[] = $item['photo_id'];
        }
        if(!empty($photo_ids)){
            if($force){
                $sql = "DELETE FROM ".$this->table($this->_table)." WHERE " . self::field($this->_pk, $photo_ids);
                $ret = $this->db->Execute($sql);
            }else{
                $ret = $this->db->update($this->_table, array('closed'=>1), self::field($this->_pk, $photo_ids));
            }
            if($ret){
                foreach($albums as $k=>$v){
                    K::M('case/case')->update_last($k, -$v['size'], -$v['num']);
                }
            }
        }
        return $ret;      
    }

}