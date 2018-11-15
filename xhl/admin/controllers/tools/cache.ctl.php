<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: cache.ctl.php 2016-09-27 02:07:36  xinghuali
 */

class Ctl_Tools_Cache extends Ctl
{
    
    public function index()
    {
        
    }

    public function clean()
    {
        if($this->checksubmit()){
            if($this->GP('cache_data')){
                $this->cache->flush();
            }
            $output = K::M('system/frontend');
            if($this->GP('cache_tplcache')){
                $output->clearCompiledTemplate();
            }
            $output->setCompileDir(__CFG::DIR.'data/tpladmin');
            if($this->GP('cache_tpladmin')){
                $output->clearCompiledTemplate();
            }
            $this->err->add('清空数据缓存成功');
            //$this->err->set_data('forward', '?index-welcome.html');            
        }else{
            $this->tmpl = 'admin:tools/cache/index.html';
        }
    }
}