<?php

Import::C('member/ucenter');

class Ctl_Member_Canzhan extends Ctl_Ucenter {
    
    public function  index($page = 1){
        $this->check_company();
        $filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 10;
        $canzhan_ids = array();
        $filter['company_id'] = $this->company['company_id'];
        if($items = K::M('canzhan/look')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
                $canzhan_ids[$v['canzhan_id']] = $v['canzhan_id'];
                $items[$k]['create_ip'] = $v['create_ip'].'('. K::M("misc/location")->location($v['create_ip']) .')';                
            }
            $pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}'),array(),true), array());
        }
        $this->pagedata['canzhan'] = K::M('canzhan/canzhan')->items_by_ids($canzhan_ids);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/canzhan/index.html';  
    }
    
    
    public function tracking($look_id = null){
        $this->check_company();
        if(!$look_id){
             $this->err->add('没有您的标', 211);
        }
        elseif(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('没有您的标', 211);
        }elseif($look['company_id'] != $this->company['company_id']){
            $this->err->add('你妹啊', 211);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($look['canzhan_id'])){
            $this->err->add('该招标数据不存在！可能由管理员删除', 212);
        }else{
            if($home_id = (int)$detail['home_id']){
                $this->pagedata['home'] = K::M('home/main')->detail($home_id);
            }
            $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
            $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
            $this->pagedata['setting'] = K::M('canzhan/setting')->fetch_all_setting();
            $this->pagedata['type']  = K::M('canzhan/setting')->get_type();
            $this->pagedata['detail'] = $detail;            
            $this->pagedata['tracking'] = K::M('canzhan/tracking')->items(array('look_id'=>$look_id), null, 1, 10, $count); 
            $this->pagedata['look_id'] = $look_id;
            $this->pagedata['look'] = $look;
            $this->tmpl = 'member/canzhan/tracking.html';
        }      
    }
    
    public function create($look_id = null){
        $this->check_company();
        if(!$look_id){
             $this->err->add('没有您的标', 211);
        }
        elseif(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('没有您的标', 211);
        }elseif($look['company_id'] != $this->company['company_id']){
            $this->err->add('非法查看', 211);
        }else{
             if(!$post = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
            }else{
                $data = array(
                    'create_ip' => __IP,
                    'dateline'  => __TIME,
                    'look_id'   => $look_id,
                    'content'   => $post['content'],
                );
      
                if($tracking_id = K::M('canzhan/tracking')->create($data)){
                    $this->err->add('添加内容成功');
                }
            } 
        }
        
        
    }
    
    
    //招标
    public function in($page = 1){
        $this->check_company();
        $filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 10;
        $filter['city_id'] = $this->company['city_id'];
        $filter['status'] = 0;
        $filter['audit'] = 1;      
        $canzhan_ids =  array();
        if($items = K::M('canzhan/canzhan')->items($filter, array('id'=>'DESC'), $page, $limit, $count)){
            foreach($items as $k=>$v){
                $canzhan_ids[$v['id']] = (int)$v['id'];
                $items[$k]['create_ip'] = $v['create_ip'].'('. K::M("misc/location")->location($v['create_ip']) .')';
            }
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array());
        }

        $looks = K::M('canzhan/look')->items(array('canzhan_id'=>$canzhan_ids,'company_id'=>  $this->company['company_id']));
        $lookIds = array();
        foreach($looks as $val){
            $lookIds[$val['canzhan_id']] = $val['canzhan_id']; 
        }
  
        $this->pagedata['lookIds'] = $lookIds;
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/canzhan/in.html';
    }
    
    public function look($id = null){
        $this->check_company();
        if(!($id = (int)$id) && !($id = (int)$this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif(!$detail['audit']){
            $this->err->add('该招标还没有公布不好意思!', 212); 
        }elseif((int)$detail['status'] === 1){
            $this->err->add('该招标已经结束了!', 212); 
        }elseif($detail['num2'] >= $detail['num']){
            $this->err->add('该招标已经结束了!', 212); 
        }elseif($this->MEMBER['gold'] < $detail['gold']){
            $this->err->add('账户余额不足!', 212); 
        }else{
            if($detail['gold'] > 0){
                if(!K::M('member/gold')->update($this->uid, -$detail['gold'], "看标：".$detail['title'])) $this->err->add('扣费失败', 201)->response();
            }
            $data = array(
               'canzhan_id' => $id,
               'company_id' =>  $this->company['company_id'],
               'dateline'   =>  __TIME,
               'create_ip'  =>  __IP 
            );
            if($look_id = K::M('canzhan/look')->create($data)){
                K::M('canzhan/canzhan')->update_count($id,'num2');
                $this->err->add('看标成功！');
            }else{
                $this->err->add('更新数据失败！');  
            }               
        }       
    }
    
    public function view($id = null){
         $this->check_company();
         if(!($id = (int)$id) && !($id = (int)$this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif(!$detail['audit']){
            $this->err->add('该招标还没有公布不好意思!', 212); 
        }else{
             K::M('canzhan/canzhan')->update_count($id,'pv_num');
            if($home_id = (int)$detail['home_id']){
                $this->pagedata['home'] = K::M('home/main')->detail($home_id);
            }
            $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
            $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
            $this->pagedata['setting'] = K::M('canzhan/setting')->fetch_all_setting();
            $this->pagedata['type']  = K::M('canzhan/setting')->get_type();
            $this->pagedata['detail'] = $detail;
            $this->pagedata['look'] = K::M('canzhan/look')->items(array('canzhan_id'=>$id,'company_id'=>  $this->company['company_id']));
            $this->tmpl = 'member/canzhan/view.html';
        }
    }
    
    
    
}