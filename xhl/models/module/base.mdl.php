<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: base.mdl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Module_Base extends Mdl_Table
{

	protected $_table = 'system_module';
	protected $_pk = 'mod_id';
	protected $_cols = 'mod_id,module,level,ctl,act,title,visible,parent_id,orderby,dateline';

	static protected $modules = null;

	public function flush()
	{
		self::$modules = null;
		return $this->cache->delete('admin/module');
	}
}