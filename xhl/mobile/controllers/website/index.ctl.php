<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-12-01 13:02:23  xinghuali
 */

class Ctl_Website_Index extends Ctl
{
    public function index()
    {
        echo 'index';
        $this->tmpl = 'mobile:index.html';
        exit;

    }
    public function search()
    {
        echo 'search';
        exit;

    }

}