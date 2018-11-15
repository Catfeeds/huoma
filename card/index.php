<?php
//if ($_SERVER["HTTPS"]<>"on")
//{
//    $xredir="https://".$_SERVER["SERVER_NAME"].
//        $_SERVER["REQUEST_URI"];
//    header("Location: ".$xredir);
//}
/**
 * Copy Right jisunet.com
 * $Id: index.php 2015-11-18 17:15:56  xinghuali
 */

define('IN_DIR', dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
$lxh_url = $_SERVER['HTTP_HOST'];

require_once 'cs.php';
require(IN_DIR.'xhl/card/index.php');
new Index();
?>
