<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: upload.ctl.php 2016-09-27 02:07:36  xinghuali
 */

class Ctl_Magic_Upload extends Ctl
{
    
    public function index()
    {
        
    }

    public function editor()
    {
    	if(!$attach = $_FILES['imgFile']){
    		$this->err->add('上传文件失败', 211);
    	}else if(UPLOAD_ERR_OK != $attach['error']){
    		$this->err->add('上传文件失败', 212);
    	}else if($data = K::M('magic/upload')->xheditor($attach)){
    		$cfg = $this->system->config->get('attach');
    		$this->err->set_data('url', $cfg['attachurl'].'/'.$data['photo'].'?PID'.$data['photo_id']);
    	}
        $this->err->json();
    }
}