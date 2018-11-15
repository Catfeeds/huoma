<?php
Import::C('member/ucenter');

class Ctl_Member_Banner extends Ctl_Ucenter {
    
    public function index($page = 1){
        $this->check_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['company_id'] = $this->company['company_id']; 
        if ($items = K::M('company/banner')->items($filter, null, $page, $limit, $count)) {
           
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}'),array(),true), array('SO' => $SO));
        }

        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/banner/index.html';
    }
    
    public function update(){
        $this->check_company();
        if (!$data = $this->GP('data')) {
            $this->err->add('非法的数据提交', 201);
        }else{
            foreach($data as $id=>$val){
                $id = (int)$id;
                if(!$detail =K::M('company/banner')->detail($id) ){
                    $this->err->add('非法的数据提交', 201);
                    die;
                }elseif($detail['company_id'] != $this->company['company_id']){
                    $this->err->add('你傻了吧！', 201);
                    die;
                }else{
                    K::M('company/banner')->update($id, $val);
                }   
            }  
            $this->err->add('操作成功');
          }
        
    }


    public function edit($banner_id = null){
        $this->check_company();
        if (!($banner_id = (int) $banner_id) && !($banner_id = (int)$this->GP('banner_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('company/banner')->detail($banner_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif($detail['company_id'] != $this->company['company_id']){
             $this->err->add('别当我是弱智傻逼!', 212);
        } else if ($this->checksubmit('data')) {
            if (!$data = $this->GP('data')) {
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
                $filter['company_id'] = $this->company['company_id']; 
                if (K::M('company/banner')->update($banner_id, $data)) {
                    $this->err->add('修改内容成功');
                }
            }
        } else {
     
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/banner/edit.html';
        }
        
    }
    
    public function create(){
         $this->check_company();
         if( K::M('company/banner')->get_count_by_company_id($this->company['company_id']) < 5){
                if ($this->checksubmit()) {
                  if (!$data = $this->GP('data')) {
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

                      if ($banner_id = K::M('company/banner')->create($data)) {
                          $this->err->add('添加内容成功');
                          $this->err->set_data('forward', $this->mklink('member/banner:index',array(),array(),true));
                      }
                  }
              } else {
                  $this->tmpl = 'member/banner/create.html';
              }
         }else{
               $this->err->add('商家横幅广告最多不能超过5张');
               $this->err->set_data('forward', $this->mklink('member/banner:index',array(),array(),true));
         }
        
    }
    
    
}