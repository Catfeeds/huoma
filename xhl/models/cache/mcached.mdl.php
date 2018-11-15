<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: mcached.mdl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

//源生memcached
Import::I('cache');
class Mdl_Cache_Mcached extends Memcached implements Cache_Interface
{
    

    public function __construct(&$system)
    {
        parent::__construct();
		$cfg = explode(':', __CFG::MEMCACHE);
		if($this->addServer($cfg[0], $cfg[1])){	
            trigger_error('Connect Mcache Server Fail!', E_USER_ERROR);
        }
    }

    //Memcached::set($key, $val, $ttl);
    //Memcached::get($key);
    //Memcached::delete($key)
    //Memcached::flush();
}