<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-12-01 13:02:23  xinghuali
 */

class Ctl_Chao_Tezhuang extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/tezhuang-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);
        }
    }    

    public function index($case_id,$page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
		$chao = $this->check_chao($case_id);
		K::M('case/case')->update_count($case_id, 'views', 1);
        if($company_id = $chao['company_id']){
		  $this->pagedata['company'] = K::M('company/company')->detail($chao['company_id']);    
        }else if($member = K::M('member/member')->member($chao['uid'])){
            if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($chao['uid']);
            }
        }
        if($attr_values = K::M('case/attr')->attrs_by_case($case_id)){
                $chao['attrvalues'] = $attr_values;
        }
		$this->pagedata['photos'] = K::M('case/photo')->items_by_case($case_id, 1, 50);
        // var_dump($this->pagedata['photos']);die;
		$filter = $pager = array();
		$pager['page'] = max(intval($page), 1);
		$pager['limit'] = $limit = 5;
		$filter['case_id'] = $case_id;
		if ($items = K::M('chao/comment')->items($filter,array('dateline'=>'desc'), $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('chao/tezhuang', array($case_id,'{page}')));            
			$uids = array();
			foreach ($items as $k => $v) {
				$uids[$v['uid']] = $v['uid'];
			}
            if($uids){
                $this->pagedata['user_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['items'] = $items;            
		}
		if($chao_xiangguan = K::M('case/case')->items(array('mianji'=>$chao['mianji'],'tzaudit'=>1,'closed'=>0), array('case_id'=>'DESC'), 1, 8, $count)){
			$this->pagedata['chao_xiangguan'] = $chao_xiangguan;
		
		}
		$access = $this->system->config->get('access');
		$this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        $this->pagedata['detail'] = $chao;
        $this->pagedata['pager'] = $pager;
		$this->tmpl = 'mobile:chao/tezhuang.html';
    }

    public function imgpage($case_id,$page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $chao = $this->check_chao($case_id);
        K::M('case/case')->update_count($case_id, 'views', 1);
        if($company_id = $chao['company_id']){
          $this->pagedata['company'] = K::M('company/company')->detail($chao['company_id']);    
        }else if($member = K::M('member/member')->member($chao['uid'])){
            if($member['from'] == 'designer'){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($chao['uid']);
            }
        }
        if($attr_values = K::M('case/attr')->attrs_by_case($case_id)){
                $chao['attrvalues'] = $attr_values;
        }
        $this->pagedata['photos'] = K::M('case/photo')->items_by_case($case_id, 1, 50);
        // var_dump($this->pagedata['photos']);die;
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 5;
        $filter['case_id'] = $case_id;
        if ($items = K::M('chao/comment')->items($filter,array('dateline'=>'desc'), $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('chao/tezhuang', array($case_id,'{page}')));            
            $uids = array();
            foreach ($items as $k => $v) {
                $uids[$v['uid']] = $v['uid'];
            }
            if($uids){
                $this->pagedata['user_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['items'] = $items;            
        }
        if($chao_xiangguan = K::M('case/case')->items(array('mianji'=>$chao['mianji'],'tzaudit'=>1,'closed'=>0), array('case_id'=>'DESC'), 1, 8, $count)){
            $this->pagedata['chao_xiangguan'] = $chao_xiangguan;
        
        }
        $access = $this->system->config->get('access');
        $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        $this->pagedata['detail'] = $chao;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:chao/imgpage.html';
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
				$chao = $this->check_chao($case_id);
				$data = array(
					'case_id' => $case_id,
					'uid' => $this->uid,
					'content' => $content,
					'audit' => $audit,
					'city_id' => $this->request['city_id']
				);
				K::M('chao/comment')->create($data);
				$this->err->add('评论成功！');
			}
        }
	}

	protected function check_chao($case_id)
    {
		if (!$case_id = (int) $case_id) {
            $this->error(404);
        }else if (!$chao = K::M('case/case')->detail($case_id)) {
            $this->error(404);
        }elseif (!$chao['audit']) {
           $this->err->add("内容审核中，暂不可访问", 211)->response();
        }
		$this->pagedata['uri'] = $this->request['uri'];
        $this->pagedata['detail'] = $chao;
        return $chao;
    }

    public function like($case_id)
    {
        if (!$case_id = (int) $case_id) {
            $this->err->add('案例不存在', 211);
        }else if (!$chao = K::M('case/case')->detail($case_id)) {
            $this->err->add('案例不存在', 212);
        }else if (!$chao['audit']) {
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