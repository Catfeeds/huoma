<?php
/**
 * Copy Right jisunet.com
 * $Id: index.php 2015-11-18 17:15:56  xinghuali
 */
define('IN_DIR', dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
$lxh_url = $_SERVER['HTTP_HOST']; 
$isapp=0;
if($lxh_url=='app.xhl.com' || $lxh_url=='app.jisunet.com'){
	$isapp=1;
}
define('IS_APP', $isapp);
require_once 'cs.php';
require(IN_DIR.'xhl/mobile/index.php');
new Index();
?>
