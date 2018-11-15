<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: guan.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */

class Ctl_Guan_Chang extends Ctl
{
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/chang-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }    

    public function index($guan_id)
    {
        $guan = $this->check_guan($guan_id);
		$photos = $filter = array();
        $filter['guan_id'] = $guan_id;
        $filter['type'] = 1;
		$photos = K::M('guan/photo')->items($filter);
		$this->pagedata['photos'] = $photos;
        $this->seo->set_company($guan);
		//参展计划
		$gnews = K::M('guan/news')->items($filter);
		$this->pagedata['gnews'] = $gnews;
		//已办过多少展
		$gzhan = K::M('zhan/zhan')->gitems('guan_id = '.$guan_id);
		$this->pagedata['gzhan'] = $gzhan;
		
        K::M('guan/guan')->update_count($guan_id, 'views', 1);  
       
        $seo = array('guan_name'=>$guan['name'], 'guan_title'=>$guan['title'],'guan_desc'=>'');
        $seo['guan_desc'] = K::M('content/text')->substr(K::M('content/html')->text($guan['content'], true), 0, 200);
        $this->seo->init('guan_detail', array('guan_title' => $guan['title'],'guan_desc' => $seo['guan_desc']));
        
        $this->tmpl = 'mobile:guan/chang.html';
    }
	
 
    protected function check_guan($guan_id)
    {
        if(!$guan_id = (int)$guan_id){
            $this->error(404);
        }else if(!$guan = K::M('guan/guan')->detail($guan_id)){
            $this->error(404);
        }else if(empty($guan['audit'])){
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }
        $this->pagedata['guan'] = $guan;
        return $guan;
    }
}