<?php

define("__APP__", "home");
define("__APP_DIR", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("__CORE_DIR", dirname(__APP_DIR) . DIRECTORY_SEPARATOR);

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
        require (__APP_DIR . "functions.inc.php");
		$act = $this->request["ctl"] . ":" . $this->request["act"];
		$this->auth = K::M("member/auth");
		$this->auth->token();
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

		switch ($request["ctl"]) {
		case "mall":
			$request["ctl"] = "mall/index";
			break;

		case "member":
			$request["ctl"] = "member/member";
		}

		$siteCfg = $this->config->get("site");
		$accessCfg = $this->config->get("access");
		if ($request["ismobile"] && empty($request["isrobot"]) && $siteCfg["mobile"]) {
			$mobileCfg = $this->config->get("mobile");
			if ($mobileCfg["forward"] && in_array($request["ctl"], array("index", "company"))) {
				header("Location:" . $mobileCfg["url"]);
				exit();
			}
		}

		$request["MINI"] = ($_REQUEST["MINI"] ? $_REQUEST["MINI"] : false);
		$request["host"] = $_SERVER ['HTTP_HOST'];



		$this->request = &$request;
		return $request;
	}

	protected function _parse_city()
	{
		$site = $this->config->get("site");
		$oCity = K::M("data/city");
		$city = array();

		if ($site["multi_city"]) {
			if (($host = $_SERVER["HTTP_HOST"]) && ($pos = strpos($host, $site["city_domain"]))) {
				$py = substr($host, 0, $pos - 1);

				if ($city = $oCity->city_by_pinyin($py)) {
					$city["city_by"] = "domain";
				}
			}

			if (!$this->request["isrobot"]) {
				if (empty($city) && ($cookie_city_id = $this->cookie->get("curr_city_id")) && ($city = $oCity->city($cookie_city_id))) {
					$city["city_by"] = "cookie";
				}

				if (empty($city) && ($city = $oCity->city_by_ip(__IP))) {
					$city["city_by"] = "ip";
				}
			}

			if (empty($city) && ($city = $oCity->city((int) $site["city_id"]))) {
				$city["city_by"] = "default";
			}
		}
		else if ($city = $oCity->city((int) $site["city_id"])) {
			$city["city_by"] = "sign";
		}

		if (empty($city)) {
			exit("网站关闭！请联系系统管理员：4001781616");
		}

		return $city;
	}

	protected function _frontend($ctl, $act = "index")
	{
		if(strstr($ctl,'/')){
			$ctl_list = explode('/',$ctl);
			if($ctl_list[0]=='member'){
				Import::C(__APP__ . ":member/ucenter");
			}elseif($ctl_list[0]=='center'){
				Import::C(__APP__ . ":center/ucenter");
			}
		}
/*		if($ctl == 'api/uc'){
			$ctl='magic';
			$act = 'shell';
		}
*/		if (!$clsName = Import::C(__APP__ . ":$ctl")) {
			if (preg_match("/^\/(index\.php)?\?.+/i", $_SERVER["REQUEST_URI"])) {
				$this->request["ctl"] = $ctl = $this->_default_request["ctl"];
				$this->request["act"] = $this->_default_request["act"];
				$clsName = Import::C(__APP__ . ":$ctl");
			}
			else {
				$this->error(404);
			}
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
}


//new Index();
?>
