<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: cate.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Xiangmu_Cate extends Ctl
{
   
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;

        if($items = K::M('xiangmu/cate')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));;
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['tree'] = K::M('xiangmu/cate')->tree();
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xiangmu/cate/items.html';
    }

    public function create($parent_id=null)
    {
        if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if($cat_id = K::M('xiangmu/cate')->create($data)){
                if($photos = $this->__upload()){
                        K::M('xiangmu/cate')->update($cat_id, $photos);
                }
                $this->err->add('添加分类成功');
                $this->err->set_data('forward', '?xiangmu/cate-index.html');
            }
        }else{
            $pager['parent_id'] = intval($parent_id);
            $this->pagedata['pager'] = $pager;
            $this->pagedata['tree'] = K::M('xiangmu/cate')->tree();
            $this->tmpl = 'admin:xiangmu/cate/create.html';
        }
    }

    protected function __upload($xiangmu=array())
    {
        $photos = array();
        if($_FILES['data']){
            foreach($_FILES['data'] as $k=>$v){
                foreach($v as $kk=>$vv){
                    $attachs[$kk][$k] = $vv;
                }
            }
            $upload = K::M('magic/upload');
            foreach($attachs as $k=>$attach){
                if($attach['error'] == UPLOAD_ERR_OK){
                    if($a = $upload->upload($attach, 'xiangmu', $xiangmu[$k])){
                        $photos[$k] = $a['photo'];
                    }
                }
            }
        }
        return $photos;      
    }
    
    public function upload($cat_id=0)
    {
        if($cat_id = (int)$cat_id){
            $cate = K::M('xiangmu/cate')->detail($cat_id);
        }
        if(!$attach = $_FILES['imgFile']){
            $this->err->add('上传文件失败', 211);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传文件失败', 212);
        }else if($data = K::M('xiangmu/photo')->upload($cat_id, $attach)){
            $cfg = $this->system->config->get('attach');
            $this->err->set_data('url', $cfg['attachurl'].'/'.$data['photo'].'?PID'.$data['photo_id']);
            if($cate && (empty($cate['bgimg']) || substr($cate['bgimg'], 0, 8) == 'default/')){
                K::M('xiangmu/cate')->update($cat_id, array('bgimg'=>$data['photo'].'_thumb.jpg'), true);
            }
        }
        $this->err->json();        
    }

    public function edit($cat_id=null)
    {
        if(!($cat_id = (int)$cat_id) && !($cat_id = (int)$this->GP('cat_id'))){
            $this->err->add('未指要修改ID', 211);
        }else if(!$cate = K::M('xiangmu/cate')->detail($cat_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(K::M('xiangmu/cate')->update($cat_id, $data)){
                if($photos = $this->__upload($cate)){
                    K::M('xiangmu/cate')->update($cat_id, $photos);
                }
                $this->err->add('修改内容成功');
            }
        }else{
        	$this->pagedata['cate'] = $cate;
            $this->pagedata['cate_list'] = K::M('xiangmu/cate')->fetch_all();
        	$this->tmpl = 'admin:xiangmu/cate/edit.html';
        }
    }

    public function update()
    {
        if($orders = $this->GP('orderby')){
            $obj = K::M('xiangmu/cate');
            foreach($orders as $k=>$v){
                $obj->update($k, array('orderby'=>$v));
            }
            $this->err->add('更新数据成功');
        }
    }

    public function delete($cat_id=null)
    {
        if($cat_id = (int)$cat_id){
            if(K::M('xiangmu/cate')->delete($cat_id)){
                $this->err->add('删除成功');
            }
        }else if($pks = $this->GP('cat_id')){
            if(K::M('xiangmu/cate')->delete($pks)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }        
    }
}