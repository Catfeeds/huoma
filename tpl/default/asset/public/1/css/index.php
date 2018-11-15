<?php
$lxh_url = $_SERVER['HTTP_HOST']; 
if($lxh_url=='114.215.30.131' || $lxh_url=='wordhuo.com'){
 	header( "HTTP/1.1 301 Moved Permanently" );
	header('Location:http://www.wordhuo.com/');
	exit;
}
/*$lxh_arr = explode('.',$lxh_url); 
if($lxh_arr[0] !='www' and count($lxh_arr)==2){
 	header( "HTTP/1.1 301 Moved Permanently" );
	header('Location:http://www.'.$lxh_url.'/');
	exit;
}*/
define('IN_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);
require(IN_DIR.'xhl/home/index.php');
new Index();