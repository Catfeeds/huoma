<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: home.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */
class Ctl_Auth extends Ctl
{
	public $sessionKey;
	public $appid;

	public function session()
	{

		$do = $this->_GPC['do'];
		$dos = array('openid', 'userinfo', 'touch');
		$do = in_array($do, $dos) ? $do : 'openid';


		if ($do == 'openid') {
			$code = $this->_GPC['code'];

			if (empty($this->_W['account']['oauth']) || empty($code)) {
				exit('通信错误，请在微信中重新发起请求');
			}

			$oauth = $this->getOauthInfo($code);

			if (!empty($oauth) && !$this->is_error($oauth)) {

				$_SESSION['openid'] = $oauth['openid'];
				$_SESSION['session_key'] = $oauth['session_key'];

				$fans = K::M('card/fans')->findOpenid($oauth['openid']);

				if (empty($fans)) {

					$record = array(
						'openid' => $oauth['openid'],
						'uid' => 0,
						'acid' => $this->_W['acid'],
						'uniacid' => $this->_W['uniacid'],
						'salt' => random(8),
						'updatetime' => time(),
						'nickname' => '',
						'follow' => '1',
						'followtime' => time(),
						'unfollowtime' => 0,
						'tag' => '',
					);

					//查询是否有注册过member表
					$email_exists_member = K::M('member/member')->find("openid='".$oauth['openid']."'");

					if (!empty($email_exists_member)) {
						$uid = $email_exists_member['uid'];
					} else {

						$data = array(
							'mail' => md5($oauth['openid']).'@16-expo.com',
							'uname' => 'card_'.time().rand(1000,9999),
							'passwd' => substr($oauth['openid'],0,6),
							'from' => 'unknown',
							'openid'=>$oauth['openid'],
						);

						//插入数据

						$uid= K::M('member/account')->create_xcx($data);


					}
					$record['uid'] = $uid;
					$_SESSION['uid'] = $uid;
					$uid= K::M('card/fans')->create($record);


				}

				$this->result(0, '', array('sessionid' => $this->_W['session_id']));
			} else {

				$this->result(1, $oauth['message']);
			}
		} elseif ($do == 'userinfo') {

			$encrypt_data = $this->_GPC['encryptedData'];
			$iv = $this->_GPC['iv'];

			if (empty($_SESSION['session_key']) || empty($encrypt_data) || empty($iv)) {
				$this->result(1, '请先登录');
			}
			$this->sessionKey=$_SESSION['session_key'];


			$sign = sha1(htmlspecialchars_decode($this->_GPC['rawData']).$_SESSION['session_key']);
			if ($sign !== $this->_GPC['signature']) {
				$this->result(1, '签名错误');
			}

//			$userinfo = $this->pkcs7Encode($encrypt_data, $iv);
			$userinfo = $this-> crypt($encrypt_data,$iv);
			$fans = K::M('card/fans')->findOpenid($userinfo['openId']);

			$fans_update = array(
				'nickname' => $userinfo['nickName'],
				'unionid' => $userinfo['unionId'],
				'tag' => base64_encode(serialize(array(
					'subscribe' => 1,
					'openid' => $userinfo['openId'],
					'nickname' => $userinfo['nickName'],
					'sex' => $userinfo['gender'],
					'language' => $userinfo['language'],
					'city' => $userinfo['city'],
					'province' => $userinfo['province'],
					'country' => $userinfo['country'],
					'headimgurl' => $userinfo['avatarUrl'],
				))),
			);

			if (!empty($userinfo['unionId'])) {

				//查询用户表中是否有数据
				if($result = K::M('member/member')->find("unionid='".$userinfo['unionId']."'")){
					//如果有存在 删除之前创建的用户 关联member表
					if($fans['uid'] !=$result['uid']){
						K::M('member/member')->delete($fans['uid']);
					}
					$fans_update['uid'] = $fans['uid'] = $result['uid'];

				} else {
					//更新用户的unionid
					K::M('member/member')->update($fans['uid'],['unionid'=>$userinfo['unionId']]);
				}
//				$union_fans = K::M('card/fans')->find("unionid='".$userinfo['unionId']."' and openid !='".$userinfo['openId']."'");
//				if (!empty($union_fans['uid'])) {
//					if (!empty($fans['uid'])) {
//						//查询如果有unionid的member的话
//
////						pdo_delete('mc_members', array('uid' => $fans['uid']));
//						//删除用户的id
//						K::M('member/member')->delete($fans['uid']);
//
//					}
//
//				}
				$_SESSION['uid'] = $fans_update['uid'] = $fans['uid'];
			}
//			pdo_update('mc_mapping_fans', $fans_update, array('fanid' => $fans['fanid']));

			K::M('card/fans')->update($fans['fanid'],$fans_update);

			$member = K::M('member/member')->detail($fans['uid']);

			unset($member['password']);
			unset($member['salt']);
			$this->result(0, '', $member);
		}


	}

