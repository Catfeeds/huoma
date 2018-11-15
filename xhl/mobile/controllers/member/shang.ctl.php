<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: shang.ctl.php 9941 2015-10-28 13:13:58  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Shang extends Ctl_Ucenter 
{
    
    protected $_allow_fields = 'cat_id,province_id,city_id,area_id,title,name,logo,contact,phone,mobile,qq,fox,mail,domain,addr,hours,info,lng,lat,banner,fox,mail,qq,hours,addr,jiaotong,bulletin,lng,lat,info,psaz,dgxz,seo_title,seo_keywords,seo_description';

    public function index()
    {
        $shang = $this->ucenter_shang();
        $this->pagedata['zhan_list'] = K::M('canzhan/canzhan')->items(array('shang_id'=>$shang['shang_id']),array('dateline'=>'desc'),1,3);
		$this->pagedata['status_list']= K::M('canzhan/canzhan')->status_list();
        $this->tmpl = 'mobile:member/shang/index.html';
    }
    public function user()
    {
        $shop = $this->ucenter_shang();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 5;
        $filter['from'] = 'shang';
        $filter['from_id'] = $shop['shang_id'];
        if ($items = K::M('member/member')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/shang/user.html';
    }

    public function listcon()
    {
        $shop = $this->ucenter_shang();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 5;
        $filter['from'] = 'shang';
        $filter['from_id'] = $shop['shang_id'];
        if ($items = K::M('member/member')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/shang/listcon.html';
    }
	
    public function reg()
    {
		$shop = $this->ucenter_shang();
		if(3>K::M('member/member')->shang_count($shop['shang_id'])){
			$this->tmpl = 'mobile:member/shang/reg.html';
		}else{
			$this->err->add('管理员最多为3个！');
			$this->err->set_data('forward', $this->mklink('member/shang:user'));    
        }	
    }    
	
    public function piao(){
        $shang = $this->ucenter_shang();
        //调用xhlctl下的table.php文件中的detail方法
        $detail =K::M('shang/piao')->detail($shang['shang_id']);
        $this->pagedata['detail'] = $detail;
          //接收和验证数据
          if($data = $this->checksubmit('data')){
              if(!$detail && empty($data['taitou'])){
                  $this->err->add('发票抬头不能为空', 211);
              }else{
                 /*if ($_FILES['data']) {
                        foreach ($_FILES['data'] as $k => $v) {
                          foreach ($v as $kk => $vv) {
                              $attachs[$kk][$k] = $vv;
                          }
                      }
                      $upload = K::M('magic/upload');
                      foreach ($attachs as $k => $attach) {
                          if ($attach['error'] == UPLOAD_ERR_OK) {
                              if ($a = $upload->upload($attach, 'shang')) {
                                  $data[$k] = $a['photo'];
                              }
                          }
                      }
                  }*/
                  if($detail){
                      if(K::M('shang/piao')->update($shang['shang_id'], $data)){
                            $this->err->add('保存资料成功');
                      }
                  }else{
                      $data['shang_id'] = $shang['shang_id'];
                      $data['uid'] = $this->uid;
                      if($shang_id = K::M('shang/piao')->create($data)){
                           $this->err->add('保存资料成功');
                      }
                  }               
              }
          }else{
              $this->pagedata['shang'] = $shang;
              $this->tmpl = 'mobile:member/shang/piao.html';
          }
    }

    public function book()
    {
		$shop = $this->ucenter_shang();
		$this->tmpl = 'mobile:member/shang/book.html';	
    }    
    public function passwd()
    {
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
           $this->tmpl = 'mobile:member/shang/passwd.html';
        }        
    }

    public function create()
    {
        $shop = $this->ucenter_shang();
        if(!$this->checksubmit('account')){
            $this->err->add('非法的数据提交', 211);
        }else if(!$account = $this->GP('account')){
            $this->err->add('非法的数据提交', 212);
        }else if($account['passwd'] != $this->GP('confirmpasswd')){
            $this->err->add('两次输入的密码不相同', 213);
        }else{
		$access = $this->system->config->get('access');
		//var_dump($access);die;
		$account['from'] = 'shang';
		$account['from_id'] = $shop['shang_id'];
			if($uid = K::M('member/account')->create($account)){
				$this->err->add('添加管理员成功');
				$from_list = K::M('member/member')->from_list();
				$account_from = $account['from'];
				if(!$from_list[$account_from]){
					$account_from = 'member';
				}
				$this->err->set_data('forward', $this->mklink('member/shang:user'));
			}
        }
    }
	
	
    public function base()
    {
        $shop = $this->ucenter_shang();
        if($this->checksubmit()){
            $data = array();
            $cfg = K::$system->config->get('attach');
            if($attach = $_FILES['shop_thumb']){
                if(UPLOAD_ERR_OK == $attach['error']){
                    if($a = K::M('magic/upload')->upload($attach, 'shang', $shop['thumb'])){
                        $thumb = K::M('content/html')->encode($a['photo']);
                        $size = $cfg['shop']['thumb'] ? $cfg['shop']['thumb'] : '200x200';
                        K::M('image/gd')->thumbs($a['file'], array($size=>$a['file']), fasle);
                    }
                }
            }
            if($attach = $_FILES['shop_logo']){
                if(UPLOAD_ERR_OK == $attach['error']){
                    if($a = K::M('magic/upload')->upload($attach, 'shang', $shop['logo'])){
                        $logo = K::M('content/html')->encode($a['photo']);
                        $size = $cfg['shop']['logo'] ? $cfg['shop']['logo'] : '200x100';
                        K::M('image/gd')->thumbs($a['file'], array($size=>$a['file']), fasle);
                    }
                }
            }            
            if($thumb || $logo){
                $a = array();
                if($logo){
                    $a = array('logo'=>$logo);
                }
                if($thumb){
                    $a['thumb'] = $thumb;
                }
                K::M('shang/shang')->update($shop['shang_id'], $a, true);
            }
            if($banner){
                K::M('shop/fields')->update($shop['shang_id'], array('banner'=>$banner), true);
            }            
            $this->err->add('修改企业资料成功');          
        }else{
            $this->tmpl = 'mobile:member/shang/base.html';
        }        
    }

    public function info()
    {
        $shop =  $this->ucenter_shang();
        if($data = $this->checksubmit('data')){
            if($data = $this->check_fields($data, $this->_allow_fields)){
				$cfg = K::$system->config->get('attach');
				if($attach = $_FILES['shop_thumb']){
					if(UPLOAD_ERR_OK == $attach['error']){
						if($a = K::M('magic/upload')->upload($attach, 'shang', $shop['thumb'])){
							$thumb = K::M('content/html')->encode($a['photo']);
							$size = $cfg['shop']['thumb'] ? $cfg['shop']['thumb'] : '200x200';
							K::M('image/gd')->thumbs($a['file'], array($size=>$a['file']), fasle);
						}
					}
				}
				if($attach = $_FILES['shop_logo']){
					if(UPLOAD_ERR_OK == $attach['error']){
						if($a = K::M('magic/upload')->upload($attach, 'shang', $shop['logo'])){
							$logo = K::M('content/html')->encode($a['photo']);
							$size = $cfg['shop']['logo'] ? $cfg['shop']['logo'] : '200x100';
							K::M('image/gd')->thumbs($a['file'], array($size=>$a['file']), fasle);
						}
					}
				}            
				if($logo){
					$data['logo'] = $logo;
				}
				if($thumb){
					$data['thumb'] = $thumb;
				}

                if($fields = $this->GP('fields')){
                    $fields = $this->check_fields($fields, $this->_allow_fields);
                }
                if( isset($shop['shang_id']) || !empty($shop['title'])){
                    unset($data['city_id']);
					unset($data['province_id']);
                    if(K::M('shang/shang')->update($shop['shang_id'], $data)){
                          $this->err->add('保存资料成功');
                    }
                }else{

/*                    if($group = K::M('member/group')->default_group('shang')){
                        $data['group_id'] = $group['group_id'];
                    }else{
*/                        $data['group_id'] = 0;
         //           }
                    $data['uid'] = $this->uid;
                    if($shang_id = K::M('shang/shang')->create($data)){
				//		 K::M('member/member')->update($data['uid'],array('group_id'=>$data['group_id']));
                         $this->err->add('保存资料成功');
                    }
                }               
            }
        }else{
            $this->pagedata['shop'] = $shop;
            $this->tmpl = 'mobile:member/shang/info.html';
        }
    }

    public function skin()
    {
        $shop = $this->ucenter_shang();
        $allow_skin = K::M('member/group')->check_priv($shop['group_id'], 'allow_skin');
        $skins = include(__CFG::TMPL_DIR.'default/shop/config.php');
        if($skin = $this->checksubmit('skin')){
            if($allow_skin < 0){
                $this->err->add('您是【'.$shop['group_name'].'】没有权限更换模板', 333);
            }else if(!$cfg = $skins[$skin]){
                $this->err->add('选择的模板不存在', 211);
            }else if(K::M('shop/fields')->update($shop['shang_id'], array('skin'=>$skin), true)){
                $this->err->add('修改企业模板成功');
            }
        }else{
            $this->pagedata['pager'] = $pager;
            $this->pagedata['skins'] = $skins;
            $this->tmpl = 'mobile:member/shang/skin.html';
        }
    }

    public function seo()
    {
        $shop = $this->ucenter_shang();
        if($data = $this->checksubmit('data')){
            if(K::M('member/group')->check_priv($shop['group_id'], 'allow_seo') < 0){
                $this->err->add('您是【'.$shop['group_name'].'】不能设置SEO', 333);
            }else if($data = $this->check_fields($data, $this->_allow_fields)){
                if(K::M('shop/fields')->update($shop['shang_id'], $data)){
                    $this->err->add('修改SEO内容成功');
                }
            }
        }else{
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/shang/seo.html';
        }
    }

    public function gmsm()
    {
        $shop = $this->ucenter_shang();
        if($data = $this->checksubmit('data')){
            if($data = $this->check_fields($data, $this->_allow_fields)){
                K::M('shop/fields')->update($shop['shang_id'], $data);
                $this->err->add('修改企业资料成功');
            }else{
                $this->err->add('非法的数据提交', 211);
            }
        }else{
            $this->tmpl = 'mobile:member/shang/gmsm.html';
        }        
    }

	public function refresh()
    {
		$shop = $this->ucenter_shang();
		$integral = K::$system->config->get('integral');
		$counts = K::M('member/flush')->flushs($this->uid);
		$is_gold = abs($integral['gold']);
		if($counts >= $shop["group"]["priv"]["day_free_count"]){
			$this->pagedata['gold'] = $is_gold;
		}
		$this->pagedata['is_refresh'] = $counts;
		$this->pagedata['counts'] = $shop["group"]["priv"]["day_free_count"];
		if($this->GP('fromid')){
			$isrefresh = true;
			if($counts >= $shop["group"]["priv"]["day_free_count"]){
				if($this->MEMBER['gold']<$is_gold){
					$isrefresh = false;
					$this->err->add('您的展币余额不足，请先充值', 215);
				}
			}
			$data['gold'] = '0';
			if($isrefresh && $counts >= $shop["group"]["priv"]["day_free_count"]){
				$data['gold'] = $is_gold;
				if($is_gold > 0){
                    if(!K::M('member/gold')->update($this->uid, -$is_gold, "刷新企业")){
						$isrefresh = false;
                        $this->err->add('扣费失败', 201)->response();
                    }
                }
			}
			$data['uid'] = $this->uid;$data['from'] = 'shop';$data['itemId'] = $shop['shang_id'];
			if($isrefresh && K::M('member/flush')->create($data)){
				K::M('shang/shang')->update($shop['shang_id'], array('flushtime'=>__TIME));
				$this->err->add('刷新成功');
			}

		}else{
			$this->pagedata['fromid'] = $shop['shang_id'];		
			$this->tmpl = 'mobile:member/shang/refresh/look.html';
		}
	}

    public function catechildren($pid=null)
    {
        $pid = (int)$pid;
        $cats = array();
        if($childrens = K::M('shop/cate')->childrens($pid)){
            foreach($childrens as $k=>$v){
                $cats[] = array('cat_id'=>$v['cat_id'], 'parent_id'=>$v['parent_id'], 'title'=>$v['title']);
            }
        }
        $this->err->set_data('cats', $cats);        
        $this->err->json();            
    }

}