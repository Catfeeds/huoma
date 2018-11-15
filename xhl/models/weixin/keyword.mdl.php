<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: keyword.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Weixin_Keyword extends Mdl_Table
{   
  
    protected $_table = 'weixin_keyword';
    protected $_pk = 'kw_id';
    protected $_cols = 'kw_id,wx_id,keyword,len,reply_id,content,hits,dateline';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    public function detail_by_keyword($kw, $wx_id)
    {
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE wx_id='$wx_id' AND keyword='$kw'";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

    protected function _check($data, $kw_id=null)
    {
        if(isset($data['keyword'])){
            $data['len'] = strlen($data['keyword']);
        }
        return parent::_check($data, $kw_id);
    }
}