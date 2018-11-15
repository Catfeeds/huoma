<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: company.ctl.php 9892 2015-04-25 08:15:30Z maoge $
 */

class Ctl_Gong_Chang extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $system->request['uri'];
        if(preg_match('/chang(-index)?-(\d+).html/i', $uri, $match)){
            $system->request['act'] = 'index';
            $system->request['args'] = array($match[2]);
        }
    }

    public function index($company_id)
    {
        $this->detail($company_id);
    }

    public function detail($company_id)
    {
        $company = $this->check_company($company_id);

        $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;

        $company['desc'] = K::M('content/html')->text($company['info']);
        //var_dump($company['desc']);die;
        $this->pagedata['company'] = $company;
		$comment_list = K::M('company/comment')->items(array('company_id'=>$company_id,'audit'=>'1'),null, 1, 4);
        
        $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id,1,4);	

        $this->pagedata['photo_banner'] = K::M('company/banner')->items(array('company_id' => $company_id), array('orderby' => 'asc'), 1, 5);

        $uids = array();
		foreach($comment_list as $k => $v){
			$uids[$v['uid']] = $v['uid'];
		}
		if($uids){
			$this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
		}

        if($items = K::M('case/case')->items(array('company_id'=>$company['company_id'],'audit'=>1, 'closed'=>0), array('case_id'=>'DESC'), 1, 4, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
		
		//var_dump($items);die;

         if($news = K::M('company/news')->items_by_company($company_id, 1, 4, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['news'] = $news;
        }

		$this->pagedata['comment_list'] = $comment_list; 

        $this->pagedata['pager'] = $pager;  
        $this->pagedata['seo_title'] = $company['title'].'_工厂首页';  
        $this->tmpl = 'mobile:gong/factoryindex.html';
    }

    public function jieshao($company_id)
    {
        $company = $this->check_company($company_id);
        $company['desc'] = K::M('content/html')->text($company['info']);
        
        $this->pagedata['company'] = $company;
        $comment_list = K::M('company/comment')->items(array('company_id'=>$company_id,'audit'=>'1'),null, 1, 4);

        $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id);

        $this->pagedata['photo_banner'] = K::M('company/banner')->items(array('company_id' => $company_id), array('orderby' => 'asc'), 1, 5);
       // var_dump($this->pagedata['photo_banner']);die;

        $uids = array();
        foreach($comment_list as $k => $v){
            $uids[$v['uid']] = $v['uid'];
        }
        if($uids){
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        
        $this->pagedata['comment_list'] = $comment_list; 
       // var_dump(  $this->pagedata['photo_list']);die;
        $this->pagedata['seo_title'] = $company['title'].'_工厂介绍';  
        $this->tmpl = 'mobile:gong/factoryinfo.html';
    }


    public function anli($company_id, $page=1)
    {
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1, 'closed'=>0);
        $filter['company_id'] = $company_id;
        if($items = K::M('case/case')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
		//var_dump($items);die;
		
        $this->pagedata['pager'] = $pager;
        $this->pagedata['seo_title'] = $company['title'].'_工程案例';  
        $this->tmpl = 'mobile:gong/factorycase.html';
    }

    public function caselistcon($company_id, $page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }

        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1, 'closed'=>0);
        $filter['company_id'] = $company_id;
        if($items = K::M('case/case')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
        //var_dump($items);die;
        
        $this->pagedata['pager'] = $pager;
        $this->pagedata['seo_title'] = $company['title'].'_工程案例';  
        $this->tmpl = 'mobile:gong/caselistcon.html';
    }

    public function casedetails($case_id, $page=1)
    {
        $case = $this->check_case($case_id);
       // var_dump($case);die; 

        K::M('case/case')->update_count($case_id, 'views', 1);
        if($company_id = $case['company_id']){
          $this->pagedata['company'] = K::M('company/company')->detail($case['company_id']);
        }else if($member = K::M('member/member')->member($case['uid'])){
            if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($case['uid']);
            }
        }
        if($attr_values = K::M('case/attr')->attrs_by_case($case_id)){
            foreach($attr_values as $k=>$v){
                $case['attrvalues'][$k] = $v['attr_value_id'];
            }
        }
        $this->pagedata['photos'] = K::M('case/photo')->items_by_case($case_id, 1, 50);
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 5;
        $filter['case_id'] = $case_id;
        if ($items = K::M('case/comment')->items($filter,array('dateline'=>'desc'), $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('case:detail', array($case_id,'{page}')));            
            $uids = array();
            foreach ($items as $k => $v) {
                $uids[$v['uid']] = $v['uid'];
            }
            if($uids){
                $this->pagedata['user_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['items'] = $items;            
        }
        $access = $this->system->config->get('access');
        $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        $this->pagedata['detail'] = $case;
        $this->pagedata['pager'] = $pager;
        $this->seo->init('case_detail',array(
            'title' => $case['title'],
            'seo_title' => $case['seo_title'],
            'seo_keywords' => $case['seo_keywords'],
            'seo_description' => $case['seo_description'],
        ));
        $this->tmpl = 'mobile:gong/factoryarticle.html';
    }

    public function youhui($company_id, $page=1)
    {
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['company_id'] = $company_id;
        $filter['audit'] = 1;
        if($items = K::M('company/youhui')->items($company_id, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
        $this->tmpl = 'mobile:company/youhui.html';
    }

    public function dongtai($company_id, $page=1)
    {
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if($items = K::M('company/news')->items_by_company($company_id, $page, $limit, $count)){
          // var_dump($items);die;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->pagedata['seo_title'] = $company['title'].'_工厂动态';  
        $this->tmpl = 'mobile:gong/factorynews.html';
    }

    public function newlistcon($company_id, $page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if($items = K::M('company/news')->items_by_company($company_id, $page, $limit, $count)){
          // var_dump($items);die;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->pagedata['seo_title'] = $company['title'].'_工厂动态';  
        $this->tmpl = 'mobile:gong/newlistcon.html';
    }

   /* public function shebei($company_id, $page=1)
    {
        $company = $this->check_company($company_id);
        $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id);
        $this->pagedata['seo_title'] = $company['title'].'_工厂设备';  
        $this->tmpl = 'mobile:gong/factorymachine.html';
    }*/

    public function shebei($company_id, $page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit =20;
        $pager['count'] = $count = 0;
        $filter['company_id'] = $company_id;
        if($items = K::M('company/photo')->items_by_company($company_id,$page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager; 
       // $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id);
        $this->pagedata['seo_title'] = $company['title'].'_工厂设备';  
        $this->tmpl = 'mobile:gong/factorymachine.html';
    }

    public function machinelistcon($company_id, $page=0){
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit =20;
        $pager['count'] = $count = 0;
        $filter['company_id'] = $company_id;
        if($items = K::M('company/photo')->items_by_company($company_id,$page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
       // $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id);
        $this->pagedata['seo_title'] = $company['title'].'_工厂设备';  
        $this->tmpl = 'mobile:gong/machinelistcon.html';
    }

    public function danbao($company_id, $page=1)  
    {
        $company = $this->check_company($company_id);
        $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id);
        $this->seo->set_company($company);
        $this->seo->init('company');
        $this->tmpl = 'mobile:gong/factorycredit.html';
    }

    public function pingjia($company_id, $page=1)
    {
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if($items = K::M('company/comment')->items_by_company($company_id, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($company_id, '{page}')));
            $uids = array();
            foreach($items as $v){
                $uids[$v['uid']] = $v['uid'];
            }
            if($uids){
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['items'] = $items;
        }
		
		$access = $this->system->config->get('access');
		$this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        $this->pagedata['seo_title'] = $company['title'].'_参展商评价';  
        $this->tmpl = 'mobile:gong/factorydiscuss.html';
    }

    public function savecomment($company_id=null)
    {
        $this->check_login();
        if(!($company_id = (int)$company_id) && !($company_id = (int)$this->GP('company_id'))){
            $this->error(404);
        }
        $company = $this->check_company($company_id);
        $allow_comment = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_comment');
        //var_dump($allow_comment);die;
        if($allow_comment < 0){
            $this->err->add('您是【'.$this->MEMBER['group_name'].'】没有权限发表点评', 333);
        }else if(!$data = $this->checksubmit('data')){
            $this->err->add('非法的数据提交', 211);
        }else if(!$data = $this->check_fields($data, 'score1,score2,score3,score4,score5,content')){
            $this->err->add('非法的数据提交', 212);
        }else{
			$verifycode_success = true;
			$access = $this->system->config->get('access');
			if($access['verifycode']['comment']){
				if(!$verifycode = $this->GP('verifycode')){
					$verifycode_success = false;
					$this->err->add('验证码不正确', 212);
				}else if(!K::M('magic/verify')->check($verifycode)){
					$verifycode_success = false;
					$this->err->add('验证码不正确', 212);
				}
			}
			if($verifycode_success){
				$data['city_id'] = $company['city_id'];
				$data['company_id'] = $company_id;
				$data['uid'] = $this->uid;
				$data['audit'] = $allow_comment;
				if($comment_id = K::M('company/comment')->create($data)){
					K::M('company/comment')->comment_count($company_id);
					K::M('company/comment')->comment($data);
					$this->err->add('发表点评成功');
				}
			}
        }
    }
    public function check_company(&$company_id=null)
    {
        if(!$company_id = (int)$company_id){
            $this->error(404);
        }else if(!$company = K::M('company/company')->detail($company_id, true)){
            $this->error(404);
        }else if(empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))){
            $this->err->add('企业审核中不能访问', 212);
            $this->err->response();
        }
        if($uid = $company['uid']){
            $company['member'] = K::M('member/member')->detail($uid);
        }
        if($group_id = $company['group_id']){
            $company['group'] = K::M('member/group')->group($group_id);
        }        
        $this->pagedata['company'] = $company;
        K::M('company/company')->update_count($company_id, 'views', 1);
        return $company; 
    }  
}