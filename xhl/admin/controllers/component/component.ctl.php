<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: component.ctl.php 10040 2015-05-05 13:21:15Z maoge $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Component_Component extends Ctl
{

    protected $component_from = 'component';
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['component_id']){$filter['component_id'] = $SO['component_id'];}
            if($SO['cat_id']){
                if($cids = K::M('component/cate')->children_ids($SO['cat_id'])){
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
        $filter['from'] = $pager['from'] = $this->component_from;
        $orderby = array('orderby'=>'ASC','component_id'=>'DESC');
        if($items = K::M('component/component')->items($filter, $orderby, $page, $limit, $count)){
        	$pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("component/{$this->component_from}:index", array("{page}")), array("SO"=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:component/component/items.html';
    }

    public function so($target=null, $multi=null)
    {
        $pager['from'] = $this->component_from;
        if($target == 'dialog'){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;   
        $this->tmpl = 'admin:component/component/so.html';
    }

    public function dialog($multi=1, $page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        $pager['multi'] = $multi = $multi ? 1 : 0;

        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['component_id']){$filter['component_id'] = $SO['component_id'];}
            if($SO['cat_id']){
                if($cids = K::M('component/cate')->children_ids($SO['cat_id'])){
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
        $filter['from'] = $pager['from'] = $this->component_from;
        $orderby = array('orderby'=>'ASC','component_id'=>'DESC');
        if($items = K::M('component/component')->items($filter, $orderby, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($multi, '{page}')), array('SO'=>$SO));;
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:component/component/dialog.html';       
    }

    public function create()
    {   
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                $data['from'] = $this->component_from;
                if($component_id = K::M('component/component')->create($data)){
                    if($photos = $this->__upload()){
                        K::M('component/component')->update($component_id, $photos);
                    }
                    $this->err->add('添加项目成功');
                    $this->err->set_data('forward', '?component/'.$this->component_from.'-index.html');
                }
            }
        }else{ 
            $pager['from'] = $this->component_from;
            $this->pagedata['pager'] = $pager;            
            $this->tmpl = 'admin:component/component/create.html';
        }
    }

    public function edit($component_id=null)
    {
        if(!($component_id = (int)$component_id) && !($component_id = (int)$this->GP('component_id'))){
            $this->err->add('未指要修改项目ID', 211);
        }else if(!$detail = K::M('component/component')->detail($component_id)){
            $this->err->add('项目不存在或已经删除', 212);
        }else if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                if(K::M('component/component')->update($component_id, $data)){
                    if($photos = $this->__upload($detail)){
                        K::M('component/component')->update($component_id, $photos);
                    }
                    $this->err->add('修改文章成功');
                }                
            } 
        }else{
            $pager['from'] = $this->component_from;
            $this->pagedata['pager'] = $pager;
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:component/component/edit.html';
        }
    }

    public function doaudit($component_id=null)
    {
        if($component_id = (int)$component_id){
            if(K::M('component/component')->batch($component_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('component_id')){
            if(K::M('component/component')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($pk=null)
    {
        if(!empty($pk)){
            if(K::M('component/component')->delete($pk)){
                $this->err->add('删除成功');
            }
        }else if($pks = $this->GP('component_id')){
            if(K::M('component/component')->delete($pks)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    protected function __upload($component=array())
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
                    if($a = $upload->upload($attach, 'component', $component[$k])){
                        $photos[$k] = $a['photo'];
                    }
                }
            }
        }
        return $photos;      
    }
    
    public function upload($component_id=0)
    {
        if($component_id = (int)$component_id){
            $component = K::M('component/component')->detail($component_id);
        }
        if(!$attach = $_FILES['imgFile']){
            $this->err->add('上传文件失败', 211);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传文件失败', 212);
        }else if($data = K::M('component/photo')->upload($component_id, $attach)){
            $cfg = $this->system->config->get('attach');
            $this->err->set_data('url', $cfg['attachurl'].'/'.$data['photo'].'?PID'.$data['photo_id']);
            if($component && (empty($component['thumb']) || substr($component['thumb'], 0, 8) == 'default/')){
                K::M('component/component')->update($component_id, array('thumb'=>$data['photo'].'_thumb.jpg'), true);
            }
        }
        $this->err->json();        
    }

}