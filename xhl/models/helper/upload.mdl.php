<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: upload.mdl.php 2016-09-27 02:07:36  xinghuali
 */

/**
 * 上传类只支持图片格式
 *
 * 601:上传失败
 * 602:不支持的文件扩展名
 * 603:不支持的文件类型
 * 604:上传的文件太大
 * 605:
 */

class Mdl_Helper_Upload
{
    public $message = '';
    public $code = '200';
    public $succeed = true;

    private $_allow_exts = array('gif','jpg', 'png','jpeg','bmp');
    private $_allow_zip_exts = array('zip', 'tar', 'rar');
    private $_allow_file_exts = array('doc','docx','txt','pdf', 'rtf', 'xls', 'xlsx', 'ppt', 'pptx','zip',  'tar', 'rar','gif','jpg', 'png','jpeg','bmp','ai');
    private $_allow_type = array('image/gif', 'image/jpeg','image/pjpeg', 'image/png', 'image/x-png', 'image/bmp','application/octet-stream','application/msword','application/octet-stream','application/pdf','application/postscript','application/vnd.ms-excel','application/vnd.ms-powerpoint','application/x-tar','application/zip','image/bmp','image/gif','image/jpeg','image/png','image/tiff','text/plain');
    private $_check_allow_type = true;
    private $_allow_max_size = 209715200;

    public function __construct($system)
    {
        $cfg = $system->config->get('attach');
        if(is_numeric($cfg['allow_size'])){
            $this->_allow_max_size = $cfg['allow_size'] * 1024;
        }
        if($cfg['allow_exts']){
            if($_allow_exts = explode(',', $cfg['allow_exts'])){
                $this->_allow_exts = $_allow_exts;
            }
        }
        if($cfg['allow_exts_zip']){
            if($_allow_zip_exts = explode(',', $cfg['allow_exts'])){
                $this->_allow_zip_exts = $_allow_zip_exts;
            }
        }
        if($cfg['allow_exts_file']){
            if($_allow_file_exts = explode(',', $cfg['allow_exts'])){
                $this->_allow_file_exts = $_allow_file_exts;
            }
        }        
    }

    function upload(&$attach, $dir, &$fname="")
    {
        if(!$this->_check($attach)){
            return false;
        }
        K::M('io/dir')->create($dir, 0777, true);
        if(empty($fname)){
            $fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
        }
        $file = $dir.$fname;
        if(move_uploaded_file($attach['tmp_name'],$file)){
            return $this->check_safe($file);
        }else if(K::M('io/file')->move($attach['tmp_name'],$file)){
            return $this->check_safe($file);
        }else{
            K::M('helper/error')->add("上传失败",605);
            return false;
        }
    }
	
    function upload_mobile(&$attach, $dir, $dir_tmp, &$fileName="")
    {
        if(!$this->_check($attach)){
            return false;
        }
        K::M('io/dir')->create($dir, 0777, true);
        K::M('io/dir')->create($dir_tmp, 0777, true);
        if(empty($fileName)){
            $fileName = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
        }
        $file = $dir.$fname;
		usleep(5000);
		
		$targetDir = $dir_tmp;
		$uploadDir = $dir;
		
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds
		
		$md5File = @file('md5list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$md5File = $md5File ? $md5File : array();
		
		if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File ) !== FALSE ) {
	//		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
		}
		
		$filePath = $dir_tmp.$fname;
		$uploadPath = $dir.$fname;
		
		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
		
		
		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
//				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}
		
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
		
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
//			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		
		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
	//			die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}
		
			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
	//			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
	//			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
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
	//			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
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
		
		// Return Success JSON-RPC response
		//die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');		
		
		
        if(file_exists($uploadPath)){
            return $this->check_safe($uploadPath);
        }else{
            K::M('helper/error')->add("上传失败",605);
            return false;
        }
    }

    public function zip($attach, $dir, &$fname='')
    {
        $_allow_exts = $this->_allow_exts;
        $_check_allow_type = $this->_check_allow_type;
        $this->set_allow_exts($this->_allow_zip_exts);
        $this->_check_allow_type = false;
        if(!$this->_check($attach)){
            return false;
        }
        K::M('io/dir')->create($dir, 0777, true);
        if(empty($fname)){
            $fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
        }
        $file = $dir.$fname;
        if(move_uploaded_file($attach['tmp_name'],$file)){
            $ret = $file;
        }else if(K::M('io/file')->move($attach['tmp_name'],$file)){
            $ret = $file;
        }else{
            K::M('helper/error')->add("上传文件失败",605);
            $ret = false;
        }
        $this->_allow_exts = $_allow_exts;
        $this->_check_allow_type = $_check_allow_type;
        return $ret;
    }

    public function file($attach, $dir, &$fname='')
    {
        $_allow_exts = $this->_allow_exts;
        $_check_allow_type = $this->_check_allow_type;
        $this->set_allow_exts($this->_allow_file_exts);
        $this->_check_allow_type = false;
        if(!$this->_check($attach)){
            return false;
        }
        K::M('io/dir')->create($dir, 0777, true);
        if(empty($fname)){
            $fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
        }
        $file = $dir.$fname;
        if(move_uploaded_file($attach['tmp_name'],$file)){
            $ret = $file;
        }else if(K::M('io/file')->move($attach['tmp_name'],$file)){
            $ret = $file;
        }else{
            K::M('helper/error')->add("上传文件失败",605);
            $ret = false;
        }
        $this->_allow_exts = $_allow_exts;
        $this->_check_allow_type = $_check_allow_type;
        return $ret;
    }

    public function set_max_size($size)
    {
        if(!is_numeric($size) || $size>2097152 || $size< 1){
            return false;
        }
        $this->_allow_max_size = $size;
    }
    
    public function set_allow_exts($ext)
    {
        $this->_allow_exts = $ext;
    }

    public function check_safe($file)
    {
        if($data = @file_get_contents($file)){
            if(preg_match("/\<(\?php|\<\? )/is", $data)){
                K::M('helper/error')->add('不是安全的图片', 999);
                K::M('io/file')->remove($file);
                return false;
            }
            //$data = preg_replace("/(\<\?|\<\%)/i", '00', $data);
            //@file_put_contents($file, $data);
        }
        return $file;
    }

    private function _check(&$attach)
    {
        if($attach['error'] != UPLOAD_ERR_OK/* || $attach['size']<1 || !file_exists($attach['tmp_name'])*/){
            K::M('helper/error')->add("上传失败".$attach['error'],601);
            return false;
        }
        $attach['extension'] = strtolower(K::M('io/file')->extension($attach['name']));
        $attach['type'] = strtolower($attach['type']);
        if(!in_array($attach['extension'], $this->_allow_exts)){
            K::M('helper/error')->add("不支持的文件扩展名",602);
        }else if($this->_check_allow_type && !in_array($attach['type'],$this->_allow_type)){
            K::M('helper/error')->add("不支持的文件类型",603);
        }else if($attach['size']>$this->_allow_max_size){
            K::M('helper/error')->add("上传的文件太大",604);
        }else{
            return true;
        }
        return false;
    }

	function uploadcard(&$attach, $dir, &$fname="")
	{
		K::M('io/dir')->create($dir, 0777, true);
		if(empty($fname)){
			$fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
		}
		$file = $dir.$fname;
		if(move_uploaded_file($attach['tmp_name'],$file)){
			return $this->check_safe($file);
		}else if(K::M('io/file')->move($attach['tmp_name'],$file)){
			return $this->check_safe($file);
		}else{
			K::M('helper/error')->add("上传失败",605);
			return false;
		}
	}
}