	public function crypt($encrypt_data,$iv)
	{
		include_once __APP_DIR."lib/crypt/wxBizDataCrypt.php";
		$data = '';
		$pc = new WXBizDataCrypt($this->_W['account']['key'], $this->sessionKey);
		$errCode = $pc->decryptData($encrypt_data, $iv, $data);
		if($errCode==0){
			return json_decode($data, true);
		} else {
			return $this->error(1, '解密失败');
		}

	}

	public function pkcs7Encode($encrypt_data, $iv) {
		$key = base64_decode($_SESSION['session_key']);
		$result = $this->aes_pkcs7_decode($encrypt_data, $key, $iv);

		if ($this->is_error($result)) {
			return $this->error(1, '解密失败');
		}
		$result = json_decode($result, true);
		if (empty($result)) {
			return $this->error(1, '解密失败');
		}
		if ($result['watermark']['appid'] != $this->_W['account']['key']) {
			return $this->error(1, '解密失败');
		}
		unset($result['watermark']);
		return $result;
	}

	function aes_pkcs7_decode($encrypt_data, $key, $iv = false) {

		include_once __APP_DIR."lib/pkcs7/pkcs7Encoder.php";
		$encrypt_data = base64_decode($encrypt_data);
		if (!empty($iv)) {
			$iv = base64_decode($iv);
		}

		$pc = new Prpcrypt($key);

		$result = $pc->decrypt($encrypt_data, $iv);
		if ($result[0] != 0) {
			return $this->error($result[0], '解密失败');
		}
		return $result[1];
	}


	public function getOauthInfo($code = '') {
		if (!empty($this->_GPC['code'])) {
			$code = $this->_GPC['code'];
		}

		$url = "https://api.weixin.qq.com/sns/jscode2session?appid={$this->_W['account']['key']}&secret={$this->_W['account']['secret']}&js_code={$code}&grant_type=authorization_code";

		$response = $this->requestApi($url);
//		$response = $this->postCurl($url);
		return $response;
	}

