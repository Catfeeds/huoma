<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Index extends Ctl
{
    public function index()
    {
        $uid = $this->cookie->get('uid');
        $data = K::M('member/member')->chaxun('uid', $uid);
        foreach ($data as $v) {
        	$name = $v;
        }
        $this->pagedata['uname'] = $name['mobile'];
        
    	$this->tmpl = 'index.html';
    }

}