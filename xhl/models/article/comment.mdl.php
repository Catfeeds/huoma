<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: comment.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Article_Comment extends Mdl_Table
{   
  
    protected $_table = 'article_comment';
    protected $_pk = 'comment_id';
    protected $_cols = 'comment_id,article_id,uid,content,closed,clientip,dateline';
    protected $_orderby = array('comment_id'=>'ASC');

    
    public function create($data)
    {
        if(!$data = $this->_check_schema($data)){
            return false;
        }
        $data['content'] = htmlspecialchars_decode($data['content']);
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !($data = $this->_check_schema($data,  $pk))){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    } 

      public function detail($article_id)
    {
        $sql = "SELECT * FROM ".$this->table($this->_table)."  where closed = 0 and article_id = ".$article_id." ORDER BY comment_id desc";
           if($rs = $this->db->Execute($sql)){
                while($row = $rs->fetch()){
                  $items[$row[$this->_pk]] = $row;
                }
            }
        return $items;  
    } 


}