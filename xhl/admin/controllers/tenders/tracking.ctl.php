<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: tracking.ctl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Tenders_Tracking extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;

        if($items = K::M('tenders/tracking')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:tenders/tracking/items.html';
    }





    public function create($look_id)
    {
         if(empty($look_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('tenders/look')->detail($look_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else{
            if($this->checksubmit()){
                if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }else{
                    $data['create_ip'] = __IP;
                    $data['dateline']  = __TIME;
                    $data['look_id'] = $look_id;
                    if($tracking_id = K::M('tenders/tracking')->create($data)){
                        $this->err->add('添加内容成功');
                        $this->err->set_data('forward', '?tenders/look-index-'.$detail['tenders_id'].'.html');
                    }
                } 
            }else{
                $this->pagedata['look_id'] = $look_id;
               $this->tmpl = 'admin:tenders/tracking/create.html';
            }
        }
    }

    public function edit($tracking_id=null)
    {
        if(!($tracking_id = (int)$tracking_id) && !($tracking_id = $this->GP('tracking_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('tenders/tracking')->detail($tracking_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                $data['reply_time'] = __TIME;
                if(K::M('tenders/tracking')->update($tracking_id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:tenders/tracking/edit.html';
        }
    }



}