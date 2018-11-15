<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: guan.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Card_Keyword extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
       if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['id']){$filter['id'] = $SO['id'];}
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
        }

		//$filter['tuijian'] = 1;
		
        if($items = K::M('card/keyword')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }//var_dump($items);die;
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:card/keyword/items.html';
    }

    public function so($target)
    {
		if($target){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;  
        $this->tmpl = 'admin:card/keyword/so.html';
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
							if($a = $upload->upload($attach, 'card')){
								$data[$k] = str_replace("\\",'/',$a['photo']);
							}
						}
					}
				}
				$data['datetime'] = time();
				
                if($id = K::M('card/keyword')->create($data)){

                    $this->err->add('添加成功');
                    $this->err->set_data('forward', '?card/keyword-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:card/keyword/create.html';
        }
    }

    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('card/keyword')->detail($id)){
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

                    foreach($attachs as $k=>$attach){
                        if($attach['error'] == UPLOAD_ERR_OK){

                            if($a = K::M('card/keyword')->upload($attach,'card')){
                                $data[$k] = str_replace("\\",'/',$a['data']);
                            }
                        }
                    }
                }
//var_dump($data);die;
                if(K::M('card/keyword')->update($id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
			$site = K::M('system/config')->get('site');
			$this->pagedata['imgurl'] = $site['siteurl'].'/card/';
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:card/keyword/edit.html';
        }
    }

    public function delete($id=null)
    {
		if($id = (int)$id){
         	if(K::M('card/keyword')->delete($id)){
				$this->err->add('删除成功');
			}

        }else if($ids = $this->GP('id')){
            if($items = K::M('card/keyword')->items_by_ids($ids)){
                $aids = $ids = array();
                foreach($items as $v){
                    
                    $aids[$v['id']] = $v['id'];
                }
                if($aids && K::M('card/keyword')->delete($aids)){
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}