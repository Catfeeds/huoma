<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: guan.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Card_Site extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
//       if($SO = $this->GP('SO')){
//            $pager['SO'] = $SO;
//            if($SO['id']){$filter['id'] = $SO['id'];}
//            if($SO['username']){$filter['username'] = "LIKE:%".$SO['username']."%";}
//            if($SO['email']){$filter['email'] = "LIKE:%".$SO['email']."%";}
//            if($SO['mobile']){$filter['mobile'] = "LIKE:%".$SO['mobile']."%";}
//            if(is_numeric($SO['audit'])){$filter['audit'] = $SO['audit'];}
//            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1])+86400;$filter['dateline'] = $a."~".$b;}}
//        }


		
        if($items = K::M('card/site')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:card/site/items.html';
    }

    public function so($target)
    {
		if($target){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;  
        $this->tmpl = 'admin:card/site/so.html';
    }



    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

				
                if($id = K::M('card/site')->create($data)){

                    $this->err->add('添加成功');
                    $this->err->set_data('forward', '?card/site-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:card/site/create.html';
        }
    }

    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('card/site')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{


                if(K::M('card/site')->update($id, $data)){

                    $this->err->add('修改成功');
                }  
            } 
        }else{

        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:card/site/edit.html';
        }
    }



    public function delete($id=null)
    {
		if($id = (int)$id){
            if($guan = K::M('card/site')->detail($id)){

                if(K::M('card/site')->delete($id)){
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('id')){
            if($items = K::M('card/site')->items_by_ids($ids)){
                $aids = $ids = array();
                foreach($items as $v){
                    
                    $aids[$v['id']] = $v['id'];
                }
                if($aids && K::M('card/site')->delete($aids)){
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}