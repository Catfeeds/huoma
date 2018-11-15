<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: user.ctl.php 10098 2015-09-29 14:44:00  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_User extends Ctl
{
    public function index()
    {
		if(IS_APP){
			$this->pagedata['app'] = $this->request['args'][1];
			$this->pagedata['openid'] = $this->request['args'][2];
			$this->tmpl = "mobile:user/applogin.html";
		}else{
			$this->seo->init('index');
			$this->tmpl = 'mobile:user/login.html';
		}
    }

    public function login()
    {
        if(!$this->checksubmit('ylz')){
            header('Location:'.K::M('helper/link')->mklink('user'));
            exit();
        }else if(!$ylz = $this->GP('ylz')){
            $this->err->add('非法的数据提交', 212);
        }else if(!$uname = $ylz['uname']){
           
             $this->err->add('用户名不正确', 213);
        }else if(!$passwd = $ylz['passwd']){
             $this->err->add('登录密码不正确', 214);
        }else{
            $verifycode_success = true;  
            $access = $this->system->config->get('access');

            if($verifycode_success){
				if(isset($ylz['app']) && isset($ylz['openid'])){
					$app = $ylz['app'];
					$openid = $ylz['openid'];
					$keep = $this->GP('keep') ? true : false;
					$keep = true;
					$a = K::M('verify/check')->mail($uname) ? 'mail' : 'uname';
					if($member = $this->auth->login($uname, $passwd, $a, false, $keep,$app,$openid)){
						$this->err->add("{$member['uname']}，欢迎您回来!");
						//var_dump($this->request['forward']);die;
						//http://localhost/user-login.html
	//                    if(!$forward = $this->request['forward']){
	//                        $forward = K::M('helper/link')->mklink('index', array(), array(), 'base');
	//                    }else if(strpos($forward,'user') !== false){
							$forward = K::M('helper/link')->mklink('member/designer:index', array(__TIME), array(), 'base');
	//                    }
						if(substr($forward, 0, 7) != 'http://'){
							$forward = '/'.trim($forward, '/');
						}
						$this->err->set_data('forward', $forward);
					}
				}else{
					$keep = $this->GP('keep') ? true : false;
					$keep = true;
					$a = K::M('verify/check')->mail($uname) ? 'mail' : 'uname';
					
					if($member = $this->auth->login($uname, $passwd, $a, false, $keep)){
						//var_dump($this->request['forward']);die;
						//http://localhost/user-login.html
	//                    if(!$forward = $this->request['forward']){
	//                        $forward = K::M('helper/link')->mklink('index', array(), array(), 'base');
	//                    }else if(strpos($forward,'user') !== false){
							$forward = K::M('helper/link')->mklink('member/designer:index', array(__TIME), array(), 'base');
	//                    }
                        header('Location:'.$forward);
                        exit;
                        $this->err->add("{$member[uname]}，欢迎您回来!");
						if(substr($forward, 0, 7) != 'http://'){
							$forward = '/'.trim($forward, '/');
						}
						$this->err->set_data('forward', $forward);
					}
				}
            }
        }
    }

    public function login_ajax()
    {
        if(!$ylz = $this->GP('ylz')){
            $info['error'] = 1;
            $info['message'] = '非法的数据提交。';
            $this->ajaxReturn($info);
        }
        if(!$uname = $ylz['mobile']){
            $info['error'] = 1;
            $info['message'] = '请输入手机号码。';
            $this->ajaxReturn($info);
        }
        if(!$passwd = $ylz['passwd']){
            $info['error'] = 1;
            $info['message'] = '请输入密码';
            $this->ajaxReturn($info);
        }
        if(isset($ylz['app']) && isset($ylz['openid'])){
            $app = $ylz['app'];
            $openid = $ylz['openid'];
            $keep = $this->GP('keep') ? true : false;
            $keep = true;
            $a = K::M('verify/check')->mail($uname) ? 'mail' : 'uname';
            if($member = $this->auth->login($uname, $passwd, $a, false, $keep,$app,$openid)){
                $this->err->add("{$member['uname']}，欢迎您回来!");
                //var_dump($this->request['forward']);die;
                //http://localhost/user-login.html
                //                    if(!$forward = $this->request['forward']){
                //                        $forward = K::M('helper/link')->mklink('index', array(), array(), 'base');
                //                    }else if(strpos($forward,'user') !== false){
                $forward = K::M('helper/link')->mklink('member/designer:index', array(__TIME), array(), 'base');
                //                    }
                if(substr($forward, 0, 7) != 'http://'){
                    $forward = '/'.trim($forward, '/');
                }
                $this->err->set_data('forward', $forward);
            }
        }else{
            $keep = $this->GP('keep') ? true : false;
            $keep = true;
            $a = K::M('verify/check')->mail($uname) ? 'mail' : 'uname';

            if($member = $this->auth->login($uname, $passwd, $a, false, $keep)){
                $info['error'] = 0;
                $info['message'] = $member['uname']."，欢迎您回来!";
                $this->ajaxReturn($info);
            }else{
                $info['error'] = 1;
                $info['message'] = $member['uname']."帐号/密码错误";
                $this->ajaxReturn($info);
            }
        }
    }


    public function minilogin()
    {
        $this->tmpl = 'view:user/minilogin.html';
    }

    public function check()
    {
        if($clientid = $this->GP('clientid')){
            $ylz = $this->GP('ylz');
            $obj = K::M('member/account');
            $oString = K::M('content/string');
            if($clientid == 'uname' && isset($ylz['uname'])){
                if($obj->check_uname($oString->unescape($ylz['uname']))){
                    $this->err->add("用户可以使用");
                }
            }else if($clientid == 'mobile' && isset($ylz['mobile'])){
                if($obj->check_mobile($oString->unescape($ylz['mobile']))){
                    $this->err->add('手机号可以使用');
                }
            }else if($clientid == 'mail' && isset($ylz['mail'])){
                if($obj->check_mail($oString->unescape($ylz['mail']))){
                    $this->err->add('邮箱可以使用');
                }
            }else{
                $this->err->add('非法的数据提交', 211);
            }
        }else{
            $this->err->add('非法的数据提交', 211);
        }
    }
	
    public function check2()
    {
        if($clientid = $this->GP('clientid')){
            $ylz = $this->GP('ylz');
            $obj = K::M('member/account');
            $oString = K::M('content/string');
            if($clientid == 'uname' && isset($ylz['uname'])){
                if($obj->check_uname($oString->unescape($ylz['uname']))){
                    $this->err->add("用户可以使用");
                }
            }else if($clientid == 'mobile' && isset($ylz['mobile'])){
                if(!$obj->check_mobile($oString->unescape($ylz['mobile']))){
                    $this->err->add('手机号可以使用');
                }else{
					 $this->err->add('手机号没有找到', 211);
				}
            }else if($clientid == 'mail' && isset($ylz['mail'])){
                if($obj->check_mail($oString->unescape($ylz['mail']))){
                    $this->err->add('邮箱可以使用');
                }
            }else{
                $this->err->add('非法的数据提交', 211);
            }
        }else{
            $this->err->add('非法的数据提交', 211);
        }
    }


    public function register($from='member')
    {   
        $from_list = K::M('member/member')->from_list();
        if(!$from_title = $from_list[$from]){
            $from_title = $from_list['member'];
            $from = 'member';
        }
        if($GUID = K::M('system/cookie')->GUID){
            $session =K::M('system/session')->start();
            $code = K::M('content/string')->random(32);
	  	    $session->set('MOBILE_VERIFY_TIME',__TIME, 300); //5分钟有效
            $session->set('MOBILE_VIMGCODE', strtoupper($code),900); //15分钟缓存
	        $this->pagedata['code'] = $code;
        }
        $pager = array('from'=>$from, 'from_title'=>$from_title);
        $this->pagedata['pager'] = $pager;
        $this->seo->init('index');
        $this->tmpl = 'mobile:user/register.html';
    }
    public function shang($cname='',$uname='',$mobile='')
    {   
		$cname = $uname = $mobile = '';
		$uri = $this->request['uri'];
		$uri = str_replace(".html", "", $uri);
		$args = explode('-', trim($uri, '-'));
		$cz_id = $args[2];
		$cname = urldecode($args[3]);
		$uname = urldecode($args[4]);
		$mobile = $args[5];
		$from_title = '参展商';
		$from = 'shang';

        $pager = array('from'=>$from, 'from_title'=>$from_title, 'cz_id'=>$cz_id,'cname'=>$cname, 'uname'=>$uname, 'mobile'=>$mobile);
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'user/shangreg.html';
    }

    public function send()
    {
		if($ylz = $this->GP('ylz')){
            if(!K::M('magic/verify')->check($ylz['code'])){
                $info['error'] = 1;
                $info['message'] = '验证码输入错误';
                $this->ajaxReturn($info);
            }
		    $member = K::M('member/member')->member($ylz['mobile'], 'mobile');
		    //找回密码时 , 帐号必须存在
            if($ylz['act'] == 'getpass' && empty($member)){
                $info['error'] = 1;
                $info['message'] = '此用户不存在';
                $this->ajaxReturn($info);
            }
            //注册时帐号不能重复
            if($ylz['act'] == 'register' && $member){
                $info['error'] = 1;
                $info['message'] = '此手机已被注册过';
                $this->ajaxReturn($info);
            }
			if($GUID = K::M('system/cookie')->GUID){
				$lanlu = $_SERVER['HTTP_REFERER'];
                $lxh_arr = explode('/',$lanlu);
                $session =K::M('system/session')->start();
                $stime = (int)$session->get('MOBILE_VERIFY_TIME');
                $code = (int)$session->get('MOBILE_VIMGCODE');
                $stime1 = (int)$session->get('MOBILE_VERIFY_TIME1');
                if(time()-$stime1<60){
                    $ajax = array(
                        'error'=>2,
                        'message'=>'请稍候再获取验证码'
                    );
                    $this->ajaxReturn($ajax);die;
                }

                $ip = gethostbyname($lxh_arr[2]);
//				if($stime && $stime < __TIME-5 && $stime > __TIME-300 && !$stime1 && $ip=='101.201.150.143' && $code==$ylz['code']){
                $code = K::M('content/string')->Random(6, 1);
//                $code = 111111;
                $session->set('MOBILE_VERIFY_CODE',$code, 1800); //30分钟有效
                $session->set('MOBILE_VERIFY_TIME1',__TIME, 180); //5分钟有效
                K::M('sms/sms')->send($ylz['mobile'],'reg_mobile',array('uname'=>$ylz['mobile'], 'verify_code'=>$code));
        //		file_put_contents('./xhl/data/send_ip.txt', __IP.'|'.$this->request['uri'].PHP_EOL, FILE_APPEND);
//				}
			}else{
				file_put_contents('./xhl/data/hei_ip.txt', __IP.'|'.$lanlu.'|'.$this->request['uri'].PHP_EOL, FILE_APPEND);
			}
		}else{
			
		}
    }


    public function loginout()
    {
        @header("Expires: -1");
        @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");
        if($this->auth->loginout()){
            $url = $this->request['forward'];
            if(empty($url) || strpos($url,'loginout') !== false){
                $cfg = $this->system->config->get('site');
                $url = $cfg['siteurl'];
            }
            //$this->err->redirect($url, 200);
            $this->err->add('您已成功退出');   
            $this->err->set_data('forward', $url);
        }else{
            $this->err->add('退出失败');   
            $this->err->set_data('forward', $url);
        }
    }

    public function forgot()
    {
		$session =K::M('system/session')->start();
        $mobile =  $session->get('MOBILE_NUM_FORGET');
        $ylz = $this->GP('ylz');
        $mobile = $ylz['mobile'];
		if($mobile){
			if(!$member = K::M('member/member')->member($mobile, 'mobile')){
					$this->err->add('该手机不存在',411);
			}else{
				if($this->checksubmit()){
					if(!K::M('verify/check')->mobile($mobile)){
						$this->err->add('手机格式不正确',411);
					}else{
                        $scode =  $session->get('MOBILE_VERIFY_CODE');
                        if($ylz['regCode'] != $scode && 0 ){
                            $this->err->add('验证码不正确', 411);
                        }else{
							$passwd = $ylz['passwd'];
							$confirmpwd = $ylz['passwd_check'];
							if($passwd != $confirmpwd){
								$this->err->add('两次输入的密码不相同',212);
							}else if(K::M('member/account')->update_passwd($member['uid'], $passwd)){
							    $forward = $this->mklink('member/designer:index');
                                header('Location:'.$forward);
								$this->err->set_data('forward', $forward);
								$this->err->add("重新设置密码成功");
							}else{
								$this->err->add('修改失败!请联系客服人员 服务热线：4001781616',212);
							}
                        }
					}
                    }else{
                        $this->pagedata['member'] = $member;
                        $this->pagedata['mobile'] = $mobile;
                        $this->tmpl = 'mobile:user/updatepw.html';
                    }
			}
		}else{
			$this->err->add('找回密码已经过期,有效性为30分钟',415);
		}
    }

    public function forgot_ajax()
    {
        $session =K::M('system/session')->start();
        $ylz = $this->GP('ylz');
        $mobile = $ylz['mobile'];
        if(!$member = K::M('member/member')->member($mobile, 'mobile')){
            $info['error'] = 1;
            $info['message'] = '该手机不存在';
            $this->ajaxReturn($info);
        }
        if(!K::M('verify/check')->mobile($mobile)){
            $info['error'] = 1;
            $info['message'] = '手机格式不正确';
            $this->ajaxReturn($info);
        }
        $scode =  $session->get('MOBILE_VERIFY_CODE');
        if($ylz['regCode'] != $scode ){
            $info['error'] = 1;
            $info['message'] = '验证码不正确';
            $this->ajaxReturn($info);
        }
        $passwd = $ylz['password'];
        $confirmpwd = $ylz['password_check'];
        if($passwd != $confirmpwd){
            $info['error'] = 1;
            $info['message'] = '两次输入的密码不相同';
            $this->ajaxReturn($info);
        }
        if(K::M('member/account')->update_passwd($member['uid'], $passwd)){
            $info['error'] = 0;
            $info['message'] = '重新设置密码成功';
            $this->ajaxReturn($info);
        }else{
            $info['error'] = 1;
            $info['message'] = '修改失败，请稍后再试';
            $this->ajaxReturn($info);
        }
    }

    public function create()
    {
        $session =K::M('system/session')->start();
        $mobile =  $session->get('MOBILE_NUM');
        if(!$ylz = $this->GP('ylz')){
            $this->err->add('非法的数据提交', 212);
        }else if(empty($mobile)){
            $this->err->add('手机验证已过期', 213);
        }else{
			$ylz['mobile'] = $mobile;
            if($uid = K::M('member/account')->create($ylz)){
                $this->err->add('恭喜您，注册会员成功');
                $from_list = K::M('member/member')->from_list();
                $ylz_from = $ylz['from'];
                if(!$from_list[$ylz_from]){
                    $ylz_from = 'member';
                }
                $forward = K::M('helper/link')->mklink('member/'.$ylz_from.':index', array(), array(), 'base');
                $this->err->set_data('forward', $forward);
            }
        }
    }

    public function create_user()
    {
        $session =K::M('system/session')->start();
        if(!$ylz = $this->GP('ylz')){
            $this->err->add('非法的数据提交', 212);
        }else{
            $ylz['uname'] = $ylz['mobile'];
            if($uid = K::M('member/account')->create($ylz)){
                $session =K::M('system/session')->start();
                $scode =  $session->get('MOBILE_VERIFY_CODE');
                if($ylz['regCode'] != $scode){
                    $this->err->add('验证码不正确', 212);
                }
                $this->err->add('恭喜您，注册会员成功');
                $from_list = K::M('member/member')->from_list();
                $ylz_from = $ylz['from'];
                if(!$from_list[$ylz_from]){
                    $ylz_from = 'designer';
                }
                $forward = K::M('helper/link')->mklink('member/'.$ylz_from.':index', array(), array(), 'base');
//                header('Location:'.$forward);
//                exit;
                $this->err->set_data('forward', $forward);
            }
        }
    }

    public function create_user_ajax()
    {
        $info = array();
        $ylz = $this->GP('ylz');
        if(!$ylz){
            $info['error'] = 1;
            $info['message'] = '非法的数据提交';
            $this->ajaxReturn($info);
        }
        $member = K::M('member/member')->member($ylz['mobile'], 'mobile');
//        echo json_encode($member);die;
        if($member){
            $info['error'] = 1;
            $info['message'] = '此手机已被注册过';
            $this->ajaxReturn($info);
        }
        $session =K::M('system/session')->start();
        $scode =  $session->get('MOBILE_VERIFY_CODE');
        if($ylz['regCode'] != $scode){
            $info['error'] = 1;
            $info['message'] = $scode;
            $this->ajaxReturn($info);
        }
        $ylz['uname'] = $ylz['mobile'];
        $uid = K::M('member/account')->create($ylz);
        if($uid){
            $info['error'] = 0;
            $info['message'] = '恭喜您，注册会员成功';
            $this->ajaxReturn($info);
        }else{
            $info['error'] = 1;
            $info['message'] = '请稍候再试';
            $this->ajaxReturn($info);
        }

    }

    
	public function service($page)
	{   
        $page = htmlspecialchars($page);
        $this->pagedata['info'] =  K::M('article/article')->item_by_page($page);
		$this->tmpl = 'mobile:user/service.html';	
    }
		
	public function reg($from='member')
		{   
			$from_list = K::M('member/member')->from_list();
			if(!$from_title = $from_list[$from]){
				$from_title = $from_list['member'];
				$from = 'member';
			}
			$pager = array('from'=>$from, 'from_title'=>$from_title);
			$this->pagedata['pager'] = $pager;
			$this->seo->init('index');
			$this->tmpl = 'mobile:user/reg.html';
		}


    public function regone($from='member')
    {     
        $from_list = K::M('member/member')->from_list();
        if(!$from_title = $from_list[$from]){
            $from_title = $from_list['member'];
            $from = 'member';
        }
        if($GUID = K::M('system/cookie')->GUID){
            $session =K::M('system/session')->start();
            $code = K::M('content/string')->random(32);
	  	    $session->set('MOBILE_VERIFY_TIME',__TIME, 600); //5分钟有效
            $session->set('MOBILE_VIMGCODE', strtoupper($code),900); //15分钟缓存
	        $this->pagedata['code'] = $code;
        }
        $pager = array('from'=>$from, 'from_title'=>$from_title);
        $this->pagedata['from'] = $from;
        $this->pagedata['pager'] = $pager;
        $this->seo->init('index');
        $this->tmpl = 'mobile:user/regis.html';
    }

    public function regtwo1111($from='member')
    {   
        $from_list = K::M('member/member')->from_list();
        if(!$from_title = $from_list[$from]){
            $from_title = $from_list['member'];
            $from = 'member';
        }
        $pager = array('from'=>$from, 'from_title'=>$from_title);
        $this->pagedata['pager'] = $pager;
        $this->seo->init('index');
        $this->tmpl = 'mobile:user/regtwo.html';
    }

    public function posttwo($from='member')
    {    
        if(!$ylz = $this->GP('ylz')){
            $this->err->add('非法的数据提交', 212);
        }else if(empty($ylz['regCode'])){
            $this->err->add('短信验证码不能为空', 213);
        }else{
			
            $access = $this->system->config->get('access');
            $session =K::M('system/session')->start();
            $scode =  $session->get('MOBILE_VERIFY_CODE');
            if($ylz['regCode'] != $scode && 0){
                $this->err->add('验证码不正确', 212);
            }else{
		  	    $session->set('MOBILE_NUM',$ylz['mobile'], 1800); //30分钟有效
				 $this->err->set_data('forward', $this->mklink('user:regtwo', array($from)));
//                header("Location: ".$this->mklink('user:regtwo'));exit;
				 $this->err->add("输入正确！");
			}
			
		}
    }
    public function postforget($from='member')
    {    
        if(!$ylz = $this->GP('ylz')){
            $this->err->add('非法的数据提交', 212);
        }else if(empty($ylz['regCode'])){
            $this->err->add('短信验证码不能为空', 213);
        }else{
			
            $access = $this->system->config->get('access');
            $session =K::M('system/session')->start();
            $scode =  $session->get('MOBILE_VERIFY_CODE');
            if($ylz['regCode'] != $scode){
                $this->err->add('验证码不正确', 212);
            }else{
		  	    $session->set('MOBILE_NUM_FORGET',$ylz['mobile'], 1800); //30分钟有效
				 $this->err->set_data('forward', $this->mklink('user:forgot', array()));
				 $this->err->add("输入正确！");
			}
			
		}
    }
    public function regtwo($from='member')
    {
        $from_list = K::M('member/member')->from_list();
        if(!$from_title = $from_list[$from]){
            $from_title = $from_list['member'];
            $from = 'member';
        }
        $pager = array('from'=>$from, 'from_title'=>$from_title);
        $this->pagedata['pager'] = $pager;
        $this->seo->init('index');
        $this->tmpl = 'mobile:user/regtwo.html';
    }

    public function forgetpw($from='member')
    {
        $from_list = K::M('member/member')->from_list();
        if(!$from_title = $from_list[$from]){
            $from_title = $from_list['member'];
            $from = 'member';
        }
         if($GUID = K::M('system/cookie')->GUID){
            $session =K::M('system/session')->start();
            $code = K::M('content/string')->random(32);
	  	    $session->set('MOBILE_VERIFY_TIME',__TIME, 600); //5分钟有效
            $session->set('MOBILE_VIMGCODE', strtoupper($code),900); //15分钟缓存
	        $this->pagedata['code'] = $code;
        }
       $pager = array('from'=>$from, 'from_title'=>$from_title);
        $this->pagedata['pager'] = $pager;
        $this->seo->init('index');
        $this->tmpl = 'mobile:user/forgetpassword.html';
    }


    /**
     * 第三方登录
     */
    public function sso($from='qq')
    {
        echo "success";
        exit;
    }    
    
    //QQ 联合登录
    public function qqlogin($type=null)
    {
        if($url = K::M('member/qqlogin')->qqloign_url($type)){
            header("Location: {$url}");
            die;
        }
        
    }
    
    public function qqcallback()
    {
        if(!$code = $this->GP('code')){
            die('回传地址有问题2');
        }elseif(!$state = $this->GP('state')){
            die('回传地址有问题1');
        }elseif(true == K::M('member/qqlogin')->qqcallback($code,$state)){        
            $forward = K::M('helper/link')->mklink('member/member:index', array(), array(), 'base');
            header("Location: {$forward}");
            die;
        }     
    }
    
    
    public function weibo($type=null)
    {
        if($url = K::M('member/weibo')->weibo_url($type)){
            header("Location: {$url}");
            die;
        }
    }
    
    public function weibocallback()
    {
        if(!$code = $this->GP('code')){
            die('回传地址有问题2');
        }if(true == K::M('member/weibo')->weibocallback($code)){        
            $forward = K::M('helper/link')->mklink('member/member:index', array(), array(), 'base');
            header("Location: {$forward}");
           die;
        }     
    }

    public function verfiy($type = 'mail',$uid = 0 ,$token = null)
    {
  
        if(!($uid=(int)$uid) || empty($token)){
            $this->err->add('参数有误', 211);
        }else{
            if(!$member = K::M('member/view')->member($uid)){
                $this->err->add('用户ID不存在！', 201);
            }else if (K::M('system/integral')->check('email',$member) === false) {
                $this->err->add('很抱歉您的账户余额不足！', 201);
            }else{   
                if(K::M('member/magic')->verify_mail($uid,$token)){
                    K::M('system/integral')->commit('email', $member,'用户邮箱认证');
                    $this->err->add('邮箱验证成功！');
                    $this->err->set_data('forward',  K::M('helper/link')->mklink('member/member:index', array(), array(), 'base'));
                }else{
                    $this->err->add('邮箱验证失败！', 201);
                    $this->err->set_data('forward',  K::M('helper/link')->mklink('member/member:index', array(), array(), 'base'));
                }
            }            
        }        
    }
    public function verify()
    {
        K::M('magic/verify')->output();
    }

}