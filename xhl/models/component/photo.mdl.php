<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: photo.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Component_Photo extends Mdl_Table
{   
  
    protected $_table = 'component_photo';
    protected $_pk = 'photo_id';
    protected $_cols = 'photo_id,xiangmu_id,title,photo,size,dateline';
    protected $_orderby = array('photo_id'=>'DESC');

    public function update_by_xiangmu($xiangmu_id, $pids, $force=false)
    {
        if(!$xiangmu_id = (int)$xiangmu_id){
            return false;
        }else if(!$pids = K::M('verify/check')->ids($pids)){
            return false;
        }
        $where = "photo_id IN ($pids)";
        if(empty($force)){
            $where .= " AND xiangmu_id=0";
        }
        if($count = $this->count($where)){
            $this->db->update($this->_table, array('component_id'=>$xiangmu_id), $where);
        }
        return $count;
    }

    public function upload($xiangmu_id=0, $attach)
    {
        $ym = date('Ym', __CFG::TIME);
        $cfg = K::$system->config->get('attach');
        $dir = $cfg['attachdir'].'photo'.DIRECTORY_SEPARATOR.$ym.DIRECTORY_SEPARATOR;
        if($attach['html5']){
            if(strlen($attach['data'])>2097152){
                $this->err->add('上传的文件不能超过2M', 721);
                return false;
            }
            $ext = $attach['extension'] = strtolower(K::M('io/file')->extension($attach['name']));
            $fname = date('Ymd_').strtoupper(md5(microtime().$attach['tmp_name'].PRI_KEY.rand())).".{$attach['extension']}";
            $file = $dir.$fname;
            file_put_contents($file, $attach['data']);
        }else if(!$file = K::M('helper/upload')->upload($attach, $dir, $fname)){
            return false;
        }
        if($file){
            $photo = "photo/{$ym}/{$fname}";
            $xiangmu_id = (int)$xiangmu_id;
            $a = array('component_id'=>$xiangmu_id,'size'=>$attach['size'], 'photo'=>$photo,'title'=>$attach['name']);
            $a['dateline'] = __CFG::TIME;
            if($a['photo_id'] = $this->db->insert($this->_table, $a, true)){
                if($xiangmu_id){
                    K::M('component/xiangmu')->update_count($xiangmu_id, 'photos', 1);
                }
            }
            $a['file'] = $file;
            $size['photo'] = $cfg['component']['photo'] ? $cfg['component']['photo'] : '720';
            $size['thumb'] = $cfg['component']['thumb'] ? $cfg['component']['thumb'] : '200';
            $thumbs = array($size['photo']=>$file, $size['thumb']=>$file.'_thumb.jpg');
            K::M('image/gd')->thumbs($file, $thumbs, false);
            if($cfg['component']['watermark']){
                $site = K::$system->config->get('site');
                $uname = $attach['uname'] ? $attach['uname'] : $site['title'];
                K::M('image/gd')->watermark($file, $uname);
            }
            return $a;
        }
        return false;
    }
}