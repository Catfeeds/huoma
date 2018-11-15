<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: designer.ctl.php 9941 2015-04-28 13:13:58  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Designer extends Ctl_Ucenter 
{
    protected $_allow_fields = 'company_id,city_id,area_id,school,about,name,slogan,mobile';

    public function index()
    {
		$designer = $this->ucenter_designer();
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_uid($this->uid);
        $this->pagedata['yuyue_company_count'] = K::M('company/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_designer_count'] = K::M('designer/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_shop_count'] = K::M('shop/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['tenders_count'] = K::M('tenders/tenders')->count(array('uid'=>$this->uid));
        // var_dump($this->cookie->get('uid'));die;
        $this->tmpl = 'member/designer/sjs.html';
    }
	
	    public function rmb()
    {
		if ($this->checksubmit()) {
			if (!$data = $this->GP('data')) {
				$this->err->add('非法的数据提交', 201);
			} else {
				if(empty($data['rmb']) || !is_numeric($data['rmb'])){
					$message = '提现金额必须为数字！';
				}elseif($data['rmb']<100){
					$message = '支付金额不能少于100！';
				}elseif(empty($data['alipay'])){
					$message = '支付宝帐户不能这空！';
				}elseif(empty($data['realname'])){
					$message = '姓名不能这空！';
				}elseif(empty($data['mobile'])){
					$message = '电话不能这空！';
				}elseif($data['rmb']>$this->MEMBER['rmb_yu']){
					$message = '余额不足，请修改后再提交！';
				}else{
					$data['uid'] = $this->uid;
					$data['shui'] = $data['rmb']*0.07;
					$data['shouxu'] = 2;
					$data['shifu'] = $data['rmb']-$data['shui']-$data['shouxu'];
					if($zhi_list = K::M('member/zhi')->zhicount($this->uid)){
						$message = '有未处理申请，不可多次提交！';
					}elseif ($zhi_id = K::M('member/zhi')->create($data)) {
							$message = '申请成功，请耐心等待审核！';
					}else{
						$message = '提交失败请联系客服反馈！';
					}
				
				}
 					$this->err->add($message);
               		$this->err->set_data('forward', $this->mklink('member/designer:rmb'));
			}
		}else{
			$zhi_list = K::M('member/zhi')->zhilist($this->uid);
			$dai_zhi=0.00;
			if(count($zhi_list)){
				foreach($zhi_list as $zhi){
					if($status==0){
						$dai_zhi += $zhi['rmb']; 
					}
				}
				
			}
			$this->pagedata['zhi_list'] = $zhi_list;
			$this->pagedata['dai_zhi'] = $dai_zhi;
			$this->tmpl = 'member/designer/rmb.html';
		}
    }

    public function logs($type=null, $page=0)
    {
        $filter = $pager = array();
        if(is_numeric($type)){
            $page = $type;
            $type = null;
        }else if($type == 'in'){
            $filter['number'] = ">:0";
        }else if($type == 'out'){
            $filter['number'] = "<:0";
        }
        $pager['type'] = $type;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $this->uid;
        $filter['from'] = 'rmb';
        if ($items = K::M('member/log')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member/member:logs', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/designer/logs.html';
    }

    public function info()
    {
        $designer = $this->ucenter_designer();
        if($data = $this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 211);
            }else{
            	if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $cfg = K::$system->config->get('attach');
                    $oImg = K::M('image/gd');
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'company')) {
                                $data[$k] = $a['photo'];
                                if ($k === 'face') {
                                    $size['photo'] = $cfg['company']['face'] ? $cfg['company']['face'] : '200X200';
                                } else {
                                    $size['photo'] = $cfg['company']['thumb'] ? $cfg['company']['thumb'] : '300X300';
                                }
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
                //var_dump($data);die;
                if(!$designer['designer_id']){
					$data['uid'] = $this->uid;
					if($group = K::M('member/group')->default_group('designer')){
						$data['group_id'] = $group['group_id'];
					}
                    if ($designer_id = K::M('designer/designer')->create($data)) {
						K::M('member/member')->update($designer['uid'],array('group_id'=>$data['group_id'],'face'=>$data['face']));
                        if ($attr = $this->GP('attr')) {
                            K::M('designer/attr')->update($designer_id, $attr);
                        }
                    }
                }else if (K::M('designer/designer')->update($designer['uid'], $data)) {
                	K::M('member/member')->update($designer['uid'],array('face'=>$data['face']));
                    if ($attr = $this->GP('attr')) {
                        K::M('designer/attr')->update($designer['uid'], $attr);
                    }
                }
                $this->err->add('设计师资料设置成功');
            }
        }else{
            if($company_id = $designer['company_id']){
                $this->pagedata['company'] = K::M('company/company')->detail($company_id);
            }
            $this->tmpl = 'member/designer/info.html';
        }        
    }

    public function attr()
    {
        $designer = $this->ucenter_designer();
        if($attr = $this->checksubmit('attr')){
            K::M('designer/attr')->update($this->uid, $attr);
            $this->err->add('设计师属性设置成功');
        }else{
            $this->pagedata['attr'] = K::M('designer/attr')->attrs_ids_by_designer($this->uid);
            $this->tmpl = 'member/designer/attr.html';
        }         
    }
    public function guifan()
    {
       	$this->pagedata['designer'] = $this->ucenter_designer();
        $this->tmpl = 'member/designer/guifan.html';
     }

	public function refresh()
    {
		$designer = $this->ucenter_designer();
		$integral = K::$system->config->get('integral');
		$counts = K::M('member/flush')->flushs($this->uid);
		$is_gold = abs($integral['gold']);
		if($counts >= $designer["group"]["priv"]["day_free_count"]){
			$this->pagedata['gold'] = $is_gold;
		}
		$this->pagedata['is_refresh'] = $counts;
		$this->pagedata['counts'] = $designer["group"]["priv"]["day_free_count"];
		if($this->GP('fromid')){
			$isrefresh = true;
			if($counts >= $designer["group"]["priv"]["day_free_count"]){
				if($this->MEMBER['gold']<$is_gold){
					$isrefresh = false;
					$this->err->add('您的展币余额不足，请先充值', 215);
				}
			}
			$data['gold'] = '0';
			if($isrefresh && $counts >= $designer["group"]["priv"]["day_free_count"]){
				$data['gold'] = $is_gold;
				if($is_gold > 0){
                    if(!K::M('member/gold')->update($this->uid, -$is_gold, "刷新设计师")){
						$isrefresh = false;
                        $this->err->add('扣费失败', 201)->response();
                    }
                }
			}
			$data['uid'] = $this->uid;$data['from'] = 'designer';$data['itemId'] = $designer['uid'];
			if($isrefresh && K::M('member/flush')->create($data)){
				K::M('designer/designer')->update($designer['uid'], array('flushtime'=>__TIME));
				$this->err->add('刷新成功');
			}

		}else{
			$this->pagedata['fromid'] = $designer['uid'];		
			$this->tmpl = 'member/designer/refresh/look.html';
		}
	}

}