<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: case.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
class Ctl_Sheji_Anli extends Ctl
{
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/anli-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }
	
	public function index($case_id, $page = 0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
		$case = $this->check_case($case_id);
		K::M('case/case')->update_count($case_id, 'views', 1);
        
      /*  if($company_id = $case['company_id']){
          $this->pagedata['company'] = K::M('company/company')->detail($case['company_id']);
        }else if($member = K::M('member/member')->member($case['uid'])){
            if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($case['uid']);
            }
        }*/
        if($member = K::M('member/member')->member($case['uid'])){
          if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($case['uid']);
            }
        }else if($company_id = $case['company_id']){
           $this->pagedata['company'] = K::M('company/company')->detail($case['company_id']);
        }
        //var_dump($this->pagedata['designer'] );die;


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
		$this->tmpl = 'mobile:sheji/casedetail.html';
    }

    public function caseimg($case_id, $page = 0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $case = $this->check_case($case_id);
        K::M('case/case')->update_count($case_id, 'views', 1);
        
      /*  if($company_id = $case['company_id']){
          $this->pagedata['company'] = K::M('company/company')->detail($case['company_id']);
        }else if($member = K::M('member/member')->member($case['uid'])){
            if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($case['uid']);
            }
        }*/
        if($member = K::M('member/member')->member($case['uid'])){
          if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($case['uid']);
            }
        }else if($company_id = $case['company_id']){
           $this->pagedata['company'] = K::M('company/company')->detail($case['company_id']);
        }
        //var_dump($this->pagedata['designer'] );die;


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
        $this->tmpl = 'mobile:sheji/caseimg.html';
    }

	protected function check_case($case_id)
    {
		if (!$case_id = (int) $case_id) {
            $this->error(404);
        }else if (!$case = K::M('case/case')->detail($case_id)) {
            $this->error(404);
        }elseif (!$case['audit']) {
           $this->err->add("内容审核中，暂不可访问", 211)->response();
        }
		$this->pagedata['uri'] = $this->request['uri'];
        $this->pagedata['detail'] = $case;
        return $case;
    }

    public function like($case_id)
    {
        if (!$case_id = (int) $case_id) {
            $this->err->add('案例不存在', 211);
        }else if (!$case = K::M('case/case')->detail($case_id)) {
            $this->err->add('案例不存在', 212);
        }else if (!$case['audit']) {
            $this->err->add('该案例还未通过审核', 212);
        }else if (K::M('case/like')->is_like($case_id, __IP)) {
            $this->err->add('已经喜欢过了', 212);
        } else {
            $data = array('case_id' => $case_id, 'uid' => $this->uid, 'create_ip' => __IP, 'dateline' => __TIME);
            K::M('case/like')->create($data);
            K::M('case/case')->update_count($case_id, 'likes', 1);
            $this->err->add('喜欢成功');
        }
    }
}