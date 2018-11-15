<?php

if (!defined("__CORE_DIR")) {
	exit("Access Denied");
}
class Ctl extends Factory
{
	protected $_allow_fields = "";

	public function __construct(&$system)
	{
	    /*if($this->is_mobile()){
            Header("HTTP/1.1 301 Moved Permanently");
            Header("Location: https://m.wordhuo.com/www");
        }*/
		parent::__construct($system);
		$this->cookie = $system->cookie;
		$this->InitializeApp();
		Import::L('log/log.class.php');
		Import::L('aliyun-php-sdk-core/Config.php');
		Import::L('Dysmsapi/Request/V20170525/SendSmsRequest.php');
		Import::L('Dysmsapi/Request/V20170525/QuerySendDetailsRequest.php');
	}

    function is_mobile() {
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        if (isset($_SERVER['HTTP_VIA'])) {
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger');
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }
	protected function InitializeApp()
	{
		$this->err->template("view:page/notice.html");
		$this->system->objctl = &$this;
		$this->auth = &$this->system->auth;
		$this->MEMBER = &$this->system->MEMBER;
		$this->uid = $this->MEMBER["uid"];
		$this->uname = $this->MEMBER["uname"];
		$this->seo = K::m("helper/seo");
	}

	protected function _init_pagedata()
	{
		parent::_init_pagedata();
		$theme = $this->default_theme();
		$this->pagedata["MEMBER"] = $this->MEMBER;
		$site = $this->system->config->get("site");
		$this->pagedata["pager"]["url"] = $site["url"];
        $this->pagedata["siteurl"] = $site["siteurl"];
		$this->pagedata["pager"]["res"] = __CFG::RES_URL;
		$this->pagedata["pager"]["sitecount"] = K::m("magic/magic")->sitecount();
		$this->pagedata["request"] = $this->request;
		$this->pagedata["pager"]["theme"] = $site["siteurl"] . "/expo";
		$this->pagedata["SEO"] = $this->seo->_SEO;
		$this->pagedata["nowtime"] = __TIME;
		$output = K::m("system/frontend");
		$output->setCompileDir(__CFG::DIR . "data/tplcache");
	}

	public function check_fields($data, $fields = NULL)
	{
		if ($fields === NULL) {
			$fields = $this->_allow_fields;
		}

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
			if ($this->request["XREQ"] || $this->request["MINI"]) {
				$this->err->add("很抱歉，你还没有登录不能访问", 101);
			}
			else {
				$this->tmpl = "user/login.html";
			}

			$this->err->response();
			exit();
		}

		return true;
	}

