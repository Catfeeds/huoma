<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: Android.ctl.php 2016-03-16 17:15:56  xinghuali
 */
class Ctl_Aapp extends Ctl
{ 
    public function __construct(&$system)
    {
        $uri = $system->request['uri'];
        if(preg_match('/aapp-([0-9A-Z]+).html/i', $uri, $match)){
            $system->request['act'] = 'index';
            $system->request['args'] = array($match[1]);
        }
    }
    public function index($openid=null)
    {
			$this->pagedata['openid'] = $openid;
			$this->tmpl = 'mobile:user/login.html';
    }

}