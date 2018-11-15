<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: 56dxw.mdl.php 2015-09-27 02:07:36  xinghuali
 */

Import::I('sms');
class Mdl_Sms_eee1 implements Sms_Interface
{   
    protected $_cfg = array();

    public $lastmsg = '';
	public $lastcode = 1;
	public $lastcon = '';

    public function __construct($system)
    {
    	$this->_cfg = $system->config->get('sms');
    }
    
    public function send($mobile, $content)
    {
    	$params = array('comid'=>$this->_cfg['comid'], 'smsnumber'=>$this->_cfg['smsnumber']);
    	$params['username'] = $this->_cfg['uname'];
    	$params['userpwd'] = $this->_cfg['passwd'];
    	$params['sendtime'] = '';
    	$params['handtel'] = $mobile;
    	$params['sendcontent'] = iconv('UTF-8', 'GB2312//IGNORE', $content);
        $http = K::M('net/http');
		
		$flag = 0; 
		$params='';//要post的数据 
//		$verify = rand(123456, 999999);//获取随机验证码		
	
		//以下信息自己填以下
		$mobile=$mobile;//手机号
		$argv = array( 
			'name'=>$this->_cfg['uname'],     //必填参数。用户账号
			'pwd'=>$this->_cfg['passwd'],     //必填参数。（web平台：基本资料中的接口密码）
			'content'=>'【'.$this->_cfg['qianming'].'】'.$content,//'短信验证码为：'.$verify.'，请勿将验证码提供给他人。',   //必填参数。发送内容（1-500 个汉字）UTF-8编码
			'mobile'=>$mobile,   //必填参数。手机号码。多个以英文逗号隔开
			'stime'=>'',   //可选参数。发送时间，填写时已填写的时间发送，不填时为当前时间发送
			'sign'=>'',    //必填参数。用户签名。
			'type'=>'pt',  //必填参数。固定值 pt
			'extno'=>'1'    //可选参数，扩展码，用户定义扩展码，只能为数字
		);
//		print_r($argv);exit;
//		exit;
		//构造要post的字符串 
		//echo $argv['content'];
		foreach ($argv as $key=>$value) { 
			if ($flag!=0) { 
				$params .= "&"; 
				$flag = 1; 
			} 
			$params.= $key."="; $params.= urlencode($value);// urlencode($value); 
			$flag = 1; 
		} 
		$url = "http://sms.1xinxi.cn/asmx/smsservice.aspx?".$params; //提交的url地址
	//	$con= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态
		


		
    	$con= file_get_contents($url);
		$con_array = explode(',', $con);
   		if($con_array[0] == '0'){
				$this->lastcon = $con;
    			return true;
    	}else{
                switch($con){
				   case 1:$error='含有敏感词汇';break;
				   case 2:$error='余额不足';break;
				   case 3:$error='没有号码';break;
				   case 4:$error='包含sql语句';break;
				   case 10:$error='账号不存在';break;
				   case 11:$error='账号注销';break;
				   case 12:$error='账号停用';break;
				   case 13:$error='IP鉴权失败';break;
				   case 14:$error='格式错误';break;
				   case -1:$error = '系统异常';break;
				   default:$error='未知的错误';
				}
				$this->lastcode = $con;
				$this->lastmsg = $error;
				$this->lastcon = $con;
    	}

    	return false;
    }
	
	
	
}