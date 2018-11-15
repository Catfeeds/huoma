<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: file.mdl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_IO_File
{
	static public function create($file,$over=false)
	{
        if(file_exists($file) && !$over){
            return false;
        }else if(file_exists($file) && $over){
            self::remove($file);
        }
		K::M('io/dir')->create(dirname($file));
        touch($file);
        return true;		
	}

	static public function copy($source,$target,$over=false)
	{
        if (!file_exists($source)) {
            return false;
        }
        if (file_exists($target) && $over==false) {
            return false;
        } elseif (file_exists($target) && $over==true) {
            self::remove($target);
        }
		K::M('io/dir')->create(dirname($target));
        copy($source, $target);
        return true;		
	}

	static public function move($source,$target,$over=false)
	{
        if(!file_exists($source)){
            return false;
        }
        if(file_exists($target) && $over = false){
            return false;
        }else if(file_exists($target) && $over = true) {
            self::remove($target);
        }
		K::M('io/dir')->create(dirname($target));
        @rename($source, $target);
        return true;		
	}

	static public function remove($file)
	{
        if (file_exists($file)) {
            @unlink($file);
            return true;
        } else {
            return false;
        }		
	}

	static function extension($file)
	{
		return trim(substr(strrchr($file, '.'), 1, 10));
	}
}