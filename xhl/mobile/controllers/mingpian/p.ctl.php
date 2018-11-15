<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: hui.ctl.php 2015-12-01 14:56:23  xinghuali
 */

class Ctl_Mingpian_P extends Ctl
{
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/p-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }

   public function index($mingpian_id)
    {
        $mingpian = K::M('mingpian/mingpian')->detail($mingpian_id);
        $this->pagedata['mingpian'] = $mingpian;
        $this->tmpl = 'mobile:mingpian/mp.html';
    }

}