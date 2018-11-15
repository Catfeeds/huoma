<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: attrvalue-bk.ctl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Data_Attrvalue extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;

        if($items = K::M('data/attrvalue')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:data/attr/value/items.html';
    }





    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if($attr_value_id = K::M('data/attrvalue')->create($data)){
                $this->err->add('修改内容成功');
                $this->err->set_data('forward', '?data/attrvalue-index.html');

            }
        }else{
           $this->tmpl = 'admin:data/attr/value/create.html';
        }
    }

    public function edit($pk=null)
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(!$attr_value_id = $this->GP('attr_value_id')){
                $this->err->add('未指要修改ID', 202);
            }else if(K::M('data/attrvalue')->update($attr_value_id, $data)){
                $this->err->add('修改内容成功');

            }
        }else{
        	$this->pagedata['detail'] = K::M('data/attrvalue')->detail($pk);
        	$this->tmpl = 'admin:data/attr/value/edit.html';
        }
    }

    public function delete($pk=null)
    {
        if(!empty($pk)){
            if(K::M('data/attrvalue')->delete($pk)){
                $this->err->add('删除成功');
            }
        }else if($pks = $this->GP('attr_value_id')){
            if(K::M('data/attrvalue')->delete($pks)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}