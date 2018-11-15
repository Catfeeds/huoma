<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: msgbox.mdl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

Import::M('helper/error');
class Mdl_Magic_Msgbox extends Mdl_Helper_Error
{
	
	public function response()
	{
		$request = K::$system->request;
		$objctl = &K::$system->objctl;
		if(!$tmpl = $objctl->tmpl){
			$tmpl = $objctl->pagedata['_OO_'];
		}
		if($request['MINI'] == 'load'){
			if($tmpl){
				$objctl->output();
			}else{
				$this->show($request['referer'], 'HTML');
			}
		}else if($request['XREQ']){
			if($tmpl){
				$this->_data['html'] = $objctl->output(false);
			}
			$this->show('', 'JSON');
		}else if($tmpl){
			$objctl->output();
		}else{
			$this->show($request['referer'], 'HTML');
		}
	}

}