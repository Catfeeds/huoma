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

class Mdl_Xiangmu_Comment extends Mdl_Table
{   
  
    protected $_table = 'xiangmu_comment';
    protected $_pk = 'comment_id';
    protected $_cols = 'comment_id,xiangmu_id,uid,content,closed,clientip,dateline,reply,replyip,replytime';
    protected $_orderby = array('comment_id'=>'ASC');

    
    public function create($data)
    {
        if(!$data = $this->_check_schema($data)){
            return false;
        }
        $data['dateline'] = $data['dateline'] ? $data['dateline'] : __CFG::TIME;
        $data['clientip'] = $data['clientip'] ? $data['clientip'] : __IP;
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


    public function items_by_xiangmu($xiangmu_id, $p=1, $l=50, &$count=0)
    {
        if(!$xiangmu_id = (int)$xiangmu_id){
            return false;
        }
        return $this->items(array('xiangmu_id'=>$xiangmu_id, 'closed'=>0), null, $p, $l, $count);
    }

    public function reply($id, $reply)
    {
        if(!$id = (int)$id){
            return false;
        }else if(empty($reply)){
            return false;
        }
        $reply = K::M('content/html')->encode($reply);
        return $this->update($id, array('reply'=>$reply,'replyip'=>__IP,'replytime'=>__TIME), true);
    }
}