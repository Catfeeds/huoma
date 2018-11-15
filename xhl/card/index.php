<?php
define("__APP__", "card");
define("__APP_DIR", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("__CORE_DIR", dirname(__APP_DIR) . DIRECTORY_SEPARATOR);
define("IN_MOBILE", true);
//新增加card
define('IN_IA', true);
define('STARTTIME', microtime());
define("IA_ROOT",  str_replace("\\", '/',dirname(__FILE__) . DIRECTORY_SEPARATOR));
define('MAGIC_QUOTES_GPC', (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) || @ini_get('magic_quotes_sybase'));
define('TIMESTAMP', time());

require(__CORE_DIR."xhlctl/xing.php");
class Index extends xing
{
	protected $_default_request = array("ctl" => "index", "act" => "index", "type" => "html", "args" => NULL);
	protected $_cust_uri;

	public function __construct($uri = NULL)
	{
		$this->_cust_uri = $uri;
		parent::__construct();
	}

	protected function _init()
	{


		parent::_init();

		require (__APP_DIR . "controller.php");
		$res = $this->getController();

		$act = $this->request["ctl"] . ":" . $this->request["act"];

		//获取使用的控制器
		$this->auth = K::M("member/auth");
		$this->auth->token();
		K::$system->check_listion();
		$this->uid = $this->auth->uid;
		$this->uname = $this->auth->uname;
		$this->MEMBER = $this->auth->member;
	}

	protected function _run($uri = NULL)
	{

		$objctl = $this->_frontend($this->request["ctl"], $this->request["act"]);

		if (!is_object($objctl)) {
			$this->error(404);
		}

		$this->objctl = &$objctl;

		if (!$this->call($objctl, $this->request["act"], $this->request["args"])) {
			$this->error(404);
		}
		else {
			if (("magic" === $this->request["ctl"]) && ("shell" === $this->request["act"])) {
				return true;
			}
		}

		$this->err->response();
	}

	protected function _route($uri = NULL)
	{
		if (($uri === NULL) && ($this->_cust_uri !== NULL)) {
			$uri = $this->_cust_uri;
		}

		$request = parent::_route($uri);
		$request["MINI"] = ($_REQUEST["MINI"] ? $_REQUEST["MINI"] : false);



		$this->request = &$request;
		return $request;
	}


	protected function _frontend($ctl, $act = "index")
	{
		if(strstr($ctl,'/')){
			$ctl_list = explode('/',$ctl);
			if($ctl_list[0]=='member'){
				Import::C(__APP__ . ":member/ucenter");
			}
		}

		if (!$clsName = Import::C(__APP__ . ":$ctl")) {
			$this->error(404);
		}

		$object = new $clsName($this);
		return $object;
	}

	protected function error($e = NULL)
	{
		if (__CFG::DEBUG) {
			trigger_error($e, 256);
		}
		else if (is_numeric($e)) {
			$this->response_code($e);

			if (is_object($this->objctl)) {
				$this->objctl->error(404);
			}
			else {
				Import::C(__APP__ . ":index");
				$objctl = new Ctl_Index($this);
				$objctl->error(404);
			}
		}
	}

	public function mklink($ctl, $act = "index", $args = array(), $extname = ".html", $params = array())
	{
		return K::M("helper/link")->mklink("$ctl:$act", $args, $extname, $params);
	}

	public function getController()
    {
		
//		require_once __APP_DIR.'/framework/bootstrap.inc.php';
//		load()->app('common');
//		load()->app('template');
//		load()->model('app');
//		require_once __APP_DIR . '/app/common/bootstrap.app.inc.php';
//
//		$acl = array(
//			'home' => array(
//				'default' => 'home',
//			),
//			'mc' => array(
//				'default' => 'home'
//			)
//		);
//
//		if ($_W['setting']['copyright']['status'] == 1) {
//			$_W['siteclose'] = true;
//			message('抱歉，站点已关闭，关闭原因：' . $_W['setting']['copyright']['reason']);
//		}
//		$multiid = intval($_GPC['t']);
//		if(empty($multiid)) {
//				$multiid = intval($unisetting['default_site']);
//			unset($setting);
//		}
//
//		// $multi = pdo_fetch("SELECT * FROM ".tablename('site_multi')." WHERE id=:id AND uniacid=:uniacid", array(':id' => $multiid, ':uniacid' => $_W['uniacid']));
//		// $multi['site_info'] = @iunserializer($multi['site_info']);
//
//		$multi['site_info'] = '';
//
//		// $styleid = !empty($_GPC['s']) ? intval($_GPC['s']) : intval($multi['styleid']);
//		$style = false;
//
//		// $templates = uni_templates();
//		$templates = [
//			'id'=>'1',
//			'name'=>'1',
//			'id'=>'default',
//			'title'=>'干点活默认模板',
//			'version'=>'',
//			'description'=>'干点活',
//			'author'=>'维吧社区',
//			'type'=>'1',
//			'url'=>'http://www.gandianhuo.com',
//			'sections'=>'0',
//
//		];
//
//
//
//		$templateid = intval($style['templateid']);
//		$template = $templates[$templateid];
//
//		$_W['template'] = !empty($template) ? $template['name'] : 'default';
//		$_W['styles'] = array();
//
//		// if(!empty($template) && !empty($style)) {
//		// 	$sql = "SELECT `variable`, `content` FROM " . tablename('site_styles_vars') . " WHERE `uniacid`=:uniacid AND `styleid`=:styleid";
//		// 	$params = array();
//		// 	$params[':uniacid'] = $_W['uniacid'];
//		// 	$params[':styleid'] = $styleid;
//		// 	$stylevars = pdo_fetchall($sql, $params);
//		// 	if(!empty($stylevars)) {
//		// 		foreach($stylevars as $row) {
//		// 			if (strexists($row['variable'], 'img')) {
//		// 				$row['content'] = tomedia($row['content']);
//		// 			}
//		// 			$_W['styles'][$row['variable']] = $row['content'];
//		// 		}
//		// 	}
//		// 	unset($stylevars, $row, $sql, $params);
//		// }
//
//		$_W['page'] = array();
//		$_W['page']['title'] = $multi['title'];
//		if(is_array($multi['site_info'])) {
//			$_W['page'] = array_merge($_W['page'], $multi['site_info']);
//		}
//		unset($multi, $styleid, $style, $templateid, $template, $templates);
//
//		if ($controller == 'wechat' && $action == 'card' && $do == 'use') {
//			header("location: index.php?i={$_W['uniacid']}&c=entry&m=paycenter&do=consume&encrypt_code={$_GPC['encrypt_code']}&card_id={$_GPC['card_id']}&openid={$_GPC['openid']}&source={$_GPC['source']}");
//			exit;
//		}
//
//
//		$controllers = array();
//		$handle = opendir(IA_ROOT . '/app/source/');
//		if(!empty($handle)) {
//			while($dir = readdir($handle)) {
//				if($dir != '.' && $dir != '..') {
//					$controllers[] = $dir;
//				}
//			}
//		}
//
//		if(!in_array($controller, $controllers)) {
//			$controller = 'home';
//		}
//
//		$init = IA_ROOT . "/app/source/{$controller}/__init.php";
//
//		if(is_file($init)) {
//			require $init;
//		}
//
//		$actions = array();
//		$handle = opendir(IA_ROOT . '/app/source/' . $controller);
//		if(!empty($handle)) {
//			while($dir = readdir($handle)) {
//				if($dir != '.' && $dir != '..' && strexists($dir, '.ctrl.php')) {
//					$dir = str_replace('.ctrl.php', '', $dir);
//					$actions[] = $dir;
//				}
//			}
//		}
//
//		if(empty($actions)) {
//			$str = '';
//			if(uni_is_multi_acid()) {
//				$str = "&j={$_W['acid']}";
//			}
//			header("location: index.php?i={$_W['uniacid']}{$str}&c=home?refresh");
//		}
//		if(!in_array($action, $actions)) {
//			$action = $acl[$controller]['default'];
//		}
//		if(!in_array($action, $actions)) {
//			$action = $actions[0];
//		}

		//定义全局变量
		$_GPC = array();
		foreach($_COOKIE as $key => $value) {
			$_GPC[substr($key)] = $value;
		}
		$_GPC = array_merge($_REQUEST,$_GPC);
//		echo "c:".$_GPC['c']."----a:".$_GPC['a'];die;
		$this->request["act"]  = $_GPC['a'];
		$this->request["ctl"]  = $_GPC['c'];

//		require $this->_forward($controller, $action);
    }

    public function _forward($c, $a) {
			$file = IA_ROOT . '/app/source/' . $c . '/' . $a . '.ctrl.php';
			return $file;
	}


    


}


new Index();
?>
