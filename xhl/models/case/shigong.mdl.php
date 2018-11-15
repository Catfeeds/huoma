<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: shigong.mdl.php 2016-1-13 14:11:00  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Case_Shigong extends Mdl_Table
{   
  
    protected $_table = 'case_shigong';
    protected $_pk = 'shigong_id';
    protected $_cols = 'shigong_id,case_id,title,photo,size,orderby';
    protected $_orderby = array('orderby'=>'ASC', 'shigong_id'=>'DESC');

    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($shigong_id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data,  $shigong_id)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $shigong_id));
    }

    public function upload($case_id, $attach)
    {
        if(!UPLOAD_ERR_OK == $attach['error']){
            $this->err->add('上传文件失败',201);
            return false;
        }
        $cfg = K::$system->config->get('attach');
        $B = 'shigong/'.date('Ym/',__CFG::TIME);
        $D = $cfg['attachdir'].$B;
        if(!$F = K::M('helper/upload')->upload($attach, $D, $fname)){
            return false;
        }
        $oImg = K::M('image/gd');
        $thumbs = $size = array();
        $size['small'] = 200;
        $thumbs = array($size['small']=>"{$D}/{$fname}_small.jpg");
        $oImg->thumbs($F, $thumbs);
        $data = array();
        $data['case_id'] = (int)$case_id;
        if(!$data['title'] = $attach['title']){
            $data['title'] = preg_replace("/\.(jpg|jpeg|png|gif|bmp)$/i", '', $attach['name']);
        }
        $data['title'] = K::M('content/html')->encode($data['title']);
        $data['photo'] = $B.$fname;
        $data['size'] = $attach['size'];
        if($shigong_id =$this->db->insert($this->_table, $data, true)){
            $data['shigong_id'] = $shigong_id;
            return $data;
        }
        return false; 
    }

    public function items_by_case($case_id, $p=1, $l=50, &$count=0)
    {
        if(!$case_id = (int)$case_id){
            return false;
        }
        return $this->items(array('case_id'=>$case_id), $this->_orderby, $p, $l, $count);
    }

    public function count_by_case($case_id)
    {
        if(!$case_id = (int)$album_id){
            return false;
        }
        $sql = "SELECT case_id, COUNT(1) photos, SUM(`size`) size FROM ".$this->table($this->_table)." WHERE case_id='$case_id' ";
        return $this->db->GetRow($sql);
    }

    public function delete($pids, $force=false)
    {
        $ret = false;
        if(empty($pids)){
            return false;
        }else if(!$items = $this->items_by_ids($pids)){
            return false;
        }
        $albums = $shops = $shigong_ids = array();
        foreach($items as $item){
   			@unlink('czfiles/'.$item['photo'].'_small.jpg');
			@unlink('czfiles/'.$item['photo']);
            $shigong_ids[] = $item['shigong_id'];
        }
        if(!empty($shigong_ids)){
                $sql = "DELETE FROM ".$this->table($this->_table)." WHERE " . self::field($this->_pk, $shigong_ids);
                $ret = $this->db->Execute($sql);
        }
        return $ret;      
    }

	
	function phone_count($val){
	   $count = 0;
	   $sql = "SELECT case_id, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('case_id', $val)." GROUP BY case_id";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                K::M('case/case')->update($row['case_id'], array('phones'=>$row['c']), true);
                $count ++;
            }
        }
        return $count;
	}

    public function _check($data, $shigong_id=null)
    {
        unset($data['shigong_id'],  $data['clientip'], $data['dateline']);
        $ohtml = K::M('content/html');
        if(isset($data['photo'])){
            $data['photo'] = $ohtml->encode($data['photo']);
        }
        if(isset($data['title'])){
            $data['title'] = $ohtml->text($data['title']);
        }
        if(isset($data['case_id'])){
            $data['case_id'] = (int)$data['case_id'];
        }
        if(isset($data['size'])){
            $data['size'] = (int)$data['size'];
        }
        return parent::_check($data);        
    } 
}