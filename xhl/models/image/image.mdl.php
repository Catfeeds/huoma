<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: image.mdl.php 2015-09-27 02:07:36  xinghuali
 */

Import::M('image/gd');
class Mdl_Image_Image extends Model
{   
	protected static $_oimg = null; 
    
    public function __construct(&$system)
    {
    	parent::__construct($system);
    	self::$_oimg = new Mdl_Image_Image();
    	self::$_oimg->params = $system->config->get('attach');
    }

    public function thumb()
    {}
}