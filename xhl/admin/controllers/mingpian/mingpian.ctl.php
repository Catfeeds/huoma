<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: guan.ctl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Mingpian_Mingpian extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
/*        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['mingpian_id']){$filter['mingpian_id'] = $SO['mingpian_id'];}
            if($SO['city_id']){$filter['city_id'] = $SO['city_id'];}
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
            if(is_numeric($SO['audit'])){$filter['audit'] = $SO['audit'];}
            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1])+86400;$filter['dateline'] = $a."~".$b;}}
        }
*/        $filter['closed'] = 0;
		
        if($items = K::M('mingpian/mingpian')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:mingpian/items.html';
    }

    public function so($target)
    {
		if($target){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;  
        $this->tmpl = 'admin:mingpian/mingpian/so.html';
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
							if($a = $upload->upload($attach, 'mingpian')){
								$data[$k] = $a['photo'];
							}
						}
					}
				}
				
				
                if($mingpian_id = K::M('mingpian/mingpian')->create($data)){
                    if($attr=  $this->GP('attr')){
                        K::M('guan/attr')->update($mingpian_id,$attr);  
						
                    }
                    $this->err->add('添加成功');
                    $this->err->set_data('forward', '?mingpian/mingpian-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:mingpian/create.html';
        }
    }

    public function edit($mingpian_id=null)
    {
        if(!($mingpian_id = (int)$mingpian_id) && !($mingpian_id = $this->GP('mingpian_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('mingpian/mingpian')->detail($mingpian_id)){
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
                            if($a = $upload->upload($attach, 'guan')){
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
				

                if(K::M('mingpian/mingpian')->update($mingpian_id, $data)){
					if($attr =  $this->GP('attr')){
                        K::M('guan/attr')->update($mingpian_id,$attr);       
                    }
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:mingpian/edit.html';
        }
    }

    public function doaudit($mingpian_id=null)
    {
        if($mingpian_id = (int)$mingpian_id){
			if(!$guan = K::M('mingpian/mingpian')->detail($mingpian_id)){
				$this->err->add('场馆不存在或已经删除', 211);
			}else if(!$this->check_city($guan['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else if(K::M('mingpian/mingpian')->batch($mingpian_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('mingpian_id')){

			if($items = K::M('mingpian/mingpian')->items_by_ids($ids)){
                $aids = $mingpian_ids = array();
                foreach($items as $v){
                   
                    $aids[$v['mingpian_id']] = $v['mingpian_id'];
                }
                if($aids && K::M('mingpian/mingpian')->batch($aids, array('audit'=>1))){
                    $this->err->add('批量审核内容成功');
                }
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($mingpian_id=null)
    {
		if($mingpian_id = (int)$mingpian_id){
            if($guan = K::M('mingpian/mingpian')->detail($mingpian_id)){
                if(!$this->check_city($guan['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('mingpian/mingpian')->delete($mingpian_id)){
                    $this->err->add('删除场馆成功');
                }
            }
        }else if($ids = $this->GP('mingpian_id')){
            if($items = K::M('mingpian/mingpian')->items_by_ids($ids)){
                $aids = $mingpian_ids = array();
                foreach($items as $v){
                    
                    $aids[$v['mingpian_id']] = $v['mingpian_id'];
                }
                if($aids && K::M('mingpian/mingpian')->delete($aids)){
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}