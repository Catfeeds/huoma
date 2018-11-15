<?php

/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: content.ctl.php 2016-01-18 17:06:00 xinghuali $
 */
class Ctl_News_Content extends Ctl 
{   
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/content-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }
     public function index($article_id=0)
     {         
         if (!($article_id = (int) $article_id) && !($article_id = (int) $this->GP('article_id'))) {
            $this->err->add('没有该文章', 211);
        }else if (!$detail = K::M('article/view')->detail($article_id)) {
            $this->err->add('文章不存在或已经删除', 212);
        } else {
	        $cate_list = K::M('article/cate')->fetch_all();
			foreach ($cate_list as $k => $v) {
				if ($v['parent_id'] == 8 && $v['from'] == 'article') {
					$cates[$k] = $v;
				}
			}
  		    $this->pagedata['cates'] = $cates;
            K::M('article/view')->update_count($article_id,'views',1);
            $detail['content']=K::M('article/link')->filter($detail['content']);
            $this->pagedata['up_item'] = K::M('article/view')->up_item($article_id);
            $this->pagedata['next_item'] = K::M('article/view')->next_item($article_id);
            $this->pagedata['contents'] = K::M('article/view')->items(array('cat_id'=>$detail['cat_id'],'closed'=>0),array('views'=>'desc'),1,6);
            $this->pagedata['detail'] = $detail;            
            $cate = K::M('article/cate')->cate($detail['cat_id']);
            $this->pagedata['cate'] = $cate;
            $this->tmpl = 'mobile:news/content.html';
        }
    }
}
