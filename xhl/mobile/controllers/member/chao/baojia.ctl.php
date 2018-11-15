<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: canzhan.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Chao_Baojia extends Ctl_Ucenter
{
    
	public function __construct(&$system)
	{
		parent::__construct($system);
	}

    public function index($page=0)
    {
    	if(!$page = $this->GP('page')){
			$page=1;
		}
		//var_dump($page);die;
		$company = $this->ucenter_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $ids = array();
		$where ="b.company_id={$company['company_id']} AND b.endtime > ".__TIME;
          if($items = K::M('chao/baojia')->items_baojia_chao_designer($where, array('endtime'=>'ASC'), $page, $limit, $count)){
			  $tem = array();
            foreach($items as $k=>$v){
                $ids[$v['id']] = $v['id'];
				$v['endtime'] = $this->endtime($v['endtime']-time());
				$tem[$k] = $v;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $tem;
        }
        $where1 ="b.company_id={$company['company_id']} AND b.gc_price>0 AND b.endtime < ".__TIME;
       	if($wancheng = K::M('chao/baojia')->items_baojia_chao_designer($where1, array('endtime'=>'ASC'), $page, $limit, $count)){
            foreach($wancheng as $k=>$v){
                $ids[$v['case_id']] = $v['case_id'];
                $cz_ids[$v['cz_id']] = $v['cz_id'];
				$wancheng[$k] = $v;
            }
			if($canzhan = K::M('canzhan/canzhan')->items_by_ids($cz_ids)){
			}
			if($baojia = K::M('chao/baojia')->items_case_ids($ids)){
			}
				foreach($wancheng as $k=>$v){
					$v['baojia'] = $baojia[$v['case_id']];
					$v['canzhan'] = $canzhan[$v['cz_id']];
					$wancheng[$k] = $v;
				}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
	        $this->pagedata['wancheng'] = $wancheng;
        }

		$where2 ="b.company_id={$company['company_id']} AND b.gc_price=0 AND b.endtime < ".__TIME;
        if($guoqi = K::M('chao/baojia')->items_baojia_chao_designer($where2, array('endtime'=>'DESC'), $page, $limit, $count)){
            foreach($guoqi as $k=>$v){
                $ids[$v['case_id']] = $v['case_id'];
                $cz_ids[$v['cz_id']] = $v['cz_id'];
			//	$v['endtime'] = $this->endtime($v['endtime']-time());
				$guoqi[$k] = $v;
            }
			
			if($canzhan = K::M('canzhan/canzhan')->items_by_ids($cz_ids)){
			}
			if($baojia = K::M('chao/baojia')->items_case_ids($ids)){
			}
				foreach($guoqi as $k=>$v){
					$v['baojia'] = $baojia[$v['case_id']];
					$v['canzhan'] = $canzhan[$v['cz_id']];
					$guoqi[$k] = $v;
				}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['guoqi'] = $guoqi;
        }

        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/chao/baojia/index.html';
    }

    public function conclock($page=0)
    {
    	if(!$page = $this->GP('page')){
			$page=1;
		}
		//var_dump($page);die;
		$company = $this->ucenter_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $ids = array();
		$where ="b.company_id={$company['company_id']} AND b.endtime > ".__TIME;
		
          if($items = K::M('chao/baojia')->items_baojia_chao_designer($where, array('endtime'=>'ASC'), $page, $limit, $count)){
			  $tem = array();
            foreach($items as $k=>$v){
                $ids[$v['id']] = $v['id'];
				$v['endtime'] = $this->endtime($v['endtime']-time());
				$tem[$k] = $v;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));

        }
        $this->pagedata['items'] = $tem;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/chao/baojia/conclock.html';
    }
	
    public function baojiadetail($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输搭建','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/baojiadetail.html';
		}
    }

    public function baojiaimg($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输搭建','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/baojiaimg.html';
		}
    }

    public function qiandan($page=1)
    {
		$company = $this->ucenter_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
		$filter['company_id'] = $company['company_id'];
 		
         if($items = K::M('canzhan/canzhan')->items($filter, array('cz_id'=>'DESC'), $page, $limit, $count)){
			$cz_ids = $case_ids = $sheji = array();
			foreach($items as $k=>$v){
				$cz_ids[$v['cz_id']] = $v['cz_id'];
				$case_ids[$v['case_id']] = $v['case_id'];
				$baojia_ids[$v['baojia_id']] = $v['baojia_id'];
			}
			if($case_list = K::M('case/case')->items_by_ids($case_ids)){
			}
			if($baojia_list = K::M('chao/baojia')->items_by_ids($baojia_ids)){
			}
			if($jindu_list = K::M('canzhan/jindu')->items_canzhan_ids($cz_ids)){
			}
			foreach($items as $key=>$val){
				$val['case'] = $case_list[$val['case_id']];
				$val['baojia'] = $baojia_list[$val['baojia_id']];
				$val['jindu'] = $jindu_list[$val['cz_id']];
				$items[$key] = $val;
			}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/chao/baojia/qiandan.html';
    }

     public function qiandanlist($page=0)
    {
    	if(!$page = $this->GP('page')){
			$page=1;
		}
		$company = $this->ucenter_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
		$filter['company_id'] = $company['company_id'];
 		
         if($items = K::M('canzhan/canzhan')->items($filter, array('cz_id'=>'DESC'), $page, $limit, $count)){
			$cz_ids = $case_ids = $sheji = array();
			foreach($items as $k=>$v){
				$cz_ids[$v['cz_id']] = $v['cz_id'];
				$case_ids[$v['case_id']] = $v['case_id'];
				$baojia_ids[$v['baojia_id']] = $v['baojia_id'];
			}
			if($case_list = K::M('case/case')->items_by_ids($case_ids)){
			}
			if($baojia_list = K::M('chao/baojia')->items_by_ids($baojia_ids)){
			}
			if($jindu_list = K::M('canzhan/jindu')->items_canzhan_ids($cz_ids)){
			}
			foreach($items as $key=>$val){
				$val['case'] = $case_list[$val['case_id']];
				$val['baojia'] = $baojia_list[$val['baojia_id']];
				$val['jindu'] = $jindu_list[$val['cz_id']];
				$items[$key] = $val;
			}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/chao/baojia/qiandanlist.html';
    }
	
    public function wancheng($page=0)
    {
    	if(!$page = $this->GP('page')){
			$page=1;
		}
		$company = $this->ucenter_company();
        $filter = $pager = $ids =array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $ids = array();
		$where ="b.company_id={$company['company_id']} AND b.gc_price>0 AND b.endtime < ".__TIME;
		
          if($wancheng = K::M('chao/baojia')->items_baojia_chao_designer($where, array('endtime'=>'ASC'), $page, $limit, $count)){
            foreach($wancheng as $k=>$v){
                $ids[$v['case_id']] = $v['case_id'];
                $cz_ids[$v['cz_id']] = $v['cz_id'];
			//	$v['endtime'] = $this->endtime($v['endtime']-time());
				$wancheng[$k] = $v;
            }
			if($canzhan = K::M('canzhan/canzhan')->items_by_ids($cz_ids)){
			}
			if($baojia = K::M('chao/baojia')->items_case_ids($ids)){
			}
				foreach($wancheng as $k=>$v){
					$v['baojia'] = $baojia[$v['case_id']];
					$v['canzhan'] = $canzhan[$v['cz_id']];
					$wancheng[$k] = $v;
				}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
	        $this->pagedata['wancheng'] = $wancheng;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/chao/baojia/wancheng.html';
    }

    public function wanchengdetail($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输搭建','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/wanchengdetail.html';
		}
    }

    public function wanchengimg($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输搭建','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/wanchengimg.html';
		}
    }

    public function guoqi($page=0)
    {
    	if(!$page = $this->GP('page')){
			$page=1;
		}
		$company = $this->ucenter_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $ids = array();
		$where ="b.company_id={$company['company_id']} AND b.gc_price=0 AND b.endtime < ".__TIME;
		
          if($guoqi = K::M('chao/baojia')->items_baojia_chao_designer($where, array('endtime'=>'DESC'), $page, $limit, $count)){
            foreach($guoqi as $k=>$v){
                $ids[$v['case_id']] = $v['case_id'];
                $cz_ids[$v['cz_id']] = $v['cz_id'];
			//	$v['endtime'] = $this->endtime($v['endtime']-time());
				$guoqi[$k] = $v;
            }
			
			if($canzhan = K::M('canzhan/canzhan')->items_by_ids($cz_ids)){
			}
			if($baojia = K::M('chao/baojia')->items_case_ids($ids)){
			}
				foreach($guoqi as $k=>$v){
					$v['baojia'] = $baojia[$v['case_id']];
					$v['canzhan'] = $canzhan[$v['cz_id']];
					$guoqi[$k] = $v;
				}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));

        }
        $this->pagedata['guoqi'] = $guoqi;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/chao/baojia/guoqi.html';
    }

    public function guoqidetail($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输搭建','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/guoqidetail.html';
		}
    }

    public function guoqiimg($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输搭建','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/guoqiimg.html';
		}
    }

	
    public function kaigong($cz_id= null)
    {
        $company = $this->ucenter_company();
        if(!$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('来源有误', 211);
        }elseif($canzhan['kaigong']){
            $this->err->add('已经开工！', 211);
        }elseif($canzhan['company_id']!=$company['company_id']){
            $this->err->add('不可越权管理！', 211);
        }else{
			$data['kaigong'] = __TIME;
			if(K::M('canzhan/canzhan')->update($cz_id, $data)){
				$log = array(
								'cz_id'=>$cz_id,
								'uid'=>$company['company_id'],
								'username'=>$company['title'],
								'ctrl'=>'开工'
							);
				K::M('canzhan/log')->create($log,'kaigong');
 			   $this->err->set_data('forward', $this->mklink('member/chao/baojia:qiandan',array('',__TIME)));
               $this->err->add('已确认开工！');
            }
        }   
    }
  public function wangong($cz_id= null)
    {
        $company = $this->ucenter_company();
        if(!$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('来源有误', 211);
        }elseif($canzhan['wangong']){
            $this->err->add('已经完工！', 211);
        }elseif($canzhan['company_id']!=$company['company_id']){
            $this->err->add('不可越权管理！', 211);
        }else{
			$data['wangong'] = __TIME;
			if(K::M('canzhan/canzhan')->update($cz_id, $data)){
				$log = array(
								'cz_id'=>$cz_id,
								'uid'=>$company['company_id'],
								'username'=>$company['title'],
								'ctrl'=>'完工'
							);
				K::M('canzhan/log')->create($log,'wangong');
// 			   $this->err->set_data('forward', $this->mklink('member/shang/canzhan:canzhanDetail',array($id)));
               $this->err->add('今日完工！');
            }
        }   
    }

    public function create($baojia_id)
    {
        $company = $this->ucenter_company();
        if(!$baojia_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('信息已过时', 211);
        }elseif($baojia['company_id'] != $company['company_id']){
            $this->err->add('非法查看', 211);
        }elseif ($data = $this->checksubmit('baojia')) {
			if($baojia['endtime']<__TIME){
				$this->err->add('报价已经结束！', 211);
			}else{
			$tijiao = array(); 
			$isempty = 1;
			$heji = 0;
			$chao_baojia = array();
			foreach($data['price'] as $key=>$val){
				if(empty($val) || $val==0){
					$isempty=0;
					$this->err->add('非法查看', 211);
					break;
				}else{
					$tijiao[$key]['xiangmu'] = $data['xiangmu'][$key];
					$tijiao[$key]['price'] = $val;
					$heji += $val;
				}
			}
			if(isset($data['customxiangmu'])){
				$num = count($tijiao);
				foreach($data['customprice'] as $key=>$val){
					if(empty($val) || $val==0){
					}else{
						$tijiao[$num]['xiangmu'] = $data['customxiangmu'][$key];
						$tijiao[$num]['price'] = $val;
						$heji += $val;
					}
					$num++;
				}
				
			}
			if($isempty){
				$cinfo = array(
								'company_id]'=>$company['company_id'],
								'title'=>$company['title'],
								'logo'=>$company['logo']
						);
				$chao_baojia['info'] = serialize($cinfo);
				$chao_baojia['data'] = serialize($tijiao);
				$chao_baojia['gc_price'] = $heji;
				$chao_baojia['price'] = $heji*1.3; //30%
				$chao_baojia['bj_time'] = __TIME;
				if(K::M('chao/baojia')->update($baojia_id, $chao_baojia)){
					$this->err->add('报价成功');
				}
			}
			}
		}else{
			if($baojia['gc_price']>0){
				$xiangmu = unserialize($baojia['data']);
			}else{
				$xiangmu = array(
					0=>array('xiangmu'=>'地面部分','price'=>0),
					1=>array('xiangmu'=>'主体结构','price'=>0),
					2=>array('xiangmu'=>'电工/AV','price'=>0),
					3=>array('xiangmu'=>'美工','price'=>0),
					4=>array('xiangmu'=>'运输/搭建/拆除','price'=>0)
				);
			}

			$zhantai = K::M('case/case')->detail($baojia['case_id']);
			$photos = K::M('case/photo')->items_by_case($baojia['case_id'], 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			if($baojia['endtime']<__TIME){
				$this->pagedata['jieshu'] = 1;
			}else{
				$this->pagedata['jieshu'] = 0;
			}
			$this->pagedata['baojia'] = $baojia;
			$this->pagedata['list_pic'] = $list_pic;
			$this->pagedata['xiangmu'] = $xiangmu;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/chao/baojia/create.html';
		}
    }
}