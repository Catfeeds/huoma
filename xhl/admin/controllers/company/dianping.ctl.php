<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: dianping.ctl.php 2034 2015-11-07 03:08:33Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Company_Dianping extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['company_id']){$filter['company_id'] = $SO['company_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['mobile']){$filter['mobile'] = "LIKE:%".$SO['mobile']."%";}
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            if($SO['home_name']){$filter['home_name'] = "LIKE:%".$SO['home_name']."%";}
            if($SO['is_rec']){$filter['is_rec'] = $SO['is_rec'];}
            if($SO['audit']){$filter['audit'] = $SO['audit'];}
        }
        $uids = $companyIds = array();
        if($items = K::M('company/dianping')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['uid'])) $uids[$v['uid']] = $v['uid'];
               if(!empty($v['company_id']))  $companyIds[$v['company_id']] = $v['company_id'];
                  $items[$k]['create_ip'] = $v['create_ip'].'('. K::M("misc/location")->location($v['create_ip']) .')';
            } 
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['userList'] = K::M('member/view')->items_by_ids($uids);
        $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($companyIds);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->system->config->get('company_dianping');
        $this->tmpl = 'admin:company/dianping/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:company/dianping/so.html';
    }


    
    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                $data['dateline']   = __TIME;
                $data['create_ip']  = __IP;
                $data['reply_time'] = __TIME + rand(1000,86400);
                $data['reply_ip']   = __IP;
                if($id = K::M('company/dianping')->create($data)){
                    if(!empty($data['company_id'])){
                        $update = K::M('company/dianping')->get_count_by_company_id($data['company_id']);
                        if(!empty($update)){
                            K::M('company/company')->update($data['company_id'],$update);
                        }
                    }
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?company/dianping-index.html');
                }
            } 
        }else{
           $this->system->config->get('company_dianping');
           $this->tmpl = 'admin:company/dianping/create.html';
        }
    }
    public function audit($id = null)
    {
        if ($id = (int) $id) {
            if (K::M('company/dianping')->update($id,array('audit'=>1))) {
                $this->err->add('审核成功');
            }
        } else if ($ids = $this->GP('id')) {
            if (K::M('company/dianping')->batch($ids,array('audit'=>1))) {
                $this->err->add('审核成功');
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }
    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('company/dianping')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if(K::M('company/dianping')->update($id, $data)){
                     if(!empty($data['company_id'])){
                        $update = K::M('company/dianping')->get_count_by_company_id($data['company_id']);
                        if(!empty($update)){
                            K::M('company/company')->update($data['company_id'],$update);
                        }
                    }
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/view')->detail($uid);
            }
            if($company_id = $detail['company_id']){
                $this->pagedata['company'] = K::M('company/company')->detail($company_id);
            }
            $this->system->config->get('company_dianping');
        	$this->tmpl = 'admin:company/dianping/edit.html';
        }
    }

    public function delete($id=null)
    {
        if($id = (int)$id){
            if(K::M('company/dianping')->delete($id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('id')){
            if(K::M('company/dianping')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}