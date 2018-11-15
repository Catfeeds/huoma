<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we8.club/ for more details.
 */

$_W = $_GPC = array();

if (isset($_W['config']['setting']['https'])) {
	$_W['ishttps'] = $_W['config']['setting']['https'];
} else {
	$_W['ishttps'] = $_SERVER['SERVER_PORT'] == 443 ||
	(isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ||
	strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https' ||
	strtolower($_SERVER['HTTP_X_CLIENT_SCHEME']) == 'https' 					? true : false;
}

$_W['isajax'] = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
$_W['ispost'] = $_SERVER['REQUEST_METHOD'] == 'POST';

$_W['sitescheme'] = $_W['ishttps'] ? 'https://' : 'http://';
$_W['script_name'] = htmlspecialchars(scriptname());


$sitepath = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
$_W['siteroot'] = htmlspecialchars($_W['sitescheme'] . $_SERVER['HTTP_HOST'] . $sitepath);

if(substr($_W['siteroot'], -1) != '/') {
	$_W['siteroot'] .= '/';
}

$urls = parse_url($_W['siteroot']);
$urls['path'] = str_replace(array('/web', '/app', '/payment/wechat', '/payment/alipay', '/api'), '', $urls['path']);
$_W['siteroot'] = $urls['scheme'].'://'.$urls['host'].((!empty($urls['port']) && $urls['port']!='80') ? ':'.$urls['port'] : '').$urls['path'];
$_W['siteurl'] = $urls['scheme'].'://'.$urls['host'].((!empty($urls['port']) && $urls['port']!='80') ? ':'.$urls['port'] : '') . $_W['script_name'] . (empty($_SERVER['QUERY_STRING'])?'':'?') . $_SERVER['QUERY_STRING'];

$cookie = $this->cookie->fetch_all();

//echo __CFG::C_PREFIX;;die;
foreach($cookie as $key => $value) {
		$_GPC[$key] = $value;
}



unset($key, $value);

$_GPC = array_merge($_GET, $_POST, $_GPC,$_REQUEST);

if(!$_W['isajax']) {
	$input = file_get_contents("php://input");
	if (!empty($input)) {
		$__input = @json_decode($input, true);
		if (!empty($__input)) {
			$_GPC['__input'] = $__input;
			$_W['isajax'] = true;
		}
	}
	unset($input, $__input);
}

// setting_load();
if (empty($_W['setting']['upload'])) {
	$_W['setting']['upload'] = array_merge($_W['config']['upload']);
}
$_W['attachurl'] = $_W['attachurl_local'] = $_W['siteroot'] . $_W['config']['upload']['attachdir'] . '/';
if (!empty($_W['setting']['remote']['type'])) {
	if ($_W['setting']['remote']['type'] == ATTACH_FTP) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['ftp']['url'] . '/';
	} elseif ($_W['setting']['remote']['type'] == ATTACH_OSS) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['alioss']['url'].'/';
	} elseif ($_W['setting']['remote']['type'] == ATTACH_QINIU) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['qiniu']['url'].'/';
	} elseif ($_W['setting']['remote']['type'] == ATTACH_COS) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['cos']['url'].'/';
	}
}

$_W['os'] = 'mobile';
$_W['container'] = 'wechat';

$controller = $_GPC['c'];
$action = $_GPC['a'];
$do = $_GPC['do'];


$_W['uniacid'] = intval($_GPC['i']);

if(empty($_W['uniacid'])) {
	$_W['uniacid'] = intval($_GPC['weid']);
}

$uniacid = empty($uniacid) ? $_W['uniacid'] : intval($uniacid);

$_W['uniaccount'] = $_W['account'] = K::M('card/member')->find('uniacid =2');

if(empty($_W['uniaccount'])) {
	exit('指定主公众号不存在。');
}

$_W['acid'] = $_W['uniaccount']['acid'];
if (!empty($_W['uniaccount']['isdeleted'])) {
	exit('指定公众号已被删除');
}
//设置session
if (isset($_GPC['state']) && !empty($_GPC['state']) && strstr($_GPC['state'], 'we7sid-')) {
	$pieces = explode('-', $_GPC['state']);
	$_W['session_id'] = $pieces[1];
	unset($pieces);
}

if (empty($_W['session_id'])) {
	$_W['session_id'] = $_COOKIE[session_name()];
}
if (empty($_W['session_id'])) {
	$_W['session_id'] = "{$_W['uniacid']}-" . random(20) ;
	$_W['session_id'] = md5($_W['session_id']);
	setcookie(session_name(), $_W['session_id']);

}

session_id($_W['session_id']);
session_start();
if ((!empty($_SESSION['acid']) && $_W['acid'] != $_SESSION['acid']) ||
	(!empty($_SESSION['uniacid']) && $_W['uniacid'] != $_SESSION['uniacid'])) {
	$keys = array_keys($_SESSION);
	foreach ($keys as $key) {
		unset($_SESSION[$key]);
	}
	unset($keys, $key);
}

$_SESSION['acid'] = $_W['acid'];
$_SESSION['uniacid'] = $_W['uniacid'];

if (!empty($_SESSION['openid'])) {
	$_W['openid'] = $_SESSION['openid'];
	$_W['fans'] = K::M('card/fans')->mc_fansinfo($_W['openid'],'','',$_W);
	$_W['fans']['from_user'] = $_W['fans']['openid'] = $_W['openid'];
}

if (!empty($_SESSION['uid']) || (!empty($_W['fans']) && !empty($_W['fans']['uid']))) {
	$uid = intval($_SESSION['uid']);
	if (empty($uid)) {
		$uid = $_W['fans']['uid'];
	}
	K::M('card/auth')->_mc_login(array('uid' => $uid),$_W);
	unset($uid);
}


if (empty($_W['openid']) && !empty($_SESSION['oauth_openid'])) {
	$_W['openid'] = $_SESSION['oauth_openid'];
	$_W['fans'] = array(
		'openid' => $_SESSION['oauth_openid'],
		'from_user' => $_SESSION['oauth_openid'],
		'follow' => 0
	);
}

$_W['oauth_account'] = $_W['account']['oauth'] = array(
	'key' => $_W['account']['key'],
	'secret' => $_W['account']['secret'],
	'acid' => $_W['account']['acid'],
	'type' => $_W['account']['type'],
	'level' => $_W['account']['level'],
);


header('Content-Type: text/html; charset=' . $_W['charset']);

