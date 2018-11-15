<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: Android.ctl.php 2016-03-16 17:15:56  xinghuali
 */
class Ctl_IOS extends Ctl
{ 
    public function index($openid)
    {
        if(!$openid ){
            header('Location:'.K::M('helper/link')->mklink('member/member'));
            exit();
        }else{
			$this->pagedata['openid'] = $openid;
			$this->tmpl = 'mobile:user/applogin.html';
        }
		
    }

}