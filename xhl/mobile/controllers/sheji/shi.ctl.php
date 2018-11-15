<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: designer.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Sheji_Shi extends Ctl
{
    
    //public $_call = 'index';
    //private $_action = array('items', 'about', 'attention', 'cases', 'article', 'article_info','comment' ,'check_designer');
   

    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/shi-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);
        }
    }

    public function index($uid,$page=1)
    {
        $designer = $this->check_designer($uid);
		//var_dump($designer);die;
		$pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1,  'closed'=>0,  'uid'=>$uid);
		if($items = K::M("designer/article")->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji/article', array($uid,'{page}')));
            $this->pagedata['items'] = $items;
        }     
		//var_dump($pager);die;
        if($cases = K::M('case/case')->items($filter, null, 1, 6, $count)){
			$case_ids = '';
			$i = 0;
			foreach($cases as $key=>$val){
				if($i==0){
					$case_ids = $val['case_id'];
				}else{
					$case_ids .= ','.$val['case_id'];
				}
				$i++;
			}
			$items_shi = K::M('case/photo')->items_shi($case_ids);
			foreach($cases as $key=>$val){
				$val['photos'] = $items_shi[$key];
				$cases[$key] = $val;
			}

            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji/cases', array($uid, '{page}')));
            $this->pagedata['cases'] = $cases;
        }

        K::M('designer/designer')->update_count($uid, 'views', 1);
        if($designer['company_id']){
           $this->pagedata['company'] = K::M('company/company')->detail($designer['company_id']);
        }
        $comment_info = K::M("designer/comment")->items(array('designer_id'=>$uid),array('comment_id'=>'desc'),1,3);
        foreach($comment_info as $k => $v){
            $uids[$v['uid']] = $v['uid'];
        }
        if(!empty($uids)){
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        $this->pagedata['comment_list'] = $comment_info;
        $this->pagedata['designer'] = $designer;
		
		$this->pagedata['pager'] = $pager;  
		//var_dump($pager);die;
        $this->tmpl = 'mobile:sheji/shicenter.html';
    }

    public function usercentercase($uid,$page=0)
    {
        $designer = $this->check_designer($uid);
        
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit =10;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1,  'closed'=>0,  'uid'=>$uid);
          
        if($cases = K::M('case/case')->items($filter, null, $page, $limit, $count)){
            $case_ids = '';
            $i = 0;
            foreach($cases as $key=>$val){
                if($i==0){
                    $case_ids = $val['case_id'];
                }else{
                    $case_ids .= ','.$val['case_id'];
                }
                $i++;
            }
            $items_shi = K::M('case/photo')->items_shi($case_ids);
            foreach($cases as $key=>$val){
                $val['photos'] = $items_shi[$key];
                $cases[$key] = $val;
            }

            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji/cases', array($uid, '{page}')));
            $this->pagedata['cases'] = $cases;
        }
        
        if(!empty($uids)){
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        $this->pagedata['designer'] = $designer;
        
        $this->pagedata['pager'] = $pager;  
        $this->tmpl = 'mobile:sheji/usercentercase.html';
    }

     public function usercenterart($uid,$page=0)
    {
        $designer = $this->check_designer($uid);

        if(!$page = $this->GP('page')){
            $page=1;
        }
        $pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1,  'closed'=>0,  'uid'=>$uid);
        if($items = K::M("designer/article")->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji:article', array($uid,'{page}')));
            $this->pagedata['items'] = $items;
        }     
        K::M('designer/designer')->update_count($uid, 'views', 1);
        if($designer['company_id']){
           $this->pagedata['company'] = K::M('company/company')->detail($designer['company_id']);
        }
        $comment_info = K::M("designer/comment")->items(array('designer_id'=>$uid),array('comment_id'=>'desc'),1,3);
        foreach($comment_info as $k => $v){
            $uids[$v['uid']] = $v['uid'];
        }
        if(!empty($uids)){
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        $this->pagedata['comment_list'] = $comment_info;
        $this->pagedata['designer'] = $designer;
        
        $this->pagedata['pager'] = $pager;  
        
        $this->tmpl = 'mobile:sheji/usercenterart.html';
    }

    public function usercenterdis($uid,$page=0)
    {
        $designer = $this->check_designer($uid);
        
        if(!$page = $this->GP('page')){
            $page=1;
        }
        
        $pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1,  'closed'=>0,  'uid'=>$uid);

        K::M('designer/designer')->update_count($uid, 'views', 1);
        if($designer['company_id']){
           $this->pagedata['company'] = K::M('company/company')->detail($designer['company_id']);
        }
        $comment_info = K::M("designer/comment")->items(array('designer_id'=>$uid),array('comment_id'=>'desc'),1,3);
        foreach($comment_info as $k => $v){
            $uids[$v['uid']] = $v['uid'];
        }
        if(!empty($uids)){
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        $this->pagedata['comment_list'] = $comment_info;
        $this->pagedata['designer'] = $designer;
        
        $this->pagedata['pager'] = $pager;  
        
        $this->tmpl = 'mobile:sheji/usercenterdis.html';
    }

    public function jianjie($uid)
    {
        $designer = $this->check_designer($uid);
        $this->pagedata['company'] = K::M('company/company')->detail($designer['company_id']);
        $this->tmpl = 'mobile:sheji/jianjie.html';
    }

    public function anli($uid, $page=1)
    {
        $designer = $this->check_designer($uid);
        $pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('uid'=>$uid, 'closed'=>0, 'audit'=>1);
        if($items = K::M('case/case')->items($filter, null, $page, $limit, $count)){
			$case_ids = '';
			$i = 0;
			foreach($items as $key=>$val){
				if($i==0){
					$case_ids = $val['case_id'];
				}else{
					$case_ids .= ','.$val['case_id'];
				}
				$i++;
			}
			$items_shi = K::M('case/photo')->items_shi($case_ids);
			foreach($items as $key=>$val){
				$val['photos'] = $items_shi[$key];
				$items[$key] = $val;
			}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji/shi:anli', array($uid, '{page}')));
            $this->pagedata['items'] = $items;
        }


        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:sheji/shianli.html';

    }


    public function casedetail($case_id)
    {
        $case = $this->check_case($case_id);
       // var_dump($case);die;
        K::M('case/case')->update_count($case_id, 'views', 1);
        
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


     public function attention($uid)
    {
        $detail = $this->check_designer($uid);
        if (!$detail['audit']) { 
            $this->err->add('您关注的内容还在审核中，暂不可关注', 213);
        }else {
            K::M('designer/designer')->update($uid,array('attention_num'=>$detail['attention_num']+1));
                $this->err->add('关注成功！');
        }
    }


    public function rizhi($uid, $page=1)
    {
        $designer = $this->check_designer($uid);
        $pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('audit'=>1,'uid'=>$uid);
        if($items = K::M("designer/article")->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji:article', array($uid,'{page}')));
            $this->pagedata['items'] = $items;
        }      
        $this->pagedata['pager'] = $pager;      
        $this->tmpl = 'mobile:sheji/shiarticle.html';
    }

    public function article_info($article_id)
    {
        $this->showinfo($article_id);
    }

    public function articledetail($article_id)
    {
        if(!($article_id = (int)$article_id) && !($article_id = $this->GP('article_id'))){
            $this->error(404);
        }else if(!$detail = K::M('designer/article')->detail($article_id)){
            $this->error(404);
        }
        $designer = $this->check_designer($detail['uid']);
        //var_dump($designer);die;
        K::M('designer/article')->update_count($article_id, 'views');
        $pager['prev'] = K::M('designer/article')->item_prev($article_id, $detail['uid']);
        $pager['next'] = K::M('designer/article')->item_next($article_id, $detail['uid']);
        $this->pagedata['detail'] = $detail;
        $this->tmpl = 'mobile:sheji/articledetail.html';
    }



    public function comments($uid, $page=1)
    {
        $designer = $this->check_designer($uid);
        $pager = $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('designer_id'=>$uid, 'closed'=>0);
        $order = array('comment_id'=>'desc');
        if($items = K::M("designer/comment")->items($filter, $order, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('sheji:comment',array($uid, '{page}')));
            $this->pagedata['items'] = $items;
            $uids = array();
            foreach($items as $k => $v){
                $uids[$v['uid']] = $v['uid'];
            }
            if(!empty($uids)){
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
        }
        $this->pagedata['comment_info'] = $items;   
        $this->pagedata['pager'] = $pager;      
        $this->tmpl = 'mobile:sheji/comments.html';
    }

    public function comment($uid)
    {
        if (!$this->check_login()) {
            $this->err->add('您还没有登录，不能评论', 101);
        }elseif (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'],'allow_score')) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        }elseif(!($uid = (int)$uid) && !($uid = (int)$this->GP('uid'))){
            $this->err->add('没有您要的数据', 211);
        }else if(!$detail = K::M('designer/designer')->detail($uid)){
            $this->err->add('没有您要的数据', 212);
        }else if(empty($detail['audit'])){
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }else{
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
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
                    $data['uid'] = $this->uid;
                    $data['designer_id'] = $uid;
                    $data['city_id'] = $this->request['city_id'];
                    $data['audit'] = $audit;
                    if($comment = K::M('designer/comment')->create($data)){
                        K::M('designer/comment')->comment($data);
                        $this->err->add('评论成功！');
                    }
                }
            }
        }
    }


      public function yuyue($uid)
    {
       // var_dump($uid);die;
        if(!($uid = (int)$uid) && !($uid = (int)$this->GP('uid'))){
            $this->err->add('没有您要的数据', 211);
        }else if(!$detail = K::M('designer/designer')->detail($uid)){
            $this->err->add('没有您要的数据', 212);
        }else if(empty($detail['audit'])){
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }else{
               if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }else{
                    $verifycode_success = true;
                    $access = $this->system->config->get('access');
                    if($access['verifycode']['yuyue']){
                        if(!$verifycode = $this->GP('verifycode')){
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        }else if(!K::M('magic/verify')->check($verifycode)){
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        }
                    }
                    if($verifycode_success){
                        $data['designer_id'] = $uid;
                        $data['company_id'] = $detail['company_id'];
                        $data['uid'] = (int)$this->uid;
                        $data['content'] = "预约设计师:".$detail['uname'];
                        $data['city_id'] =  $this->request['city_id'];
                        if($yuyue_id = K::M('designer/yuyue')->create($data)){
                            K::M('designer/yuyue')->yuyue_count($uid);
                            $smsdata = $maildata = array('contact'=>$data['contact'] ? $data['contact'] : '参展商','mobile'=>$data['mobile'],'designer'=>$detail['realname']);
                            K::M('sms/sms')->send($data['mobile'], 'designer_yuyue', $smsdata);
                            if($company_id = $detail['company_id']){
                                if($company = K::M('company/company')->detail($company_id)){
                                    $company['member'] = $detail;
                                    K::M('sms/sms')->company('designer_tongzhi', $smsdata);
                                    K::M('helper/mail')->sendcompany($company, 'designer_yuyue', $maildata);
                                }
                            }else{
                                if($detail['verify_mobile'] && K::M('verify/check')->mobile($detail['mobile'])){
                                    K::M('sms/sms')->send($detail['mobile'], 'designer_tongzhi', $smsdata);
                                }
                                K::M('helper/mail')->sendmail($detail['mail'], 'designer_yuyue', $maildata);
                            }
                            $this->err->add('预约设计师成功');
                        }
                    }
                } 
        }
    }


    protected function check_designer($uid)
    {
        if(!$uid = (int)$uid){
            $this->error(404);
        }else if(!$designer = K::M('designer/designer')->detail($uid)){
            $this->error(404);
        }
        $this->pagedata['designer'] = $designer;
        $seo = array('designer_name'=>$designer['name'], 'designer_school'=>$designer['school'], 'designer_slogan'=>$designer['slogan'], 'designer_desc'=>'');
        $seo['designer_desc'] = K::M('content/text')->substr(K::M('content/html')->text($designer['about'], true), 0, 200);
        $this->seo->init('designer_detail', $seo);
        return $designer;
    }

   
}