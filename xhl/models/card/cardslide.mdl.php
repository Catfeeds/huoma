<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: member.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
	exit("Access Denied");
}

class Mdl_Card_Cardslide extends Mdl_Table
{
	protected $_table = 'ims_amouse_wxapp_card_slide';
	protected $_pk = 'id';
	public function create($data, $checked=false)
	{

		$fanid = $this->db->insert($this->_table, $data, true);

		return $fanid;
	}

	public function update($fanid, $data, $checked=false)
	{
		if(!$case = $this->detail($fanid)){
			return false;
		}
		if($ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $fanid))){

		}
		return $ret;
	}

}