	public function postCurl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURL_SSLVERSION_SSL, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($ch);
		return $response = json_decode($data);
	}




	public function checkSign() {
		$token = $this->account['token'];
		$signkey = array($token, $_GET['timestamp'], $_GET['nonce']);
		sort($signkey, SORT_STRING);
		$signString = implode($signkey);
		$signString = sha1($signString);
		return $signString == $_GET['signature'];
	}




	public function getAccessToken() {
		$cachekey = "accesstoken:{$this->account['key']}";
		$cache = cache_load($cachekey);
		if (!empty($cache) && !empty($cache['token']) && $cache['expire'] > TIMESTAMP) {
			$this->account['access_token'] = $cache;
			return $cache['token'];
		}

		if (empty($this->account['key']) || empty($this->account['secret'])) {
			return error('-1', '未填写小程序的 appid 或 appsecret！');
		}

		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->account['key']}&secret={$this->account['secret']}";
		$response = $this->requestApi($url);

		$record = array();
		$record['token'] = $response['access_token'];
		$record['expire'] = TIMESTAMP + $response['expires_in'] - 200;

		$this->account['access_token'] = $record;
		cache_write($cachekey, $record);
		return $record['token'];
	}

	public function getJssdkConfig($url = ''){
		return array();
	}

	public function getCodeWithPath($path) {

	}

	public function getCodeUnlimit($scene, $width = '430', $option = array()) {
		if (!preg_match('/[0-9a-zA-Z\!\#\$\&\'\(\)\*\+\,\/\:\;\=\?\@\-\.\_\~]{1,32}/', $scene)) {
			return error(1, '场景值不合法');
		}
		$access_token = $this->getAccessToken();
		if(is_error($access_token)){
			return $access_token;
		}
		$data = array(
			'scene' => $scene,
			'width' => intval($width),
		);
		if (!empty($data['auto_color'])) {
			$data['auto_color'] = intval($data['auto_color']);
		}
		if (!empty($option['line_color'])) {
			$data['line_color'] = array(
				'r' => $option['line_color']['r'],
				'g' => $option['line_color']['g'],
				'b' => $option['line_color']['b'],
			);
			$data['auto_color'] = false;
		}
		$url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
		$response = $this->requestApi($url, json_encode($data));
		if (is_error($response)) {
			return $response;
		}
		return $response['content'];
	}

	public function getQrcode() {

	}



	protected function requestApi($url, $post = '') {


		$response = $this->ihttp_request($url, $post);

		$result = @json_decode($response['content'], true);
		if($this->is_error($response)) {
			return $this->error($result['errcode'], "访问公众平台接口失败, 错误详情: {$this->errorCode($result['errcode'])}");
		}

		if(empty($result)) {

			return $response;
		} elseif(!empty($result['errcode'])) {

			return $this->error($result['errcode'], "访问公众平台接口失败, 错误: {$result['errmsg']},错误详情：{$this->errorCode($result['errcode'])}");
		}

		return $result;
	}



	public function getDailyVisitTrend() {
		$token = $this->getAccessToken();
		if (is_error($token)) {
			return $token;
		}
		$url = "https://api.weixin.qq.com/datacube/getweanalysisappiddailyvisittrend?access_token={$token}";
		$data = array(
			'begin_date' => date('Y-m-d', strtotime('-1 days')),
			'end_date' => date('Y-m-d', strtotime('-1 days'))
		);

		$response = $this->requestApi($url, json_encode($data));
		if (is_error($response)) {
			return $response;
		}
		return $response['list'][0];
	}

	function ihttp_build_curl($url, $post, $extra, $timeout) {
		if (!function_exists('curl_init') || !function_exists('curl_exec')) {
			return error(1, 'curl扩展未开启');
		}
		$urlset = $this->ihttp_parse_url($url);

		if ($this->is_error($urlset)) {
			return $urlset;
		}

		if (!empty($urlset['ip'])) {
			$extra['ip'] = $urlset['ip'];
		}

		$ch = curl_init();
		if (!empty($extra['ip'])) {
			$extra['Host'] = $urlset['host'];
			$urlset['host'] = $extra['ip'];
			unset($extra['ip']);
		}

		curl_setopt($ch, CURLOPT_URL, $urlset['scheme'] . '://' . $urlset['host'] . ($urlset['port'] == '80' || empty($urlset['port']) ? '' : ':' . $urlset['port']) . $urlset['path'] . $urlset['query']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		@curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);

		if ($post) {

			if (is_array($post)) {
				$filepost = false;
				foreach ($post as $name => &$value) {

					if (version_compare(phpversion(), '5.5') >= 0 && is_string($value) && substr($value, 0, 1) == '@') {
						$post[$name] = new CURLFile(ltrim($value, '@'));
					}
					if ((is_string($value) && substr($value, 0, 1) == '@') || (class_exists('CURLFile') && $value instanceof CURLFile)) {
						$filepost = true;
					}
				}
				if (!$filepost) {

					$post = $this->http_build_query($post);
				}
			}
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		if (!empty($GLOBALS['_W']['config']['setting']['proxy'])) {
			$urls = parse_url($GLOBALS['_W']['config']['setting']['proxy']['host']);
			if (!empty($urls['host'])) {
				curl_setopt($ch, CURLOPT_PROXY, "{$urls['host']}:{$urls['port']}");
				$proxytype = 'CURLPROXY_' . strtoupper($urls['scheme']);
				if (!empty($urls['scheme']) && defined($proxytype)) {
					curl_setopt($ch, CURLOPT_PROXYTYPE, constant($proxytype));
				} else {
					curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
					curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
				}
				if (!empty($GLOBALS['_W']['config']['setting']['proxy']['auth'])) {
					curl_setopt($ch, CURLOPT_PROXYUSERPWD, $GLOBALS['_W']['config']['setting']['proxy']['auth']);
				}
			}
		}
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		if (defined('CURL_SSLVERSION_TLSv1')) {
			curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		}
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
		if (!empty($extra) && is_array($extra)) {
			$headers = array();
			foreach ($extra as $opt => $value) {
				if (strexists($opt, 'CURLOPT_')) {
					curl_setopt($ch, constant($opt), $value);
				} elseif (is_numeric($opt)) {
					curl_setopt($ch, $opt, $value);
				} else {
					$headers[] = "{$opt}: {$value}";
				}
			}
			if (!empty($headers)) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}
		}
		return $ch;
	}

	function ihttp_request($url, $post = '', $extra = array(), $timeout = 60) {
		if (function_exists('curl_init') && function_exists('curl_exec') && $timeout > 0) {

			$ch = $this->ihttp_build_curl($url, $post, $extra, $timeout);

			if ($this->is_error($ch)) {
				return $ch;
			}

			$data = curl_exec($ch);
			$status = curl_getinfo($ch);
			$errno = curl_errno($ch);
			$error = curl_error($ch);
			curl_close($ch);

			if ($errno || empty($data)) {
				return $this->error(1, $error);
			} else {

				return $this->ihttp_response_parse($data);
			}
		}

		$urlset = $this->ihttp_parse_url($url, true);
		if (!empty($urlset['ip'])) {
			$urlset['host'] = $urlset['ip'];
		}

		$body = $this->ihttp_build_httpbody($url, $post, $extra);

		if ($urlset['scheme'] == 'https') {
			$fp = ihttp_socketopen('ssl://' . $urlset['host'], $urlset['port'], $errno, $error);
		} else {
			$fp = ihttp_socketopen($urlset['host'], $urlset['port'], $errno, $error);
		}
		stream_set_blocking($fp, $timeout > 0 ? true : false);
		stream_set_timeout($fp, ini_get('default_socket_timeout'));
		if (!$fp) {
			return error(1, $error);
		} else {
			fwrite($fp, $body);
			$content = '';
			if($timeout > 0) {
				while (!feof($fp)) {
					$content .= fgets($fp, 512);
				}
			}
			fclose($fp);
			return ihttp_response_parse($content, true);
		}
	}



	function ihttp_parse_url($url, $set_default_port = false) {
		if (empty($url)) {
			return $this->error(1);
		}
		$urlset = parse_url($url);
		if (!empty($urlset['scheme']) && !in_array($urlset['scheme'], array('http', 'https'))) {
			return $this->error(1, '只能使用 http 及 https 协议');
		}
		if (empty($urlset['path'])) {
			$urlset['path'] = '/';
		}
		if (!empty($urlset['query'])) {
			$urlset['query'] = "?{$urlset['query']}";
		}

		if (empty($urlset['host'])) {
			$current_url = parse_url($this->_W['siteroot']);
			$urlset['host'] = $current_url['host'];
			$urlset['scheme'] = $current_url['scheme'];
			$urlset['path'] = $current_url['path'] . 'web/' . str_replace('./', '', $urlset['path']);
			$urlset['ip'] = '127.0.0.1';
		}
		if ($set_default_port && empty($urlset['port'])) {
			$urlset['port'] = $urlset['scheme'] == 'https' ? '443' : '80';
		}

		return $urlset;
	}

	function ihttp_allow_host($host) {
		global $_W;
		if (strexists($host, '@')) {
			return false;
		}
		$pattern = "/^(10|172|192|127)/";
		if (preg_match($pattern, $host) && isset($_W['setting']['ip_white_list'])) {
			$ip_white_list = $_W['setting']['ip_white_list'];
			if ($ip_white_list && isset($ip_white_list[$host]) && !$ip_white_list[$host]['status']) {
				return false;
			}
		}
		return true;
	}



	function ihttp_response_parse($data, $chunked = false) {
		$rlt = array();
		$headermeta = explode('HTTP/', $data);
		if (count($headermeta) > 2) {
			$data = 'HTTP/' . array_pop($headermeta);
		}
		$pos = strpos($data, "\r\n\r\n");
		$split1[0] = substr($data, 0, $pos);
		$split1[1] = substr($data, $pos + 4, strlen($data));

		$split2 = explode("\r\n", $split1[0], 2);
		preg_match('/^(\S+) (\S+) (.*)$/', $split2[0], $matches);
		$rlt['code'] = $matches[2];
		$rlt['status'] = $matches[3];
		$rlt['responseline'] = $split2[0];
		$header = explode("\r\n", $split2[1]);
		$isgzip = false;
		$ischunk = false;
		foreach ($header as $v) {
			$pos = strpos($v, ':');
			$key = substr($v, 0, $pos);
			$value = trim(substr($v, $pos + 1));
			if (is_array($rlt['headers'][$key])) {
				$rlt['headers'][$key][] = $value;
			} elseif (!empty($rlt['headers'][$key])) {
				$temp = $rlt['headers'][$key];
				unset($rlt['headers'][$key]);
				$rlt['headers'][$key][] = $temp;
				$rlt['headers'][$key][] = $value;
			} else {
				$rlt['headers'][$key] = $value;
			}
			if(!$isgzip && strtolower($key) == 'content-encoding' && strtolower($value) == 'gzip') {
				$isgzip = true;
			}
			if(!$ischunk && strtolower($key) == 'transfer-encoding' && strtolower($value) == 'chunked') {
				$ischunk = true;
			}
		}

		if($chunked && $ischunk) {
			$rlt['content'] = $this->ihttp_response_parse_unchunk($split1[1]);
		} else {
			$rlt['content'] = $split1[1];
		}

		if($isgzip && function_exists('gzdecode')) {
			$rlt['content'] = gzdecode($rlt['content']);
		}

		$rlt['meta'] = $data;

		if($rlt['code'] == '100') {

			return $this->ihttp_response_parse($rlt['content']);
		}
		return $rlt;
	}

	function ihttp_response_parse_unchunk($str = null) {
		if(!is_string($str) or strlen($str) < 1) {
			return false;
		}
		$eol = "\r\n";
		$add = strlen($eol);
		$tmp = $str;
		$str = '';
		do {
			$tmp = ltrim($tmp);
			$pos = strpos($tmp, $eol);
			if($pos === false) {
				return false;
			}
			$len = hexdec(substr($tmp, 0, $pos));
			if(!is_numeric($len) or $len < 0) {
				return false;
			}
			$str .= substr($tmp, ($pos + $add), $len);
			$tmp  = substr($tmp, ($len + $pos + $add));
			$check = trim($tmp);
		} while(!empty($check));
		unset($tmp);
		return $str;
	}



}


