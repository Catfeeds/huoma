<?php

Import::C('member/ucenter');

class Ctl_Member_News extends Ctl_Ucenter {
    
    protected  $_news_allow_fields = 'title,content';


    public function index(){
        $this->check_company();
        $filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 10;
        $filter['company_id'] = $this->company['company_id'];
        if($items = K::M('company/news')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/news/index.html';
    }
    
    public function create(){
        $this->check_company();
         if(K::M('system/integral')->check('news',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }
        elseif ($audit = K::M('system/audit')->audit('news', $this->MEMBER) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        }
        elseif($data = $this->checksubmit('data')){
            if(!$data = $this->check_fields($data,  $this->_news_allow_fields)){
                $this->err->add('非法的数据提交', 201);
            }else{
                $data['company_id']= $this->company['company_id'];
                $data['create_ip'] = __IP;
                $data['dateline']  = __TIME;
                $data['audit'] = $audit;
                if($news_id = K::M('company/news')->create($data)){
                     K::M('system/integral')->commit('news',  $this->MEMBER,'发布工厂新闻');
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('member/news:index',array(),array(),true));
                }
            } 
        }else{
           $this->tmpl = 'member/news/create.html';
        }
        
    }
    
    
    public function edit($news_id = 0){
        $this->check_company();
         if(!($news_id = (int)$news_id) && !($news_id = (int)$this->GP('news_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('company/news')->detail($news_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif($detail['company_id'] !=$this->company['company_id']){
            $this->err->add('就是想侮辱我的智商么', 212);
        }else if($data = $this->checksubmit('data')){
            if(!$data = $this->check_fields($data,  $this->_news_allow_fields)){
                $this->err->add('非法的数据提交', 201);
            }else{
                if(K::M('company/news')->update($news_id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'member/news/edit.html';
        }   
    }
    
    
}