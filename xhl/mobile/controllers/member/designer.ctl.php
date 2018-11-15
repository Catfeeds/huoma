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
    protected $_allow_fields = 'company_id,province_id,city_id,area_id,school,about,name,slogan,mobile,qq,skills';

    public function index()
    {
		$designer = $this->ucenter_designer();
        $this->system->config->load(array("site", "bulletin", "attach"));
        $info['attachurl'] =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $info['menu_list_temp'] = $this->_parse_menu($this->MEMBER['from']);
        $info['member'] = $this->MEMBER;
        $info['member']['uname'] = $designer['name'];

        foreach($info['menu_list_temp'] as $key => $val){
            if($val['menu']){
                $info['menu_list'][$key]['title'] = $val['title'];
                foreach($val['items'] as $k => $v){
                    if($v['menu']){
                        $info['menu_list'][$key]['items'][$k] = $v;
                        switch($v['title']){
                            case '个人中心':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member.html';
                                break;
                            case '资料设置':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_info.html';
                                break;
                            case '修改密码':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_passwd.html';
                                break;
                            case '文章管理':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_blog.html';
                                break;
                            case '团队管理':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_team.html';
                                break;
                            case '项目管理':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_project.html';
                                break;
                            case '需求管理':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_demand.html';
                                break;
                            case '偏好设置':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member_preference.html';
                                break;
                            case '关注的项目':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'follow_project.html';
                                break;
                            case '关注的用户':
                                $info['menu_list'][$key]['items'][$k]['href'] = 'follow_designer.html';
                                break;
                            default:
                                $info['menu_list'][$key]['items'][$k]['href'] = 'member.html';
                                break;
                        }
                    }
                }
            }
        }
        unset($info['menu_list_temp']);

//        $this->dump($info['menu_list']);
        $designer_model = K::M('designer/designer');
        //项目数量
        $info['count']['xiangmu'] = $designer_model->xiangmu_count($info['member']['uid']);
        //关注数量
        $info['count']['follow'] = $designer_model->follow_count($info['member']['uid']);
        //粉丝数量
        $info['count']['fans'] = $designer_model->fans_count($info['member']['uid']);
        $this->ajaxReturn($info);
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_uid($this->uid);
        $this->pagedata['yuyue_company_count'] = K::M('company/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_designer_count'] = K::M('designer/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_shop_count'] = K::M('shop/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['tenders_count'] = K::M('tenders/tenders')->count(array('uid'=>$this->uid));
        $this->tmpl = 'mobile:member/designer/sjs.html';
    }

    public function index1()
    {
        $designer = $this->ucenter_designer();
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_uid($this->uid);
        $this->pagedata['yuyue_company_count'] = K::M('company/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_designer_count'] = K::M('designer/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_shop_count'] = K::M('shop/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['tenders_count'] = K::M('tenders/tenders')->count(array('uid'=>$this->uid));
        $this->tmpl = 'mobile:member/designer/sjs.html';
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
			$this->tmpl = 'mobile:member/designer/rmb.html';
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
        $this->tmpl = 'mobile:member/designer/logs.html';
    }

    public function listcon($type=null, $page=0)
    {
    	if(!$page = $this->GP('page')){
			$page=1;
		}

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
        $this->tmpl = 'mobile:member/designer/listcon.html';
    }

     public function shouru($type=null, $page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }

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
        $this->tmpl = 'mobile:member/designer/shouru.html';
    }

     public function tixian($type=null, $page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }

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
        $this->tmpl = 'mobile:member/designer/tixian.html';
    }

    public function info()
    {
        $designer = $this->ucenter_designer();
        if($data = $this->checksubmit('data')){
            if(!$data = $this->check_fields($data, $this->_allow_fields)){
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
                if(!$designer['designer_id']){
					$data['uid'] = $this->uid;
					if($group = K::M('member/group')->default_group('designer')){
						$data['group_id'] = $group['group_id'];
					}
                    if ($designer_id = K::M('designer/designer')->create($data)) {
						K::M('member/member')->update($designer['uid'],array('group_id'=>$data['group_id']));
                        if ($attr = $this->GP('attr')) {
                            K::M('designer/attr')->update($designer_id, $attr);
                        }
                    }
                }else if (K::M('designer/designer')->update($designer['uid'], $data)) {
                    if($data['face']){
                        K::M('member/member')->update($designer['uid'],array('face'=>$data['face']));
                    }
                    if ($attr = $this->GP('attr')) {
                        K::M('designer/attr')->update($designer['uid'], $attr);
                    }
                }
                $this->err->add('发布成功');
            }
        }elseif($province_id = intval($_POST['province_id'])){
            $this->ajaxReturn( K::M('data/city')->options($province_id));
        }elseif($city_id = intval($_POST['city_id'])){
            $this->ajaxReturn( K::M('data/area')->options($city_id));
        }else{
            $info['error'] = 0;
            $info['designer_info'] = $this->designer;
            if($info['designer_info']['face']){
                $this->system->config->load(array("site", "bulletin", "attach"));
                $info['designer_info']['face'] = Mdl_System_Config::$_CFG["attach"]["attachurl"]."/".$info['designer_info']['face'];
            }
            $info['province_list'] = K::M('data/province')->options();
            if($info['designer_info']['province_id']){
                $info['city_list'] = K::M('data/city')->options($info['designer_info']['province_id']);
            }else{
                $info['city_list'] = array();
            }
            $info['area_list'] = K::M('data/area')->options($info['designer_info']['city_id']);
            $detail = K::M('designer/preference')->detail($info['designer_info']['uid']);
            $info['preference'] = $detail?1:0;
            $info['message'] = "查询成功";
            $this->ajaxReturn($info);
        }
    }

    public function shejiguanli()
    {
        $this->tmpl = 'mobile:member/designer/shejiguanli.html';
    }


    public function attr()
    {
        $designer = $this->ucenter_designer();
        if($attr = $this->checksubmit('attr')){
            K::M('designer/attr')->update($this->uid, $attr);
            $this->err->add('设计师属性设置成功');
        }else{
            $this->pagedata['attr'] = K::M('designer/attr')->attrs_ids_by_designer($this->uid);
            $this->tmpl = 'mobile:member/designer/attr.html';
        }
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
			$this->tmpl = 'mobile:member/designer/refresh/look.html';
		}
	}

	public function city(){
        $this->ajaxReturn( K::M('data/city')->options(intval($_POST['province_id'])));
    }

}