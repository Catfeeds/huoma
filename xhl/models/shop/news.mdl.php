<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: news.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Shop_News extends Mdl_Table
{   
  
    protected $_table = 'shop_news';
    protected $_pk = 'news_id';
    protected $_cols = 'news_id,shop_id,city_id,from,title,content,views,audit,clientip,dateline';
    protected $_orderby = array('news_id'=>'DESC');
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    public function items_by_shop($shop_id, $p=1, $l=50, &$count=0)
    {
        return $this->items(array('shop_id'=>$shop_id, 'audit'=>1), null, $p, $l, $count);
    }

    public function format_items_ext($items)
    {
        if(empty($items)){
            return false;
        }
        $shop_ids = array();
        foreach((array)$items as $k=>$v){
            $shop_ids[$v['shop_id']] = $v['shop_id'];
        }
        if($shop_ids){
            $shop_list = K::M('shop/shop')->items_by_ids($shop_ids);
        }
        foreach((array)$items as $k=>$v){
            $shop = array();
            if(!$shop = $shop_list[$v['shop_id']]){
                $member = array();
            }
            $v['ext'] = array('shop'=>$shop);
            $items[$k] = $v;            
        }
        return $items;
    }      
}