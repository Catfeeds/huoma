<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: cache.mdl.php 9863 2015-04-23 09:49:29  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Cache_Cache
{   
	public $__CACHE = array();
	public $cache = null;

	public function __construct()
	{
        Import::M('cache/file');
        if(defined('__CFG::CACHE_FILE_SIZE')){
            $this->cache = new Mdl_Cache_File(array('CACHE_SIZE'=>__CFG::CACHE_FILE_SIZE));
        }else{
            $this->cache = new Mdl_Cache_File(array('CACHE_SIZE'=>'32M'));
        }
	}
    
    public function set($key, $val, $ttl=0)
    {
        $ttl = intval($ttl);
        $this->__CACHE[$key] = $val;
        if($ttl < 0  ){
            return false;
        }        
    	return $this->cache->set($key, $val, $ttl);
    }

    public function get($key)
    {

        if($data = $this->__CACHE[$key]){
            return $data;
        }
    	return $this->cache->get($key);
    }

    public function delete($key)
    {
        unset($this->__CACHE[$key]);
    	return $this->cache->delete($key);
    }

    public function flush()
    {
        $this->__CACHE = array();
    	return $this->cache->flush();
    }

    public function clean()
    {
        $this->__CACHE = array();
        $this->cache->clean();
    }
}