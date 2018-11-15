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

		$this->system->config->load(array("site", "mobile"));
		$this->card_int();
	}

	protected function _init_pagedata()
	{
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
			//if ($this->request["XREQ"] || $this->request["MINI"]) {
			//	$this->err->add("很抱歉，你还没有登录不能访问", 101);
			//}
			//else {
				// if(IS_APP){
				// 	$this->pagedata['app'] = $this->request['args'][1];
				// 	$this->pagedata['openid'] = $this->request['args'][2];
				// 	$this->tmpl = "xcxmobile:user/applogin.html";
				// }else{
					$this->tmpl = "xcxmobile:user/login.html";
				// }
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

	function error($errno, $message = '') {
		return array(
			'errno' => $errno,
			'message' => $message,
		);
	}




	public function card_int()
	{
		require_once __APP_DIR.'/lib/common.class.php';
		require_once __APP_DIR.'/config.php';
		$act = array(
			'home' => array(
				'default' => 'home',
			),
			'mc' => array(
				'default' => 'home'
			)
		);

		$multi['site_info'] = '';

		// $styleid = !empty($_GPC['s']) ? intval($_GPC['s']) : intval($multi['styleid']);
		$style = false;

		// $templates = uni_templates();
		$templates = [
			'id'=>'1',
			'name'=>'1',
			'id'=>'default',
			'title'=>'干点活默认模板',
			'version'=>'',
			'description'=>'干点活',
			'author'=>'维吧社区',
			'type'=>'1',
			'url'=>'http://www.gandianhuo.com',
			'sections'=>'0',

		];


		;
		$templateid = intval($style['templateid']);
		$template = $templates[$templateid];

		$_W['template'] = !empty($template) ? $template['name'] : 'default';
		$_W['styles'] = array();


		$_W['page'] = array();
		$_W['page']['title'] = $multi['title'];
		if(is_array($multi['site_info'])) {
			$_W['page'] = array_merge($_W['page'], $multi['site_info']);
		}
		unset($multi, $styleid, $style, $templateid, $template, $templates);

		if ($controller == 'wechat' && $action == 'card' && $do == 'use') {
			header("location: index.php?i={$_W['uniacid']}&c=entry&m=paycenter&do=consume&encrypt_code={$_GPC['encrypt_code']}&card_id={$_GPC['card_id']}&openid={$_GPC['openid']}&source={$_GPC['source']}");
			exit;
		}


		$controllers = array();
		$handle = opendir(IA_ROOT . '/app/source/');
		if(!empty($handle)) {
			while($dir = readdir($handle)) {
				if($dir != '.' && $dir != '..') {
					$controllers[] = $dir;
				}
			}
		}

		if(!in_array($controller, $controllers)) {
			$controller = 'home';
		}

		$this->_W = $_W;
		$this->_GPC = $_REQUEST;
		require_once __APP_DIR . '/lib//card.php';


	}

	public function result($errno, $message = '', $data = '') {
		exit(json_encode(array(
			'errno' => $errno,
			'message' => $message,
			'data' => $data,
		)));
	}

	public function errorCode($code, $errmsg = '未知错误') {
		$errors = array(
			'-1' => '系统繁忙',
			'0' => '请求成功',
			'40001' => '获取access_token时AppSecret错误，或者access_token无效',
			'40002' => '不合法的凭证类型',
			'40003' => '不合法的OpenID',
			'40004' => '不合法的媒体文件类型',
			'40005' => '不合法的文件类型',
			'40006' => '不合法的文件大小',
			'40007' => '不合法的媒体文件id',
			'40008' => '不合法的消息类型',
			'40009' => '不合法的图片文件大小',
			'40010' => '不合法的语音文件大小',
			'40011' => '不合法的视频文件大小',
			'40012' => '不合法的缩略图文件大小',
			'40013' => '不合法的APPID',
			'40014' => '不合法的access_token',
			'40015' => '不合法的菜单类型',
			'40016' => '不合法的按钮个数',
			'40017' => '不合法的按钮个数',
			'40018' => '不合法的按钮名字长度',
			'40019' => '不合法的按钮KEY长度',
			'40020' => '不合法的按钮URL长度',
			'40021' => '不合法的菜单版本号',
			'40022' => '不合法的子菜单级数',
			'40023' => '不合法的子菜单按钮个数',
			'40024' => '不合法的子菜单按钮类型',
			'40025' => '不合法的子菜单按钮名字长度',
			'40026' => '不合法的子菜单按钮KEY长度',
			'40027' => '不合法的子菜单按钮URL长度',
			'40028' => '不合法的自定义菜单使用用户',
			'40029' => '不合法的oauth_code',
			'40030' => '不合法的refresh_token',
			'40031' => '不合法的openid列表',
			'40032' => '不合法的openid列表长度',
			'40033' => '不合法的请求字符，不能包含\uxxxx格式的字符',
			'40035' => '不合法的参数',
			'40038' => '不合法的请求格式',
			'40039' => '不合法的URL长度',
			'40050' => '不合法的分组id',
			'40051' => '分组名字不合法',
			'41001' => '缺少access_token参数',
			'41002' => '缺少appid参数',
			'41003' => '缺少refresh_token参数',
			'41004' => '缺少secret参数',
			'41005' => '缺少多媒体文件数据',
			'41006' => '缺少media_id参数',
			'41007' => '缺少子菜单数据',
			'41008' => '缺少oauth code',
			'41009' => '缺少openid',
			'42001' => 'access_token超时',
			'42002' => 'refresh_token超时',
			'42003' => 'oauth_code超时',
			'43001' => '需要GET请求',
			'43002' => '需要POST请求',
			'43003' => '需要HTTPS请求',
			'43004' => '需要接收者关注',
			'43005' => '需要好友关系',
			'44001' => '多媒体文件为空',
			'44002' => 'POST的数据包为空',
			'44003' => '图文消息内容为空',
			'44004' => '文本消息内容为空',
			'45001' => '多媒体文件大小超过限制',
			'45002' => '消息内容超过限制',
			'45003' => '标题字段超过限制',
			'45004' => '描述字段超过限制',
			'45005' => '链接字段超过限制',
			'45006' => '图片链接字段超过限制',
			'45007' => '语音播放时间超过限制',
			'45008' => '图文消息超过限制',
			'45009' => '接口调用超过限制',
			'45010' => '创建菜单个数超过限制',
			'45015' => '回复时间超过限制',
			'45016' => '系统分组，不允许修改',
			'45017' => '分组名字过长',
			'45018' => '分组数量超过上限',
			'45056' => '创建的标签数过多，请注意不能超过100个',
			'45057' => '该标签下粉丝数超过10w，不允许直接删除',
			'45058' => '不能修改0/1/2这三个系统默认保留的标签',
			'45059' => '有粉丝身上的标签数已经超过限制',
			'45157' => '标签名非法，请注意不能和其他标签重名',
			'45158' => '标签名长度超过30个字节',
			'45159' => '非法的标签',
			'46001' => '不存在媒体数据',
			'46002' => '不存在的菜单版本',
			'46003' => '不存在的菜单数据',
			'46004' => '不存在的用户',
			'47001' => '解析JSON/XML内容错误',
			'48001' => 'api功能未授权',
			'50001' => '用户未授权该api',
			'40070' => '基本信息baseinfo中填写的库存信息SKU不合法。',
			'41011' => '必填字段不完整或不合法，参考相应接口。',
			'40056' => '无效code，请确认code长度在20个字符以内，且处于非异常状态（转赠、删除）。',
			'43009' => '无自定义SN权限，请参考开发者必读中的流程开通权限。',
			'43010' => '无储值权限,请参考开发者必读中的流程开通权限。',
			'43011' => '无积分权限,请参考开发者必读中的流程开通权限。',
			'40078' => '无效卡券，未通过审核，已被置为失效。',
			'40079' => '基本信息base_info中填写的date_info不合法或核销卡券未到生效时间。',
			'45021' => '文本字段超过长度限制，请参考相应字段说明。',
			'40080' => '卡券扩展信息cardext不合法。',
			'40097' => '基本信息base_info中填写的参数不合法。',
			'49004' => '签名错误。',
			'43012' => '无自定义cell跳转外链权限，请参考开发者必读中的申请流程开通权限。',
			'40099' => '该code已被核销。',
			'61005' => '缺少接入平台关键数据，等待微信开放平台推送数据，请十分钟后再试或是检查“授权事件接收URL”是否写错（index.php?c=account&amp;a=auth&amp;do=ticket地址中的&amp;符号容易被替换成&amp;amp;）',
			'61023' => '请重新授权接入该公众号',
		);
		$code = strval($code);
		if($errors[$code]) {
			return $errors[$code];
		} else {
			return $errmsg;
		}
	}

	function is_error($data) {
		if (empty($data) || !is_array($data) || !array_key_exists('errno', $data) || (array_key_exists('errno', $data) && $data['errno'] == 0)) {
			return false;
		} else {
			return true;
		}
	}

}


?>
