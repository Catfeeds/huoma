<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: authcode.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Weixin_Authcode extends Mdl_Table
{   
  
    protected $_table = 'weixin_authcode';
    protected $_pk = 'id';
    protected $_cols = 'id,code,uid,type,addon,dateline';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    public function detail_by_code($code)
    {
        if(!$code = (int)$code){
            return false;
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE code='$code'";
        return $this->db->GetRow($sql);
    }

    public function create_code()
    {
        $code = 0;
        $i = 0;
        do {
            $code = rand(1000000, 9999999);
            $codeexists = $this->detail_by_code($code);
            $i++;
        } while($codeexists && $i < 10);
        return $code;       
    }

    public function scanar($weixin, $uid=0, $type='bind', $addon=array(), $expire=1800)
    {

    }

    protected function _format_row($row)
    {
        $row['addon'] = unserialize($row['addon']);
        return $row;
    }

    protected function _check($data, $id=null)
    {
        if(isset($data['addon']) && !is_string($data['addon'])){
            $data['addon'] = serialize($data['addon']);
        }
        return parent::_check($data, $id);
    }
}