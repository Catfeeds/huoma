<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: comment.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Code extends Ctl
{
    //生成空码
    public function mkcode()
    {
        include '/static/phpqrcode/phpqrcode.php';
        $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $randStr = str_shuffle($str);
        $data['code'] = substr($randStr,0,6);
        $code = base64_encode($data['code']);
        $link = 'test?code=' . $code;
        $name = date('Ymd') . time() . rand(1000000, 9999999);
        $code_link = 'static/code/' . $name . '.png';
        QRcode::png($link, $code_link, '', 10, 2, true);
    }

}