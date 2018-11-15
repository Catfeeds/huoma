<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_My extends Ctl
{
    public function index()
    {
    	$uid = $this->cookie->get('uid');
        $data = K::M('member/member')->chaxun('uid', $uid);
        $code = K::M('code/content')->chaxun('uid', $uid);
        if (!empty($code)) {
            $num = count($code);
        }
        foreach ($data as $v) {
            $name = $v;
        }
        $fangwen = K::M('code/fangwen')->chaxun('uid', $uid);
        foreach ($fangwen as $v) {
        	$fangwen_num += $v['num'];
        }
        $this->pagedata['uname'] = $name['mobile'];
        $this->pagedata['num'] = $num;
        $this->pagedata['fangwen_num'] = $fangwen_num;
    	$this->tmpl = 'my.html';
    }

    //统计
    public function tongji()
    {
    	$uid = $this->cookie->get('uid');
    	$time = 60*60*24*30;
    	$time = date('Y-m-d', time() - $time); 
    	$data = K::M('code/fangwen')->tongji('uid', $uid, $time);
    	$this->pagedata['data'] = $data;

    	$this->tmpl = 'tongji.html';
    }

    //关于我们
    public function about()
    {
    	$this->tmpl = 'about.html';
    }

    //帮助中心
    public function help()
    {
    	$this->tmpl = 'help.html';
    }

    public function shuoming()
    {
    	$this->tmpl = 'help_shuoming.html';
    }

    public function duli()
    {
    	$this->tmpl = 'index_duli.html';
    }

}