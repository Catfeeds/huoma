<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: up.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Up extends Ctl 
{
    private  $ext ='jpg,png,doc,docx,xls,xlsx,ppt,pptx,rar,zip,7z,pdf';
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/up-([\d]+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);
       }
    }
    public function index($size_photo=null)
    {
		if (!empty($_FILES)) {
			
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		
        $ym = date('Ym', __CFG::TIME);
        $cfg = K::$system->config->get('attach');
        $targetDir = $cfg['attachdir'].'photo/tmp/';
        $uploadDir = $cfg['attachdir'].'photo/'.$ym.'/';
		$ext = substr(strrchr($_FILES["file"]["name"], '.'), 1);
		$fileName = date('Ymd_').strtoupper(md5(microtime().rand())).".$ext";
        $photo = 'photo/'.$ym.'/'.$fileName;
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		
		// Uncomment this one to fake upload time
		usleep(5000);
		
		
		
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds
		
		
		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}
		
		// Create target dir
		if (!file_exists($uploadDir)) {
			@mkdir($uploadDir);
		}
		

		$md5File = @file('md5list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$md5File = $md5File ? $md5File : array();
		
		if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File ) !== FALSE ) {
			die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
		}
		
		$filePath = $targetDir . '/' . $fileName;
		$uploadPath = $uploadDir . '/' . $fileName;
		
		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
		
		
		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}
		
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . '/' . $file;
		
				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
					continue;
				}
		
				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}
		
		
		// Open temp file
		if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		
		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}
		
			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}
		
		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}
		
		@fclose($out);
		@fclose($in);
		
		rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
		
		$index = 0;
		$done = true;
		for( $index = 0; $index < $chunks; $index++ ) {
			if ( !file_exists("{$filePath}_{$index}.part") ) {
				$done = false;
				break;
			}
		}
		if ( $done ) {
			if (!$out = @fopen($uploadPath, "wb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			}
		
			if ( flock($out, LOCK_EX) ) {
				for( $index = 0; $index < $chunks; $index++ ) {
					if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
						break;
					}
		
					while ($buff = fread($in, 4096)) {
						fwrite($out, $buff);
					}
		
					@fclose($in);
					@unlink("{$filePath}_{$index}.part");
				}
		
				flock($out, LOCK_UN);
			}
			@fclose($out);
		}
		
			if($size_photo){
				if($size_photo==200){
					$size_photo='200X100';
					K::M('image/gd')->thumbs($uploadPath, array($size_photo => $uploadPath));
				}elseif($size_photo==600){
					$size_photo='600X600';
					K::M('image/gd')->thumbs($uploadPath, array($size_photo => $uploadPath));
				}elseif($size_photo==1000){
					$cfg = K::$system->config->get('attach');
					$oImg = K::M('image/gd');
					$thumbs = $size = array();
					$size['photo'] = $cfg['casephoto']['photo'] ? $cfg['casephoto']['photo'] : '2000';
					$size['thumb'] = $cfg['casephoto']['thumb'] ? $cfg['casephoto']['thumb'] : '1000';
					$size['small'] = $cfg['casephoto']['small'] ? $cfg['casephoto']['small'] : '400X260';
					$thumbs = array($size['photo']=>"{$uploadPath}_expo.jpg",$size['thumb']=>"{$uploadPath}", $size['small']=>"{$uploadPath}_small.jpg");
					$oImg->thumbs($uploadPath, $thumbs);
					if($cfg['casephoto']['watermark']){
						$uname = $attach['uname'] ? $attach['uname'] : 'LXH';
						$oImg->watermark("{$uploadPath}", $uname);
						$oImg->watermark2("{$uploadPath}_expo.jpg", $uname);
					}
				}
			}
		$a = array('size'=>$_FILES["file"]['size'], 'photo'=>$photo,'name'=>$_FILES["file"]['name'], 'type'=>$_FILES["file"]['type']);
		echo json_encode($a);
		exit;
 	   }

	}
}