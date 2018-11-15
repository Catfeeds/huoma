<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: photo.mdl.php 2015-09-27 02:07:36  xinghuali
 */


if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xiangmu_Project extends Mdl_Table
{   
  
    protected $_table = 'xiangmu_project';
    protected $_pk = 'project_id';
    protected $_cols = 'project_id,xiangmu_id,project_title,project_content,project_mobile,project_email,project_img,project_dateline,closed,project_url';
    protected $_orderby = array('project_id'=>'DESC');


    public function create($data)
    {
        
        //设置图片
        $addr = $data['photo'];
        unset($data['photo']);
        //获取后缀
        $type = strtolower(substr(strrchr($addr['name'], '.'), 1));
        //设置图片路径
        $year = date("Ym");
        $path = "files/photo/".$year;
        if(!is_dir($path)){
            mkdir($path,0777);
        }

        //设置图片名称
        $pic_name = time().'.'.$type;
        $pic_url = $path.'/'.$pic_name;

         if (move_uploaded_file($addr['tmp_name'], $pic_url)) {//临时文件转移到目标文件夹
                $data['project_url'] = $pic_url;
         }else{
                 
         }
         //设置添加使劲
        $data['project_dateline'] = __CFG::TIME;
        
       //添加数据
        if($pro = $this->db->insert($this->_table, $data, true)){
            return $pro;
        }else{

          return  2;
        }

       

    }

    public function edit($data)
    {
        //设置图片
        $addr = $data['photo'];
        if($addr){
            unset($data['photo']);
            //获取后缀
            $type = strtolower(substr(strrchr($addr['name'], '.'), 1));
            //设置图片路径
            $year = date("Ym");
            $path = "files/photo/".$year;
            if(!is_dir($path)){
                mkdir($path,0777);
            }

            //设置图片名称
            $pic_name = time().'.'.$type;
            $pic_url = $path.'/'.$pic_name;

             if (move_uploaded_file($addr['tmp_name'], $pic_url)) {//临时文件转移到目标文件夹
                    $data['project_url'] = $pic_url;
             }else{
                     
             }
        }

        $pk = $data['project_id'];    
        unset($data['project_id']);
      if($ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $pk))){
            $this->flush();
        }
        return $ret;
       
       

    }

     public function delete($project_id)
    {

        $sql = "DELETE FROM ".$this->table($this->_table)." WHERE project_id= ".$project_id;
         return $this->db->Execute($sql);   
       
       

    }


    public function url_address($url)
    {
        
        foreach ($url as $k => $v) {
                   foreach ($v as $kk => $vv) {
                       $adress[$k] =$vv; 
                   }
                }

        return $adress;

    }

}