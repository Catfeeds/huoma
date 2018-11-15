<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: member.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
	exit("Access Denied");
}

class Mdl_Card_Card extends Mdl_Table
{
	protected $_table = 'ims_amouse_wxapp_card';
	protected $_pk = 'id';

	public function upload($attach,$url='',$path='')
	{
		$ym = date('Ym', __CFG::TIME);
		$cfg = K::$system->config->get('attach');
		$path = $path?$path:'card';
        $path = $path.DIRECTORY_SEPARATOR.$ym.DIRECTORY_SEPARATOR;
		//$dir = $cfg['attachdir'].$path.DIRECTORY_SEPARATOR.$ym.DIRECTORY_SEPARATOR;
        $dir = dirname(dirname(__APP_DIR)).DIRECTORY_SEPARATOR.'card'.DIRECTORY_SEPARATOR.$path;
		$ext = $attach['extension'] = strtolower(K::M('io/file')->extension($attach['name']));
		$fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
		if($attach['html5']){
			if(strlen($attach['data'])>2097152){

				return array('code'=>0,'data'=>'','msg'=>'上传的文件不能超过2M');
			}
			$ext = $attach['extension'] = strtolower(K::M('io/file')->extension($attach['name']));
			$fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
			$file = $dir.$fname;

			file_put_contents($file, $attach['data']);

		}else if(!$file = K::M('helper/upload')->upload($attach, $dir, $fname)){
			return array('code'=>0,'data'=>'','msg'=>'上传失败');

		}
        $filename = $path.$fname;
		return array('code'=>1,'data'=>$filename,'msg'=>'上传失败');
	}

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

	public function items($filter = array(), $orderby = NULL, $p = 1, $l = 50, & $count = 0)
	{
		$where = $this -> where($filter);
		$orderby = $this -> order($orderby);
		$limit = $this -> limit($p, $l);
		$items = array();

		if ($count = $this -> count($where)){
			$sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE $where $orderby $limit";
//			 echo $sql;
//			exit;
			if ($rs = $this -> db -> Execute($sql)){
				while ($row = $rs -> fetch()){
					$row = $this -> _format_row($row);

					$items[] = $row;

				}
			}
		}

		return $items;
	}

	public function querySql($sql)
	{
		if(!$sql)
		{
			return false;
		}

		if ($rs = $this -> db -> Execute($sql)){
			while ($row = $rs -> fetch()){
				$row = $this -> _format_row($row);

					$items[] = $row;

			}
		}

		return $items;
	}

	public function update_down($ids, $from = "views", $num = 1)
	{

		$this -> _checkpk();

		if ($ids = K :: M("verify/check") -> ids($ids)){


				$sql = "UPDATE " . $this -> table($this -> _table) . " SET `$from`= IFNULL(`$from`,0)-$num WHERE " . self :: field($this -> _pk, $ids);

				return $this -> db -> Execute($sql);

		}
		return false;
	}

	public function update_count($ids, $from = "views", $num = 1)
	{

		$this -> _checkpk();

		if ($ids = K :: M("verify/check") -> ids($ids)){



				$sql = "UPDATE " . $this -> table($this -> _table) . " SET `$from`= IFNULL(`$from`,0)+$num WHERE " . self :: field($this -> _pk, $ids);

				return $this -> db -> Execute($sql);

		}
		return false;
	}



}