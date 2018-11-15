<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: pics.ctl.php 3191 2015-01-23 06:27:20  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Home_Pics extends Ctl
{
    
    public function index($home_id=0,$type=0)
    {   
        $home_id = (int)$home_id;
        if(!$detail = K::M('home/main')->detail($home_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } 
        $this->pagedata['detail']  = $detail;
        $this->pagedata['home_id'] = $filter['home_id'] = $home_id;
        $this->pagedata['type'] = $filter['type'] = (int)$type;
        $this->pagedata['typeCfg'] = K::M('home/pics')->get_type();
        $this->pagedata['items'] =  K::M('home/pics')->items($filter, null, 1, 50, $count);
        $this->tmpl = 'admin:home/pics/items.html';
    }

    public function dialog($home_id=0,$page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $pager['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['id']){$filter['id'] = $SO['id'];}
            if($SO['city_id']){$filter['city_id'] = $SO['city_id'];}
            if($SO['area_id']){$filter['area_id'] = $SO['area_id'];}
            if($SO['home_id']){$filter['home_id'] = $SO['home_id'];}
        }      
        if($home_id ){
            $filter['home_id'] = (int)$home_id;
        }
        $filter['type'] = '1';//户型图
        $filter['closed'] = 0;
        if($items = K::M('home/pics')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pager'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($home_id ,'{page}')), array('SO'=>$SO, 'multi'=>$multi));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;    
        $this->tmpl = 'admin:home/pics/dialog.html';         
    }
    
    public function upload()
    {
        if(!$home_id = $this->GP('home_id')){
            $this->err->add('非法的参数请求', 201);
        }else if(!$home = K::M('home/main')->detail($home_id)){
            $this->err->add('酒店不存在或已经删除', 202);
        }else if(!$type = $this->GP('type')){
             $this->err->add('非法的参数请求', 201);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            $attach['uname'] = $hotel['title'];
            if($a = K::M('home/pics')->upload($home_id,$type, $attach)){               
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('thumb', $cfg['attachurl'].'/'.$a['photo']);
                $this->err->add('上传图片成功');                
            }
        }
        $this->err->json();
    }
    
    
    public function update(){
        if($title = $this->GP('title')){
            foreach($title as $k=>$v){
                $id = (int)$k;
                $data = array('title'=>$v);
                K::M('home/pics')->update($id,$data);
            } 
             $this->err->add('批量更新操作成功');
        }else{
            $this->err->add('未指定要更新的内容', 401);
        }
        
    }

    public function delete($id=0)
    {
        
        if($id = (int)$id){
            if(K::M('home/pics')->delete($id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('id')){
            if(K::M('home/pics')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}