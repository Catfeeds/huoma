<?php

if (!defined("__CORE_DIR")) {
	exit("Access Denied");
}
class Ctl extends Factory
{
	public function __construct(&$system)
	{
		parent::__construct($system);
		$this->cookie = $system->cookie;
		$this->InitializeApp();
	}

	protected function InitializeApp()
	{
		$this->err->template("mobile:page/notice.html");
		$this->system->objctl = &$this;
		$this->auth = &$this->system->auth;
		$this->MEMBER = &$this->system->MEMBER;
		$this->uid = $this->MEMBER["uid"];
		$this->uname = $this->MEMBER["uname"];
		$this->seo = K::M("helper/seo");
		$this->system->config->load(array("site", "mobile"));
	}

	protected function _init_pagedata()
	{
//	    echo "<pre>";
//	    var_dump($this->MEMBER);die;
		parent::_init_pagedata();
		$theme = K::M("system/theme")->default_theme();
		$this->pagedata["MEMBER"] = $this->MEMBER;
		$this->pagedata["PAGEID"] = __TIME.rand(10,99999);
		$site = $this->system->config->get("site");
		$this->pagedata["pager"]["url"] = $site["url"];
		$this->pagedata["pager"]["res"] = __CFG::RES_URL;
		$this->pagedata["request"] = $this->request;
		$this->pagedata["pager"]["theme"] = $site["siteurl"] . "/expo";
		$this->pagedata["SEO"] = $this->seo->_SEO;
		$output = K::M("system/frontend");
		$output->setCompileDir(__CFG::DIR . "data/tplcache");
	}

	public function check_fields($data, $fields)
	{
		if (!is_array($fields)) {
			$fields = explode(",", $fields);
		}

		foreach ((array) $data as $k => $v ) {
			if (!in_array($k, $fields)) {
				unset($data[$k]);
			}
		}

		return $data;
	}

	public function check_login()
	{
		if (!$this->uid) {
		    $this->ajaxReturn(array('error'=>1));
			//if ($this->request["XREQ"] || $this->request["MINI"]) {
			//	$this->err->add("很抱歉，你还没有登录不能访问", 101);
			//}
			//else {
				if(IS_APP){
					$this->pagedata['app'] = $this->request['args'][1];
					$this->pagedata['openid'] = $this->request['args'][2];
					$this->tmpl = "mobile:user/applogin.html";
				}else{
					$this->tmpl = "mobile:user/login.html";
				}
		//	}

			$this->err->response();
			exit();
		}

		return true;
	}

	protected function set_resource_view(&$output)
	{
		$theme = K::M("system/theme")->default_theme();
		$output->setTemplateDir(__CFG::TMPL_DIR . $theme["theme"]);
		$output->registerFilter("pre", array($this, "smarty_pre_filter"));
		$output->registerFilter("post", array($this, "smarty_post_filter"));
	}

	public function smarty_pre_filter($source, $smarty)
	{
		$s = array("/(<\{KT[^\}]*\}>)/", "/(<\{\/KT\}>)/", "/(<\{AD[^\}]*\}>)/", "/(<\{\/AD\}>)/", "/(<\{calldata[^\}]*\}>)/", "/(<\{\/calldata\}>)/");
		$r = array("\1<{literal}>", "<{/literal}>\1", "\1<{literal}>", "<{/literal}>\1", "\1<{literal}>", "<{/literal}>\1");
		//return preg_replace($s, $r, $source);
		return $source;
	}

	public function smarty_post_filter($source, $smarty)
	{
		if ($file_dependency = $smarty->properties["file_dependency"]) {
			foreach ($smarty->properties["file_dependency"] as $info ) {
				$tmpl = $smarty->template_resource;

				if ($info[2] == "file") {
					$theme = substr($info[0], strlen(__CFG::TMPL_DIR), -strlen($tmpl));
					$theme = str_replace("\\", "/", $theme);
					$theme = str_replace("/", "", $theme);
					$site = $this->system->config->get("site");
					$theme_url = trim($site["url"], "/") . "/expo/" . $theme;

					return preg_replace("/%THEME%/", $theme_url, $source);
				}
			}
		}

		return $source;
	}

	public function error($error)
	{
		if (is_numeric($error)) {
			$this->system->response_code($error);
		}

		$this->tmpl = "mobile:page/" . $error . ".html";
		$this->output();
	}

	public function shutdown()
	{
	}
}


?>
