<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: handler.mdl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

Import::M('article/base');
class Mdl_article_Handler extends Mdl_article_Base
{   
    
    public function create($data)
    {
        if(!$data = $this->_check($data)){
            return false;
        }
        $data['dateline'] = __CFG::TIME;
        if($article_id = $this->db->insert($this->_table, $data, true)){
            K::M('article/content')->create($article_id, $this->article_ext);
        }
        return $article_id;
    }

    public function update($article_id, $data, $checked=false)
    {
        if(!$article_id = intval($article_id)){
            return false;
        }else if(!$checked && !($data = $this->_check($data,  $article_id))){
            return false;
        }
        $ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $article_id));
        if($this->article_ext){
            K::M('article/content')->update($article_id, $this->article_ext);
        }
        return $ret;
    }

    protected function _check($data, $article_id=null)
    {
        $oText = K::M('content/text');
        $oHtml = K::M('content/html');
        $article_ext = array();
        if(!$article_id || isset($data['title'])){
            if(empty($data['title'])){
                $this->err->add('标题不能为空', 431);
                return false;
            }else{
                $data['title'] = $oHtml->encode($data['title']);
            }
        }
        if(!$article_id || isset($data['content'])){
            if(empty($data['content'])){
                $this->err->add('内容不能为空', 432);
                return false;               
            }
            $this->text = $oHtml->text($data['content']);
            if($article_id || isset($data['desc'])){
                if(empty($data['desc'])){
                    $data['desc'] = preg_replace('/\s+/', '',$oText->substr($this->text, 0, 200));
                }else{
                    $data['desc'] = $oHtml->encode($data['desc']);
                }
            }
            $article_ext['content'] = $oHtml->filter($data['content']);
        }else if(isset($data['desc'])){
             $data['desc'] = $oHtml->encode($data['desc']);
        }
        if(isset($data['from'])){
            if(!in_array($data['from'], array('article', 'about', 'help', 'page'))){
                $data['from'] = 'article';
            }
        }
        if(isset($data['views'])){
            $data['views'] = (int)$data['views'];
        }
        if(isset($data['favorites'])){
            $data['favorites'] = (int)$data['favorites'];
        }
        if(isset($data['comments'])){
            $data['comments'] = (int)$data['comments'];
        }
        if(isset($data['photos'])){
            $data['photos'] = (int)$data['photos'];
        }
        if(isset($data['orderby'])){
            $data['orderby'] = (int)$data['orderby'];
        }else if(!$article_id){
            $data['orderby'] = 50;
        }
        if(isset($data['hidden'])){
            $data['hidden'] = $data['hidden'] ? 1 : 0;
        }
        if(isset($data['closed'])){
            $data['closed'] = $data['closed'] ? 1 : 0;
        }
        if(isset($data['seo_title'])){
            $article_ext['seo_title'] = $oHtml->encode($data['seo_title']);
        }
        if(isset($data['seo_keywords'])){
            $article_ext['seo_keywords'] = $oHtml->encode($data['seo_keywords']);
        }
        if(isset($data['seo_description'])){
            $article_ext['seo_description'] = $oHtml->encode($data['seo_description']);
        }
        $this->article_ext = $article_ext;
        unset($data['content'], $data['seo_title'], $data['seo_keywords'], $data['seo_description']);
        return parent::_check($data, $article_id);        
    }
}