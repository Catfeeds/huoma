<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: company.ctl.php 9941 2015-04-28 13:13:58  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Company extends Ctl_Ucenter 
{
    protected $_allow_fields = 'province_id,city_id,area_id,title,name,logo,slogan,contact,phone,addr,qq,mobile,lng,lat,video';   
    public function index()
    {
        $company = $this->ucenter_company();
		$this->pagedata['baojia_count'] = K::M('chao/baojia')->count(array('company_id'=>$company['company_id']));
        $this->tmpl = 'mobile:member/company/index.html';
    }

	public function refresh()
    {
		$company = $this->ucenter_company();
		$integral = K::$system->config->get('integral');
		$counts = K::M('member/flush')->flushs($this->uid);
		$is_gold = abs($integral['gold']);
		if($counts >= $company["group"]["priv"]["day_free_count"]){
			$this->pagedata['gold'] = $is_gold;
		}
		$this->pagedata['is_refresh'] = $counts;
		$this->pagedata['counts'] = $company["group"]["priv"]["day_free_count"];
		if($this->GP('fromid')){
			$isrefresh = true;
			if($counts >= $company["group"]["priv"]["day_free_count"]){
				if($this->MEMBER['gold']<$is_gold){
					$isrefresh = false;
					$this->err->add('您的展币余额不足，请先充值', 215);
				}
			}
			$data['gold'] = '0';
			if($isrefresh && $counts >= $company["group"]["priv"]["day_free_count"]){
				$data['gold'] = $is_gold;
				if($is_gold > 0){
                    if(!K::M('member/gold')->update($this->uid, -$is_gold, "刷新工厂")){
						$isrefresh = false;
                        $this->err->add('扣费失败', 201)->response();
                    }
                }
			}
			$data['uid'] = $this->uid;$data['from'] = 'company';$data['itemId'] = $company['company_id'];
			if($isrefresh && K::M('member/flush')->create($data)){
				K::M('company/company')->update($company['company_id'], array('flushtime'=>__TIME));
				$this->err->add('刷新成功');
			}

		}else{
			$this->pagedata['fromid'] = $company['company_id'];	
			$this->tmpl = 'mobile:member/company/refresh/look.html';
		}
	}

    public function info()
    {
        $company = $this->ucenter_company();
        if($data = $this->checksubmit('data')){

            if (!$data = $this->check_fields($data, $this->_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if(!$company['company_id']){
                    $data['uid'] = $this->uid;
                    $data['group_id'] = 8;
                    if ($company_id = K::M('company/company')->create($data)) {
						K::M('member/member')->update($this->uid,array('group_id'=>$data['group_id']));
                        if ($attr = $this->GP('attr')) {
                            K::M('company/attr')->update($company_id, $attr);
                        }
                        if ($fields = $this->GP('fields')) {                            
                            if($fields = $this->check_fields($fields, array('info'))) {
                                K::M('company/fields')->update($company['company_id'], $fields);
                            }
                        }
                        $this->err->add('设置工厂资料成功');
                    }
                }else if (K::M('company/company')->update($company['company_id'], $data)) {
                    if ($attr = $this->GP('attr')) {
                        K::M('company/attr')->update($company['company_id'], $attr);
                    }
                    if ($fields = $this->GP('fields')) {
                        if($fields = $this->check_fields($fields, array('info'))) {
                            K::M('company/fields')->update($company['company_id'], $fields);
                        }
                    }
                    $this->err->add('设置工厂资料成功');
                }                
            }
        }else{
            if($attrs = K::M('company/attr')->attrs_by_company($company['company_id'])){
                $this->pagedata['attr_values'] = array_keys($attrs);
            }
            $this->tmpl = 'mobile:member/company/info.html';
        }
    }

    public function passwd($from='member'){
        if($account = $this->checksubmit('account')){
            if(md5($account['old_passwd']) != $this->MEMBER['passwd']){
                $this->err->add('原密码不正确', 211);
            }else if($account['passwd'] != $account['confirm_passwd']){
                $this->err->add('两次输入的密码不相同', 212);
            }else if($account['passwd'] == $account['old_passwd']){
                $this->err->add('原密码与修改密码不能相同', 212);
            }else if(K::M('member/account')->check_passwd($account['passwd'])){
                if($this->auth->update_passwd($account['passwd'], false)){
                    $this->err->add('修改密码成功');
                }
            }
        }else{
           $this->tmpl = 'mobile:member/company/passwd.html';
        }        
    }
	
    public function skin()
    {
        $company = $this->ucenter_company();
        $allow_skin = K::M('member/group')->check_priv($company['group_id'], 'allow_skin', $group_name);
        $skins = include(__CFG::TMPL_DIR.'expo/gong/config.php');   
        if($skin = $this->checksubmit('skin')){
            if($audit_skin < 0){
                $this->err->add('您是【'.$audit_title.'】没有权限更换模板', 333);
            }else if(!$cfg = $skins[$skin]){
                $this->err->add('选择的模板不存在', 211);
            }else if(K::M('company/fields')->update($company['company_id'], array('skin'=>$skin), true)){
                $this->err->add('修改工厂模板成功');
            }
        }else{
            $pager = array('allow_skin'=>$allow_skin);
            $this->pagedata['pager'] = $pager;
            $this->pagedata['skins'] = $skins;
            $this->tmpl = 'mobile:member/company/skin.html';
        }    
    }

}