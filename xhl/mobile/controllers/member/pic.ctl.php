<?php

Import::C('member/ucenter');

class Ctl_Member_Pic extends Ctl_Ucenter {

    protected $_pic_allow_fields = 'type,title';

    public function index($page = 1) {
        $this->check_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['company_id'] = $this->company['company_id'];
        if ($items = K::M('company/pic')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['type'] = K::M('company/pic')->get_type_means();
        $this->tmpl = 'member/pic/index.html';
    }

    public function create() {
        $this->check_company();
        if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_pic_allow_fields)) {
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
                $data['company_id'] = $this->company['company_id'];
                if ($pic_id = K::M('company/pic')->create($data)) {
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward',  $this->mklink('member/pic:index',array(),array(),true));
                }
            }
        } else {
            $this->pagedata['type'] = K::M('company/pic')->get_type_means();
            $this->tmpl = 'member/pic/create.html';
        }
    }

    public function edit($pic_id=0) {
        $this->check_company();
        if (!($pic_id = (int) $pic_id) && !($pic_id = (int)$this->GP('pic_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('company/pic')->detail($pic_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif($detail['company_id'] != $this->company['company_id']){
             $this->err->add('死开犊子！乱搞灭了你！', 201);    
        } else if ($data=$this->checksubmit('data')) {
             if (!$data = $this->check_fields($data, $this->_pic_allow_fields)) {
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
                
                if (K::M('company/pic')->update($pic_id, $data)) {
                    $this->err->add('修改内容成功');
                }
            }
        } else {
    
            $this->pagedata['detail'] = $detail;
            $this->pagedata['type'] = K::M('company/pic')->get_type_means();
            $this->tmpl = 'member/pic/edit.html';
        }
        
    }

}