	protected function set_resource_view(&$output)
	{
		$theme = $this->default_theme();
		$output->setTemplateDir(__CFG::TMPL_DIR . $theme["theme"]);
		$output->registerFilter("pre", array($this, "smarty_pre_filter"));
		$output->registerFilter("post", array($this, "smarty_post_filter"));
		$output->default_template_handler_func = array($this, "theme_default_handler");
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
					$theme_url = trim($site["url"], "/") . "/tpl/" . $theme;

					return preg_replace("/%THEME%/", $theme_url, $source);
				}
			}
		}

		return $source;
	}

	public function theme_default_handler($type, $name, &$content, &$modified, $smarty)
	{
		if ($type == "file") {
			$file = __CFG::TMPL_DIR . "default" . DIRECTORY_SEPARATOR . $name;
			return $file;
		}

		return false;
	}

	public function error($error)
	{
		if (is_numeric($error)) {
			$this->system->response_code($error);
		}

		$this->tmpl = "page/" . $error . ".html";
		$this->output();
	}

	public function shutdown()
	{
	}

	protected function default_theme()
	{
		static $theme;

		if ($theme === NULL) {
			if ($city_theme_id = (int) $this->request["city"]["theme_id"]) {
				$theme = K::m("system/theme")->theme(NULL, $city_theme_id);
			}

			if (empty($theme)) {
				$theme = K::m("system/theme")->default_theme();
			}
		}

		return $theme;
	}

	protected function check_shop($shop_id = NULL)
	{
		if (!$shop_id = (int) $shop_id) {
			$this->error(404);
		}
		else if (!$shop = K::m("shop/shop")->detail($shop_id, true)) {
			$this->error(404);
		}
		else {
			if (empty($shop["audit"]) && (empty($this->uid) || ($this->uid != $shop["uid"]))) {
				$this->err->add("企业审核中不能访问", 212);
				$this->err->response();
			}
		}

		if ($uid = $shop["uid"]) {
			$shop["member"] = K::m("member/view")->detail($uid);
		}

		$theme = $this->default_theme();
		$skin_cfg = __CFG::TMPL_DIR . $theme["theme"] . "/shop/config.php";

		if (!file_exists($skin_cfg)) {
			$skin_cfg = __CFG::TMPL_DIR . "default/shop/config.php";
		}

		$skins = include ($skin_cfg);

		if (!$skin = $shop["skin"]) {
			$skin = "default";
		}

		$shop["skin_cfg"] = $skins[$skin];
		$this->pagedata["shop"] = $shop;
		return $shop;
	}
	
	public function ajjson($message='', $status = 100,$forward='',$refresh=0,$timer=3)
	{
		$array = array(
			'message'=>$message,
			'status'=>$status, //100-199错误  200-299 警告 300-399 通知 900 成功
			'flush'=>$refresh,// 0不刷新 1刷新当前页
			'jumpUrl'=>$forward, //网址
			'waitTime'=>$timer, // 延时关闭或跳转
		);
		echo json_encode($array);
//		exit;
	}
	//阿里短信配置
	var $accessKeyId = "LTAIq9mnexguCnVF";
	var $accessKeySecret = "ldbkvd8s6jlwARo9fFAO5F3j4e779z";
	//短信API产品名
	var $product = "Dysmsapi";
	//短信API产品域名
	var $domain = "dysmsapi.aliyuncs.com";
	//暂时不支持多Region
	var $region = "cn-hangzhou";
	var $_msg_mod;
	var $_msglog_mod;

	function send_msg_order($id,$to_mobile,$uid=0,$money=0) {
		switch ($id) {
			case 1:
				$to_mobile = $to_mobile;
				$smstemplate_id ="SMS_129485026";
				$code = rand(100000,999999);
				$session =K::M('system/session')->start();
				$session->set('MOBILE_VERIFY_CODE',$code, 1800); //30分钟有效
				$product = '干点活';
				$smsText = "{\"code\":\"".$code."\"}";
				break;
		}

		$result = $this->send_msg($to_mobile, $smsText,$smstemplate_id);
		return $result;
	}

	/*
	 * 短信发送
	 */
	function send_msg($to_mobile, $smsText,$smstemplate_id) {
//		ini_set("display_errors", "On");
//
//		error_reporting(E_ALL | E_STRICT);
		//初始化访问的acsCleint
		$profile = DefaultProfile::getProfile($this->region, $this->accessKeyId, $this->accessKeySecret);
		DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $this->product, $this->domain);
		$acsClient= new DefaultAcsClient($profile);

		$request = new Dysmsapi\Request\V20170525\SendSmsRequest;
		//必填-短信接收号码
		$request->setPhoneNumbers($to_mobile);
		//必填-短信签名
		$request->setSignName("干点活");
		//必填-短信模板Code
		$request->setTemplateCode($smstemplate_id);
		//选填-假如模板中存在变量需要替换则为必填(JSON格式)
		$request->setTemplateParam($smsText);
		//选填-发送短信流水号
		$request->setOutId($this->make_code());

		//发起访问请求
		$acsResponse = $acsClient->getAcsResponse($request);
		//=======================================

		$msgarr = array(
			"OK"	=>"请求成功",
			"isp.RAM_PERMISSION_DENY"=>	"RAM权限DENY",
			"isv.OUT_OF_SERVICE"=>	"业务停机",
			"isv.PRODUCT_UN_SUBSCRIPT"=>	"未开通云通信产品的阿里云客户",
			"isv.PRODUCT_UNSUBSCRIBE"=>	"产品未开通",
			"isv.ACCOUNT_NOT_EXISTS"=>	"账户不存在",
			"isv.ACCOUNT_ABNORMAL"=>	"账户异常",
			"isv.SMS_TEMPLATE_ILLEGAL"=>	"短信模板不合法",
			"isv.SMS_SIGNATURE_ILLEGAL"=>	"短信签名不合法",
			"isv.INVALID_PARAMETERS"=>	"参数异常",
			"isp.SYSTEM_ERROR"=>	"系统错误",
			"isv.MOBILE_NUMBER_ILLEGAL"=>	"非法手机号",
			"isv.MOBILE_COUNT_OVER_LIMIT"=>	"手机号码数量超过限制",
			"isv.TEMPLATE_MISSING_PARAMETERS"=>	"模板缺少变量",
			"isv.BUSINESS_LIMIT_CONTROL"=>	"业务限流",
			"isv.INVALID_JSON_PARAM"=>	"JSON参数不合法，只接受字符串值",
			"isv.BLACK_KEY_CONTROL_LIMIT"=>	"黑名单管控",
			"isv.PARAM_LENGTH_LIMIT"=>	"参数超出长度限制",
			"isv.PARAM_NOT_SUPPORT_URL"=>	"不支持URL",
			"isv.AMOUNT_NOT_ENOUGH"=>	"账户余额不足"
		);

		$add_msglog = array(
			'mobile' => $to_mobile,
			'content' => $smsText,
			'code' => json_encode($acsResponse),
			'time' => time(),
			'chinese' => $msgarr[$acsResponse->Code]
		);

		K::M('codelog')->add($add_msglog);
		var_dump($acsResponse->Code);die;
		if ($acsResponse->Code =='OK') {
			// user_id = 0 user_name = admin  表示为系统发送,短信的条数不做操作
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/**
	 * 生成随机码 用于注册 以及修改
	 */
	function make_code() {
		$chars = '0123456789';
		$code = '';
		for ($i = 0; $i < 6; $i++) {
			$code .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $code;
	}
	public function pushdata($data){
		header('Content-type: application/json');
		echo json_encode($data,true);die;
	}
}


?>
