<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: user.ctl.php 10098 2015-09-29 14:44:00  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
include_once "wxBizDataCrypt.php";

class Ctl_Weixin extends Ctl
{
    public function index()
    {
        $appid        =$_GET["appid"];
        $sessionKey   =$_GET["secret"];
        $encryptedData=$_GET["encryptedData"];
        $iv           =$_GET["iv"];

        $pc = new WXBizDataCrypt($appid, $sessionKey);

        $errCode = $pc->decryptData($encryptedData, $iv, $data );
        if($errCode == 0){
            print($data . "\n");
        }else{
            print($errCode . "\n");
        }
        die;
//        echo $errCode;die;

    }
    public function code(){
        /*获取SESSION  key 的写法*/
        $appid        =$_GET["appid"];
        $sessionKey   =$_GET["secret"];
        $encryptedData=$_GET["codes"];

        $file_contents = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$sessionKey.'&js_code='.$encryptedData.'&grant_type=authorization_code');
        echo $file_contents;die;
    }

    public function info(){
        $openid     =htmlspecialchars(trim($_GET["openid"]));
        $telephone  =htmlspecialchars(trim($_GET["telephone"]));
        $wxname     =$_GET["wxname"];
        $headurl    =$_GET["headurl"];
        /*绑定手机提交存库*/
        //判断是否有传递openid和手机
		if(!$telephone){
			$this->pushdata(array('res'=>false,'msg'=>'请输入正确手机号','status'=>201));
		}
		if(!$openid){
			$this->pushdata(array('res'=>false,'msg'=>'未知错误','status'=>201));
		}
        //判断手机是否注册过
		if($res = K::M('member/member')->find('mobile='.$telephone)){
			//更新用户的openid
			//判断有没有传递openid
			K::M('member/member')->update($res['uid'],array('openid'=>$openid));

			$this->pushdata(array('res'=>true,'msg'=>'绑定成功','status'=>201));

		} else {
			//进行注册
			$this->pushdata(array('res'=>false,'msg'=>'请先进行注册','status'=>202));
		}

	}

    public function types(){
        $openid  =htmlspecialchars(trim($_GET["openid"]));
        $typeCtl =(int)$_GET["types"];
        $moblie = htmlspecialchars(trim($_GET["moblie"]));
		if(!in_array($typeCtl,array(1,2,3,4))){
			$this->pushdata(array('res'=>false,'msg'=>'注册类型错误'));
		}
		if(!$openid){
			$this->pushdata(array('res'=>false,'msg'=>'数据错误'));
		}

        /*注册类型 注册人的手机openid 和类型 进行给用户免费注册*/
		$fromlist = array(1=>'shang',2=>'designer',3=>'company',4=>'member');
        $data=array(
			'mobile'=>$moblie,
			'uname'=>'wx_'.$moblie,
			'openid'=>$openid,
			'from'=>$fromlist[$typeCtl],
			'passwd'=>substr($openid,0,6),
		);




		if($uid = K::M('member/account')->create_xcx($data)){

			$this->pushdata(array('res'=>true,'msg'=>'注册成功','status'=>202));
		} else {
			$this->pushdata(array('res'=>false,'msg'=>'注册失败','status'=>202));
		}
    }

    public function selects(){

        $openid     =$_GET["openid"];
		//如果有传递openid
		if($openid){
			if($res = K::M('member/member')->find("openid='$openid'")){

				//登陆
				$member = $this->auth->login_xcx($res);
				$this->pushdata(array('res'=>true,'msg'=>'登陆成功'));

			} else {
				//进行注册
				$this->pushdata(array('res'=>false,'msg'=>'改账号未注册,请先注册'));
			}
		}


        /* 用户第二次进页面 openid为条件  返回手机号 自动登录状态 可前端判断*/
    }
}