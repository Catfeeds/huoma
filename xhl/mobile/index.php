<?php

define("__APP__", "mobile");
define("__APP_DIR", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("__CORE_DIR", dirname(__APP_DIR) . DIRECTORY_SEPARATOR);
define("IN_MOBILE", true);

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
		$act = $this->request["ctl"] . ":" . $this->request["act"];
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

		if ($city = $this->_parse_city($request)) {
			$request["city"] = $city;
			$request["city_id"] = $city["city_id"];

			if ($this->cookie->get("curr_city_id") != $city["city_id"]) {
				$this->cookie->set("curr_city_id", $city["city_id"]);
			}
		}

		$this->request = &$request;
		return $request;
	}

	protected function _parse_city($request)
	{
		$site = $this->config->get("site");
		$oCity = K::M("data/city");
		$city = array();
		if ($site["multi_city"] && ($host = $_SERVER["HTTP_HOST"])) {
			if (preg_match("/^([a-z]+)$/i", trim($request["uri"], "/"), $match)) {
				$city = $oCity->city_by_pinyin($match[1]);
			}

			if (empty($city) && ($cookie_city_id = $this->cookie->get("curr_city_id"))) {
				$city = $oCity->city($cookie_city_id);
			}

			if (empty($city)) {
				$city = $oCity->city_by_ip(__IP);
			}
		}

		if (empty($city) && !$city = $oCity->city((int) $site["city_id"])) {
			exit("没有开通城市站点");
		}

		return $city;
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
}


new Index();
?>
