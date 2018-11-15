<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: xiangmu.ctl.php 10040 2015-05-05 13:21:15Z maoge $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Xiangmu_Xiangmu extends Ctl
{

    protected $xiangmu_from = 'xiangmu';
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['xiangmu_id']){$filter['xiangmu_id'] = $SO['xiangmu_id'];}
            if($SO['cat_id']){
                if($cids = K::M('xiangmu/cate')->children_ids($SO['cat_id'])){
                    $filter['cat_id'] = explode(',', $cids);
                }
            }
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
            if(is_array($SO['dateline'])){
                if($SO['dateline'][0] && $SO['dateline'][1]){
                    $a = strtotime($SO['dateline'][0]); 
                    $b = strtotime($SO['dateline'][1]);
                    $filter['dateline'] = $a."~".$b;
                }
            }
            if(is_numeric($SO['hidden'])){
                $filter['hidden'] = $SO['hidden'] ? 1 : 0;
            }
            if(is_numeric($SO['audit'])){
                $filter['audit'] = $SO['audit'] ? 1 : 0;
            }            
        }
        $filter['closed'] = 0;
        $filter['from'] = $pager['from'] = $this->xiangmu_from;
        $orderby = array('orderby'=>'ASC','xiangmu_id'=>'DESC');
        if($items = K::M('xiangmu/xiangmu')->items($filter, $orderby, $page, $limit, $count)){
        	$pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("xiangmu/{$this->xiangmu_from}:index", array("{page}")), array("SO"=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xiangmu/xiangmu/items.html';
    }

    public function so($target=null, $multi=null)
    {
        $pager['from'] = $this->xiangmu_from;
        if($target == 'dialog'){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;   
        $this->tmpl = 'admin:xiangmu/xiangmu/so.html';
    }

    public function dialog($multi=1, $page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        $pager['multi'] = $multi = $multi ? 1 : 0;

        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['xiangmu_id']){$filter['xiangmu_id'] = $SO['xiangmu_id'];}
            if($SO['cat_id']){
                if($cids = K::M('xiangmu/cate')->children_ids($SO['cat_id'])){
                    $filter['cat_id'] = explode(',', $cids);
                }
            }
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
            if(is_array($SO['dateline'])){
                if($SO['dateline'][0] && $SO['dateline'][1]){
                    $a = strtotime($SO['dateline'][0]); 
                    $b = strtotime($SO['dateline'][1]);
                    $filter['dateline'] = $a."~".$b;
                }
            }
            if(is_numeric($SO['hidden'])){
                $filter['hidden'] = $SO['hidden'] ? 1 : 0;
            }
            if(is_numeric($SO['audit'])){
                $filter['audit'] = $SO['audit'] ? 1 : 0;
            }            
        }
        $filter['closed'] = 0;
        $filter['from'] = $pager['from'] = $this->xiangmu_from;
        $orderby = array('orderby'=>'ASC','xiangmu_id'=>'DESC');
        if($items = K::M('xiangmu/xiangmu')->items($filter, $orderby, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($multi, '{page}')), array('SO'=>$SO));;
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xiangmu/xiangmu/dialog.html';       
    }

    public function create()
    {   
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                $data['from'] = $this->xiangmu_from;
                if($xiangmu_id = K::M('xiangmu/xiangmu')->create($data)){
                    if($photos = $this->__upload()){
                        K::M('xiangmu/xiangmu')->update($xiangmu_id, $photos);
                    }
                    $this->err->add('添加项目成功');
                    $this->err->set_data('forward', '?xiangmu/'.$this->xiangmu_from.'-index.html');
                }
            }
        }else{ 
            $pager['from'] = $this->xiangmu_from;
            $this->pagedata['pager'] = $pager;            
            $this->tmpl = 'admin:xiangmu/xiangmu/create.html';
        }
    }

    public function edit($xiangmu_id=null)
    {
        if(!($xiangmu_id = (int)$xiangmu_id) && !($xiangmu_id = (int)$this->GP('xiangmu_id'))){
            $this->err->add('未指要修改项目ID', 211);
        }else if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)){
            $this->err->add('项目不存在或已经删除', 212);
        }else if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                if(K::M('xiangmu/xiangmu')->update($xiangmu_id, $data)){
                    if($photos = $this->__upload($detail)){
                        K::M('xiangmu/xiangmu')->update($xiangmu_id, $photos);
                    }
                    $this->err->add('修改文章成功');
                }                
            } 
        }else{
            $pager['from'] = $this->xiangmu_from;
            $this->pagedata['pager'] = $pager;
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:xiangmu/xiangmu/edit.html';
        }
    }

    public function doaudit($xiangmu_id=null)
    {
        if($xiangmu_id = (int)$xiangmu_id){
            if(K::M('xiangmu/xiangmu')->batch($xiangmu_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('xiangmu_id')){
            if(K::M('xiangmu/xiangmu')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($pk=null)
    {
        if(!empty($pk)){
            if(K::M('xiangmu/xiangmu')->delete($pk)){
                $this->err->add('删除成功');
            }
        }else if($pks = $this->GP('xiangmu_id')){
            if(K::M('xiangmu/xiangmu')->delete($pks)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
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
    
    public function upload($xiangmu_id=0)
    {
        if($xiangmu_id = (int)$xiangmu_id){
            $xiangmu = K::M('xiangmu/xiangmu')->detail($xiangmu_id);
        }
        if(!$attach = $_FILES['imgFile']){
            $this->err->add('上传文件失败', 211);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传文件失败', 212);
        }else if($data = K::M('xiangmu/photo')->upload($xiangmu_id, $attach)){
            $cfg = $this->system->config->get('attach');
            $this->err->set_data('url', $cfg['attachurl'].'/'.$data['photo'].'?PID'.$data['photo_id']);
            if($xiangmu && (empty($xiangmu['thumb']) || substr($xiangmu['thumb'], 0, 8) == 'default/')){
                K::M('xiangmu/xiangmu')->update($xiangmu_id, array('thumb'=>$data['photo'].'_thumb.jpg'), true);
            }
        }
        $this->err->json();        
    }

}