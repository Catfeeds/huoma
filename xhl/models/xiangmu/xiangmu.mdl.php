<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: xiangmu.mdl.php 9581 2015-04-08 13:25:34Z maoge $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xiangmu_Xiangmu extends Mdl_Table
{   

    protected $_table = 'xiangmu';
    protected $_pk = 'xiangmu_id';
    protected $_cols = 'xiangmu_id,cat_id,from,page,title,thumb,yuyan,hangye,chajian,huanjing,ontime,size,xingzhi,gurl,xnum,url,linkurl,desc,views,favorites,comments,orderby,dateline,audit,hidden,closed,uid,infourl,xmprice,teamid,check_str,ischeck,content,seo_keywords,photo,introduce';
    protected $_orderby = array('orderby'=>'ASC', 'xiangmu_id'=>'DESC');

    protected $_hot_orderby = array('views'=>'DESC', 'orderby'=>'ASC');
    protected $_hot_filter = array('from'=>'xiangmu','hidden'=>'0', 'audit'=>'1', 'closed'=>'0');
    protected $_new_orderby = array('xiangmu_id'=>'DESC');
    protected $_new_filter = array('from'=>'xiangmu','hidden'=>'0', 'audit'=>'1', 'closed'=>'0');

    protected $_page_sep = '<hr style="page-break-after:always;" class="ke-pagebreak" />';
    
    public function create($data)
    {
        if(!$data = $this->_check($data)){
            return false;
        }
        $data['dateline'] = __CFG::TIME;
        if($xiangmu_id = $this->db->insert($this->_table, $data, true)){
            K::M('xiangmu/content')->create($xiangmu_id, $this->xiangmu_ext);
            //正则获取thumb,photoIds
            if(preg_match_all("/(photo\/\d+\/\d{8}_[\dA-F]{32}\.(jpg|gif|png|jpeg))\?PID(\d+)/i", $this->xiangmu_ext['content'], $matches)){
                $a = array();
                if(empty($data['thumb'])){
                    $a['thumb'] = $matches[1][0].'_thumb.jpg';
                }
                $pids = implode(',',$matches[3]); //组合photoId为字符串 
                if($count = K::M('xiangmu/photo')->update_by_xiangmu($xiangmu_id, $pids)){
                    $a['photos'] = $count;
                }
                if($a){
                    $this->update($xiangmu_id, $a);
                }
            }            
        }
        return $xiangmu_id;
    }

    public function update($xiangmu_id, $data, $checked=false)
    {
        if(!$xiangmu_id = intval($xiangmu_id)){
            return false;
        }else if(!$checked && !($data = $this->_check($data,  $xiangmu_id))){
            return false;
        }
        $ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $xiangmu_id));
        if($this->xiangmu_ext){
            K::M('xiangmu/content')->update($xiangmu_id, $this->xiangmu_ext);
        }
        return $ret;
    }

    public function detail($xiangmu_id, $closed=false)
    {
        if(!$xiangmu_id = intval($xiangmu_id)){
            return false;
        }
        $where = "a.xiangmu_id='$xiangmu_id'";
        if($closed){
            $where .= " AND a.closed=0";
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('xiangmu_content')." c ON a.xiangmu_id=c.xiangmu_id WHERE $where LIMIT 1";
        if($detail = $this->db->GetRow($sql)){
            $cate = K::M('xiangmu/cate')->cate($detail['cat_id']);
            $detail['cat_title'] = $cate['title'];
        }
        //分页处理
        $detail['content_list'] = explode($this->_page_sep, $detail['content']);
        $detail['content_count'] = count($detail['content_list']);
        return $detail;
    }

    public function xiangmudetail($xiangmu_id, $closed=false)
    {
        if(!$xiangmu_id = intval($xiangmu_id)){
            return false;
        }
        $where = "a.xiangmu_id='$xiangmu_id'";
        if($closed){
            $where .= " AND a.closed=0";
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('xiangmu_comment')." c ON a.xiangmu_id=c.xiangmu_id WHERE $where LIMIT 1";
        if($xiangmudetail = $this->db->GetRow($sql)){
            $cate = K::M('xiangmu/cate')->cate($xiangmudetail['cat_id']);
            $xiangmudetail['cat_title'] = $cate['title'];
        }
        //分页处理
        return $xiangmudetail;
    }
    
    public function prev_item($xiangmu_id, $cat_id=0)
    {
        $where = '';
        if(!$xiangmu_id = (int)$xiangmu_id){
            return false;
        }else if($cat_id = (int)$cat_id){
            $where = "cat_id='{$cat_id}' AND ";
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where xiangmu_id<$xiangmu_id AND `from`='xiangmu' AND closed=0 ORDER BY xiangmu_id DESC LIMIT 1";
        return $this->db->GetRow($sql);  
    }

    public function next_item($xiangmu_id, $cat_id=0)
    {
        $where = '';
        if(!$xiangmu_id = (int)$xiangmu_id){
            return false;
        }else if($cat_id = (int)$cat_id){
            $where = "cat_id='{$cat_id}' AND ";
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where xiangmu_id>$xiangmu_id AND `from`='xiangmu' AND closed=0 ORDER BY xiangmu_id ASC LIMIT 1";
        return $this->db->GetRow($sql);
    }
        
    public function item_by_page($page,$city_id=0)
    {
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $where = "a.page='{$page}' AND a.closed='0'";
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a  LEFT JOIN ".$this->table('xiangmu_content')." c ON a.xiangmu_id=c.xiangmu_id  WHERE $where";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

    public function detail_by_page($page, $city_id=0)
    {
        return $this->item_by_page($page,$city_id);
    }

    public function about($page, $city_id=0)
    {
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('xiangmu_content')." c ON a.xiangmu_id=c.xiangmu_id WHERE a.page='{$page}' AND a.from='about' LIMIT 1";
        return $this->db->GetRow($sql);
    }

    public function help($page, $city_id=0)
    {
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $sql = "SELECT c.*,a.* FROM ".$this->table($this->_table)." a LEFT JOIN ".$this->table('xiangmu_content')." c ON a.xiangmu_id=c.xiangmu_id WHERE a.page='{$page}' AND a.from='help' LIMIT 1";
        return $this->db->GetRow($sql);        
    }


    protected function _format_row($row)
    {
        if($cate = K::M('xiangmu/cate')->cate($row['cat_id'])){
            $row['cat_title'] = $cate['title'];
        }
        if(empty($row['thumb'])){
            $row['thumb'] = 'default/xiangmu_thumb.jpg';
        }
        return $row;
    }

    protected function _check($data, $xiangmu_id=null)
    {
        $oText = K::M('content/text');
        $oHtml = K::M('content/html');
        $xiangmu_ext = array();
        if(!$xiangmu_id || isset($data['title'])){
            if(empty($data['title'])){
                $this->err->add('标题不能为空', 431);
                return false;
            }else{
                $data['title'] = $oHtml->encode($data['title']);
            }
        }
        if(!$xiangmu_id || isset($data['content'])){
            if(empty($data['content'])){
                $this->err->add('内容不能为空', 432);
                return false;               
            }
            $this->text = $oHtml->text($data['content']);
            if($xiangmu_id || isset($data['desc'])){
                if(empty($data['desc'])){
                    $data['desc'] = preg_replace('/\s+/', '',$oText->substr($this->text, 0, 200));
                }else{
                    $data['desc'] = $oHtml->encode($data['desc']);
                }
            }
            $xiangmu_ext['content'] = $oHtml->filter($data['content']);
        }else if(isset($data['desc'])){
             $data['desc'] = $oHtml->encode($data['desc']);
        }
        if(isset($data['from'])){
            if(!in_array($data['from'], array('xiangmu', 'about', 'help', 'page'))){
                $data['from'] = 'xiangmu';
            }
        }
        if(isset($data['ontime'])){
            if(preg_match("/^\d{4}-\d{1,2}-\d{1,2}( \d{1,2}:\d{1,2}:\d{1,2})?$/i", $data['ontime'])){
                $data['ontime'] = strtotime($data['ontime']);
            }else{
                $data['ontime'] = 0;
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
        }else if(!$xiangmu_id){
            $data['orderby'] = 50;
        }
        if(isset($data['linkurl'])){
            if(!K::M('verify/check')->url($data['linkurl'])){
                $data['linkurl'] = '';
            }
        }
        if(isset($data['hidden'])){
            $data['hidden'] = $data['hidden'] ? 1 : 0;
        }
        if(isset($data['closed'])){
            $data['closed'] = $data['closed'] ? 1 : 0;
        }
        if(isset($data['seo_title'])){
            $xiangmu_ext['seo_title'] = $oHtml->encode($data['seo_title']);
        }
        if(isset($data['seo_keywords'])){
            $xiangmu_ext['seo_keywords'] = $oHtml->encode($data['seo_keywords']);
        }
        if(isset($data['seo_description'])){
            $xiangmu_ext['seo_description'] = $oHtml->encode($data['seo_description']);
        }
        $this->xiangmu_ext = $xiangmu_ext;
//        unset($data['content'], $data['seo_title'], $data['seo_keywords'], $data['seo_description']);
        unset( $data['seo_title'], $data['seo_description']);
        return parent::_check($data, $xiangmu_id);        
    }

    public function photofetch($data)
    {
        $p = implode(",", $data);
        return $p;
    }

    public function delete($xiangmu_id)
    {

         $sql = "DELETE FROM ".$this->table($this->_table)." WHERE xiangmu_id= ".$xiangmu_id;
         return $this->db->Execute($sql);   

    }

     public function xiangmu_all($uid)
    {   

        if($uid){

            $where = " where uid = ".$uid;
            $sql = "SELECT * FROM ".$this->table($this->_table).$where;
               if($rs = $this->db->Execute($sql)){
                    while($row = $rs->fetch()){
                      $items[$row[$this->_pk]] = $row;
                    }
                }
        }else{

            $sql = "SELECT * FROM ".$this->table($this->_table);
               if($rs = $this->db->Execute($sql)){
                    while($row = $rs->fetch()){
                      $items[$row[$this->_pk]] = $row;
                    }
                }
        }

        
        return $items;       

    }





    public function list_all($info)
    {
        //
        if($info){
           if($info['yuyan'] > 0){
              $where1 = " yuyan = ".$info['yuyan'];
                
           }

           if ($info['introduce'] > 0) {
                if($info['yuyan'] > 0){
                    $where2 = " and introduce = ".$info['introduce'];
                }else{
                     $where2 = " introduce = ".$info['introduce'];

                }
              
               
           }

           if ($info['hangye'] > 0) {
                if($info['yuyan'] > 0 or $info['introduce'] > 0){
                     $where3 = " and hangye = ".$info['hangye'];
                }else{
                     $where3 = " hangye = ".$info['hangye'];
                }
              
               
           }

           $where = $where1.$where2.$where3;

           $sql = "SELECT * FROM ".$this->table($this->_table)." where ".$where." order by xiangmu_id desc";
               if($rs = $this->db->Execute($sql)){
                    while($row = $rs->fetch()){
                      $items[$row[$this->_pk]] = $row;
                    }
                }

            
        }else{

              $sql = "SELECT * FROM ".$this->table($this->_table)." order by xiangmu_id desc";
               if($rs = $this->db->Execute($sql)){
                    while($row = $rs->fetch()){
                      $items[$row[$this->_pk]] = $row;
                    }
                }

        }

        return $items;
    }

}