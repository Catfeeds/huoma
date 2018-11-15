<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: chao.ctl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Chao_Baojia extends Ctl
{

    public function baojia($case_id=null,$cz_id=0,$page=1)
    {
        if(!$case_id = (int)$case_id){
            $this->err->add('非指特装超市ID', 211);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('特装超市不存在或已经删除', 212);
        }else{
			if($case['cz_id']){
				if($changdi = K::M('canzhan/changdi')->detail($case['cz_id'])){
					$changdi['data'] = unserialize($changdi['data']);
					$this->pagedata['changdi'] = $changdi;
				}
			}
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 50;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
			$where =" b.case_id={$case_id} ";
            if($items = K::M('chao/baojia')->items(array('case_id'=>$case_id),array('status'=>'DESC','gc_price'=>'DESC'), $page, $limit, $count)){
				if(count($items)){
					$tmp = array();
					foreach($items as $key=>$val){
//						if($key=='info' || $key=='data' || $key=='changdi'){
							$val['info'] = unserialize($val['info']);
							$val['data'] = unserialize($val['data']);
							$val['yuandata'] = unserialize($val['yuandata']);
							if($val['iser']==2){
								$yuan_price = 0;
								foreach($val['yuandata'] as $v){
									$yuan_price += $v['price'];
									
								}
								$val['yuan_price'] = $yuan_price;
							}
							$val['changdi'] = unserialize($val['changdi']);
//						}
						$tmp[] = $val;
					}
				}
                $this->pagedata['items'] = $tmp;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("chao/baojia:baojia", array($case_id,$cz_id,'{page}')));
            }
            $this->pagedata['cz_id'] = $cz_id;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['case'] = $case;
            $this->tmpl = 'admin:chao/chao/baojia.html';
        }
    }

    public function tongbu($baojia_id=0,$cz_id=0)
    {
        if(!$baojia_id || !$cz_id){
            $this->err->add('当前ID同步出错请联系管理人员', 211);
        }else if(!$changdi = K::M('canzhan/changdi')->detail($cz_id)){
            $this->err->add('场地费为空，请先去参展计划添加场地费用', 212);
        }else if(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('场地费为空，请先去参展计划添加场地费用', 212);
        }else{
			$data['changdi'] = $changdi['data'];
			$data['cd_price'] = $changdi['price'];
			$data['shui_price'] = $baojia['shuidian']*($changdi['price']+$baojia['price'])/100;
			$data['heji_price'] = $changdi['price']+$baojia['price']+$data['shui_price']+$baojia['fuwu_price']+$baojia['sheji_price'];
			if(K::M('chao/baojia')->update($baojia_id,  $data)){
 				$this->err->set_data('forward', '?chao/baojia-baojia-'.$baojia['case_id'].'-'.$baojia['cz_id'].'.html');
                $this->err->add('同步成功');
            }
		}
    }
    public function isshow($case_id=0)
    {
        if(!$case_id){
            $this->err->add('当前ID为空，不可操作', 211);
        }else if(!$changdi = K::M('case/case')->detail($case_id)){
            $this->err->add('设计稿不存在请联系管理员', 212);
        }else{			
			if(K::M('chao/baojia')->isshow($case_id)){
                 $this->err->add('设置成功');
            }
		}
    }
    public function piliang($case_id=0,$cz_id=0)
    {
        if(!$baojia_id = (int)$baojia_id || !$cz_id = (int)$cz_id){
            $this->err->add('当前ID同步出错请联系管理人员', 211);
        }else if(!$changdi = K::M('canzhan/changdi')->detail($cz_id)){
            $this->err->add('场地费为空，请先去参展计划添加场地费用', 212);
        }else if(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('场地费为空，请先去参展计划添加场地费用', 212);
        }else{
			$data['changdi'] = $changdi['data'];
			$data['cd_price'] = $changdi['price'];
			$data['shui_price'] = $baojia['shuidian']*($changdi['price']+$baojia['price'])/100;
			$data['heji_price'] = $changdi['price']+$baojia['price']+$data['shui_price']+$baojia['fuwu_price']+$baojia['sheji_price'];
			
			if(K::M('chao/baojia')->update($baojia_id,  $data)){
                 $this->err->add($msg.'同步成功');
            }
		}
    }

    public function gongchang($case_id=0,$cz_id=0)
    {
        if(empty($case_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('case/case')->detail($case_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else{
            if($this->checksubmit()){
                if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }elseif(!$company_list = K::M('company/company')->items_by_compay_ids($data['company_id'])){
					$this->err->add('选择工厂有误请重新选择！', 201);
				}else{
					$chongfu = $chenggong = 0;
						foreach($company_list as $company){
							if($baojia = K::M('chao/baojia')->items(array('case_id'=>$case_id,'company_id'=>$company['company_id']))){
								$chongfu++;
							}else{
								$cinfo = array(
												'company_id]'=>$company['company_id'],
												'title'=>$company['title'],
												'logo'=>$company['logo']
										);
								$datas['info'] = serialize($cinfo);
								$datas['cz_id'] = $cz_id;
								$datas['case_id'] = $case_id;
								$datas['company_id'] = $company['company_id']; 
								$datas['addtime'] = __TIME;
					//			$rule = K::M('canzhan/rule')->rule($detail['mianji']);
					//			$datas['endtime'] = __TIME + $rule['baojia']*24*3600;
								$datas['endtime'] = __TIME + 2*24*3600;  //默认两天
	
								
								if($baojia_id = K::M('chao/baojia')->create($datas)){
									K::M('company/company')->update_count($company['company_id'], 'fp_num');
									K::M('sms/sms')->company($company,'admin_company_baojia',array('name'=>$company['contact']));
									$chenggong++;
								}
						}
					
						
					} 
					if(K::M('canzhan/canzhan')->update($cz_id, array('status'=>4))){
						  $this->err->set_data('forward', '?chao/baojia-baojia-'.$case_id.'-'.$cz_id.'.html');
						  $this->err->add('指派工厂完成！成功：'.$chenggong.';重复：'.$chongfu);
					}
			}
            }else{
	            $this->pagedata['cz_id'] = $cz_id;
	            $this->pagedata['detail'] = $detail;
                $this->tmpl = 'admin:chao/baojia/gongchang.html';
            }
        }
    }

    public function caizhi($case_id=0,$cz_id=0)
    {
        if(empty($case_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('case/case')->detail($case_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else{
           if($data = $this->checksubmit('data')){
				if(K::M('case/case')->update($case_id, $data)){
					  $this->err->set_data('forward', '?chao/baojia-baojia-'.$case_id.'-'.$cz_id.'.html');
					  $this->err->add('材质要求保存成功！');
				}
            }else{
	            $this->pagedata['cz_id'] = $cz_id;
	            $this->pagedata['detail'] = $detail;
                $this->tmpl = 'admin:chao/baojia/caizhi.html';
            }
        }
    }
    public function edit($baojia_id=0,$case_id=0,$cz_id=0)
    {
        if(empty($baojia_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else{
           if($data = $this->checksubmit('data')){
			   $baojia = $this->GP('baojia');
				$tijiao = array(); 
				$isempty = 1;
				$heji = 0;
				$chao_baojia = array();
				foreach($baojia['price'] as $key=>$val){
					if(empty($val) || $val==0){
						$isempty=0;
						$this->err->add('不能有空项！请核实后提交', 211);
						break;
					}else{
						$tijiao[$key]['xiangmu'] = $baojia['xiangmu'][$key];
						$tijiao[$key]['price'] = $val;
						$heji += $val;
					}
				}
				$data['data'] = serialize($tijiao);
				$data['gc_price'] = $heji;
				if(K::M('chao/baojia')->update($baojia_id, $data)){
					  $this->err->set_data('forward', '?chao/baojia-baojia-'.$case_id.'-'.$cz_id.'.html');
					  $this->err->add('工厂价格修改成功！');
				}
            }else{
				if($detail['gc_price']>0){
					$xiangmu = unserialize($detail['data']);
				}else{
					$xiangmu = array(
						0=>array('xiangmu'=>'地面部分','price'=>0),
						1=>array('xiangmu'=>'主体结构','price'=>0),
						2=>array('xiangmu'=>'电工/AV','price'=>0),
						3=>array('xiangmu'=>'美工','price'=>0),
						4=>array('xiangmu'=>'运输/搭建/拆除','price'=>0)
					);
				}
	            $this->pagedata['xiangmu'] = $xiangmu;
	            $this->pagedata['case_id'] = $case_id;
	            $this->pagedata['cz_id'] = $cz_id;
	            $this->pagedata['detail'] = $detail;
                $this->tmpl = 'admin:chao/baojia/edit.html';
            }
        }
    }

    public function qiandan($baojia_id= null,$cz_id= null)
    {
        if(!$baojia_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('来源有误', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('来源有误', 211);
        }elseif($canzhan['sign_company_id']){
            $this->err->add('已经签约！如有修改请联系执行经理！', 211);
        }else{
			$data['baojia_id'] = $baojia_id;
			$data['company_id'] = $baojia['company_id'];
			$data['status'] = 5;
			$data['sign_time'] = __TIME;
			if(K::M('canzhan/canzhan')->update($cz_id, $data)){
				if(K::M('chao/baojia')->update($baojia_id, array('status'=>1))){
					$info = unserialize($baojia['info']);
					$log = array(
									'cz_id'=>$cz_id,
									'uid'=>$this->admin->admin_id,
									'username'=>$this->admin->admin_name,
									'ctrl'=>'签约工厂ID:'.$baojia['company_id'].'工厂名称:'.$info['title']
								);
				   K::M('company/company')->update_count($baojia['company_id'], 'qy_num');
					K::M('canzhan/log')->create($log,'qiandan');
					$this->err->set_data('forward', '?chao/baojia-baojia-'.$baojia['case_id'].'-'.$baojia['cz_id'].'.html');
					$this->err->add('签单成功');
				}
            }
        }   
    }
    public function qiandan_cancel($baojia_id= null,$cz_id= null)
    {
        if(!$baojia_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('来源有误', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('来源有误', 211);
        }else{
			$data['baojia_id'] = 0;
			$data['company_id'] = 0;
			$data['sign_time'] = 0;
			if(K::M('canzhan/canzhan')->update($cz_id, $data)){
				if(K::M('chao/baojia')->update($baojia_id, array('status'=>0))){
					$this->err->set_data('forward', '?chao/baojia-baojia-'.$baojia['case_id'].'-'.$baojia['cz_id'].'.html');
					$this->err->add('签单成功');
				}
            }
        }   
    }


}