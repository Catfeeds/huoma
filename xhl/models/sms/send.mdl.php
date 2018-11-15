<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: 56dxw.mdl.php 2015-09-27 02:07:36  xinghuali
 */

include 'aliyun-php-sdk-core/Config.php';
include_once 'Dysmsapi/Request/V20170525/SendSmsRequest.php';
include_once 'Dysmsapi/Request/V20170525/QuerySendDetailsRequest.php';
Import::I('sms');
class Mdl_Sms_send implements Sms_Interface
{   
    protected $_cfg = array();

    public $lastmsg = '';
	public $lastcode = 1;
	public $lastcon = '';
    var $accessKeyId = "LTAIq9mnexguCnVF";//LTAIStSgzZrElqG7
    var $accessKeySecret = "ldbkvd8s6jlwARo9fFAO5F3j4e779z";//wpGjdoHQ3Y0Lnb9QnOTHE7pSEzMyp4
    //短信API产品名
    var $product = "Dysmsapi";
    //短信API产品域名
    var $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region
    var $region = "cn-hangzhou";

    public function __construct($system)
    {
    	$this->_cfg = $system->config->get('sms');
    }
    
    public function send($mobile, $content)
    {
        $smstemplate_id ="SMS_129485026";//SMS_109465254
        $session =K::M('system/session')->start();
        $code =  $session->get('MOBILE_VERIFY_CODE');
        $product = '干点活';
        $smsText = "{\"code\":\"".$code."\"}";
        $result = $this->send_msg($mobile, $smsText,$smstemplate_id);
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
	
	
	
}