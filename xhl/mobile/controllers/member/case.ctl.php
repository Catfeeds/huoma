<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 *$Id: case.ctl.php 3455 2015-02-25 06:40:14Z xinghuali $
 */

Import::C('member/ucenter');
class Ctl_Member_Case extends Ctl_Ucenter {

    protected $_case_create_allower_fields = 'home_id,huxing_id,designer_id,title,intro,seo_title,seo_keywords,seo_description';

    public function index($page = 1)
	{
        $this->check_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['company_id'] = $this->company['company_id'];
        $filter['closed'] = 0;
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $home_ids = $designer_ids = array();
            foreach ($items as $k => $v) {
                if ($v['home_id']) {
                    $home_ids[$v['home_id']] = $v['home_id'];
                }
                if ($v['designer_id']) {
                    $designer_ids[$v['designer_id']] = $v['designer_id'];
                }
            }
            if (!empty($home_ids)) {
                $this->pagedata['home_list'] = K::M('home/main')->items_by_ids($home_ids);
            }
            if (!empty($designer_ids)) {
                $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_ids);
            }
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}'), array(), true), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/case/index.html';
    }
    
     public function upload($case_id = null)
    {
        $this->check_company();    
        if(!$case_id = (int)$this->GP('case_id')){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }elseif ($case['company_id'] != $this->company['company_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/photo')->upload($case_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
    
    public function update($case_id = null)
	{
        $this->check_company();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['company_id'] != $this->company['company_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            $photo_ids = array();
            foreach($data as $k=>$v){
                $photo_ids[$k] = $k;
            }
            if(empty($photo_ids)){
                $this->err->add('没有您要更新的内容', 212);
            }
            elseif(!$photoinfos = K::M('case/photo')->items_by_ids($photo_ids)){
                $this->err->add('没有您要更新的内容', 212); 
            }else{
                $obj = K::M('case/photo');
                foreach($data as $k=>$v){
                    if($photoinfos[$k]['case_id'] == $case_id){
                        $obj->update($k, array('title'=>$v['title'], 'orderby'=>(int)$v['orderby']));
                    }
                }
                $this->err->add('更新成功');
            }            
        }        
    }    
    
    public function delete($photo_id= null)
	{
        $this->check_company();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/photo')->detail($photo_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif(!$case = K::M('case/case')->detail($detail['case_id'])){
              $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($case['company_id'] != $this->company['company_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else{
            if(K::M('case/photo')->delete($photo_id)){
                $this->err->add('删除成功');
            }
        }
        
    }
    
    public function pic($case_id = null,$page=1)
	{
        $this->check_company();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['company_id'] != $this->company['company_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else{
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 30;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
            if($items = K::M('case/photo')->items_by_case($case_id, $page, $limit, $count)){
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("member/case:pic", array($case_id,'{page}'),array(),true));
            }
            $this->pagedata['pager'] = $pager;
            $this->pagedata['case']  = $detail;
            $this->tmpl = 'member/case/pic.html';
        }
    }
    
    
    public function edit($case_id = null)
	{
        $this->check_company();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['company_id'] != $this->company['company_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data,  $this->_case_create_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if (K::M('case/case')->update($case_id, $data)) {
                    if($detail['home_id'] != $data['home_id']){
                        if($home_id = (int) $data['home_id']){
                            K::M('home/main')->update_count($home_id, 'case_num', 1);
                        }
                        if($home_id = (int)$detail['home_id']){
                             K::M('home/main')->update_count($home_id, 'case_num', -1);
                        }
                    }
                    if (!$attr = $this->GP('attr')) {
                        $attr = array();
                    }
                    K::M('case/attr')->update($case_id, $attr);
                    $this->err->add('修改内容成功');
                }
            }
        } else {
            if ($attrs = K::M('case/attr')->attrs_by_case($case_id)) {
                $this->pagedata['attrs'] = $attrs;
                $detail['attrvalues'] = array_keys($attrs);
            }
            if ($home_id = (int) $detail['home_id']) {
                $this->pagedata['home'] = K::M('home/main')->detail($home_id);
            }
            if ($huxing_id = (int) $detail['huxing_id']) {
                $this->pagedata['huxing'] = K::M('home/pics')->detail($huxing_id);
            }
            $this->pagedata['designers'] = K::M('designer/designer')->items(array('company_id' => $this->company['company_id']), array(), 1, 1000, $c);
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/case/edit.html';
        }
    }

    public function create()
	{
        $this->check_company();
        if(K::M('system/integral')->check('case',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }
        elseif ($audit = K::M('system/audit')->audit('case', $this->MEMBER) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        } elseif ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_case_create_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $data['company_id'] = $this->company['company_id'];
                $data['audit'] = $audit;
                $data['clientip'] = __IP;
                $data['dateline'] = __TIME;
                if ($case_id = K::M('case/case')->create($data)) {
                    if (!$attr = $this->GP('attr')) {
                        $attr = array();
                    }
                    K::M('case/attr')->update($case_id, $attr);
                    if ($company_id = (int) $data['company_id']) {
                        K::M('company/company')->update_count($company_id, 'case_num', 1);
                        K::M('company/company')->update($company_id, array('case_time'=>__TIME));
                    }
                    if ($home_id = (int) $data['home_id']) {
                        K::M('home/main')->update_count($home_id, 'case_num', 1);
                    }
                    if($home_id && $company_id){
                         K::M('home/main')->update($home_id, array('last_case_company_id'=>$company_id));
                    }
                    K::M('system/integral')->commit('case',  $this->MEMBER,'发布案例');
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('member/case:pic', array($case_id), array(), true));
                }
            }
        } else {
            $this->pagedata['designers'] = K::M('designer/designer')->items(array('company_id' => $this->company['company_id']), array(), 1, 1000, $c);
            $this->tmpl = 'member/case/create.html';
        }
    }

}
