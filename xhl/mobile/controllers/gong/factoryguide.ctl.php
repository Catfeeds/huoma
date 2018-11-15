<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 10025 2015-12-01 11:56:23  xinghuali
 */

class Ctl_Gong_Factoryguide extends Ctl
{
	public function index($page = 1)
	{
        $this->seo->init('index', $seo);
        $this->tmpl = 'mobile:gong/factoryguide.html';
	}
}