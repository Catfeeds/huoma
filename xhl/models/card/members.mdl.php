<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: member.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Card_Members extends Mdl_Table
{

    protected $_table = 'ims_mc_members';
    protected $_pk = 'uid';

    function _mc_login($member,$_W) {
		if (!empty($member) && !empty($member['uid'])) {	
			// $member = pdo_get('mc_members', array('uid' => $member['uid'], 'uniacid' => $_W['uniacid']), array('uid', 'realname', 'mobile', 'email', 'groupid', 'credit1', 'credit2', 'credit6'));
			$member = $this->find( array('uid' => $member['uid'], 'uniacid' => $_W['uniacid']));
			if (!empty($member) && (!empty($member['mobile']) || !empty($member['email']))) {
				$_W['member'] = $member;
				$_W['member']['groupname'] = $_W['uniaccount']['groups'][$member['groupid']]['title'];
				$_SESSION['uid'] = $member['uid'];
		
				if (empty($_W['openid'])) {
					$fan = K::M('card/fans')->find('uid='.$member['uid']);
					if (!empty($fan)) {
						$_SESSION['openid'] = $fan['openid'];
						$_W['openid'] = $fan['openid'];
						$_W['fans'] = $fan;
						$_W['fans']['from_user'] = $_W['openid'];
					} else {
						$_W['openid'] = $member['uid'];
						$_W['fans'] = array(
							'from_user' => $member['uid'],
							'follow' => 0
						);
					}
				}
				setcookie('logout', '', -60000);
				return true;
			}
		}
		return false;
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
 
}