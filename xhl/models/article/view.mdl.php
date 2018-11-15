<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: view.mdl.php 2444 2015-11-23 07:23:01Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

Import::M('article/base');
class Mdl_article_View extends Mdl_article_Base
{   
	
	public function detail($article_id, $closed=false)
    {
        if(!$article_id = intval($article_id)){
            return false;
        }
        $where = "a.article_id='$article_id'";
        if($closed){
            $where .= " AND a.closed=0";
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('article_content')." c ON a.article_id=c.article_id WHERE $where LIMIT 1";
        if($detail = $this->db->GetRow($sql)){
            $cate = K::M('article/cate')->cate($detail['cat_id']);
            $detail['cat_title'] = $cate['title'];
        }
        return $detail;
    }
    
    public function up_item($article_id){
         $where = "a.article_id < '$article_id'";
        if($closed){
            $where .= " AND a.closed=0";
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('article_content')." c ON a.article_id=c.article_id WHERE $where order by a.article_id DESC LIMIT 1 ";
        if($detail = $this->db->GetRow($sql)){
            $cate = K::M('article/cate')->cate($detail['cat_id']);
            $detail['cat_title'] = $cate['title'];
        }
        return $detail;
    }
    
     public function next_item($article_id){
         $where = "a.article_id > '$article_id'";
        if($closed){
            $where .= " AND a.closed=0";
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('article_content')." c ON a.article_id=c.article_id WHERE $where order by a.article_id ASC LIMIT 1 ";
        if($detail = $this->db->GetRow($sql)){
            $cate = K::M('article/cate')->cate($detail['cat_id']);
            $detail['cat_title'] = $cate['title'];
        }
        return $detail;
    }
    
    public function item_by_page($page)
    {
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('article_content')." c ON a.article_id=c.article_id WHERE a.page='{$page}' LIMIT 1";
        return $this->db->GetRow($sql);
    }

    public function about($page)
    {
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('article_content')." c ON a.article_id=c.article_id WHERE a.page='{$page}' AND a.from='about' LIMIT 1";
        return $this->db->GetRow($sql);
    }

    public function help($page)
    {
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('article_content')." c ON a.article_id=c.article_id WHERE a.page='{$page}' AND a.from='help' LIMIT 1";
        return $this->db->GetRow($sql);        
    }

    public function items_by_hot($filter=array(),$limit=20)
    {
        if($filter['cat_id']){
            $filter['cat_id'] = K::M('article/cate')->children_ids($cat_id);
        }
        return parent::items_by_hot($filter, $limit);
    }

    public function items_by_new($filter=array(), $limit=20)
    {
        if($filter['cat_id']){
            $filter['cat_id'] = K::M('article/cate')->children_ids($cat_id);
        }
        return parent::items_by_new($filter, $limit);
    }

    protected function _format_row($row)
    {
    	if($cate = K::M('article/cate')->cate($row['cat_id'])){
    		$row['cat_title'] = $cate['title'];
    	}
    	return $row;
    }  
}