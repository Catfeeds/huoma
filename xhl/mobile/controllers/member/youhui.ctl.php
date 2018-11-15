<?php
Import::C('member/ucenter');

class Ctl_Member_Youhui extends Ctl_Ucenter {
    
    protected  $_youhui_allow_fields = 'area_id,title,bg_date,end_date,content';


    public function index($page=1){
         $this->check_company();
         $filter = $pager = array();
         $pager['page'] = max(intval($page), 1);
         $pager['limit'] = $limit = 10;
         $filter['company_id'] = $this->company['company_id'];
         if ($items = K::M('company/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}'),array(),true), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/youhui/index.html';
    }
    
    public function sign($youhui_id = 0,$page=1){
        $this->check_company();
        if (!($youhui_id = (int) $youhui_id) && !($youhui_id = (int)$this->GP('youhui_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('company/youhui')->detail($youhui_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($detail['company_id'] != $this->company['company_id']){
            $this->err->add('别侮辱程序员的智商', 212);
        }
        else{
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 10;
            $filter['youhui_id'] = $youhui_id;
            if($items = K::M('company/sign')->items($filter, null, $page, $limit, $count)){
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($youhui_id,'{page}'),array(),true), array());
            }
            $this->pagedata['items']  = $items;
            $this->pagedata['pager']  = $pager;
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/youhui/sign.html';
        }       
    }
    
    
    public function edit($youhui_id = 0){
        $this->check_company();
        if (!($youhui_id = (int) $youhui_id) && !($youhui_id = (int)$this->GP('youhui_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('company/youhui')->detail($youhui_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($detail['company_id'] != $this->company['company_id']){
            $this->err->add('别侮辱程序员的智商', 212);
        }
        else if ($data = $this->checksubmit('data')) {
             if (!$data = $this->check_fields($data,  $this->_youhui_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'company')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }

                if (K::M('company/youhui')->update($youhui_id, $data)) {
                    $this->err->add('修改内容成功');
                }
            }
        } else {
      
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/youhui/edit.html';
        }
        
    }




    public function  create(){
        $this->check_company();
        if(K::M('system/integral')->check('youhui',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }
        elseif ($audit = K::M('system/audit')->audit('youhui', $this->MEMBER) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        }
        else if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data,  $this->_youhui_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $cfg = K::$system->config->get('attach');
                    $oImg = K::M('image/gd');
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'company')) {
                                $data[$k] = $a['photo'];
                                $size['photo'] = $cfg['youhui']['photo'] ? $cfg['youhui']['photo'] : 200;
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
                $data['company_id'] = $this->company['company_id'];
                $data['city_id'] = $this->company['city_id'];
                $data['dateline'] = __TIME;
                $data['create_ip'] = __IP;
                $data['audit'] = $audit;

                if ($youhui_id = K::M('company/youhui')->create($data)) {
                    K::M('system/integral')->commit('youhui',  $this->MEMBER,'发布优惠信息');
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('member/youhui:index',array(),array(),true));
                }
            }
        } else {
           $this->tmpl = 'member/youhui/create.html';
        }
        
        
    }
    
    
}