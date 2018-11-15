<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: member.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Card_Fans extends Mdl_Table
{

    protected $_table = 'ims_mc_mapping_fans';
    protected $_pk = 'fanid';
	public $_W;

	public function findOpenid($openid='')
	{
		if($openid==''){
			return false;
		}
		$where = "openid = '$openid'";
		return $this->find($where);
	}

	public function findUnionid($unionid='')
	{
		if($unionid==''){
			return false;
		}
		$where = "unionid = '$unionid'";
		return $this->find($where);
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
	//获取卡片信息详情
	function mc_fansinfo($openidOruid, $acid = 0, $uniacid = 0,$_W=''){
		$this->_W = $_W;
		if (empty($openidOruid)) {
			return array();
		}
		if (is_numeric($openidOruid)) {
			$openid = $this->mc_uid2openid($openidOruid);
			if (empty($openid)) {
				return array();
			}
		} else {
			$openid = $openidOruid;
		}

		$condition = "`openid` = '$openid'";

		if (!empty($acid)) {
			$condition .= " AND `acid` = '$acid'";
		}
		if (!empty($uniacid)) {
			$condition .= " AND `uniacid` = '$uniacid'";
		}

		$fan = $this->find($condition);

		if (!empty($fan)) {
			if (!empty($fan['tag']) && is_string($fan['tag'])) {
				if (is_base64($fan['tag'])) {
					$fan['tag'] = @base64_decode($fan['tag']);
				}
				if (is_serialized($fan['tag'])) {
					$fan['tag'] = @iunserializer($fan['tag']);
				}
				if (is_array($fan['tag']) && !empty($fan['tag']['headimgurl'])) {
					$fan['tag']['avatar'] = tomedia($fan['tag']['headimgurl']);
					unset($fan['tag']['headimgurl']);
					if (empty($fan['nickname']) && !empty($fan['tag']['nickname'])) {
						$fan['nickname'] = strip_emoji($fan['tag']['nickname']);
					}
					$fan['gender'] = $fan['sex'] = $fan['tag']['sex'];
					$fan['avatar'] = $fan['headimgurl'] = $fan['tag']['avatar'];
				}
			} else {
				$fan['tag'] = array();
			}
		}
		if (empty($fan) && $openid == $_W['openid'] && !empty($_SESSION['userinfo'])) {
			$fan['tag'] = unserialize(base64_decode($_SESSION['userinfo']));
			$fan['uid'] = 0;
			$fan['openid'] = $fan['tag']['openid'];
			$fan['follow'] = 0;
			if (empty($fan['nickname']) && !empty($fan['tag']['nickname'])) {
				$fan['nickname'] = strip_emoji($fan['tag']['nickname']);
			}
			$fan['gender'] = $fan['sex'] = $fan['tag']['sex'];
			$fan['avatar'] = $fan['headimgurl'] = $fan['tag']['headimgurl'];
			$mc_oauth_fan = $this->mc_oauth_fans($fan['openid']);
			if (!empty($mc_oauth_fan)) {
				$fan['uid'] = $mc_oauth_fan['uid'];
			}
		}
		return $fan;
	}

	function mc_oauth_fans($openid, $acid = 0){
		$condition = array();
		$condition['oauth_openid'] = $openid;
		$condition = "oauth_openid='".$openid."'";
		if (!empty($acid)) {
			$condition['acid'] = $acid;
			$condition .= " and acid='".$acid."'";
		}

		$fan = $this->findTbale('ims_mc_oauth_fans',$condition);
		return $fan;
	}


	function mc_uid2openid($uid) {
		if (is_numeric($uid)) {

			$where = "uniacid=".$this->mc_current_real_uniacid()." and  uid= $uid";
			$fans_info = $this->find($where);
			return !empty($fans_info['openid']) ? $fans_info['openid'] : false;
		}
		if (is_string($uid)) {
			$openid = trim($uid);
			$where = "openid='".$openid."'";
			$openid_exist = $this->find($where);
			if (!empty($openid_exist)) {
				return $openid;
			} else {
				return false;
			}
		}
		if (is_array($uid)) {
			$openids = array();
			foreach ($uid as $key => $value) {
				if (is_string($value)) {
					$openids[] = $value;
				} elseif (is_numeric($value)) {
					$uids[] = $value;
				}
			}
			if (!empty($uids)) {

				$where = "uniacid=".$this->mc_current_real_uniacid()." and `uid` IN (".implode(",", $uids) .")";
				$fans_info = $this->items($where);
				$fans_info = array_keys($fans_info);
				$openids = array_merge($openids, $fans_info);
			}
			return $openids;
		}
		return false;
	}

	function mc_current_real_uniacid() {
		if (!empty($this->_W['account']['link_uniacid']) || (!empty($this->_W['account']) && $this->_W['uniacid'] != $this->_W['account']['uniacid'])) {
			return $this->_W['account']['uniacid'];
		} else {
			return $this->_W['uniacid'];
		}
	}

	public function findTbale($table,$where = 1)
	{
//		echo "SELECT count(1) FROM " . $this -> table($this -> _table) . " WHERE $where";
//		exit;
		$sql = "SELECT * FROM " . $this -> table($table) . " WHERE $where";
		if ($detail = $this -> db -> GetRow($sql)){
			$detail = $this -> _format_row($detail);
		}

		return $detail;
	}

 
}