<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: about.ctl.php 9797 2015-04-22 02:52:25Z xinghuali $
 */

class Ctl_About_Index extends Ctl 
{   
     public $_call = 'index';
     public function index($page)
     {         
        $page = htmlspecialchars($page);
        //$city_id = $this->request['city_id'];
        $this->pagedata['info'] =  K::M('article/article')->item_by_page($page);
        //var_dump($this->pagedata['info']) ;die;
        if(empty($this->pagedata['info'])){
            $this->err->add('没有您要查看的内容', 211);
        }else{
            $items =  K::M('article/article')->items(array('from'=>'about','closed'=>0),array('article_id'=>'ASC'),1,50); 
            $article_id = $this->pagedata['info']['article_id'];            
            $detail = K::M('article/article')->detail($article_id,$city_id,false);
            $this->pagedata['cate_list'] = K::M('article/cate')->fetch_all();
            $this->pagedata['page'] = $page;
            $this->pagedata['items'] = $items;
            //var_dump($items);die;
            $this->pagedata['detail'] = $detail;
            $cate = K::M('article/cate')->cate($this->pagedata['info']['cat_id']);
            $this->seo->init('article_detail',array(
                'title'         =>   $this->pagedata['info']['title'],
                'cate_title'        =>$cate['title'],
                'cate_seo_title'    => $cate['seo_title'],
                'cate_seo_keywords' => $cate['seo_keywords'],
                'cate_seo_description' => $cate['seo_description']               
            ));
            $this->tmpl = 'mobile:about/index.html';
        }
     }       
}