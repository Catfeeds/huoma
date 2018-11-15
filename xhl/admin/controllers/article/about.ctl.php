<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: about.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

require(dirname(__FILE__).'/article.ctl.php');
class Ctl_Article_About extends Ctl_Article_Article
{
    protected $article_from = 'about';
}