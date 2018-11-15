<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: photo.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xiangmu_Photo extends Mdl_Table
{   
  
    protected $_table = 'xiangmu_photo';
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
            $this->db->update($this->_table, array('xiangmu_id'=>$xiangmu_id), $where);
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
            $a = array('xiangmu_id'=>$xiangmu_id,'size'=>$attach['size'], 'photo'=>$photo,'title'=>$attach['name']);
            $a['dateline'] = __CFG::TIME;
            if($a['photo_id'] = $this->db->insert($this->_table, $a, true)){
                if($xiangmu_id){
                    K::M('xiangmu/xiangmu')->update_count($xiangmu_id, 'photos', 1);
                }
            }
            $a['file'] = $file;
            $size['photo'] = $cfg['xiangmu']['photo'] ? $cfg['xiangmu']['photo'] : '720';
            $size['thumb'] = $cfg['xiangmu']['thumb'] ? $cfg['xiangmu']['thumb'] : '200';
            $thumbs = array($size['photo']=>$file, $size['thumb']=>$file.'_thumb.jpg');
            K::M('image/gd')->thumbs($file, $thumbs, false);
            if($cfg['xiangmu']['watermark']){
                $site = K::$system->config->get('site');
                $uname = $attach['uname'] ? $attach['uname'] : $site['title'];
                K::M('image/gd')->watermark($file, $uname);
            }
            return $a;
        }
        return false;
    }


    public function addphoto($data)
    {

        //获取后缀
        $type = strtolower(substr(strrchr($data['name'], '.'), 1));
        //设置图片路径
        $year = date("Ym");
        $path = "files/photo/".$year;
        if(!is_dir($path)){
            mkdir($path,0777);
        }
        //设置图片名称
        $pic_name = time().'.'.$type;
        $pic_url = $path.'/'.$pic_name;
        //上传后图片路径+名称
        if (move_uploaded_file($data['tmp_name'], $pic_url)) {//临时文件转移到目标文件夹
            //图片信息存储数据库
                $datas['size'] = $data['size'];
                $datas['dateline'] = time();
                $datas['title'] = '项目图片';
                $datas['photo'] = $pic_url;
                $photo_id = $this->db->insert($this->_table, $datas, true);

                if($photo_id){

                     $sql = "SELECT * FROM ".$this->table($this->_table)."  where photo_id =".$photo_id;
                        if($rs = $this->db->Execute($sql)){
                        while($row = $rs->fetch()){
                        $ph = $row;
                     }
            }

                     return json_encode($ph);
                }else{
                    return '图片存储错误';

                }

         } else {
                 return '图片路径错误';
         }

       
    }



    public function tupian_all($data)
    {
        
            $sql = "SELECT * FROM ".$this->table($this->_table)."  where photo_id in(".$data.")";
                        if($rs = $this->db->Execute($sql)){
                             while($row = $rs->fetch_all()){
                             $ph = $row;
                        }
            }

            return $ph;

    }



}