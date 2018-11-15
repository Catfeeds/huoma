<?php
// +----------------------------------------------------------------------
// | layerIM + Workerman + ThinkPHP5 即时通讯
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\mobile\controller;

use think\Controller;
use think\Request;

class Login extends Controller
{

    public function index()
    {
        $uid = cookie('uid');
        if($uid == '' && isset($_COOKIE['uid'])){
            $uid = $_COOKIE['uid'];
        }
        if($uid){
            $userinfo = db('member')->where('uid', $uid)->find();
            $url = url('login/doLogin',array('id'=>input('id')))."?username=".$userinfo['uname']."&pwd=".$userinfo['passwd'];
            echo "<script>window.location.href='".$url."'</script>";
        }
        return $this->fetch();
    }
    
    public function doLogin()
    {
    	$uname = input('param.username');
        $userinfo = db('chatuser')->where('username', $uname)->find();

        // 如果xhl_member表中有这个用户 复制一份出来
        $member = db('member')->where('uname', $uname)->find();
        if($member){
            $member['face'] = $member['face']?$member['face']:"face/face.jpg";
            $designer = db('designer')->where('uid',$member['uid'])->find();
            $member['face'] = $member['face']?$member['face']:"face/face.jpg";
            $data = array(
                'id'=>$member['uid'],
                'username'=>$member['uname'],
                'pwd'=>$member['passwd'],
                'status'=>'online',
                'sign'=>strip_tags($designer['about']),
                'avatar'=>config('attach_url') . $member['face'],
                'groupid'=>1
            );
            if($userinfo){
                db('chatuser')->where('id',$member['uid'])->update($data);
            }else{
                db('chatuser')->insert($data);
            }
            $userinfo = $data;
        }


        if( empty($userinfo) ){
            $this->error("用户不存在");
        }

        $pwd = input('param.pwd');
		if( $pwd != $userinfo['pwd'] && md5($pwd) != $userinfo['pwd'] ){
            $this->error("密码不正确");
        }
    	
    	//设置为登录状态
    	db('chatuser')->where('username', $uname)->setField('status', 'online');
    	
    	cookie( 'uid', $userinfo['id'] );
    	cookie( 'username', $userinfo['username'] );
        cookie( 'avatar', $userinfo['avatar'] );
        cookie( 'sign', $userinfo['sign'] );
        $_COOKIE['uid'] = $userinfo['id'];
    	$this->redirect(url('index/index',array('id'=>input('id'))));
    }
    
}
