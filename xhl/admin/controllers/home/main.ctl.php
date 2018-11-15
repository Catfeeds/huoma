<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: main.ctl.php 3220 2015-01-27 08:12:25  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Home_Main extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['id']){$filter['id'] = $SO['id'];}
            if($SO['city_id']){$filter['city_id'] = $SO['city_id'];}
            if($SO['area_id']){$filter['area_id'] = $SO['area_id'];}
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            if($SO['tel']){$filter['tel'] = "LIKE:%".$SO['tel']."%";}
            if($SO['kf']){$filter['kf'] = "LIKE:%".$SO['kf']."%";}
            if(is_array($SO['lng'])){$a = intval($SO['lng'][0]);$b=intval($SO['lng'][1]);if($a && $b){$filter['lng'] = $a."~".$b;}}
            if(is_array($SO['lat'])){$a = intval($SO['lat'][0]);$b=intval($SO['lat'][1]);if($a && $b){$filter['lat'] = $a."~".$b;}}
        }
        $filter['closed'] = 0;
        if($items = K::M('home/main')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));;
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
   
        $this->tmpl = 'admin:home/main/items.html';
    }

    public function so($target=null, $multi=null)
    {
        if($target){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;          
        $this->tmpl = 'admin:home/main/so.html';
    }

    public function dialog($page=1)
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
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            if($SO['tel']){$filter['tel'] = "LIKE:%".$SO['tel']."%";}
            if($SO['kf']){$filter['kf'] = "LIKE:%".$SO['kf']."%";}
            if(is_array($SO['lng'])){$a = intval($SO['lng'][0]);$b=intval($SO['lng'][1]);if($a && $b){$filter['lng'] = $a."~".$b;}}
            if(is_array($SO['lat'])){$a = intval($SO['lat'][0]);$b=intval($SO['lat'][1]);if($a && $b){$filter['lat'] = $a."~".$b;}}
        }
        $filter['closed'] = 0;
        if($items = K::M('home/main')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO, 'multi'=>$multi));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();        
        $this->tmpl = 'admin:home/main/dialog.html';           
    }


    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
        if($_FILES['data']){
            foreach($_FILES['data'] as $k=>$v){
                foreach($v as $kk=>$vv){
                    $attachs[$kk][$k] = $vv;
                }
            }
            $upload = K::M('magic/upload');
            foreach($attachs as $k=>$attach){
                if($attach['error'] == UPLOAD_ERR_OK){
                    if($a = $upload->upload($attach, 'home')){
                        $data[$k] = $a['photo'];
                    }
                }
            }
        }

                if($id = K::M('home/main')->create($data)){
                    if($attr=  $this->GP('attr')){
                        K::M('home/attr')->update($id,$attr);       
                    }
                    
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?home/main-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:home/main/create.html';
        }
    }

    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('home/main')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
        if($_FILES['data']){
            foreach($_FILES['data'] as $k=>$v){
                foreach($v as $kk=>$vv){
                    $attachs[$kk][$k] = $vv;
                }
            }
            $upload = K::M('magic/upload');
            foreach($attachs as $k=>$attach){
                if($attach['error'] == UPLOAD_ERR_OK){
                    if($a = $upload->upload($attach, 'home')){
                        $data[$k] = $a['photo'];
                    }
                }
            }
        }

                if(K::M('home/main')->update($id, $data)){
                    if($attr =  $this->GP('attr')){
                        K::M('home/attr')->update($id,$attr);       
                    }
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
                $this->pagedata['attr'] = K::M('home/attr')->attrs_ids_by_home($id);
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:home/main/edit.html';
        }
    }

    public function delete($id)
    {
        if($id = (int)$id){
            if(K::M('home/main')->delete($id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('id')){
            if(K::M('home/main')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}