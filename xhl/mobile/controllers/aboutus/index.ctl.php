<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 10025 2016-05-05 16:20:23  xinghuali
 */

class Ctl_Aboutus_Index extends Ctl
{
	public function index($page = 1)
	{
        $this->tmpl = 'mobile:Aboutus/index.html';
	}
}