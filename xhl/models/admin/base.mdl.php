	<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: base.mdl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Admin_Base extends Mdl_Table
{
    protected $_table = 'admin';
    protected $_pk = 'admin_id';
    protected $_cls = 'admin_id,admin_name,passwd,role_id,last_login,closed,dateline';
	protected $_orderby = array('admin_id'=>'ASC');
	protected $_pre_cache_key = 'admin-admin-list';
	
    public function items_by_ids($ids,$role_id=8)
    {
        if(!$ids = K::M('verify/check')->ids($ids)){
            return false;
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE admin_id IN($ids) AND closed=0 and role_id={$role_id} order by admin_id ASC";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['admin_id']] = $this->_format_row($row);
            }
        }
        return $items;
    }

    public function adminitems(){
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE closed=0 AND role_id=8 order by admin_id ASC";
        return $this->db->GetAll($sql);
    }

}