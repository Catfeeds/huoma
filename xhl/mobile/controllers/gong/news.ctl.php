<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: News.ctl.php 2016-01-11 16:51:23  xinghuali
 */

class Ctl_Gong_News extends Ctl
{
    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $system->request['uri'];
        if(preg_match('/news(-index)?-(\d+).html/i', $uri, $match)){
            $system->request['act'] = 'index';
            $system->request['args'] = array($match[2]);
        }
    }
	public function index($news_id, $page = 1)
    {
		if(!$news_id = (int)$news_id){
            $this->error(404);
        }else if(!$detail = K::M('company/news')->detail($news_id)){
            $this->error(404);
        }else{
			K::M('company/news')->update_count($news_id, 'views', 1);
             $this->pagedata['detail'] = $detail;
			$this->pagedata['company'] = $company = K::M('company/company')->detail($detail['company_id']);

	        $this->pagedata['seo_title'] = $detail['title'].'_'.$company['title'];  
            $this->tmpl = 'mobile:gong/news.html';
        }
    }

	public function comment($case_id)
	{
		if(!$this->check_login()){
			$this->err->add('您还没有登录，不能评论', 101);
		}elseif (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'],'allow_comment')) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        }elseif (!$content = $this->GP('content')) {
              $this->err->add('评论内容不能不能为空', 211);
        }else {
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
				$case = $this->check_case($case_id);
				$data = array(
					'case_id' => $case_id,
					'uid' => $this->uid,
					'content' => $content,
					'audit' => $audit,
					'city_id' => $this->request['city_id']
				);
				K::M('case/comment')->create($data);
				$this->err->add('评论成功！');
			}
        }
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