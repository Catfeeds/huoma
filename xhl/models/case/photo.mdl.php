<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: photo.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Case_Photo extends Mdl_Table
{   
  
    protected $_table = 'case_photo';
    protected $_pk = 'photo_id';
    protected $_cols = 'photo_id,group,case_id,title,photo,size,views,orderby,closed,clientip,dateline';
    protected $_orderby = array('photo_id'=>'ASC');
    protected $_type = array('1'=>'效果图', '2'=>'报馆图', '3'=>'施工图', '4'=>'3D模型');

    protected $_hot_orderby = array('likes'=>'DESC', 'views'=>'ASC');
    protected $_hot_filter = array('closed'=>'0');
    protected $_new_orderby = array('photo_id'=>'DESC');
    protected $_new_filter = array('closed'=>'0');

    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($photo_id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data,  $photo_id)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $photo_id));
    }

    public function upload_daoru($case_id, $attach)
    {
		$cfg = K::$system->config->get('attach');
		foreach($attach['photo'] as $val){
			$val = str_replace('/czfiles/','',$val);
			$url_arr = explode('/',$val);
			$exp_arr = explode('.',$url_arr[count($url_arr)-1]);

	        $B = 'anli/'.date('Ym/',__CFG::TIME);
			$D = $cfg['attachdir'].$B;
			$fname = date('Ymd_').strtoupper(md5(microtime().$url_arr[count($url_arr)-1].PRI_KEY.rand())).'.'.$exp_arr[count($exp_arr)-1];
			$F =  $cfg['attachdir'].$B.$fname;
			
			//dirname(__file__).
			copy($cfg['attachdir'].$val,$F);
			unlink($cfg['attachdir'].$val);
			if (file_exists($F)) {
				$oImg = K::M('image/gd');
				$thumbs = $size = array();
				$size['photo'] = $cfg['casephoto']['photo'] ? $cfg['casephoto']['photo'] : '720';
				$size['thumb'] = $cfg['casephoto']['thumb'] ? $cfg['casephoto']['thumb'] : '200';
				$size['small'] = $cfg['casephoto']['small'] ? $cfg['casephoto']['small'] : '60X60';
				$thumbs = array($size['photo']=>"{$D}/{$fname}_expo.jpg",$size['thumb']=>"{$D}/{$fname}", $size['small']=>"{$D}/{$fname}_small.jpg");
				$oImg->thumbs($F, $thumbs);
				if($cfg['casephoto']['watermark']){
					$uname = $attach['uname'] ? $attach['uname'] : 'LXH';
					$oImg->watermark("{$D}/{$fname}", $uname);
					$oImg->watermark2("{$D}/{$fname}_expo.jpg", $uname);
				}
				$data = array();
				$data['case_id'] = (int)$case_id;
				if(!$data['title'] = $attach['title']){
					$data['title'] = preg_replace("/\.(jpg|jpeg|png|gif|bmp)$/i", '', $attach['name']);
				}
				$imginfo = $oImg->info($F);
				$data['title'] = K::M('content/html')->encode($data['title']);
				$data['photo'] = $B.$fname;
				$data['group'] = 0;
				$data['size'] = $imginfo['size'];
				$data['clientip'] = __IP;
				$data['dateline'] = __CFG::TIME;
				if($photo_id =$this->db->insert($this->_table, $data, true)){
					$data['photo_id'] = $photo_id;
					K::M('case/case')->update_last($case_id, $imginfo['size'], 1);
				}
			} else { }
		}
		return $data;
	}
    public function upload($case_id, $attach,$iswater=1)
    {
        if(!UPLOAD_ERR_OK == $attach['error']){
            $this->err->add('上传文件失败',201);
            return false;
        }
        $cfg = K::$system->config->get('attach');
        $B = 'anli/'.date('Ym/',__CFG::TIME);
        $D = $cfg['attachdir'].$B;
        if(!$F = K::M('helper/upload')->upload($attach, $D, $fname)){
            return false;
        }
        $oImg = K::M('image/gd');
        $thumbs = $size = array();
        $size['photo'] = $cfg['casephoto']['photo'] ? $cfg['casephoto']['photo'] : '720';
        $size['thumb'] = $cfg['casephoto']['thumb'] ? $cfg['casephoto']['thumb'] : '200';
        $size['small'] = $cfg['casephoto']['small'] ? $cfg['casephoto']['small'] : '60X60';
        $thumbs = array($size['photo']=>"{$D}/{$fname}_expo.jpg",$size['thumb']=>"{$D}/{$fname}", $size['small']=>"{$D}/{$fname}_small.jpg");
        $oImg->thumbs($F, $thumbs);
        if($cfg['casephoto']['watermark']){
            $uname = $attach['uname'] ? $attach['uname'] : 'LXH';
            $oImg->watermark("{$D}/{$fname}", $uname);
			if($iswater){
				$oImg->watermark2("{$D}/{$fname}_expo.jpg", $uname);
			}      
        }
        $data = array();
        $data['case_id'] = (int)$case_id;
        if(!$data['title'] = $attach['title']){
            $data['title'] = preg_replace("/\.(jpg|jpeg|png|gif|bmp)$/i", '', $attach['name']);
        }
        $data['title'] = K::M('content/html')->encode($data['title']);
        $data['photo'] = $B.$fname;
        $data['group'] = $attach['group'];
        $data['size'] = $attach['size'];
        $data['clientip'] = __IP;
        $data['dateline'] = __CFG::TIME;
        if($photo_id =$this->db->insert($this->_table, $data, true)){
            $data['photo_id'] = $photo_id;
            K::M('case/case')->update_last($case_id, $attach['size'], 1);
            return $data;
        }
        return false; 
    }

    public function items_by_case($case_id, $p=1, $l=50, &$count=0)
    {
        if(!$case_id = (int)$case_id){
            return false;
        }
		$orderby = array('group'=>'DESC','photo_id'=>'ASC');
        return $this->items(array('case_id'=>$case_id,'closed'=>0), $orderby, $p, $l, $count);
    }

    public function items_by_cases($ids)
    {
        if(!$ids = K::M('verify/check')->ids($ids)){
            return false;
        }

        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE case_id IN($ids) AND closed=0  order by case_id ASC";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['case_id']][$row['group']] = $this->_format_row($row);
            }
        }
        return $items;
    }

    public function items_by_case_group($case_id,$group=0, $p=1, $l=50, &$count=0)
    {
        if(!$case_id = (int)$case_id){
            return false;
        }
		$orderby = array('group'=>'DESC','photo_id'=>'ASC');
        return $this->items(array('case_id'=>$case_id,'group'=>$group,'closed'=>0), $orderby, $p, $l, $count);
    }

    public function count_by_case($case_id)
    {
        if(!$case_id = (int)$album_id){
            return false;
        }
        $sql = "SELECT case_id, COUNT(1) photos, SUM(`size`) size FROM ".$this->table($this->_table)." WHERE case_id='$case_id' AND closed=0";
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
        $albums = $shops = $photo_ids = array();
        foreach($items as $item){
   			@unlink('czfiles/'.$item['photo'].'_small.jpg');
   			@unlink('czfiles/'.$item['photo'].'_expo.jpg');
 			@unlink('czfiles/'.$item['photo']);
           $albums[$item['case_id']]['num'] += 1;
            $albums[$item['case_id']]['size'] += $item['size'];
            $photo_ids[] = $item['photo_id'];
        }
        if(!empty($photo_ids)){
            if($force){
                $sql = "DELETE FROM ".$this->table($this->_table)." WHERE " . self::field($this->_pk, $photo_ids);
                $ret = $this->db->Execute($sql);
            }else{
                $ret = $this->db->update($this->_table, array('closed'=>1), self::field($this->_pk, $photo_ids));
            }
            if($ret){
                foreach($albums as $k=>$v){
                    K::M('case/case')->update_last($k, -$v['size'], -$v['num']);
                }
            }
        }
        return $ret;      
    }

	
	function phone_count($val){
	   $count = 0;
	   $sql = "SELECT case_id, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('case_id', $val)." and closed = 0 GROUP BY case_id";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                K::M('case/case')->update($row['case_id'], array('phones'=>$row['c']), true);
                $count ++;
            }
        }
        return $count;
	}
    public function items_shi($case_ids=0)
    {

        $sql = "SELECT c.photo,c.case_id FROM ".$this->table($this->_table)." c
WHERE case_id IN ($case_ids) AND c.closed=0 AND 4>=(
SELECT COUNT(*) FROM ".$this->table($this->_table)." a
WHERE a.case_id=c.case_id AND a.photo_id>=c.photo_id)
ORDER BY c.case_id,c.photo_id desc";
        if($rs = $this->db->query($sql)){
            while($row = $rs->fetch()){
             	$items[$row['case_id']][] = $row;
            }
        }
        return $items;
    }  
    public function addfile_sql($sql)
    {
		$sql = str_replace("{table}",$this->table($this->_table),$sql);
        $this->db->Execute($sql);
        return true;
    }
    public function _check($data, $photo_id=null)
    {
        unset($data['photo_id'], $data['closed'], $data['clientip'], $data['dateline']);
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

    public function casephotos($case_id)
    {
        $sql = "SELECT * FROM ".$this->table($this->_table)."  WHERE case_id='$case_id' ORDER BY photo_id DESC";
        //echo $sql;die;
        return $this->db->GetRow($sql);
    }
}