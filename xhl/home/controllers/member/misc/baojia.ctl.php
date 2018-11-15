<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: canzhan.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Misc_Baojia extends Ctl_Ucenter
{
    

	public function __construct(&$system)
	{
		parent::__construct($system);
		switch($this->MEMBER['from']){
			case 'gz'		:	$gz = $this->ucenter_gz(); $city_id = $gz['city_id']; break;
			case 'designer'	:	$designer = $this->ucenter_designer(); $city_id = $designer['city_id']; break;
			case 'mechanic'	:	$mechanic = $this->ucenter_mechanic(); $city_id = $mechanic['city_id']; break;
			case 'company'	:	$company = $this->ucenter_company(); $city_id = $company['city_id']; break;
			case 'shop'		:	$shop = $this->ucenter_shop(); $city_id = $shop['city_id']; break;
		}        
		$this->city_id = $city_id;       
	}

	public function index($page=1)
	{
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['city_id'] = $this->city_id;
        $filter['status'] = array(0,1);
        $filter['audit'] = 1;
		$filter['sign_uid'] = "<:1";
        $ids =  array();
        if($items = K::M('canzhan/canzhan')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/misc/baojia/items.html';
	}


	public function company($page=1)
	{
		$this->canzhan($page);
	}

	public function shop($page=1)
	{
		$this->canzhan($page);
	}

	public function designer($page=1)
	{
		$this->canzhan($page);
	}

	public function gz($page=1)
	{
		$this->canzhan($page);
	}

	public function mechanic($page=1)
	{
		$this->canzhan($page);
	}

	protected function canzhan($page=1)
	{
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['city_id'] = $this->city_id;
        $filter['status'] = array(0,1,2);
        $filter['audit'] = 1;
        $ids =  array();
        if($items = K::M('canzhan/canzhan')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/misc/baojia/items.html';		
	}

    public function detail($id=null)
    {
        if(!$id = (int)$id){
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('信息不存在或已经删除', 211);
        }else if(empty($detail['audit'])){
            $this->err->add('信息还在审核中，不可查看', 211);
        }else{
            K::M('canzhan/canzhan')->update_count($id,'views');
            if($look_list = K::M('canzhan/look')->items_by_canzhan($id)){
                $uids = array();
                foreach($look_list as $k=>$v){
                    $uids[$v['uid']] = $v['uid'];
                    if($v['uid'] == $this->uid){
                        $detail['looked'] = $k;
                    }
                }
                $this->pagedata['look_list'] = $look_list;
                if($uids){
					if($member_list = K::M('member/member')->items_by_ids($uids)){
						$gz_uids = $designer_uids = $mechanic_uids = $company_uids = $shop_uids = array();
						foreach($member_list as $v){
							switch($v['from']){
								case 'company'	: $company_uids[$v['uid']]	= $v['uid']; break;
								case 'designer'	: $designer_uids[$v['uid']] = $v['uid']; break;
								case 'gz'		: $gz_uids[$v['uid']]		= $v['uid']; break;
								case 'mechanic'	: $mechanic_uids[$v['uid']] = $v['uid']; break;
								case 'shop'		: $shop_uids[$v['uid']]		= $v['uid']; break;
							}
						}
						if($gz_uids){
							$this->pagedata['gz_list'] = K::M('gz/gz')->items_by_ids($gz_uids);
						}
						if($designer_uids){
							$this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_uids);
						}
						if($mechanic_uids){
							$this->pagedata['mechanic_list'] = K::M('mechanic/mechanic')->items_by_ids($mechanic_uids);
						}
						if($company_uids){
							$this->pagedata['company_list'] = K::M('company/company')->items_by_uids($company_uids);
						}
						if($shop_uids){
							$this->pagedata['shop_list'] = K::M('shop/shop')->items_by_uids($shop_uids);
						}
						$this->pagedata['member_list'] = $member_list;
					}
                }
                $this->pagedata['look_list'] = $look_list;
            }
            if($uid = $detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->member($uid);
            }
            $this->pagedata['pager'] = $pager;
            $this->pagedata['detail'] = $detail;
            K::M('canzhan/canzhan')->update_count($id, 'views');
            $this->tmpl = 'member/misc/baojia/detail.html';
        }
    }

    public function looked($page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $ids = array();
        $filter['uid'] = $this->uid;
        if($items = K::M('canzhan/look')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
                $ids[$v['id']] = $v['id'];
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            if($ids){
                $this->pagedata['canzhan_list'] = K::M('canzhan/canzhan')->items_by_ids($ids);
            }
        }
        
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/misc/baojia/looks.html';
    }

    public function track($look_id=null, $page=1)
    {
        if(!$look_id = (int)$look_id){
             $this->error(404);
        }else if(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('您的任务不存在或已经删除', 211);
        }elseif($look['uid'] != $this->uid){
            $this->err->add('非法操作，你没有权限查看该标', 212);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($look['id'])){
            $this->err->add('该信息数据不存在！可能由管理员删除', 213);
        }else if(empty($detail['audit'])){
             $this->err->add('该任务已经进入待审中，暂时不能查看', 214);
        }else{
			
            $canzhan_case = K::M('canzhan/case')->items(array('id'=>$look['id'],'is_ok'=>1), array('dateline'=>'DESC'));
			$czc_list =array();
			if(count($canzhan_case>0)){
				foreach($canzhan_case as $val){
					$val['cphoto'] = K::M('canzhan/photo')->items(array('case_id'=>$val['case_id'],'closed'=>0),array('dateline'=>'DESC'),1,4);
					$czc_list[] = $val;
				}
			}

            $this->pagedata['canzhan_case'] = $czc_list; 
            $this->pagedata['detail'] = $detail;
            $pager = array();
            $pager['page'] = $page = max((int)$page, 1);
            $pager['limit'] = $limit = 10;
            $pager['count'] = $count = 0;
            if($track_list = K::M('canzhan/track')->items(array('look_id'=>$look_id), array('track_id'=>'DESC'), $page, $limit, $count)){
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $count, $this->mklink(null, array($look_id, '{page}')));
                $this->pagedata['track_list'] = $track_list; 
            }
            $this->pagedata['look_id'] = $look_id;
            $this->pagedata['look'] = $look;
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'member/misc/baojia/track.html';
        }  
    }
    public function baojia($case_id=null,$look_id=null)
    {
		$case_id = (int)$case_id;
		
        if(!$look_id = (int)$look_id){
             $this->error(404);
        }else if(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('您的任务不存在或已经删除', 211);
        }elseif($look['uid'] != $this->uid){
            $this->err->add('非法操作，你没有权限查看该标', 212);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($look['id'])){
            $this->err->add('该信息数据不存在！可能由管理员删除', 213);
        }else if(empty($detail['audit'])){
             $this->err->add('该任务已经进入待审中，暂时不能报价', 214);
        }else{
//			else if(!$case = K::M('canzhan/case')->detail($case_id)){
//            $this->err->add('您的报价稿不存在或已经删除', 211);
//        }
			$company = K::M('company/company')->company_by_uid($this->uid);
 			$case = K::M('canzhan/case')->detail($case_id);
			$cphoto = K::M('canzhan/photo')->items(array('case_id'=>$case['case_id'],'closed'=>0),array('dateline'=>'DESC'),1,4);
			$baojia = K::M('canzhan/baojia')->detail_case_uid($case['case_id'],$this->uid);
			$btype = array();
			if(!$baojia){
				$btype = K::M('canzhan/btype')->items_list(array('status'=>1),array('order'=>'ASC'));
				$bianhao = $detail['id'].'-'.$case_id.'-'.$this->uid.'-'.date('Ymd');
			}else{
				$btype = K::M('canzhan/bxmtype')->items_list($baojia['baojia_id']);
				$bianhao = $baojia['sn'];
			}
//			print_r($btype);
//			exit;
			$look['info']  = unserialize($look['info']);
            $this->pagedata['baojia'] = $baojia; 
            $this->pagedata['btype'] = $btype; 
            $this->pagedata['bianhao'] = $bianhao; 
            $this->pagedata['look'] = $look; 
            $this->pagedata['case'] = $case; 
            $this->pagedata['cphoto'] = $cphoto; 
            $this->pagedata['detail'] = $detail;
            $this->pagedata['company'] = $company;
            $pager = array();
            $this->pagedata['look_id'] = $look_id;
            $this->tmpl = 'member/misc/baojia/baojia.html';
        }  
    }
    public function show($case_id=null,$look_id=null)
    {
		$case_id = (int)$case_id;
		
        if(!$look_id = (int)$look_id){
             $this->error(404);
        }else if(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('您的任务不存在或已经删除', 211);
        }elseif($look['uid'] != $this->uid){
            $this->err->add('非法操作，你没有权限查看该标', 212);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($look['id'])){
            $this->err->add('该信息数据不存在！可能由管理员删除', 213);
        }else if(empty($detail['audit'])){
             $this->err->add('该任务已经进入待审中，暂时不能报价', 214);
        }else{
//			else if(!$case = K::M('canzhan/case')->detail($case_id)){
//            $this->err->add('您的报价稿不存在或已经删除', 211);
//        }
 			$case = K::M('canzhan/case')->detail($case_id);
			$cphoto = K::M('canzhan/photo')->items(array('case_id'=>$case['case_id'],'closed'=>0),array('dateline'=>'DESC'),1,4);
			$baojia = K::M('canzhan/baojia')->detail_case_uid($case['case_id'],$this->uid);
			$btype = array();
			if(!$baojia){
				$btype = K::M('canzhan/btype')->items_list(array('status'=>1),array('order'=>'ASC'));
				$bianhao = $detail['id'].'-'.$case_id.'-'.$this->uid.'-'.date('Ymd');
			}else{
				$btype = K::M('canzhan/bxmtype')->items_list($baojia['baojia_id']);
				$bianhao = $baojia['sn'];
			}
//			print_r($btype);
//			exit;
			$look['info']  = unserialize($look['info']);
            $this->pagedata['baojia'] = $baojia; 
            $this->pagedata['btype'] = $btype; 
            $this->pagedata['bianhao'] = $bianhao; 
            $this->pagedata['look'] = $look; 
            $this->pagedata['case'] = $case; 
            $this->pagedata['cphoto'] = $cphoto; 
            $this->pagedata['detail'] = $detail;
            $pager = array();
            $this->pagedata['look_id'] = $look_id;
            $this->tmpl = 'member/misc/baojia/show.html';
        }  
    }

    public function updatebaojia()
    {
		//主表数据保存
        if($this->checksubmit()){
            if($baojia = $this->checksubmit('baojia')){
				if($baojia['baojia_id']){
					 K::M('canzhan/baojia')->update($baojia['baojia_id'],$baojia);
					$baojia_id = $baojia['baojia_id'];
				}else{
					$baojia['uid'] = $this->uid;
					unset($baojia['baojia_id']);
					if($baojia_id = K::M('canzhan/baojia')->create($baojia)){
					}
				}
            }
			
            if($xiangmu = $this->checksubmit('xiangmu')){
				foreach($xiangmu as $k=>$v){
					 if($v['title'] && $v['key']){
						 //原小项目名称更新
						if(K::M('canzhan/bxmtype')->update(v['key'], $v)){
							if($baojia[$v['key']]){
								foreach($baojia[$v['key']] as $vv){
									if($vv['xiangmu'] && $vv['num']){
										//子项目更新
										if(K::M('canzhan/bxm')->update($vv['bxm_id'],$vv)){
											
										}
									}
								}
							}
							//子项目新增
							if($data = $this->checksubmit('data')){
								if($data[$v['key']]){
									foreach($data[$v['key']] as $vv){
										if($vv['xiangmu'] && $vv['num']){
											$vv['xtype_id'] = $v['key'];
											if($bxm_id = K::M('canzhan/bxm')->create($vv)){
												
											}
										}
									}
								}
							}

						}
					}
				}
            }
            if($newxiangmu = $this->checksubmit('newxiangmu')){
               foreach($newxiangmu as $v){
                    if($v['title'] && $v['key'] && $baojia_id){
                        $v['baojia_id'] = $baojia_id;
                        if($xtype_id = K::M('canzhan/bxmtype')->create($v)){
							$data = $this->checksubmit('data');
								foreach($data[$v['key']] as $v2){
									if($v2['xiangmu'] && $v2['num'] && $xtype_id){
										$v2['xtype_id'] = $xtype_id;
										if($bxm_id = K::M('canzhan/bxm')->create($v2)){
											
										}
									}
								}
							}                   
						}
                    }
                }


            $this->err->add('数据保存成功！');
        }        
    }

    public function bstatus($id=null)
    {
		if (!($id = (int) $id) && !($id = (int)$this->GP('id'))) {
            $this->error(404);
        } else {
			K::M('canzhan/baojia')->update($id, array('status'=>1),1);
			$this->err->add('状态修改成功！');
		}
    }

    public function deletebxm($bxm_id=null)
    {
        if(!$bxm_id = (int)$bxm_id){
            $this->err->add('未定义操作', 211);
        }else if(!$spec = K::M('canzhan/bxm')->detail($bxm_id)){
            $this->err->add('项目不存在或已经删除', 212);
        }else if(K::M('canzhan/bxm')->delete($bxm_id)){
            $this->err->add('项目删除成功');
        }
    }

    public function comment()
    {
        if(!$look_id = (int)$this->GP('look_id')){
            $this->err->add('非法的数据提交', 211);
        }elseif(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('没有您的标', 211);
        }elseif($look['uid'] != $this->uid){
            $this->err->add('非法的数据提交', 211);
        }else if(!$content = $this->GP('tack_content')){
            $this->err->add('非法的数据提交', 211);
        }else{
            $data = array('content'=>$content, 'look_id'=>$look_id);
            if($tracking_id = K::M('canzhan/track')->create($data)){
                $this->err->add('添加内容成功');
            }
        }        
    }
    public function look($id=null)
    {
        if(!($id = (int)$id) && !($id = (int)$this->GP('id'))){
            $this->error(404);
        }else if(!$canzhan = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('信息不存在或已经删除', 212);
        }else if(($canzhan_look = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'canzhan_look')) < 0){
            $this->err->add('您是【'.$this->MEMBER['group_name'].'】不能进行投标', 333);
        }else if(!$canzhan['audit']){
            $this->err->add('该信息还没有公布不好意思!', 212); 
        }else if($canzhan['status'] < 0){
            $this->err->add('该信息已经作废，不可投标!', 212); 
        }else if($canzhan['sign_uid']){
            $this->err->add('该信息已经结束了!', 212); 
        }else if($canzhan['looks'] >= $canzhan['max_look']){
            $this->err->add('该信息已经结束了!', 212); 
        }else if(K::M('canzhan/look')->is_looked($id, $this->uid)){
            $this->err->add('您已经投过标了，不需要重复投标', 213);
        }else if(($canzhan['gold']) && ($this->MEMBER['gold']<$canzhan['gold'])){
            $this->err->add('您的展币全额不足，请先充值', 215);
        }else if($data = $this->checksubmit('data')){
            if(!$content = $data['content']){
                $this->err->add('给参展商留言不能为空', 216);
            }else{
                if($canzhan['gold'] > 0){
                    if(!K::M('member/gold')->update($this->uid, -$canzhan['gold'], "看标：".$canzhan['title']."(ID:{$id})")){
                        $this->err->add('扣费失败', 201)->response();
                    }
                }
				$datas = K::M('canzhan/look')->getdata($this->uid);
				$datas['id'] = $id;
				$datas['uid'] = $this->uid;
				$datas['content'] = $content;
                if($look_id = K::M('canzhan/look')->create($datas)){
                    K::M('canzhan/canzhan')->update_count($id, 'looks');
                    switch ($this->MEMBER['from']) {
                        case 'gz':
                            K::M('gz/gz')->update_count($this->uid, 'canzhan_num'); break;
                        case 'designer':
                            K::M('designer/designer')->update_count($this->uid, 'canzhan_num'); break;
                        case 'mechanic':
                            K::M('mechanic/mechanic')->update_count($this->uid, 'canzhan_num'); break;
                        case 'company':
                            K::M('company/company')->update_count($this->company['company_id'], 'canzhan_num'); break;
                        case 'shop':
                            K::M('shop/shop')->update_count($this->shop['shop_id'], 'canzhan_num'); break;
                    }
                    $this->err->add('参加竞标成功！');
                }
            }
        }else{
            $this->pagedata['canzhan'] = $canzhan;
            $this->tmpl = 'member/misc/baojia/look.html';
        }
    }



}